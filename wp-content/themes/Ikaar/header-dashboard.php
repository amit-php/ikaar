<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <?php $fav_icon = get_theme_value('driverite_fav_icon');
   if (!empty($fav_icon)) { ?>
      <link rel="icon" type="image/x-icon" href="<?php echo $fav_icon; ?>">
   <?php } ?>
   
   <!-- Required meta tags -->

   <!-- <title>My Account</title> -->

   <link href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/bootstrap.min.css" rel="stylesheet">
   <link href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/all.min.css" rel="stylesheet">
   <link href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/slick.css" rel="stylesheet" type="text/css">
   <link href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/slick-theme.css" rel="stylesheet"
      type="text/css">
   <link href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/owl.carousel.min.css" rel="stylesheet">
   <link href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/owl.theme.default.min.css" rel="stylesheet">
   <link href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/custom.css" rel="stylesheet" type="text/css">

   <script src="<?php echo get_template_directory_uri(); ?>/assets/auth/js/jquery.min.js"></script>
   <script src="<?php echo get_template_directory_uri(); ?>/assets/auth/js/bootstrap.bundle.min.js"></script>
   <script src="<?php echo get_template_directory_uri(); ?>/assets/auth/js/slick.min.js"></script>
   <script src="<?php echo get_template_directory_uri(); ?>/assets/auth/js/owl.carousel.min.js"></script>
   <script src="<?php echo get_template_directory_uri(); ?>/assets/auth/js/custom.js"></script>
</head>
<header class="main-header">
   <div class="container container-custome">
      <div class="header-row d-flex justify-content-between position-relative align-items-center">
         <div class="logo-wrap"><a href="<?php echo site_url(); ?>"><img
                  src="<?php echo get_template_directory_uri(); ?>/assets/auth/images/logo.svg" alt=""></a></div>
         <div class="left-col">
            <div class="hamburger-nav">
               <span></span>
               <span></span>
               <span></span>
            </div>
            <div class="menu-wrap">
               <!-- <ul class="nav">
                   <li><a href="">Home</a></li>
                   <li><a href="">About Us</a></li>
                   <li><a href="">Guide</a></li>
                </ul> -->
               <?php wp_nav_menu(array('theme_location' => 'primary_left', 'menu_class' => 'nav', )); ?>
            </div>
         </div>
         <div class="right-col d-flex align-items-center">
            <div class="menu-wrap">
               <!-- <ul class="nav">
                   <li><a href="">Services</a></li>
                   <li><a href="">Listing</a></li>
                   <li><a href="">Contact us</a></li>
                </ul> -->
               <?php wp_nav_menu(array('theme_location' => 'primary_right', 'menu_class' => 'nav', )); ?>
            </div>

            <?php if (is_user_logged_in()) {
               $user = wp_get_current_user();
               $user_role = $user->roles[0];
               $user_name = $user->user_firstname;
               $profile_img_id=get_user_meta( $user->ID, '_profile_image_user', true );
               $profile_img=wp_get_attachment_image_url($profile_img_id,'thumbnail');
               $default_img=get_theme_value('user_default_images');
           
               ?>
               <div class="login-wrap">
                  <?php if ($user_role == 'agent') { ?>
                     <a href="<?php echo get_theme_value('agent_dashboard_link'); ?>" class="d-flex">
                        <div class="icon-wrap"><img src="<?php 
                        if(!empty($profile_img)){ echo $profile_img ;} else{ echo $default_img; } ?>" alt="" class="rounded">
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