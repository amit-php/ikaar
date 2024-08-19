<?php get_header();
//$service_id = $post->ID;
//$slug = get_post_field('post_name', $service_id);
//echo $slug; ?>
<!-- body section start -->
<main>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();

            //print_r($term_id); ?>

            <section class="hero-banner inner-banner position-relative">
                <div class="banner-bg" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
                <div class="container-holder">
                    <div class="container overlay-content">
                        <div class="banner-info">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="service-details-section details-section body-bg">
                <div class="container">
                    <div class="details-wraper">
                        <div class="section-title text-center">
                            <h2>
                                <?php echo get_field('sub_title_subdet'); ?>
                            </h2>
                            <h4>
                                <?php echo strtoupper(get_the_date("j M, Y")); ?>
                                by
                                <?php echo get_the_author(); ?>
                            </h4>
                        </div>
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
            <?php
        }
    }
    ?>
    <!-- latest product -->
    <?php //get_template_part("/template_part/latest_property"); 
    $post_id = get_queried_object_id();
    $term_id = get_post_meta($post_id, 'select_area', true); ?>
    <section class="recommendations-section latest-project-section common-padding">
        <div class="container">
            <div class="title-heading text-center">
                <?php $lat_prop_title = get_theme_value("lat_prop_title");
                if ($lat_prop_title != "") { ?>
                    <h3>
                        <?php echo $lat_prop_title . ' ' . get_the_title(); ?>
                    </h3>
                <?php } ?>
                <?php $lat_prop_sub_title = get_theme_value("lat_prop_sub_title");
                if ($lat_prop_sub_title != "") { ?>
                    <p>
                        <?php echo $lat_prop_sub_title ?>
                    </p>
                <?php } ?>
            </div>
            <div class="row">
                <?php
                $posts_per_page = 9;
                $wpnew = array(
                    'post_type' => 'property',
                    'post_status' => 'publish',
                    'posts_per_page' => $posts_per_page,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'property_location', // Replace with your custom taxonomy slug
                            'field' => 'id',
                            'terms' => $term_id,
                            'operator' => 'IN',
                        ),
                    ),
                );

                $qprop = new WP_Query($wpnew);
                $total_count = $qprop->found_posts;
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
                    ?>
                </div>
            <?php } else {
                    echo "No Related Post is Found";
                }
                ;
                if ($total_count > $posts_per_page) { ?>
                <div class="button-wrap text-center">

                    <!-- <a class="btn"
                        href="<?php //echo get_the_permalink(64) ?>?<?php //echo http_build_query(array("location" => $term_id)); ?>">
                        view
                    </a> -->
                <?php } ?>

                </a>
            </div>
        </div>
    </section>
    <!-- latest product end-->

    <!-- trusted partners start-->
    <?php get_template_part("/template_part/partner_logo"); ?>
    <!-- trusted partners end-->
</main>
<!-- body section end -->
<?php get_footer(); ?>