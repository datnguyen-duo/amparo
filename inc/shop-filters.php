<?php

$per_page = 12;
function shop_filter() {
    $current_page = sanitize_text_field($_GET['page']);
    $sort = sanitize_text_field($_GET['sort']);
    $medium = $_GET['medium'];
    $style = $_GET['style'];
    $subject = $_GET['subject'];
    $collection = $_GET['collection'];
    $size = $_GET['size'];
    $orientation = $_GET['orientation'];
    $search = sanitize_text_field($_GET['search']);
    $price = $_GET['price'];
    $artists = $_GET['artists'];

    $products_args = array(
        'post_type' => 'product',
        'posts_per_page' => $GLOBALS['per_page'],
        'paged' => $current_page,
        's' => $search,
        'tax_query' => array(
            'relation' => 'AND',
        ),
        'meta_query' => array()
    );

    if( $sort == 'sales' ) {
        $products_args['orderby'] = 'meta_value_num';
        $products_args['meta_key'] = 'total_sales';
    } elseif( $sort == 'price' ) {
        $products_args['orderby'] = 'meta_value_num';
        $products_args['meta_key'] = '_price';
    }

    if( $artists ) {
        $products_args['author__in'] = $artists;
    }

    if( $medium ) {
        array_push($products_args['tax_query'],array(
            'taxonomy' => 'product-medium',
            'field' => 'slug',
            'terms' => $medium
        ));
    }

    if( $style ) {
        array_push($products_args['tax_query'],array(
            'taxonomy' => 'product-style',
            'field' => 'slug',
            'terms' => $style
        ));
    }

    if( $subject ) {
        array_push($products_args['tax_query'],array(
            'taxonomy' => 'product-subject',
            'field' => 'slug',
            'terms' => $subject
        ));
    }

    if( $collection ) {
        array_push($products_args['tax_query'],array(
            'taxonomy' => 'product-collection',
            'field' => 'slug',
            'terms' => $collection
        ));
    }

    if( $size ) {
        array_push($products_args['tax_query'],array(
            'taxonomy' => 'product-size',
            'field' => 'slug',
            'terms' => $size
        ));
    }

    if( $orientation ) {
        array_push($products_args['tax_query'],array(
            'taxonomy' => 'product-orientation',
            'field' => 'slug',
            'terms' => $orientation
        ));
    }

    if( $price ):
        $price_filter = array();

        foreach ($price as $item):
            $item = explode(" ",$item);

            $object = array(
                'key' => '_price',
                'type'    => 'numeric',
                'compare' => $item[0],
                'value' => ( $item[0] == 'BETWEEN' ) ? array($item[1],$item[2]) : $item[1]
            );

            array_push($price_filter, $object);
        endforeach;

        $price_filter['relation'] = 'OR';
        $products_args['meta_query']['price_clause'] = $price_filter;
    endif;

    $products = new WP_Query($products_args);

    print_products($products);
    die;
}
add_action('wp_ajax_shop_filter', 'shop_filter'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_shop_filter', 'shop_filter');

function print_products( $query = '' ) {
    if( !$query ) {
        $query = new WP_Query(array(
            'post_type' => 'product',
            'posts_per_page' => $GLOBALS['per_page'],
            'paged' => 1,
//            'orderby' => 'meta_value_num',
//            'meta_key' => 'total_sales',
        ));
    }
    $posts_per_page = $query->query['posts_per_page'];
    $found_posts = $query->found_posts;
    $current_page = $query->query['paged'];
    $total_pages = ceil($found_posts / $posts_per_page);
    if( $query->have_posts() ): ?>
        <div class="artist_work">
            <div class="artist_work_wrap">
                <?php while( $query->have_posts() ): $query->the_post();
                    $product = wc_get_product( get_the_ID() );
                    $author = get_the_author();
                    $price = $product->get_price();
                    $is_in_stock = $product->is_in_stock();
                    ?>
                    <a href="<?php the_permalink() ?>" class="single_work">
                        <?php if( !$is_in_stock ): ?>
                            <span class="sold-out">Sold out</span>
                        <?php endif; ?>

                        <?php if( $author || $price ): ?>
                            <div class="price">
                                <?php if( $author ): ?>
                                    <span class="author_name"><?= $author ?></span>
                                <?php endif; ?>

                                <?php if( $price): ?>
                                    <span class="price_text">
                                        <?= wc_price($product->get_price()) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="single_work_image">
                            <?php the_post_thumbnail('full'); ?>
                        </div>

                        <div class="art_name"><?php the_title() ?></div>
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <?php if( $total_pages > 1 ): ?>
                <div class="artists_pagination">
                    <div class="pagination_arrow pagination_arrow_left pagination-page" data-page="<?= ($current_page == 1) ? $total_pages : $current_page-1; ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/artists/arrow_left.svg" alt="" class="arrow_left">
                    </div>

                    <div class="middle">
                        <ul>
                            <?php for( $i=1; $i <= $total_pages; $i++ ): ?>
                                <li data-page="<?php echo $i; ?>" class="pagination-page  <?= ($current_page == $i) ? ' active' : null; ?>">
                                    <?php echo $i; ?>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </div>

                    <div class="pagination_arrow pagination_arrow_right pagination-page" data-page="<?= ($current_page == $total_pages) ? 1 : $current_page+1; ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/artists/arrow_left.svg" alt="" class="arrow_right">
                    </div>
                </div>
            <?php endif; ?>
        </div>


    <?php else: ?>
        <div class="no-results">
            <h2>No posts found.</h2>
        </div>
    <?php endif; ?>
<?php }