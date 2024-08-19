<?php get_header(); ?>
<!-- body section start -->
<main>
    <section class="hero-banner inner-banner position-relative">
        <!-- -->
        <?php $banner_image_teamsingle = get_field("banner_image_teamsingle");
        if ($banner_image_teamsingle != "") { ?>
            <div class="banner-bg" style="background: url(<?php echo $banner_image_teamsingle; ?>);"></div>
        <?php } else {
        ?>
            <div class="banner-bg" style="background: url(<?php echo get_template_directory_uri(); ?>/assets/images/contact-banner.jpg);"></div>
        <?php
        } ?>
        <div class="container-holder">
            <div class="container overlay-content">
                <?php $banner_title_team_single = get_field("banner_title_team_single");
                if ($banner_title_team_single != "") { ?>
                    <div class="banner-info">
                        <h1><?php echo $banner_title_team_single; ?></h1>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
    ?>
            <section class="team-details-section common-padding">
                <div class="container container-custome">
                    <div class="details-box">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="image-box"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt=""></div>
                            </div>
                            <div class="col-md-8">
                                <div class="info-box">
                                    <h3><?php the_title(); ?></h3>
                                    <?php the_content(); ?>
                                    <ul class="d-flex">
                                        <li> <?php $responsibility_title = get_field("responsibility_title");
                                                if ($responsibility_title != "") { ?>
                                                <span><?php echo $responsibility_title; ?></span>
                                            <?php } ?>
                                            <?php $responsibilty = get_field("responsibilty");
                                            if ($responsibilty != "") { ?>
                                                <span><?php echo $responsibilty; ?></span>
                                            <?php } ?>
                                        </li>
                                        <li>
                                            <?php $mail_info = get_field("mail_info");
                                            if ($mail_info != "") { ?>
                                                <span><?php echo $mail_info; ?></span>
                                            <?php } ?>
                                            <?php $email__id = get_field("email__id");
                                            if ($email__id != "") { ?>
                                                <span><a href="mailto:<?php echo get_field('email__id'); ?>"><?php echo $email__id; ?></a></span><?php } ?>
                                        </li>
                                        <li>
                                            <?php $experience = get_field("experience");
                                            if ($experience != "") { ?>
                                                <span><?php echo $experience; ?></span>
                                            <?php } ?>
                                            <?php $experience_in_year = get_field("experience_in_year");
                                            if ($experience_in_year != "") { ?>
                                                <span><?php echo $experience_in_year; ?></span><?php } ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="experience-box">
                        <?php $title_pe = get_field("title_pe");
                        if ($title_pe != "") { ?>
                            <h3><?php echo $title_pe; ?></h3>
                        <?php } ?>
                        <?php $content_pe = get_field('content_pe');
                        echo wpautop($content_pe);
                        ?>
                    </div>
                </div>
            </section>
    <?php
        }
    }
    ?>
    <section class="map-section">
        <div class="container-fluid">
            <?php $map_url = get_field("map_url");
            if ($map_url != "") { ?>
                <div class="map-holder">
                    <iframe src="<?php echo $map_url; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- trusted partners -->

    <?php get_template_part("/template_part/partner_logo");
    ?>

    <!-- trusted partners end-->
</main>
<!-- body section end -->
<?php get_footer(); ?>