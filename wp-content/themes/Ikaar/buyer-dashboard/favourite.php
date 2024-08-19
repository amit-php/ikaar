<?php
//Template Name:favouriteBuyer
get_header('dashboard'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<main>
    <div class="dashbord-section common-padding">
        <div class="container">
            <div class="dashbord-inner-row  d-flex align-items-start">
                <?php get_template_part('/buyer-dashboard/dashboard_menu_buyer'); ?>
                <div class="dashboard-info">
                    <div class="Favorite-section">
                        <div class="title-heading">
                            <h1><?php the_title(); ?></h1>
                        </div>
                       
                        <div class="card-blog-wraper">
                            <div class="row">
                                <?php
                                $user_id = $current_user->ID;
                                $user_new_data = get_user_meta($user_id, '_iswishlist');
                                foreach ($user_new_data as $post_id) {
                                    $post = get_post($post_id);
                                    // echo $post . '<br>';
                                    // print_r($post);
                                    if ($post) {
                                        $post_title = $post->post_title;
                                        $post_content = $post->post_content;
                                        $post_permalink = get_permalink($post_id);
                                        $post_thumbnail = has_post_thumbnail($post_id) ? get_the_post_thumbnail($post_id, 'thumbnail') : get_template_directory_uri() . '/assets/auth/images/default-image.jpg';

                                ?>
                                        <div class="col-md-6 card-blog-item">
                                            <div class="card-blog">
                                                <a href="<?php echo esc_url($post_permalink); ?>">
                                                    <div class="card-blog-row d-flex align-items-start">

                                                        <div class="image-box"><?php echo $post_thumbnail ?></div>

                                                        <div class="info-box">
                                                            <h6><?php echo $post_title; ?></h6>
                                                            <div class="location-wrap">
                                                                <ul class="d-flex">
                                                                    <?php
                                                                    $taxonomy = 'property_location';
                                                                    $terms = get_the_terms(get_the_ID(), $taxonomy);
                                                                    if ($terms && !is_wp_error($terms)) {
                                                                        foreach ($terms as $term) {
                                                                            // print_r($term);
                                                                            $name = $term->name;
                                                                            $term_link = get_term_link($term);
                                                                    ?>
                                                                            <li><a href="<?php echo esc_url($term_link); ?>">
                                                                                    <?php echo $name; ?>
                                                                                </a></li>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <li> <?php echo get_field('ref_no'); ?></li>
                                                                </ul>
                                                            </div>
                                                            <div class="provide-item-row">
                                                                <ul class="d-flex align-items-center">
                                                                    <li><span><img src="<?php echo get_field('bedrooms_image'); ?>" alt=""></span> <?php echo get_field('bwdrooms_qtt'); ?></li>
                                                                    <li><span><img src="<?php echo get_field('bathroom_image'); ?>" alt=""></span> <?php echo get_field('bathrooms_qtt'); ?></li>
                                                                </ul>
                                                            </div>
                                                            <h6 class="price-wrap"> <?php echo get_field('currency'); ?> <?php echo number_format(get_field('property_price')); ?></h6>
                                                            <div class="bottom-row">
                                                                <div class="size-box">
                                                                    <p><strong>Built Size:</strong><?php echo get_field('built_size'); ?></p>
                                                                    <p><strong>Terrace Size:</strong><?php echo get_field('terrace_size:'); ?></p>
                                                                </div>
                                                                <div class="button-holder">
                                                                    <ul class="d-flex">
                                                                    <li><a href="javascript:void(0)" onclick="Addtowishlist('<?php echo $post->ID ;?>','no')"><i class="fa fa-trash" aria-hidden="true" style="color:black"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            </a>
                                        </div>
                                <?php
                                    }
                                    wp_reset_postdata();
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<script>
    //Add to wishlist
    function Addtowishlist(propertyId,status){
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php') ?>',
            data: {
                action: 'add_to_wishlist',
                propertyId: propertyId,
                wishstatus:status
            },
            success: function(data) {
                location.reload();

            }
        });

    }
</script>
<?php get_footer(); ?>