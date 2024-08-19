<?php get_header(); ?>
<main>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $banner_image_id = get_post_meta($post->ID, 'banner_image', true);
            $bannerimage = wp_get_attachment_image_url($banner_image_id);
            $blog_banner_text = get_post_meta(get_the_ID(), 'blog_banner_text', true);
            if (!empty($banner_image_id)) {
                ?>
                <section class="hero-banner inner-banner position-relative">
                    <div class="banner-bg" style="background: url(<?php echo $bannerimage; ?>);"></div>
                    <?php if (!empty($blog_banner_text)) { ?>
                        <div class="container-holder">
                            <div class="container overlay-content">
                                <div class="banner-info">
                                    <h1>
                                        <?php echo $blog_banner_text; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </section>
            <?php } else { ?>
                <section class="hero-banner inner-banner position-relative">
                    <div class="banner-bg"
                        style="background: url(<?php echo get_template_directory_uri(); ?>/assets/images/inner-banner.jpg);">
                    </div>
                    <?php $title = get_post_field("post_title", 77);
                    if (!empty($title)) { ?>
                        <div class="container-holder">
                            <div class="container overlay-content">
                                <div class="banner-info">
                                    <h1>
                                        <?php echo $title; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </section>
            <?php } ?>

            <section class="blog-details-section details-section common-padding-top">
                <div class="container">
                    <div class="details-wraper">
                        <div class="section-title text-center">
                            <h2>
                                <?php the_title() ?>
                            </h2>
                            <h4>
                                <?php echo get_the_date(); ?> by
                                <?php the_author(); ?>
                            </h4>
                        </div>
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="image-box">
                                <?php echo get_the_post_thumbnail(); ?>
                            </div>
                        <?php }
                        the_content(); ?>
                    </div>
                </div>
            </section>
        <?php }
    }
    ?>
    <?php get_template_part("/template_part/trusted_partners") ?>;
</main>
<?php get_footer(); ?>