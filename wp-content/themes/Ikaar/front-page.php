<?php get_header(); ?>

<!-- body section start -->
<main>
    <!-- banner section start -->
    <?php
    $page_id = get_queried_object_id();
    $banner_image_id = get_post_meta($page_id, 'banner_image', true);
    $banner_img = wp_get_attachment_image_url($banner_image_id, 'full');
    $banner_header_one = get_post_meta($page_id, 'banner_header_one', true);
    $banner_header_two = get_post_meta($page_id, 'banner_header_two', true);
    $banner_sub_header = get_post_meta($page_id, 'banner_sub_header', true);
    $for_sale_button = get_post_meta($page_id, 'for_sale_button', true);
    $new_build_button = get_post_meta($page_id, 'new_build_button', true);
    $rental_button = get_post_meta($page_id, 'rental_button', true);
    ?>
    <section class="hero-banner position-relative">
        <?php if (!empty($banner_img)) { ?>
            <div class="banner-bg" style="background: url(<?php echo $banner_img ?>);"></div>
        <?php }?>
        <div class="container-holder">
            <div class="container overlay-content">
                <div class="banner-info">
                    <h1>
                        <?php echo $banner_header_one; ?><br>
                        <?php echo $banner_header_two; ?>
                    </h1>
                    <?php if (!empty($banner_sub_header)) { ?>
                        <p>
                            <?php echo $banner_sub_header; ?>
                        </p>
                    <?php } ?>
                    <div class="button-wrap">
                        <ul class="nav justify-content-center">
                            <?php if (!empty($for_sale_button['title'])) { ?>
                                <li><a href="<?php echo $for_sale_button['url']; ?>" class="btn-border">
                                        <?php echo $for_sale_button['title']; ?>
                                    </a></li>
                            <?php }
                            if (!empty($new_build_button['title'])) { ?>
                                <li><a href="<?php echo $new_build_button['url']; ?>" class="btn-border">
                                        <?php echo $new_build_button['title']; ?>
                                    </a></li>
                            <?php }
                            if (!empty($rental_button['title'])) { ?>
                                <li><a href="<?php echo $rental_button['url']; ?>" class="btn-border">
                                        <?php echo $rental_button['title']; ?>
                                    </a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner section start -->

    <!-- search section start-->
    <section class="Category-section">
        <div class="container container-custome">
            <form method="get" id="searchform" action="<?php echo site_url(); ?>">
                <!-- <div class="row">
                    <div class="col-lg-3 col-md-6 medium-col">
                        <div class="form-row">
                            <input type="text" name="s" id="s" class="form-control" placeholder="Property Category">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 medium-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Min Price">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 medium-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Maximum price">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 big-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Location">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 big-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Property Type">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 big-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Beds & Baths">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 big-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Min.Built">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 big-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Min.Built">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 big-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Min.Plot">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 big-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Ref#">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 big-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Features">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 big-col">
                        <div class="form-row">
                            <input type="submit" class="btn" placeholder="Search">
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Property Category</label>
                            <select name="s" id="s" class="form-control">
                                <option value="0">Choose Category</option>
                                <?php $property_category = get_terms(
                                    array(
                                        'taxonomy' => 'property_type',
                                        'hide_empty' => false,
                                    )
                                );
                                foreach ($property_category as $category) {
                                    ?>
                                    <option value="<?php echo $category->slug; ?>">
                                        <?php echo $category->name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <!-- <input type="text" class="form-control" placeholder="Property Category"> -->
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                        <?php $property_price = get_terms(
                                    array(
                                        'taxonomy' => 'property_price',
                                        'hide_empty' => false,
                                    )
                                );
                                $priceArr = [];
                                foreach ($property_price as $price) {
                                    $price = (int) $price->name;
                                    array_push($priceArr, $price);
                                }
                                   // print_r($priceArr);
                                    ?>
                            <label for="">Minimum price</label>
                            <select name="location" id="proloc" class="form-control min">
                                <option value="0">Select Minimum Price</option>
                               <?php
                               foreach ($priceArr as $key => $value) {
                            
                               ?>
                                    <option value="<?php echo $value; ?>">
                                        <?php echo $value; ?>
                                        
                                    </option>
                                <?php } ?>
                               
                            </select>
                            
                            <!-- <input type="number" name="min" id="min" min="1" title="Please enter number"
                                class="form-control" placeholder="Minimum Price"> -->
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Maximum Price</label>
                            <select name="location" id="proloc" class="form-control max">
                                <option value="0">Select Maximum Price</option>
                                <?php 
                               foreach ($priceArr as $key => $value) {
                            if($key > 0){
                               ?>
                                    ?>
                                    <option value="<?php echo $value; ?>">
                                        <?php echo $value; ?>
                                    </option>
                                <?php } }?>
                            </select>
                            <!-- <input type="number" name="max" id="max" min="1" title="Please enter number"
                                class="form-control" placeholder="Maximum Price"> -->
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Location</label>
                            <!-- <input type="text" class="form-control" placeholder="Location"> -->
                            <select name="location" id="proloc" class="form-control">
                                <option value="0">Choose Location</option>
                                <?php $property_location = get_terms(
                                    array(
                                        'taxonomy' => 'property_location',
                                        'hide_empty' => false,
                                    )
                                );
                                foreach ($property_location as $location) {
                                    ?>
                                    <option value="<?php echo $location->slug; ?>">
                                        <?php echo $location->name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                   <div class="morefields">
                    <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Property Area</label>
                            <input type="number" name="_area" id="min" min="1" title="Please enter number"
                                class="form-control" placeholder="Property Area">
                        </div>
                    </div>
                    <!-- <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">BHK</label>
                            <input type="number" name="_bhk" id="min" min="1" title="Please enter number"
                                class="form-control" placeholder="BHK">
                        </div>
                    </div> -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Bedrooms</label>
                            <input type="number" name="_bedrooms" id="min" min="1" title="Please enter number"
                                class="form-control" placeholder="Bedrooms">
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Bathrooms</label>
                            <input type="number" name="_bathrooms" id="min" min="1" title="Please enter number"
                                class="form-control" placeholder="Bathrooms">
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Property Services</label>
                            <!-- <input type="text" class="form-control" placeholder="Location"> -->
                            <select name="_types" id="proloc" class="form-control">
                                <option value="">Property Services</option>
                               <?php 
                               $args = array(
                                        'post_type' => 'services',
                                        'posts_per_page' => -1, // Set to -1 to retrieve all posts of the specified type
                                    );
                                    $services = get_posts($args);

                                    // Loop through the retrieved posts
                                    foreach ($services as $service) {
                                    ?>
                                    <option value="<?php echo  $service->ID; ?>">
                                        <?php echo  $service->post_title; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Reference Id</label>
                            <!-- <input type="text" class="form-control" placeholder="Location"> -->
                            <select name="_ref" id="proloc" class="form-control">
                                <option value="">Property Reference Id</option>
                               <?php 
                             $allref = get_all_ref_id();
                              if($allref) {
                                    // Loop through the retrieved posts
                                    foreach ($allref as $service) {
                                    ?>
                                    <option value="<?php echo  $service; ?>">
                                        <?php echo  $service; ?>
                                    </option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Features</label>
                            <!-- <input type="text" class="form-control" placeholder="Location"> -->
                            <select name="fetures" id="proloc" class="form-control">
                                <option value="0">Choose Features</option>
                                <?php $property_amenities = get_terms(
                                    array(
                                        'taxonomy' => 'amenities',
                                        'hide_empty' => false,
                                    )
                                );
                                foreach ($property_amenities as $property_amenitiess) {
                                    ?>
                                    <option value="<?php echo $property_amenitiess->slug; ?>">
                                        <?php echo $property_amenitiess->name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                                    </div>
                </div>
                    
                    <div class="col-xl-3 col-lg-4 col-md-6"><label for=""></label><input type="submit" value="search" class="btn">
                    </div>

                </div>
            </form>

            <div class="drop-down-arrow text-center ">
                <?php $less_search = get_post_meta($page_id, 'less_search', true);?>
              
                    <a href="JavaScript:void(0);" onclick="moreserch()" id="less_serch"></a>
               
            </div>
        </div>
    </section>


    <!-- search section end -->

    <!-- ikkar info section start -->
    <?php
    $info_title = get_post_meta($page_id, 'info_title', true);
    $info_sub_title = get_post_meta($page_id, 'info_sub_title', true);
    $info_content = get_post_meta($page_id, 'info_content', true);
    $info_image_id = get_post_meta($page_id, 'info_image', true);
    $info_image = wp_get_attachment_image($info_image_id, 'full');
    ;
    ?>
    <section class="ikaar-info-section common-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-col">
                        <div class="row-holder container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="info-holder">
                                        <?php if (!empty($info_title)) { ?>
                                            <h2>
                                                <?php echo $info_title; ?>
                                            </h2>
                                        <?php }
                                        if (!empty($info_sub_title)) { ?>
                                            <h6>
                                                <?php echo $info_sub_title; ?>
                                            </h6>
                                        <?php } ?>
                                        <?php echo $info_content; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!empty($info_image_id)) { ?>
                    <div class="col-lg-4">

                        <div class="image-holder">
                            <img src="<?php echo $info_image; ?>" alt="">
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- ikkar info section end -->

    <!-- ikkar property section start -->
    <?php
    $property_image_id = get_post_meta($page_id, 'property_image', true);
    $property_image = wp_get_attachment_image_url($property_image_id, 'full');
    $property_price = get_post_meta($page_id, 'property_price', true);
    $property_name = get_post_meta($page_id, 'property_name', true);
    $describe_property = get_post_meta($page_id, 'describe_property', true);
    $property_video_button = get_post_meta($page_id, 'property_video_button', true);
    ?>
    <section class="property-details-section position-relative">
        <?php if (!empty($property_image_id)) { ?>
            <div class="banner-bg" style="background: url(<?php echo $property_image; ?>);">
            </div>
        <?php } else { ?>
            <div class="banner-bg"
                style="background: url(<?php echo get_template_directory_uri(); ?>/assets/images/property-details.jpg);">
            </div>
        <?php } ?>
        <div class="container-holder">
            <div class="container">
                <div class="info-wrap">
                    <div class="section-title">
                        <?php if (!empty($property_price)) { ?>
                            <h3>
                                <?php echo $property_price; ?>
                            </h3>
                        <?php }
                        if (!empty($property_name)) { ?>
                            <h5>
                                <?php echo $property_name; ?>
                            </h5>
                        <?php } ?>
                    </div>
                    <?php if (!empty($describe_property)) { ?>
                        <p>
                            <?php echo $describe_property; ?>
                        </p>
                    <?php }
                    if (!empty($property_video_button['title'])) { ?>
                        <p><a href="<?php echo $property_video_button['url'] ?>" class="details-btn">
                                <?php echo $property_video_button['title'] ?>
                            </a></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- ikkar property section end -->

    <!-- dream property section start -->
    <?php $dream_header = get_post_meta($page_id, 'dream_header', true);
    $dream_sub_header = get_post_meta($page_id, 'dream_sub_header', true); ?>
    <section class="dream-proparty-section common-padding">
        <div class="container">
            <div class="title-heading text-center">
                <?php if (!empty($dream_header)) { ?>
                    <h3 class="text-uppercase">
                        <?php echo $dream_header; ?>
                    </h3>
                <?php }
                if (!empty($dream_sub_header)) { ?>
                    <p>
                        <?php echo $dream_sub_header; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="row">
                <?php
                if (have_rows('dream_repeater')):
                    while (have_rows('dream_repeater')):
                        the_row();
                        $post_objects = get_sub_field('dream_property_name');
                        $property_location_terms = wp_get_post_terms($post_objects->ID, 'property_location');
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <a
                                href="<?php echo site_url(); ?>/property-location/<?php echo $property_location_terms['0']->slug; ?>">
                                <div class="property-box position-relative">
                                    <div class="image-holder position-relative"><img
                                            src="<?php echo get_the_post_thumbnail_url($post_objects->ID); ?>" alt=""></div>
                                    <div class="info-holder">
                                        <h3>
                                            <?php echo $post_objects->post_title; ?>
                                        </h3>
                                        <?php
                                        $property_location_terms3 = wp_get_post_terms($post_objects->ID, 'property_location');
                                        $location_name3 = !empty($property_location_terms3) ? esc_html($property_location_terms3[0]->name) : '';
                                        ?>
                                        <h4>
                                            <?php echo $location_name3; ?>
                                        </h4>
                                        <h5>
                                            <?php echo get_field('currency', $post_objects); ?>
                                            <?php echo get_field('property_price', $post_objects); ?>
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    endwhile;
                endif; ?>
            </div>
        </div>
    </section>
    <!-- dream property section end -->

    <!-- testimonial section start -->
    <?php $testimonial_title = get_post_meta($page_id, 'testimonial_title', true);
    $testimonial_subtitle = get_post_meta($page_id, 'testimonial_subtitle', true);
    $testimonial_banner_id = get_post_meta($page_id, 'testimonial_banner', true);
    $testimonial_banner = wp_get_attachment_image_url($testimonial_banner_id, 'full'); ?>
    <section class="testimonial-section">
        <?php if (!empty($testimonial_banner_id)) { ?>
            <div class="banner-bg" style="background-image: url(<?php echo $testimonial_banner; ?>);">
            </div>
        <?php } else { ?>
            <div class="banner-bg"
                style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/testimonial-bg.jpg);">
            </div>
        <?php } ?>
        <div class="container-holder">
            <div class="container container-custome">
                <div class="testimonial-wraper">
                    <div class="section-title text-center">
                        <?php if (!empty($testimonial_title)) { ?>
                            <h2>
                                <?php echo $testimonial_title; ?>
                            </h2>
                        <?php }
                        if (!empty($testimonial_subtitle)) { ?>
                            <p>
                                <?php echo $testimonial_subtitle; ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
                <?php
                $args = array(
                    'post_type' => 'testimonials',
                    'post_status' => 'publish',
                    //'posts_per_page' => -1,
                );
                $testimonials = new WP_Query($args);
                if ($testimonials->have_posts()) { ?>
                    <div class="testimonial-slider">
                        <?php while ($testimonials->have_posts()) {
                            $testimonials->the_post();
                            $location = get_post_meta(get_the_ID(), 'testimonial_location', true);
                            $testimonial_author = get_post_meta(get_the_ID(), 'testimonial_author', true); ?>
                            <div class="item-box">
                                <div class="info-box">
                                    <p>
                                        <?php the_content(); ?>
                                    </p>
                                    <?php if (!empty($testimonial_author) || !empty($location)) { ?>
                                        <h5>
                                            <?php echo $testimonial_author; ?> |
                                            <?php echo $location; ?>
                                        </h5>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <!-- testimonial section end -->

    <!-- latest property Recommendations section start -->

    <section class="recommendations-section common-padding">
        <div class="container">
            <div class="title-heading text-center">
                <?php $title_latest_prop = get_field("title_latest_prop");
                if ($title_latest_prop != "") { ?>
                    <h3>
                        <?php echo $title_latest_prop; ?>
                    </h3>
                <?php } ?>
                <?php $sub_title_latest_prop = get_field("sub_title_latest_prop");
                if ($sub_title_latest_prop != "") { ?>
                    <p>
                        <?php echo $sub_title_latest_prop; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="row">
                <?php
                    $dynamic_params = [
                        'p_agency_filterid' => 1,
                        'P_PageSize'=>6,
                        'P_sandbox' => true
                    ];
                    $data = fetch_data_from_resales_api($dynamic_params);
                    // echo "<pre/>";
                    // print_r($data);
                    // echo "<pre/>";
                    if ($data["status"] === "success") {
                        // Process and display the data
                        foreach ($data["result"] as $key => $value) {
                    ?>
                    <div class="col-lg-4 col-md-6 category-item-box">
                        <div class="category-box position-relative">
                            <a href="<?php echo esc_url(get_the_permalink(1417)).'?refid='.$value['Reference']; ?>">
                                <div class="image-box position-relative">
                                    <?php
                                    if ($value['Pictures']['Picture'][0]) {
                                        echo "<img src='".$value['Pictures']['Picture'][0]['PictureURL']."' />";
                                    } ?>
                                    <div class="category-title">
                                        <h6>
                                            <?php echo $value['PropertyType']['NameType']; ?>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                            <div class="category-list-row d-flex align-items-center justify-content-between">
                                <div class="provide-item-row">
                                    <ul class="d-flex align-items-center">
                                        <?php
                                        $bedrooms_image = get_theme_value('pro_bedrooms_image_icon');
                                        $bwdrooms_qtt = $value['Bedrooms'];
                                        $bathroom_image = get_theme_value('pro_bathrooms_image_icon');
                                        $bathrooms_qtt = $value['Bathrooms'];
                                        $sq_ft_image = get_theme_value('pro_squ_imag_icon');
                                        $property_area_sq = $value['Built'].'m²';
                                        $terrace_img = get_theme_value('pro_terrace_image_icon');
                                        $temperature = 0;
                                        $property_price = $value['OriginalPrice'];
                                        if (!empty($bwdrooms_qtt)) { ?>
                                            <li><span><img src="<?php echo $bedrooms_image; ?>" alt=""></span>
                                                <?php echo $bwdrooms_qtt; ?>
                                            </li>
                                        <?php }
                                        if (!empty($bathrooms_qtt)) { ?>
                                            <li><span><img src="<?php echo $bathroom_image; ?>" alt=""></span>
                                                <?php echo $bathrooms_qtt; ?>
                                            </li>
                                        <?php }
                                        if (!empty($property_area_sq)) { ?>
                                            <li><span><img src="<?php echo $sq_ft_image; ?>" alt=""></span>
                                                <?php echo $property_area_sq; ?>
                                            </li>
                                        <?php }
                                        if (!empty($temperature)) { ?>
                                            <li><span><img src="<?php echo $terrace_img; ?>" alt=""></span>
                                                <?php echo $temperature; ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="total-price-row">
                                    <span>
                                        <?php echo get_theme_value('pro_currency'); ?>
                                    </span>
                                    <?php
                                    if (!empty($property_price)) { ?>
                                        <span>
                                            <?php echo $property_price ; ?>
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
                ?>
            </div>
            <?php $view_all_recommended_propertise = get_field("view_all_recommended_propertise");
            if ($view_all_recommended_propertise['title'] != "") { ?>
                <div class="button-wrap text-center">
                    <a href="<?php echo $view_all_recommended_propertise['url']; ?>" class="btn">
                        <?php echo $view_all_recommended_propertise['title']; ?>
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- latest property Recommendations section end -->

    <!-- video-section start -->
    <?php get_template_part('/template_part/video_section'); ?>
    <!-- video-section start -->

    <!-- Latest Update section start -->
    <?php $blog_title = get_post_field("blog_title", 77);
    $sub_title = get_post_field('sub_title', 77) ?>
    <section class="global-audience-section common-padding">
        <div class="container">
            <div class="title-heading text-center">
                <?php if (!empty($blog_title)) { ?>
                    <h3>
                        <?php echo $blog_title; ?>
                    </h3>
                <?php }
                if (!empty($sub_title)) { ?>
                    <p>
                        <?php echo $sub_title; ?>
                    </p>
                <?php } ?>
            </div>
            <?php $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                //'orderby' => 'rand',
                'posts_per_page' => 4,
            );
            $blogs = new WP_Query($args);
            if ($blogs->have_posts()) { ?>
                <div class="row">
                    <?php while ($blogs->have_posts()) {
                        $blogs->the_post(); ?>
                        <div class="col-lg-3 col-md-6 card-item-box">
                            <div class="card-box">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="image-box position-relative">
                                        <?php echo get_the_post_thumbnail(); ?>
                                        <div class="card-title">
                                            <?php $special_points = get_post_meta($post->ID, 'special_points', true);
                                            if (!empty($special_points)) { ?>
                                                <h6>
                                                    <?php echo $special_points; ?>
                                                </h6>
                                            <?php } ?>
                                            <p>
                                                <?php echo get_the_date(); ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <div class="card-info">
                                    <h6><a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a></h6>
                                        <?php the_excerpt(); ?>
                                    <?php $read_more = get_post_meta($post->ID, 'read_more', true) ?>
                                    <div class="button-row">
                                        <a href="<?php echo the_permalink(); ?>" class="more-btn">
                                            <?php echo $read_more; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    wp_reset_postdata(); ?>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- Latest Update section end -->

    <!-- get in touch section start-->
    <?php
    $form_title = get_post_meta($page_id, 'form_title', true);
    $form_sub_title = get_post_meta($page_id, 'form_sub_title', true);
    $form_short_code = get_post_meta($page_id, 'form_short_code', true) ?>
    <section class="contact-section contact-wraper common-padding">
        <div class="container container-custome">
            <div class="title-heading text-center">
                <?php if (!empty($form_title)) { ?>
                    <h3>
                        <?php echo $form_title; ?>
                    </h3>
                <?php }
                if (!empty($form_sub_title)) { ?>
                    <p>
                        <?php echo $form_sub_title; ?>
                    </p>
                <?php } ?>
            </div>
            <?php if (!empty($form_short_code)) { ?>
                <div class="form-wraper">
                    <?php echo do_shortcode($form_short_code); ?>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- get in touch section end-->
      <!-- Modal -->
 

    <!-- trusted partners start-->
    <?php get_template_part("/template_part/partner_logo"); ?>
    <!-- trusted partners end-->

</main>
<div class="home-popup">
<div class="modal fade" id="survaymyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">What is in your mind </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  what do you think about our product 
                  <a href="<?php echo get_the_permalink(1412);?>" class=" survay-btn">click</a>
                </div>
            </div>
        </div>
    </div>
            </div>
<!-- body section end -->
<?php get_footer(); ?>
<script>
        jQuery(document).ready(function() {
            jQuery('#survaymyModal').modal('show');
             // Close the modal when the custom button is clicked
             jQuery('.close').on('click', function() {
                jQuery('#survaymyModal').modal('hide');
        });
        });
    </script>
<script>
    
    function moreserch(){
        jQuery(".morefields").toggleClass("_isHide");
        jQuery(".drop-down-arrow").toggleClass("less-more");
        //jQuery(".morefields").show();
    }




   //for min price
   jQuery('.min').change(function() {
            var selectedValue = jQuery(this).val();
            var minValue = selectedValue;
            var pricArr = <?php echo json_encode($priceArr); ?>;
            var select = jQuery('.max');
            select.empty(); // Clear existing options
                // Add new options from pricArr
                jQuery.each(pricArr, function(index, value) {
                    if(value > minValue) {
                    select.append('<option value="' + value + '">' + value + ' </option>');
                    }
                });
        });

        //for Max price
   jQuery('.max').change(function() {
            var selectedValue = jQuery(this).val();
            var maxValue = selectedValue;
            var pricArr = <?php echo json_encode($priceArr); ?>;
            var select = jQuery('.min');
            select.empty(); // Clear existing options
                // Add new options from pricArr
                jQuery.each(pricArr, function(index, value) {
                    if(value < maxValue) {
                    select.append('<option value="' + value + '">' + value + ' </option>');
                    }
                });
        });

</script>