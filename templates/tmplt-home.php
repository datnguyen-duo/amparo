<?php
/* Template Name: Home */
$products = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => 20,
    'post_status' => array( 'publish' ),
//    'order' => '',
//    'paged' => '',
    'tax_query' => array(),
    'orderby' => 'rand',
));

get_header(); ?>

<div class="home_indicator_desktop">
    <img src="<?php echo get_template_directory_uri(); ?>/images/drag-icon.svg" class="drag-icon">
    <p>DRAG MOUSE</p>
</div>

<div class="home_wrap">
    <a href="/contact" class="home_fixed_button"><span>Contact Us</span></a>

    <?php if( $products->have_posts() ): ?>
        <div class="artist_work_wrap" >
            <div class="artist_work_grid">
                <?php while( $products->have_posts() ): $products->the_post();
                    $product = wc_get_product( get_the_ID() );
                    $author = get_the_author();
                    $price = $product->get_price()
                    ?>
                    <a href="<?php the_permalink() ?>" class="single_work">
                        <?php if( $author || $price ): ?>
                            <div class="price">
                                <?php if( $author ): ?>
                                    <span><?= $author ?></span>
                                <?php endif; ?>

                                <?php if( $price ): ?>
                                    <span><?= get_woocommerce_currency_symbol().''.$price ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="single_work_image">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>

                        <div class="art_name"><?php the_title() ?></div>
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
    

<?php
get_footer(); ?>