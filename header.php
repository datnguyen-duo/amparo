<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package amparo
 */

$checkoutPage = (is_checkout() && empty(is_wc_endpoint_url('order-received')));

$instagram = get_field('instagram', 'option');
$facebook = get_field('facebook', 'option');
$twitter = get_field('twitter', 'option');

$navigation_button = get_field('navigation_button', 'option');
$header_banner_text = get_field('header_banner_text', 'option');

$template_path = get_post_meta(get_the_ID(), '_wp_page_template', true);
$templates = wp_get_theme()->get_page_templates();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <link rel="stylesheet" href="https://use.typekit.net/niy0gru.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollToPlugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/Draggable.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">


    <?php wp_head(); ?>
</head>

<body <?php body_class();?> data-barba="wrapper">

<?php wp_body_open(); ?>
<div id="page" data-barba="container" data-barba-namespace="page">

    <?php if(is_page_template('templates/tmplt-home.php')): ?>
        <div class="loader">
            <img src="<?php echo get_template_directory_uri(); ?>/images/loader_new.gif" class="loader_gif">
            <p>Your Source For Fine Art</p>
        </div>

        <div class="popup_container">
            <div class="popup_content">
                <img src="<?php echo get_template_directory_uri(); ?>/images/close_popup.svg" class="close_popup">
                <div class="image_holder">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/popup.png" class="popup_image">
                </div>
                <div class="content">
                    <h2>Request a Consultation</h2>
                    <!-- <p>
                        FIND THE PERFECT FIT FOR YOUR NEEDS WITH OUR FILTERED QUIZ!
                    </p> -->

                    <div class="buttons_holder">
                        <a href="https://calendly.com/hello-amparoart" class="single_button" target="_blank"><span>Calendly</span></a>
                        <!-- <a class="single_button take_quiz"><span>Take Quizz</span></a> -->
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="swiper_indicator_desktop">
        <img src="<?php echo get_template_directory_uri(); ?>/images/single_product/drag.svg">
    </div>

    <?php if(is_page_template('templates/tmplt-home.php')): ?>
        <div class="loader_overlay"></div>
    <?php endif; ?>

    <header class="regular <?php if(is_product() || $checkoutPage || is_wc_endpoint_url('order-received')): ?>dark<?php endif; ?>">
        <a href="/" class="logo_holder">
            <?php if(is_product() || $checkoutPage || is_wc_endpoint_url('order-received')): ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/white_logo.svg">
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/dark_logo.svg" class="dark">
            <?php endif; ?>
        </a>
        <!-- add filters if Home page -->
        <?php if(is_page_template('templates/tmplt-home.php')): ?>
            <div class="home_header_button">
                <a href="/shop">SHOP ALL ART</a>
            </div>
        <?php endif; ?>
        <!-- comment end -->
        <!-- add filters if Partners page -->
        <?php if(is_page_template('templates/tmplt-partner.php') || is_page_template('templates/tmplt-collector.php') || is_page_template('templates/tmplt-artist.php') || is_page_template('templates/tmplt-business.php')): ?>
            <nav class="partners_nav">
                <p>I am a/an:</p>
                <ul>
                    <li>
                        <a href="/collector" data-text="Private collector">Private collector</a>
                    </li>
                    <li>
                        <a href="/artist" data-text="Artist">Artist</a>
                    </li>
                    <li>
                        <a href="/business" data-text="Business">Business</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- comment end -->

        <!-- add filters if Single Product page -->
        <?php if(is_product()): ?>
            <nav class="filter_nav product_filters">
                <ul>
                    <li class="white">
                        <a class="white" data-text="Room Type">Room Type
                            <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#ededed" stroke-width="1.5"/>
                            </svg>
                        </a>
                    </li>
                    <li class="white">
                        <a class="white" data-text="Room Color">
                            Room Color
                            <input id="single-product-color-picker" value='#276cb8' />
                        </a>
                    </li>
                    <li class="white surprise_button">
                        <a class="white" data-text="Surprise me">Surprise me
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- comment end -->

        <!-- add filters if Single Product page -->
        <?php if($checkoutPage): ?>
            <nav class="filter_nav checkout_nav product_filters">
                <ul>
                    <li class="white active" data-step="1">
                        <a class="white" data-text="DETAILS">DETAILS</a>
                    </li>
                    <li class="white shipping" data-step="2">
                        <a class="white" data-text="SHIPPING">SHIPPING</a>
                    </li>
                    <li class="white payment" data-step="3">
                        <a class="white" data-text="PAYMENT">PAYMENT</a>
                    </li>
                    <li class="white confirmation">
                        <a class="white" data-text="CONFIRMATION">CONFIRMATION</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- comment end -->

        <!-- add filters if Artists list page -->
        <?php if(is_page_template('templates/tmplt-artists.php')): ?>
            <nav class="filter_nav artist_filters">
                <ul>
                    <li>
                        <a data-text="Region">Region
                            <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a data-text="Style">Style
                            <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a data-text="Medium">Medium
                            <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- comment end -->

        <!-- add filters if Artists list page -->
        <?php if( is_shop() ):
            $medium_terms = get_terms(array('taxonomy'=>'product-medium'));
            $style_terms = get_terms(array('taxonomy'=>'product-style'));
            $subject_terms = get_terms(array('taxonomy'=>'product-subject'));
            $collection_terms = get_terms(array('taxonomy'=>'product-collection'));
            $orientation_terms = get_terms(array('taxonomy'=>'product-orientation'));
            $size_terms = get_terms(array('taxonomy'=>'product-size'));
            ?>
            <nav class="filter_nav shop_filters">
                <ul>
                    <?php if( $medium_terms ): ?>
                        <li>
                            <a data-text="Medium">
                                Medium
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                    <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if( $style_terms ): ?>
                        <li>
                            <a data-text="Style">Style
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                    <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if( $subject_terms ): ?>
                        <li>
                            <a data-text="Subject">Subject
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                    <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a data-text="Price">Price
                            <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                            </svg>
                        </a>
                    </li>

                    <?php if( $collection_terms ): ?>
                        <li>
                            <a data-text="Collection">Collection
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                    <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if( $size_terms ): ?>
                        <li>
                            <a data-text="Size">Size
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                    <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if( $orientation_terms ): ?>
                        <li>
                            <a data-text="Orientation">Orientation
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.692" height="7.907" viewBox="0 0 13.692 7.907">
                                    <path id="Path_47227" data-name="Path 47227" d="M8786.292,116.587l6.315,6.316,6.316-6.316" transform="translate(-8785.762 -116.056)" fill="none" stroke="#4b58aa" stroke-width="1.5"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- comment end -->

        <div class="buttons_holder <?php if(is_product()): ?>white<?php endif; ?>">
            <a class="btn header_button cart_opener" data-text="CART">CART</a>
            <a class="btn header_button menu_opener" data-text="MENU">MENU</a>
            <a class="btn header_button close_about_popup" data-text="BACK">BACK</a>
        </div>
    </header>

    <div class="quiz_popup">
        <div class="quiz_popup_content" id="quiz_popup_content">
            <div class="quiz_header">
                <div class="logo_holder">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/dark_logo.svg" class="dark">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/white_logo.svg" class="white">
                </div>
                <div class="quiz_header_buttons">
                    <a href="/contact" class="btn quiz_header_button" data-text="Contact us">Contact us</a>
                    <a class="btn quiz_header_button close_quiz" data-text="Close">Close</a>
                </div>

            </div>
            <div class="quiz_content_wrap">
                <div class="quiz_content">
                    <div class="results_holder">
                        <div class="results_marquee">
                            <div class="results_marquee_content">
                                <p>Your Results Your Results </p>
                            </div>
                        </div>

                        <div class="result_image">
                            <div class="single_image">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/hero__artists.png" class="white">
                            </div>
                        </div>

                        <div class="result_artwork">
                            <p>
                                Artwork Name
                            </p>
                            <p>
                                By Artist
                            </p>
                        </div>

                        <p class="results">
                            Artwork details: <br> Medium, style, price
                        </p>

                        <a class="calendly results_single_button"> <span>Calendly</span></a>


                    </div>

                    <div class="image_stack">
                        <div class="single_image_wrap active" data-color="#50C5EB">
                            <div class="single_image">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/art.png" class="white">
                            </div>
                        </div>
                        <div class="single_image_wrap" data-color="#EB7042">
                            <div class="single_image">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/hero__private-collector.png" class="white">
                            </div>
                        </div>
                        <div class="single_image_wrap" data-color="#5AAC7A">
                            <div class="single_image">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/hero__artists.png" class="white">
                            </div>
                        </div>
                        <div class="single_image_wrap" data-color="#E0D927">
                            <div class="single_image">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/hero__business.png" class="white">
                            </div>
                        </div>
                        <div class="single_image_wrap" data-color="#50C5EB">
                            <div class="single_image">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/art.png" class="white">
                            </div>
                        </div>
                        <div class="single_image_wrap" data-color="#EB7042">
                            <div class="single_image">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/hero__private-collector.png" class="white">
                            </div>
                        </div>
                        <div class="single_image_wrap" data-color="#5AAC7A">
                            <div class="single_image">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/hero__artists.png" class="white">
                            </div>
                        </div>
                        <div class="single_image_wrap" data-color="#50C5EB">
                            <div class="single_image">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/hero__business.png" class="white">
                            </div>
                        </div>
                    </div>
                    <div class="quizz_answers">
                        <div class="pagination_holder mobile">
                            <p class="pagination_description">
                                Do you like this piece?
                            </p>
                            <div class="images_pagination">
                                <div class="single_pagination">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/image_pag_empty.svg" class="empty">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/image_pag_filled.svg" class="filled">
                                </div>
                            </div>
                        </div>
                        <div class="left">
                            <div class="left_description">

                                <div class="pagination_holder desktop">

                                    <p class="pagination_description">
                                        Do you like this piece?
                                    </p>
                                    <div class="images_pagination">
                                        <div class="single_pagination">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/image_pag_empty.svg" class="empty">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/image_pag_filled.svg" class="filled">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pass answer">Pass</div>
                        </div>

                        <div class="right">
                            <div class="left_description">
                                <p>
                                    Artwork Name
                                </p>
                                <p>
                                    By Artist
                                </p>
                            </div>

                            <div class="love answer">Love It</div>

                            <a class="calendly single_button"> <span>Calendly</span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quiz_footer">
                <div class="social_holder">
                    <p>SHARE THIS QUIZ</p>
                    <div class="social_wrap">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://amparo-art.myshopify.com/?quizz=true&t=Amparo Quiz"
                           onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                           target="_blank"
                           title="Share on Facebook"
                           class="facebook">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/facebook.svg">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/facebook_hover.svg" class="hover">
                        </a>
                        <a href="https://twitter.com/share?url=https://amparo-art.myshopify.com/?quizz=true&text=Amparo Quiz" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                           target="_blank"
                           title="Share on Twitter"
                           class="twitter">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.svg">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/linkedin_hover.svg" class="hover">
                        </a>
                        <a href="">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/instagram.svg">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/instagram_hover.svg" class="hover">
                        </a>
                    </div>
                </div>
                <div class="input_holder">
                    <p>
                        Subscribe Headline Here
                    </p>
                    <?php echo do_shortcode('[contact-form-7 id="72" title="Subscribe Form"]')?>
                </div>
                <div class="quiz_contact">
                    Questions? <a href="/contact">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

    <div class="website_navigation">
        <div class="nav_content">
            <div class="left">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-3',
                        'menu_id'        => 'header1',
                        'container' => false,
                    )
                );
                ?>

            </div>
            <div class="right">
                <div class="banner second">
                    <div class="second_banner_content header_marquee">
                        <?php if($header_banner_text): ?>
                            <p><?php echo $header_banner_text; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="right_content_wrap">
                    <div class="right_content">
                        <div class="single_block">
                            <span>SUPPORT</span>
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-4',
                                    'menu_id'        => 'header2',
                                    'container' => false,
                                )
                            );
                            ?>
                        </div>
                        <div class="single_block">
                            <span>FOLLOW US</span>
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
                        <div class="single_block">
                            <span>SUBSCRIBE</span>
                            <div class="input_holder"><?php echo do_shortcode('[contact-form-7 id="<?php echo $contact_form_id; ?>" title="Subscribe Form"]')?></div>
                        </div>
                    </div>
                    <?php if($navigation_button): ?>
                        <a href="<?php echo $navigation_button['url']; ?>" target="<?php echo $navigation_button['target']; ?>" class="single_button"><span><?php echo $navigation_button['title']; ?></span></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (!$checkoutPage):
        render_shopping_cart();
    endif;
    ?>
