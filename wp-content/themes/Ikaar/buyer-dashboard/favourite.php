<?php
//Template Name:favouriteBuyer
get_header('dashboard'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<main>
    <div class="dashbord-section common-padding">
        <div class="container">
            <div class="dashbord-inner-row  d-flex align-items-start">
                <?php get_template_part('/buyer-dashboard/dashboard_menu_buyer'); ?>
                <div class="dashboard-info">
                    <div class="Favorite-section">
                        <div class="title-heading">
                            <h1><?php the_title(); ?></h1>
                        </div>
                       
                        <div class="card-blog-wraper">
                            <div class="row">
                                <?php
                                $user_id = $current_user->ID;
                                $user_new_data = get_user_meta($user_id, '_iswishlist');
                                //print_r($user_new_data);
                                foreach ($user_new_data as $refid) {
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
                                                                <div class="button-holder">
                                                                    <ul class="d-flex">
                                                                    <li><a href="javascript:void(0)" onclick="Addtowishlist('<?php echo $propertyDetails['Reference'] ;?>','no')"><i class="fa fa-trash" aria-hidden="true" style="color:black"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            </a>
                                        </div>
                                <?php
                                    }
                                    wp_reset_postdata();
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<script>
    //Add to wishlist
    function Addtowishlist(propertyId,status){
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php') ?>',
            data: {
                action: 'add_to_wishlist',
                propertyId: propertyId,
                wishstatus:status
            },
            success: function(data) {
                location.reload();

            }
        });

    }
</script>
<?php get_footer(); ?>