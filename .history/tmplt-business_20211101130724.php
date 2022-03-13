<?php
/* Template Name: Business */

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
        <img src="<?php echo get_template_directory_uri(); ?>/images/hero__business.png">
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
      <div class="headline_wrap">
        <img src="<?php echo get_template_directory_uri(); ?>/images/four_squares.svg">
        <h2 class="letter_wrap fadein_wrap">Amparo represents regional fine artists, showcasing a variety of artwork in customizable, virtually staged environments.</h2>
      </div>
      <p class="fadein_wrap fade_up"> We designed our platform to create spaces that mirror your own.</p>
    </div>
  </div>

  <div class="second_section">
    <div class="second_section_content">
      <div class="left">
        <div class="container">
          <img src="<?php echo get_template_directory_uri(); ?>/images/shape.svg" class="shape">
          <div class="image_holder_wrap">
            <div class="image_holder one">
              <img src="<?php echo get_template_directory_uri(); ?>/images/Boston Library Image.jpg" class="bg one">
            </div>
            <div class="image_holder two">
              
              <img src="<?php echo get_template_directory_uri(); ?>/images/Library w- pictures.jpg" class="bg two">
            </div>
            <div class="image_holder three">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Flowers Art.jpg" class="bg three">
            </div>
          </div>
        </div>
        <div class="banner first mobile">
          <div class="banner_content marquee">
            <p>Business Details</p>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="banner first desktop">
          <div class="banner_content marquee">
            <p>Business Details</p>
          </div>
        </div>
        <div class="right_content">
          <div class="single_box">
            <div class="box_content fadein_wrap">
              <div class="headline_holder">
                <img src="<?php echo get_template_directory_uri(); ?>/images/list_icon.svg">

                <h2 class="letter_wrap fadein_wrap">Complete Your Aesthetic</h2>
              </div>
              <p>Research shows that art in the workspace increases productivity and happiness. Let Amparo help your business find fine art to match your company’s environment.</p>
            </div>
          </div>
          <div class="single_box">
            <div class="box_content fadein_wrap">
              <div class="headline_holder">
                <img src="<?php echo get_template_directory_uri(); ?>/images/list_icon.svg">
                <h2 class="letter_wrap fadein_wrap">Support Local Community</h2>
              </div>
              <p>Amparo exhibits regional fine artists from along the East Coast who employ diverse mediums and subject matter. Your investment in the arts sector supports the vibrancy of local communities. </p>
            </div>
          </div>
          <div class="single_box">
            <div class="box_content fadein_wrap">
              <div class="headline_holder">
                <img src="<?php echo get_template_directory_uri(); ?>/images/list_icon.svg">
                <h2 class="letter_wrap fadein_wrap">White-Glove Service</h2>
              </div>
              <p>Amparo offers customers a white glove delivery process, which will include installation, so you do not have to worry about any overhang of how to hang your artwork.</p>
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
    <h2>Featured Artists</h2>

    <div class="featured_artist_content">
      <div class="single_artist_wrap">
        <div class="single_artist">
            <img src="<?php echo get_template_directory_uri(); ?>/images/artist_shape.svg" class="artist_shape">
            <div class="artist_image_wrap">
              <div class="artist_image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/rotate_circle.svg" class="rotate_circle">
                <img src="<?php echo get_template_directory_uri(); ?>/images/LogoAmparo-Logomark_Color.png" class="artist last">
              </div>
            </div>
          <div class="artist_info">
            <h3>Claire Giblin</h3>
            <p>Claire Louise Giblin is a painter and photographer born and educated in New York City. She has exhibited in the US, Germany, Italy, Korea, Spain, and Turkey in her professional career. Her work is in corporate, educational, museum, and private collections. Her paintings have appeared on covers of scholarly publications, and articles. As Curator of Collections and Exhibitions at Phillips Museum of Art at Franklin & Marshall College, she curated over 100 exhibitions, designed and produced exhibition catalogs. Giblin received her Certificate in Appraisal Studies at NYU. She is an Accredited Member of the Appraisers Association of America and founder of Atlantic Appraisal Services LLC.</p>
          </div>
        </div>
      </div>
      <div class="single_artist_wrap">
        <div class="single_artist">

          <img src="<?php echo get_template_directory_uri(); ?>/images/artist_shape.svg" class="artist_shape">
          <div class="artist_image_wrap">
              <div class="artist_image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/rotate_circle.svg" class="rotate_circle">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Jain Falcon Image.jpeg" class="artist">
              </div>
          </div>
          <div class="artist_info">
            <h3>Jain Falcon</h3>
            <p>Jain Falcon is a fine artist based in Lancaster, PA. She is inspired by fantasy, nature, female empowerment, and beautiful colors. Her fine art pieces are a unique process of acrylic pouring mixed with line art of shapes and gestures. In the process of creating, Jain discovers that each painting decides what it wishes to be and is never premeditated. When she's not creating, Jain loves to travel, read, and tend to her large collection of house plants.</p>
          </div>
        </div>
      </div>
      <div class="single_artist_wrap">
        <div class="single_artist">
        <img src="<?php echo get_template_directory_uri(); ?>/images/artist_shape.svg" class="artist_shape">
            <div class="artist_image_wrap">
              <div class="artist_image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/rotate_circle.svg" class="rotate_circle">
                <img src="<?php echo get_template_directory_uri(); ?>/images/LogoAmparo-Logomark_Color.png" class="artist last">
              </div>
           </div>
          <div class="artist_info">
            <h3>Possibly You?</h3>
            <p>
            If you are an artist interested in Amparo's service, please feel free to either schedule a meeting through our "Let's Talk" button above or send us an <a href="mailto:hello@amparoart.com">email</a>. We look forward to working with you!</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="fourth_section" id="contact">
    <div class="fourth_section_content">
      <div class="left">
        <div class="left_content">
          <h2 class="letter_wrap fadein_wrap">Contact Us</h2>

          <div class="sign fadein_wrap fade_up">
            <img src="<?php echo get_template_directory_uri(); ?>/images/dark_square.svg">
            <img src="<?php echo get_template_directory_uri(); ?>/images/arrow_right.svg">
          </div>
          <p class="fadein_wrap fade_up">Amparo operates 24/7 and will respond to all requests promptly. If you are interested in working with a representative, please fill out the form on the right or schedule an appointment above!</p>
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