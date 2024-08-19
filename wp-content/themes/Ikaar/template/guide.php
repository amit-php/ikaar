<?php
//Template Name:Guide
get_header();
$page_id = get_queried_object_id();
?>
<main>
    <section class="hero-banner inner-banner position-relative">
        <?php $banner_image_guide = get_field("banner_image_guide");
        if ($banner_image_guide != "") { ?>
            <div class="banner-bg" style="background: url(<?php echo $banner_image_guide; ?>);"></div>
        <?php } ?>
        <div class="container-holder">
            <div class="container overlay-content">
                <div class="banner-info">
                    <?php $banner_title_guide = get_field("banner_title_guide");
                    if ($banner_title_guide != "") { ?>
                        <h1>
                            <?php echo $banner_title_guide; ?>
                        </h1>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- MARBELLA'S PRIME LOCATIONS -->
    <?php $hide_MARBELLA = get_post_meta($page_id, '_hide_MARBELLA', true);
    if ($hide_MARBELLA == "Show") {
        ?>
        <section class="dream-proparty-section common-padding-top">
            <div class="container">
                <div class="title-heading text-center">
                    <?php $title_marbellas = get_field("title_marbellas");
                    if ($title_marbellas != "") { ?>
                        <h3>
                            <?php echo $title_marbellas; ?>
                        </h3>
                    <?php } ?>
                    <?php $sub_title_marbellas = get_field("sub_title_marbellas");
                    if ($sub_title_marbellas != "") { ?>
                        <p>
                            <?php echo $sub_title_marbellas; ?>
                        </p>
                    <?php } ?>
                </div>
                <div class="row addrowss">
                    <?php
                    $publish_args = array(
                        'post_type' => 'area_guide',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
                    );
                    $publish_posts = new WP_Query($publish_args);

                    //check
                    if ($publish_posts->have_posts()) {
                        //loop
                        while ($publish_posts->have_posts()) {
                            $publish_posts->the_post(); ?>
                            <div class="col-lg-3 col-md-6">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="property-box position-relative">
                                        <div class="image-holder position-relative">
                                            <?php echo get_the_post_thumbnail(); ?>
                                        </div>
                                        <div class="info-holder">
                                            <h3>
                                                <?php the_title() ?>
                                            </h3>
                                            <?php $location_ids = get_post_meta(get_the_ID(), 'select_area', true);
                                            // print_r($location_ids);
                                            foreach ($location_ids as $location_id) {
                                                $term = get_term($location_id);
                                                if ($term && !is_wp_error($term)) { ?>
                                                    <h4>
                                                        <?php echo $term->name; ?>
                                                    </h4>
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                    } ?>
                </div>
                <div class="button-row mt-5 text-center">
                    <a id="guidebot" href="javascript:void(0)" class="btn">
                        <?php echo get_theme_value("view_more_btn_txt"); ?>
                    </a>
                </div>

            </div>
        </section>
    <?php } ?>

    <!-- MARBELLA'S PRIME LOCATIONS end-->

    <!-- Sed ut perspiciatis -->
    <?php $PERSPICIATIS_A = get_post_meta($page_id, '_PERSPICIATIS_AA', true);
    if ($PERSPICIATIS_A == "Show") { ?>
        <section class="perspiciatis-section">
            <?php $background_image_sed = get_field("background_image_sed");
            if ($background_image_sed != "") { ?>
                <div class="banner-bg" style="background: url(<?php echo $background_image_sed; ?>);"></div>
            <?php } ?>
            <div class="info-holder text-center">
                <?php $title_sed = get_field("title_sed");
                if ($title_sed != "") { ?>
                    <h3>
                        <?php echo $title_sed; ?>
                    </h3>
                <?php } ?>
                <?php $sub_title_sed = get_field("sub_title_sed");
                if ($sub_title_sed != "") { ?>
                    <p>
                        <?php echo $sub_title_sed; ?>
                    </p>
                <?php } ?>
                <?php $buttom_text_sed = get_field("buttom_text_sed");
                if ($buttom_text_sed != "") { ?>
                    <a href="<?php echo get_field('url_sed'); ?>" class="btn">
                        <?php echo $buttom_text_sed; ?>
                    </a>
                <?php } ?>
            </div>
        </section>
    <?php } ?>
    <!-- Sed ut perspiciatis end-->

    <!-- BUYERS GUIDE -->
    <section class="common-design common-margin">
        <?php $title_buyers = get_post_meta($page_id, 'title_buyers', true);
        $sub_title_buyers = get_post_meta($page_id, 'sub_title_buyers', true);
        $buyers_guide_content = get_post_meta($page_id, 'buyers_guide_content', true);
        $buyers_guide_image_id = get_post_meta($page_id, 'buyers_guide_image', true);
        $buyers_guide_image = wp_get_attachment_image_url($buyers_guide_image_id, 'full');
        $buyers_guide_button = get_post_meta($page_id, 'buyers_guide_button', true); ?>
        <div class="container">
            <div class="title-heading text-center">
                <?php if (!empty($title_buyers)) { ?>
                    <h3>
                        <?php echo $title_buyers; ?>
                    </h3>
                <?php }
                if (!empty($sub_title_buyers)) { ?>
                    <p>
                        <?php echo $sub_title_buyers; ?>
                    </p>
                <?php } ?>
            </div>
        </div>
        <div class="perspiciatis-section">
            <?php if (!empty($buyers_guide_image)) { ?>
                <div class="banner-bg" style="background: url(<?php echo $buyers_guide_image; ?>);">
                </div>
            <?php } ?>
            <div class="info-holder text-center">
                <?php if (!empty($buyers_guide_content)) { ?>
                    <p>
                        <?php echo $buyers_guide_content ?>
                    </p>
                <?php }
                if (!empty($buyers_guide_button['title'])) { ?>
                    <a href="<?php echo $buyers_guide_button['url']; ?>" class="btn">
                        <?php echo $buyers_guide_button['title']; ?>
                    </a>
                <?php } ?>
            </div>
        </div>

    </section>
    <!-- BUYERS GUIDE end-->

    <!-- SELLERS GUIDE -->
    <section class="common-design">
        <?php $title_seller = get_post_meta($page_id, 'title_seller', true);
        $sub_titltle_seller = get_post_meta($page_id, 'sub_titltle_seller', true);
        $seller_guide_content = get_post_meta($page_id, 'seller_guide_content', true);
        $seller_guide_image_id = get_post_meta($page_id, 'seller_guide_image', true);
        $seller_guide_image = wp_get_attachment_image_url($seller_guide_image_id, 'full');
        $seller_guide_button = get_post_meta($page_id, 'seller_guide_button', true); ?>
        <div class="container">
            <div class="title-heading text-center">
                <?php if (!empty($title_seller)) { ?>
                    <h3>
                        <?php echo $title_seller; ?>
                    </h3>
                <?php }
                if (!empty($sub_titltle_seller)) { ?>
                    <p>
                        <?php echo $sub_titltle_seller; ?>
                    </p>
                <?php } ?>
            </div>
        </div>
        <div class="perspiciatis-section">
            <?php if (!empty($seller_guide_image)) { ?>
                <div class="banner-bg" style="background: url(<?php echo $seller_guide_image; ?>);">
                </div>
            <?php } ?>
            <div class="info-holder text-center">
                <?php if (!empty($seller_guide_content)) { ?>
                    <p>
                        <?php echo $seller_guide_content; ?>
                    </p>
                <?php }
                if (!empty($seller_guide_button['title'])) { ?>
                    <a href="<?php echo $seller_guide_button['url']; ?>" class="btn">
                        <?php echo $seller_guide_button['title']; ?>
                    </a>
                <?php } ?>
            </div>
        </div>

    </section>
    <!-- SELLERS GUIDE end-->

    <!-- GOLDEN VISA GUIDE -->
    <section class=" common-design common-margin mb-0">
        <?php $title_golden = get_post_meta($page_id, 'title_golden', true);
        $sub_title_golden = get_post_meta($page_id, 'sub_title_golden', true);
        $gv_content = get_post_meta($page_id, 'gv_content', true);
        $gv_img_id = get_post_meta($page_id, 'gv_img', true);
        $gv_img = wp_get_attachment_image_url($gv_img_id, 'full');
        $gv_button = get_post_meta($page_id, 'gv_button', true); ?>
        <div class="container">
            <div class="title-heading text-center">
                <?php if (!empty($title_golden)) { ?>
                    <h3>
                        <?php echo $title_golden; ?>
                    </h3>
                <?php }
                if (!empty($sub_title_golden)) { ?>
                    <p>
                        <?php echo $sub_title_golden; ?>
                    </p>
                <?php } ?>
            </div>
        </div>
        <div class="perspiciatis-section">
            <?php if (!empty($gv_img)) { ?>
                <div class="banner-bg" style="background: url(<?php echo $gv_img; ?>);">
                </div>
            <?php } ?>
            <div class="info-holder text-center">
                <?php if (!empty($gv_content)) { ?>
                    <p>
                        <?php echo $gv_content; ?>
                    </p>
                <?php }
                if (!empty($gv_button['title'])) { ?>
                    <a href="<?php echo $gv_button['url']; ?>" class="btn">
                        <?php echo $gv_button['title']; ?>
                    </a>
                <?php } ?>
            </div>
        </div>

    </section>
    <!-- GOLDEN VISA GUIDE end-->

    <!-- trusted partners start-->
    <?php get_template_part("/template_part/partner_logo"); ?>
    <!-- trusted partners end-->
</main>

<?php get_footer(); ?>

<script>
    jQuery(document).ready(function ($) {
        jQuery(function ($) {
            var loadMoreButton = $('#guidebot');
            var paged = 2;
            var container = $('.addrowss');

            function loadposts() {
                var data = {
                    'action': 'guide_post',
                    'paged': paged,
                };

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (response) {
                        if (paged >= response.max) {
                            $('#guidebot').hide();
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
    });
</script>