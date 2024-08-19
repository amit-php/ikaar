<?php
//Template Name:ContactedPropertiesBuyer
get_header('dashboard');
?>
<main>
    <div class="dashbord-section common-padding">
        <div class="container">
            <div class="dashbord-inner-row align-items-start d-flex">
                <?php get_template_part('/buyer-dashboard/dashboard_menu_buyer');
                $user_id = $current_user->ID; ?>
                <div class="dashboard-info">
                    <div class="properties-section">
                        <div class="title-heading">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                        </div>
                        <div class="card-blog-wraper">
                            <?php
                            $outargs = array(
                                'post_type' => 'enquiry',
                                'post_status' => 'publish',
                                'author' => $user_id,
                                'posts_per_page' => -1,
                            );
                            $enquries = new WP_Query($outargs);

                            if ($enquries->have_posts()) {
                                $propIDs = [];
                                while ($enquries->have_posts()) {
                                    $enquries->the_post();
                                    $property_id = get_post_meta(get_the_ID(), 'current_post_id', true);

                                    array_push($propIDs, $property_id);
                                }
                            }

                            wp_reset_postdata();
                            if (!empty($propIDs)) {
                                $prop_arg = array(
                                    'post_type' => 'property',
                                    'post_status' => 'publish',
                                    'post__in' => $propIDs,
                                    'posts_per_page' => -1
                                );
                                $properties = new WP_Query($prop_arg);
                                if ($properties->have_posts()) { ?>
                                    <div class="row">
                                        <?php while ($properties->have_posts()) {
                                            $properties->the_post();
                                            $post_id = get_the_ID();
                                            $featured_img_id = get_post_thumbnail_id();
                                            $featured_img = wp_get_attachment_image($featured_img_id, array('100', '91'));
                                            $property_area_sq = get_post_meta(get_the_ID(), 'property_area_sq', true);
                                            $currency = get_post_meta(get_the_ID(), 'currency', true);
                                            $property_price = get_post_meta(get_the_ID(), 'property_price', true);
                                            $ref_no = get_post_meta(get_the_ID(), 'ref_no', true);
                                            $built_size = get_post_meta(get_the_ID(), 'built_size', true);
                                            $terrace_size = get_post_meta(get_the_ID(), 'terrace_size:', true);
                                            $bedrooms_image_id = get_post_meta(get_the_ID(), 'bedrooms_image', true);
                                            $bedrooms_image = wp_get_attachment_image($bedrooms_image_id, 'full');
                                            $bwdrooms_qtt = get_post_meta(get_the_ID(), 'bwdrooms_qtt', true);
                                            $bathroom_image_id = get_post_meta(get_the_ID(), 'bathroom_image', true);
                                            $bathroom_image = wp_get_attachment_image($bathroom_image_id, 'full');
                                            $location = get_the_terms(get_the_ID(), 'property_location');
                                            $bathrooms_qtt = get_post_meta(get_the_ID(), 'bathrooms_qtt', true);
                                            ?>
                                            <div class="col-md-6 card-blog-item">
                                                <div class="card-blog">
                                                    <div class="card-blog-row d-flex align-items-start">
                                                        <?php if (!empty($featured_img)) { ?>
                                                            <div class="image-box">
                                                                <?php echo $featured_img; ?>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="info-box">
                                                            <h6>
                                                                <?php the_title(); ?>
                                                            </h6>
                                                            <div class="location-wrap">
                                                                <ul class="d-flex">
                                                                    <?php if (!empty($location)) { ?>
                                                                        <li>
                                                                            <?php echo $location[0]->name; ?>
                                                                        </li>
                                                                    <?php }
                                                                    if (!empty($ref_no)) { ?>
                                                                        <li>
                                                                            <?php echo $ref_no; ?>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                            <div class="provide-item-row">
                                                                <ul class="d-flex align-items-center">
                                                                    <li><span>
                                                                            <?php echo $bedrooms_image ?>
                                                                        </span>
                                                                        <?php echo $bwdrooms_qtt; ?>
                                                                    </li>
                                                                    <li><span>
                                                                            <?php echo $bathroom_image ?>
                                                                        </span>
                                                                        <?php echo $bathrooms_qtt; ?>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <?php if (!empty($currency) || !empty($property_price)) { ?>
                                                                <h6 class="price-wrap">
                                                                    <?php echo $currency; ?>
                                                                    <?php echo $property_price; ?>
                                                                </h6>
                                                            <?php } ?>
                                                            <div class="bottom-row">
                                                                <div class="size-box">
                                                                    <?php if (!empty($built_size)) { ?>
                                                                        <p>
                                                                            <?php echo $built_size; ?>
                                                                        </p>
                                                                    <?php }
                                                                    if (!empty($terrace_size)) { ?>
                                                                        <p>
                                                                            <?php echo $terrace_size; ?>
                                                                        </p>
                                                                    <?php } ?>
                                                                </div>
                                                                <!-- <div class="button-holder">
                                                                    <ul class="d-flex">
                                                                        <li class="list-btn"><a href="javascript:void(0)"
                                                                                class="heart-link" id="<?php //echo $post_id; ?>"><img
                                                                                    src="<?php //echo get_template_directory_uri(); ?>/assets/auth/images/icon-heart.svg"
                                                                                    alt=""></a></li>
                                                                    </ul>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    </div>
                                <?php }
                                wp_reset_postdata();
                            } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script>

    jQuery(document).ready(function () {

        jQuery(".heart-link img").click(function () {

            var postId = jQuery(this).parent().attr("id");
            jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php') ?>',
                data: {
                    action: 'single_property',
                    postId: postId,

                },
                success: function (data) {
                    alert(data);
                }

            });
        });
    });
</script>
<?php get_footer(); ?>