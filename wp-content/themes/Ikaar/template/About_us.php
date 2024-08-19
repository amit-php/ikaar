<?php
//Template Name:Aboutus
get_header();
?>

<main>
    <section class="hero-banner inner-banner position-relative">
        <?php $banner_image_about = get_field("banner_image_about");
        if ($banner_image_about != "") { ?>
            <div class="banner-bg" style="background: url(<?php echo $banner_image_about; ?>);"></div>
        <?php } ?>
        <div class="container-holder">
            <div class="container overlay-content">
                <?php $banner_title_about = get_field("banner_title_about");
                if ($banner_title_about != "") { ?>
                    <div class="banner-info">
                        <h1>
                            <?php echo $banner_title_about; ?>
                        </h1>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- about -->
    <section class="about-section common-padding">
        <div class="container container-custome">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <?php $about_image = get_field("about_image");
                    if ($about_image != "") { ?>
                        <div class="iamge-holder position-relative"><img src="<?php echo $about_image; ?>" alt=""></div>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <div class="info-holder">
                        <div class="title-heading">
                            <?php $about_title = get_field("about_title");
                            if ($about_title != "") { ?>
                                <h3>
                                    <?php echo $about_title; ?>
                                </h3>
                            </div>
                        <?php } ?>
                        <?php $about_content = get_field('about_content');
                        echo wpautop($about_content);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about end-->

    <!-- FUGIAT -->
    <section class="property-details-section position-relative">
        <?php $background_image_fugiat = get_field("background_image_fugiat");
        if ($background_image_fugiat != "") { ?>
            <div class="banner-bg" style="background: url(<?php echo $background_image_fugiat; ?>"></div>
        <?php } ?>
        <div class="container-holder">
            <div class="container">
                <div class="info-wrap info-meet-wrap text-center">
                    <?php $title_fugiat = get_field("title_fugiat");
                    if ($title_fugiat != "") { ?>
                        <div class="section-title">
                            <h3>
                                <?php echo $title_fugiat; ?>
                            </h3>
                        </div>
                    <?php } ?>
                    <?php $content_fugiat = get_field('content_fugiat');
                    echo wpautop($content_fugiat);
                    ?>
                    <?php $button_text_fugiat = get_field("button_text_fugiat");
                    if ($button_text_fugiat != "") { ?>
                        <a href="<?php echo get_field('url_fugiat') ?>" class="btn">
                            <?php echo $button_text_fugiat; ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- FUGIAT end-->

    <!-- team -->
    <section class="team-section common-padding">
        <div class="container">
            <?php $title_theteam = get_field("title_theteam");
            if ($title_theteam != "") { ?>
                <div class="title-heading text-center">
                    <h3>
                        <?php echo $title_theteam; ?>
                    </h3>
                </div>
            <?php } ?>
            <div class="row">
                <?php
                $wpnew = array(
                    'post_type' => 'team',
                    'post_status' => 'publish',
                    'posts_per_page' => 4,
                    'order' => 'DESC',
                );
                $q = new WP_Query($wpnew);
                while ($q->have_posts()) {
                    $q->the_post();
                    ?>

                    <div class="col-lg-3 col-md-6 team-box-item">
                        <a href="<?php the_permalink(); ?>">
                            <div class="team-box position-relative">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="team-image position-relative">
                                        <?php echo get_the_post_thumbnail(); ?>
                                    </div>
                                </a>
                                <div class="team-info">
                                    <h5><a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                            <a></h5>
                                    <h6>
                                        
                                        <?php
                                       echo $excerpt= get_post_field('post_excerpt',$post->ID)
                                       // $excerpt = str_replace('<p>', '', $excerpt);
                                       // $excerpt = str_replace('</p>', '', $excerpt);
                                      // echo $excerpt;
                                       ?>
                                    </h6>
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
    <!-- team end-->

    <!-- BUY, SELL -->
    <?php $back_ground_image_buy = get_field("back_ground_image_buy");
    if ($back_ground_image_buy != "") { ?>
        <section class="hassle-section position-relative common-padding"
            style="background-image: url(<?php echo $back_ground_image_buy; ?>);">
            <div class="container">
                <div class="info-wraper text-center">
                    <?php $tutle_buy = get_field("tutle_buy");
                    if ($tutle_buy != "") { ?>
                        <h3>
                            <?php echo $tutle_buy; ?>
                        </h3>
                    <?php } ?>
                    <?php $content_buy = get_field('content_buy');
                    echo wpautop($content_buy);
                    ?>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- BUY, SELL end-->

    <!-- video -->

    <?php get_template_part('/template_part/video_section'); ?>

    <!-- video end-->

    <!-- our history -->
    <section class="history-section common-padding-top">
        <div class="container">
            <div class="info-wrap text-center">
                <?php $title_ourhistory = get_field("title_ourhistory");
                if ($title_ourhistory != "") { ?>
                    <h3>
                        <?php echo $title_ourhistory; ?>
                    </h3>
                <?php } ?>
                <?php $content_ourhistory = get_field('content_ourhistory');
                echo wpautop($content_ourhistory);
                ?>
            </div>
        </div>
    </section>
    <!-- our history end -->

    <!-- trusted partners -->

    <?php get_template_part("/template_part/partner_logo");
    ?>

    <!-- trusted partners end-->

</main>
<?php get_footer(); ?>