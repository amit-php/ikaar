<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
   <meta charset="<?php bloginfo('charset'); ?>" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <?php $fav_icon = get_theme_value('driverite_fav_icon');
   if (!empty($fav_icon)) { ?>
      <link rel="icon" type="image/x-icon" href="<?php echo $fav_icon; ?>">
   <?php } ?>
   <?php wp_head(); ?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
      integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>

<body <?php body_class(); ?>>

   <!-- header section start -->
   <?php
   if (is_page(374) || is_page(113) || is_page(3) || is_page(477) || is_singular('property') || is_tax('property_type') || is_tax('property_location')) {
      $class = "inner-header";
   } else {
      $class = "";
   }
   ?>
   <header class="main-header <?= $class; ?>">
      <div class="container container-custome">
         <div class="header-row d-flex justify-content-between position-relative align-items-center">

            <?php $driverite_header_logo = get_theme_value('driverite_header_logo');
            $driverite_header_right_user_img_link = get_theme_value('driverite_header_right_user_img_link');
            if ($driverite_header_logo != "") { ?>
               <div class="logo-wrap"><a href="<?php echo site_url(); ?>"><img src="<?php echo $driverite_header_logo; ?>"
                        alt=""></a></div>
            <?php } ?>
            <div class="left-col">
               <div class="hamburger-nav">
                  <span></span>
                  <span></span>
                  <span></span>
               </div>
               <div class="menu-wrap">
                  <?php wp_nav_menu(array('theme_location' => 'primary_left', 'menu_class' => 'nav', )); ?>
               </div>
            </div>
            <div class="right-col d-flex align-items-center">
               <div class="menu-wrap">
                  <?php wp_nav_menu(array('theme_location' => 'primary_right', 'menu_class' => 'nav', )); ?>
               </div>
               <?php if (is_user_logged_in()) {
                  $user = wp_get_current_user();
                 $profile_img_id=get_user_meta( $user->ID, '_profile_image_user', true );
                 $profile_img=wp_get_attachment_image_url($profile_img_id,'thumbnail');
                 $default_img = get_theme_value('user_default_images');
                 $user_role = $user->roles[0];

                  $user_name = $user->user_firstname;
                  ?>
                  <div class="login-wrap">
                     <?php if ($user_role == 'agent') { ?>
                        <a href="<?php echo get_theme_value('agent_dashboard_link'); ?>" class="d-flex">
                           <div class="icon-wrap"><img src="<?php if(!empty($profile_img)){ echo $profile_img ;} else{ echo $default_img; }?>" alt="" class="rounded" >
                           </div>
                           <div class="name-wrap">
                              <?php echo $user_name; ?>
                           </div>
                        </a>
                     <?php } else { ?>
                        <a href="<?php echo get_theme_value('buyer_dashboard_link'); ?>" class="d-flex">
                           <div class="icon-wrap"><img src="<?php if(!empty($profile_img)){ echo $profile_img ;} else{ echo $default_img; } ?>" alt="" class="rounded">
                           </div>
                           <div class="name-wrap">
                              <?php echo $user_name; ?>
                           </div>
                        </a>
                     <?php } ?>
                  </div>
                  <?php
               } else { ?>
                  <div class="login-wrap">
                     <a href="<?php echo get_theme_value('login_url'); ?>"><img
                           src="<?php echo get_theme_value("without_login_logo"); ?>" alt=""></a>

                  </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </header>
   <div class="mobile-menu">
      <div class="container">
         <div class="top-row">
            <?php $driverite_header_logo = get_theme_value('driverite_header_logo');
            if ($driverite_header_logo != "") { ?>
               <div class="logo-wrap"><a href=""><img src="<?php echo $driverite_header_logo; ?>" alt=""></a></div>
            <?php } ?>
            <div class="hamburger-nav-close">
               <span></span>
               <span></span>
               <span></span>
            </div>
         </div>
         <div class="mobile-menu-inner">
            <?php wp_nav_menu(array('theme_location' => 'mobile_menu')); ?>
         </div>
      </div>
   </div>
   <!-- header section end -->
 