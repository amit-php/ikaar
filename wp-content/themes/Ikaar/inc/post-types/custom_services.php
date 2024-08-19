<?php

/***
 * Display Post Type
 ***/
if (!class_exists('WeaversWeb_services_Post_Type')) :
    class WeaversWeb_services_Post_Type
    {

        function __construct()
        {
            // Adds the class post type and taxonomies
            add_action('init', array(&$this, 'services_init'), 0);
            // Thumbnail support for workouts posts
            //add_theme_support('post-thumbnails',array('workouts'));
        }

        function services_init()
        {
            /**
             * Enable the display_init custom post type
             * http://codex.wordpress.org/Function_Reference/register_post_type
             */
            $labels = array(
                'name' => __('Services', 'WeaversWeb'),
                'singular_name' => __('Services', 'WeaversWeb'),
                'add_new' => __('Add New', 'WeaversWeb'),
                'add_new_item' => __('Add New Services', 'WeaversWeb'),
                'edit_item' => __('Edit Services', 'WeaversWeb'),
                'new_item' => __('Add New Services', 'WeaversWeb'),
                'view_item' => __('View Services', 'WeaversWeb'),
                'search_items' => __('Search Services', 'WeaversWeb'),
                'not_found' => __('No Services found', 'WeaversWeb'),
                'not_found_in_trash' => __('No Services found in trash', 'WeaversWeb')
            );

            $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => 'dashicons-portfolio',
                'rewrite' => array('slug' => 'services'),
                'map_meta_cap' => true,
                'hierarchical' => false,
                'menu_position' => 5,
                'supports' => array('title', 'editor', 'page-attributes', 'thumbnail', 'excerpt', 'comments', 'author')
            );

            $args = apply_filters('WeaversWeb_services_args', $args);
            register_post_type('services', $args);


            // Add new Class Type taxonomy,NOT hierarchical(like tags)
            $labels_one = array(
                'name' => _x('Services Type', 'taxonomy general name'),
                'singular_name' => _x('Services Type', 'taxonomy singular name'),
                'search_items' => __('Search Services Types'),
                'popular_items' => __('Popular Services Types'),
                'all_items' => __('All Services Types'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Services Type'),
                'update_item' => __('Update Services Type'),
                'add_new_item' => __('Add New Services Types'),
                'new_item_name' => __('New Services Type Name'),
                'separate_items_with_commas' => __('Separate Services types with commas'),
                'add_or_remove_items' => __('Add or remove Services types'),
                'choose_from_most_used' => __('Choose from the most used Services types'),
                'not_found' => __('No Services types found.'),
                'menu_name' => __('Services Type'),
            );

            $args_one = array(
                'hierarchical' => true,
                'labels' => $labels_one,
                'show_ui' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => 'services-type'),
            );

            register_taxonomy('services_type', 'services', $args_one);
        }
    }
    new WeaversWeb_services_Post_Type;
endif;
