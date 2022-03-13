<?php
/* Template Name: Contact */
$hero_headline = get_field('hero_headline');
$link_list_left_headline = get_field('link_list_left_headline');
$link_list_left = get_field('link_list_left');
$link_list_right_headline = get_field('link_list_right_headline');
$link_list_right = get_field('link_list_right');

$subscribe_section_headline = get_field('subscribe_section_headline');
$subscribe_section_form_id = get_field('subscribe_section_form_id');

$contact_form_headline = get_field('contact_form_headline');
$contact_form_description = get_field('contact_form_description');
$contact_form_banner_text = get_field('contact_form_banner_text');
$contact_form_banner_id = get_field('contact_form_banner_id');

$instagram = get_field('instagram', 'option');
$facebook = get_field('facebook', 'option');
$twitter = get_field('twitter', 'option');
get_header(); ?>

<div class="contact_wrap">
    <div class="contact_header">
        <img src="<?php echo get_template_directory_uri(); ?>/images/contact/contact_header.svg" alt="" class="desktop">
        <img src="<?php echo get_template_directory_uri(); ?>/images/contact/hero_shape_mobile.svg" alt="" class="mobile">
        <?php if($hero_headline): ?>
            <h1 class="letter_wrap"><?php echo $hero_headline; ?></h1>
        <?php endif; ?>
        
        <?php if($link_list_left): ?>
            <div class="contact_cta left">
                <?php if($link_list_left_headline): ?>
                    <span><?php echo $link_list_left_headline; ?></span>
                <?php endif; ?>
                <?php if($link_list_left): ?>
                    <ul>
                        <?php foreach( $link_list_left as $singleLink ): ?>
                            <li>
                                <a href="<?php echo $singleLink['single_link']['url']; ?>" target="<?php echo $singleLink['single_link']['target']; ?>">
                                    <?php echo $singleLink['single_link']['title']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if($link_list_right): ?>
            <div class="contact_cta right">
                <?php if($link_list_right_headline): ?>
                    <span><?php echo $link_list_right_headline; ?></span>
                <?php endif; ?>
                <div class="social_wrap">
                    <?php if($facebook): ?>
                        <a href="<?php echo $facebook; ?>" data-text="fb" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/facebook.svg">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/facebook_hover.svg" class="hover">
                        </a>
                    <?php endif; ?>

                    <?php if($twitter): ?>
                        <a href="<?php echo $twitter; ?>" data-text="tw" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.svg">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/linkedin_hover.svg" class="hover">
                        </a>
                    <?php endif; ?>

                    <?php if($instagram): ?>
                        <a href="<?php echo $instagram; ?>" data-text="ig" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/instagram.svg">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/instagram_hover.svg" class="hover">
                        </a>
                    <?php endif; ?>
                </div>
                
            </div>
        <?php endif; ?>
    </div>

    <div class="contact_subscribtion">
        <?php if($subscribe_section_headline): ?>
            <span><?php echo $subscribe_section_headline; ?></span>
        <?php endif; ?>
        <?php if($subscribe_section_form_id): ?>
            <?php echo do_shortcode('[contact-form-7 id="<?php echo $subscribe_section_form_id; ?>" title="Subscribe Form 2"]')?>
        <?php endif; ?>
    </div>

    <div class="contact_section" id="contact">
        <div class="contact_section_content">
            <div class="left">
                <div class="left_content">
                    <?php if($contact_form_headline): ?>
                        <h2 class="letter_wrap "><?php echo $contact_form_headline; ?></h2>
                    <?php endif; ?>

                    <div class="sign">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/dark_square.svg">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/arrow_right.svg">
                    </div>
                    <?php if($contact_form_description): ?>
                        <p><?php echo $contact_form_description; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="right">
                <div class="banner second">
                    <div class="second_banner_content vmarquee">
                        <?php if($contact_form_banner_text): ?>
                            <p><?php echo $contact_form_banner_text; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="right_content">
                    <?php if($contact_form_banner_id): ?>
                        <div class="form_holder">
                            
                            <?php echo do_shortcode('[contact-form-7 id="<?php echo $contact_form_banner_id; ?>" title="Contact Form"]')?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer(); ?>