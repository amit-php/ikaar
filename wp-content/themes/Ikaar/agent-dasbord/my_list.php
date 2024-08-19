<?php
//Template Name:MyListAgent
get_header('dashboard');
$page_id = get_queried_object_id();
?>

<main>
    <div class="dashbord-section common-padding">
        <div class="container">
            <div class="dashbord-inner-row align-items-start d-flex">
                <?php get_template_part('/agent-dasbord/dashboard_menu_agent');
                $user_id = $current_user->ID;
                ?>
                <div class="dashboard-info">
                    <div class="properties-section">
                        <div class="title-heading">
                            <h1>
                               <?php the_title(); ?>
                            </h1>
                        </div>
                        <div class="card-blog-wraper">
                            <?php
                                $existing_value = get_user_meta($user_id, "my_broucher_list", false);
                                if ($existing_value) { 
                                    
                                    
                                    ?>
                                    <div class="row">
                                        <?php 
                                         $existing_value = get_user_meta($user_id, "my_broucher_list", false);
                                        foreach ($existing_value as $key => $value) {

                                            $post_id = $value;
                                            $featured_img_id = get_post_thumbnail_id($post_id);
                                            $featured_img = wp_get_attachment_image($featured_img_id, array('100', '91'));
                                            $property_area_sq = get_post_meta($post_id, 'property_area_sq', true);
                                            $currency = get_post_meta($post_id, 'currency', true);
                                            $property_price = get_post_meta($post_id, 'property_price', true);
                                            $ref_no = get_post_meta($post_id, 'ref_no', true);
                                            $built_size = get_post_meta($post_id, 'built_size', true);
                                            $terrace_size = get_post_meta($post_id, 'terrace_size:', true);
                                            $bedrooms_image_id = get_post_meta($post_id, 'bedrooms_image', true);
                                            $bedrooms_image = wp_get_attachment_image($bedrooms_image_id, 'full');
                                            $bwdrooms_qtt = get_post_meta($post_id, 'bwdrooms_qtt', true);
                                            $bathroom_image_id = get_post_meta($post_id, 'bathroom_image', true);
                                            $bathroom_image = wp_get_attachment_image($bathroom_image_id, 'full');
                                            $location = get_the_terms($post_id, 'property_location');
                                            $bathrooms_qtt = get_post_meta($post_id, 'bathrooms_qtt', true);
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
                                                                <a href="<?php echo get_the_permalink($post_id);?>"><?php echo get_the_title($post_id); ?></a>
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
                                                                        <p><strong>Built Size:</strong>
                                                                            <?php echo $built_size; ?>
                                                                        </p>
                                                                    <?php }
                                                                    if (!empty($terrace_size)) { ?>
                                                                        <p><strong>Terrace Size:</strong>
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
                                //wp_reset_postdata();
                             ?>
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