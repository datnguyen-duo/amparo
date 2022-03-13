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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Readmore.js/2.0.2/readmore.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class();?> data-barba="wrapper">
<?php wp_body_open(); ?>
<div id="page" class="site">
<header>
    <div class="logo_holder">
        <img src="<?php echo get_template_directory_uri(); ?>/images/dark_logo.svg" class="dark">
    </div>

    <nav>
      <p>I am a/an:</p>
      <ul>
        <li>
          <a href="/collector/" data-text="Private collector">Private collector</a>
        </li>
        <li>
          <a href="/artist/" data-text="Artist">Artist</a>
        </li>
        <li>
          <a href="/business/" data-text="Business">Business</a>
        </li>
      </ul>
    </nav>

    <a class="button header_button" data-text="Contact us" href="#contact">Contact us</a>
  </header>
