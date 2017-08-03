/**
 * @file
 * Defines a behavior to automatically set the height for columned divs
 * to the higher div's height in a row.
 * This is to prevent having divs from a row bellow pushed on the side
 * because of a div higher than the others.
 *
 *
 */
(function ($, Drupal, window, document, undefined) {
  Drupal.behaviors.act_news_views_grid = {
    attach: function (context, settings) {
      var mobile_bp = 749;
      var col12w = $('.main-container .row', context).innerWidth();
      var element = '.views-grid';


     function getMaxHeight(selector, context) {


        if (col12w > mobile_bp) {
            // Reset height.
            $(selector, context).css('height', 'initial');

           // Calculate max height.
            var maxHeight = Math.max.apply(null, $(selector, context).map(function (){
              return $(this).height();
            }));


           // Set new height.
            $(selector, context).css('height', maxHeight);
        }
      }

     $(window)
        .load(function() {
          getMaxHeight(element, context);
        })
        .resize(function() {
            getMaxHeight(element, context);
        })
        .ajaxComplete(function() {
            getMaxHeight(element, context);
        });
    }
  }
})(jQuery, Drupal, this, this.document);