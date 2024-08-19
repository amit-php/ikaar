<?php //Template Name:DashboardBuyer
get_header('dashboard');
//$current_user = wp_get_current_user(); 
$page_id=get_queried_object_id();?>

<main>
   <div class="dashbord-section common-padding">
      <div class="container">
         <div class="dashbord-inner-row align-items-start d-flex">
            <?php get_template_part('/buyer-dashboard/dashboard_menu_buyer');?>
            <div class="dashboard-info">
               <div class="my-account-section">
                  <div class="title-heading">
                     <h1><?php echo get_theme_value('welcome_text'); ?>
                        <?php echo esc_html($current_user->user_firstname); ?>!
                     </h1>
                     <p>
                        <?php echo esc_html($current_user->description); ?>
                     </p>
                  </div>
                  <div class="account-details-box">
                     <div class="account-details-inner-row d-flex justify-content-between align-items-center">
                        <div class="account-details-row">
                           <ul>
                              <li class="d-flex">
                                 <div class="left-col">Name:</div>
                                 <div class="right-col">
                                    <?php echo esc_html($current_user->user_firstname) . ' ' . esc_html($current_user->user_lastname); ?>
                                 </div>
                              </li>
                              <li class="d-flex">
                                 <div class="left-col">Email address:</div>
                                 <div class="right-col">
                                    <?php echo esc_html($current_user->user_email); ?>
                                 </div>
                              </li>
                              <li class="d-flex">
                                 <div class="left-col">Phone number:</div>
                                 <div class="right-col">
                                    <?php echo get_user_meta($current_user->ID, "number", true); ?>
                                 </div>
                              </li>
                              <li class="d-flex">
                                 <div class="left-col">Address:</div>
                                 <div class="right-col">
                                    <?php echo get_user_meta($current_user->ID, "address", true); ?>
                                 </div>
                              </li>
                           </ul>
                        </div>
                        <?php $edit_btn=get_post_meta($page_id,'edit_btn',true);
                        if(!empty($edit_btn['title'])){ ?>
                        <div class="button-row">
                             <a href="<?php echo $edit_btn['url']; ?>" class="btn"><?php echo $edit_btn['title']; ?></a>
                        </div>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="chart-box-wraper">
                     <div class="row">
                        <div class="col-xl-4 chart-box-item col-md-6">
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span>50</span>
                                 <h5>Total Viewed Properties</h5>
                              </div>
                              <div class="image-holder">
                                 <img src="<?php echo get_template_directory_uri() ?>/assets/auth/images/chart-1.png"
                                    alt="">
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-4 chart-box-item col-md-6">
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span>35</span>
                                 <h5>Total Intersted Properties</h5>
                              </div>
                              <div class="image-holder">
                                 <img src="<?php echo get_template_directory_uri() ?>/assets/auth/images/chart-1.png"
                                    alt="">
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-4 chart-box-item col-md-6">
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span>50</span>
                                 <h5>Total Favorite Properties</h5>
                              </div>
                              <div class="image-holder">
                                 <img src="<?php echo get_template_directory_uri() ?>/assets/auth/images/chart-1.png"
                                    alt="">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-4 chart-box-item col-md-6">
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span>50</span>
                                 <h5>Total Download Properties</h5>
                              </div>
                              <div class="image-holder">
                                 <img src="<?php echo get_template_directory_uri() ?>/assets/auth/images/chart-2.jpg"
                                    alt="">
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-4 chart-box-item col-md-6">
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span>50</span>
                                 <h5>Total Shared Properties</h5>
                              </div>
                              <div class="image-holder">
                                 <img src="<?php echo get_template_directory_uri() ?>/assets/auth/images/chart-2.jpg"
                                    alt="">
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-4 chart-box-item col-md-6">
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span>50</span>
                                 <h5>Total Shared in Email</h5>
                              </div>
                              <div class="image-holder">
                                 <img src="<?php echo get_template_directory_uri() ?>/assets/auth/images/chart-2.jpg"
                                    alt="">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</main>

<?php get_footer(); ?>