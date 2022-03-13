<?php
/* Template Name: Artists */
$medium_terms = get_terms(array('taxonomy'=>'product-medium', 'hide_empty'=>false));
$style_terms = get_terms(array('taxonomy'=>'product-style', 'hide_empty'=>false));
$region_terms = get_terms(array('taxonomy'=>'product-region','hide_empty'=>false));

$cta_section_headline = get_field('cta_section_headline');
$cta_section_small_headline = get_field('cta_section_small_headline');
$cta_section_link = get_field('cta_section_link');
get_header(); ?>

<div class="artists_wrap">


    <form id="artists_form">
        <input type="hidden" name="action" value="artists_filter">
        <input type="hidden" name="page" value="1" id="artists_page_num_input">

        <div class="mobile_artist_filter">
            <div class="mobile_artist_filter_header">
                <div class="left">
                    <div class="mobile_filters_holder">
                        <p>FILTER BY</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                            <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="filters_holder">
                <div class="main_filters_mobile">
                    <ul>
                        <?php if( $region_terms ): ?>
                            <li>
                                <a data-text="Region">
                                    Region
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                        <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                    </svg>
                                </a>

                                <div class="sub_filters_mobile region">
                                    <?php foreach ( $region_terms as $term ): ?>
                                        <label>
                                            <input type="checkbox" value="<?= $term->term_id ?>" name="region[]">
                                            <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </li>
                        <?php endif; ?>

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
                                            <input type="checkbox" value="<?= $term->term_id ?>" name="medium[]">
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
                                            <input type="checkbox" value="<?= $term->term_id ?>" name="style[]">
                                            <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="single_button_holder">
                    <a href="/contact" class="single_button"><span>Apply Filters</span></a>
                </div>
            </div>
        </div>

        <div class="desktop_artist_filter">
            <?php if( $region_terms ): ?>
                <div class="global_filters region">
                    <?php foreach ( $region_terms as $term ): ?>
                        <label>
                            <input type="checkbox" value="<?= $term->term_id ?>" name="region[]">
                            <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if( $medium_terms ): ?>
                <div class="global_filters medium">
                    <?php foreach ( $medium_terms as $term ): ?>
                        <label>
                            <input type="checkbox" value="<?= $term->term_id ?>" name="medium[]">
                            <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if( $style_terms ): ?>
                <div class="global_filters style">
                    <?php foreach ( $style_terms as $term ): ?>
                        <label>
                            <input type="checkbox" value="<?= $term->term_id ?>" name="style[]">
                            <span class="btn dark_outlined" data-text="<?= $term->name ?>"><?= $term->name ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>



        <div class="artists_list_wrap">
            <div class="left" id="artists_response">
                <?php print_artists() ?>
            </div>
            <div class="right">
                <div class="right_content">
                    <div class="artist_info">
                        <span class="sub_headline">AMPARO ARTISTS</span>
                        <h3 class="letter_wrap">Select an artist from<br>the list on the left</h3>

                        <!-- <div class="arrow_shape">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/artists/full_arrwo_shape.svg" alt="">
                        </div> -->
                        <div class="sign">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/dark_square.svg">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/arrow_right.svg" class="arrow_right">
                        </div>
                    </div>
                    <div class="artist_image_wrap">
                        <div class="artist_image">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/artists/artist.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="call_to_action_box">
        <div class="call_to_action_box_content">
            <div class="cta_info">
                <?php if($cta_section_small_headline): ?>
                    <p><?php echo $cta_section_small_headline; ?></p>
                <?php endif; ?>
                <?php if($cta_section_headline): ?>
                    <h2 class="letter_wrap"><?php echo $cta_section_headline; ?></h2>
                <?php endif; ?>
                <?php if($cta_section_link): ?>
                    <a href="<?php echo $cta_section_link['url'] ?>" target="<?php echo $cta_section_link['target'] ?>" class="btn dark" data-text="<?php echo $cta_section_link['title'] ?>"><?php echo $cta_section_link['title'] ?></a>
                <?php endif; ?>
            </div>

            <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_left.svg" alt="" class="left_shape">
            <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_right.svg" alt="" class="right_shape">
            
            <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_top_mobile.svg" alt="" class="top_shape">
            <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_bottom_mobile.svg" alt="" class="bottom_shape">
        </div>
    </div>
</div>

<?php
get_footer(); ?>