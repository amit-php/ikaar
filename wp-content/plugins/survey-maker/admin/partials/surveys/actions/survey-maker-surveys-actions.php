<?php
    require_once( SURVEY_MAKER_ADMIN_PATH . "/partials/surveys/actions/survey-maker-surveys-actions-options.php" );
?>

<div class="wrap">
    <div class="container-fluid">
        <div class="ays-survey-heading-box">
            <div class="ays-survey-wordpress-user-manual-box">
                <a href="https://ays-pro.com/wordpress-survey-maker-user-manual" target="_blank" style="text-decoration: none;font-size: 13px;">
                    <i class="ays_fa ays_fa_file_text" ></i> 
                    <span style="margin-left: 3px;text-decoration: underline;">View Documentation</span>
                </a>
            </div>
        </div>
        <form method="post" id="ays-survey-form">
            <input type="hidden" name="ays_survey_tab" value="<?php echo esc_attr($ays_tab); ?>">
            <h1 class="wp-heading-inline">
                <?php
                    echo esc_html($heading);
                    $other_attributes = array('id' => 'ays-button-save-top');
                    submit_button(__('Save and close', "survey-maker"), 'primary ays-button ays-survey-loader-banner', 'ays_submit_top', false, $other_attributes);

                    $other_attributes = array(
                        'id' => 'ays-button-apply-top',
                        'title' => 'Ctrl + s',
                        'data-toggle' => 'tooltip',
                        'data-delay'=> '{"show":"1000"}'
                    );
                    
                    submit_button(__('Save', "survey-maker"), 'ays-button ays-survey-loader-banner', 'ays_apply_top', false, $other_attributes);
                    submit_button(__('Cancel', "survey-maker"), 'ays-button', 'ays_survey_cancel', false, array());
                    echo wp_kses_post($loader_iamge);
                ?>
            </h1>
            <div>
                <div class="ays-survey-subtitle-main-box">
                    <p class="ays-subtitle">

                        <?php if(isset($id) && count($get_all_surveys) > 1):?>
                            <span class="ays-subtitle-inner-surveys-page">
                                <i class="ays_fa ays_fa_arrow_down ays-survey-open-surveys-list" style="font-size: 15px;"></i>   
                            </span>
                            <strong class="ays_survey_title_in_top"><?php echo esc_attr( stripslashes( $object['title'] ) ); ?></strong>
                        <?php endif; ?>
                        
                    </p>
                    <?php if(isset($id) && count($get_all_surveys) > 1):?>
                        <div class="ays-survey-surveys-data">
                            <?php $var_counter = 0; foreach($get_all_surveys as $var => $var_name): if( intval($var_name['id']) == $id ){continue;} $var_counter++; ?>
                                <?php ?>
                                <label class="ays-survey-message-vars-each-data-label">
                                    <input type="radio" class="ays-survey-surveys-each-data-checker" hidden id="ays_survey_message_var_count_<?php echo esc_attr($var_counter)?>" name="ays_survey_message_var_count">
                                    <div class="ays-survey-surveys-each-data">
                                        <input type="hidden" class="ays-survey-surveys-each-var" value="<?php echo esc_attr($var); ?>">
                                        <a href="?page=survey-maker&action=edit&id=<?php echo esc_attr($var_name['id']); ?>" target="_blank" class="ays-survey-go-to-surveys"><span><?php echo stripslashes(esc_attr($var_name['title'])); ?></span></a>
                                    </div>
                                </label>              
                            <?php endforeach ?>
                        </div>                        
                    <?php endif; ?>
                </div>
                <?php if($id !== null): ?>
                <div class="row">
                    <div class="col-sm-3">
                        <label> <?php echo __( "Shortcode text for editor", "survey-maker" ); ?> </label>
                    </div>
                    <div class="col-sm-9">
                        <p style="font-size:14px; font-style:italic;">
                            <?php echo __("To insert the Survey into a page, post or text widget, copy shortcode", "survey-maker"); ?>
                            <strong class="ays-survey-shortcode-box" onClick="selectElementContents(this)" style="font-size:16px; font-style:normal;" class="ays_help" data-toggle="tooltip" title="<?php echo __('Click for copy',"survey-maker");?>" ><?php echo "[ays_survey id='".esc_attr($id)."']"; ?></strong>
                            <?php echo " " . __( "and paste it at the desired place in the editor.", "survey-maker"); ?>
                        </p>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <hr/>
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for='ays-survey-title'>
                        <?php echo __('Title', "survey-maker"); ?>
                        <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Give a title to your survey.',"survey-maker"); ?>">
                            <i class="ays_fa ays_fa_info_circle"></i>
                        </a>
                    </label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="ays-text-input" id='ays-survey-title' name='<?php echo esc_attr($html_name_prefix); ?>title' value="<?php echo esc_attr($title); ?>"/>
                </div>
            </div> <!-- Survey Title -->
            <hr/>
            <div class="ays-top-menu-wrapper">
                <div class="ays_menu_left" data-scroll="0"><i class="ays_fa ays_fa_angle_left"></i></div>
                <div class="ays-top-menu">
                    <div class="nav-tab-wrapper ays-top-tab-wrapper">
                        <a href="#tab1" data-tab="tab1" class="nav-tab <?php echo ($ays_tab == 'tab1') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("General", "survey-maker");?>
                        </a>
                        <a href="#tab2" data-tab="tab2" class="nav-tab <?php echo ($ays_tab == 'tab2') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Styles", "survey-maker");?>
                        </a>
                        <a href="#tab6" data-tab="tab6" class="nav-tab <?php echo ($ays_tab == 'tab6') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Start page", "survey-maker");?>
                        </a>
                        <a href="#tab3" data-tab="tab3" class="nav-tab <?php echo ($ays_tab == 'tab3') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Settings", "survey-maker");?>
                        </a>
                        <a href="#tab4" data-tab="tab4" class="nav-tab <?php echo ($ays_tab == 'tab4') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Results Settings", "survey-maker");?>
                        </a>
                        <a href="#tab9" data-tab="tab9" class="nav-tab <?php echo ($ays_tab == 'tab9') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Conditional Result", "survey-maker");?>
                        </a>
                        <a href="#tab5" data-tab="tab5" class="nav-tab <?php echo ($ays_tab == 'tab5') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Limitation Users", "survey-maker");?>
                        </a>
                        <a href="#tab7" data-tab="tab7" class="nav-tab <?php echo ($ays_tab == 'tab7') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("E-Mail", "survey-maker");?>
                        </a>
                        <a href="#tab8" data-tab="tab8" class="nav-tab <?php echo ($ays_tab == 'tab8') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Integrations", "survey-maker");?>
                        </a>
                    </div>  
                </div>
                <div class="ays_menu_right" data-scroll="-1"><i class="ays_fa ays_fa_angle_right"></i></div>
            </div>
            
            <?php
                for($tab_ind = 1; $tab_ind <= 9; $tab_ind++){
                    require_once( SURVEY_MAKER_ADMIN_PATH . "/partials/surveys/actions/partials/survey-maker-surveys-actions-tab".$tab_ind.".php" );
                }
            ?>

            <div class="ays-modal" id="ays-survey-move-to-section">
                <div class="ays-modal-content">
                    <div class="ays-survey-preloader">
                        <img class="loader" src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/loaders/tail-spin-result.svg" alt="" width="100">
                    </div>

                    <!-- Modal Header -->
                    <div class="ays-modal-header">
                        <span class="ays-close">&times;</span>
                        <h2><?php echo __('Move to section', "survey-maker"); ?></h2>
                    </div>

                    <!-- Modal body -->
                    <div class="ays-modal-body">
                        <div class="ays-survey-move-to-section-sections-wrap">

                        </div>
                    </div>

                    <!-- Modal footer -->
                </div>
            </div>

            <input type="hidden" name="<?php echo esc_attr($html_name_prefix); ?>author_id" value="<?php echo esc_attr($author_id); ?>">
            <input type="hidden" name="<?php echo esc_attr($html_name_prefix); ?>post_id" value="<?php echo esc_attr($post_id); ?>">
            <input type="hidden" name="<?php echo esc_attr($html_name_prefix); ?>date_created" value="<?php echo esc_attr($date_created); ?>">
            <input type="hidden" name="<?php echo esc_attr($html_name_prefix); ?>date_modified" value="<?php echo esc_attr($date_modified); ?>">
            <input type="hidden" name="<?php echo esc_attr($html_name_prefix); ?>default_question_type" value="<?php echo esc_attr($survey_default_type); ?>">
            <input type="hidden" name="<?php echo esc_attr($html_name_prefix); ?>default_answers_count" value="<?php echo esc_attr($survey_answer_default_count); ?>">
            <hr>
            <div class="form-group row ays-surveys-button-box">
                <div class="ays-question-button-first-row" style="padding: 0;">
                <?php
                    wp_nonce_field('survey_action', 'survey_action');
                    $other_attributes = array();
                    $buttons_html = '';
                    $buttons_html .= '<div class="ays_save_buttons_content">';
                        $buttons_html .= '<div class="ays_save_buttons_box">';
                        // echo $buttons_html;                        
                        echo html_entity_decode(esc_html( $buttons_html ));

                            $other_attributes = array('id' => 'ays-button-save');
                            submit_button(__('Save and close', "survey-maker"), 'primary ays-button ays-survey-loader-banner', 'ays_submit', false, $other_attributes);

                            $other_attributes = array(
                                'id' => 'ays-button-apply',
                                'title' => 'Ctrl + s',
                                'data-toggle' => 'tooltip',
                                'data-delay'=> '{"show":"1000"}'
                            );

                            submit_button(__('Save', "survey-maker"), 'ays-button ays-survey-loader-banner', 'ays_apply', false, $other_attributes);                            
                            submit_button(__('Cancel', "survey-maker"), 'ays-button', 'ays_survey_cancel', false, array());
                            echo wp_kses_post($loader_iamge);
                        $buttons_html = '</div>';
                        echo html_entity_decode(esc_html( $buttons_html ));

                    $buttons_html = "</div>";
                    echo html_entity_decode(esc_html( $buttons_html ));
                ?>
                </div>
                <div class="ays-surveys-button-second-row">
                    <div >
                    <?php
                        if ( isset($prev_survey_id) && $prev_survey_id != "" ) {

                            $other_attributes = array(
                                'id' => 'ays-surveys-prev-button',
                                'href' => sprintf( '?page=%s&action=%s&id=%d', sanitize_text_field( $_REQUEST['page'] ), 'edit', absint( $prev_survey_id ) )
                            );
                            submit_button(__('Prev Survey', "survey-maker"), 'button button-primary ays-button ays-survey-prev-survey-button', 'ays_survey_prev_button', false, $other_attributes);
                        }

                        if ( $next_survey_id != "" && !is_null( $next_survey_id ) ) {

                            $other_attributes = array(
                                'id' => 'ays-surveys-next-button',
                                'href' => sprintf( '?page=%s&action=%s&id=%d', sanitize_text_field( $_REQUEST['page'] ), 'edit', absint( $next_survey_id ) )
                            );
                            submit_button(__('Next Survey', "survey-maker"), 'button button-primary ays-button ays-survey-next-survey-button', 'ays_survey_next_button', false, $other_attributes);
                        }
                    ?>
                    </div>
                    <div class="ays_save_default_button_box">
                        <a class="ays_help" data-toggle="tooltip" title="" data-original-title="Saves the assigned settings of the current survey as default. After clicking on this button, each time creating a new survey, the system will take the settings and styles of the current survey. If you want to change and renew it, please click on this button on another survey.">
                                <i class="ays_fa ays_fa_info_circle"></i>
                        </a>
                        <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" type="button" class="button button-primary ays-survey-save-as-default-pro-button" style="opacity: 0.5;margin: 0;"><?php echo __( 'Save as default', "survey-maker" ); ?></a>
                    </div>
                </div>
            </div>
        </form>

        <div class="ays-modal" id="ays-edit-question-content">
            <div class="ays-modal-content">
                <div class="ays-survey-preloader">
                    <img class="loader" src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/loaders/tail-spin-result.svg" alt="" width="100">
                </div>

                <!-- Modal Header -->
                <div class="ays-modal-header">
                    <span class="ays-close">&times;</span>
                    <h2>
                        <div class="ays-survey-icons" style="width:36px;height:36px;line-height: 0;vertical-align: bottom;">
                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/edit-content.svg" style="vertical-align: initial;line-height: 0;margin: 0px;padding: 0;width: 36px;height: 36px;">
                        </div>
                        <span><?php echo __( 'Edit question', "survey-maker" ); ?></span>
                    </h2>
                </div>

                <!-- Modal body -->
                <div class="ays-modal-body">
                    <form method="post" id="ays_export_filter">
                        <div style="padding: 15px 0;">
                        <?php
                            $content = '';
                            $editor_id = 'ays_survey_question_editor';
                            $settings = array(
                                'editor_height' => $survey_wp_editor_height,
                                'textarea_name' => 'ays_survey_question_editor',
                                'editor_class' => 'ays-textarea'
                            );
                            wp_editor($content, $editor_id, $settings);
                        ?>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="ays-modal-footer">
                    <button type="button" class="button button-primary ays-survey-back-to-textarea" data-question-id="" data-question-name="" style="margin-right: 10px;"><?php echo __( 'Back to classic textarea', "survey-maker" ); ?></button>
                    <button type="button" class="button button-primary ays-survey-apply-question-changes" data-question-id="" data-question-name=""><?php echo __( 'Apply changes', "survey-maker" ); ?></button>
                </div>
            </div>
        </div>

        <!-- Survey Templates start -->
        <div class="ays-modal" id="ays-survey-templates-modal" <?php echo $action_is_add ? 'style="display: flex"' : '' ?>>
                <div class="ays-modal-content ays-modal-content-survey-templates <?php echo $action_is_add ? 'no-confirmation' : '' ?>">
                    <div class="ays_survey_preloader" style="display:none">
                        <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/loaders/tail-spin-result.svg" alt="" width="100">
                    </div>
                    <!-- Modal Header -->
                    <div class="ays-modal-header ays-modal-content-survey-templates-header">
                        <h2><?=__('Survey Templates', "survey-maker")?></h2>
                        <a href="?page=survey-maker" style="display: inline-block;">
                            <span class="ays-close-templates-popup" data-action="ays-close-templates">&times;</span>
                        </a>
                    </div>
                    <!-- Modal body -->
                    <div class="ays-modal-body ays-modal-content-survey-templates-body">
                        <div class="ays-survey-templates-container">
                            <div class="ays-survey-templates-content">
                                <div class="ays-survey-templates-box ays-survey-templates-blank-box" data-template="blank-form">
                                    <div class="ays-survey-templates-box-text">
                                        <div class="ays-survey-templates-box-image ays-survey-templates-box-blank-images ays-survey-templates-box-image-blank">
                                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/templates/blank-plus.png">
                                        </div>
                                        <div class="ays-survey-templates-box-texts ays-survey-templates-box-blank-texts">
                                            <h4 class="ays-survey-templates-box-title"><?php echo __('Blank Survey', "survey-maker")?></h4>
                                        </div>
                                        <div class="ays-survey-templates-box-buttons">
                                            <button class="ays-survey-templates-box-apply-button-blank"><?php echo __("Choose" , "survey-maker"); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ays-survey-templates-box" data-template="customer-feedback-form">
                                    <div class="ays-survey-templates-box-text">                                        
                                        <div class="ays-survey-templates-box-image ays-survey-templates-box-blank-images ays-survey-templates-box-image-customer-feedback">
                                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/templates/customer-feedback.png">
                                        </div>
                                        <div class="ays-survey-templates-box-texts">
                                            <h4 class="ays-survey-templates-box-title"><?php echo __('Customer Feedback Form Template', "survey-maker")?></h4>
                                            <div class="ays-survey-templates-box-desc"><?php echo __('Beautiful, fun, easy to complete. Comes with useful rating questions.', "survey-maker")?></div>
                                        </div>
                                        <div class="ays-survey-templates-box-buttons">
                                            <button class="ays-survey-templates-box-apply-button" data-template="customer-feedback-form"><?php echo __("Choose Template" , "survey-maker"); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ays-survey-templates-box" data-template="employee-satisfaction-survey">
                                    <div class="ays-survey-templates-box-text">                                        
                                        <div class="ays-survey-templates-box-image ays-survey-templates-box-blank-images ays-survey-templates-box-image-employee-satisfaction">
                                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/templates/employee-satisfaction.png">
                                        </div>
                                        <div class="ays-survey-templates-box-texts">
                                            <h4 class="ays-survey-templates-box-title"><?php echo __('Employee Satisfaction Survey Template', "survey-maker")?></h4>
                                            <div class="ays-survey-templates-box-desc"><?php echo __('Great for honing in on specific things to improve.', "survey-maker")?></div>
                                        </div>
                                        <div class="ays-survey-templates-box-buttons">
                                            <button class="ays-survey-templates-box-apply-button" data-template="employee-satisfaction-survey"><?php echo __("Choose Template" , "survey-maker"); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ays-survey-templates-box" data-template="event-evaluation-survey">
                                    <div class="ays-survey-templates-box-text">                                        
                                        <div class="ays-survey-templates-box-image ays-survey-templates-box-blank-images ays-survey-templates-box-image-event-evaluation">
                                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/templates/event-evaluation.png">
                                        </div>
                                        <div class="ays-survey-templates-box-texts">
                                            <h4 class="ays-survey-templates-box-title"><?php echo __('Event Evaluation Survey Template', "survey-maker")?></h4>
                                            <div class="ays-survey-templates-box-desc"><?php echo __('Get honest feedback from guests and use it to improve your upcoming events.', "survey-maker")?></div>
                                        </div>
                                        <div class="ays-survey-templates-box-buttons">
                                            <button class="ays-survey-templates-box-apply-button" data-template="event-evaluation-survey"><?php echo __("Choose Template" , "survey-maker"); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ays-survey-templates-box" data-template="product-research-survey">
                                    <div class="ays-survey-templates-box-text">                                        
                                        <div class="ays-survey-templates-box-image ays-survey-templates-box-blank-images ays-survey-templates-box-image-product-research">
                                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/templates/product.png">
                                        </div>
                                        <div class="ays-survey-templates-box-texts">
                                            <h4 class="ays-survey-templates-box-title"><?php echo __('Product Research Survey Template', "survey-maker")?></h4>
                                            <div class="ays-survey-templates-box-desc"><?php echo __('Developing a product? Find out more about your target audience with this survey', "survey-maker")?></div>
                                        </div>
                                        <div class="ays-survey-templates-box-buttons">
                                            <button class="ays-survey-templates-box-apply-button" data-template="product-research-survey"><?php echo __("Choose Template" , "survey-maker"); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ays-survey-templates-box" data-template="restaurant-evaluation-survey">
                                    <div class="ays-survey-templates-box-text">                                        
                                        <div class="ays-survey-templates-box-image ays-survey-templates-box-blank-images ays-survey-templates-box-image-restaurant-evaluation">
                                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/templates/restaurant-evaluation.png">
                                        </div>
                                        <div class="ays-survey-templates-box-texts">
                                            <h4 class="ays-survey-templates-box-title"><?php echo __('Restaurant Evaluation Survey Template', "survey-maker")?></h4>
                                            <div class="ays-survey-templates-box-desc"><?php echo __('Help restaurants get better. Ask questions about your customer\'s dining experience.', "survey-maker")?></div>
                                        </div>
                                        <div class="ays-survey-templates-box-buttons">
                                            <button class="ays-survey-templates-box-apply-button" data-template="restaurant-evaluation-survey"><?php echo __("Choose Template" , "survey-maker"); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ays-survey-templates-box" data-template="market-research-survey">
                                    <div class="ays-survey-templates-box-text">                                        
                                        <div class="ays-survey-templates-box-image ays-survey-templates-box-blank-images ays-survey-templates-box-image-market-research">
                                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/templates/market-research.png">
                                        </div>
                                        <div class="ays-survey-templates-box-texts">
                                            <h4 class="ays-survey-templates-box-title"><?php echo __('Market Research Survey Template', "survey-maker")?></h4>
                                            <div class="ays-survey-templates-box-desc"><?php echo __('Easily learn about what customers like. Understand trends with simple questions.', "survey-maker")?></div>
                                        </div>
                                        <div class="ays-survey-templates-box-buttons">
                                            <button class="ays-survey-templates-box-apply-button" data-template="market-research-survey"><?php echo __("Choose Template" , "survey-maker"); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ays-survey-templates-box" data-template="brand-awareness-survey">
                                    <div class="ays-survey-templates-box-text">                                        
                                        <div class="ays-survey-templates-box-image ays-survey-templates-box-blank-images ays-survey-templates-box-image-brand-awareness">
                                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/templates/brand-awareness.png">
                                        </div>
                                        <div class="ays-survey-templates-box-texts">
                                            <h4 class="ays-survey-templates-box-title"><?php echo __('Brand Awareness Survey Template', "survey-maker")?></h4>
                                            <div class="ays-survey-templates-box-desc"><?php echo __('Know how well people know your brand. Ask easy questions to find out.', "survey-maker")?></div>
                                        </div>
                                        <div class="ays-survey-templates-box-buttons">
                                            <button class="ays-survey-templates-box-apply-button" data-template="brand-awareness-survey"><?php echo __("Choose Template" , "survey-maker"); ?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ays-survey-templates-box" data-template="user-persona-survey">
                                    <div class="ays-survey-templates-box-text">                                        
                                        <div class="ays-survey-templates-box-image ays-survey-templates-box-blank-images ays-survey-templates-box-image-user-persona">
                                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/templates/user-persona.png">
                                        </div>
                                        <div class="ays-survey-templates-box-texts">
                                            <h4 class="ays-survey-templates-box-title"><?php echo __('User Persona Survey Template', "survey-maker")?></h4>
                                            <div class="ays-survey-templates-box-desc"><?php echo __('Understand your users better. Ask simple questions to know what they like.', "survey-maker")?></div>
                                        </div>
                                        <div class="ays-survey-templates-box-buttons">
                                            <button class="ays-survey-templates-box-apply-button" data-template="user-persona-survey"><?php echo __("Choose Template" , "survey-maker"); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Survey Templates end -->

        <!-- Pro features modal start -->
            <div class="ays-modal" id="pro-features-popup-modal">
                <div class="ays-modal-content">
                    <!-- Modal Header -->
                    <div class="ays-modal-header">
                        <span class="ays-close-pro-popup">&times;</span>
                        <!-- <h2></h2> -->
                    </div>

                    <!-- Modal body -->
                    <div class="ays-modal-body">
                    <div class="row">
                            <div class="col-sm-6 pro-features-popup-modal-left-section"></div>
                            <div class="col-sm-6 pro-features-popup-modal-right-section">
                            <div class="pro-features-popup-modal-right-box">
                                    <div class="pro-features-popup-modal-right-box-icon"><i class="ays_fa ays_fa_lock"></i></div>

                                    <div class="pro-features-popup-modal-right-box-title"></div>

                                    <div class="pro-features-popup-modal-right-box-content"></div>

                                    <div class="pro-features-popup-modal-right-box-button">
                                        <a href="https://ays-pro.com/wordpress/survey-maker" class="pro-features-popup-modal-right-box-link" target="_blank"><?php echo __("Upgrade PRO NOW", "survey-maker"); ?></a>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="ays-modal-footer" style="display:none">
                    </div>
                </div>
            </div>
        <!-- Pro features modal end -->


    </div>
</div>
