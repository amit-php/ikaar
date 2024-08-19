<?php
/***
 * Display Post Type
 ***/
if (!class_exists('WeaversWeb_testimonials_Post_Type')):
    class WeaversWeb_testimonials_Post_Type
    {

        function __construct()
        {
            // Adds the class post type and taxonomies
            add_action('init', array(&$this, 'testimonials_init'), 0);
            // Thumbnail support for workouts posts
            //add_theme_support('post-thumbnails',array('workouts'));
        }

        function testimonials_init()
        {
            /**
             * Enable the display_init custom post type
             * http://codex.wordpress.org/Function_Reference/register_post_type
             */
            $labels = array(
                'name' => __('Testimonials', 'WeaversWeb'),
                'singular_name' => __('Testimonials', 'WeaversWeb'),
                'add_new' => __('Add New', 'WeaversWeb'),
                'add_new_item' => __('Add New Testimonials', 'WeaversWeb'),
                'edit_item' => __('Edit Testimonials', 'WeaversWeb'),
                'new_item' => __('Add New Testimonials', 'WeaversWeb'),
                'view_item' => __('View Testimonials', 'WeaversWeb'),
                'search_items' => __('Search Testimonials', 'WeaversWeb'),
                'not_found' => __('No Testimonials found', 'WeaversWeb'),
                'not_found_in_trash' => __('No Testimonials found in trash', 'WeaversWeb')
            );

            $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => 'dashicons-format-chat',
                'rewrite' => array('slug' => 'testimonials'),
                'map_meta_cap' => true,
                'hierarchical' => false,
                'menu_position' => 5,
                'supports' => array('title', 'editor')
            );

            $args = apply_filters('WeaversWeb_testimonials_args', $args);
            register_post_type('testimonials', $args);

        }
    }

    new WeaversWeb_testimonials_Post_Type;
endif;