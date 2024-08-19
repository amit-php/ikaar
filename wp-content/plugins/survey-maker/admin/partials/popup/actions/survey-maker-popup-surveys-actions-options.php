<?php
    $action = isset( $_GET["action"] ) ? sanitize_text_field( $_GET["action"] ) : "";

    $id = (isset($_GET["id"])) ? absint( sanitize_text_field( $_GET["id"] ) ) : null;

    $html_name_prefix = "ays_";

    $user_id = get_current_user_id();

    $options = array(
        "width"         	 => "800",
        "height"        	 => "450",
        "popup_position"     => "center-center",
        "popup_margin"       => "0",
        "popup_trigger"      => "on_load",
        "popup_selector"     => "",
        "popup_enable_show_title"     => "off",
        "popup_title_font_size"     => 25,
        "popup_hide_title_on_mobile"     => 'off',
        "popup_title_border_radius" => 0,
        "popup_title_mobile_font_size" => 25,
        "popup_title_bg_color"     => "#00000000",
        "popup_title_text_color"     => "#000000",
        "popup_title_transform"     => "none",
        "ays_survey_popup_title_letter_spacing" => 0,
        "popup_enable_close_by_esc" => "off",
        // "except_types"       => "",
        // "except_posts"       => "",
        // "hide_popup"         => "off",
        // "full_screen_mode"   => "off",
        // "popup_bg_color"     => "#ffffff",
    );

    $object = array(
        "survey_id" => "",
        "title" => "",
        "show_all" => "all",
        "status" => "published",
        'date_created' => current_time( 'mysql' ),
        'date_modified' => current_time( 'mysql' ),
        'author_id' => $user_id,
        "options" => json_encode( $options ),
    );

    $heading = "";
    switch ($action) {
        case "add":
            $heading = __( "Add new popup", "survey-maker" );
            break;
        case "edit":
            $heading = __( "Edit popup", "survey-maker" );
            $object = $this->popup_surveys_obj->get_item_by_id( $id );
            break;
    }


    if (isset($_POST["ays_submit"]) || isset($_POST["ays_submit_top"])) {
        $_POST["id"] = $id;
        $this->popup_surveys_obj->add_or_edit_item();
    }

    if(isset($_POST["ays_apply"]) || isset($_POST["ays_apply_top"])){
        $_POST["id"] = $id;
        $_POST["save_type"] = "apply";
        $this->popup_surveys_obj->add_or_edit_item();
    }

    if(isset($_POST["ays_save_new"]) || isset($_POST["ays_save_new_top"])){
        $_POST["id"] = $id;
        $_POST["save_type"] = "save_new";
        $this->popup_surveys_obj->add_or_edit_item();
    }


    // Options
    $options = isset( $object["options"] ) && $object["options"] != "" ? $object["options"] : "";
    $options = json_decode( $options, true );

    $gen_options = ($this->settings_obj->ays_get_setting('options') === false) ? array() : json_decode($this->settings_obj->ays_get_setting('options'), true);

    // Author ID
    $author_id = isset( $object['author_id'] ) && $object['author_id'] != '' ? intval( $object['author_id'] ) : $user_id;

    // Title
    $title = isset( $object["title"] ) && $object["title"] != "" ? stripslashes( esc_attr( $object["title"] ) ) : "";

    // Show popup title
    $survey_popup_enable_show_title = (isset($options["popup_enable_show_title"]) && $options["popup_enable_show_title"] == "on") ? true : false;

    // Popup title font size
    $survey_popup_title_font_size = (isset($options["popup_title_font_size"]) && $options["popup_title_font_size"] != "") ? absint ( intval( $options["popup_title_font_size"] ) ) : 25;

    // Popup title font size on mobile
    $survey_popup_title_mobile_font_size = (isset($options["popup_title_mobile_font_size"]) && $options["popup_title_mobile_font_size"] != "") ? absint ( intval( $options["popup_title_mobile_font_size"] ) ) : $survey_popup_title_font_size;

    // Popup title bg color
    $survey_popup_title_bg_color = (isset($options["popup_title_bg_color"]) && $options["popup_title_bg_color"] != "") ? esc_attr ( $options["popup_title_bg_color"] ) : "#00000000";

    // Popup title text color
    $survey_popup_title_text_color = (isset($options["popup_title_text_color"]) && $options["popup_title_text_color"] != "") ? esc_attr ( $options["popup_title_text_color"] ) : "#000000";

    // Popup title alignment
    $survey_popup_title_alignment = (isset($options["popup_title_alignment"]) && $options["popup_title_alignment"] != "") ? esc_attr ( $options["popup_title_alignment"] ) : "left";

    // Popup title transform
    $survey_popup_title_transform = (isset($options["popup_title_transform"]) && $options["popup_title_transform"] != "") ? esc_attr ( $options["popup_title_transform"] ) : "none";
    
    // Popup title letter spacing
    $survey_popup_title_letter_spacing = (isset( $options['popup_title_letter_spacing' ] ) && $options['popup_title_letter_spacing'] != '' && $options['popup_title_letter_spacing'] != '0') ? esc_attr( $options['popup_title_letter_spacing'] ) : 0;

    // Hide popup title on mobile
    $survey_popup_hide_title_on_mobile = (isset($options["popup_hide_title_on_mobile"]) && $options["popup_hide_title_on_mobile"] == "on") ? true : false;

    // Title border radius
    $survey_popup_title_border_radius = (isset($options["popup_title_border_radius"]) && $options["popup_title_border_radius"] != "") ? absint ( intval( $options["popup_title_border_radius"] ) ) : 0;

    // Survey_id
    $survey_id = isset( $object["survey_id"] ) && $object["survey_id"] != "" ? stripslashes( htmlentities( $object["survey_id"] ) ) : "";
    
    // Status
    $status = isset( $object["status"] ) && $object["status"] != "" ? stripslashes( $object["status"] ) : "published";

    // Date created
    $date_created = isset( $object['date_created'] ) && Survey_Maker_Admin::validateDate( $object['date_created'] ) ? $object['date_created'] : current_time( 'mysql' );
    
    // Date modified
    $date_modified = current_time( 'mysql' );
    
    // Show All
    $show_all = isset( $object["show_all"] ) && $object["show_all"] != "" ? stripslashes( $object["show_all"] ) : "all";

    // Width
    $popup_survey_width = (isset($options["width"]) && $options["width"] != "") ? absint ( intval( $options["width"] ) ) : 800;
   
    // Height
    $popup_survey_height = (isset($options["height"]) && $options["height"] != "") ? absint ( intval( $options["height"] ) ) : 450;

    // Popup Position
    $popup_position = (isset($options["popup_position"]) && $options["popup_position"] != "center-center") ? $options["popup_position"] : "center-center";

    // Popup Margin
    $popup_margin = (isset($options["popup_margin"]) && $options["popup_margin"] != "") ? $options["popup_margin"] : "0";

    //Popup Trigger
    $trigger_type_arr = array(
        'on_load'  => __('On load', "survey-maker"),
        'on_click' => __('On Click', "survey-maker"),
    ); 

    $popup_trigger_type = (isset($options["popup_trigger"]) && $options["popup_trigger"] != "") ? $options["popup_trigger"] : "on_load";

    $popup_selector = (isset($options["popup_selector"]) && $options["popup_selector"] != "") ? stripslashes( esc_attr($options["popup_selector"])) : "";    

    // Popup background color
    $survey_popup_bg_color = (isset($options["popup_bg_color"]) && $options["popup_bg_color"] != "") ? $options["popup_bg_color"] : "#ffffff";

    // Popup close after finish
    $survey_enable_popup_close_after_finish = (isset($options["enable_popup_close_after_finish"]) && $options["enable_popup_close_after_finish"] == "on") ? true : false;
    $survey_popup_close_after_finish_delay  = (isset($options[ 'popup_close_after_finish_delay' ]) && $options[ 'popup_close_after_finish_delay' ] != '') ? absint ( intval( $options[ 'popup_close_after_finish_delay' ] ) ) : '';

    $posts = array();
    $except_posts       = (isset($options["except_posts"]) && $options["except_posts"] != "") ? ($options["except_posts"]) : array();
    $except_post_types  = (isset($options["except_post_types"]) && $options["except_post_types"] != "") ? ($options["except_post_types"]) : array();

    if ( !empty( $except_posts ) ) {
        $post_ids = implode(",", $except_posts);

        $posts = get_posts(array(
            'post_type'     => $except_post_types,
            'post_status'   => 'publish',
            'numberposts'   => -1, 
            'include'       => $post_ids
        ));
    }

    $args = array(
        "public" => true
    );

    $all_post_types = get_post_types( $args, "objects" );

    if( array_key_exists( 'attachment', $all_post_types ) ){
        unset( $all_post_types['attachment'] );
    }

    //Show on home page
    $show_on_home_page = (isset($options["show_on_home_page"]) && $options["show_on_home_page"] == "on") ? "on" : "off";

    // Hide Popup
    $hide_popup = (isset($options["hide_popup"]) && $options["hide_popup"] == "on") ? $options["hide_popup"] : "off";

    // Hide Popup after close
    $hide_popup_after_close = (isset($options["hide_popup_after_close"]) && $options["hide_popup_after_close"] == "on") ? esc_attr($options["hide_popup_after_close"]) : "off";

    // Survey categories IDs
    $surveys = $this->popup_surveys_obj->get_surveys();

    $loader_iamge = '<span class="display_none ays_survey_loader_box"><img src="". SURVEY_MAKER_ADMIN_URL ."/images/loaders/loading.gif"></span>';

    // Popup full screen mode
    $survey_popup_full_screen = (isset($options["full_screen_mode"]) && $options["full_screen_mode"] == "on") ? "checked" : "";

    // Close by pressing the ESC
    $survey_popup_enable_close_by_esc = (isset($options["popup_enable_close_by_esc"]) && $options["popup_enable_close_by_esc"] == "on") ? "checked" : "";
