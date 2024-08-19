<?php
/*
Template name:Collaborate us
*/
get_header(); ?>
<section class="common-padding collaborate-section">
    <div class="container">
        <div class="title-heading text-center">
            <?php $title_collaborate = get_field("title_collaborate");
            if ($title_collaborate != "") { ?>
                <h1><?php echo $title_collaborate; ?></h1>
            <?php } ?>
            <?php $content_collaborate = get_field('content_collaborate');
            echo wpautop($content_collaborate);
            ?>
        </div>
        <div class="collaborate-contact-wraper">
            <div class="form-wraper">
                <?php
                if (get_field('form_shortcode')) {
                    echo do_shortcode(get_field('form_shortcode'));
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>