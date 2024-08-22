<?php
//Template Name:property-details
 get_header();
// print_r(get_the_category($post->ID));
$current_post = get_queried_object();
$current_post_id = $current_post->ID;
$current_post_title = $current_post->post_title;
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $role = $current_user->roles[0];
    if($role ==="agent"){
        $pid = 553;
    } else {
        $pid = 782;
    }
    
    $user_id = $current_user->ID;
    $postId = $post->ID;
    $week_start_date = date('Y-m-d', strtotime('today'));
     //update_number_of_views($user_id,"view", $week_start_date,$postId);


     //shayer by gmail
     if(isset($_POST['sub'])){
        $to      = $_POST['email'];
        $subject = $_POST['subject'];
        $msg     = $_POST['msg'];
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $mail    = wp_mail( $to, $subject, $msg, $headers );
        if($mail){
          update_number_of_views($user_id,"gmail", $week_start_date,$postId);
            echo "<script>alert('Mail was sent successfully')</script>";
        }else{
            echo "<script>alert(There is something problem to send you email.)</script>";
        }
    }
    
} else {
    $role = "";
}

if ($user_id) {
    $membership_level = pmpro_getMembershipLevelForUser($user_id); // Get the membership level for the user

    if ($membership_level) {
        $level_id = $membership_level->id; // Get the ID of the membership level
        $level_name = $membership_level->name; // Get the name of the membership level
    } else {
        $level_name = "";
    }
}
 $postTitles = get_the_title($post->ID);
 //for api
 $refid = $_GET["refid"];
 $dynamic_params = [
    'p_agency_filterid' => 1,
    'P_sandbox' => true,
    'P_RefId' =>  $refid ,
    'P_ShowGPSCoords' => TRUE,
    'P_showdecree218' => "YES",
];
$data = fetch_data_from_resales_api($dynamic_params);
if($data) {
    $propertyDetails = $data['result'][0];
} else {
    $propertyDetails = NULL;
}

?>
<!-- body section start -->
<div id="loader"><img src="<?php echo home_url(); ?>/wp-content/uploads/2024/03/loading-gif-800x600-1.gif" height="100" /></div>
<main>
    <section class="listing-details-section common-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="slider-wraper">
                        <div class="top-slider">
                            <?php
                            $imgs = $data['result'][0]['Pictures']['Picture'];
                            foreach ($imgs as $value) {
                                // echo $value['PictureURL'];
                            ?>
                                <div class="item-box">
                                    <div class="image-box">
                                        <img src="<?php echo $value['PictureURL']; ?>"  alt="">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="bottom-slider">
                            <?php
                          
                            foreach ($imgs as $value) {
                            ?>
                                <div class="item-box">
                                    <div class="image-box"><img src="<?php echo $value['PictureURL']; ?>" alt=""></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- we are form -->
                    <div class="form-holder">
                        <div class="form-title">
                            <?php 
                            
                            
                            $form_title_we_are = get_theme_value("form_title_we_are");
                            if ($form_title_we_are != "") { ?>
                                <h3>
                                
                                    <?php echo $form_title_we_are; ?>
                                </h3>
                            <?php } ?>
                        </div>

                        <div class="form-wraper">
                            <form  id="new_post" name="new_post" action="">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <input type="text" placeholder="First name *" pattern="[A-Za-z]+" title="Please enter only alphabetic characters" name="first_name" id="first_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <input type="text" placeholder="Last name *" pattern="[A-Za-z]+" title="Please enter only alphabetic characters" name="last_name" id="last_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <input type="tel"  name="phoneNumber" pattern="[0-9]{4,15}" title="Phone number must be between 4 and 15 digits" placeholder="Phone *" name="phone" id="phone" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-row">
                                            <input type="email" placeholder="Email *" name="email" id="mail" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-row">
                                            <textarea class="form-control" name="message" id="message" placeholder="Message *" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="button-row text-end">
                                            <input type="submit" name="submit" class="btn" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong id="errormessage"></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- we are form end-->
                </div>
                <!-- prob -->
                <div class="col-lg-6">
                    <div class="property-listing-info-wraper">
                                <div class="info-box ">
                                    <div class="top-row d-flex justify-content-between">
                                        <div class="title-wrap">
                                        <?php
                                            $location = 'sale in '.$propertyDetails['Province'].','.$propertyDetails['Area'];
                                            $propertyName = $propertyDetails['PropertyType']['NameType'].' '.$location; 
                                        ?>
                                            <h4>
                                               <?php echo $propertyName ; ?>
                                               
                                            </h4>
                                        </div>
                                        <div class="button-holder">
                                        <?php 
                                        if($user_id){
                                            $is_wishlist = get_user_meta($user_id,"_iswishlist");
                                            if (in_array($propertyDetails['Reference'], $is_wishlist)){
                                                $is_whisl = "yes";
                                             }else { 
                                                $is_whisl = "no";
                                             }
                                            }else{
                                                $is_whisl = "";
                                            }

                                            ?>
                                                <ul class="d-flex">
                                                    <li><a href="javascript:void(0)" data-bs-toggle="modal" onclick="checkLogin('exampleModal')"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-download.svg" alt="" title="download property brochure"></a></li>
                                                    <li><a href="avascript:void(0)" data-bs-toggle="modal"  onclick="checkLogin('shareModal')"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-share.svg" alt=""></a></li>
                                                    <?php if($is_whisl === "yes"){?>
                                                    <li class="list-btn"><a href="<?php echo get_the_permalink($pid);?>" title="view list"><i class="fa fa-heart" aria-hidden="true" style="color:yellow"></i></a></li>
                                                <?php } elseif($is_whisl === "no"){ ?>
                                                    <li class="list-btn"><a href="javascript:void(0)" onclick="Addtowishlist('<?php echo $propertyDetails['Reference'] ;?>','yes')"><i class="fa fa-heart" aria-hidden="true" style="color:white"></i></a></li>
                                               <?php } else { ?>
                                                <li class="list-btn"><a href="javascript:void(0)" onclick="Addtowishlist('<?php echo $propertyDetails['Reference'] ;?>','yes')"><i class="fa fa-heart" aria-hidden="true" style="color:white"></i></a></li>
                                                <?php } ?>
                                                    </ul>
                                          
                                        </div>
                                    </div>
                                    <div class="location-wrap">
                                        <ul class="d-flex">
                                                <li>
                                                    <?php echo $propertyDetails['Country']; ?>
                                                </li>
                                            <li>
                                                <?php echo $refid; ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="provide-item-row">
                                        <ul class="d-flex align-items-center">
                                            <li><span><img src="<?php echo get_theme_value('pro_bedrooms_image_icon'); ?>" alt=""></span>
                                                <?php echo $propertyDetails['Bedrooms']; ?>
                                            </li>
                                            <li><span><img src="<?php echo get_theme_value('pro_bathrooms_image_icon'); ?>" alt=""></span>
                                            <?php echo $propertyDetails['Bathrooms']; ?>
                                            </li>
                                            <li><span><img src="<?php echo get_theme_value('pro_squ_imag_icon'); ?>" alt=""></span>
                                            <?php echo $propertyDetails['Built'].'m²'; ?>
                                    </li>
                                        </ul>
                                    </div>

                                    <h6>
                                    <?php echo get_theme_value('pro_currency'); ?>
                                        <?php echo $propertyDetails['OriginalPrice']; ?>
                                    </h6>
                                    <div class="size-box">
                                    <p>
                                        Type: <?php echo $propertyDetails['PropertyType']['Type']; ?>
                                        </p>
                                        <p>
                                        Built Size: <?php echo $propertyDetails['Built'].'m²'; ?>
                                        </p>
                                        <p>
                                        Terrace Size: <?php echo $propertyDetails['Terrace'].'m²'; ?>
                                        </p>
                                        <p>
                                        Status: <?php echo $propertyDetails['Status']['en']; ?>
                                        </p>
                                        <p>
                                        Province: <?php echo $propertyDetails['Province']; ?>
                                        </p>
                                        <p>
                                        Area: <?php echo $propertyDetails['Area']; ?>
                                        </p>
                                        <p>
                                        Location: <?php echo $propertyDetails['Location']; ?>
                                        </p>
                                    </div>
                                    <?php echo $propertyDetails['Description']; ?>
                                </div>
                       
                        <div class="listing-Category-box">
                                <h5>
                                    <?php echo get_field("title_amneties"); ?>
                                </h5>
                            <?php  ?>
                            <ul class="d-flex">
                                <?php
                                       $Allterms =  $propertyDetails['PropertyFeatures']['Category'];
                                      // print_r($Allterms);
                                    //   die;
                                       if(!empty($Allterms)){
                                        foreach ($Allterms as $key => $value) {
                                    ?>
                                        <li><a href="">
                                                <?php echo  $value['Type'].':'.implode(",", $value['Value']); ?>
                                            </a></li>
                                            <?php } } ?>
                            </ul>
                            
                        </div>
                    </div>

                </div>
                <!-- prob -->
            </div>
        </div>
    </section>
    <section class="map-section">
        <div class="container-fluid">
           
                <div class="map-holder">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2970.140276291572!2d-87.6269033!3d41.889840199999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880e2cae716c71c3%3A0x619dd21429319d37!2s420%20N%20Wabash%20Ave%20%23500%2C%20Chicago%2C%20IL%2060611%2C%20USA!5e0!3m2!1sen!2sin!4v1698733307241!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
           
        </div>
    </section>

    <!-- latest product -->
    <?php get_template_part("/template_part/latest_property"); ?>
    <!-- latest product end-->

    <!-- trusted partners start-->
    <?php get_template_part("/template_part/partner_logo"); ?>
    <!-- trusted partners end-->

<!-- pdf HTML hidden section start-->
<section class="pdf-section" id="myContent">
    <div class="item-wrap full-page-wraper" style="display: flex; align-items: center; background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-right: 130px; margin: 0 auto;">
               <div class="container-fluid">
                  <div class="front-page-content" style="display: flex; align-items: center; justify-content: center; position: absolute; top: 0; right: 0; bottom: 0; left: 0; margin: auto;">
                     <div class="logo-outer" style="max-width: 700px; text-align: center; color: #fff;">
                        <div class="logo-wraper" style="max-width: 320px; margin: 0 auto 20px;"><a href=""><img src="<?php echo get_theme_value('brand_default_images');?>" alt="" style="width: 100%; height: 100%;"></a></div>
                        <div class="info-wraper">
                          <p style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 40px;"><?php echo get_theme_value('_brou_title');?></p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="side-bar-design" style="position: absolute; top: 0; right: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
            <div class="item-wrap full-page-wraper" style="background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-left: 130px; margin: 0 auto;">
               <div class="container-fluid" style="width: 100%; height: 100%;">
                  <div class="item-row" style="display: flex; height: 100%;">
                     <div class="col-wrap" style="display: flex; align-items: center; width: 40%; height: 100%; padding-right: 30px;">
                        <div class="info-wraper" style="width: 100%;">
                           <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 45px;"><?php echo get_theme_value('_brou_title_property_info');?></h1>
                           <div class="menu-wrap">
                              <ul style="padding: 0;">
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Reference:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Reference']; ?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Property Area:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Area']; ?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Location:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;">
                                        <?php
                                            echo $propertyDetails['Location'];
                                            ?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Type:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"> 
                                         <?php echo $propertyDetails['PropertyType']['Type'] ;?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Beds:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Bedrooms']; ?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Bath:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Bathrooms']; ?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">BHK:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Bhk']; ?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Terrace Size:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Terrace']; ?>(m²)</span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Built Size:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Built']; ?>(m²)</span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Price:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;">€<?php echo $propertyDetails['OriginalPrice']; ?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Community Fees:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;">€<?php echo get_post_meta($post->ID,"community_fees",true); ?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">IBI Fees:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;">€<?php echo get_post_meta($post->ID,"ibi_fees",true); ?></span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-wrap" style="width: 60%;">
                        <div class="image-wraper"  style="width: 100%; height: 100%;"><img src="<?php echo $imgs[0]['PictureURL'];?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
                     </div>
                    
                  </div>
               </div>
               <div class="side-bar-design" style="position: absolute; top: 0; left: 30px; width: 75px; height: 100%;"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/ikaar-design.png" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
            <div class="item-wrap" style="background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-right: 130px; margin: 0 auto;">
               <div class="container-fluid" style="width: 100%; height: 100%;">
                  <div class="item-row" style="display: flex; height: 100%;">
                     <div class="col-wrap" style="display: flex; align-items: center; width: 50%; height: 100%;">
                        <div class="image-wraper" style="width: 100%; height: 100%;"><img src="<?php echo $imgs[1]['PictureURL'];?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
                     </div>
                     <div class="col-wrap" style="display: flex; align-items: center; width: 50%; height: 100%;">
                        <div class="info-wraper" style="padding-left: 20px;">
                           <h3 style=" margin: 0 0 20px; padding: 0; color: #D4A884; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 32px;">Description:</h3>
                           <p style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 25px;"><?php echo $propertyDetails['Description'];?></p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="side-bar-design" style="position: absolute; top: 0; right: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
            <div class="item-wrap full-page-wraper" style="background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-left: 130px; margin: 0 auto;">
               <div class="container-fluid" style="width: 100%; height: 100%;">
                  <div class="item-row" style="display: flex; height: 100%;">
                     <div class="col-wrap" style="display: flex; align-items: center; width: 40%; height: 100%; padding-right: 30px;">
                        <div class="info-wraper" style="width: 100%;">
                           <div class="menu-wrap">
                              <ul style="padding: 0;">
                              
                                 <?php
                                      
                                       if(!empty($Allterms)){
                                        foreach ($Allterms as $key => $value) {
                                    ?>
                                        <li style="display: flex; margin-bottom: 15px;">
                                                <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;"><?php echo  $value['Type'] ;?>:</span>
                                                <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo  implode(",", $value['Value']) ;?></span>
                                            </li>
                                            <?php } } ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-wrap" style="width: 60%;">
                        
                        <?php if($imgs[2]['PictureURL']){
                        ?>
                        <div class="image-wraper"  style="width: 100%; height: 100%;"><img src="<?php echo $imgs[2]['PictureURL'];?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
                     <?php } else { ?>
                        <div class="image-wraper"  style="width: 100%; height: 100%;"><img src="<?php echo $imgs[0]['PictureURL'];?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>

                     <?php }
                     ?>
                        </div>
                    
                  </div>
               </div>
               <div class="side-bar-design" style="position: absolute; top: 0; left: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images_unbranded');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
            <?php 
            //$galleryImage = get_field('add_images');
             foreach ($imgs as $kk=>$img) {
                $kk++;
                if($kk%2){
                    $position = "right";
                }else{
                    $position = "left"; 
                }
                ?>
            <div class="item-wrap" style="background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-left: 130px; margin: 0 auto;">
               <div class="ful-image-wraper"  style="width: 100%; height: 100%; position: absolute; top: 0; right: 0; bottom: 0; left: 0;">
               <img src="<?php echo $img['PictureURL'];?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
           
            <div class="side-bar-design" style="position: absolute; top: 0; <?=$position;?>: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
            <?php } ?>
            <div class="item-wrap full-page-wraper" style="display: flex; align-items: center; background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-right: 130px; margin: 0 auto;">
               <div class="container-fluid">
                  <div class="front-page-content" style="display: flex; align-items: center; justify-content: center; position: absolute; top: 0; right: 0; bottom: 0; left: 0; margin: auto;">
                     <div class="logo-outer" style="max-width: 550px; text-align: center; color: #fff;">
                        <div class="logo-wraper" style="max-width: 320px; margin: 0 auto 20px;"><a href=""><img src="<?php echo get_theme_value('brand_default_images');?>" alt="" style="width: 100%; height: 100%;"></a></div>
                        <div class="info-wraper">
                          <ul style="padding: 0; list-style: none;">
                           <li style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px; margin-bottom: 5px; font-size: 28px;">
                              Email: <a href=""  style=" font-family: Verdana, Geneva, Tahoma, sans-serif; ont-size: 28px; color: #fff; text-decoration: none;"><?php echo get_theme_value('_brou_email');?></a>
                           </li>
                           <li style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px; margin-bottom: 5px; font-size: 28px;">
                              Internet: <a href=""  style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px; color: #fff; text-decoration: none;"><?php echo get_theme_value('web_urls');?></a>
                           </li>
                           <li style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px; margin-bottom: 5px; font-size: 28px;">
                              Tel: <a href="" style=" font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px; color: #fff; text-decoration: none;"><?php echo get_theme_value('_brouc_con');?></a>
                           </li>
                          </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="side-bar-design" style="position: absolute; top: 0; right: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
         </section>

    
         <!-- wethout logo -->
         <!-- pdf HTML hidden section start-->
         <section class="pdf-section" id="myContent2" >
    <div class="item-wrap full-page-wraper" style="display: flex; align-items: center; background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-right: 130px; margin: 0 auto;">
               <div class="container-fluid">
                  <div class="front-page-content" style="display: flex; align-items: center; justify-content: center; position: absolute; top: 0; right: 0; bottom: 0; left: 0; margin: auto;">
                     <div class="logo-outer" style="max-width: 700px; text-align: center; color: #fff;">
                        <!-- <div class="logo-wraper" style="max-width: 320px; margin: 0 auto 20px;"><a href=""><img src="<?php// echo get_theme_value('brand_default_images');?>" alt="" style="width: 100%; height: 100%;"></a></div> -->
                        <div class="info-wraper">
                          <p style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 40px;"><?php echo get_theme_value('_brou_title');?></p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="side-bar-design" style="position: absolute; top: 0; right: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images_unbranded');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
            <div class="item-wrap full-page-wraper" style="background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-left: 130px; margin: 0 auto;">
               <div class="container-fluid" style="width: 100%; height: 100%;">
                  <div class="item-row" style="display: flex; height: 100%;">
                     <div class="col-wrap" style="display: flex; align-items: center; width: 40%; height: 100%; padding-right: 30px;">
                        <div class="info-wraper" style="width: 100%;">
                           <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 45px;"><?php echo get_theme_value('_brou_title_property_info');?></h1>
                           <div class="menu-wrap">
                              <ul style="padding: 0;">
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Reference:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Reference'];?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Property Area:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Area'];?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Location:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;">
                                          <?php echo $propertyDetails['Location'];?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Type:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;">  
                                           <?php echo $propertyDetails['PropertyType']['Type'];?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Beds:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Bedrooms'];?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Bath:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Bathrooms'];?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">BHK:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Bhk'];?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Terrace Size:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Terrace'];?>(m²)</span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Built Size:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo $propertyDetails['Built'];?>(m²)</span>
                                 </li>

                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Price:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;">€<?php echo $propertyDetails['OriginalPrice'];?></span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">Community Fees:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;">€ 0.0</span>
                                 </li>
                                 <li style="display: flex; margin-bottom: 15px;">
                                    <span  style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;">IBI Fees:</span>
                                    <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;">€ 0.0</span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-wrap" style="width: 60%;">
                        <div class="image-wraper"  style="width: 100%; height: 100%;"><img src="<?php echo $imgs[0]['PictureURL'];?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
                     </div>
                    
                  </div>
               </div>
               <div class="side-bar-design" style="position: absolute; top: 0; left: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images_unbranded');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
            <div class="item-wrap" style="background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-right: 130px; margin: 0 auto;">
               <div class="container-fluid" style="width: 100%; height: 100%;">
                  <div class="item-row" style="display: flex; height: 100%;">
                     <div class="col-wrap" style="display: flex; align-items: center; width: 50%; height: 100%;">
                        <div class="image-wraper" style="width: 100%; height: 100%;"><img src="<?php echo $imgs[1]['PictureURL'];?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
                     </div>
                     <div class="col-wrap" style="display: flex; align-items: center; width: 50%; height: 100%;">
                        <div class="info-wraper" style="padding-left: 20px;">
                           <h3 style=" margin: 0 0 20px; padding: 0; color: #D4A884; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 32px;">Description:</h3>
                           <p style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 25px;"><?php echo $propertyDetails['Description'];?></p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="side-bar-design" style="position: absolute; top: 0; right: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images_unbranded');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>

            <div class="item-wrap full-page-wraper" style="background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-left: 130px; margin: 0 auto;">
               <div class="container-fluid" style="width: 100%; height: 100%;">
                  <div class="item-row" style="display: flex; height: 100%;">
                     <div class="col-wrap" style="display: flex; align-items: center; width: 40%; height: 100%; padding-right: 30px;">
                        <div class="info-wraper" style="width: 100%;">
                           <div class="menu-wrap">
                              <ul style="padding: 0;">
                              <?php
                                      
                                      if(!empty($Allterms)){
                                       foreach ($Allterms as $key => $value) {
                                   ?>
                                       <li style="display: flex; margin-bottom: 15px;">
                                               <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; color: #D4A884; font-size: 28px; font-weight: 600;"><?php echo  $value['Type'] ;?>:</span>
                                               <span style="display: block; width: 50%; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px;"><?php echo  implode(",", $value['Value']) ;?></span>
                                           </li>
                                           <?php } } ?>
                                 
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-wrap" style="width: 60%;">
                        <?php
                        if($imgs[2]['PictureURL']) { ?>
                        <div class="image-wraper"  style="width: 100%; height: 100%;"><img src="<?php echo $imgs[2]['PictureURL'];?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
                    <?php } else { ?>
                        <div class="image-wraper"  style="width: 100%; height: 100%;"><img src="<?php echo $imgs[1]['PictureURL'];?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>


                 <?php   } ?>
                        </div>
                    
                  </div>
               </div>
               <div class="side-bar-design" style="position: absolute; top: 0; left: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images_unbranded');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
            <?php 
            //$galleryImage = get_field('add_images');
             foreach ($imgs as $kk=>$value) {
                $kk++;
                if($kk%2){
                    $position = "right";
                }else{
                    $position = "left"; 
                }
                ?>
            <div class="item-wrap" style="background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-left: 130px; margin: 0 auto;">
               <div class="ful-image-wraper"  style="width: 100%; height: 100%; position: absolute; top: 0; right: 0; bottom: 0; left: 0;">
               <img src="<?php echo $value['PictureURL']; ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
           
            <div class="side-bar-design" style="position: absolute; top: 0; <?=$position;?>: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images_unbranded');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
            <?php } ?>
            <div class="item-wrap full-page-wraper" style="display: flex; align-items: center; background: #333333; width: 2245px; height: 1588px; position: relative; color: #fff; padding-right: 130px; margin: 0 auto;">
               <div class="container-fluid">
                  <div class="front-page-content" style="display: flex; align-items: center; justify-content: center; position: absolute; top: 0; right: 0; bottom: 0; left: 0; margin: auto;">
                     <div class="logo-outer" style="max-width: 550px; text-align: center; color: #fff;">
                        <!-- <div class="logo-wraper" style="max-width: 320px; margin: 0 auto 20px;"><a href=""><img src="<?php// echo get_theme_value('brand_default_images');?>" alt="" style="width: 100%; height: 100%;"></a></div> -->
                        <div class="info-wraper">
                          <ul style="padding: 0; list-style: none;">
                           <li style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px; margin-bottom: 5px; font-size: 28px;">
                              Email: <a href=""  style=" font-family: Verdana, Geneva, Tahoma, sans-serif; ont-size: 28px; color: #fff; text-decoration: none;"><?php echo get_theme_value('_brou_email');?></a>
                           </li>
                           <li style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px; margin-bottom: 5px; font-size: 28px;">
                              Internet: <a href=""  style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px; color: #fff; text-decoration: none;"><?php echo get_theme_value('web_urls');?></a>
                           </li>
                           <li style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px; margin-bottom: 5px; font-size: 28px;">
                              Tel: <a href="" style=" font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 28px; color: #fff; text-decoration: none;"><?php echo get_theme_value('_brouc_con');?></a>
                           </li>
                          </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="side-bar-design" style="position: absolute; top: 0; right: 30px; width: 75px; height: 100%;"><img src="<?php echo get_theme_value('border_default_images_unbranded');?>" alt="" style="width: 100%; height: 100%; object-fit: cover;"></div>
            </div>
         </section>
     
<!-- pdf HTML hidden section end-->

    <!-- Modal -->
    <div class="share-modal-wraper">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-form">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="title-heding text-center">
                            <?php $modal_title=get_theme_value('modal_title');
                            $modal_sub_title=get_theme_value('modal_sub_title');
                            $modal_but_title=get_theme_value('modal_but_title'); 
                            if(!empty($modal_title)){?>
                            <h3><?php echo $modal_title; ?></h3>
                            <?php } if(!empty($modal_sub_title)){ ?>
                            <p> <?php echo  $modal_sub_title; ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-wraper">
                                    <div class="col-12">
                                        <div class="button-row text-center">                                      
                                                <a href="javascript:void(0)" class="btn" onclick="Convert_HTML_To_PDF()" >Branded brochure </button>
                                        
                                            <a href="javascript:void(0)" onclick="Convert_HTML_To_PDF_wethout_logo()" class=" btn subscribe-btn">Unbranded brochure </a>
                                
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <!-- Share Modal -->
    <div class="share-modal-wraper">
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-form">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <?php $modal_share_title=get_theme_value('modal_share_title'); ?>
                        <div class="title-heding text-center">
                           <?php  if(!empty($modal_share_title)){ ?>
                            <h3><?php echo $modal_share_title; ?></h3>
                            <?php } ?>
                        </div>
                       
                        <div class="form-wraper text-center">
                        <?php //echo do_shortcode('[shared_counts]'); ?>
                        <?php// echo do_shortcode('[Sassy_Social_Share]'); ?>
                          <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url(get_the_permalink(1417)).'?refid='.$propertyDetails['Reference']; ?>&text=<?php echo $propertyName ;?>" target="_blank" class="btn btn-primary">Twitter</a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink(1417)).'?refid='.$propertyDetails['Reference']; ?>" target="_blank" class="btn btn-primary">Facebook</a>
                           <a href="javascript:void(0)" onclick="shareWithGmail('<?php echo esc_url(get_the_permalink(1417)).'?refid='.$propertyDetails['Reference']; ?>')" class="btn btn-primary">Gmail</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
      <!-- Share Modal Gmail -->
      <div class="modal fade" id="shareModalGmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-form">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="title-heding text-center">
                        <?php  if(!empty($modal_share_title)){ ?>
                            <h3><?php echo $modal_share_title; ?></h3>
                            <?php } ?>
                            
                        </div>
                        <div class="form-wraper">
                            <form action=""  method="post">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input type="email" placeholder="To" name="email" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input type="text" placeholder="Subject" name="subject" class="form-control" value="<?php echo $propertyName ;?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-row">
                                        <textarea class="form-control" name="msg" value="<?php echo esc_url(get_the_permalink(1417)).'?refid='.$_GET['refid']; ?>" ><?php echo esc_url(get_the_permalink(1417)).'?refid='.$_GET['refid']; ?></textarea>
                                    </div>
                                </div>
                                </div>
                                <div class="bottom-row d-flex justify-content-between align-items-center">
                                <div class="button-row">
                                    <input type="submit" value="SEND" name="sub" class="btn">
                                </div>
                                </div>
                            </form>
                  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
   
    <script>
       //check user is login or not
     var user_id = "<?php echo $user_id;?>";
     var week_start_date ="<?php echo $week_start_date ; ?>";
    function checkLogin(data){
    if(user_id){
        jQuery("#"+data+"").modal("show");
    } else{
        var logUrl = "<?php echo get_the_permalink(544) ; ?>"
        var alertmsg = "please login to perform this action!"
        alert(alertmsg);
    }
    }
 //Add to wishlist
    function Addtowishlist(propertyId,status){
        if(user_id){
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
    }else{
        var alertmsg = "please login to perform this action!"
        alert(alertmsg);   
    }
    }
    

    jQuery(document).ready(function($) {
           
            jQuery(".alert").hide();
            jQuery(".close").click(function() {
                jQuery(".alert").hide();
            });
            jQuery("#new_post").submit(function() {
                var fastname = jQuery('#first_name').val();
                var lastname = jQuery('#last_name').val();
                var mail = jQuery('#mail').val();
                var number = jQuery('#phone').val();
                var message = jQuery('#message').val();
                var current_post_id = "<?php echo $propertyDetails['Reference']; ?>";
                var current_post_title = "<?php echo $propertyName; ?>";
                event.preventDefault();
                var role = "<?php echo $role ?>";
                if (role === "") {
                    if (confirm("are You Agent") == true) {
                        role = "agent";
                    } else {
                        role = "buyer";
                    }
                }
                jQuery.ajax({
                    type: "POST",
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    //dataType: "json",

                    data: {
                        action: 'property_signup',
                        fastname: fastname,
                        lastname: lastname,
                        mail: mail,
                        number: number,
                        message: message,
                        role: role,
                        current_post_id: current_post_id,
                        current_post_title: current_post_title

                    },
                    success: function(data) {
                        if (data == "200") {
                           var errormessage = "you are regester successfully ! An OTP is sent to you email id.";
                           jQuery('#errormessage').text(errormessage);
                           jQuery(".alert").show();
                        } else {
                           alert(data);
                           location.reload();
                        }


                    }
                });
            });
        });

        //share with gmail
        function shareWithGmail(postId){
            jQuery("#shareModal").modal("hide");
            jQuery("#shareModalGmail").modal("show");
            return false;

        }
        </script>
         <script>
            var basdocName = '<?php echo $postTitles ; ?>';
        const fullname = basdocName+'.pdf';
             jQuery('#myContent').hide();
    function Convert_HTML_To_PDF() {
      //  var _isPremum = "<?php echo $level_name ; ?>"
   // if(_isPremum) {
       var result = confirm("Do you want to download brochure?");
    if(result) {
        document.getElementById("loader").style.display = "block";
        jQuery('#myContent').show();
            // var doc = new jsPDF();
                var doc = new window.jspdf.jsPDF({
            orientation: 'landscape',
            format: 'a2'
            });
// Add a new page with the specified height
         doc.addPage('a2', 'landscape', 100);
	//jQuery("#myContent").removeAttr('hidden');
    var elementHTML = document.querySelector("#myContent");
    doc.html(elementHTML, {
        callback: function(doc) {
            // Save the PDF
           
            doc.save(fullname);
            //elementHTML.remove();
            jQuery("#myContent").attr('hidden','true');
        },
        margin: [0, 0, 0, 0],
        autoPaging: 'text',
        putOnlyUsedFonts: true,
        unit:'cm',
        fontName:"times",
        x: 0,
        y: 0,
       // format: 'a4',
        width: 396.5, //target width in the PDF document
        windowWidth: 1500 //window width in CSS pixels
    });

    jQuery.ajax({
                    type: "POST",
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    //dataType: "json",

                    data: {
                        action: 'download_property',
                        post_ids:<?php echo $post->ID;?>,
                        week_start_date:week_start_date
                    },
                    success: function(data) {
                        jQuery('#myContent').hide();
                //console.log(data);
                     }
                });
                       // Hide loader after a short delay
       setTimeout(function() {
                document.getElementById("loader").style.display = "none";
            }, 1000); // Adjust the delay as needed
            }

            else {
                return false
            }
       

        // } else {
        //     alert("please subscribe to download property brochure");
        // }
        }
        jQuery('#myContent2').hide();
function Convert_HTML_To_PDF_wethout_logo() {
    var _isPremum = "<?php echo $level_name ; ?>"
    if(_isPremum) {
        var result = confirm("Do you want to download brochure?");
    if(result) {
    document.getElementById("loader").style.display = "block";
    jQuery('#myContent2').show();
   // var doc = new jsPDF();
    var doc = new window.jspdf.jsPDF({
        orientation: 'landscape',
        format: 'a2'
        });
// Add a new page with the specified height
doc.addPage('a2', 'landscape', 100);
	//jQuery("#myContent").removeAttr('hidden');
    var elementHTML = document.querySelector("#myContent2");
    doc.html(elementHTML, {
        callback: function(doc) {
            // Save the PDF
            doc.save(fullname);
        },
        margin: [0, 0, 0, 0],
        autoPaging: 'text',
        putOnlyUsedFonts: true,
        unit:'cm',
        fontName:"times",
        x: 0,
        y: 0,
       // format: 'a4',
        width: 396.5, //target width in the PDF document
        windowWidth: 1500 //window width in CSS pixels
    });

    jQuery.ajax({
                    type: "POST",
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    //dataType: "json",

                    data: {
                        action: 'download_property',
                        post_ids:<?php echo $post->ID;?>,
                        week_start_date:week_start_date
                    },
                    success: function(data) {
                        jQuery('#myContent2').hide();
                //console.log(data);
                 }
                });
            
       // Hide loader after a short delay
       setTimeout(function() {
                document.getElementById("loader").style.display = "none";
            }, 1000); // Adjust the delay as needed

        }

        else {
            return false
        }
        } else {
            alert("please subscribe to download property brochure");
        }

        }
  
         </script>
        
    <?php

    get_footer(); ?>