/**
 * @file
 * Sets a scroll animation to the top of the page when clicking on the "Back to the top" link.
 * The "back to the top" link follows the page's scroll when the block is dynamic.
 *
 */
(function ($, Drupal) {
  Drupal.behaviors.act_link_back_top = {
    attach: function (context, settings) {

      $(".act-link-back-top").each(function(){
        var position=$("a",this).attr('data-position');

        if(position === 'dynamic') {

          var $this = $(this),
              element_height=$this.height(),
              page = $(".region-content").offset();

          $this.hide();

          $(window).scroll(function () {

            var window_height=window.innerHeight,
                element_mid_screen= window_height/2 - element_height/2;

            if ($(window).scrollTop() >= page.top ) {

              $this.show();
              $this.css({
                'position':'fixed',
                top: element_mid_screen
              });

            }else{
              $this.hide();
            }
          });
        }
      });


      $(".act-link-back-top a").click(function(event){
		event.preventDefault();
        var duration = parseInt($(this).attr('data-duration'));

        if(duration  !== '' ){

          $("html,  body").animate({scrollTop:0},duration);

        }else{
          $("html,  body").animate({scrollTop:0},1500);
        }

      });

    }
  }
})(jQuery, Drupal);