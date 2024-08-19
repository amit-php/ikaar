<?php
    require_once( SURVEY_MAKER_ADMIN_PATH . "/partials/popup/actions/survey-maker-popup-surveys-actions-options.php" );
?>
<div class="wrap">
    <div class="container-fluid">
        <form class="ays-survey-popup-surveys-form" id="ays-survey-popup-surveys-form" method="post">
            <div class="ays-survey-heading-box">
                <div class="ays-survey-wordpress-user-manual-box">
                    <a href="https://ays-pro.com/wordpress-survey-maker-user-manual" target="_blank" style="text-decoration: none;font-size: 13px;">
                        <i class="ays_fa ays_fa_file_text" ></i> 
                        <span style="margin-left: 3px;text-decoration: underline;"><?php echo __( "View Documentation", "survey-maker" ); ?></span>
                    </a>

                </div>
            </div>
            <h1><?php echo $heading; ?></h1>
            <hr/>
            <div id="tab1" class="ays-survey-tab-content ays-survey-tab-content-active">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="<?php echo esc_attr($html_name_prefix); ?>status">
                            <?php echo __('Enable popup',"survey-maker")?>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Turn on the popup for the website based on your configured options.', "survey-maker"); ?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="checkbox" id="<?php echo esc_attr($html_name_prefix); ?>status" name="<?php echo esc_attr($html_name_prefix); ?>status" value="on" <?php echo $status == 'published' ? 'checked' : ''; ?>/>
                    </div>
                </div> <!-- Publish/Unpublish popup -->
                <hr/>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="ays-title">
                            <?php echo __("Title", "survey-maker"); ?>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __("Give a title to your popup.","survey-maker"); ?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="ays-text-input" id="ays-title" name="<?php echo esc_attr($html_name_prefix); ?>title" value="<?php echo $title; ?>" />
                    </div>
                </div> <!-- Title -->
                <hr>
                <div class="form-group row ays_toggle_parent">
                    <div class="col-sm-3">
                        <label for="ays_survey_popup_enable_show_title">
                            <span><?php echo __("Show popup title", "survey-maker"); ?></span>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __("Tick this option to show the popup title on the popup box on the front page.", "survey-maker"); ?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <input type="checkbox" name="ays_survey_popup_enable_show_title" class="ays_toggle_checkbox" id="ays_survey_popup_enable_show_title" <?php echo ($survey_popup_enable_show_title) ? "checked" : ""  ?>>
                    </div>
                    <div class="col-sm-8 ays_toggle_target ays_divider_left <?php echo $survey_popup_enable_show_title ? '' : 'display_none_not_important'; ?>">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="ays_survey_popup_title_font_size">
                                    <?php echo __('Font size',"survey-maker")?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify the font size of the popup title.',"survey-maker"); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_survey_display_flex_width">
                                <div>
                                    <input type="number" class="ays-text-input ays-text-input-short" id="ays_survey_popup_title_font_size" name="ays_survey_popup_title_font_size" value="<?php echo esc_attr($survey_popup_title_font_size); ?>">
                                </div>
                                <div class="ays_dropdown_max_width">
                                    <input type="text" value="px" class='ays-form-hint-for-size' disabled>
                                </div>
                            </div>
                        </div><!-- Popup title Font size -->
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="ays_survey_popup_title_mobile_font_size">
                                    <?php echo __('Font size on mobile',"survey-maker")?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify the font size of the popup title on mobile devices.',"survey-maker"); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_survey_display_flex_width">
                                <div>
                                    <input type="number" class="ays-text-input ays-text-input-short" id="ays_survey_popup_title_mobile_font_size" name="ays_survey_popup_title_mobile_font_size" value="<?php echo esc_attr($survey_popup_title_mobile_font_size); ?>">
                                </div>
                                <div class="ays_dropdown_max_width">
                                    <input type="text" value="px" class='ays-form-hint-for-size' disabled>
                                </div>
                            </div>
                        </div><!-- Popup title font size on mobile -->
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="ays_survey_popup_title_text_color">
                                    <?php echo __('Background color',"survey-maker")?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify the background color of the popup title.',"survey-maker"); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="ays-text-input" id='ays_survey_popup_title_bg_color' name='ays_survey_popup_title_bg_color' data-alpha="true" value="<?php echo $survey_popup_title_bg_color; ?>"/>
                            </div>
                        </div><!-- Popup title Background color -->
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="ays_survey_popup_title_text_color">
                                    <?php echo __('Text color',"survey-maker")?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify the text color of the popup title.',"survey-maker"); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="ays-text-input" id='ays_survey_popup_title_text_color' name='ays_survey_popup_title_text_color' data-alpha="true" value="<?php echo $survey_popup_title_text_color; ?>"/>
                            </div>
                        </div><!-- Popup title text color -->
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="ays-survey-title-alignment">
                                    <?php echo __('Text alignment',"survey-maker")?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify the text alignment of the popup title.',"survey-maker"); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <select id="ays-survey-title-alignment" name="<?php echo esc_attr($html_name_prefix); ?>survey_popup_title_alignment">
                                    <option value="left" <?php echo $survey_popup_title_alignment == 'left' ? 'selected' : ''; ?>><?php echo __('Left' , "survey-maker") ?></option>
                                    <option value="center" <?php echo $survey_popup_title_alignment == 'center' ? 'selected' : ''; ?>><?php echo __('Center' , "survey-maker") ?></option>
                                    <option value="right" <?php echo $survey_popup_title_alignment == 'right' ? 'selected' : ''; ?>><?php echo __('Right' , "survey-maker") ?></option>
                                </select>
                            </div>
                        </div><!-- Popup title alignment -->
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="ays-survey-popup-title-transform">
                                    <?php echo __('Text transform',"survey-maker")?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify the text transformation of popup title, such as converting to uppercase or lowercase.',"survey-maker"); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                            <select id="ays-survey-popup-title-transform" name="ays_survey_popup_title_transform">
                                <option value="none" <?php echo ($survey_popup_title_transform == 'none') ? 'selected' : ''; ?>><?php echo __('Default',"survey-maker"); ?></option>
                                <option value="capitalize" <?php echo ($survey_popup_title_transform == 'capitalize') ? 'selected' : ''; ?>><?php echo __('Capitalize',"survey-maker"); ?></option>
                                <option value="uppercase" <?php echo ($survey_popup_title_transform == 'uppercase') ? 'selected' : ''; ?>><?php echo __('Uppercase',"survey-maker"); ?></option>
                                <option value="lowercase" <?php echo ($survey_popup_title_transform == 'lowercase') ? 'selected' : ''; ?>><?php echo __('Lowercase',"survey-maker"); ?></option>
                            </select>
                            </div>
                        </div><!-- Popup title text transform -->
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for='ays_survey_popup_title_letter_spacing'>
                                    <?php echo __('Letter spacing', "survey-maker"); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Define the space between the letters of the survey popup title in pixels.',"survey-maker"); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_survey_display_flex_width">
                                <div>
                                    <input type="number" class="ays-text-input ays-text-input-short" id='ays_survey_popup_title_letter_spacing' name='ays_survey_popup_title_letter_spacing' value="<?php echo esc_attr($survey_popup_title_letter_spacing); ?>"/>
                                </div>
                                <div class="ays_dropdown_max_width">
                                    <input type="text" value="px" class='ays-form-hint-for-size' disabled>
                                </div>
                            </div>
                        </div><!-- Popup title letter spacing -->
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="ays_survey_popup_hide_title_on_mobile">
                                    <span><?php echo __("Hide on mobile", "survey-maker"); ?></span>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __("Tick this option to hide the popup title on mobile devices.", "survey-maker"); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <input type="checkbox" name="ays_survey_popup_hide_title_on_mobile" id="ays_survey_popup_hide_title_on_mobile" <?php echo ($survey_popup_hide_title_on_mobile) ? "checked" : ""  ?>>
                            </div>
                        </div><!-- Popup title hide on mobile -->
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="ays_survey_popup_title_border_radius">
                                    <?php echo __('Border radius',"survey-maker")?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify the radius of the title border.',"survey-maker"); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_survey_display_flex_width">
                                <div>
                                    <input type="number" class="ays-text-input ays-text-input-short" id="ays_survey_popup_title_border_radius" name="ays_survey_popup_title_border_radius" value="<?php echo esc_attr($survey_popup_title_border_radius); ?>">
                                </div>
                                <div class="ays_dropdown_max_width">
                                    <input type="text" value="px" class='ays-form-hint-for-size' disabled>
                                </div>
                            </div>
                        </div><!-- Title border radius -->
                    </div>
                </div> <!-- Show popup title -->
                <hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="ays-category">
                            <?php echo __("Select Survey", "survey-maker"); ?>
                            <a class="ays_help" data-toggle="tooltip" data-html="true" title="<?php
                                echo htmlspecialchars( sprintf(
                                    __("Choose the survey which you want to display within the popup from your already created list.","survey-maker"),
                                    "<strong>",
                                    "</strong>"
                                ) );
                            ?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <select id="ays-select-popup-survey-id" name="<?php echo esc_attr($html_name_prefix); ?>survey_id">
                            <?php
                          $selected = "";
                          foreach ( $surveys as $key => $survey ):
                              if( $survey_id == $survey["id"] ){
                                  $selected = "selected";
                              }else{
                                  $selected = "";
                              }
                              ?>
                              <option value="<?php echo $survey["id"]; ?>" <?php echo $selected; ?>><?php echo $survey["title"]; ?></option>
                          <?php
                          endforeach;
                            ?>
                        </select>
                    </div>
                    
                </div> <!-- Survey Id -->
                <hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="ays_popup_survey_width">
                            <?php echo __("Popup width", "survey-maker"); ?>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __("Specify the width of your popup in pixels.","survey-maker"); ?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9 ays_survey_display_flex_width">
                        <div>
                            <input type="number" class="ays-text-input ays-text-input-short" id="ays_popup_survey_width" name="ays_popup_survey_width" value="<?php echo $popup_survey_width; ?>"/>
                        </div>                        
                        <div class="ays_dropdown_max_width">
                            <input type="text" value="px" class='ays-form-hint-for-size' disabled>
                        </div>
                    </div>
                </div> <!-- Survey width -->
                <hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="ays_popup_survey_height">
                            <?php echo __("Popup height", "survey-maker"); ?>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __("Specify the height of your popup in pixels.","survey-maker"); ?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9 ays_survey_display_flex_width">
                        <div>
                            <input type="number" class="ays-text-input ays-text-input-short" id="ays_popup_survey_height" name="ays_popup_survey_height" value="<?php echo $popup_survey_height; ?>"/>
                        </div>
                        <div class="ays_dropdown_max_width">
                            <input type="text" value="px" class='ays-form-hint-for-size' disabled>
                        </div>
                    </div>
                </div> <!-- Survey height -->
                <hr/>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="ays_survey_popup_bg_color">
                            <span><?php echo __("Popup background color", "survey-maker"); ?></span>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __("Specify the background color of your popup.", "survey-maker"); ?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="ays-text-input" id='ays_survey_popup_bg_color' name='ays_survey_popup_bg_color' data-alpha="true" value="<?php echo $survey_popup_bg_color; ?>"/>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="ays_survey_hide_popup">
                            <span><?php echo __("Hide popup after one submission", "survey-maker"); ?></span>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __("By enabling the option, the popup will not be shown as soon as a visitor submits the survey.", "survey-maker"); ?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="checkbox" name="ays_survey_hide_popup" class="" id="ays_survey_hide_popup" <?php echo ($hide_popup == "on") ? "checked" : ""  ?>>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="ays_survey_hide_popup_after_close">
                            <span><?php echo __("Hide popup after close", "survey-maker"); ?></span>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __("By enabling the option, the popup will not be shown as soon as a visitor clicks the close button.", "survey-maker"); ?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="checkbox" name="ays_survey_hide_popup_after_close" class="" id="ays_survey_hide_popup_after_close" <?php echo ($hide_popup_after_close == "on") ? "checked" : ""  ?>>
                    </div>
                </div>
                <hr>
                <div class="form-group row" style="margin:0px;">
                    <div class="col-sm-12 ays-pro-features-v2-main-box ays-pro-features-v2-main-box-small">
                        <div class="ays-pro-features-v2-small-buttons-box">
                            <div class="ays-pro-features-v2-video-button"></div>
                            <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                <div class="ays-pro-features-v2-upgrade-text">
                                    <?php echo __("Upgrade" , "survey-maker"); ?>
                                </div>
                            </a>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label>
                                    <span><?php echo __("Show on ", "survey-maker"); ?></span>
                                    <a class="ays_help ays-survey-zindex-for-pro" data-toggle="tooltip" title="<?php echo __("Select on which pages of your website you need the popup to be loaded. For the Except and Selected options, you can choose specific posts and post types.", "survey-maker") ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <label class="ays_survey_loader">
                                    <input type="radio" class="ays-survey-popup-show-where" checked/>
                                    <span><?php echo __("All pages", "survey-maker"); ?></span>
                                </label>
                                <label class="ays_survey_loader">
                                    <input type="radio" class="ays-survey-popup-show-where"/>
                                    <span><?php echo __("Except", "survey-maker"); ?></span>
                                </label>
                                <label class="ays_survey_loader">
                                    <input type="radio" class="ays-survey-popup-show-where"/>
                                    <span><?php echo __("Selected", "survey-maker"); ?></span>
                                </label>
                            </div>
                        </div><!-- Survey show in pages -->
                    </div>
                </div>
                <!-- Popup Position start  -->                
                <hr>
                <div class="popup_survey_position_block">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="<?php echo $this->plugin_name; ?>-popup-position">
                                <span><?php echo __("Popup position", "survey-maker"); ?></span>
                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __("Specify the position of the popup on the screen.", "survey-maker"); ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <table id="ays-survey-popup-position-table">
                                <tr>
                                    <td data-value="left-top" data-id="1" style="<?php echo $popup_position == "left-top" ? "background-color: #a2d6e7" : ""; ?>"></td>
                                    <td data-value="top-center" data-id="2" style="<?php echo $popup_position == "top-center" ? "background-color: #a2d6e7" : ""; ?>"></td>
                                    <td data-value="right-top" data-id="3" style="<?php echo $popup_position == "right-top" ? "background-color: #a2d6e7" : ""; ?>"></td>
                                </tr>
                                <tr>
                                    <td data-value="left-center" data-id="4" style="<?php echo $popup_position == "left-center" ? "background-color: #a2d6e7" : ""; ?>"></td>
                                    <td data-value="center-center" data-id="5" style="<?php echo $popup_position == "center-center" ? "background-color: #a2d6e7" : ""; ?>"></td>
                                    <td data-value="right-center" data-id="6" style="<?php echo $popup_position == "right-center" ? "background-color: #a2d6e7" : ""; ?>"></td>
                                </tr>
                                <tr>
                                    <td data-value="left-bottom" data-id="7" style="<?php echo $popup_position == "left-bottom" ? "background-color: #a2d6e7" : ""; ?>"></td>
                                    <td data-value="center-bottom" data-id="8" style="<?php echo $popup_position == "center-bottom" ? "background-color: #a2d6e7" : ""; ?>"></td>
                                    <td data-value="right-bottom" data-id="9" style="<?php echo $popup_position == "right-bottom" ? "background-color: #a2d6e7" : ""; ?>"></td>
                                </tr>
                            </table>
                            <input type="hidden" name="<?php echo $html_name_prefix; ?>survey_popup_position" id="ays-survey-popup-position-val" value="<?php echo $popup_position; ?>" >
                        </div>
                    </div>
                    <hr class="ays_pb_hr_hide <?php echo $popup_position == "center-center" ? "display_none" : ""; ?>"/>
                    <div id="popupMargin" class="form-group row <?php echo $popup_position == "center-center" ? "display_none" : ""; ?>">
                        <div class="col-sm-3">
                            <label for="<?php echo $this->plugin_name; ?>-pb_margin">
                                <span><?php echo __("Popup margin", "survey-maker"); ?>(px)</span>
                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __("Specify the popup margin in pixels. It accepts only numerical values.", "survey-maker"); ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <input type="number" id="<?php echo $this->plugin_name; ?>-popup_margin" name="<?php echo $html_name_prefix; ?>survey_popup_margin"  class="ays-text-input-short"  value="<?php echo $popup_margin; ?>" />
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Popup Position end  -->
                <!-- Popup Trigger start  -->
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="<?php echo esc_attr($html_name_prefix); ?>survey_popup_trigger">
                            <span> <?php echo __('Popup trigger', "survey-maker"); ?></span>
                                <a class="ays_help" data-toggle="tooltip" data-html="true"
                                title="<?php
                                    echo __('Choose when to show the popup on the website.', "survey-maker") .
                                    "<ul style='list-style-type: circle;padding-left: 20px;'>".
                                        "<li>". __('On page load - popup will be shown as soon as the page is loaded.',"survey-maker") ."</li>".
                                        "<li>". __('On click - popup will be shown when the user clicks on the assigned CSS element(s). Select CSS element with the help of CSS selector(s) option.',"survey-maker") ."</li>".
                                        "<li>". __('On Exit - the popup will show up as soon as the user wants to leave the page.',"survey-maker") ."</li>".
                                    "</ul>";
                                ?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <select id="<?php echo esc_attr($html_name_prefix); ?>survey_popup_trigger" class="ays-text-input ays_survey_aysDropdown" name="<?php echo esc_attr($html_name_prefix); ?>survey_popup_trigger">
                            <?php
                                foreach ($trigger_type_arr as $trigger_type_key => $trigger_type_val):
                                    if($popup_trigger_type == $trigger_type_key):
                                        $selected = 'selected';
                                    else:
                                        $selected = '';
                                    endif;
                            ?>
                                <option value="<?php echo $trigger_type_key; ?>" <?php echo $selected; ?>><?php echo $trigger_type_val; ?></option>
                            <?php
                                endforeach;
                            ?>
                            <option value="on_exit_popup" disabled><?php echo __('On Exit (Pro)', "survey-maker"); ?></option>

                        </select>
                    </div>
                </div>
                <hr class="<?php echo $popup_trigger_type == 'on_load' ? 'display_none_not_important' : '' ?>"/>
                <div class="form-group row ays-survey-popup-selector <?php echo $popup_trigger_type == 'on_load' ||  $popup_trigger_type == 'on_exit' ? 'display_none_not_important' : '' ?> ">
                    <div class="col-sm-3">
                        <label for="<?php echo esc_attr($html_name_prefix); ?>survey_popup_selector">
                    <span>
                        <?php echo __('CSS selector(s) for trigger click', "survey-maker"); ?>
                        <a class="ays_help" data-toggle="tooltip" title="<?php echo __("Add your preferred CSS selector(s) if you have given “On click” or “Both” value to the “Popup trigger” option. For example #mybutton or .mybutton.", "survey-maker"); ?>">
                            <i class="ays_fa ays_fa_info_circle"></i>
                        </a>
                    </span>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="<?php echo esc_attr($html_name_prefix); ?>survey_popup_selector" name="<?php echo esc_attr($html_name_prefix); ?>survey_popup_selector"  class="ays-text-input" value="<?php echo $popup_selector; ?>" placeholder="#myButtonId, .myButtonClass, .myButton" />
                    </div>
                </div>
                <!-- Popup Trigger end  -->
                <hr>
                <div class="form-group row ays_toggle_parent">
                    <div class="col-sm-3">
                        <label for="ays_survey_enable_popup_close_after_finish">
                            <?php echo __('Enable close popup after finish',"survey-maker")?>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Tick this option to close the popup after finish.',"survey-maker")?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <input type="checkbox"
                            class="ays-enable-timer1 ays_toggle_checkbox"
                            id="ays_survey_enable_popup_close_after_finish"
                            name="ays_survey_enable_popup_close_after_finish"
                            value="on"
                            <?php echo ($survey_enable_popup_close_after_finish) ? 'checked' : '';?>/>
                    </div>
                    <div class="col-sm-8 ays_toggle_target ays_divider_left <?php echo $survey_enable_popup_close_after_finish ? '' : 'display_none_not_important'; ?>">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="ays_survey_popup_close_after_finish_delay">
                                    <?php echo __('Delay',"survey-maker")?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify the delay for closing the popup after finish.',"survey-maker"); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_survey_display_flex_width">
                                <div>
                                    <input type="number" class="ays-text-input ays-text-input-short" id="ays_survey_popup_close_after_finish_delay" name="ays_survey_popup_close_after_finish_delay" value="<?php echo esc_attr($survey_popup_close_after_finish_delay); ?>">
                                </div>
                                <div class="ays_dropdown_max_width">
                                    <input type="text" value="sec" class='ays-form-hint-for-size' disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Close popup after finish -->    
                <hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="ays_survey_enable_popup_full_screen_mode">
                            <?php echo __('Enable full-screen mode',"survey-maker")?>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Allow the popup to enter full-screen mode by pressing the icon located in the top-right corner of the popup container.',"survey-maker")?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="checkbox"
                               class="ays-enable-timer1"
                               id="ays_survey_enable_popup_full_screen_mode"
                               name="ays_survey_enable_popup_full_screen_mode"
                               value="on"
                               <?php echo $survey_popup_full_screen;?>/>
                    </div>
                </div> <!-- Open Full Screen Mode -->
                <hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="ays_survey_popup_enable_close_by_esc">
                            <?php echo __('Close by pressing the ESC',"survey-maker")?>
                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Tick this option to allow close the popup by pressing the ESC button from the keyboard.',"survey-maker")?>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="checkbox"
                               class="ays-enable-timer1"
                               id="ays_survey_popup_enable_close_by_esc"
                               name="ays_survey_popup_enable_close_by_esc"
                               value="on"
                               <?php echo $survey_popup_enable_close_by_esc;?>/>
                    </div>
                </div> <!-- Close by pressing the ESC -->
            </div>
            <hr/>
            
            <input type="hidden" name="<?php echo esc_attr($html_name_prefix); ?>author_id" value="<?php echo $author_id; ?>">
            <input type="hidden" name="<?php echo esc_attr($html_name_prefix); ?>date_created" value="<?php echo $date_created; ?>">
            <input type="hidden" name="<?php echo esc_attr($html_name_prefix); ?>date_modified" value="<?php echo $date_modified; ?>">
            <?php
                wp_nonce_field("popup_survey_action", "popup_survey_action");
                $other_attributes = array("id" => "ays-button-save");
                submit_button(__("Save and close", "survey-maker"), "primary ays-button ays-survey-loader-banner", "ays_submit", false, $other_attributes);
                $other_attributes = array(
                    'id' => 'ays-button-apply',
                    'title' => 'Ctrl + s',
                    'data-toggle' => 'tooltip',
                    'data-delay'=> '{"show":"1000"}'
                );
                submit_button(__("Save", "survey-maker"), "ays-button ays-survey-loader-banner", "ays_apply", false, $other_attributes);

                echo $loader_iamge;
            ?>
        </form>
    </div>
</div>
