<?php get_header();
$service_id = $post->ID;
//$slug = get_post_field('post_name', $service_id);
//echo $slug; ?>
<!-- body section start -->
<main>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>
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
    <?php //get_template_part("/template_part/latest_property"); ?>
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
                $posts_per_page=3;
                $wpnew = array(
                    'post_type' => 'property',
                    'post_status' => 'publish',
                    'posts_per_page' => $posts_per_page,
                    'meta_query' => array(
                        array(
                            'key' => 'service_type',
                            'value' => $service_id,
                        ),
                    ),
                );
                $qprop = new WP_Query($wpnew);
                $total_count=$qprop->found_posts;
                if ($qprop->have_posts()) {
                    while ($qprop->have_posts()) {
                        $qprop->the_post();
                        // $meta=get_post_meta(get_the_ID(),'service_type',true);
                        // print_r($meta);
                        ?>
                        <div class="col-lg-4 col-md-6 category-item-box">
                            <div class="category-box position-relative">
                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                    <div class="image-box position-relative">
                                        <?php echo get_the_post_thumbnail(); ?>
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
                                            <li><span><img src="<?php echo get_theme_value('pro_bedrooms_image_icon'); ?>" alt=""></span>
                                                <?php echo get_field('bwdrooms_qtt'); ?>
                                            </li>
                                            <li><span><img src="<?php echo get_theme_value('pro_bathrooms_image_icon'); ?>" alt=""></span>
                                                <?php echo get_field('bathrooms_qtt'); ?>
                                            </li>
                                            <li><span><img src="<?php echo get_theme_value('pro_squ_imag_icon'); ?>" alt=""></span>
                                                <?php echo get_field('property_area_sq'); ?>
                                            </li>
                                            <li><span><img
                                                        src="<?php echo get_theme_value('pro_terrace_image_icon');?>"
                                                        alt=""></span><?php echo get_field('terrace_size:'); ?></li>
                                        </ul>
                                    </div>
                                    <div class="total-price-row">
                                        <span>
                                        <?php echo get_theme_value('pro_currency'); ?><?php echo get_field('property_price'); ?>
                                        </span>
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
                } ;
                if($total_count>$posts_per_page){ ?>
                <div class="button-wrap text-center">
                    <a class="btn" href="<?php echo get_the_permalink(64) ; ?>/?service=<?php echo $service_id; ?>">view all</a>
               <?php } ?>
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
