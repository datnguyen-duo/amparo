<?php
get_header();
global $post;

$orders_shipping_and_returns_headline = get_field('orders_shipping_and_returns_headline', 'option');
$orders_list = get_field('orders_list', 'option');
$orders_banner_text = get_field('orders_banner_text', 'option');
$product_cta_section_link = get_field('product_cta_section_link', 'option');
$product_cta_section_small_headline = get_field('product_cta_section_small_headline', 'option');
$product_cta_section_headline = get_field('product_cta_section_headline', 'option');

$product_id = get_the_ID();
$product = wc_get_product( $product_id );
$gallery = $product->get_gallery_image_ids();
$product_terms = get_the_terms( $product_id, 'product_cat' );
$product_tags = get_the_terms( $product_id, 'product_tag' );
$product_desc = $product->get_description();
$author_id = $post->post_author;
$author = get_user_by( 'ID', $author_id );

$author_title = $author->display_name;
$author_desc = get_the_author_meta('description',$author_id);
$author_profile_image = get_field('profile_image',$author);

$author_products = new WP_Query([
    'post_type'         => 'product',
    'posts_per_page'    => -1,
    'author__in'        => array($author_id),
]);

$medium_terms = get_the_terms($product_id, 'product-medium');
$style_terms = get_the_terms($product_id, 'product-style');
$subject_terms = get_the_terms($product_id, 'product-subject');
$collection_terms = get_the_terms($product_id, 'product-collection');
$orientation_terms = get_the_terms($product_id, 'product-orientation');
$size_terms = get_the_terms($product_id, 'product-size');
$staged_size_terms = get_the_terms($product_id, 'product-staged-size');

$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
?>
    <div class="single_product">
        <div class="hero_buttons">
            <?php
//                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
//                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
//                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
//                do_action( 'woocommerce_single_product_summary' );
            ?>
            <a href="<?= $product->add_to_cart_url() ?>" value="<?= esc_attr( $product->get_id() ); ?>" class="single_button ajax_add_to_cart add_to_cart_button" data-product_id="<?= get_the_ID(); ?>" data-product_sku="<?= esc_attr($product->get_sku()) ?>" aria-label="Add “<?= the_title_attribute() ?>” to your cart" data-barba-prevent="self"><span>PURCHASE</span></a>
        </div>
        <div class="global_filters roomtype flex dark">
            <div class="room_type">
                <span class="active" data-type="residental">residental</span>
                <span data-type="commercial">commercial</span>
            </div>
            <div class="buttons_holder active" data-type="residental">
                <a class="btn dark_outlined" data-background="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/residential_homeoffice_1.png" data-foreground="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/residential_homeoffice_2.png" data-text="Home Office">Home Office</a>
                <a class="btn dark_outlined" data-background="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/residential_dining_1.png" data-foreground="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/residential_dining_2.png" data-text="Dining">Dining</a>
                <a class="btn dark_outlined" data-background="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/residential_bedroom_1.png" data-foreground="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/residential_bedroom_2.png" data-text="Bedroom">Bedroom</a>
                <a class="btn dark_outlined" data-background="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/residential_livingroom_1.png" data-foreground="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/residential_livingroom_2.png" data-text="Living Room">Living Room</a>
            </div>
            <div class="buttons_holder" data-type="commercial">
                <a class="btn dark_outlined" data-background="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/commercial_boardoffice_1.png" data-foreground="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/commercial_boardoffice_2.png" data-text="Board Office">Board Office</a>
                <a class="btn dark_outlined" data-background="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/commercial_doctors_1.png" data-foreground="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/commercial_doctors_2.png" data-text="Doctors Office">Doctors Office</a>
                <a class="btn dark_outlined" data-background="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/lawoffice_1.png" data-foreground="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/lawoffice_2.png" data-text="Law Office">Law Office</a>
                <a class="btn dark_outlined" data-background="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/commercial_restaurant_1.png" data-foreground="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/commercial_restaurant_2.png" data-text="Restaurant">Restaurant</a>
                <a class="btn dark_outlined" data-background="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/commercial_waitingroomlobby_1.png" data-foreground="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/commercial_waitingroomlobby_2.png" data-text="Lobby">Lobby</a>
            </div>
        </div>

        <div class="hero_wrap">
            <div class="image_holder">
                <img src="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/residential_homeoffice_1.png" class="room background">
                <img src="<?php echo get_template_directory_uri(); ?>/images/single_product/rooms/residential_homeoffice_2.png" class="room foreground">
                <div class="product_image">
                    <?php
                    $image_size_class = ( $staged_size_terms ) ? $staged_size_terms[0]->slug : "";
                    $image_orientation_class = ( $orientation_terms ) ? $orientation_terms[0]->slug : "";
                    echo get_the_post_thumbnail(get_the_ID(), 'full',array('class'=>$image_size_class.' '.$image_orientation_class)); ?>
                </div>
            </div>

        </div>

        <div class="product_info">
            <div class="headline_holder">
                <h1 class="letter_wrap"><?php the_title() ?></h1>

                <?php if( $product->get_price() ): ?>
                    <div class="price_holder">
                        <div class="shape_holder">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/single_product/square_shape.svg">
                        </div>
                        <span class="price"><?= wc_price($product->get_price()) ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="about_product_info_content">
                <div class="left">
                    <?php if( $product_desc ): ?>
                        <p><?= $product_desc; ?></p>
                    <?php endif;

                    if( $product_tags ): ?>
                        <span>
                            <?php foreach ( $product_tags as $index => $tag ):
                                echo $tag->name;
                                if( ( $index + 1 ) != sizeof($product_tags) ) {
                                    echo ', ';
                                }
                            endforeach; ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="right">
                    <?php if( $medium_terms || $style_terms || $subject_terms || $collection_terms ): ?>
                        <div class="info_list">
                            <?php if( $medium_terms ): ?>
                                <div class="single_item">
                                    <div class="left">MEDIUM</div>
                                    <div class="right">
                                        <?php foreach ( $medium_terms as $index => $term ): ?>
                                            <a href="<?= $shop_page_url ?>?medium=<?= $term->slug ?>"><?php echo $term->name; ?></a><?php if( sizeof($medium_terms) - 1 != $index ){ echo ', ';} ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if( $style_terms ): ?>
                                <div class="single_item">
                                    <div class="left">STYLE</div>
                                    <div class="right">
                                        <?php foreach ( $style_terms as $index => $term ): ?>
                                            <a href="<?= $shop_page_url ?>?style=<?= $term->slug ?>"><?php echo $term->name; ?></a><?php if( sizeof($style_terms) - 1 != $index ){ echo ', ';} ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if( $subject_terms ): ?>
                                <div class="single_item">
                                    <div class="left">SUBJECT</div>
                                    <div class="right">
                                        <?php foreach ( $subject_terms as $index => $term ): ?>
                                            <a href="<?= $shop_page_url ?>?subject=<?= $term->slug ?>"><?php echo $term->name; ?></a><?php if( sizeof($subject_terms) - 1 != $index ){ echo ', ';} ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if( $collection_terms ): ?>
                                <div class="single_item">
                                    <div class="left">COLLECTION</div>
                                    <div class="right">
                                        <?php foreach ( $collection_terms as $index => $term ): ?>
                                            <a href="<?= $shop_page_url ?>?collection=<?= $term->slug ?>"><?php echo $term->name; ?></a><?php if( sizeof($collection_terms) - 1 != $index ){ echo ', ';} ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if( $size_terms ): ?>
                                <div class="single_item">
                                    <div class="left">SIZE</div>
                                    <div class="right">
                                        <?php foreach ( $size_terms as $index => $term ): ?>
                                            <a href="<?= $shop_page_url ?>?size=<?= $term->slug ?>"><?php echo $term->name; ?></a><?php if( sizeof($size_terms) - 1 != $index ){ echo ', ';} ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if( $orientation_terms ): ?>
                                <div class="single_item">
                                    <div class="left">ORIENTATION</div>
                                    <div class="right">
                                        <?php foreach ( $orientation_terms as $index => $term ): ?>
                                            <a href="<?= $shop_page_url ?>?orientation=<?= $term->slug ?>"><?php echo $term->name; ?></a><?php if( sizeof($orientation_terms) - 1 != $index ){ echo ', ';} ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="artist_info_holder">
            <div class="left">
                <div class="single_artist_wrap">
                    <div class="single_artist">
                        <!-- <img src="<?php echo get_template_directory_uri(); ?>/images/single_product/artist_shape.svg" class="artist_shape"> -->
                        <span class="sub_headline fadein_wrap">artwork by</span>
                        <h3 class="letter_wrap"><?= $author->display_name ?></h3>
                        <div class="artist_image_wrap">
                            <div class="artist_image">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/single_product/artist_shape.svg" class="rotate_circle">
                                
                                <?php if($author_profile_image): ?>
                                    <?= wp_get_attachment_image($author_profile_image['ID'],'large','',array('class'=>'artist')) ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/artist_no_image.svg" class="cover_image">
                                <?php endif; ?>
                                    
                            </div>
                        </div>
                        <?php
                        $author_base = ( get_option('_ba_eas_author_base') ) ? get_option('_ba_eas_author_base') : 'author';
                        $author_slug = ( isset($author->user_nicename) ) ? $author->user_nicename : $author->nickname;
                        ?>
                        <div class="artist_info">
                            <p><?= $author_desc ?></p>
                            <a href="<?= site_url().'/'.$author_base.'/'.$author_slug ?>" class="btn" data-text="View Artist">View Artist</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="right_content">
                    <?php if( $author_products->have_posts() ): ?>
                        <span class="sub_headline fadein_wrap">LOVE THIS ARTIST?</span>
                        <h3 class="letter_wrap">View More Art</h3>

                        <div class="simmilar_art">
                            <?php while( $author_products->have_posts() ): $author_products->the_post() ?>
                                <div class="single_art">
                                    <?php the_post_thumbnail('large') ?>
                                </div>
                            <?php endwhile; wp_reset_postdata();?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="swiper_indicator_mobile">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/single_product/drag.svg">
                </div>
            </div>
        </div>
        <?php
        $args = array(
            'posts_per_page' => 3,
        );
        $args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
        $args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

        if( $args['related_products'] ):
            function similar_artwork($related){
                $related_data = $related->get_data();
                $related_featured_image = get_the_post_thumbnail($related->id,'large');
            ?>
                <a href="<?= get_the_permalink($related->id) ?>" class="single_work">
                    <div class="price">
                        <?= wc_price($related->get_price()) ?>
                    </div>
                    <div class="single_work_image">
                        <?= $related_featured_image ?>
                    </div>
                    <div class="art_name"><?= $related_data['name'] ?></div>
                </a>
            <?php } ?>
            <div class="similar_artwork">
                <h2 class="letter_wrap">Similar Artworks</h2>

                <div class="artist_work_wrap">
                    <?php foreach ( $args['related_products'] as $related ):
                        similar_artwork($related);
                    endforeach; ?>
                </div>

                <div class="artist_work_wrap_slider mobile">
                    <?php foreach ( $args['related_products'] as $related ):
                        similar_artwork($related);
                    endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="shipping_section">
            <?php if($orders_shipping_and_returns_headline): ?>
                <h2 class="letter_wrap"><?php echo $orders_shipping_and_returns_headline; ?></h2>
            <?php endif; ?>

            <div class="second_section_content">
                <div class="left">
                    <div class="container">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/single_product/big_shape.svg" class="shape_image">
                        <!-- <svg class="shape" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1163.858" height="1053.07" viewBox="0 0 1163.858 1053.07"><defs><style>.a{fill:#eb7042;}.b{fill:none;stroke:#4b58aa;stroke-width:2px;}.c{clip-path:url(#a);}</style><clipPath id="a"><rect class="a" width="580.929" height="920" rx="290.465" transform="translate(580.929 131.07)"/></clipPath></defs><g transform="translate(1 1)"><line class="b" y2="1050.867" transform="translate(580.929 0.203)"/><rect class="b" width="580.929" height="920" rx="290.465" transform="translate(580.929 131.07)"/><rect class="b" width="580.929" height="920" rx="290.465"/></g></svg> -->
                        <?php if( $orders_list ): ?>
                            <div class="image_holder_wrap">
                                    <?php $counter = 1; ?>
                                    <?php foreach( $orders_list as $singleItem ): ?>
                                        <div class="image_holder <?php if($counter == 1): ?>one<?php elseif($counter == 2): ?>two<?php elseif($counter == 3): ?>three<?php endif; ?>">
                                            <img src="<?php echo $singleItem['list_image']['url']; ?>" class="bg <?php if($counter == 1): ?>one<?php elseif($counter == 2): ?>two<?php elseif($counter == 3): ?>three<?php endif; ?>">
                                        </div>
                                    <?php $counter++; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="banner_holder">
                        <div class="banner second">
                            <div class="second_banner_content vmarquee">
                                <?php if($orders_banner_text): ?>
                                    <p><?php echo $orders_banner_text; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="banner_holder">
                        <div class="banner second">
                            <div class="second_banner_content vmarquee">
                                <?php if($orders_banner_text): ?>
                                    <p><?php echo $orders_banner_text; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="right_content">
                        <?php if($orders_list): ?>
                            <?php foreach( $orders_list as $singleItem ): ?>
                                <div class="single_box">
                                    <div class="box_content fadein_wrap">
                                        <div class="headline_holder">
                                            <h3 class="letter_wrap fadein_wrap"><?php echo $singleItem['list_headline']; ?></h3>
                                        </div>
                                        <p><?php echo $singleItem['list_description']; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if($product_cta_section_headline || $product_cta_section_small_headline): ?>
            <div class="call_to_action_box">
                <div class="call_to_action_box_content">
                    <div class="cta_info">
                        <?php if($product_cta_section_small_headline): ?>
                            <p><?php echo $product_cta_section_small_headline; ?></p>
                        <?php endif; ?>
                        <?php if($product_cta_section_headline): ?>
                            <h2 class="big_headline letter_wrap"><?php echo $product_cta_section_headline; ?></h2>
                        <?php endif; ?>
                        <?php if($product_cta_section_link): ?>
                            <a href="<?php echo $product_cta_section_link['url'] ?>" target="<?php echo $product_cta_section_link['target'] ?>" class="btn dark" data-text="<?php echo $product_cta_section_link['title'] ?>"><?php echo $product_cta_section_link['title'] ?></a>
                        <?php endif; ?>
                    </div>

                    <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_left.svg" alt="" class="left_shape">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_right.svg" alt="" class="right_shape">
                    
                    <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_top_mobile.svg" alt="" class="top_shape">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_bottom_mobile.svg" alt="" class="bottom_shape">
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php
get_footer();