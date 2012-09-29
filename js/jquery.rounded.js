/*
* jQuery Rounded plugin
*
* @version  1.0
* @author   Jan Javorek
*/

(function($){

  $.fn.rounded = function(radius) {
    if (typeof radius == 'number') {
      radius = [radius, radius, radius, radius]; // clockwise
    }
  
    if ($.browser.mozilla) {
      $(this).css({
        // mozilla
        '-moz-border-radius-topleft': radius[0],
        '-moz-border-radius-topright': radius[1],
        '-moz-border-radius-bottomright': radius[2],
        '-moz-border-radius-bottomleft': radius[3],
      });
    } else if ($.browser.webkit) {
      $(this).css({
        // webkit
        '-webkit-border-top-left-radius': radius[0],
        '-webkit-border-top-right-radius': radius[1],
        '-webkit-border-bottom-right-radius': radius[2],
        '-webkit-border-bottom-left-radius': radius[3],
      });
    }

    $(this).css({
      // css3
      'border-top-left-radius': radius[0],
      'border-top-right-radius': radius[1],
      'border-bottom-right-radius': radius[2],
      'border-bottom-left-radius': radius[3]
    });
      
    return this;
  }
  
})(jQuery);

