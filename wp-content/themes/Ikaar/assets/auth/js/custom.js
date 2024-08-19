// for sticky header
jQuery(window).scroll(function () {
    if (jQuery(window).scrollTop() >= 150) {
        jQuery('body').addClass('header-sticky');
    }
    else {
        jQuery('body').removeClass('header-sticky');
    }
});

jQuery(document).ready(function(e) {
    jQuery(".toggle-menu-icon").click(function() {    
      //alert("alert");
      jQuery(this).toggleClass("activate");
      jQuery(".dashboard-menu").toggleClass("show-menu");
   });  
    
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
 
