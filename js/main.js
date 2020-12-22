// Hello.
//
// This is The Scripts used for ___________ Theme
//
//

function main() {

  (function () {
    'use strict';
    $('a.js-scroll-trigger').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top - 40
          }, 900);
          return false;
        }
      }
    }); 
    /*show menu */
    $('.js-scroll-trigger').click(function() {
      $('.navbar-collapse').collapse('hide');
    });
  
    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
      target: '#mainNav',
      offset: 57
    });
  
    // Collapse Navbar
    var navbarCollapse = function() {
      if ($("#mainNav").offset().top > 100) {
        $("#mainNav").addClass("navbar-shrink");
      } else {
        $("#mainNav").removeClass("navbar-shrink");
      }
    };
    $(window).bind('scroll', function () {
      var navHeight = $(window).height() - 900;
      if ($(window).scrollTop() > navHeight) {
        $('.navbar-light').addClass('on');
      } else {
        $('.navbar-light').removeClass('on');
      }

    });
    $('a.nav-link').on('click', function () {
      $('.header-text').addClass('animated fadeInDown delay-1s').one(webkitAnimationEnd,function(){
        $(this).removeClass('animated fadeInDown');
      });
    });

  }());
}
main();
