<?php
/*
Template name: Partners
*/
get_header(); ?>

<section class="partner-brand-section common-padding">
    <div class="container">
        <div class="info-wraper">
            <div class="title-heading text-center">
                <h3><?php the_content(); ?></h3>
                <p><?php echo get_field('sub_title'); ?></p>
            </div>
            <?php $partner_details = get_field('partner_details');
            echo wpautop($partner_details);
            ?>
        </div>
        <div class="brand-holder">
            <ul>
                <?php
                if (have_rows('partners')) :
                    while (have_rows('partners')) : the_row();
                ?>
                        <li><img src="<?php echo get_sub_field('partners__images'); ?>" alt=""></li>
                <?php
                    endwhile;
                endif;  ?>
            </ul>
        </div>
    </div>
</section>


<?php get_footer(); ?>