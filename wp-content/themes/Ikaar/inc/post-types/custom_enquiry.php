<?php

/***
 * Display Post Type
 ***/
if (!class_exists('WeaversWeb_enquiry_Post_Type')) :
    class WeaversWeb_enquiry_Post_Type
    {

        function __construct()
        {
            // Adds the class post type and taxonomies
            add_action('init', array(&$this, 'enquiry_init'), 0);
            // Thumbnail support for workouts posts
            //add_theme_support('post-thumbnails',array('workouts'));
        }

        function enquiry_init()
        {
            /**
             * Enable the display_init custom post type
             * http://codex.wordpress.org/Function_Reference/register_post_type
             */
            $labels = array(
                'name' => __('Enquiry', 'WeaversWeb'),
                'singular_name' => __('Enquiry', 'WeaversWeb'),
                'add_new' => __('Add New', 'WeaversWeb'),
                'add_new_item' => __('Add New Enquiry', 'WeaversWeb'),
                'edit_item' => __('Edit Enquiry', 'WeaversWeb'),
                'new_item' => __('Add New Enquiry', 'WeaversWeb'),
                'view_item' => __('View Enquiry', 'WeaversWeb'),
                'search_items' => __('Search Enquiry', 'WeaversWeb'),
                'not_found' => __('No Enquiry found', 'WeaversWeb'),
                'not_found_in_trash' => __('No Enquiry found in trash', 'WeaversWeb')
            );

            $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => 'dashicons-id-alt',
                'rewrite' => array('slug' => 'enquiry'),
                'map_meta_cap' => true,
                'hierarchical' => false,
                'menu_position' => 4,
                'supports' => array('title',  'comments', 'author')
            );

            $args = apply_filters('WeaversWeb_enquiry_args', $args);
            register_post_type('enquiry', $args);


            // Add new Class Type taxonomy,NOT hierarchical(like tags)
            $labels_one = array(
                'name' => _x('Enquiry Categories', 'taxonomy general name'),
                'singular_name' => _x('Enquiry Type', 'taxonomy singular name'),
                'search_items' => __('Search Enquiry Types'),
                'popular_items' => __('Popular Enquiry Types'),
                'all_items' => __('All Enquiry Types'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Enquiry Type'),
                'update_item' => __('Update Enquiry Type'),
                'add_new_item' => __('Add New Enquiry Categories'),
                'new_item_name' => __('New Enquiry Type Name'),
                'separate_items_with_commas' => __('Separate Enquiry types with commas'),
                'add_or_remove_items' => __('Add or remove Enquiry types'),
                'choose_from_most_used' => __('Choose from the most used Enquiry types'),
                'not_found' => __('No Enquiry types found.'),
                'menu_name' => __('Enquiry Categories'),
            );

            $args_one = array(
                'hierarchical' => true,
                'labels' => $labels_one,
                'show_ui' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => 'enquiry-type'),
            );

            //register_taxonomy('enquiry_type', 'enquiry', $args_one);
        }
    }
    new WeaversWeb_enquiry_Post_Type;
endif;
