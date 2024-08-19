<?php
//Template Name:Dashboard Agent
get_header('dashboard');
//$current_user = wp_get_current_user();
$page_id = get_queried_object_id();
$user_id = get_current_user_id();
$week_start_date = date('Y-m-d', strtotime('last sunday'));
$endDate = date('Y-m-d', strtotime('this saturday'));
if (isset($_POST['cpisub'])) {
   $image = $_FILES['cpiimage'];
   if ($image) {
      $image_type = $image['type'];
      $currect_format = array("image/jpeg", "image/jpg", "image/png");
      if (in_array($image_type, $currect_format)) {
         //echo "Match found";

         $attachmentID = (string) image_upload($image);
         if (!empty($attachmentID)) {
            update_user_meta($user_id, '_profile_image_user', $attachmentID);
         }
      } else {
         echo "Format not matched";
      }
   }
}
$userImagID = get_user_meta($user_id, '_profile_image_user', true);
if ($userImagID) {
   $userImgLink = wp_get_attachment_image_url($userImagID, "thumbnail");
} else {
   $userImgLink = get_theme_value('user_default_images');
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<main>
   <div class="dashbord-section common-padding">
      <div class="container">
         <div class="dashbord-inner-row align-items-start d-flex">
            <?php get_template_part('/agent-dasbord/dashboard_menu_agent'); ?>
            <div class="dashboard-info">
               <div class="my-account-section">

                  <div class="profile-picture">
                     <a href="javascript:void(0)" onclick="openModel()">
                        <image src="<?php echo $userImgLink; ?>" class="prfile-pic"
                           alt="<?php echo esc_html($current_user->user_firstname); ?>">
                     </a>
                  </div>

                  <div class="title-heading">
                     <h1>
                        <?php echo get_theme_value('welcome_text'); ?>
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
                        <?php $edit_button_title = get_theme_value('edit_btn_agent');
                        $edit_btn_link = get_theme_value('edit_url_agent');
                        if (!empty($edit_button_title)) { ?>
                           <div class="button-row">
                              <a href="<?php echo $edit_btn_link; ?>" class="btn">
                                 <?php echo $edit_button_title; ?>
                              </a>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="chart-box-wraper">
                     <div class="row">
                        <div class="col-xl-4 chart-box-item col-md-6">
                           <?php
                           $totlViewperweek = get_total_view_per_week($user_id, "view", $week_start_date, $endDate);
                           $totlavies = [];
                           $total_view = [];
                           foreach ($totlViewperweek as $item) {
                              $dayOfWeek = date("D", strtotime($item['week_start_date']));
                              $totlavies[$dayOfWeek] = $item['views'];
                              $total_view[] = $item['views'];
                           }
                           $number_of_view = array_sum($total_view);
                           ?>
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span>
                                    <?php echo $number_of_view; ?>
                                 </span>
                                 <h5>Total Viewed Properties</h5>
                              </div>
                              <div class="image-holder">
                                 <canvas id="viewsChart" width="400" height="200"
                                    style="background-color: #FCEBD4"></canvas>
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-4 chart-box-item col-md-6">
                           <?php
                           $totlEnqperweek = get_total_view_per_week($user_id, "enq", $week_start_date, $endDate);
                           $totlaEnq = [];
                           $total_Enq = [];
                           foreach ($totlEnqperweek as $item) {
                              $dayOfWeek = date("D", strtotime($item['week_start_date']));
                              $totlaEnq[$dayOfWeek] = $item['views'];
                              $total_Enq[] = $item['views'];
                           }
                           $number_of_enq = array_sum($total_Enq);
                           ?>
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span>
                                    <?php echo $number_of_enq; ?>
                                 </span>
                                 <h5>Total Interested Properties</h5>
                              </div>
                              <div class="image-holder">
                                 <canvas id="EnqChart" width="400" height="200"
                                    style="background-color: #FCEBD4"></canvas>
                              </div>
                           </div>
                        </div>
                        <div class="col-xl-4 chart-box-item col-md-6">
                           <?php
                           $totlfavperweek = get_total_view_per_week($user_id, "fav", $week_start_date, $endDate);
                           $totlaFav = [];
                           $total_Fav = [];
                           foreach ($totlfavperweek as $item) {
                              $dayOfWeek = date("D", strtotime($item['week_start_date']));
                              $totlaFav[$dayOfWeek] = $item['views'];
                              $total_Fav[] = $item['views'];
                           }
                           $number_of_fav = array_sum($total_Fav);
                           ?>
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span>
                                    <?php echo $number_of_fav; ?>
                                 </span>
                                 <h5>Total Favorite Properties</h5>
                              </div>
                              <div class="image-holder">
                                 <canvas id="FavChart" width="400" height="200"
                                    style="background-color: #FCEBD4"></canvas>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xl-4 chart-box-item col-md-6">
                        <?php
                           $totalDownloadperWeek= get_total_view_per_week($user_id, "download", $week_start_date, $endDate);
                           $totlaDownload = [];
                           $total_Download = [];
                           foreach ($totalDownloadperWeek as $item) {
                              $dayOfWeek = date("D", strtotime($item['week_start_date']));
                              $totlaDownload[$dayOfWeek] = $item['views'];
                              $total_Download[] = $item['views'];
                           }
                           $number_of_download = array_sum($total_Download);
                           ?>
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span><?php echo $number_of_download ; ?></span>
                                 <h5>Total Download Properties</h5>
                              </div>
                              <div class="image-holder">
                              <canvas id="DownloadChart" width="400" height="200"
                                    style="background-color: #f0f0f1;"></canvas>
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
                           <?php
                           $totlgmailperweek = get_total_view_per_week($user_id, "gmail", $week_start_date, $endDate);
                           $totlaGmail = [];
                           $total_Gmail = [];
                           foreach ($totlgmailperweek as $item) {
                              $dayOfWeek = date("D", strtotime($item['week_start_date']));
                              $totlaGmail[$dayOfWeek] = $item['views'];
                              $total_Gmail[] = $item['views'];
                           }
                           $number_of_gmail = array_sum($total_Gmail);
                           ?>
                           <div class="chart-box">
                              <div class="title-box d-flex align-items-center">
                                 <span>
                                    <?php echo $number_of_gmail; ?>
                                 </span>
                                 <h5>Total Shared in Email</h5>
                              </div>
                              <div class="image-holder">
                                 <canvas id="GmailChart" width="400" height="200"
                                    style="background-color: #f0f0f1;"></canvas>
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
<!-- Modal -->
<div class="profile-image-modal">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <h4 class="modal-title" id="exampleModalLabel">Update your profile picture</h4>
            <form method="POST" action="" enctype="multipart/form-data">
               <div class="form-row"><input type="file" name="cpiimage"></div>
               <input type="submit" name="cpisub" lable="upload" class="btn">
            </form>
            <a href="javascript:void(0)" onclick="hideModel()">
               <span aria-hidden="true">&times;</span></a>
         </div>
      </div>
   </div>
</div>
</div>
<script>
   var viewsByDay = <?php echo json_encode($totlavies); ?>;
   var ctx = document.getElementById('viewsChart').getContext('2d');
   var viewsChart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: Object.keys(viewsByDay),
         datasets: [{
            label: 'Number of Views',
            data: Object.values(viewsByDay),
            backgroundColor: 'rgba(219,176,139)',
            borderColor: 'rgba(219,176,139)',
            borderWidth: 1
         }]
      },
      options: {
         scales: {
            y: {
               beginAtZero: true,
            }
         }
      }
   });
   //favourite chart
   var viewsByDay = <?php echo json_encode($totlaFav); ?>;
   var ctx = document.getElementById('FavChart').getContext('2d');
   var viewsChart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: Object.keys(viewsByDay),
         datasets: [{
            label: 'Number of Favourite',
            data: Object.values(viewsByDay),
            backgroundColor: 'rgba(219,176,139)',
            borderColor: 'rgba(219,176,139)',
            borderWidth: 1
         }]
      },
      options: {
         scales: {
            y: {
               beginAtZero: true,
            }
         }
      }
   });
   //enq chart
   //favourite chart
   var viewsByDay = <?php echo json_encode($totlaEnq); ?>;
   var ctx = document.getElementById('EnqChart').getContext('2d');
   var viewsChart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: Object.keys(viewsByDay),
         datasets: [{
            label: 'Number of Favourite',
            data: Object.values(viewsByDay),
            backgroundColor: 'rgba(219,176,139)',
            borderColor: 'rgba(219,176,139)',
            borderWidth: 1
         }]
      },
      options: {
         scales: {
            y: {
               beginAtZero: true,
            }
         }
      }
   });

   //Gmail chart
   var viewsByDay = <?php echo json_encode($totlaGmail); ?>;
   var ctx = document.getElementById('GmailChart').getContext('2d');
   var viewsChart = new Chart(ctx, {
      type: 'line',
      data: {
         labels: Object.keys(viewsByDay),
         datasets: [{
            label: 'Number of Favourite',
            data: Object.values(viewsByDay),
            backgroundColor: 'rgba(219,176,139)',
            borderColor: 'rgba(219,176,139)',
            borderWidth: 1
         }]
      },
      options: {
         scales: {
            y: {
               beginAtZero: true,
            }
         }
      }
   });

   //download chart
  var viewsByDay = <?php echo json_encode($totlaDownload); ?>;
   var ctx = document.getElementById('DownloadChart').getContext('2d');
   var viewsChart = new Chart(ctx, {
      type: 'line',
      data: {
         labels: Object.keys(viewsByDay),
         datasets: [{
            label: 'Number of Favourite',
            data: Object.values(viewsByDay),
            backgroundColor: 'rgba(219,176,139)',
            borderColor: 'rgba(219,176,139)',
            borderWidth: 1
         }]
      },
      options: {
         scales: {
            y: {
               beginAtZero: true,
            }
         }
      }
   });
</script>
<script>
   //share with gmail
   function openModel() {
      jQuery("#exampleModal").modal("show");
      return false;

   }
   function hideModel() {
      jQuery("#exampleModal").modal("hide");
      return false;
   }
</script>
<?php get_footer(); ?>