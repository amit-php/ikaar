<?php

/***
 * Display Post Type
 ***/
if (!class_exists('WeaversWeb_team_Post_Type')) :
    class WeaversWeb_team_Post_Type
    {

        function __construct()
        {
            // Adds the class post type and taxonomies
            add_action('init', array(&$this, 'team_init'), 0);
            // Thumbnail support for workouts posts
            //add_theme_support('post-thumbnails',array('workouts'));
        }

        function team_init()
        {
            /**
             * Enable the display_init custom post type
             * http://codex.wordpress.org/Function_Reference/register_post_type
             */
            $labels = array(
                'name' => __('Team', 'WeaversWeb'),
                'singular_name' => __('Team', 'WeaversWeb'),
                'add_new' => __('Add New', 'WeaversWeb'),
                'add_new_item' => __('Add New Team', 'WeaversWeb'),
                'edit_item' => __('Edit Team', 'WeaversWeb'),
                'new_item' => __('Add New Team', 'WeaversWeb'),
                'view_item' => __('View Team', 'WeaversWeb'),
                'search_items' => __('Search Team', 'WeaversWeb'),
                'not_found' => __('No Team found', 'WeaversWeb'),
                'not_found_in_trash' => __('No Team found in trash', 'WeaversWeb')
            );

            $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => 'dashicons-groups',
                'rewrite' => array('slug' => 'team'),
                'map_meta_cap' => true,
                'hierarchical' => false,
                'menu_position' => 5,
                'supports' => array('title', 'editor', 'page-attributes', 'thumbnail', 'excerpt', 'comments', 'author')
            );

            $args = apply_filters('WeaversWeb_team_args', $args);
            register_post_type('team', $args);


            // Add new Class Type taxonomy,NOT hierarchical(like tags)
            $labels_one = array(
                'name' => _x('Team Types', 'taxonomy general name'),
                'singular_name' => _x('Team Type', 'taxonomy singular name'),
                'search_items' => __('Search Team Types'),
                'popular_items' => __('Popular Team Types'),
                'all_items' => __('All Team Types'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Team Type'),
                'update_item' => __('Update Team Type'),
                'add_new_item' => __('Add New Team Type'),
                'new_item_name' => __('New Team Type Name'),
                'separate_items_with_commas' => __('Separate Team types with commas'),
                'add_or_remove_items' => __('Add or remove Team types'),
                'choose_from_most_used' => __('Choose from the most used Team types'),
                'not_found' => __('No Team types found.'),
                'menu_name' => __('Team Types'),
            );

            $args_one = array(
                'hierarchical' => true,
                'labels' => $labels_one,
                'show_ui' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => 'team-type'),
            );

            register_taxonomy('team_type', 'team', $args_one);






            // Add new Class Type taxonomy,NOT hierarchical(like tags)
            $labels_one = array(
                'name' => _x('Tags', 'taxonomy general name'),
                'singular_name' => _x('Tags', 'taxonomy singular name'),
                'search_items' => __('Search Tags'),
                'popular_items' => __('Popular Tags'),
                'all_items' => __('All Tags'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Tags'),
                'update_item' => __('Update Tags'),
                'add_new_item' => __('Add New Tags'),
                'new_item_name' => __('New Tag Name'),
                'separate_items_with_commas' => __('Separate Tags with commas'),
                'add_or_remove_items' => __('Add or remove Tags'),
                'choose_from_most_used' => __('Choose from the most used Tags'),
                'not_found' => __('No Tags found.'),
                'menu_name' => __('Tags'),
            );

            $args_one = array(
                'hierarchical' => false,
                'labels' => $labels_one,
                'show_ui' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => 'tag'),
            );

            register_taxonomy('tags', 'team', $args_one);
        }
    }

    new WeaversWeb_team_Post_Type;
endif;
