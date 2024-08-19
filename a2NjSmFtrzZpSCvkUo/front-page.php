<?php
//Template Name:Frontpage
get_header(); ?>


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
        <?php } else { ?>
            <div class="banner-bg" style="background: url(<?php echo get_template_directory_uri(); ?>/assets/images/banner.jpg);"></div>
        <?php } ?>
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
            <form action="">
                <div class="row">
                    <div class="col-lg-3 col-md-6 medium-col">
                        <div class="form-row">
                            <input type="text" class="form-control" placeholder="Property Category">
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
                            <input type="search" class="btn" placeholder="Search">
                        </div>
                    </div>
                </div>
            </form>
            <div class="drop-down-arrow text-center">
                <a href="">Less search</a>
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
    $info_image = wp_get_attachment_image($info_image_id, 'full');;
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
            <div class="banner-bg" style="background: url(<?php echo get_template_directory_uri(); ?>/assets/images/property-details.jpg);">
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
                $repeater_value = get_post_meta($page_id, 'dream_repeater', true);
                if ($repeater_value) {
                    for ($i = 0; $i < $repeater_value; $i++) {
                        $dream_property_name_key = 'dream_repeater_' . $i . '_dream_property_name';
                        $dream_property_location_key = 'dream_repeater_' . $i . '_dream_property_location';
                        $dream_property_price_key = 'dream_repeater_' . $i . '_dream_property_price';
                        $dream_property_image_key = 'dream_repeater_' . $i . '_dream_property_image';
                        $dream_property_name = get_post_meta($page_id, $dream_property_name_key, true);
                        $dream_property_location = get_post_meta($page_id, $dream_property_location_key, true);
                        $dream_property_price = get_post_meta($page_id, $dream_property_price_key, true);
                        $dream_property_image_id = get_post_meta($page_id, $dream_property_image_key, true);
                        $dream_property_image = wp_get_attachment_image_url($dream_property_image_id, 'full');

                ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="property-box position-relative">
                                <?php if (!empty($dream_property_image_id)) { ?>
                                    <div class="image-holder position-relative">
                                        <img src="<?php echo $dream_property_image; ?>" alt="">
                                    </div>
                                <?php } ?>
                                <div class="info-holder">
                                    <?php if (!empty($dream_property_name)) { ?>
                                        <h3>
                                            <?php echo $dream_property_name; ?>
                                        </h3>
                                    <?php }
                                    if (!empty($dream_property_location)) { ?>
                                        <h4>
                                            <?php echo $dream_property_location; ?>
                                        </h4>
                                    <?php }
                                    if (!empty($dream_property_price)) { ?>
                                        <h5>
                                            <?php echo $dream_property_price; ?>
                                        </h5>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                <?php }
                }
                ?>
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
            <div class="banner-bg" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/testimonial-bg.jpg);">
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
                    <h3><?php echo $title_latest_prop; ?></h3>
                <?php } ?>
                <?php $sub_title_latest_prop = get_field("sub_title_latest_prop");
                if ($sub_title_latest_prop != "") { ?>
                    <p><?php echo $sub_title_latest_prop; ?></p>
                <?php } ?>
            </div>
            <div class="row">
                <?php
                $wpnew = array(
                    'post_type' => 'property',
                    'post_status' => 'publish',
                    'posts_per_page' => 8
                );
                $q = new WP_Query($wpnew);
                while ($q->have_posts()) {
                    $q->the_post();
                ?>
                    <div class="col-lg-4 col-md-6 category-item-box">
                        <div class="category-box position-relative">
                            <div class="image-box position-relative">
                                <?php echo get_the_post_thumbnail(); ?>
                                <div class="category-title">
                                    <h6><?php ?></h6>
                                </div>
                            </div>
                            <div class="category-list-row d-flex align-items-center justify-content-between">
                                <div class="provide-item-row">
                                    <ul class="d-flex align-items-center">
                                        <li><span><img src="<?php echo get_template_directory_uri() ?>/assets/images/bed.svg" alt=""></span>2</li>
                                        <li><span><img src="<?php echo get_template_directory_uri() ?>/assets/images/bathroom.svg" alt=""></span>2</li>
                                        <li><span><img src="<?php echo get_template_directory_uri() ?>/assets/images/home.svg" alt=""></span>101.0</li>
                                        <li><span><img src="<?php echo get_template_directory_uri() ?>/assets/images/terrace.svg" alt=""></span>26.0</li>
                                    </ul>
                                </div>
                                <div class="total-price-row">
                                    <span>€292,500</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
            <div class="button-wrap text-center">
                <a href="" class="btn">View all Recommended Propertise</a>
            </div>
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
                'orderby' => 'rand',
                'posts_per_page' => 4,
            );
            $blogs = new WP_Query($args);
            if ($blogs->have_posts()) { ?>
                <div class="row">
                    <?php while ($blogs->have_posts()) {
                        $blogs->the_post(); ?>
                        <div class="col-lg-3 col-md-6 card-item-box">
                            <div class="card-box">
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
                                <div class="card-info">
                                    <h6>
                                        <?php the_title(); ?>
                                    </h6>
                                    <p>
                                        <?php the_excerpt(); ?>
                                    </p>
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

    <!-- trusted partners start-->
    <?php get_template_part("/template_part/partner_logo"); ?>
    <!-- trusted partners end-->

</main>
<!-- body section end -->
<?php get_footer(); ?>