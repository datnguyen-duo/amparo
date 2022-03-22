<?php
get_header();
$artist_cta_section_link = get_field('artist_cta_section_link', 'option');
$artist_cta_section_small_headline = get_field('artist_cta_section_small_headline', 'option');
$artist_cta_section_headline = get_field('artist_cta_section_headline', 'option');

$author = get_queried_object();
$author_id = $author->ID;
$author_title = $author->display_name;
$author_desc = get_the_author_meta('description',$author_id);
$author_products = new WP_Query(array(
    'post_type' => 'product',
    'author__in' => array($author_id),
));
$author_profile_image = get_field('profile_image',get_queried_object());
$user_region = get_field('region',$author);
$user_medium = get_field('medium', $author);
$user_style = get_field('style', $author);
$user_collection = get_field('collection', $author);

$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
?>
    <div class="single_artist_wrap">
        <div class="single_artist_header">
            <div class="left">
                <div class="artist_info">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/single_artist/shape.svg" alt="">
                    <span class="sub_headline">AMPARO ARTISTS</span>
                    <h1 class="letter_wrap"><?= $author_title ?></h1>
                </div>

                <div class="banner first desktop">
                    <div class="banner_content marquee">
                        <p>ABOUT THE ARTIST</p>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="artist_image_wrap">
                    <div class="artist_image">
                        <?php if( $author_profile_image ): ?>
                            <?= wp_get_attachment_image($author_profile_image['ID'],'full') ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if( $author_desc || $user_region || $user_style || $user_medium || $user_collection ): ?>
            <div class="about_artist_info">
                <div class="about_artist_info_content">
                    <div class="left">
                        <?php if( $author_desc ): ?>
                            <span>ABOUT THE ARTIST</span>
                            <p><?= $author_desc ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="right">
                        <?php if( $user_region || $user_style || $user_medium || $user_collection ): ?>
                            <div class="info_list">
                                <?php if( $user_region ): ?>
                                    <div class="single_item">
                                        <div class="left">REGION</div>
                                        <div class="right">
                                            <?php foreach ( $user_region as $index => $term ):
                                                echo $term->name;
                                                if( sizeof($user_region) - 1 != $index ){ echo ', ';}
                                            endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if( $user_style ): ?>
                                    <div class="single_item">
                                        <div class="left">STYLE</div>
                                        <div class="right">
                                            <?php foreach ( $user_style as $index => $term ): ?>
                                                <a href="<?= $shop_page_url.'?style='.$term->slug ?>"><?= $term->name; ?></a><?php if( sizeof($user_style) - 1 != $index ){ echo ', ';} ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if( $user_medium ): ?>
                                    <div class="single_item">
                                        <div class="left">MEDIUM</div>
                                        <div class="right">
                                            <?php foreach ( $user_medium as $index => $term ): ?>
                                                <a href="<?= $shop_page_url.'?medium='.$term->slug ?>"><?= $term->name; ?></a><?php if( sizeof($user_medium) - 1 != $index ){ echo ', ';} ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if( $user_collection ): ?>
                                    <div class="single_item">
                                        <div class="left">COLLECTION</div>
                                        <div class="right">
                                            <?php foreach ( $user_collection as $index => $term ): ?>
                                                <a><?= $term->name; ?></a><?php if( sizeof($user_collection) - 1 != $index ){ echo ', ';} ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if( $author_products->have_posts() ): ?>
            <div class="artist_work">
                <h2 class="letter_wrap">Artworks by <?= $author_title ?></h2>
                <div class="artist_work_wrap">
                    <?php while ( $author_products->have_posts() ): $author_products->the_post();
                        $product = wc_get_product( get_the_ID() );
                        $price = $product->get_price(); ?>
                        <a href="<?php the_permalink() ?>" class="single_work">
                            <div class="price"><?= wc_price($price)?></div>
                            <div class="single_work_image"><?= get_the_post_thumbnail(get_the_ID()) ?></div>
                            <div class="art_name"><?php the_title() ?></div>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if($artist_cta_section_headline || $artist_cta_section_small_headline): ?>
            <div class="call_to_action_box">
                <div class="call_to_action_box_content">
                    <div class="cta_info">
                        <?php if($artist_cta_section_small_headline): ?>
                            <p><?php echo $artist_cta_section_small_headline; ?></p>
                        <?php endif; ?>
                        <?php if($artist_cta_section_headline): ?>
                            <h2 class="letter_wrap"><?php echo $artist_cta_section_headline; ?></h2>
                        <?php endif; ?>
                        <?php if($artist_cta_section_link): ?>
                            <a href="<?php echo $artist_cta_section_link['url'] ?>" target="<?php echo $artist_cta_section_link['target'] ?>" class="btn dark" data-text="<?php echo $artist_cta_section_link['title'] ?>"><?php echo $artist_cta_section_link['title'] ?></a>
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
get_footer(); ?>