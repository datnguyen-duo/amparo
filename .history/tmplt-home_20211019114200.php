<?php
/* Template Name: Home */
get_header(); ?>

<div class="home_wrap">
  <div class="landing_popup_wrap">
    <div class="landing_popup">
      <div class="logo_holder">
        <img src="<?php echo get_template_directory_uri(); ?>/images/white_logo.svg">
      </div>
      <div class="landing_popup_content">
        <p>I am a/an:</p>
        <div class="buttons_holder">
          <div class="big_button null" data-text="Private Collector">Private Collector</div>
          <div class="big_button" data-text="Artist">Artist</div>
          <div class="big_button null" data-text="Business">Business</div>
        </div>
      </div>
    </div>
  </div>

  <header>
    <div class="logo_holder">
        <img src="<?php echo get_template_directory_uri(); ?>/images/dark_logo.svg" class="dark">
    </div>

    <nav>
      <p>I am a/an:</p>
      <ul>
        <li>
          <a href="#" data-text="Private collector">Private collector</a>
        </li>
        <li class="active">
          <a href="#" data-text="Artist">Artist</a>
        </li>
        <li>
          <a href="#" data-text="Business">Business</a>
        </li>
      </ul>
    </nav>

    <a class="button header_button" data-text="Contact us" href="#contact">Contact us</a>
  </header>

  <!-- <div class="quiz_popup">
    <div class="quiz_popup_content" id="quiz_popup_content">
      <div class="quiz_header">
        <div class="logo_holder">
          <img src="{{ 'dark_logo.svg' | asset_url }}" class="dark" />
        </div>

        <a href="#contact" class="button quiz_header_button" data-text="Contact us">Contact us</a>

      </div>
      <div class="quiz_content_wrap">
        <div class="quiz_content">

          <div class="results_marquee">
            <div class="results_marquee_content">
              <p>Your Results Your Results </p>
            </div>
          </div>

          <div class="left">
            <div class="left_description">
              <p class="results">
                Artwork details: <br> Medium, style, price
              </p>
              <p class="pagination_description">
                Do you like this piece?
              </p>
              <div class="images_pagination">
                <div class="single_pagination">
                  <img src="{{ 'image_pag_empty.svg' | asset_url }}" class="empty" />
                  <img src="{{ 'image_pag_filled.svg' | asset_url }}" class="filled" />
                </div>
              </div>
            </div>

            <div class="pass answer">Pass</div>
          </div>

          <div class="image_stack">
            <div class="single_image_wrap active" data-color="#50C5EB">
              <div class="single_image">
                <img src="{{ 'art.png' | asset_url }}" class="white" />
              </div>
            </div>
            <div class="single_image_wrap" data-color="#EB7042">
              <div class="single_image">
                <img src="{{ 'hero__private-collector.png' | asset_url }}" class="white" />
              </div>
            </div>
            <div class="single_image_wrap" data-color="#5AAC7A">
              <div class="single_image">
                <img src="{{ 'hero__artists.png' | asset_url }}" class="white" />
              </div>
            </div>
            <div class="single_image_wrap" data-color="#E0D927">
              <div class="single_image">
                <img src="{{ 'hero__business.png' | asset_url }}" class="white" />
              </div>
            </div>
            <div class="single_image_wrap" data-color="#50C5EB">
              <div class="single_image">
                <img src="{{ 'art.png' | asset_url }}" class="white" />
              </div>
            </div>
            <div class="single_image_wrap" data-color="#EB7042">
              <div class="single_image">
                <img src="{{ 'hero__private-collector.png' | asset_url }}" class="white" />
              </div>
            </div>
            <div class="single_image_wrap" data-color="#5AAC7A">
              <div class="single_image">
                <img src="{{ 'hero__artists.png' | asset_url }}" class="white" />
              </div>
            </div>
            <div class="single_image_wrap" data-color="#50C5EB">
              <div class="single_image">
                <img src="{{ 'hero__business.png' | asset_url }}" class="white" />
              </div>
            </div>

            <div class="result_image">
              <div class="single_image">
                <img src="{{ 'result_image.png' | asset_url }}" class="white" />
              </div>
            </div>
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

      <div class="quiz_footer">
        <div class="social_holder">
          <p>SHARE THIS QUIZ</p>
          <div class="social_wrap">
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://amparo-art.myshopify.com/?quizz=true&t=Amparo Quiz"
            onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
            target="_blank"
            title="Share on Facebook"
            class="facebook" data-text="fb">
              fb
            </a>
            <a href="https://twitter.com/share?url=https://amparo-art.myshopify.com/?quizz=true&text=Amparo Quiz" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
            target="_blank"
            title="Share on Twitter"
            class="twitter" data-text="tw">
              tw
            </a>
            <a href="" data-text="ig">
              Ig
            </a>
          </div>
        </div>
        <div class="input_holder">
          <p>
            Subscribe Headline Here
          </p>
          {%- assign formId = 'ContactQuizz' -%}
          {% form 'customer', id: formId, novalidate: 'novalidate' %}
            {%- if form.posted_successfully? -%}
              <p class="form-message form-message--success" tabindex="-1" data-form-status>
                {{ 'general.newsletter_form.confirmation' | t }}
              </p>
            {%- endif -%}
            <input type="hidden" name="contact[tags]" value="newsletter">
            <div class="input-group {% if form.errors %} input-group--error{% endif %}">
              <input type="email"
                name="contact[email]"
                id="{{ formId }}-email"
                class="input-group__field newsletter__input{% if form.errors %} input--error{% endif %}"
                value="{{ form.email }}"
                placeholder="Email"
                aria-label="{{ 'general.newsletter_form.email_placeholder' | t }}"
                aria-required="true"
                required
                autocorrect="off"
                autocapitalize="off"
                {% if form.errors %}
                  aria-invalid="true"
                  aria-describedby="{{ formId }}-email-error"
                  data-form-status
                {% endif %}>
              <span class="input-group__btn"></span>
                <button type="submit" class="btn newsletter__submit" name="commit" >
                  <span class="newsletter__submit-text--large">{{ 'general.newsletter_form.submit' | t }}</span>
                  <img src="{{ 'white_arrow_right.svg' | asset_url }}">
                </button>
              </span>
            </div>
            {% if form.errors contains 'email' %}
              <span id="{{ formId }}-email-error" class="input-error-message">
                <span class="visually-hidden">{{ 'general.accessibility.error' | t }} </span>
                {% include 'icon-error' %}
                <span class="site-footer__newsletter-error">{{ form.errors.translated_fields['email'] | capitalize }} {{ form.errors.messages['email'] }}.</span>
              </span>
            {% endif %}
          {% endform %}
        </div>
        <div class="quiz_contact">
          Questions? <a href="#contact" class="quiz_contact_button">Contact Us</a>
        </div>
      </div>
    </div>
  </div> -->

  <div class="hero_wrap">
    <div class="image_holder">
        <img src="<?php echo get_template_directory_uri(); ?>/images/hero__private-collector.png">
        <img src="<?php echo get_template_directory_uri(); ?>/images/hero__artists.png">
        <img src="<?php echo get_template_directory_uri(); ?>/images/hero__business.png">

    </div>
    <div class="hero_buttons">
      <a class="single_button"> <span>Calendly</span></a>
      <a class="single_button take_quiz"><span>Take the quiz</span></a>
    </div>
    <div class="hero_content">
      <div class="small_headline">
        <img src="<?php echo get_template_directory_uri(); ?>/images/square_shape.svg">
        <p>For Artists</p>
      </div>
      <h1 class="main_headline letter_wrap">Promote Your Artwork Here</h1>
    </div>
  </div>

  <div class="first_section">
    <div class="first_section_content">
      <div class="headline_wrap">
        <img src="<?php echo get_template_directory_uri(); ?>/images/four_squares.svg">
        <h2 class="letter_wrap fadein_wrap">Amparo enables artists to exhibit their artwork in virtually staged environments.</h2>
      </div>
      <p class="fadein_wrap fade_up">We work to provide fine artists a platform to enhance their virtual presence while receiving a competitive commission.</p>
    </div>
  </div>

  <div class="second_section">
    <div class="second_section_content">
      <div class="left">
        <div class="container">
          <img src="<?php echo get_template_directory_uri(); ?>/images/shape.svg" class="shape">
          <div class="image_holder_wrap">
            <div class="image_holder one">
              <img src="<?php echo get_template_directory_uri(); ?>/images/bg-1.png" class="bg one">
            </div>
            <div class="image_holder two">
              
              <img src="<?php echo get_template_directory_uri(); ?>/images/bg-2.png" class="bg two">
            </div>
            <div class="image_holder three">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bg-3.png" class="bg three">
            </div>
          </div>
        </div>
        <div class="banner first mobile">
          <div class="banner_content marquee">
            <p>Artist Details</p>
          </div>
        </div>
      </div>
      <div class="right">
        <div class="banner first desktop">
          <div class="banner_content marquee">
            <p>Artist Details</p>
          </div>
        </div>
        <div class="right_content">
          <div class="single_box">
            <div class="box_content fadein_wrap">
              <div class="headline_holder">
                <img src="<?php echo get_template_directory_uri(); ?>/images/list_icon.svg">

                <h2 class="letter_wrap fadein_wrap">Artist Centered Platform</h2>
              </div>
              
              <p>Our interactive, data-driven platform allows your artwork to put its best foot forward. Our virtually staged environments place every individual painting in a favorable atmosphere, bolstering its saleability. </p>
            </div>
          </div>
          <div class="single_box">
            <div class="box_content fadein_wrap">
              <div class="headline_holder">
                <img src="<?php echo get_template_directory_uri(); ?>/images/list_icon.svg">
                <h2 class="letter_wrap fadein_wrap">Earn More</h2>
              </div>
              <p>Amparo strives to offer a more competitive commission than traditional brick-and-mortar galleries without any additional hassle. So if you have never sold your artwork online, there are no worries. The artwork never has to leave your hands until it is purchased!</p>
            </div>
          </div>
          <div class="single_box">
            <div class="box_content fadein_wrap">
              <div class="headline_holder">
                <img src="<?php echo get_template_directory_uri(); ?>/images/list_icon.svg">
                <h2 class="letter_wrap fadein_wrap">Easy Sign-Up</h2>
              </div>
              <p>If you are an artist interested in our services, all you have to do is either fill out the form above or schedule an appointment to discuss further. We pride ourselves on being an artist-centered service, so we will answer any and all questions you may have!</p>
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
                <img src="<?php echo get_template_directory_uri(); ?>/images/horizontal_line.svg" class="horizontal_line">
                <img src="<?php echo get_template_directory_uri(); ?>/images/rotate_circle.svg" class="rotate_circle">
                <img src="<?php echo get_template_directory_uri(); ?>/images/artist.png" class="artist">
              </div>
          </div>
          <div class="artist_info">
            <h3>Artist Name</h3>
            <p>
              Short bio: Curabitur ultricies rhoncus ex, ut lacinia nisl venenatis vitae. Cras ut felis ipsum. Vivamus eu scelerisque sapien, vel congue mauris.
            </p>
          </div>
        </div>
      </div>
      <div class="single_artist_wrap">
        <div class="single_artist">
            <img src="<?php echo get_template_directory_uri(); ?>/images/artist_shape.svg" class="artist_shape">
            <div class="artist_image_wrap">
              <div class="artist_image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/horizontal_line.svg" class="horizontal_line">
                <img src="<?php echo get_template_directory_uri(); ?>/images/rotate_circle.svg" class="rotate_circle">
                <img src="<?php echo get_template_directory_uri(); ?>/images/artist.png" class="artist">
              </div>
            </div>
          <div class="artist_info">
            <h3>Artist Name</h3>
            <p>
              Short bio: Curabitur ultricies rhoncus ex, ut lacinia nisl venenatis vitae. Cras ut felis ipsum. Vivamus eu scelerisque sapien, vel congue mauris.
            </p>
          </div>
        </div>
      </div>
      <div class="single_artist_wrap">
        <div class="single_artist">
        <img src="<?php echo get_template_directory_uri(); ?>/images/artist_shape.svg" class="artist_shape">
            <div class="artist_image_wrap">
              <div class="artist_image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/horizontal_line.svg" class="horizontal_line">
                <img src="<?php echo get_template_directory_uri(); ?>/images/rotate_circle.svg" class="rotate_circle">
                <img src="<?php echo get_template_directory_uri(); ?>/images/artist.png" class="artist">
              </div>
           </div>
          <div class="artist_info">
            <h3>Artist Name</h3>
            <p>
              Short bio: Curabitur ultricies rhoncus ex, ut lacinia nisl venenatis vitae. Cras ut felis ipsum. Vivamus eu scelerisque sapien, vel congue mauris.
            </p>
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
            <form action="">
              <input type="text" placeholder="First Name" />
              <input type="text" placeholder="Last Name" />
              <input type="text" placeholder="Email Address" />
              <input type="text" placeholder="Subject" />
              <input type="text" placeholder="Message" />

              <div class="button_holder">
                <button class="button dark" data-text="Send message">
                  Send message
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
get_footer(); ?>