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
$checkoutPage = (is_checkout() && empty(is_wc_endpoint_url('order-received')));
$fixed_popup_headline = get_field('fixed_popup_headline', 'option');
$fixed_popup_links = get_field('fixed_popup_links', 'option');
?>
<?php if(!$checkoutPage && !is_wc_endpoint_url('order-received') ): ?>
  <footer>
    <div class="footer_content_wrap">
      <div class="logo_holder">
      <img src="<?php echo get_template_directory_uri(); ?>/images/footer_logo.svg" class="white">
      </div>
      <div class="footer_content_top">
        <div class="left">
          <?php if($subscribe_form_headline): ?>
            <h4><?php echo $subscribe_form_headline; ?></h4>
          <?php endif; ?>
          <?php if($contact_form_id): ?>
            <div class="input_holder"><?php echo do_shortcode('[contact-form-7 id="<?php echo $contact_form_id; ?>" title="Subscribe Form"]')?></div>
          <?php endif; ?>
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
      </div>

    </div>
  </footer>
<?php endif; ?>

<?php if(is_wc_endpoint_url('order-received')): ?>
  <footer class="checkout_footer">
    <div class="footer_content_wrap">
      <div class="social_wrap_holder">
        <h4>FOLLOW US ON SOCIAL MEDIA</h4>
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
      <div class="subscribe_wrap">
        <h4>SUBSCRIBE HEADLINE HERE</h4>
        <div class="input_holder"><?php echo do_shortcode('[contact-form-7 id="72" title="Subscribe Form"]')?></div>
      </div>

      <div class="bottom_section">
        <span>Questions? <a href="<?= site_url('/contact/') ?>">Contact Us</a></span>
      </div>
    </div>
  </footer>
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
    <div class="cta_fixed_popup">
      <div class="close_fixed_popup">
        <img src="<?php echo get_template_directory_uri(); ?>/images/close_popup.svg" class="close_popup">
      </div>
      <div class="fixed_popup_content">
        <?php if($fixed_popup_headline): ?>
          <p><?php echo $fixed_popup_headline; ?></p>
        <?php endif; ?>
        <?php if($fixed_popup_links): ?>
          <div class="buttons_holder">
            <?php foreach( $fixed_popup_links as $singleItem ): ?>
              <a href="<?php echo $singleItem['single_link']['url'] ?>" target="<?php echo $singleItem['single_link']['target'] ?>" class="btn" data-text="<?php echo $singleItem['single_link']['title'] ?>">
                <?php echo $singleItem['single_link']['title'] ?>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
</body>
</html>
