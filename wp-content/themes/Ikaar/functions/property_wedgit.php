<?php
function property_weights_page_callback()
{
   $postid = $_GET["id"];
   if ($postid) {
      $week_start_date = date('Y-m-d', strtotime('last sunday'));
      $endDate = date('Y-m-d', strtotime('this saturday'));
      $userID = get_current_user_id();
      $totlViewperweek = get_total_view_per_week_by_postId($userID, "view", $week_start_date, $endDate, $postid);
      ?>

      <link href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/bootstrap.min.css" rel="stylesheet">

      <link href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/custom.css" rel="stylesheet" type="text/css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script src="<?php echo get_template_directory_uri(); ?>/assets/auth/js/custom.js"></script>
      <div class="dashboard-info">
         <div class="my-account-section">
            <div class="chart-box-wraper">
               <div class="row">
                  <div class="col-xl-4 chart-box-item col-md-6">
                     <?php
                     $totlavies = [];
                     $total_view = [];
                     foreach ($totlViewperweek as $item) {
                        if ($item['chart_type'] === "view") {
                           $dayOfWeek = date("D", strtotime($item['week_start_date']));
                           if (array_key_exists($dayOfWeek, $totlavies)) {
                              $totlavies[$dayOfWeek] += $item['views'];
                           } else {
                              $totlavies[$dayOfWeek] = $item['views'];
                           }
                           $total_view[] = $item['views'];
                        }
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
                           <canvas id="viewsChart" width="400" height="200" style="background-color: #FCEBD4"></canvas>
                        </div>
                     </div>
                  </div>

                  <div class="col-xl-4 chart-box-item col-md-6">
                     <?php
                     $totlaenqs = [];
                     $total_enq = [];
                     foreach ($totlViewperweek as $item) {
                        //print_r($totlViewperweek);
                        if ($item['chart_type'] === "enq") {
                           $dayOfWeek = date("D", strtotime($item['week_start_date']));
                           if (array_key_exists($dayOfWeek, $totlaenqs)) {
                              $totlaenqs[$dayOfWeek] += $item['views'];
                           } else {
                              $totlaenqs[$dayOfWeek] = $item['views'];
                           }
                           $total_enq[] = $item['views'];
                        }
                     }
                     $number_of_enq = array_sum($total_enq);
                     ?>
                     <div class="chart-box">
                        <div class="title-box d-flex align-items-center">
                           <span>
                              <?php echo $number_of_enq; ?>
                           </span>
                           <h5>Total Intersted Properties</h5>
                        </div>
                        <div class="image-holder">
                           <canvas id="EnqChart" width="400" height="200" style="background-color: #FCEBD4"></canvas>
                        </div>
                     </div>
                  </div>

                  <div class="col-xl-4 chart-box-item col-md-6">
                     <?php
                     $totlafvrts = [];
                     $total_fvrt = [];
                     foreach ($totlViewperweek as $item) {
                        //print_r($totlViewperweek);
                        if ($item['chart_type'] === "fav") {
                           $dayOfWeek = date("D", strtotime($item['week_start_date']));
                           if (array_key_exists($dayOfWeek, $totlafvrts)) {
                              $totlafvrts[$dayOfWeek] += $item['views'];
                           } else {
                              $totlafvrts[$dayOfWeek] = $item['views'];
                           }
                           $total_fvrt[] = $item['views'];
                        }
                     }
                     $number_of_fvrt = array_sum($total_fvrt);
                     ?>

                     <div class="chart-box">
                        <div class="title-box d-flex align-items-center">
                           <span>
                              <?php echo $number_of_fvrt; ?>
                           </span>
                           <h5>Total Favorite Properties</h5>
                        </div>
                        <div class="image-holder">
                           <canvas id="FavChart" width="400" height="200" style="background-color: #FCEBD4"></canvas>
                        </div>
                     </div>
                  </div>

               </div>
               <div class="row">
                  <div class="col-xl-4 chart-box-item col-md-6">
                     <?php
                     $totladwnlds = [];
                     $total_dwnld = [];
                     foreach ($totlViewperweek as $item) {
                        //print_r($totlViewperweek);
                        if ($item['chart_type'] === "download") {
                           $dayOfWeek = date("D", strtotime($item['week_start_date']));
                           if (array_key_exists($dayOfWeek, $totladwnlds)) {
                              $totladwnlds[$dayOfWeek] += $item['views'];
                           } else {
                              $totladwnlds[$dayOfWeek] = $item['views'];
                           }
                           $total_dwnld[] = $item['views'];
                        }
                     }
                     $number_of_dwnld = array_sum($total_dwnld);
                     ?>
                     <div class="chart-box">
                        <div class="title-box d-flex align-items-center">
                           <span>
                              <?php echo $number_of_dwnld; ?>
                           </span>
                           <h5>Total Download Properties</h5>
                        </div>
                        <div class="image-holder">
                           <canvas id="DownloadChart" width="400" height="200" style="background-color: #f0f0f1;"></canvas>
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
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/auth/images/chart-2.jpg" alt="">
                        </div>
                     </div>
                     Thank you for creating with WordPress.Version 6.4.2
                  </div>
                  <div class="col-xl-4 chart-box-item col-md-6">
                     <?php
                     $totlagmails = [];
                     $total_email = [];
                     foreach ($totlViewperweek as $item) {
                        //print_r($totlViewperweek);
                        if ($item['chart_type'] === "gmail") {
                           $dayOfWeek = date("D", strtotime($item['week_start_date']));
                           if (array_key_exists($dayOfWeek, $totlagmails)) {
                              $totlagmails[$dayOfWeek] += $item['views'];
                           } else {
                              $totlagmails[$dayOfWeek] = $item['views'];
                           }
                           $total_email[] = $item['views'];
                        }
                     }
                     $number_of_email = array_sum($total_email);
                     ?>
                     <div class="chart-box">
                        <div class="title-box d-flex align-items-center">
                           <span>
                              <?php echo $number_of_email; ?>
                           </span>
                           <h5>Total Shared in Email</h5>
                        </div>
                        <div class="image-holder">
                           <canvas id="GmailChart" width="400" height="200" style="background-color: #f0f0f1;"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         //View chart
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


         //enq chart
         var viewsByDay = <?php echo json_encode($totlaenqs); ?>;
         var ctx = document.getElementById('EnqChart').getContext('2d');
         var viewsChart = new Chart(ctx, {
            type: 'bar',
            data: {
               labels: Object.keys(viewsByDay),
               datasets: [{
                  label: 'Number of Enquiry',
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
         var viewsByDay = <?php echo json_encode($totlafvrts); ?>;
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


         //download chart
         var viewsByDay = <?php echo json_encode($totladwnlds); ?>;
         var ctx = document.getElementById('DownloadChart').getContext('2d');
         var viewsChart = new Chart(ctx, {
            type: 'line',
            data: {
               labels: Object.keys(viewsByDay),
               datasets: [{
                  label: 'Number of downloaded Property',
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
         var viewsByDay = <?php echo json_encode($totlagmails); ?>;
         var ctx = document.getElementById('GmailChart').getContext('2d');
         var viewsChart = new Chart(ctx, {
            type: 'line',
            data: {
               labels: Object.keys(viewsByDay),
               datasets: [{
                  label: 'Number of Share Email',
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
   <?php }
}


?>