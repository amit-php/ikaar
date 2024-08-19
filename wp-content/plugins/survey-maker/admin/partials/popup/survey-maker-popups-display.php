<?php
$survey_max_id = Survey_Maker_Admin::get_max_id('popup_surveys');
$plus_icon_svg = "<span class=''><img src='". SURVEY_MAKER_ADMIN_URL ."/images/icons/plus-icon.svg'></span>";
$youtube_icon_svg = "<span ><img src='". SURVEY_MAKER_ADMIN_URL ."/images/icons/youtube-video-icon.svg' ></span>";
?>
<div class="wrap">
    <div class="ays-survey-heading-box">
        <div class="ays-survey-wordpress-user-manual-box">
            <a href="https://ays-pro.com/wordpress-survey-maker-user-manual" target="_blank" style="text-decoration: none;font-size: 13px;">
                <i class="ays_fa ays_fa_file_text" ></i> 
                <span style="margin-left: 3px;text-decoration: underline;"><?php echo __( "View Documentation", "survey-maker" ); ?></span>
            </a>

        </div>
    </div>
    <h1 class="wp-heading-inline">
        <?php
        echo __( esc_html(get_admin_page_title()), "survey-maker" );
        ?>
    </h1>
    <div class="ays-survey-maker-add-new-button-box">
        <?php 
            echo sprintf( '<a href="?page=%s&action=%s" class="page-title-action button-primary ays-survey-add-new-button-new-design"> %s ' . __( 'Add New', "survey-maker" ) . '</a>', esc_attr( $_REQUEST['page'] ), 'add', $plus_icon_svg);
        ?>
    </div>
    
    <div id="poststuff">
        <div id="post-body" class="metabox-holder">
            <div id="post-body-content" style="margin-bottom: 10px;">
                <div class="meta-box-sortables ui-sortable">
                    <?php
                        $this->popup_surveys_obj->views();
                    ?>
                    <form method="post">
                        <?php
                            $this->popup_surveys_obj->prepare_items();
                            $this->popup_surveys_obj->display();
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <br class="clear">
        <div class="ays-survey-maker-add-new-button-box">
            <?php echo sprintf( '<a href="?page=%s&action=%s" class="page-title-action button-primary ays-survey-add-new-button-new-design"> %s ' . __('Add New', "survey-maker") . '</a>', esc_attr( $_REQUEST['page'] ), 'add', $plus_icon_svg);?>
        </div>
        <?php if($survey_max_id <= 0): ?>
            <div style="display: flex;justify-content: center; align-items: center;margin-bottom: 15px;"><iframe width="560" height="315" src="https://www.youtube.com/embed/gM6SQdOw3fA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe></div>
        <?php else: ?>
            <div class="ays-survey-create-survey-video-box" style="margin: auto;height: 83px;">
                <div class="ays-survey-create-survey-youtube-video">
                    <?php echo $youtube_icon_svg; ?>
                    <a href="https://www.youtube.com/embed/gM6SQdOw3fA" target="_blank" title="YouTube video player" >How to create Popup Survey in Under One Minute</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
