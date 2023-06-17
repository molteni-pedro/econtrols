/**
 * @file
 * Vegas jQuery Plugin Drupal Integration.
 */

(function ($) {

/**
 * Drupal Disqus behavior.
 */
Drupal.behaviors.vegas = {
  attach: function (context, settings) {
    var vegas = settings['vegas'] || [];
    if (vegas) {
      $('body', context).once('vegas').vegas(vegas);
    }
  }
};

})(jQuery);
