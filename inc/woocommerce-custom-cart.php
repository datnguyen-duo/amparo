<?php
function render_shopping_cart_items($is_item_added_to_cart = false) {
    $woocommerce_cart = WC()->cart->get_cart();
//    add_action( 'woocommerce_checkout_create_order', 'get_total_cost', 20, 1 );

    if( $woocommerce_cart ):
        $checkout_url = wc_get_checkout_url();
        $currency_symbol = get_woocommerce_currency_symbol();
        $cart_subtotal_price = WC()->cart->get_subtotal();
        $cart_totals = WC()->cart->get_totals();
        $cart_price = $cart_totals['total'];
//        $cart_shipping = WC()->cart->get_cart_shipping_total();
        $cart_shipping = WC()->cart->get_shipping_total();
//        var_dump(WC()->cart);

        if( $is_item_added_to_cart ):
            $last_added_product_id = end( WC()->cart->cart_contents)['product_id'];
            $last_product_title = get_the_title($last_added_product_id); ?>
            <p class="item_added_to_cart_message"><?= $last_product_title; ?> has been added to cart.</p>
        <?php endif;

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
//            var_dump($cart_item);
            $post_obj    = get_post( $cart_item['product_id'] );
            $author_id = $post_obj->post_author;
            $author = get_user_by( 'ID', $author_id );

            $item_name = $cart_item['data']->get_title();
            $product_id = $cart_item['product_id'];
            $product_quantity = $cart_item['quantity'];
            $price = $cart_item['data']->get_price();
            $image = get_the_post_thumbnail($product_id);
            ?>
            <div class="item item_<?php echo $product_id; ?>" id="cart_item_<?php echo $cart_item_key; ?>">
                <div class="item_info_col image_col">
                    <div class="item_info_col_inner_col">
                        <a href="<?= get_permalink($product_id) ?>" class="image_holder"><?= $image; ?></a>
                    </div>
                </div>
                
                <div class="item_info_col info_col">
                    <div class="item_info_col_inner_col">
                        <div class="item_name"><?= $item_name; ?> (<?php echo $product_quantity; ?>)</div>
                        <div class="item_author"><?= $author->data->display_name ?></div>
                        <p class="remove_item" data-target="<?php echo $cart_item_key ?>">Remove</p>
                    </div>
                    <div class="item_price"> <?= wc_price($price) ?></div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="cart_footer">
            <div class="total_info">
                <div class="cart_total_price_holder">
                    <h4>Total:</h4>
                    <p> <?= wc_price($cart_price) ?></p>
                </div>

                <div class="cart_shipping_price">
                    <?php if(is_numeric($cart_shipping)): ?>
                        <h4>Shipping Costs: </h4>
                    <?php endif; ?>
                    <p><?= ( is_numeric($cart_shipping) ) ? wc_price($cart_shipping) : 'DOES NOT INCLUDE SHIPPING' ?></p>
                </div>
            </div>
                
            <div class="total_checkout_info">
                <div class="single_info">
                    <p>SUBTOTAL</p>
                    <p><?= wc_price($cart_subtotal_price)?></p>
                </div>
                <div class="single_info single_shipping_checkout">
                    <p>SHIPPING</p>
                    <p class="single_shipping_checkout_price">
                        <?php if( is_numeric($cart_shipping) ):
                            if( $cart_shipping == '0' ) {
                                echo '---';
                            } else {
                                echo wc_price($cart_shipping);
                            }
                        else:
                            echo 'FREE';
                        endif; ?>
                    </p>
                </div>
                <div class="single_info">
                    <p>INSTALLATION</p>
                    <p><?= wc_price($cart_totals['fee_total'])?></p>
                </div>
            </div>

            <div class="checkout_btn_holder">
                <a href="<?= $checkout_url; ?>" data-barba-prevent="self">Checkout</a>

                <div class="checkout_info">
                    <p>TOTAL</p>
                    <p class="checkout_total_price"><?= wc_price($cart_price)?></p>
                </div>
            </div>
        </div>
    <?php else:
        echo '<p class="empty_cart_message">Your cart is empty.</p>';
    endif;
}

function update_shopping_cart() {
    $is_item_added_to_cart = boolval($_POST['addedToCart']);
    render_shopping_cart_items($is_item_added_to_cart);
    die;
}
add_action('wp_ajax_updateshoppingcart', 'update_shopping_cart'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_updateshoppingcart', 'update_shopping_cart');

function render_shopping_cart() {
    $checkoutPage = ( is_checkout() && empty( is_wc_endpoint_url('order-received')) );
    $total_items = ( WC()->cart->get_cart_contents_count() ) ? WC()->cart->get_cart_contents_count() : 0;

    ?>
    <div class="custom_cart_overlay <?php echo ( $checkoutPage ) ? ' checkout_page' : null; ?>"></div>

    <div class="custom_side_cart <?php echo ( $checkoutPage ) ? ' checkout_page' : null; ?>" data-action="<?php echo site_url() ?>/wp-admin/admin-ajax.php">
        <div class="custom_side_cart_content">
            <div class="cart_header <?php if(is_checkout()): ?>checkout_cart_header<?php endif; ?>">
                <h2 class="title">
                    YOUR CART
                    <span id="cart_total_items_response">(<?= $total_items ?>)</span>
                </h2>

                <div class="close_cart btn dark_outlined" data-text="Close">Close</div>
            </div>

            <div class="items" id="cart_items_response">
                <?php render_shopping_cart_items(); ?>
            </div>
        </div>
    </div>
<?php }

function woo_custom_remove_from_cart() {
    $cart_item_key = $_POST['cartItemKey'];
    WC()->cart->remove_cart_item($cart_item_key);
}
add_action('wp_ajax_woo_custom_remove_from_cart', 'woo_custom_remove_from_cart'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_woo_custom_remove_from_cart', 'woo_custom_remove_from_cart');

function update_cart_total_items() {
    $total_items = ( WC()->cart->get_cart_contents_count() ) ? WC()->cart->get_cart_contents_count() : 0;
    echo $total_items;
    die;
}
add_action('wp_ajax_update_cart_total_items', 'update_cart_total_items'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_update_cart_total_items', 'update_cart_total_items');