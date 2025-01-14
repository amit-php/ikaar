<?php
//Template Name:Listing
get_header();

?>

<main>
    <section class="hero-banner inner-banner position-relative">
        <?php $banner_image_listing = get_field("banner_image_listing");
        if ($banner_image_listing != "") { ?>
            <div class="banner-bg" style="background: url(<?php echo $banner_image_listing; ?>);"></div>
        <?php } ?>
        <div class="container-holder">
            <div class="container overlay-content">
                <?php $banner_title_listing = get_field("banner_title_listing");
                if ($banner_title_listing != "") { ?>
                    <div class="banner-info">
                        <h1>
                            <?php echo $banner_title_listing; ?>
                        </h1>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- filter posts -->
    <section class="Category-section">
        <div class="container container-custome">
            <form id="searchforms" method="post" action="<?php echo site_url('/listing') ?>">

                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Property Category</label>
                            <select name="category" id="procat" class="form-control">
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
                    <!-- <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Minimum Price</label>
                            <input type="text" id="min" pattern="^[0-9]+$" title="Please enter number"
                                class="form-control" placeholder="Minimum Price">
                        </div>
                    </div> -->
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
                            <select name="location" id="min" class="form-control min">
                                <option value="0">Select Minimum Price</option>
                               <?php
                               foreach ($priceArr as $key => $value) {
                            
                               ?>
                                    <option value="<?php echo $value; ?>">
                                        <?php echo $value; ?>
                                        
                                    </option>
                                <?php } ?>
                               
                            </select>

                        </div>
                    </div>
                    <!-- <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Maximum Price</label>
                            <input type="text" id="max" pattern="^[0-9]+$" title="Please enter number"
                                class="form-control" placeholder="Maximum price">
                        </div>
                    </div> -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Maximum Price</label>
                            <select name="location" id="max" class="form-control max">
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
                            <input type="number" name="_area" id="area" min="1" title="Please enter number"
                                class="form-control" placeholder="Property Area in sqs.ft.">
                        </div>
                     </div>
                     <!-- <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">BHK</label>
                            <input type="number" name="_bhk" id="bhk" min="1" title="Please enter number"
                                class="form-control" placeholder="BHK">
                        </div>
                     </div> -->
                     <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Bedrooms</label>
                            <input type="number" name="_bedrooms" id="bedroom" min="1" title="Please enter number"
                                class="form-control" placeholder="Bedrooms">
                        </div>
                     </div>
                     <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Bathrooms</label>
                            <input type="number" name="_bathrooms" id="bathroom" min="1" title="Please enter number"
                                class="form-control" placeholder="Bathrooms">
                        </div>
                     </div>

                     <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="form-row">
                            <label for="">Property Services</label>
                            <!-- <input type="text" class="form-control" placeholder="Location"> -->
                            <select name="_types" id="type" class="form-control">
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
                            <select name="_ref" id="refid" class="form-control">
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
                            <select name="fetures" id="feturess" class="form-control">
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
                    <a href="JavaScript:void(0);" onclick="moreserch()" id="less_serch"></a>
               
            </div>
        </div>
    </section>
    <!-- filter posts end -->
    <?php
    $transferredData = $_GET['service'];
    $type_slug = [];
    $type_slug = $_GET['location'];
    //print_r($type_slug);
    
    ?>
    <section class="recommendations-section common-padding-top">
        <div class="container">
            <div class="title-heading text-center">
                <?php $title_latest_prop = get_field("title_latest_prop");
                if ($title_latest_prop != "") { ?>
                    <h3>
                        <?php echo $title_latest_prop; ?>
                    </h3>
                <?php } ?>
                <?php $sub_title_latestProp = get_field("sub_title_latestProp");
                if ($sub_title_latestProp != "") { ?>
                    <p>
                        <?php echo $sub_title_latestProp; ?>
                    </p>
                <?php } ?>
            </div>
            <?php if (!empty($transferredData)) { ?>
                <div class="row propClass" id="filterprop">
                    <?php
                    $wpnew = array(
                        'post_type' => 'property',
                        'post_status' => 'publish',
                        //'posts_per_page' => 3
                        'meta_query' => array(
                            array(
                                'key' => 'service_type',
                                'value' => $transferredData,
                            ),
                        ),
                    );
                    $qprop = new WP_Query($wpnew);
                    if ($qprop->have_posts()) {
                        while ($qprop->have_posts()) {
                            $qprop->the_post();
                            ?>
                            <div class="col-lg-4 col-md-6 category-item-box">
                                <div class="category-box position-relative">
                                    <a href="<?php echo esc_url(get_permalink()); ?>">
                                        <div class="image-box position-relative">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                echo get_the_post_thumbnail();
                                            } ?>
                                            <div class="category-title">
                                                <h6>
                                                    <?php the_title(); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="category-list-row d-flex align-items-center justify-content-between">
                                        <div class="provide-item-row">
                                            <ul class="d-flex align-items-center">
                                                <?php
                                                $bedrooms_image = get_theme_value('pro_bedrooms_image_icon');
                                                $bwdrooms_qtt = get_field('bwdrooms_qtt');
                                                $bathroom_image = get_theme_value('pro_bathrooms_image_icon');
                                                $bathrooms_qtt = get_field('bathrooms_qtt');
                                                $sq_ft_image = get_theme_value('pro_squ_imag_icon');
                                                $property_area_sq = get_field('property_area_sq');
                                                $terrace_img = get_theme_value('pro_terrace_image_icon');
                                                $temperature = get_field('temperature');
                                                $property_price = get_field('property_price');
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
                                                    <?php echo number_format($property_price); ?>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </div>
            <?php } else if (!empty($type_slug)) { ?>
                    <div class="row propClass" id="filterprop">
                        <?php
                        $wpnew = array(
                            'post_type' => 'property',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                    array(
                                        'taxonomy' => 'property_location', // Replace with your custom taxonomy slug
                                        'field' => 'id',
                                        'terms' => $type_slug,
                                        'operator' => 'IN',
                                    ),
                                ),
                        );
                        $qprop = new WP_Query($wpnew);
                        if ($qprop->have_posts()) {
                            while ($qprop->have_posts()) {
                                $qprop->the_post();
                                ?>loc
                                <div class="col-lg-4 col-md-6 category-item-box">
                                    <div class="category-box position-relative">
                                        <a href="<?php echo esc_url(get_permalink()); ?>">
                                            <div class="image-box position-relative">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    echo get_the_post_thumbnail();
                                                } ?>
                                                <div class="category-title">
                                                    <h6>
                                                    <?php the_title(); ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="category-list-row d-flex align-items-center justify-content-between">
                                            <div class="provide-item-row">
                                                <ul class="d-flex align-items-center">
                                                    <?php
                                                    $bedrooms_image = get_theme_value('pro_bedrooms_image_icon');
                                                    $bwdrooms_qtt = get_field('bwdrooms_qtt');
                                                    $bathroom_image = get_theme_value('pro_bathrooms_image_icon');
                                                    $bathrooms_qtt = get_field('bathrooms_qtt');
                                                    $sq_ft_image = get_theme_value('pro_squ_imag_icon');
                                                    $property_area_sq = get_field('property_area_sq');
                                                    $terrace_img = get_theme_value('pro_terrace_image_icon');
                                                    $temperature = get_field('temperature');
                                                    $property_price = get_field('property_price');
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
                                                <?php echo  get_theme_value('pro_currency'); ?>
                                                </span>
                                                <?php
                                                if (!empty($property_price)) { ?>
                                                    <span>
                                                    <?php echo number_format($property_price); ?>
                                                    </span>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </div>

            <?php } else { ?>
                    <div class="row propClass" id="filterprop">
                        <?php
                        $wpnew = array(
                            'post_type' => 'property',
                            'post_status' => 'publish',
                            'posts_per_page' => 3
                        );
                        $qprop = new WP_Query($wpnew);
                        if ($qprop->have_posts()) {
                            while ($qprop->have_posts()) {
                                $qprop->the_post();
                                ?>
                                <div class="col-lg-4 col-md-6 category-item-box">
                                    <div class="category-box position-relative">
                                        <a href="<?php echo esc_url(get_permalink()); ?>">
                                            <div class="image-box position-relative">
                                            <?php if (has_post_thumbnail()) {
                                                echo get_the_post_thumbnail();
                                            } ?>
                                                <div class="category-title">
                                                    <h6>
                                                    <?php the_title(); ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="category-list-row d-flex align-items-center justify-content-between">
                                            <div class="provide-item-row">
                                                <ul class="d-flex align-items-center">
                                                    <?php
                                                    $bedrooms_image = get_theme_value('pro_bedrooms_image_icon');
                                                    $bwdrooms_qtt = get_field('bwdrooms_qtt');
                                                    $bathroom_image = get_theme_value('pro_bathrooms_image_icon');
                                                    $bathrooms_qtt = get_field('bathrooms_qtt');
                                                    $sq_ft_image = get_theme_value('pro_squ_imag_icon');
                                                    $property_area_sq = get_field('property_area_sq');
                                                    $terrace_img = get_theme_value('pro_terrace_image_icon');
                                                    $temperature = get_field('temperature');
                                                    $property_price = get_field('property_price');
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
                                                    <?php echo number_format($property_price); ?>
                                                    </span>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                    <div class="button-wrap text-center" id="loadhide">
                        <a href="javascript:void(0)" class="btn" id="LoadMoreProp">
                        <?php echo get_theme_value("load_more_button"); ?>
                        </a>
                    </div>
            <?php } ?>

        </div>
    </section>

    <!-- trusted partners start-->
    <?php get_template_part("/template_part/partner_logo"); ?>
    <!-- trusted partners end-->
</main>
<script>
    jQuery(document).ready(function ($) {
        jQuery(function ($) {
            var loadMoreButton = $('#LoadMoreProp');
            var paged = 2;
            var container = $('.propClass');

            function loadposts() {
                var data = {
                    'action': 'load_more_postsProperty',
                    'paged': paged,
                };

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (response) {
                        if (paged >= response.max) {
                            $('#LoadMoreProp').hide();
                        }
                        container.append(response.html);
                        paged++;
                    }
                });
            }
            loadMoreButton.on('click', function (e) {
                e.preventDefault();
                loadposts();
            });
        });

        // filter


        jQuery("#searchforms").submit(function () {
            event.preventDefault();

            var cat = jQuery('#procat').val();
            var min = jQuery('#min').val();
            var max = jQuery('#max').val();
            var loc = jQuery('#proloc').val();

            var area = jQuery('#area').val();
            var bhk = jQuery('#bhk').val();
            var bedroom = jQuery('#bedroom').val();
            var bathroom = jQuery('#bathroom').val();
            var type = jQuery('#type').val();
            var refid = jQuery('#refid').val();
            var fetures = jQuery('#feturess').val();
            
            jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php') ?>',
                //dataType: "json",

                data: {
                    action: 'listing_postfilter',
                    cat: cat,
                    min: min,
                    max: max,
                    loc: loc,
                    area: area,
                    bhk: bhk,
                    bedroom: bedroom,
                    bathroom: bathroom,
                    type: type,
                    refid:refid,
                    fetures:fetures,


                },
                success: function (data) {
                    jQuery('#loadhide').hide();
                    filterprop.innerHTML = data;
                    //alert(data);
                }
            });


        });
    });
</script>


<?php get_footer(); ?>
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