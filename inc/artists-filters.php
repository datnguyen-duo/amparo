<?php

$artists_per_page = 6;
function artists_filter() {
    $current_page = (int)$_GET['page'];
    $medium = $_GET['medium'];
    $style = $_GET['style'];
    $region = $_GET['region'];

    $artists_args =  array(
        'role' => 'wcfm_vendor',
        'number' => $GLOBALS['artists_per_page'],
        'paged' => $current_page,
        'meta_query' => array(
            'relation' => 'OR',
        ),
    );

    if( $medium ) {
        foreach ( $medium as $term ) {
            array_push($artists_args['meta_query'],array(
                'key' => 'medium',
                'value' => $term,
                'compare' => 'LIKE',
            ));
        }
    }

    if( $style ) {
        foreach ( $style as $term ) {
            array_push($artists_args['meta_query'],array(
                'key' => 'style',
                'value' => $term,
                'compare' => 'LIKE',
            ));
        }
    }

    if( $region ) {
        foreach ( $region as $term ) {
            array_push($artists_args['meta_query'],array(
                'key' => 'region',
                'value' => $term,
                'compare' => 'LIKE',
            ));
        }
    }

    $artists = new WP_User_Query($artists_args);

    print_artists($artists);

    die;
}
add_action('wp_ajax_artists_filter', 'artists_filter'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_artists_filter', 'artists_filter');

function print_artists( $user_query = '' ) {
    $author_base = ( get_option('_ba_eas_author_base') ) ? get_option('_ba_eas_author_base') : 'author';

    if( !$user_query ) {
        $user_query = new WP_User_Query( array(
            'role' => 'wcfm_vendor',
            'number' => $GLOBALS['artists_per_page'],
        ));
    }
    $posts_per_page = $GLOBALS['artists_per_page'];
    $found_posts = $user_query->get_total();
    $current_page = $user_query->get('paged');
    $total_pages = ceil($found_posts / $posts_per_page);
    if( $user_query->get_results() ):?>
        <div class="artists_list">
            <?php
            foreach ( $user_query->get_results() as $author ): $image = get_field('profile_image',$author);
                $user_medium = get_field('medium', $author);
                $user_style = get_field('style', $author);
                $user_categories = [];
                $author_slug = ( isset($author->user_nicename) ) ? $author->user_nicename : $author->nickname;

                if( !$user_medium[0]->errors && $user_medium ) {
                    $user_categories = $user_medium;
                }

                if( !$user_style[0]->errors && $user_style ) {
                    foreach ( $user_style as $term ) {
                        array_push($user_categories, $term);
                    }
                }
                ?>
                <a href="<?= site_url().'/'.$author_base.'/'.$author_slug ?>" class="single_artist" data-image="<?= $image['url'] ?>">
                    <div class="artist_image_mobile_wrap">
                        <?php if( $image ): ?>
                            <div class="artist_image_mobile">
                                <?= wp_get_attachment_image($image['ID'],'large') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="artist_info_holder">
                        <h2><?= $author->display_name ?></h2>

                        <?php if( $user_categories ): ?>
                            <div class="artist_info">

                                <?php foreach ( $user_categories as $index => $term ): ?>
                                    <p><?php echo $term->name; ?></p>
                                    <?php if( sizeof($user_categories) - 1 != $index ): ?>
                                        <span>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/image_pag_filled.svg" alt="">
                                        </span>
                                    <?php endif;
                                endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach ?>
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
    <?php else: ?>
        <div class="no_results">
            <h2>No Artists Found.</h2>
        </div>
    <?php endif; ?>
<?php }