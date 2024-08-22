<?php
//Template Name:ContactedPropertiesAgent
get_header('dashboard');
$page_id = get_queried_object_id();
?>

<main>
    <div class="dashbord-section common-padding">
        <div class="container">
            <div class="dashbord-inner-row align-items-start d-flex">
                <?php get_template_part('/agent-dasbord/dashboard_menu_agent');
                $user_id = $current_user->ID; ?>
                <div class="dashboard-info">
                    <div class="properties-section">
                        <div class="title-heading">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                        </div>
                        <div class="card-blog-wraper">
                            <?php
                            $outargs = array(
                                'post_type' => 'enquiry',
                                'post_status' => 'publish',
                                'author' => $user_id,
                                'posts_per_page' => -1,
                            );
                            $enquries = new WP_Query($outargs);

                            if ($enquries->have_posts()) {
                                $propIDs = [];
                                while ($enquries->have_posts()) {
                                    $enquries->the_post();
                                    $property_id = get_post_meta(get_the_ID(), 'current_post_id', true);

                                    array_push($propIDs, $property_id);
                                }
                            }

                            wp_reset_postdata();
                            //print_r($propIDs);
                           
                               
                                if (!empty($propIDs)) { ?>
                                    <div class="row">
                                        <?php foreach ($propIDs as $key => $refid) {
                                             $dynamic_params = [
                                                'p_agency_filterid' => 1,
                                                'P_sandbox' => true,
                                                'P_RefId' =>  $refid ,
                                                'P_ShowGPSCoords' => TRUE,
                                                'P_showdecree218' => "YES",
                                            ];
                                            $data = fetch_data_from_resales_api($dynamic_params);
                                            // echo $post . '<br>';
                                            // print_r($post);
                                            if ($data) {
                                                $propertyDetails = $data['result'][0];
                                                $imgs = $data['result'][0]['Pictures']['Picture'];
                                                $location = 'sale in '.$propertyDetails['Province'].','.$propertyDetails['Area'];
                                                $propertyName = $propertyDetails['PropertyType']['NameType'].' '.$location; 
                                                $post_title = $propertyName;
                                                $post_content = $propertyDetails['Description'];
                                                $post_permalink = esc_url(get_the_permalink(1417)).'?refid='.$propertyDetails['Reference'];
                                                $post_thumbnail = !empty($imgs) ? $imgs[0]['PictureURL'] : get_template_directory_uri() . '/assets/auth/images/default-image.jpg';
        
                                        ?>
                                                <div class="col-md-6 card-blog-item">
                                                    <div class="card-blog">
                                                        <a href="<?php echo esc_url($post_permalink); ?>">
                                                            <div class="card-blog-row d-flex align-items-start">
        
                                                                <div class="image-box"><img src="<?php echo $post_thumbnail ?>" /></div>
        
                                                                <div class="info-box">
                                                                    <h6><?php echo $post_title; ?></h6>
                                                                    <div class="location-wrap">
                                                                        <ul class="d-flex">
                                                                           
                                                                                    <li>
                                                                                            <?php echo $propertyDetails['Location']; ?>
                                                                                        </li>
                                                                            
                                                                            <li> <?php echo $propertyDetails['Reference']; ?></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="provide-item-row">
                                                                        <ul class="d-flex align-items-center">
                                                                            <li><span><img src="<?php echo get_theme_value('pro_bedrooms_image_icon'); ?>" alt=""></span> <?php echo $propertyDetails['Bedrooms']; ?></li>
                                                                            <li><span><img src="<?php echo get_theme_value('pro_bathrooms_image_icon'); ?>" alt=""></span><?php echo $propertyDetails['Bathrooms']; ?></li>
                                                                        </ul>
                                                                    </div>
                                                                    <h6 class="price-wrap"> <?php echo get_theme_value('pro_currency'); ?> <?php echo $propertyDetails['OriginalPrice']; ?></h6>
                                                                    <div class="bottom-row">
                                                                        <div class="size-box">
                                                                            <p><strong>Built Size:</strong><?php echo $propertyDetails['Built'].'m²'; ?></p>
                                                                            <p><strong>Terrace Size:</strong><?php echo $propertyDetails['Terrace'].'m²'; ?></p>
                                                                        </div>
                                                                      
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    </a>
                                                </div>
                                        <?php
                                            }
                                           // wp_reset_postdata();
                                        }
                                        ?>

                                        <?php } ?>
                                    </div>
                              
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script>

    jQuery(document).ready(function () {

        jQuery(".heart-link img").click(function () {

            var postId = jQuery(this).parent().attr("id");
            jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php') ?>',
                data: {
                    action: 'single_property',
                    postId: postId,

                },
                success: function (data) {
                    alert(data);
                }

            });
        });
    });
</script>
<?php get_footer(); ?>