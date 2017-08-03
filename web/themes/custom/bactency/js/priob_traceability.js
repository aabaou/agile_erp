(function($, Drupal, drupalSettings) {
    "use strict";
    Drupal.behaviors.priob_traceability = {
        attach: function(context, settings) {

            function setShowMore(context) {
                var leftHeight = $('.path-traceability .left', context).height();
                var rightHeight = $('.path-traceability .right', context).height();

                if (leftHeight > rightHeight) {
                    $('.product-tips', context).before('<div class="show-more"><strong>' + Drupal.t('Show more') + '</strong></div>').hide();
                    $('.show-more', context).click(function () {
                        $(this).remove();
                        $('.product-tips').toggle('fast');
                    });
                }
                else {
                    if ($('.show-more', context).length) {
                        $('.show-more', context).remove();
                        $('.product-tips', context).show();
                    }
                }
            }


            $( window ).resize(function(context) {
                $('.show-more', context).remove();
                $('.product-tips', context).show();

                setShowMore();
            });

            setShowMore(context);
        }
    };

})(jQuery, Drupal, drupalSettings);
