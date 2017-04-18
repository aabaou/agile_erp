(function($, Drupal, drupalSettings) {
    "use strict";
    Drupal.behaviors.magnific_popup = {
        attach: function(context, settings) {
            // Setup gallery items.
            $(context).find('#priob-live-the-moment-form').once('mfp-processed').each(function() {
                $(this).magnificPopup({
                    delegate: 'a.popup',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    image: {
                        titleSrc: 'title'
                    }
                });
            });

            $(context).find('.priob-content .product-image').once('mfp-processed').each(function() {
                $(this).magnificPopup({
                    delegate: 'a.popup',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    image: {
                        titleSrc: 'title'
                    }
                });
            });
        }
    };

})(jQuery, Drupal, drupalSettings);
