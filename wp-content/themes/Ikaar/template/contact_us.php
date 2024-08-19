<?php
//Template Name:Contactus
get_header();
?>
<main>
    <section class="hero-banner inner-banner position-relative">
        <?php $banner_image_contact = get_field("banner_image_contact");
        if ($banner_image_contact != "") { ?>
            <div class="banner-bg" style="background: url(<?php echo $banner_image_contact; ?>);"></div>
        <?php } ?>
        <div class="container-holder">
            <div class="container overlay-content">
                <?php $banner_title_contact = get_field("banner_title_contact");
                if ($banner_title_contact != "") { ?>
                    <div class="banner-info">
                        <h1><?php echo $banner_title_contact; ?></h1>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- form -->
    <section class="contact-section contact-contact-section  common-padding-top">
        <div class="container ">
            <div class="contact-wraper common-padding">
                <div class="title-heading text-center">
                    <?php $form_title_contact = get_field("form_title_contact");
                    if ($form_title_contact != "") { ?>
                        <h3><?php echo $form_title_contact; ?></h3>
                    <?php } ?>
                    <?php $form_sub_title_contact = get_field("form_sub_title_contact");
                    if ($form_sub_title_contact != "") { ?>
                        <p><?php echo $form_sub_title_contact; ?></p>
                    <?php } ?>
                </div>
                <div class="form-wraper">

                    <?php
                    if (get_field('from_shortcode_contact')) {
                        echo do_shortcode(get_field('from_shortcode_contact'));
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- form end -->
    <section class="contact-info-section common-padding">
        <div class="container container-custome">
            <div class="contact-list">
                <ul class="d-flex justify-content-between">
                    <li>
                        <?php $tel_image = get_field("tel_image");
                        if ($tel_image != "") { ?>
                            <div class="button-wrap">
                                <span><img src="<?php echo $tel_image; ?>" alt=""></span>
                            </div>
                        <?php } ?>
                        <div class="info-wrap">
                            <p>
                                <?php
                                if (have_rows('tel_numbers')) :
                                    while (have_rows('tel_numbers')) : the_row();
                                ?>
                                        <a href="tel:<?php echo get_sub_field('number_1'); ?>"><?php echo get_sub_field('number_1'); ?></a>
                                <?php
                                    endwhile;
                                endif;
                                ?>
                            </p>
                        </div>
                    </li>
                    <li>
                        <?php $email_image = get_field("email_image");
                        if ($email_image != "") { ?>
                            <div class="button-wrap">
                                <span><img src="<?php echo $email_image; ?>" alt=""></span>
                            </div>
                        <?php } ?>
                        <div class="info-wrap">
                            <?php $email_id = get_field("email_id");
                            if ($email_id != "") { ?>
                                <p>
                                    <a href="mailto:<?php echo get_field('email_id'); ?>"><?php echo $email_id; ?></a>
                                </p>
                            <?php } ?>
                        </div>
                    </li>
                    <li>
                        <?php $location_image = get_field("location_image");
                        if ($location_image != "") { ?>
                            <div class="button-wrap">
                                <span><img src="<?php echo $location_image; ?>" alt=""></span>
                            </div>
                        <?php } ?>
                        <div class="info-wrap">
                            <?php $location_detail = get_field("location_detail");
                            if ($location_detail != "") { ?>
                                <p>
                                    <a href=""><?php echo $location_detail; ?></a>
                                </p>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="map-section">
        <div class="container-fluid">
            <?php $map_url_contct = get_field("map_url_contct");
            if ($map_url_contct != "") { ?>
                <div class="map-holder">
                    <iframe src="<?php echo $map_url_contct;  ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- trusted partners -->

    <?php get_template_part("/template_part/partner_logo");
    ?>

    <!-- trusted partners end-->
</main>
<?php get_footer(); ?>