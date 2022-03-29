<?php

if ( ! function_exists( 'amparo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function amparo_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );


        add_theme_support( 'woocommerce' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Footer 1', 'footer1' ),
				'menu-2' => esc_html__( 'Footer 2', 'footer2' ),
				'menu-3' => esc_html__( 'Header 1', 'header1' ),
				'menu-4' => esc_html__( 'Header 2', 'header2' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'amparo_setup' );

/**
 * Enqueue scripts and styles.
 */
function amparo_scripts() {
	wp_enqueue_style( 'amparo-style', get_stylesheet_uri(), array(), '1.0' );
	wp_style_add_data( 'amparo-style', 'rtl', 'replace' );

	wp_enqueue_script('barba','https://unpkg.com/@barba/core', array(), true);
	wp_enqueue_script('imagesloaded','https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array(), true);
	wp_enqueue_script('colorPicker','https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js', array(), true);
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, true);
	wp_enqueue_script('slick-js','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array(), true);
	wp_enqueue_script('gsap', get_template_directory_uri() . '/js/gsap-libs/gsap.min.js', true);
	wp_enqueue_script('inertia', get_template_directory_uri() . '/js/InertiaPlugin.min.js', true);
	wp_enqueue_script('draggable', get_template_directory_uri() . '/js/gsap-libs/Draggable.min.js', true);
	wp_enqueue_script('split-text', get_template_directory_uri() . '/js/gsap-libs/SplitText.min.js', true);
	wp_enqueue_script('scrolltrigger', get_template_directory_uri() . '/js/gsap-libs/ScrollTrigger.min.js', true);
	wp_enqueue_script('scrollto', get_template_directory_uri() . '/js/gsap-libs/ScrollToPlugin.min.js', true);
	wp_enqueue_script('morphsvg', get_template_directory_uri() . '/js/gsap-libs/MorphSVGPlugin.min.js', true);
	wp_enqueue_script('global', get_theme_file_uri('/js/global.js'), NULL, '1.0', true);
    if( is_checkout() ) {
        wp_enqueue_script('woocommerce-checkout', get_theme_file_uri('/js/woocommerce-checkout.js'), NULL, '1.0', true);
    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'amparo_scripts' );

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Global Settings',
        'menu_title'    => 'Global Settings',
        'menu_slug'     => 'global-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

require_once("inc/woocommerce-custom-cart.php");
require_once("inc/taxonomies.php");
require_once("inc/shop-filters.php");
require_once("inc/artists-filters.php");

add_filter('woocommerce_ship_to_different_address_checked', '__return_true', 999);