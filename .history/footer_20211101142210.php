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
            <ul>
              <li><a href="">Home</a></li>
              <li><a href="">Shop All Art</a></li>
              <li><a href="">Artists</a></li>
              <li><a href="">About</a></li>
            </ul>
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
            <ul>
              <li><a href="">Partner With Us</a></li>
              <li><a href="">Shipping & Returns</a></li>
              <li><a href="">Terms & Privacy</a></li>
              <li><a href="">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="social_wrap">
          <a href="https://www.facebook.com/people/Amparo-Art/" data-text="fb" target="_blank" rel="noopener noreferrer">
            fb
          </a>
          <a href="https://twitter.com/amparo_art" data-text="tw" target="_blank" rel="noopener noreferrer">
            tw
          </a>
          <a href="https://www.instagram.com/amparo_art_/" data-text="ig" target="_blank" rel="noopener noreferrer">
            Ig
          </a>
        </div>
      </div>
    </div>

  </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
