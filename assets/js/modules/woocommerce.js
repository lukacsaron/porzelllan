(function($) {
    'use strict';

    $(document).ready(function () {
        eltdInitQuantityButtons();
        eltdInitSelect2();
        eltdInitSingleProductLightbox();
    });

    function eltdInitQuantityButtons() {

        $(document).on( 'click', '.eltd-quantity-minus, .eltd-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.parent().siblings('.eltd-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('eltd-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(1);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
            inputField.trigger( 'change' );

        });

    }

    function eltdInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length ||  $('#calc_shipping_country').length ) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();

        }

    }


    /*
     ** Init Product Single Pretty Photo attributes
     */
    function eltdInitSingleProductLightbox() {
        var item = $('.eltd-woocommerce-single-page .images .woocommerce-product-gallery__image');

        if(item.length) {
            item.children('a').attr('data-rel', 'prettyPhoto[product-gallery]');

            if (typeof eltd.modules.common.eltdPrettyPhoto === "function") {
                eltd.modules.common.eltdPrettyPhoto();
            }
        }
    }


})(jQuery);