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


  /*	-----------------------------------------------------------------------------
  quizz logic
  --------------------------------------------------------------------------------- */
    // setTimeout(function(){
    //   $('.single_pagination').first().addClass('active');
    // }, 1000)

    // var url_string = window.location.href; //window.location.href
    // var url = new URL(url_string);
    // var paramValue = url.searchParams.get("quizz");

    // var stackImagesIntro = gsap.timeline({
    //   paused:true,
    //   onComplete: function () {
    //     $(".image_stack .single_image_wrap").addClass('intro_done');
    //   },
    // });

    // let singleImage = $(".single_image_wrap");
    // let quiz_popup = $(".quiz_popup");
    // let quiz_popup_content = $(".quiz_popup_content");

    // stackImagesIntro.set(quiz_popup, {css:{zIndex:999}})
    // stackImagesIntro.to(quiz_popup, { visibility: 'visible', height: '100vh', duration: 0.7, ease: "power2.inOut" });
    // stackImagesIntro.to(quiz_popup_content, { visibility: 'visible', opacity: 1, duration: 0.7, ease: "power2.inOut" });
    // stackImagesIntro.to(singleImage, { opacity: 1, duration: 0.6, stagger: -0.2 });

    // $(".quiz_header_button, .quiz_contact_button").on("click", function () {
    //   stackImagesIntro.reverse();
    //   $('.quiz_popup').fadeOut();
    // })

    // $(".take_quiz").on("click", function () {
    //   var currentUrl = $(this).data('url');
    //   newUrl = '?quizz=true';
    //   window.history.pushState("", "", newUrl);
    //   $('.quiz_popup').fadeIn('fast');
    //   stackImagesIntro.play();
    //   var quizBackground = $('.single_image_wrap.active').data('color');
    //   $('.quiz_popup').css('background-color', quizBackground);
    // })

    // if (paramValue == 'true') {
    //   $(".take_quiz").trigger('click');
    //   $(".landing_popup .big_button:not(.null)").trigger('click')
    // }

    // $(".answer").on("click", function () {
    //   $('.single_pagination.active').last().next().addClass('active');

    //   $(".single_image_wrap.active").removeClass('new');
    //   let currentArt = $(".single_image_wrap.active");

    //   var removeImage = gsap.timeline({
    //     onComplete: function () {
    //       $(currentArt).remove();

    //       if($('.single_image_wrap').length < 1){
    //         $('.result_image').addClass('active');
    //         $('.quiz_popup').css('background-color', '#4b58aa');
    //         $('.results_marquee').addClass('active');
    //         $('.quiz_popup').addClass('final_result');
    //         $(".answer").fadeOut('fast');
    //         $(".left .left_description").addClass('result');
    //       }

    //       $(".image_stack .single_image_wrap").first().addClass('new');
    //       $(".image_stack .single_image_wrap").first().addClass('active');

    //       var quizBackground = $('.single_image_wrap.active').data('color');
    //       $('.quiz_popup').css('background-color', quizBackground);
    //     },
    //   });

    //   if($(this).hasClass('love')){
    //     removeImage.to(currentArt, { scale: 1.1, duration: 0.5 });
    //     removeImage.to(currentArt, { x: "250%",rotate: '180deg', duration: 0.4 });
    //   } else{
    //     removeImage.to(currentArt, { scale: 1.1, duration: 0.5 });
    //     removeImage.to(currentArt, { x: "-250%",rotate: '180deg', duration: 0.4 });
    //   }
    // });

    /*	-----------------------------------------------------------------------------
    end of quizz logic
  --------------------------------------------------------------------------------- */