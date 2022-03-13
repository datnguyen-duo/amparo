<?php
/* Template Name: Artist */

$hero_sub_headline = get_field('hero_sub_headline');
$hero_main_headline = get_field('hero_main_headline');
$hero_link = get_field('hero_link');

$section_1_big_description = get_field('section_1_big_description');
$section_1_small_description = get_field('section_1_small_description');

$section_2_banner_text = get_field('section_2_banner_text');
$section_2_list = get_field('section_2_list');

$section_3_headline = get_field('section_3_headline');
$section_3_artist_list = get_field('section_3_artist_list');

$section_4_headline = get_field('section_4_headline');
$section_4_description = get_field('section_4_description');

get_header(); ?>

<div class="home_wrap" data-barba="container" data-barba-namespace="template">

  <div class="hero_wrap">
    <div class="image_holder">
        <img src="<?php echo get_template_directory_uri(); ?>/images/hero__artists.png">

    </div>
    
    <?php if($hero_link): ?>
      <div class="hero_buttons">
        <a class="single_button" href="<?php echo $hero_link['url'] ?>" target="<?php echo $hero_link['target'] ?>" rel="noopener noreferrer"><span><?php echo $hero_link['title'] ?></span></a>
        <!-- <a class="single_button take_quiz"><span>Take the quiz</span></a> -->
      </div>
    <?php endif; ?>
    <div class="hero_content">
      <?php if($hero_sub_headline): ?>
        <div class="small_headline">
          <img src="<?php echo get_template_directory_uri(); ?>/images/square_shape.svg">
          <p><?php echo $hero_sub_headline; ?></p>
        </div>
      <?php endif; ?>
      <?php if($hero_main_headline): ?>
        <h1 class="main_headline letter_wrap"><?php echo $hero_main_headline; ?></h1>
      <?php endif; ?>
    </div>
  </div>

  <div class="first_section">
    <div class="first_section_content">
      <?php if($section_1_big_description): ?>
        <div class="headline_wrap">
          <img src="<?php echo get_template_directory_uri(); ?>/images/four_squares.svg">
          <h2 class="letter_wrap fadein_wrap"><?php echo $section_1_big_description; ?></h2>
        </div>
      <?php endif; ?>
      <?php if($section_1_small_description): ?>
        <p class="fadein_wrap fade_up"><?php echo $section_1_small_description; ?></p>
      <?php endif; ?>
    </div>
  </div>

  <div class="second_section">
    <div class="second_section_content">
      <div class="left">
        <div class="container">
          <img src="<?php echo get_template_directory_uri(); ?>/images/shape.svg" class="shape">
          <div class="image_holder_wrap">
            <?php $counter = 1; ?>
            <?php foreach( $section_2_list as $singleItem ): ?>
              <div class="image_holder <?php if($counter == 1): ?>one<?php elseif($counter == 2): ?>two<?php elseif($counter == 3): ?>three<?php endif; ?>">
                <img src="<?php echo $singleItem['list_image']['url']; ?>" class="bg <?php if($counter == 1): ?>one<?php elseif($counter == 2): ?>two<?php elseif($counter == 3): ?>three<?php endif; ?>">
              </div>
              <?php $counter++; ?>
            <?php endforeach; ?>

            <!-- <div class="image_holder one">
              <img src="<?php echo get_template_directory_uri(); ?>/images/Bridge Painting.jpg" class="bg one">
            </div>
            <div class="image_holder two">
              
              <img src="<?php echo get_template_directory_uri(); ?>/images/Dark Flower Painting.jpg" class="bg two">
            </div>
            <div class="image_holder three">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Angelic Painting.jpg" class="bg three">
            </div> -->
          </div>
        </div>
        <div class="banner first mobile">
          <div class="banner_content marquee">
            <?php if($section_2_banner_text): ?>
              <p><?php echo $section_2_banner_text ?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="banner first desktop">
          <div class="banner_content marquee">
            <?php if($section_2_banner_text): ?>
              <p><?php echo $section_2_banner_text ?></p>
            <?php endif; ?>
          </div>
        </div>
        <div class="right_content">
          <div class="single_box">
            <div class="box_content fadein_wrap">
              <div class="headline_holder">
                <img src="<?php echo get_template_directory_uri(); ?>/images/list_icon.svg">

                <h2 class="letter_wrap fadein_wrap">Artist Centered Platform</h2>
              </div>
              <p>Our interactive, data-driven platform allows your artwork to put its best foot forward. Our virtually staged environments place every individual painting in a favorable atmosphere, leading to more sales.</p>
            </div>
          </div>
          <div class="single_box">
            <div class="box_content fadein_wrap">
              <div class="headline_holder">
                <img src="<?php echo get_template_directory_uri(); ?>/images/list_icon.svg">
                <h2 class="letter_wrap fadein_wrap">Earn More</h2>
              </div>
              <p>Amparo offers a more competitive commission than the average traditional brick-and-mortar gallery without any additional hassle. Whether you are new to online art sales or looking to increase your sales, we are here to support your work.</p>
            </div>
          </div>
          <div class="single_box">
            <div class="box_content fadein_wrap">
              <div class="headline_holder">
                <img src="<?php echo get_template_directory_uri(); ?>/images/list_icon.svg">
                <h2 class="letter_wrap fadein_wrap">Easy Sign-Up</h2>
              </div>
              <p>Interested in our services? Fill out our online form or schedule an appointment and we’ll be in touch! We pride ourselves on putting the artist first and will answer any and all questions you may have!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="third_section">
    <div class="third_section_content_wrap">
      <div class="third_section_content">
        <h2 class="letter_wrap fadein_wrap">Take our art match quiz</h2>
        <div class="flower_wrap fadein_wrap">
          <img src="<?php echo get_template_directory_uri(); ?>/images/flowers.png" class="flower">
        </div>
        <div class="bottom_bar">
          <div class="bottom_bar_content">
            <p>Find the perfect fit for your needs with our filtered quiz!</p>
            <a class="button take_quiz" data-text="Take the quiz"> Take the quiz </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="featured_artist">
    <?php if($section_3_headline): ?>
      <h2 class="letter_wrap"><?php echo $section_3_headline; ?></h2>
    <?php endif; ?>

    <div class="featured_artist_content">

      <?php foreach( $section_3_artist_list as $singleArtist ): ?>
        <div class="single_artist_wrap">
          <div class="single_artist"> 
              <img src="<?php echo get_template_directory_uri(); ?>/images/artist_shape.svg" class="artist_shape">
              <div class="artist_image_wrap">
                <div class="artist_image">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/rotate_circle.svg" class="rotate_circle">
                  <?php if($singleArtist['artist_image']): ?>
                    <img src="<?php echo $singleArtist['artist_image']['url']; ?>" class="artist last">
                  <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/LogoAmparo-Logomark_Color.png" class="artist last">
                  <?php endif; ?>
                </div>
              </div>
            <div class="artist_info">
              <h3><?php echo $singleArtist['artist_name']; ?></h3>
              <?php echo $singleArtist['artist_description']; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="fourth_section" id="contact">
    <div class="fourth_section_content">
      <div class="left">
        <div class="left_content">
          <?php if($section_4_headline): ?>
            <h2 class="letter_wrap fadein_wrap"><?php echo $section_4_headline; ?></h2>
          <?php endif; ?>

          <div class="sign fadein_wrap fade_up">
            <img src="<?php echo get_template_directory_uri(); ?>/images/dark_square.svg">
            <img src="<?php echo get_template_directory_uri(); ?>/images/arrow_right.svg">
          </div>
          <?php if($section_4_description): ?>
            <p class="fadein_wrap fade_up"><?php echo $section_4_description; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="right">
        <div class="banner second">
          <div class="second_banner_content vmarquee">
            <p>SEND US A MESSAGE</p>
          </div>
        </div>
        <div class="right_content">
          <div class="form_holder">
            <?php echo do_shortcode('[contact-form-7 id="79" title="Contact Form"]')?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
get_footer(); ?>