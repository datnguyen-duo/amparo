<?php
get_header();

$filtered_medium = sanitize_text_field(( isset($_GET["medium"]) ) ? $_GET["medium"] : '');
$filtered_style = sanitize_text_field(( isset($_GET["style"]) ) ? $_GET["style"] : '');
$filtered_subject = sanitize_text_field(( isset($_GET["subject"]) ) ? $_GET["subject"] : '');
$filtered_collection = sanitize_text_field(( isset($_GET["collection"]) ) ? $_GET["collection"] : '');
$filtered_size = sanitize_text_field(( isset($_GET["size"]) ) ? $_GET["size"] : '');
$filtered_orientation = sanitize_text_field(( isset($_GET["orientation"]) ) ? $_GET["orientation"] : '');

$filtered_products_args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    'post_status' => array( 'publish' ),
    'paged' => 1,
    'tax_query' => array(),
    'orderby' => 'meta_value_num',
    'meta_key' => 'total_sales',
);

if( $filtered_medium ) {
    array_push($filtered_products_args['tax_query'],array(
        'taxonomy' => 'product-medium',
        'field' => 'slug',
        'terms' => $filtered_medium,
    ));
}

if( $filtered_style ) {
    array_push($filtered_products_args['tax_query'],array(
        'taxonomy' => 'product-style',
        'field' => 'slug',
        'terms' => $filtered_style,
    ));
}

if( $filtered_subject ) {
    array_push($filtered_products_args['tax_query'],array(
        'taxonomy' => 'product-subject',
        'field' => 'slug',
        'terms' => $filtered_subject,
    ));
}

if( $filtered_collection ) {
    array_push($filtered_products_args['tax_query'],array(
        'taxonomy' => 'product-collection',
        'field' => 'slug',
        'terms' => $filtered_collection,
    ));
}

if( $filtered_size ) {
    array_push($filtered_products_args['tax_query'],array(
        'taxonomy' => 'product-size',
        'field' => 'slug',
        'terms' => $filtered_size,
    ));
}

if( $filtered_orientation ) {
    array_push($filtered_products_args['tax_query'],array(
        'taxonomy' => 'product-orientation',
        'field' => 'slug',
        'terms' => $filtered_orientation,
    ));
}

$medium_terms = get_terms(array('taxonomy'=>'product-medium'));
$style_terms = get_terms(array('taxonomy'=>'product-style'));
$subject_terms = get_terms(array('taxonomy'=>'product-subject'));
$collection_terms = get_terms(array('taxonomy'=>'product-collection'));
$size_terms = get_terms(array('taxonomy'=>'product-size'));
$orientation_terms = get_terms(array('taxonomy'=>'product-orientation'));

$products = new WP_Query($filtered_products_args);

$price_filters = array(
    array('value' => '< 2000',            'text' => 'Below $2000'),
    array('value' => 'BETWEEN 2000 2500', 'text' => '$2,000 - $2,500'),
    array('value' => 'BETWEEN 2500 3000', 'text' => '$2,500 - $3,000'),
    array('value' => 'BETWEEN 3000 3500', 'text' => '$3,000 - $3,500'),
    array('value' => '> 3500',            'text' => 'More than $3,500')
);

$user_query = new WP_User_Query( array(
    'role' => 'wcfm_vendor',
    'number' => $GLOBALS['artists_per_page'],
));

?>
    <div class="shop_all">

        <form id="products-shop-form">
            <input type="hidden" name="action" value="shop_filter">
            <input type="hidden" name="page" value="1" id="products-page-num-input">

            <div class="mobile_shop_filter">
                <div class="mobile_shop_filter_header">
                    <div class="left">
                        <div class="mobile_filters_holder">
                            <p>FILTER BY</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                            </svg>
                        </div>
                    </div>
                    <div class="right search_action">
                        <p>SEARCH</p>
                    </div>
                </div>

                <div class="search_input_holder">
                    <input type="text" placeholder="I AM LOOKING FOR..." id="search_input" name="search">
                </div>

                <div class="filters_holder">
                    <div class="sort_filter_mobile">
                        <label class="single_filter">
                            <input type="radio" name="sort" value="sales" checked>
                            <span>RELEVANCE</span>
                        </label>
                        <label class="single_filter">
                            <input type="radio" name="sort" value="date">
                            <span>NEWEST</span>
                        </label>
                        <label class="single_filter">
                            <input type="radio" name="sort" value="price">
                            <span>PRICE</span>
                        </label>
                    </div>

                    <div class="filter_headline">
                        FILTER BY:
                    </div>

                    <div class="main_filters_mobile">
                        <ul>
                            <?php if( $medium_terms ): ?>
                                <li>
                                    <a data-text="Medium">
                                        Medium
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                            <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                        </svg>
                                    </a>

                                    <div class="sub_filters_mobile medium">
                                        <?php foreach ( $medium_terms as $term ): ?>
                                            <label>
                                                <input type="checkbox" value="<?= $term->slug ?>" name="medium[]" <?= ( $filtered_medium == $term->slug ) ? ' checked' : null; ?>>
                                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if( $style_terms ): ?>
                                <li>
                                    <a data-text="Style">Style
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                            <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                        </svg>
                                    </a>

                                    <div class="sub_filters_mobile style">
                                        <?php foreach ( $style_terms as $term ): ?>
                                            <label>
                                                <input type="checkbox" value="<?= $term->slug ?>" name="style[]" <?= ( $filtered_style == $term->slug ) ? ' checked' : null; ?>>
                                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if( $subject_terms ): ?>
                                <li>
                                    <a data-text="Subject">Subject
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                            <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                        </svg>
                                    </a>

                                    <div class="sub_filters_mobile subject">
                                        <?php foreach ( $subject_terms as $term ): ?>
                                            <label>
                                                <input type="checkbox" value="<?= $term->slug ?>" name="subject[]" <?= ( $filtered_subject == $term->slug ) ? ' checked' : null; ?>>
                                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <li>
                                <a data-text="Price">Price
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                        <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                    </svg>
                                </a>

                                <div class="sub_filters_mobile price">
                                    <?php foreach ( $price_filters as $price ): ?>
                                        <label>
                                            <input type="checkbox" value="<?= $price['value'] ?>" name="price[]">
                                            <span class="btn dark_outlined" data-text="<?= $price['text'] ?>"><?= $price['text'] ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </li>

                            <?php if( $user_query->get_results() ): ?>

                            <?php endif; ?>

                            <?php if( $user_query->get_results() ): ?>
                                <li>
                                    <a data-text="Artists">Artists
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                            <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                        </svg>
                                    </a>

                                    <div class="sub_filters_mobile artists">
                                        <?php foreach ( $user_query->get_results() as $author ): ?>
                                            <label>
                                                <input type="checkbox" value="<?= $author->ID ?>" name="artists[]">
                                                <span class="btn dark_outlined" data-text="<?= $author->display_name ?>"><?= $author->display_name ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if( $collection_terms ): ?>
                                <li>
                                    <a data-text="Collection">Collection
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                            <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                        </svg>
                                    </a>

                                    <div class="sub_filters_mobile collection">
                                        <?php foreach ( $collection_terms as $term ): ?>
                                            <label>
                                                <input type="checkbox" value="<?= $term->slug ?>" name="collection[]" <?= ( $filtered_collection == $term->slug ) ? ' checked' : null; ?>>
                                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if( $size_terms ): ?>
                                <li>
                                    <a data-text="Size">Size
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                            <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                        </svg>
                                    </a>

                                    <div class="sub_filters_mobile size">
                                        <?php foreach ( $size_terms as $term ): ?>
                                            <label>
                                                <input type="checkbox" value="<?= $term->slug ?>" name="size[]" <?= ( $filtered_size == $term->slug ) ? ' checked' : null; ?>>
                                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php endif; ?>


                            <?php if( $orientation_terms ): ?>
                                <li>
                                    <a data-text="Orientation">Orientation
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                            <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                        </svg>
                                    </a>

                                    <div class="sub_filters_mobile orientation">
                                        <?php foreach ( $orientation_terms as $term ): ?>
                                            <label>
                                                <input type="checkbox" value="<?= $term->slug ?>" name="orientation[]" <?= ( $filtered_orientation == $term->slug ) ? ' checked' : null; ?>>
                                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="single_button_holder">
                        <button class="single_button" id="mobile_form_submit_button"><span>Apply Filters</span></button>
                    </div>
                </div>
            </div>

            <div class="desktop_shop_filters">
                <?php if( $medium_terms ): ?>
                    <div class="global_filters medium">
                        <?php foreach ( $medium_terms as $term ): ?>
                            <label>
                                <input type="checkbox" value="<?= $term->slug ?>" name="medium[]" <?= ( $filtered_medium == $term->slug ) ? ' checked' : null; ?>>
                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if( $style_terms ): ?>
                    <div class="global_filters style">
                        <?php foreach ( $style_terms as $term ): ?>
                            <label>
                                <input type="checkbox" value="<?= $term->slug ?>" name="style[]" <?= ( $filtered_style == $term->slug ) ? ' checked' : null; ?>>
                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if( $subject_terms ): ?>
                    <div class="global_filters subject">
                        <?php foreach ( $subject_terms as $term ): ?>
                            <label>
                                <input type="checkbox" value="<?= $term->slug ?>" name="subject[]" <?= ( $filtered_subject == $term->slug ) ? ' checked' : null; ?>>
                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if( $size_terms ): ?>
                    <div class="global_filters size">
                        <?php foreach ( $size_terms as $term ): ?>
                            <label>
                                <input type="checkbox" value="<?= $term->slug ?>" name="size[]" <?= ( $filtered_size == $term->slug ) ? ' checked' : null; ?>>
                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if( $orientation_terms ): ?>
                    <div class="global_filters orientation">
                        <?php foreach ( $orientation_terms as $term ): ?>
                            <label>
                                <input type="checkbox" value="<?= $term->slug ?>" name="orientation[]" <?= ( $filtered_orientation == $term->slug ) ? ' checked' : null; ?>>
                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="global_filters price">
                    <?php foreach ( $price_filters as $price ): ?>
                        <label>
                            <input type="checkbox" value="<?= $price['value'] ?>" name="price[]">
                            <span class="btn dark_outlined" data-text="<?= $price['text'] ?>"><?= $price['text'] ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <?php if( $user_query->get_results() ): ?>
                    <div class="global_filters artists">
                        <?php foreach ( $user_query->get_results() as $author ): ?>
                            <label>
                                <input type="checkbox" value="<?= $author->ID ?>" name="artists[]">
                                <span class="btn dark_outlined" data-text="<?= $author->display_name ?>"><?= $author->display_name ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if( $collection_terms ): ?>
                    <div class="global_filters collection">
                        <?php foreach ( $collection_terms as $term ): ?>
                            <label>
                                <input type="checkbox" value="<?= $term->slug ?>" name="collection[]" <?= ( $filtered_collection == $term->slug ) ? ' checked' : null; ?>>
                                <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="shop_header_section">
                    <div class="header_content">
                        <div class="headline_holder">
                            <h2 class="letter_wrap">All Art</h2>
                            <div class="art_counter">
                                <span><?= $products->found_posts ?></span>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/shop/square_shape.svg">
                            </div>
                        </div>

                        <div class="filter_holder sort_filter_holder">
                            <label class="single_filter">
                                <input type="radio" name="sort" value="sales" checked>
                                <span>RELEVANCE</span>
                            </label>
                            <label class="single_filter">
                                <input type="radio" name="sort" value="date">
                                <span>NEWEST</span>
                            </label>
                            <label class="single_filter">
                                <input type="radio" name="sort" value="price">
                                <span>PRICE</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="products_response">
                <?php print_products($products) ?>
            </div>
        </form>

        <?php
        $featured_artists = get_field('featured_artists',wc_get_page_id( 'shop' ));
        if( $featured_artists ):
            $author_base = ( get_option('_ba_eas_author_base') ) ? get_option('_ba_eas_author_base') : 'author';
        ?>
            <div class="featured_artist">

                <h2 class="letter_wrap">Featured Artists</h2>

                <div class="featured_artist_content">
                    <?php foreach ( $featured_artists as $artist ):
                        $author = get_user_by( 'ID', $artist['ID'] );
                        $author_slug = ( isset($author->user_nicename) ) ? $author->user_nicename : $author->nickname;
                        ?>
                        <div class="single_artist_wrap">
                            <div class="single_artist">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/artist_shape.svg" class="artist_shape">
                                <div class="artist_image_wrap">
                                    <div class="artist_image">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/rotate_circle.svg" class="rotate_circle">
                                        <?php
                                        $artist_img = get_field('profile_image', $author );
                                        if( $artist_img ):
                                            echo wp_get_attachment_image($artist_img['ID'],'large','',array('class'=>'artist'));
                                        else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/LogoAmparo-Logomark_Color.png" class="artist last">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="artist_info">
                                    <h3><?= $artist['display_name'] ?></h3>

                                    <?php if( $artist['user_description'] ): ?>
                                        <p class="test addReadMore showlesscontent"><?= $artist['user_description'] ?></p>
                                    <?php endif; ?>

                                    <a href="<?= site_url().'/'.$author_base.'/'.$author_slug ?>" class="btn dark" data-text="View Artist">View Artist</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="artist_slider">
                    <?php foreach ( $featured_artists as $artist ):
                        $author = get_user_by( 'ID', $artist['ID'] );
                        $author_slug = ( isset($author->user_nicename) ) ? $author->user_nicename : $author->nickname;
                    ?>
                        <div class="single_artist_wrap">
                            <div class="single_artist">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/artist_shape.svg" class="artist_shape">
                                <div class="artist_image_wrap">
                                    <div class="artist_image">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/rotate_circle.svg" class="rotate_circle">
                                        <?php
                                        $artist_img = get_field('profile_image', $author );
                                        if( $artist_img ):
                                            echo wp_get_attachment_image($artist_img['ID'],'large','',array('class'=>'artist'));
                                        else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/LogoAmparo-Logomark_Color.png" class="artist last">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="artist_info">
                                    <h3><?= $artist['display_name'] ?></h3>

                                    <?php if( $artist['user_description'] ): ?>
                                        <p class="test addReadMore showlesscontent"><?= $artist['user_description'] ?></p>
                                    <?php endif; ?>

                                    <a href="<?= site_url().'/'.$author_base.'/'.$artist['user_nicename'] ?>" class="btn dark" data-text="View Artist">View Artist</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>
