<?php
/* Template Name: Partner */

$categories_images = get_field('categories_images');

get_header(); ?>

<div class="partners_wrap">
  <div class="landing_popup_wrap">
    <div class="landing_popup">
      <div class="logo_holder">
        <img src="<?php echo get_template_directory_uri(); ?>/images/white_logo.svg">
      </div>
      <div class="landing_popup_content">
        <p>I am a/an:</p>
        <div class="buttons_holder">
          <?php if($categories_images): ?>
          <?php foreach( $categories_images as $singleItem ): ?>
            <a class="big_button" data-text="<?php echo $singleItem['single_button']['title']; ?>" href="<?php echo $singleItem['single_button']['url']; ?>"><?php echo $singleItem['single_button']['title']; ?></a>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

   <div class="hero_wrap">
    <div class="image_holder">
      <?php foreach( $categories_images as $singleItem ): ?>
        <img src="<?php echo $singleItem['single_image']['url']; ?>" class="select_partner">
      <?php endforeach; ?>
    </div>
    <div class="hero_buttons">
      <a class="single_button"> <span>Calendly</span></a>
      <a class="single_button take_quiz"><span>Take the quiz</span></a>
    </div>
    
  </div>
</div>


<?php
get_footer(); ?>