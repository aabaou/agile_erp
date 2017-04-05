(function($, Drupal, drupalSettings) {
    "use strict";
    Drupal.behaviors.priob_miab = {
        attach: function() {
            $('#edit-message').keyup(function(){
                $('.particulars').removeClass('hidden');
            })
        }
    };

})(jQuery, Drupal, drupalSettings);
