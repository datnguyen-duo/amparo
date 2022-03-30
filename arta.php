<?php

/**
 * Plugin Name: Arta Shipping
 * Description: Custom Shipping Method for WooCommerce
 * Version: 1.0.0
 * Author: Duo Studio
 * Author URI: https://duo-studio.co/
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html

 */

if (!defined('WPINC')) {

    die;
}

add_filter('woocommerce_shipping_methods', 'add_UPS_number_shipping');
function add_UPS_number_shipping($methods)
{
    $methods['arta'] = 'Arta_Shipping_Method';
    return $methods;
}
add_action('woocommerce_shipping_init', 'Arta_Shipping_Method');
function Arta_Shipping_Method()
{
    include_once('ArtaAPI.php');
    class Arta_Shipping_Method extends WC_Shipping_Method
    {
         /**
         * Constructor for your shipping class
         *
         * @access public
         * @return void
         */
        public function __construct($instance_id = 0)
        {
            $this->id = 'arta';
            $this->instance_id = absint($instance_id);
          
            $this->method_title       = __('Arta Shipping', 'arta');
            $this->method_description = __('Custom Shipping Method for Arta', 'arta');
           
            $this->supports = array(
                'shipping-zones',
                'instance-settings',
                'instance-settings-modal',
            );

            $this->init();

            $this->enabled = isset($this->settings['enabled']) ? $this->settings['enabled'] : 'yes';
            $this->title = isset($this->settings['title']) ? $this->settings['title'] : __('Arta Shipping', 'arta');

            $this->api_key = isset($this->settings['api_key']) ? $this->settings['api_key'] : __('', 'arta');

            $this->admin_email = isset($this->settings['admin_email']) ? $this->settings['admin_email'] : __('', 'arta');

            $this->admin_name = isset($this->settings['admin_name']) ? $this->settings['admin_name'] : __('', 'arta');

            $this->admin_phone = isset($this->settings['admin_phone']) ? $this->settings['admin_phone'] : __('', 'arta');

            
        }

        /**
         * Init your settings
         *
         * @access public
         * @return void
         */
        function init()
        {
            
            // Load the settings API
            //include_once('ArtaAPI.php');
            $this->init_form_fields();
            $this->init_settings();

            // Save settings in admin if you have any defined
            add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
           
        }
        /*** subscribe to admin email address with all notifications types */

        function process_admin_options()
        {
            parent::process_admin_options();

            $arta_notification_email = get_option('arta_notification_email');

            $email = $this->get_option('admin_email');
            $api_key = $this->get_option('api_key');

            if ($arta_notification_email == false) {
                $this->arta_api = new ArtaAPI($api_key);
                $response = $this->arta_api->create_subscription($email);
            } else {
                $data = json_decode($arta_notification_email);

                if ($data->email != $email || $data->api_key != $api_key) {
                    $this->arta_api = new ArtaAPI($api_key);
                    $response = $this->arta_api->create_subscription($email);
                }
            }

            if (isset($response->errors)) {
                //print_R($response);
                //die(00);
            }

            $data = ['email' => $email, 'api_key' => $api_key];

            if (!$arta_notification_email) {
                add_option('arta_notification_email', json_encode($data));
            } else {
                update_option('arta_notification_email', json_encode($data));
            }
        }
        /**
         * Define settings field for this shipping
         * @return void 
         */
        function init_form_fields()
        {

            $this->form_fields = array(

                'api_key' => array(
                    'title' => __('Api key', 'arta'),
                    'type' => 'text',
                    'description' => __('API key for the arta api', 'arta'),
                    'default' => __('', 'arta')
                ),

                'enabled' => array(
                    'title' => __('Enable', 'arta'),
                    'type' => 'checkbox',
                    'description' => __('Enable this shipping.', 'arta'),
                    'default' => 'yes'
                ),

                'title' => array(
                    'title' => __('Title', 'arta'),
                    'type' => 'text',
                    'description' => __('Title to be display on site', 'arta'),
                    'default' => __('Arta Shipping', 'arta')
                ),

                'admin_name' => array(
                    'title' => __('Name ', 'arta'),
                    'type' => 'text',
                    'description' => __('Name of the person will be used on ARTA shipping when product purchased from admin', 'arta'),
                    'default' => ''
                ),

                'admin_phone' => array(
                    'title' => __('Phone number ', 'arta'),
                    'type' => 'text',
                    'description' => __('Phone number for ARTA pickup for the products directly created by admin', 'arta'),
                    'default' => ''
                ),
                'admin_email' => array(
                    'title' => __('Email ', 'arta'),
                    'type' => 'text',
                    'description' => __('Email can be used for ARTA notifications and for the delivery of products directly created from admin', 'arta'),
                    'default' => ''
                )

            );
        }

        public function calculate_shipping($cart = array())
        {
            include_once('ArtaAPI.php');
            //$cart = WC()->shipping->get_packages()[0]; //patch
            $this->arta_api = new ArtaAPI($this->api_key);
            $weight = 0;

            //$destination = $cart['destination'];
            $destination = $cart['destination'];
            
            $currency = get_woocommerce_currency();
            /*** can not able to get the store currency */
            $currency = 'USD';

            $logged_in_user_id = get_current_user_id();

            
            //print_R(wp_get_current_user());die(0000);
            
            //if ($destination['address'] == '' || $destination['postcode'] == '' || $destination['country'] == '') {
            if ($destination['city'] == '' || $destination['postcode'] == '' || $destination['country'] == '') {    
                return $cart;
            }

            foreach ($cart['contents'] as $item_id => $values) {

                $_product = $values['data'];

                if (!$_product->needs_shipping()) {
                    continue;
                }

                $price = $_product->get_price() * $values['quantity'];
                $weight = (wc_get_weight($_product->get_weight(), 'lbs')) * $values['quantity'];
                $height = $_product->get_height();
                $width = $_product->get_width();
                $length = $_product->get_length();

                if (!$weight) { // Product is missing weight. Using 1lb.
                    $weight = 1 * $values['quantity'];
                }

                if (!$height) { // Product height is missing.
                    $height = 5;
                }

                if (!$width) { // Product width is missing width.
                    $width = 5;
                }

                if (!$length) { // Product length is missing width.
                    $length = 5;
                }

                $product_id = $_product->get_id();

                $post_obj = get_post($product_id);
                $author_id = $post_obj->post_author;

                if (isset($cart['vendor_id']) && $cart['vendor_id']) {

                    $vendor_data = get_user_meta($cart['vendor_id'], 'wcfmmp_profile_settings', true);

                    $store_name = $vendor_data['store_name'];
                    $store_email = $vendor_data['store_email'];
                    $store_phone = $vendor_data['phone'];

                    $street_1 = isset($vendor_data['address']['street_1']) ? $vendor_data['address']['street_1'] : '';
                    $street_2 = isset($vendor_data['address']['street_2']) ? $vendor_data['address']['street_2'] : '';
                    $city     = isset($vendor_data['address']['city']) ? $vendor_data['address']['city'] : '';
                    $zip      = isset($vendor_data['address']['zip']) ? $vendor_data['address']['zip'] : '';
                    $country  = isset($vendor_data['address']['country']) ? $vendor_data['address']['country'] : '';
                    $state    = isset($vendor_data['address']['state']) ? $vendor_data['address']['state'] : '';

                    //print_R($vendor_data);die(000);

                    $contact = ['name' => $store_name, 'email_address' => $store_email, 'phone_number' => $store_phone];

                    $origin = [
                        "address_line_1" => $street_1,
                        "city" =>  $city,
                        "region" => $state,
                        "postal_code" => $zip,
                        "country" => $country
                    ];
                } else {

                    $admin_store_address     = get_option('woocommerce_store_address');
                    $admin_store_address_2   = get_option('woocommerce_store_address_2');
                    $admin_store_city        = get_option('woocommerce_store_city');
                    $admin_store_postcode    = get_option('woocommerce_store_postcode');

                    // The country/state
                    $admin_store_raw_country = get_option('woocommerce_default_country');

                    // Split the country/state
                    $split_country = explode(":", $admin_store_raw_country);

                    // Country and state separated:
                    $admin_store_country = $split_country[0];
                    $admin_store_state   = $split_country[1];

                    $origin = [
                        "address_line_1" => $admin_store_address,
                        "city" =>  $admin_store_city,
                        "region" => $admin_store_state,
                        "postal_code" => $admin_store_postcode,
                        "country" => $admin_store_country
                    ];

                    $contact = ['name' => $this->admin_name, 'email_address' => $this->admin_email, 'phone_number' => $this->admin_phone];
                }

                if (!empty($contact)) {
                    //$origin['contacts'] = [$contact];
                }

                $origin_products[] = [
                    "internal_reference" => "product: $product_id Quantity:". $values['quantity'],
                    "current_packing" => [
                        "no_packing"
                    ],
                    "depth" => $length,

                    "height" => $height,
                    "subtype" => "painting_unframed",
                    "width" => $width,
                    "unit_of_measurement" => "in",
                    "weight" => floor($weight),
                    "weight_unit" => "lb",
                    'value' => $price,
                    'value_currency' => $currency
                ];
            }

            if ($origin['postal_code'] == '' || $origin['country'] == '') {
                return $cart;
            }

            // print_R($destination);die(0000);

            $reference = $store_name . ' quote - datetime '.date("Y-m-d H:i:s");
            //$shipping_notes = 'product - 1';
            $internal_reference = $store_name . ' quote - datetime '.date("Y-m-d H:i:s");

            $arta_destination = [
                "address_line_1" => $destination['address'],
                "city" => $destination['city'],
                "region" => $destination['state'],
                "postal_code" => $destination['postcode'],
                "country" => $destination['country']
            ];

            if ($destination['address1'] != '') {
                $arta_destination['address_line_2'] = $destination['address1'];
            }

            //$arta_destination['contacts'] = [$contact];

            $request = [
                "preferred_quote_types" => [],
                "public_reference" => $reference,
                //"shipping_notes" => $shipping_notes,
                'currency' => $currency,
                "internal_reference" => $internal_reference,
                'destination' => $arta_destination,
                'origin' => $origin,
                "insurance" => "arta_transit_insurance",
                'objects' => $origin_products
            ];

            $api_key = $this->get_option('api_key');
            $this->arta_api = new ArtaAPI($api_key);
            try {
                
                $arta_request_body = ['request' => $request];

                //print_R(json_encode($body));
                //die(000);
                $arta_response = $this->arta_api->create_quote_request($arta_request_body);

                //echo '<pre>';
                //print_r($arta_response);
                //echo '</pre>';
                
                $errors = [];

                if (isset($arta_response->errors)) {
                    foreach ($arta_response->errors as $key => $aerrors) {
                        $errors[] = $key . " " . $aerrors;
                    }
                } else {
                    /* if (!$arta_response->bookable->ready) {
                        foreach ($arta_response->bookable->missing as $missed) {
                            $errors[] = implode(" ", explode("_", $missed));
                        }
                    }*/
                }

                if (!empty($errors)) {
                    
                    wc_add_notice("Unfortunately, there has been an issue processing your order. Please try again or contact hello@amparoart.com, and a representative from our team will respond promptly", 'error');
                    //wc_add_notice('Shipment quotation failed - ' . implode(',', $errors), 'error');
                    //return;
                }

                //print_R($arta_response);die(000);

                if (isset($arta_response->status) && $arta_response->status == 'quoted') {
                    foreach ($arta_response->quotes as $quote) {
                        add_option('arta_request_id_'.$quote->id, $arta_response->id);
                        $quotes[$quote->quote_type] = array(
                            'id' => $quote->id,
                            'label' => $this->method_title . ' - ' . $quote->quote_type,
                            'cost' => $quote->total,
                            //'quote_id' => $res->id
                        );
                    }
                    
                    foreach ($quotes as $q) {
                        $this->add_rate($q);
                    }
                }
            } catch (Exception $e) {
            }

           
        }
    }
}

function arta_validate_order($posted)
{
    $packages = WC()->shipping->get_packages();

    $chosen_methods = WC()->session->get('chosen_shipping_methods');

    if (is_array($chosen_methods) && in_array('arta', $chosen_methods)) {

        foreach ($packages as $i => $package) {

            if ($chosen_methods[$i] != "arta") {

                continue;
            }

            //print_R($package);die(000);

            $Arta_Shipping_Method = new Arta_Shipping_Method();
            $weightLimit = (int) $Arta_Shipping_Method->settings['weight'];
            $weight = 0;

            foreach ($package['contents'] as $item_id => $values) {
                $_product = $values['data'];
                $weight = $weight + $_product->get_weight() * $values['quantity'];
            }

            $weight = wc_get_weight($weight, 'kg');

            if ($weight > $weightLimit) {

                $message = sprintf(__('Sorry, %d kg exceeds the maximum weight of %d kg for %s', 'arta'), $weight, $weightLimit, $Arta_Shipping_Method->title);

                $messageType = "error";

                if (!wc_has_notice($message, $messageType)) {

                    wc_add_notice($message, $messageType);
                }
            }
        }
    }
}

add_action('woocommerce_review_order_before_cart_contents', 'arta_validate_order', 10);
add_action('woocommerce_after_checkout_validation', 'arta_validate_order', 10);

add_action('woocommerce_checkout_order_processed', 'action_checkout_order_processed', 10, 3);

add_action('woocommerce_checkout_create_order', 'action_checkout_order_create', 10, 3);

/*** this function updates destination contact  */

function action_checkout_order_create($order){

    $shipping = $order->get_items('shipping');
    $request_ids = [];

    foreach ($order->get_items('shipping') as $item_id => $item) {

        if ($item->get_method_id() == 'arta') {
            $meta_data = $item->get_meta_data();

            foreach ($meta_data as $md) {
                if ($md->key == 'method_slug') {
                    //$request_ids[] = explode('_', $md->value)[0];     
                    $request_ids[] = get_option('arta_request_id_'.$md->value);
                }
            }
        }
    }

    if (empty($request_ids)) {
        return;
    }

    $contact = array();

    //if(isset($order->billing_first_name)){
        $contact['name'] = $order->billing_first_name .' '. $order->billing_last_name;
    //}

    //if(isset($order->billing_phone)){
        $contact['phone_number'] = $order->billing_phone;
    //}

    //if(isset($order->billing_email)){
        $contact['email_address'] = $order->billing_email;
    //}

    /*if(isset($order->shipping_phone)){
        if(isset($order->shipping_first_name)){
            $contact['name'] = $order->shipping_first_name .' '. $order->shipping_last_name;
        }
        $contact['phone_number'] = $order->shipping_phone;
    }

    if(isset($order->shipping_email)){
        $contact['email_address'] = $order->shipping_email;
    }*/

    $data = get_option('arta_notification_email');
    $api_key = json_decode($data)->api_key;

    foreach ($request_ids as $request_id) {

    $arta_api = new ArtaAPI($api_key);
    $data = ['destination' => ['contacts' => [$contact]]];

    $arta_response = $arta_api->update_quote_request_contacts($request_id, $data);

    $errors = [];

        if (isset($arta_response->errors)) {
            foreach ($arta_response->errors as $key => $aerrors) {
                $errors[] = $key . " " . $aerrors;
            }
        }

        if (!$arta_response->bookable->ready) {
            foreach ($arta_response->bookable->missing as $missed) {
                $errors[] = implode(" ", explode("_", $missed));
            }
        }

        if (!empty($errors)) {
            wc_add_notice('The order processed but automatic shipment creation failed, please contact admin', 'error');
            $order->add_order_note('Shipment creation failed - Quote Id - ' . implode(',', $request_ids) . implode(' ', $errors));
        }
    }
}

/*** this function checks if the payment method is cod, it will create shipment other wise skip creating shipment and wait until payment confirmation. */

function action_checkout_order_processed($order_id, $posted_data, $order)
{
    if (isset($posted_data['payment_method']) && $posted_data['payment_method'] != 'cod') return;

    process_shipment($order_id);
}

function process_shipment($order_id)
{
    $order = new WC_Order($order_id);
    $shipping = $order->get_items('shipping');
    $quote_ids = [];

    foreach ($order->get_items('shipping') as $item_id => $item) {

        if ($item->get_method_id() == 'arta') {
            $meta_data = $item->get_meta_data();

            foreach ($meta_data as $md) {
                if ($md->key == 'method_slug') {
                    $quote_ids[] = explode('_', $md->value)[0];
                    //$quote_ids[] = $md->value;
                }
            }
        }
    }

    if (empty($quote_ids)) {
        return;
    }

    include_once('ArtaAPI.php');

    $data = get_option('arta_notification_email');
    $api_key = json_decode($data)->api_key;


    $notes = $posted_data['order_comments'];

    foreach ($quote_ids as $quote_id) {
        $pref = 'Order ID' . $order_id . ' - Quote ID ' . $quote_id;
        $iref = 'Order ID' . $order_id . ' - Quote ID ' . $quote_id;
        $data = ['shipment' => [
            'quote_id' => $quote_id,
            'public_reference' => $pref, 'internal_reference' => $iref,
            'shipping_notes' => $notes
        ]];

        $arta_api = new ArtaAPI($api_key);
        $arta_response = $arta_api->create_shipment($data);

        $errors = [];

        if (isset($arta_response->errors)) {
            foreach ($arta_response->errors as $key => $aerrors) {
                $errors[] = $key . " " . $aerrors;
            }
        }

        if (!empty($errors)) {
            wc_add_notice('The order processed but automatic shipment creation failed, please contact admin', 'error');
            $order->add_order_note('Shipment creation failed - Quote Id - ' . implode(',', $quote_ids) . implode(' ', $errors));
        }
    }
}


/**** after payment complete, it will create shipment */

function arta_woocommerce_payment_complete($order_id)
{
    process_shipment($order_id);
}
add_action('woocommerce_payment_complete', 'arta_woocommerce_payment_complete', 10, 1);