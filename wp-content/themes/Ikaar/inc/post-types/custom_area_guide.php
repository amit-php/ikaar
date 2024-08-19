<?php

/***
 * Display Post Type
 ***/
if (!class_exists('WeaversWeb_area_guide_Post_Type')) :
    class WeaversWeb_area_guide_Post_Type
    {

        function __construct()
        {
            // Adds the class post type and taxonomies
            add_action('init', array(&$this, 'area_guide_init'), 0);
            // Thumbnail support for workouts posts
            //add_theme_support('post-thumbnails',array('workouts'));
        }
        function area_guide_init()
        {
            /**
             * Enable the display_init custom post type
             * http://codex.wordpress.org/Function_Reference/register_post_type
             */
            $labels = array(
                'name' => __('Area guide', 'WeaversWeb'),
                'singular_name' => __('Area guide', 'WeaversWeb'),
                'add_new' => __('Add New', 'WeaversWeb'),
                'add_new_item' => __('Add New Area guide', 'WeaversWeb'),
                'edit_item' => __('Edit Area guide', 'WeaversWeb'),
                'new_item' => __('Add New Area guide', 'WeaversWeb'),
                'view_item' => __('View Area guide', 'WeaversWeb'),
                'search_items' => __('Search Area guide', 'WeaversWeb'),
                'not_found' => __('No Area guide found', 'WeaversWeb'),
                'not_found_in_trash' => __('No Area guide found in trash', 'WeaversWeb')
            );
            $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => 'dashicons-admin-site',
                'rewrite' => array('slug' => 'area_guide'),
                'map_meta_cap' => true,
                'hierarchical' => false,
                'menu_position' => 5,
                'supports' => array('title', 'editor', 'thumbnail', 'comments', 'author')
            );
            $args = apply_filters('WeaversWeb_area_guide_args', $args);
            register_post_type('area_guide', $args);


             // Type taxonomy,
             $labels_one = array(
                'name' => _x('Area guide Type', 'taxonomy general name'),
                'singular_name' => _x('Area guide Type', 'taxonomy singular name'),
                'search_items' => __('Search Area guide Types'),
                'popular_items' => __('Popular Area guide Types'),
                'all_items' => __('All Area guide Types'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Area guide Type'),
                'update_item' => __('Update Area guide Type'),
                'add_new_item' => __('Add New Area guide Type'),
                'new_item_name' => __('New Area guide Type Name'),
                'separate_items_with_commas' => __('Separate Area guide types with commas'),
                'add_or_remove_items' => __('Add or remove Area guide types'),
                'choose_from_most_used' => __('Choose from the most used Area guide types'),
                'not_found' => __('No Area guide types found.'),
                'menu_name' => __('Area guide Type'),
            );

            $args_one = array(
                'hierarchical' => true,
                'labels' => $labels_one,
                'show_ui' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => 'areaguide-type'),
            );

            //register_taxonomy('area_guide_type', 'area_guide', $args_one);

        }
    }
    new WeaversWeb_area_guide_Post_Type;
endif;
   