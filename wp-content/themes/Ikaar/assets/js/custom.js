// for sticky header
jQuery(window).scroll(function () {
    if (jQuery(window).scrollTop() >= 150) {
        jQuery('body').addClass('header-sticky');
    }
    else {
        jQuery('body').removeClass('header-sticky');
    }
});

jQuery(document).ready(function() {

  // for toggle menu
  jQuery('.hamburger-nav').click(function() {
      jQuery('body').toggleClass('menu-open');
  });
  jQuery('.hamburger-nav-close').click(function() {
      jQuery(' body').removeClass('menu-open');
  });
});
 

jQuery(document).ready(function() {

    jQuery('.testimonial-slider').slick({
       slidesToShow: 1,
       slidesToScroll: 1,
     });




     jQuery('.top-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.bottom-slider'
      });
      jQuery('.bottom-slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.top-slider',
        dots: false,
        arrows: false,
        focusOnSelect: true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 4,
            }
          },
          {
            breakpoint: 420,
            settings: {
              slidesToShow: 3,
            }
          }
        ]
      });

    });