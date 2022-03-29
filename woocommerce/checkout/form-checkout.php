<?php
//remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form');
//add_action( 'woocommerce_after_checkout_form', 'woocommerce_checkout_coupon_form' );
?>
<div class="form_checkout_page_container">
    <div class="checkout_fields">
        <?php
        /**
         * Checkout Form
         *
         * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
         *
         * HOWEVER, on occasion WooCommerce will need to update template files and you
         * (the theme developer) will need to copy the new files to your theme to
         * maintain compatibility. We try to do this as little as possible, but it does
         * happen. When this occurs the version of the template file will be bumped and
         * the readme will list any important changes.
         *
         * @see https://docs.woocommerce.com/document/template-structure/
         * @package WooCommerce\Templates
         * @version 3.5.0
         */

        if ( ! defined( 'ABSPATH' ) ) {
            exit;
        }

        do_action( 'woocommerce_before_checkout_form', $checkout );

        // If checkout registration is disabled and not logged in, the user cannot checkout.
        if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
            echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
            return;
        }
        ?>

        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

            <?php if ( $checkout->get_checkout_fields() ) : ?>

                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                <div id="customer_details">
                    <div class="billing_box single_step">
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        <div class="checkout_buttons_holder">
                            <a href="<?= get_site_url() ?>" class="btn" data-text="RETURN TO SHOP">RETURN TO SHOP</a>
                            <div class="btn white" data-text="CONTINUE TO SHIPPING" data-step="2">CONTINUE TO SHIPPING</div>
                        </div>
                    </div>

                    <div class="shipping_box single_step">
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>

                        <?php if( WC()->shipping->get_packages() ): ?>
                            <h2>Shipping Methods</h2>
							<?php echo woocommerce_order_review(); ?>
                            <!--div class="shipping_methods_copy"></div-->
                        <?php endif; ?>

                        <div class="checkout_buttons_holder">
                            <div class="btn" data-text="RETURN TO DETAILS" data-step="1">RETURN TO DETAILS</div>
                            <div class="btn white" data-text="CONTINUE TO PAYMENT" data-step="3">CONTINUE TO PAYMENT</div>
                        </div>
                    </div>
                </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            <?php endif; ?>

            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <div id="order_review" class="woocommerce-checkout-review-order single_step">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
            </div>

            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

        </form>

        


    </div>
    <div class="checkout_cart">
        <?php render_shopping_cart(); ?>
    </div>
</div>
<style>
input[type=radio] {
  visibility: hidden;
  position: relative;

  margin-left: 5px;
  width: 20px;
  height: 20px;
}

input[type=radio]:before {
  content: "";
  visibility: visible;
  position: absolute;

  border: 2px solid #eb6864;
  border-radius: 50%;

  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}

input[checked="checked"]:before {
  background-color: #eb6864;
}
</style>