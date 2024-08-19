<?php get_header();
$id = get_queried_object_id();
$term = get_term($id);
// print_r($term);
// die;
$term_name = $term->name;
// print_r($term_name);

// print_r(get_the_category($post->ID));

// Get taxonomy names
$property_type_taxonomy = get_taxonomy('property_type');
$property_location_taxonomy = get_taxonomy('property_location');


$property_type_terms = get_the_terms(get_the_ID(), 'property_type');
$property_location_terms = get_the_terms(get_the_ID(), 'property_location');

// Check if terms are retrieved successfully
if ($property_type_terms && $property_location_terms && !is_wp_error($property_type_terms) && !is_wp_error($property_location_terms)) {
    // Extract slugs from term objects
    $property_type_slugs = wp_list_pluck($property_type_terms, 'slug');
    $property_location_slugs = wp_list_pluck($property_location_terms, 'slug');
    // print_r($property_location_slugs );
    // die;
    $args = array(
        'post_type' => 'property',
        'post_status' => 'publish',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'property_type',
                'field' => 'slug',
                'terms' => $property_type_slugs,
            ),
            array(
                'taxonomy' => 'property_location',
                'field' => 'slug',
                'terms' => $property_location_slugs,
            ),
        ),
    );

    // Now you can use $args in your WP_Query
    $query = new WP_Query($args);

    // Rest of your code for the loop or displaying results
} else {
    // Handle the case where terms are not found
    echo 'No terms found for property_type or property_location';
}


$query = new WP_Query($args);
// echo "<pre>";
// print_r($query);
?>
<section class="recommendations-section common-padding">
    <div class="container">
        <div class="title-heading text-center">
            <h3><?php echo $term_name; ?></h3>
            <p><?php echo $property_type_taxonomy->labels->name; ?>, <?php echo $property_location_taxonomy->labels->name; ?></p>
        </div>
        <div class="row">
            <?php
            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
            ?>
                    <div class="col-lg-4 col-md-6 category-item-box">
                        <div class="category-box position-relative">
                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                <div class="image-box position-relative">
                                    <?php echo get_the_post_thumbnail(); ?>
                                    <div class="category-title">
                                        <h6><?php the_title(); ?></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="category-list-row d-flex align-items-center justify-content-between">
                            <div class="provide-item-row">
                                <ul class="d-flex align-items-center">
                                    <li><span><img src="<?php echo get_theme_value('pro_bedrooms_image_icon'); ?>" alt=""></span><?php echo get_field('bwdrooms_qtt'); ?></li>
                                    <li><span><img src="<?php echo get_theme_value('pro_bathrooms_image_icon'); ?>" alt=""></span><?php echo get_field('bathrooms_qtt'); ?></li>
                                    <li><span><img src="<?php echo get_theme_value('pro_squ_imag_icon'); ?>" alt=""></span><?php echo get_field('property_area_sq'); ?></li>
                                    <li><span><img src="<?php echo get_theme_value('pro_terrace_image_icon'); ?>" alt=""></span>26.0</li>
                                </ul>
                            </div>
                            <div class="total-price-row">
                                <span><?php echo get_theme_value('pro_currency'); ?></span>
                                <span><?php echo get_field('property_price'); ?></span>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo 'No posts found';
            endif;
            ?>
        </div>
        <!-- <div class="button-wrap text-center">
            <a href="" class="btn">LOAD MORE</a>
        </div> -->
    </div>
</section>
<?php get_footer(); ?>