<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package amparo
 */
$instagram = get_field('instagram', 'option');
$facebook = get_field('facebook', 'option');
$twitter = get_field('twitter', 'option');
$subscribe_form_headline = get_field('subscribe_form_headline', 'option');
$contact_form_id = get_field('contact_form_id', 'option');
?>

<footer>
  <div class="footer_content_wrap">
    <div class="logo_holder">
		<img src="<?php echo get_template_directory_uri(); ?>/images/footer_logo.svg" class="white">
    </div>
    <div class="footer_content_top">
      <div class="left">
        <h4>Subscribe for all the latest updates</h4>
        <div class="input_holder"><?php echo do_shortcode('[contact-form-7 id="84" title="Subscribe Form"]')?></div>
      </div>
      <div class="right">
        <div class="right_top_content">
          <div class="single_menu">
            <h5>MENU</h5>
            
            <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-1',
                  'menu_id'        => 'footer1',
                  'container' => false,
                )
              );
            ?>
          </div>
  
          <div class="single_menu">
            <h5>SUPPORT</h5>
            <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-2',
                  'menu_id'        => 'footer2',
                  'container' => false,
                )
              );
            ?>
          </div>
        </div>
        <div class="social_wrap">
          <a href="https://www.facebook.com/people/Amparo-Art/" data-text="fb" target="_blank" rel="noopener noreferrer">
            fb
          </a>
          <a href="https://twitter.com/amparo_art" data-text="tw" target="_blank" rel="noopener noreferrer">
            tw
          </a>
          <?php if($instagram): ?>
            <a href="<?php echo $instagram; ?>" data-text="ig" target="_blank" rel="noopener noreferrer">
              Ig
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
