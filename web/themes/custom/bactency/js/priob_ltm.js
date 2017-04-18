(function($, Drupal, drupalSettings) {
    "use strict";
    Drupal.behaviors.priob_ltm = {
        attach: function() {
            $('input[type=file]').change(function(){
                $('.particulars').removeClass('hidden');
            });

            $(window).resize(function(){
                placeShowRandom();
            });
            placeShowRandom();
            // hide it before it's positioned
            $('#show-random').css('display','inline');
        }
    };

    function placeShowRandom() {
        var windHeight = $(window).height();
        var footerHeight = $('#show-random').height();
        var offset = parseInt(windHeight) - parseInt(footerHeight);
        $('#show-random').css('top',offset);

        var regionWidth = parseInt($('.region-content').width());
        $('#show-random').css('width',regionWidth);
    }

})(jQuery, Drupal, drupalSettings);
