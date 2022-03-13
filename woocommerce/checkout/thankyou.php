<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$order_items = $order->get_items();
$order_fees = $order->get_fees();
?>
<div class="woocommerce-order thank_you_wrap">
    <?php if($order): ?>
        <?php if ( $order->has_status( 'failed' ) ) : ?>
            <div class="thank_you_header">
                <img src="<?php echo get_template_directory_uri(); ?>/images/thankyou_background_hero.png" alt="" class="desktop">
                <img src="<?php echo get_template_directory_uri(); ?>/images/mobile_thank_you_hero.png" alt="" class="mobile">

                <div class="headline_holder">
                    <h1 class="letter_wrap">Order Failed</h1>
                    <p>
                        Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.
                    </p>
                </div>
            </div>
        <?php else : ?>
            <div class="thank_you_header">
                <img src="<?php echo get_template_directory_uri(); ?>/images/thankyou_background_hero.png" alt="" class="desktop">
                <img src="<?php echo get_template_directory_uri(); ?>/images/mobile_thank_you_hero.png" alt="" class="mobile">

                <div class="headline_holder">
                    <h1 class="letter_wrap">Order Received</h1>
                    <p>
                        Thank you for shopping with Amparo! View your order details below.                     
                    </p>

                    <a class="scroll_down" href="#order_summary">
                        <span>view order summary</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24.962" height="34.557" viewBox="0 0 24.962 34.557">
                            <g id="Group_4722" data-name="Group 4722" transform="translate(0.076 34.557) rotate(-90)">
                                <path id="Path_46842" data-name="Path 46842" d="M-22111.928,9996.247s1.252-12.264-11.773-12.4" transform="translate(22123.787 -9971.438)" fill="none" stroke="#ffffff" stroke-width="1.5"/>
                                <line id="Line_178" data-name="Line 178" x1="34.557" transform="translate(0 12.405)" fill="none" stroke="#ffffff" stroke-width="1.5"/>
                                <path id="Path_47226" data-name="Path 47226" d="M-22111.928,9983.843s1.252,12.264-11.773,12.4" transform="translate(22123.787 -9983.843)" fill="none" stroke="#ffffff" stroke-width="1.5"/>
                            </g>
                        </svg>

                    </a>
                </div>
            </div>

            <div class="contact_section" id="order_summary">
                <div class="contact_section_content">
                    <div class="left">
                        <div class="left_content">
                            
                            <h2 class="letter_wrap ">Order Summary</h2>

                            <div class="sign">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/dark_square.svg">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/arrow_right.svg">
                            </div>
                            
                            <p>    Amparo appreciates your support of the arts. If you have any questions or concerns about your order, please contact <a href="mailto:hello@amparoart.com">hello@amparoart.com</a>.</p>
                            
                        </div>
                    </div>
                    <div class="right">
                        <div class="banner second">
                            <div class="second_banner_content vmarquee">
                                <p>THANK YOU FOR SHOPPING WITH AMPARO!</p>
                            </div>
                        </div>
                        <div class="right_content">
                            <div class="orders_wrap_list">
                                <h4>orders</h4>
                                <?php foreach($order_items as $item):
                                    $item_data = $item->get_data();    
                                    $product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
                                ?>
                                    <div class="single_order">
                                        <div class="left_info">
                                            <div class="product_image">
                                                <?php echo $product->get_image(); ?>
                                            </div>
                                        </div>
                                        <div class="right_info_wrap">
                                            <div class="right_info">
                                                <div class="product_info">
                                                    <div class="product_title">
                                                        <?php echo get_the_title($item_data['product_id']) ?>
                                                    </div>
                                                    <div class="product_author">
                                                        <?php echo get_the_author($item_data['product_id']); ?>
                                                    </div>
                                                </div>
                                                <div class="product_price">
                                                    <?php echo get_woocommerce_currency_symbol(); ?><?php echo $product->get_price() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="general_order_info">
                                <div class="single_order_info">
                                    <div class="order_info_name">
                                        SUBTOTAL
                                    </div>
                                    <div class="order_info_price">
                                        <?php echo get_woocommerce_currency_symbol(); ?><?php echo $order->get_subtotal(); ?>
                                    </div>
                                </div>
                                <div class="single_order_info">
                                    <div class="order_info_name">
                                        SHIPPING
                                    </div>
                                    <div class="order_info_price">
                                        <?php echo get_woocommerce_currency_symbol(); ?><?php echo $order->get_shipping_total(); ?>
                                    </div>
                                </div>
                                <?php if( $order->get_fees() ): ?>
                                    <?php foreach ( $order->get_fees() as $fee ):
                                        $fee_data = $fee->get_data() ?>
                                        <div class="single_order_info">
                                            <div class="order_info_name">
                                                <?= $fee_data['name']; ?>
                                            </div>
                                            <div class="order_info_price">
                                                <?= get_woocommerce_currency_symbol().$fee_data['total']; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <div class="single_order_info">
                                    <div class="order_info_name">
                                        TOTAL
                                    </div>
                                    <div class="order_info_price">
                                        <?php echo get_woocommerce_currency_symbol(); ?><?php echo $order->get_total(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    
    <div class="old_thankyou">
        <?php
        if ( $order ) :
    
            do_action( 'woocommerce_before_thankyou', $order->get_id() );
            ?>
    
            <?php if ( $order->has_status( 'failed' ) ) : ?>
                
                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>
    
                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                    <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
                    <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
                    <?php endif; ?>
                </p>
            <?php else : ?>
                    
    
                <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
    
                <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
    
                    <li class="woocommerce-order-overview__order order">
                        <?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
                        <strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                    </li>
    
                    <li class="woocommerce-order-overview__date date">
                        <?php esc_html_e( 'Date:', 'woocommerce' ); ?>
                        <strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                    </li>
    
                    <!-- <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                        <li class="woocommerce-order-overview__email email">
                            <?php esc_html_e( 'Email:', 'woocommerce' ); ?>
                            <strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                        </li>
                    <?php endif; ?> -->
    
                    <li class="woocommerce-order-overview__total total">
                        <?php esc_html_e( 'Total:', 'woocommerce' ); ?>
                        <strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                    </li>
    
                    <?php if ( $order->get_payment_method_title() ) : ?>
                        <li class="woocommerce-order-overview__payment-method method">
                            <?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
                            <strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
                        </li>
                    <?php endif; ?>
    
                </ul>
    
            <?php endif; ?>
    
            <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
            <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
    
        <?php else : ?>
    
            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
    
        <?php endif; ?>
    </div>

</div>
