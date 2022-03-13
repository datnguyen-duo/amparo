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
        <div class="input_holder">
			<form action="">
				<input type="email" placeholder="Email">
			</form>
          {%- assign formId = 'ContactFooter' -%}
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
                placeholder="{{ 'general.newsletter_form.email_placeholder' | t }}"
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
                  <!-- <span class="newsletter__submit-text--large">{{ 'general.newsletter_form.submit' | t }}</span> -->
				  <img src="<?php echo get_template_directory_uri(); ?>/images/arrow_right.svg">
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
        
      </div>
      <div class="right">
        <div class="right_top_content">
          <div class="single_menu">
            <h5>MENU</h5>
            <ul>
              <li><a href="">Home</a></li>
              <li><a href="">Shop All Art</a></li>
              <li><a href="">Artists</a></li>
              <li><a href="">About</a></li>
            </ul>
          </div>
  
          <div class="single_menu">
            <h5>SUPPORT</h5>
            <ul>
              <li><a href="">Partner With Us</a></li>
              <li><a href="">Shipping & Returns</a></li>
              <li><a href="">Terms & Privacy</a></li>
              <li><a href="">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="social_wrap">
          <a href="" data-text="fb">
            fb
          </a>
          <a href="" data-text="tw">
            tw
          </a>
          <a href="" data-text="ig">
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
