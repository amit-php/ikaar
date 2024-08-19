<?php
//Template Name:Services
get_header();
?>

<main>
    <section class="hero-banner inner-banner position-relative">
        <?php $banner_image_service = get_field("banner_image_service");
        if ($banner_image_service != "") { ?>
            <div class="banner-bg" style="background: url(<?php echo $banner_image_service; ?>);"></div>
        <?php } ?>
        <div class="container-holder">
            <div class="container overlay-content">
                <?php $banner_title_services = get_field("banner_title_services");
                if ($banner_title_services != "") { ?>
                    <div class="banner-info">
                        <h1><?php echo $banner_title_services; ?></h1>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="service-section body-bg common-padding-top">
        <div class="container">
            <div class="row">
                <?php
                $wpnew = array(
                    'post_type' => 'services',
                    'post_status' => 'publish',
                    'posts_per_page' => -1
                );
                $q = new WP_Query($wpnew);
                while ($q->have_posts()) {
                    $q->the_post();
                ?>
                    <div class="col-lg-4 col-md-6 service-item-box">
                        <a href="<?php the_permalink(); ?>">
                            <div class="service-box">
                                <div class="image-box">
                                    <?php echo get_the_post_thumbnail(); ?> </div>
                                <div class="title-box">
                                    <h3> <?php the_title(); ?></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <!-- trusted partners start-->
    <?php get_template_part("/template_part/partner_logo"); ?>
    <!-- trusted partners end-->
</main>
<?php get_footer(); ?>