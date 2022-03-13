(function ($) {
    let $awcfeRadioPriceFieldLabels = $('.awcfe_radio_field.awcfe_price_field input');

    $awcfeRadioPriceFieldLabels.each(function(){
        let $price = $(this).data('optionprice');
        $(this).next().wrapInner('<div class="label_name"></div>');
        $(this).next().append('<div class="label_cost">$ '+$price+'</div>');
    });

    //Custom cloned shipping methods from WC order table
    let $shippingMethodsCopy = $('.shipping_methods_copy');
    let $shippingMethods = $('.woocommerce-shipping-totals td ul li').children();
    $shippingMethodsCopy.append($shippingMethods.clone());
    $shippingMethodsCopy.find('input').remove();
    $shippingMethodsCopy.find('label').each(function(index){
        $(this).addClass('custom_radio_btn');
        if( index === 0 ) {
            $(this).addClass('active');
        }

        let $priceTxt = $(this).find('.amount').text();
        $(this).find('.amount').remove();
        let $labelTxt = $(this).text();
        $(this).text('');

        $(this).append(
            '<span class="label_name">'+$labelTxt+'</span>'+
            '<span class="label_cost">'+$priceTxt+'</span>'
        )
    });

    let $checkedShipping = $('.woocommerce-shipping-methods input:checked').attr('id');
    $shippingMethodsCopy.find('label[for="'+$checkedShipping+'"]').addClass('active');

    //On original shipping method radio button change
    $('#order_review').on('change','input[type=radio]', function () {
        let $checkedShipping = $('.woocommerce-shipping-methods input:checked').attr('id');
        $shippingMethodsCopy.find('label').removeClass('active');
        $shippingMethodsCopy.find('label[for="'+$checkedShipping+'"]').addClass('active');
    });
    //Custom cloned shipping methods from WC order table END

    $("#ship-to-different-address-checkbox").change(function () {
        $(".shipping_address select").select2({
            // allowClear: true,
            width: '100%',
            // // selectOnClose: true,
            // placeholder : placeHolder,
            // dropdownPosition: 'below',
        });
    });

    // Change tabs on checkoout page
    let $checkoutStepChanger = $('.checkout_nav ul li, .checkout_buttons_holder .btn');
    $checkoutStepChanger.on('click', function(){
        window.scrollTo({ top: 0, behavior: 'smooth' });
        var currentStep = $(this).data('step');
        $('.single_step').fadeOut('fast');
        $('.checkout_nav ul li').removeClass('active');

        if(currentStep == "1"){
            $('.checkout_nav ul li[data-step=1]').addClass('active');
            $('.billing_box').fadeIn('fast');
        }

        if(currentStep == "2"){
            $('.checkout_nav ul li[data-step=2]').addClass('active');
            $('.shipping_box').fadeIn('fast');
        }

        if(currentStep == "3"){
            $('.checkout_nav ul li[data-step=3]').addClass('active');
            $('#order_review').fadeIn('fast');
        }
    })
    // Change tabs on checkoout page END
})(jQuery);