<section

    class="recommendations-section latest-project-section <?php echo is_singular('property') ? 'common-padding-top' : 'common-padding'; ?>">
    <div class="container">
        <div class="title-heading text-center">
            <?php $lat_prop_title = get_theme_value("lat_prop_title");
            if ($lat_prop_title != "") { ?>
                <h3>
                    <?php echo $lat_prop_title ?>
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
            $current_post_id = get_the_ID(); // Get the current post ID
            $wpnew = array(
                'post_type' => 'property',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'post__not_in'   => array($current_post_id) // Exclude the current post ID
            );
            $qprop = new WP_Query($wpnew);
            while ($qprop->have_posts()) {
                $qprop->the_post();
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
                                    <li><span><img src="<?php echo get_field('bedrooms_image'); ?>" alt=""></span>
                                        <?php echo get_field('bwdrooms_qtt'); ?>
                                    </li>
                                    <li><span><img src="<?php echo get_field('bathroom_image'); ?>" alt=""></span>
                                        <?php echo get_field('bathrooms_qtt'); ?>
                                    </li>
                                    <li><span><img src="<?php echo get_field('sq_ft_image'); ?>" alt=""></span>
                                        <?php echo get_field('property_area_sq'); ?>
                                    </li>
                                    <li><span><img
                                                src="<?php echo get_template_directory_uri() ?>/assets/images/terrace.svg"
                                                alt=""></span>26.0</li>
                                </ul>
                            </div>
                            <div class="total-price-row">
                                <span>
                                <?php echo get_field('currency'); ?><?php echo get_field('property_price'); ?>
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
    </div>
</section>