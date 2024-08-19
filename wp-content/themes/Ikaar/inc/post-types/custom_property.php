<?php

/***
 * Display Post Type
 ***/
if (!class_exists('WeaversWeb_property_Post_Type')) :
    class WeaversWeb_property_Post_Type
    {

        function __construct()
        {
            // Adds the class post type and taxonomies
            add_action('init', array(&$this, 'property_init'), 0);
            // Thumbnail support for workouts posts
            //add_theme_support('post-thumbnails',array('workouts'));
        }

        function property_init()
        {
            /**
             * Enable the display_init custom post type
             * http://codex.wordpress.org/Function_Reference/register_post_type
             */
            $labels = array(
                'name' => __('Property', 'WeaversWeb'),
                'singular_name' => __('Property', 'WeaversWeb'),
                'add_new' => __('Add New', 'WeaversWeb'),
                'add_new_item' => __('Add New Property', 'WeaversWeb'),
                'edit_item' => __('Edit Property', 'WeaversWeb'),
                'new_item' => __('Add New Property', 'WeaversWeb'),
                'view_item' => __('View Property', 'WeaversWeb'),
                'search_items' => __('Search Property', 'WeaversWeb'),
                'not_found' => __('No Property found', 'WeaversWeb'),
                'not_found_in_trash' => __('No Property found in trash', 'WeaversWeb')
            );

            $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => 'dashicons-admin-multisite',
                'rewrite' => array('slug' => 'property'),
                'map_meta_cap' => true,
                'hierarchical' => false,
                'capability_type' => 'property',
                'menu_position' => 5,
                'supports' => array('title', 'editor', 'page-attributes', 'thumbnail', 'excerpt', 'comments', 'author')
            );

            $args = apply_filters('WeaversWeb_gallery_args', $args);
            register_post_type('property', $args);


            // Add new Property Category taxonomy
            $labels_one = array(
                'name' => _x('Property Category', 'taxonomy general name'),
                'singular_name' => _x('Property Category', 'taxonomy singular name'),
                'search_items' => __('Search Property Categories'),
                'popular_items' => __('Popular Property Types'),
                'all_items' => __('All Property Types'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Property Category'),
                'update_item' => __('Update Property Type'),
                'add_new_item' => __('Add New Property Categories'),
                'new_item_name' => __('New Property Type Name'),
                'separate_items_with_commas' => __('Separate Property types with commas'),
                'add_or_remove_items' => __('Add or remove Property types'),
                'choose_from_most_used' => __('Choose from the most used Property types'),
                'not_found' => __('No Property types found.'),
                'menu_name' => __('Property Category'),
            );

            $args_one = array(
                'hierarchical' => true,
                'labels' => $labels_one,
                'show_ui' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'capabilities'      => array(
                    'manage_terms'  => 'manage_property_type',
                    'edit_terms'    => 'edit_property_type',
                    'delete_terms'  => 'delete_property_type',
                    'assign_terms'  => 'assign_property_type'
                ),
                'rewrite' => array('slug' => 'property-type'),
            );

            register_taxonomy('property_type', 'property', $args_one);

            // Add new Property Location taxonomy
            $labels_location = array(
                'name' => _x('Property Location', 'taxonomy general name'),
                'singular_name' => _x('Property Location', 'taxonomy singular name'),
                'search_items' => __('Search Property Locations'),
                'popular_items' => __('Popular Property Locations'),
                'all_items' => __('All Property Locations'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Property Location'),
                'update_item' => __('Update Property Location'),
                'add_new_item' => __('Add New Property Locations'),
                'new_item_name' => __('New Property Location Name'),
                'separate_items_with_commas' => __('Separate Property locations with commas'),
                'add_or_remove_items' => __('Add or remove Property locations'),
                'choose_from_most_used' => __('Choose from the most used Property locations'),
                'not_found' => __('No Property locations found.'),
                'menu_name' => __('Property Location'),
            );

            $args_location = array(
                'hierarchical' => true,
                'labels' => $labels_location,
                'show_ui' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'capabilities'      => array(
                    'assign_terms'  => 'assign_property_location'
                ),
                'query_var' => true,
                'rewrite' => array('slug' => 'property-location'),
            );

            register_taxonomy('property_location', 'property', $args_location);

            // Add new Property Amenities taxonomy
            $labels_location2 = array(
                'name' => _x('Property Amenities', 'taxonomy general name'),
                'singular_name' => _x('Property Amenitie', 'taxonomy singular name'),
                'search_items' => __('Search Property Amenities'),
                'popular_items' => __('Popular Property Amenities'),
                'all_items' => __('All Property Amenities'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Property Amenities'),
                'update_item' => __('Update Property Amenities'),
                'add_new_item' => __('Add New Property Amenities'),
                'new_item_name' => __('New Property Amenities Name'),
                'separate_items_with_commas' => __('Separate Property Amenities with commas'),
                'add_or_remove_items' => __('Add or remove Property Amenities'),
                'choose_from_most_used' => __('Choose from the most used Property Amenities'),
                'not_found' => __('No Property Amenities found.'),
                'menu_name' => __('Property Amenities'),
            );

            $args_location2 = array(
                'hierarchical' => true,
                'labels' => $labels_location2,
                'show_ui' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'capabilities'      => array(
                    'assign_terms'  => 'assign_property_location_amenities'
                ),
                'query_var' => true,
                'rewrite' => array('slug' => 'property-amenities'),
            );

            register_taxonomy('amenities', 'property', $args_location2);


             // Add new Property Price taxonomy
             
             $labels_price = array(
                'name' => _x('Property Price', 'taxonomy general name'),
                'singular_name' => _x('Property Price', 'taxonomy singular name'),
                'search_items' => __('Search Property Prices'),
                'popular_items' => __('Popular Property Prices'),
                'all_items' => __('All Property Prices'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Property Price'),
                'update_item' => __('Update Property Price'),
                'add_new_item' => __('Add New Property Prices'),
                'new_item_name' => __('New Property Price Name'),
                'separate_items_with_commas' => __('Separate Property prices with commas'),
                'add_or_remove_items' => __('Add or remove Property prices'),
                'choose_from_most_used' => __('Choose from the most used Property prices'),
                'not_found' => __('No Property prices found.'),
                'menu_name' => __('Property Price'),
            );

            $args_price = array(
                'hierarchical' => true,
                'labels' => $labels_price,
                'show_ui' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'capabilities'      => array(
                    'assign_terms'  => 'assign_property_price'
                ),
                'query_var' => true,
                'rewrite' => array('slug' => 'property-price'),
            );

            register_taxonomy('property_price', 'property', $args_price);
            
        }
    }
    new WeaversWeb_property_Post_Type;
endif;
