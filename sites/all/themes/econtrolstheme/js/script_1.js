/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document) {

  'use strict';

  // To understand behaviors, see https://drupal.org/node/756722#behaviors
  Drupal.behaviors.my_custom_behavior = {
    attach: function (context, settings) {

      // Place your code here.
      var nav = jQuery('.logomenu');
      jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 120) {
                nav.addClass("f-nav");
            } else {
                nav.removeClass("f-nav");
            }
        });/*
        jQuery(".field-name-field-menuproducto ul li a").on("click", function () {
            var href = jQuery(this).attr("href");
            var hash = href.substr(href.indexOf("#"));
            var pos = jQuery(hash).position().top; 
            jQuery(window).scrollTop(pos);
            return false;
        });*/
        jQuery('.field-name-field-menuproducto ul li a,.menuempresa a').each(function(){
            var href = jQuery(this).attr('href');
            if(jQuery(href).length == 0) jQuery(this).remove();
        });
        jQuery('.field-name-field-menuproducto ul li a,.menuempresa a').click(function() {
            

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            jQuery('html, body').animate({
                scrollTop: jQuery(hash).offset().top - 230
            }, 1000, function() {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });

            // Prevent default anchor click behavior
            return false;
        });        
        jQuery('#block-block-7 p a,.group-fonsblanc h3,#caja_centro_detalles h4,#block-webform-client-block-9616 h2,#block-webform-client-block-5426 h2').click(function() {

            // Using jQuery's animate() method to add smooth page scroll
            jQuery('html, body').animate({
                scrollTop: 0
            }, 1000, function() {

            });

            // Prevent default anchor click behavior
            return false;
        });
        
        
        if(jQuery('.view.view-llistatproductos > .view-content > table.cols-4 > tbody > .row-1 > td').length == 1){
            jQuery('.view.view-llistatproductos > .view-content > table.cols-4').addClass('unelement');
        }
        var srcstring = 'https://e-touch.e-controls.es/'+location.hash.substr(1);
        let newUrl = document.getElementById("iframeetouch");
        if (newUrl !== null) {       console.log(newUrl);
            newUrl.setAttribute("src", srcstring);}
    }
  };

})(jQuery, Drupal, this, this.document);
