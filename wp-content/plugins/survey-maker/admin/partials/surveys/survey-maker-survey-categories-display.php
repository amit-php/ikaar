<?php

$action = ( isset($_GET['action']) ) ? sanitize_key( $_GET['action'] ) : '';
$id     = ( isset($_GET['id']) ) ? absint( sanitize_key( $_GET['id'] ) ) : null;

if( $action == 'duplicate' && !is_null($id) ){
    $this->surveys_categories_obj->duplicate_survey_categories($id);
}

$plus_icon_svg = "<span class=''><img src='". SURVEY_MAKER_ADMIN_URL ."/images/icons/plus-icon.svg'></span>";

?>
<div class="wrap">
    <div class="ays-survey-heading-box">
        <div class="ays-survey-wordpress-user-manual-box">
            <a href="https://ays-pro.com/wordpress-survey-maker-user-manual" target="_blank" style="text-decoration: none;font-size: 13px;">
                <i class="ays_fa ays_fa_file_text" ></i> 
                <span style="margin-left: 3px;text-decoration: underline;">View Documentation</span>
            </a>
        </div>
    </div>
    <h1 class="wp-heading-inline">
        <?php
        echo __( esc_html(get_admin_page_title()), "survey-maker" );
        ?>
    </h1>
    <div class="ays-survey-maker-add-new-button-box">
        <?php echo sprintf( '<a href="?page=%s&action=%s" class="page-title-action button-primary ays-survey-add-new-button-new-design"> %s ' . __( 'Add New', "survey-maker" ) . '</a>', esc_attr( $_REQUEST['page'] ), 'add', $plus_icon_svg); ?>
    </div>

    <div id="poststuff" style="padding-top: 0;">
        <div id="post-body" class="metabox-holder">
            <div id="post-body-content" style="margin-bottom: 10px;">
                <div class="meta-box-sortables ui-sortable">
                    <?php
                        $this->surveys_categories_obj->views();
                    ?>
                    <form method="post">
                        <?php
                            $this->surveys_categories_obj->prepare_items();
                            $search = __( "Search", "survey-maker" );
                            $this->surveys_categories_obj->search_box($search, $this->plugin_name);
                            $this->surveys_categories_obj->display();
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <br class="clear">
        <div class="ays-survey-maker-add-new-button-box">
            <?php echo sprintf( '<a href="?page=%s&action=%s" class="page-title-action button-primary ays-survey-add-new-button-new-design"> %s ' . __( 'Add New', "survey-maker" ) . '</a>', esc_attr( $_REQUEST['page'] ), 'add', $plus_icon_svg); ?>
        </div>
    </div>
</div>
