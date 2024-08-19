<?php
global $wpdb;
$survey_id = isset($_GET['survey']) ? intval( sanitize_text_field( $_GET['survey'] ) ) : null;
if($survey_id === null){
    wp_redirect( admin_url('admin.php') . '?page=' . $this->plugin_name . '-submissions' );
}

if(isset($_GET['ays_survey_tab'])){
    $ays_survey_tab = sanitize_text_field( $_GET['ays_survey_tab'] );
}else{
    $ays_survey_tab = 'statistics_of_answer';
}

if(isset($_REQUEST['s'])){
    $ays_survey_tab = 'poststuff';
}

$sql = "SELECT * FROM " . $wpdb->prefix . SURVEY_MAKER_DB_PREFIX . "surveys WHERE id =" . absint( $survey_id );
$survey_name = $wpdb->get_row( $sql, 'ARRAY_A' );

$survey_options = isset( $survey_name['options'] ) && $survey_name['options'] != '' ? json_decode( $survey_name['options'], true ) : array();

$survey_for_charts = isset( $survey_options['survey_color'] ) && $survey_options['survey_color'] != '' ? esc_attr($survey_options['survey_color']) : "rgb(255, 87, 34)";
$survey_for_charts = Survey_Maker_Data::rgb2hex($survey_for_charts);

// Allow HTML in answers
$survey_options[ 'survey_allow_html_in_answers' ] = isset($survey_options[ 'survey_allow_html_in_answers' ]) ? $survey_options[ 'survey_allow_html_in_answers' ] : 'off';
$allow_html_in_answers = (isset($survey_options[ 'survey_allow_html_in_answers' ]) && $survey_options[ 'survey_allow_html_in_answers' ] == 'on') ? true : false;

// Allow HTML in description
$survey_options[ 'survey_allow_html_in_section_description' ] = isset($survey_options[ 'survey_allow_html_in_section_description' ]) ? $survey_options[ 'survey_allow_html_in_section_description' ] : 'off';
$survey_allow_html_in_section_description = (isset($survey_options[ 'survey_allow_html_in_section_description' ]) && $survey_options[ 'survey_allow_html_in_section_description' ] == 'on') ? true : false;

$get_count_per_day = $this->each_submission_obj->get_submision_line_chart($survey_id);
$get_users_count = $this->each_submission_obj->survey_users_count();

// For charts in summary
$survey_question_results = $this->ays_survey_question_results( $survey_id );
$question_results = $survey_question_results['questions'];
$total_count = $survey_question_results['total_count'];

$last_submission = $this->ays_survey_get_last_submission_id( $survey_id );

$ays_survey_individual_questions = $this->ays_survey_individual_results_for_one_submission( $last_submission, $survey_name );

// Show question title as HTML
$survey_options[ 'survey_show_questions_as_html' ] = isset($survey_options[ 'survey_show_questions_as_html' ]) ? $survey_options[ 'survey_show_questions_as_html' ] : 'on';
$survey_show_questions_as_html = $survey_options[ 'survey_show_questions_as_html' ] == 'on' ? true : false;

// Get user info
$individual_user_name   = "";
$individual_user_email  = "";
$individual_user_ip     = "";
$individual_user_date   = "";
$individual_user_sub_id = "";
$individual_user_device_type = "";
if( isset($ays_survey_individual_questions['user_info']) && is_array( $ays_survey_individual_questions['user_info']) ){
    $individual_user_name   = isset($ays_survey_individual_questions['user_info']['user_name']) && isset($ays_survey_individual_questions['user_info']['user_name']) ? $ays_survey_individual_questions['user_info']['user_name'] : "";
    $individual_user_email  = isset($ays_survey_individual_questions['user_info']['user_email']) && isset($ays_survey_individual_questions['user_info']['user_email'])  ? wp_kses_post($ays_survey_individual_questions['user_info']['user_email']) : "";
    $individual_user_ip     = isset($ays_survey_individual_questions['user_info']['user_ip']) && isset($ays_survey_individual_questions['user_info']['user_ip'])  ? esc_attr($ays_survey_individual_questions['user_info']['user_ip']) : "";
    $individual_user_date   = isset($ays_survey_individual_questions['user_info']['submission_date']) && isset($ays_survey_individual_questions['user_info']['submission_date'])  ? esc_attr($ays_survey_individual_questions['user_info']['submission_date']) : "";
    $individual_user_sub_id = isset($ays_survey_individual_questions['user_info']['id']) && isset($ays_survey_individual_questions['user_info']['id'])  ? esc_attr($ays_survey_individual_questions['user_info']['id']) : "";

    $individual_user_extra_data  = isset($ays_survey_individual_questions['user_info']['options']) && $ays_survey_individual_questions['user_info']['options']  != '' ? json_decode(($ays_survey_individual_questions['user_info']['options']) , 'true') : array();
    $individual_user_device_type = isset($individual_user_extra_data['device']) && $individual_user_extra_data['device']  != '' ? esc_attr($individual_user_extra_data['device']) : '';
}
if( empty( $ays_survey_individual_questions['sections'] ) ){
    $question_results = array();
}

$text_types = array(
    'text',
    'short_text',
    'number',
    'name',
    'email',
);

$submission_count_and_ids = $this->get_submission_count_and_ids();

wp_localize_script( $this->plugin_name, 'SurveyChartData', array( 
    'countPerDayData' => $get_count_per_day,
    'usersCount'      => $get_users_count,
    // 'perAnswerCount' => $question_results,
    // 'submission_count' => $submission_count
    'perAnswerCount'  => $question_results,
    'chartColor'      => $survey_for_charts,
) );

$survey_data_clipboard = array(
    "user_name"   => $individual_user_name,
    "user_email"  => $individual_user_email,
    "user_ip"     => $individual_user_ip,
    "user_date"   => $individual_user_date,
    "user_sub_id" => $individual_user_sub_id,
    "user_device_type" => $individual_user_device_type,
);
$survey_data_formated_for_clipboard = Survey_Maker_Data::ays_survey_copy_text_formater($survey_data_clipboard);

?>

<div class="wrap ays_each_results_table">
    <div class="ays-survey-heading-box">
        <div class="ays-survey-wordpress-user-manual-box">
            <a href="https://ays-pro.com/wordpress-survey-maker-user-manual" target="_blank" style="text-decoration: none;font-size: 13px;">
                <i class="ays_fa ays_fa_file_text" ></i> 
                <span style="margin-left: 3px;text-decoration: underline;">View Documentation</span>
            </a>
        </div>
    </div>
    <h1 class="wp-heading-inline" style="padding-left:15px;">
        <?php
        echo sprintf( '<a href="?page=%s" class="go_back"><span><i class="fa fa-long-arrow-left" aria-hidden="true"></i> %s</span></a>', $this->plugin_name."-submissions", __("Back to Submissions", "survey-maker") );
        ?>
    </h1>
    <div style="display: flex; justify-content: space-between;flex-wrap:wrap">
        <h1 class="wp-heading-inline" style="padding-left:15px;">
            <?php               
                $url = admin_url('admin.php');
                $url = esc_url_raw(add_query_arg(array(
                    "page"   => $this->plugin_name,
                    "action" => "edit",
                    "id"     => $survey_id
                ) , $url));
                echo "<span>". __("Reports for", "survey-maker") . "</span>" ." <a href='".esc_url($url)."' target='_blank' class='ays-survey-to-curnet-survey'>\"" .    __(esc_html($survey_name['title']), "survey-maker") . "\""."</a>";
            ?>
        </h1>
        <div class="ays-survey-question-action-butons" style="padding: 10px; display: inline-block;">
            <a type="button" class="button button-primary ays-survey-question-actions-pro-button" href="#" style="opacity:0.5;" data-video-url="https://www.youtube.com/watch?v=5azAn4qEOmo" data-option-title="<?php echo __('Export Submissions',"survey-maker")?>" data-option-text="<strong> To get the reports </strong> of your survey submissions, use the “Export Submissions” feature. You also have the option to <strong> select specific users, the period of submissions </strong> , and also the <strong> format of your exporting document </strong>. Get the instant report of your submissions in your desired format."><?php echo __('Export submissions', "survey-maker"); ?></a>
            <a type="button" class="button button-primary ays-survey-question-actions-pro-button" href="#" style="opacity:0.5;"  data-video-url="https://www.youtube.com/watch?v=EKhq0Sja3tE" data-option-title="<?php echo __('Export to XLSX',"survey-maker")?>" data-option-text="Analyzing the survey submissions is the most important part of surveys, and having the results at your disposal makes the process of analyzing much easier. <strong> Download the reports in.</strong> XLSX format and have the full results sheet at your fingertips with the <strong> answers, their percentages </strong>, and <strong> the number of survey takers. </strong>"><?php echo __('Export to XLSX', "survey-maker"); ?></a>
        </div>
    </div>
    <div class="form-group row" style="margin:0px;">
        <div class="col-sm-12 ays-pro-features-v2-main-box ays-pro-features-v2-main-box-small" style="background-color: rgb(53 113 196 / 7%);">
            <div class="ays-pro-features-v2-small-buttons-box ays-pro-pro-features-popup" data-video-url="https://www.youtube.com/watch?v=N3vJjECIShQ" data-option-title="<?php echo __('Submission filters',"survey-maker")?>" data-option-text="Easily filter submissions on your survey based on the question answers. Get the needed data and make improvements due to the well-designed filtering system. Make use of this option and filter survey responses quickly.">
                <div class="ays-pro-features-v2-video-button">
                    <div class="ays-pro-features-v2-video-icon" style="background-image: url('<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Video_24x24.svg');" data-img-src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Video_24x24_Hover.svg"></div>
                    <div class="ays-pro-features-v2-video-text">
                        <?php echo __("Watch Video" , "survey-maker"); ?>
                    </div>
                </div>
                <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" class="ays-pro-features-v2-upgrade-button">
                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                    <div class="ays-pro-features-v2-upgrade-text">
                        <?php echo __("Upgrade" , "survey-maker"); ?>
                    </div>
                </a>
            </div>
            <div class="ays-survey-submissions-filters-section">
                <div class="ays-survey-submissions-filter-button">
                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" overflow="visible" preserveAspectRatio="none" viewBox="0 0 16 16" width="16" height="16"><g transform="translate(0, 0)"><defs><path id="path-169778375629214" d="M20.31816722868322 5.092834549770544 C20.31816722868322 5.092834549770544 5.817641447783829 5.092834549770544 5.817641447783829 5.092834549770544 C5.512596577862579 5.071023695167673 5.251129546501509 5.256415959292082 5.14218495010106 5.539957069129414 C5.011451434420527 5.801687324363874 5.076818192260794 6.1397555707083855 5.316496304341776 6.3360532621342305 C5.316496304341776 6.3360532621342305 10.894459640044625 11.930537467770824 10.894459640044625 11.930537467770824 C10.894459640044625 11.930537467770824 10.894459640044625 17.448683682297368 10.894459640044625 17.448683682297368 C10.894459640044625 17.644981373723212 10.970720857524936 17.830373637847625 11.112348832845516 17.961238765464852 C11.112348832845516 17.961238765464852 14.02116955673743 20.872987854948224 14.02116955673743 20.872987854948224 C14.151903072417964 21.01475840986689 14.337108886298722 21.09109640097694 14.533209159819528 21.09109640097694 C14.631259296579927 21.09109640097694 14.729309433340331 21.069285546374072 14.81646511046069 21.036569264469758 C15.099721061101844 20.927514991455404 15.27403241534256 20.654879308919504 15.252243496062473 20.3495273444793 C15.252243496062473 20.3495273444793 15.252243496062473 11.930537467770826 15.252243496062473 11.930537467770826 C15.252243496062473 11.930537467770826 20.841101291405362 6.336053262134233 20.841101291405362 6.336053262134233 C21.0698849438463 6.139755570708387 21.146146161326612 5.812592751665312 21.00451818600603 5.539957069129416 C20.895573589605586 5.256415959292082 20.623212098604473 5.071023695167673 20.31816722868322 5.092834549770544 Z" vector-effect="non-scaling-stroke"/></defs><g transform="translate(-5.07598791074798, -5.0910964009769435)"><path d="M20.31816722868322 5.092834549770544 C20.31816722868322 5.092834549770544 5.817641447783829 5.092834549770544 5.817641447783829 5.092834549770544 C5.512596577862579 5.071023695167673 5.251129546501509 5.256415959292082 5.14218495010106 5.539957069129414 C5.011451434420527 5.801687324363874 5.076818192260794 6.1397555707083855 5.316496304341776 6.3360532621342305 C5.316496304341776 6.3360532621342305 10.894459640044625 11.930537467770824 10.894459640044625 11.930537467770824 C10.894459640044625 11.930537467770824 10.894459640044625 17.448683682297368 10.894459640044625 17.448683682297368 C10.894459640044625 17.644981373723212 10.970720857524936 17.830373637847625 11.112348832845516 17.961238765464852 C11.112348832845516 17.961238765464852 14.02116955673743 20.872987854948224 14.02116955673743 20.872987854948224 C14.151903072417964 21.01475840986689 14.337108886298722 21.09109640097694 14.533209159819528 21.09109640097694 C14.631259296579927 21.09109640097694 14.729309433340331 21.069285546374072 14.81646511046069 21.036569264469758 C15.099721061101844 20.927514991455404 15.27403241534256 20.654879308919504 15.252243496062473 20.3495273444793 C15.252243496062473 20.3495273444793 15.252243496062473 11.930537467770826 15.252243496062473 11.930537467770826 C15.252243496062473 11.930537467770826 20.841101291405362 6.336053262134233 20.841101291405362 6.336053262134233 C21.0698849438463 6.139755570708387 21.146146161326612 5.812592751665312 21.00451818600603 5.539957069129416 C20.895573589605586 5.256415959292082 20.623212098604473 5.071023695167673 20.31816722868322 5.092834549770544 Z" style="stroke-width: 0; stroke-linecap: butt; stroke-linejoin: miter; fill: rgb(19, 101, 143);" vector-effect="non-scaling-stroke"/></g></g></svg>
                    <?php echo __( "Filters", "survey-maker" ); ?>
                </div>
                <div class="ays-survey-submissions-filter-container">
                    <div class="ays-survey-submissions-filter-section">
                        <select class="form-select" id="ays-survey-submissions-filter-post">
                            <option value=""><?php echo __( "Select post", "survey-maker" ); ?></option>                    
                        </select>
                        <input type="date" name="filterbystartdate" class="ays-survey-submissions-filter-date" id="ays-survey-submissions-filter-start-date" placeholder="From">
                        <input type="date" name="filterbyenddate" class="ays-survey-submissions-filter-date" id="ays-survey-submissions-filter-end-date" placeholder="To">
                        <button type="submit" class="btn btn-outline-primary btn-sm" name="ays_survey_submissions_filter" id="ays-survey-submissions-filter"><?php echo esc_html(__( 'Filter', "survey-maker" )); ?></button>
                        <button type="submit" class="btn btn-outline-primary btn-sm" name="ays_survey_submissions_filter_clear" id="ays-survey-submissions-filter-clear"><?php echo esc_html(__( 'Clear filters', "survey-maker" )); ?></button>
                    </div>
                    <br>
                    <div class="ays-survey-submissions-filter-section">
                        <select class="form-select ays-survey-submissions-filter-question">
                            <option value=""><?php echo __( "Select question", "survey-maker" ); ?></option>                            
                        </select>
                        <select name="filterbyanswer" class="form-select ays-survey-submissions-filter-answer">
                            <option value=""><?php echo __( "Select answer", "survey-maker" ); ?></option>    
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-tab-wrapper">
        <a href="#statistics_of_answer" class="nav-tab <?php echo ($ays_survey_tab == 'statistics_of_answer') ? 'nav-tab-active' : ''; ?>"><?php echo __("Summary", "survey-maker"); ?></a>
        <a href="#questions" class="nav-tab <?php echo ($ays_survey_tab == 'questions') ? 'nav-tab-active' : ''; ?>"><?php echo __("Individual", "survey-maker"); ?></a>
        <a href="#poststuff" class="nav-tab <?php echo ($ays_survey_tab == 'poststuff') ? 'nav-tab-active' : ''; ?>" ><?php echo __("Submissions", "survey-maker"); ?></a>
        <a href="#statistics" class="nav-tab <?php echo ($ays_survey_tab == 'statistics') ? 'nav-tab-active' : ''; ?>"><?php echo __("Analytics", "survey-maker"); ?></a>
    </div>
    <div id="poststuff" class="ays-survey-tab-content <?php echo ($ays_survey_tab == 'poststuff') ? 'ays-survey-tab-content-active' : ''; ?>">
        <div id="post-body" class="metabox-holder">
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <?php
                        $this->each_submission_obj->views();
                    ?>
                    <form method="post">
                      <?php
                        $this->each_submission_obj->prepare_items();
                        $this->each_submission_obj->search_box('Search', "survey-maker");
                        $this->each_submission_obj->display();
                        $this->each_submission_obj->mark_as_read_all_results( $survey_id );
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>

    <div id="statistics" class="ays-survey-tab-content <?php echo ($ays_survey_tab == 'statistics') ? 'ays-survey-tab-content-active' : ''; ?>">
        <div class="wrap col-sm-12 ays-pro-features-v2-main-box" style="padding:10px 0 5px 10px;">
            <div class="ays-pro-features-v2-big-buttons-box">
                <div class="ays-pro-features-v2-video-button"></div>
                <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" class="ays-pro-features-v2-upgrade-button">
                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                    <div class="ays-pro-features-v2-upgrade-text">
                        <?php echo __("Upgrade" , "survey-maker"); ?>
                    </div>
                </a>
            </div>
            <div class="ays-pro-features-v2-small-buttons-box">
                <div class="ays-pro-features-v2-video-button"></div>
                <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" class="ays-pro-features-v2-upgrade-button">
                    <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                    <div class="ays-pro-features-v2-upgrade-text">
                        <?php echo __("Upgrade" , "survey-maker"); ?>
                    </div>
                </a>
            </div>
            <div class="ays-survey-submission-summary-question-container">
                <div class="ays-survey-submission-summary-question-header">
                    <div class="ays-survey-submission-summary-question-header-content">
                        <h1 style="text-align:center;"><?php echo __("Submission count per day", "survey-maker"); ?></h1>
                    </div>
                </div>
                <div class="ays-survey-submission-summary-question-content">
                    <div id="survey_chart1_div" class="chart_div"></div>
                </div>
            </div>
            <div class="ays-survey-submission-summary-question-container">
                <div class="ays-survey-submission-summary-question-header">
                    <div class="ays-survey-submission-summary-question-header-content">
                        <h1 style="text-align:center;"><?php echo __("Survey passed users by user role", "survey-maker"); ?></h1>
                    </div>
                </div>
                <div class="ays-survey-submission-summary-question-content">
                    <div id="survey_chart2_div" class="chart_div"></div>
                </div>
            </div>
            <div class="ays-survey-submission-summary-question-container">
                <div class="ays-survey-submission-summary-question-header">
                    <div class="ays-survey-submission-summary-question-header-content">
                        <h1 style="text-align:center;"><?php echo __("Detected device", "survey-maker"); ?></h1>
                    </div>
                </div>
                <div class="ays-survey-submission-summary-question-content">
                    <div id="survey_chart3_div" class="chart_div"></div>
                </div>
            </div>
            <div class="ays-survey-submission-summary-question-container">
                <div class="ays-survey-submission-summary-question-header">
                    <div class="ays-survey-submission-summary-question-header-content">
                        <h1 style="text-align:center;"><?php echo __("Detected Countries", "survey-maker"); ?></h1>
                    </div>
                </div>
                <div class="ays-survey-submission-summary-question-content">
                    <div id="survey_chart4_div" class="chart_div"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="questions" class="ays-survey-tab-content <?php echo ($ays_survey_tab == 'questions') ? 'ays-survey-tab-content-active' : ''; ?>">
        <div class="wrap">
            <div class="ays_survey_container_each_result">
                <div class="ays_survey_response_count">
                    <div class="form-group row">
                        <div class="col-sm-6" style="font-size: 13px;"><?php echo __('Responses cannot be edited',"survey-maker"); ?></div>
                        <div class="col-sm-6 ays-survey-question-action-butons" style="align-items: center;">
                            <span style="min-width: 70px;"><?php echo __("Export to", "survey-maker"); ?></span>
                            <a download="" id="downloadFile" hidden href=""></a>
                            <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" type="button" class="button button-primary ays-survey-export-button" style="opacity: 0.5;"><?php echo __("PDF", "survey-maker"); ?></a>
                            <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" type="button" class="button button-primary ays-survey-export-button" style="opacity: 0.5;"><?php echo __("XLSX", "survey-maker"); ?></a>
                        </div>
                    </div>
                    <?php
                    if(intval($submission_count_and_ids['submission_count']) > 0):
                    ?>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <h1><?php 
                                echo esc_attr($submission_count_and_ids['submission_count']);
                                echo __(" Responses","survey-maker");
                            ?></h1>
                        </div>
                        <div class="col-sm-6 ays-survey-question-action-butons">
                            <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" type="button" class="button button-primary" style="opacity: 0.5;"><?php echo __( 'Print', "survey-maker"); ?></a>
                        </div>
                    </div>
                    <div class="ays_survey_previous_next_conteiner">
                        <div class="ays_survey_previous_next ays_survey_previous" data-name="ays_survey_previous">
                            <div class="appsMaterialWizButtonPapericonbuttonEl" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<?php echo __('Previous response',"survey-maker"); ?>">
                                <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/arrow-left.svg">
                            </div>
                        </div>
                        <div class="ays_submissions_input_box">
                            <div class="" style="position: relative;margin-right: 10px;">
                                <input type="number" class="ays_number_of_result ays-survey-question-input ays-survey-input" value="<?php echo esc_attr($submission_count_and_ids['submission_count']); ?>" min="1" max="<?php echo esc_attr($submission_count_and_ids['submission_count']); ?>" badinput="false" autocomplete="off" data-id="<?php echo esc_attr($survey_id); ?>">
                                <div class="ays-survey-input-underline" style="margin:0;"></div>
                                <div class="ays-survey-input-underline-animation" style="margin:0;"></div>
                            </div>
                            <input type="hidden" class="ays_submissions_id_str" value="<?php echo esc_attr($submission_count_and_ids['submission_ids']); ?>">
                            <span>of <?php echo esc_attr($submission_count_and_ids['submission_count']); ?></span>
                        </div>
                        <div class="ays_survey_previous_next ays_survey_next" data-name="ays_survey_next">
                            <div class="appsMaterialWizButtonPapericonbuttonEl" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<?php echo __('Next response',"survey-maker"); ?>">
                                <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/arrow-right.svg">
                            </div>
                        </div>
                    </div>
                    <?php
                    else:?>
                        <h1 style="width:100%;text-align:center;"><?php
                        echo __("There are no responses yet.","survey-maker");
                        ?></h1>
                    <?php
                    endif;
                    ?>
                </div>
                <?php if( intval($submission_count_and_ids['submission_count']) > 0 ):?>
                <div class="ays_survey_each_sub_user_info">
                    <div class="ays_survey_each_sub_user_info_header">
                        <div class="ays_survey_each_sub_user_info_header_text">
                            <span><?php echo __("User Information" , "survey-maker"); ?></span>
                        </div>
                        <div class="ays_survey_each_sub_user_info_header_button">
                            <button type="button" class="button ays_help" data-toggle="tooltip" title="<?php echo __('Click for copy',"survey-maker");?>" data-clipboard-text="<?php echo esc_attr($survey_data_formated_for_clipboard); ?>"><?php echo __("Copy user info to clipboard" , "survey-maker"); ?></button>
                        </div>
                    </div>
                    <div class="ays_survey_each_sub_user_info_body ays_survey_copyable_box">
                        <div class="ays_survey_each_sub_user_info_columns">
                            <div ><?php echo __("User name" , "survey-maker"); ?></div>
                            <div class="ays_survey_each_sub_user_info_name"><?php echo esc_html($individual_user_name);?></div>
                        </div>
                        <div class="ays_survey_each_sub_user_info_columns">
                            <div ><?php echo __("User email" , "survey-maker"); ?></div>
                            <div class="ays_survey_each_sub_user_info_email"><?php echo esc_html($individual_user_email);?></div>
                        </div>
                        <div class="ays_survey_each_sub_user_info_columns">
                            <div ><?php echo __("User IP" , "survey-maker");   ?></div>
                            <div class="ays_survey_each_sub_user_info_user_ip"><?php echo esc_html($individual_user_ip);?></div>
                        </div>
                        <div class="ays_survey_each_sub_user_info_columns">
                            <div ><?php echo __("Submission Date" , "survey-maker"); ?></div>
                            <div class="ays_survey_each_sub_user_info_sub_date"><?php echo esc_html($individual_user_date);?></div>
                        </div>
                        <div class="ays_survey_each_sub_user_info_columns">
                            <div ><?php echo __("Submission id" , "survey-maker"); ?></div>
                            <div class="ays_survey_each_sub_user_info_sub_id"><?php echo esc_html($individual_user_sub_id);?></div>
                        </div>
                        <?php if( isset($individual_user_device_type) && $individual_user_device_type != '' ): ?>
                            <div class="ays_survey_each_sub_user_info_columns">
                                <div><?php echo __("Device" , "survey-maker"); ?></div>
                                <div class="ays_survey_each_sub_user_info_device_type"><?php echo esc_html(ucfirst($individual_user_device_type));?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row" style="margin:0px;">
                    <div class="col-sm-12 ays-pro-features-v2-main-box ays-pro-features-v2-main-box-small" style="background-color: rgb(53 113 196 / 7%);">
                        <div class="ays-pro-features-v2-small-buttons-box">
                            <div class="ays-pro-features-v2-video-button"></div>
                            <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" class="ays-pro-features-v2-upgrade-button">
                                <div class="ays-pro-features-v2-upgrade-icon" style="background-image: url('<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg');" data-img-src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/pro-features-icons/Locked_24x24.svg"></div>
                                <div class="ays-pro-features-v2-upgrade-text">
                                    <?php echo __("Upgrade" , "survey-maker"); ?>
                                </div>
                            </a>
                        </div>
                        <div class="ays-survey-each-sub-dashboard-admin-note">
                            <div class="ays-survey-each-sub-dashboard-admin-note-button-box">
                                <button type="button" class="button button-primary ays-survey-each-sub-dashboard-admin-note-button-box"><?php echo __( 'Click For Admin Note', "survey-maker"); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <div class="question_result_container">
                    <div class="ays_question_answer" style="position:relative;">
                        <div class="ays-survey-submission-sections">
                        <?php
                            $checked = '';
                            $disabled = '';
                            $selected = '';
                            $color = '';
                            if( is_array( $ays_survey_individual_questions['sections'] ) ):
                            foreach ($ays_survey_individual_questions['sections'] as $section_key => $section) {
                                ?>
                            <div class="ays-survey-submission-section">
                                <?php if($section['title'] != "" || $section['description'] != ""):?>
                                <div class="ays_survey_name" style="border-top-color: <?php echo esc_attr($survey_for_charts); ?>;">
                                    <h3><?php echo esc_attr($section['title']); ?></h3>
                                    <p><?php echo ($survey_allow_html_in_section_description) ? strip_tags(htmlspecialchars_decode($section['description'] )) : nl2br( $section['description'] ) ?></p>
                                </div>
                                <?php endif; ?>
                                <?php
                                foreach ( $section['questions'] as $q_key => $question ) {
                                    ?>
                                    <div class="ays_questions_answers" data-id="<?php echo esc_attr($question['id']); ?>" data-type="<?php echo esc_attr($question['type']); ?>" style="border-left-color: <?php echo esc_attr($survey_for_charts); ?>;">
                                    <?php if(!$survey_show_questions_as_html): ?>
                                        <div class="ays-survey-individual-question-title"><?php echo Survey_Maker_Data::ays_autoembed( nl2br( htmlentities($question['question']) ) ); ?></div>
                                    <?php else: 
                                        $question_title_text = (strpos($question['question'], '<script>') !== false ) ? Survey_Maker_Data::ays_autoembed(preg_replace('#<script(.*?)>(.*?)</script>#is', '$2', $question['question'])) : Survey_Maker_Data::ays_autoembed( $question['question'] );                                        
                                    ?>
                                        <div class="ays-survey-individual-question-title"><?php echo $question_title_text; ?></div>
                                    <?php endif?>                                    
                                    <?php
                                    $question_type_content = '';
                                    $user_answer = isset( $ays_survey_individual_questions['questions'][ $question['id'] ] ) ? $ays_survey_individual_questions['questions'][ $question['id'] ] : '';
                                    $other_answer = '';
                                    if( isset( $user_answer['otherAnswer'] ) ){
                                        $other_answer = $user_answer['otherAnswer'] ;
                                    }
                                    if( isset( $user_answer['answer'] ) ){
                                        $user_answer = $user_answer['answer'];
                                    }
                                    $question_type_content = '';
                                    if( $question['type'] == 'select' ){
                                        $question_type_content .= '<div class="ays_each_question_answer">
                                            <select class="ays-survey-submission-select" disabled>
                                                <option value="">' . __( "Choose", "survey-maker" ) . '</option>';
                                    }

                                    if( in_array( $question['type'], $text_types ) ){
                                        $question_type_content .= '<div class="ays_each_question_answer">
                                            <p class="ays_text_answer">' . $user_answer . '</p>
                                        </div>';
                                    }

                                    foreach ($question['answers'] as $key => $answer) {
                                        $checked = '';
                                        $selected = '';
                                        $disabled = 'disabled';
                                        $color = '#777';                                       

                                        $answer_content = $allow_html_in_answers ? $answer['answer'] : htmlentities( $answer['answer'] );
                                        $answer_content = ($allow_html_in_answers && strpos($answer_content,'<script>') !== false) ? strip_tags($answer_content) : ( $answer_content );

                                        switch( $question['type'] ){
                                            case 'radio':
                                            case 'yesorno':
                                                if( intval( $user_answer ) == intval( $answer['id'] ) ){
                                                    $checked = 'checked';
                                                }
                                                $question_type_content .= '<div class="ays_each_question_answer">
                                                    <label style="color:' . $color . '">
                                                        <input type="radio" ' . $checked . ' ' . $disabled . ' data-id="' . $answer['id'] . '"/>
                                                        <div class="ays-survey-answer-label-content">
                                                            <div class="ays-survey-answer-icon-content">
                                                                <div class="ays-survey-answer-icon-ink"></div>
                                                                <div class="ays-survey-answer-icon-content-1">
                                                                    <div class="ays-survey-answer-icon-content-2" style="border-color:'.$survey_for_charts.';">
                                                                        <div class="ays-survey-answer-icon-content-3" style="border-color:'.$survey_for_charts.';"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span style="font-size: 17px;">' . ($answer_content) . '</span>
                                                        </div>
                                                    </label>
                                                </div>';
                                                break;
                                            case 'checkbox':
                                                if( !empty( $user_answer ) && is_array($user_answer) && in_array( $answer['id'], $user_answer ) ){
                                                    $checked = 'checked';
                                                }
                                                $question_type_content .= '<div class="ays_each_question_answer">
                                                    <label style="color:' . $color . '">
                                                        <input type="checkbox" ' . $checked . ' ' . $disabled . ' data-id="' . $answer['id'] . '"/>
                                                        <div class="ays-survey-answer-label-content">
                                                            <div class="ays-survey-answer-icon-content">
                                                                <div class="ays-survey-answer-icon-ink"></div>
                                                                <div class="ays-survey-answer-icon-content-1">
                                                                    <div class="ays-survey-answer-icon-content-2" style="border-color:'.$survey_for_charts.';">
                                                                        <div class="ays-survey-answer-icon-content-3" style="border-color:'.$survey_for_charts.';"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span style="font-size: 17px;">' . $answer_content . '</span>
                                                        </div>
                                                    </label>
                                                </div>';
                                                break;
                                            case 'select':
                                                if( intval( $user_answer ) == intval( $answer['id'] ) ){
                                                    $selected = 'selected';
                                                }
                                                $question_type_content .= '<option value=' . $answer['id'] . ' ' . $selected . '>' . $answer_content . '</option>';
                                            break;
                                        }
                                    }
                                    
                                    if( ( $question['type'] == 'radio' || $question['type'] == 'checkbox' || $question['type'] == 'yesorno' ) && $question['user_variant'] == 'on' ){
                                        $checked = '';
                                        if( $question['type'] == 'radio' && intval( $user_answer ) == 0 && $other_answer != ""){
                                            $checked = 'checked';
                                        }
                                        if( $question['type'] == 'checkbox' && !empty( $user_answer ) && in_array( '0', $user_answer ) ){
                                            $checked = 'checked';
                                        }

                                        if( $question['type'] == 'yesorno' && intval( $user_answer ) == 0 && $other_answer != ""){
                                            $checked = 'checked';
                                        }

                                        $input_type = $question['type'];
                                        if( $question['type'] == 'yesorno' ){
                                            $input_type = 'radio';
                                        }

                                        $question_type_content .= '<div class="ays_each_question_answer ays-survey-answer-label-other">
                                            <label style="color:' . $color . '">
                                                <input type="'. $input_type .'" ' . $checked . ' ' . $disabled . ' data-id="0"/>
                                                <div class="ays-survey-answer-label-content">
                                                    <div class="ays-survey-answer-icon-content">
                                                        <div class="ays-survey-answer-icon-ink"></div>
                                                        <div class="ays-survey-answer-icon-content-1">
                                                            <div class="ays-survey-answer-icon-content-2" style="border-color:'.$survey_for_charts.';">
                                                                <div class="ays-survey-answer-icon-content-3" style="border-color:'.$survey_for_charts.';"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span style="font-size: 17px;">' . __( 'Other', "survey-maker" ) . ':</span>
                                                </div>
                                            </label>
                                            <div class="ays-survey-answer-other-text">
                                                <span style="display: inline-block;" class="ays-survey-answer-other-input ays-survey-question-input ays-survey-input" tabindex="0">' . ($other_answer) . '</span>
                                                <div class="ays-survey-input-underline" style="margin:0;"></div>
                                                <div class="ays-survey-input-underline-animation" style="margin:0;background-color: '.$survey_for_charts.';"></div>
                                            </div>
                                        </div>';
                                    }

                                    if( $question['type'] == 'select' && $key == count( $question['answers'] ) - 1 ){
                                        $question_type_content .= '</select></div>';
                                    }
                                    echo $question_type_content;
                                    ?>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            }
                            endif;
                        ?>
                        </div>
                    </div>
                    <div class="ays_survey_preloader" style="display:none;">
                        <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL) ; ?>/images/loaders/tail-spin-result.svg" alt="" width="100">
                    </div>
                </div>
                <?php
                if(intval($submission_count_and_ids['submission_count']) > 0):
                ?>
                <div class="ays_survey_response_count">
                    <div class="form-group row">
                        <div class="col-sm-6" style="font-size: 13px;"><?php echo __('Responses cannot be edited',"survey-maker"); ?></div>
                        <div class="col-sm-6 ays-survey-question-action-butons" style="align-items: center;">
                            <span style="min-width: 70px;"><?php echo __("Export to", "survey-maker"); ?></span>
                            <a download="" id="downloadFile" hidden href=""></a>
                            <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" type="button" class="button button-primary ays-survey-export-button" style="opacity: 0.5;"><?php echo __("PDF", "survey-maker"); ?></a>
                            <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" type="button" class="button button-primary ays-survey-export-button" style="opacity: 0.5;"><?php echo __("XLSX", "survey-maker"); ?></a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <h1><?php 
                                echo esc_attr($submission_count_and_ids['submission_count']);
                                echo __(" Responses","survey-maker");
                            ?></h1>
                        </div>
                        <div class="col-sm-6 ays-survey-question-action-butons">
                            <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" type="button" class="button button-primary" style="opacity: 0.5;"><?php echo __( 'Print', "survey-maker"); ?></a>
                        </div>
                    </div>
                    <div class="ays_survey_previous_next_conteiner">
                        <div class="ays_survey_previous_next ays_survey_previous" data-name="ays_survey_previous">
                            <div class="appsMaterialWizButtonPapericonbuttonEl" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<?php echo __('Previous response',"survey-maker"); ?>">
                                <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/arrow-left.svg">
                            </div>
                        </div>
                        <div class="ays_submissions_input_box">
                            <div class="" style="position: relative;margin-right: 10px;">
                                <input type="number" class="ays_number_of_result ays-survey-question-input ays-survey-input" value="<?php echo esc_attr($submission_count_and_ids['submission_count']); ?>" min="1" max="<?php echo esc_attr($submission_count_and_ids['submission_count']); ?>" badinput="false" autocomplete="off" data-id="<?php echo esc_attr($survey_id); ?>">
                                <div class="ays-survey-input-underline" style="margin:0;"></div>
                                <div class="ays-survey-input-underline-animation" style="margin:0;"></div>
                            </div>
                            <input type="hidden" class="ays_submissions_id_str" value="<?php echo esc_attr($submission_count_and_ids['submission_ids']); ?>">
                            <span>of <?php echo esc_attr($submission_count_and_ids['submission_count']); ?></span>
                        </div>
                        <div class="ays_survey_previous_next ays_survey_next" data-name="ays_survey_next">
                            <div class="appsMaterialWizButtonPapericonbuttonEl" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<?php echo __('Next response',"survey-maker"); ?>">
                                <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/arrow-right.svg">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>

    <div id="statistics_of_answer" class="ays-survey-tab-content <?php echo ($ays_survey_tab == 'statistics_of_answer') ? 'ays-survey-tab-content-active' : ''; ?>">
        <div class="wrap">
            <div class="ays-survey-submission-summary-question-container ays-survey-submission-summary-header-container" style="padding: 20px;">
                <div class="ays-survey-submission-summary-question-container-title">
                    <h2 style="margin: 0;"><?php echo sprintf( __( 'In total %s submission', "survey-maker" ), intval( esc_attr($submission_count_and_ids['submission_count']) ) ); ?></h2>
                </div>
                <div class="ays-survey-submission-summary-question-container-buttons">
                    <a type="button" class="button button-primary" target="_blank" href="https://ays-pro.com/wordpress/survey-maker" style="opacity:0.5;"><?php echo __( 'Print', "survey-maker"); ?></a>
                </div>
            </div>
            <?php
            if( is_array( $ays_survey_individual_questions['sections'] ) ):
                foreach ($ays_survey_individual_questions['sections'] as $section_key => $section) {
                    ?>
                    <div class="ays-survey-submission-section ays-survey-submission-summary-section">
                        <?php if($section['title'] != "" || $section['description'] != ""):?>
                        <div class="ays_survey_name ays-survey-submission-summary-section-header" style="border-top-color: <?php echo esc_attr($survey_for_charts); ?>;">
                            <h3><?php echo esc_attr($section['title']); ?></h3>
                            <p><?php echo ($survey_allow_html_in_section_description) ? strip_tags(htmlspecialchars_decode($section['description'] )) : nl2br( $section['description'] ) ?></p>
                        </div>
                        <?php else:?>
                        <div class="ays_survey_name ays-survey-submission-summary-section-header" style="border-top-color: <?php echo esc_attr($survey_for_charts); ?>;">
                            <h3><?php echo __( 'Untitled section' , "survey-maker" );; ?></h3>
                        </div>
                        <?php endif; ?>
                        <?php
                        foreach ( $section['questions'] as $q_key => $question ) {
                            ?>
                            <div class="ays-survey-submission-summary-question-container">
                                <div class="ays-survey-submission-summary-question-header">
                                    <div class="ays-survey-submission-summary-question-header-content">
                                        <?php if(!$survey_show_questions_as_html): ?>
                                            <div style="padding: 9px 0 4px 0;"><?php echo Survey_Maker_Data::ays_autoembed( nl2br( htmlentities( $question_results[ $question['id'] ]['question'] ) ) ); ?></div>
                                        <?php else: 
                                            $question_title_text = (strpos($question['question'], '<script>') !== false ) ? Survey_Maker_Data::ays_autoembed(preg_replace('#<script(.*?)>(.*?)</script>#is', '$2', $question['question'])) : Survey_Maker_Data::ays_autoembed( $question['question'] );                                                                                     
                                        ?>                                            
                                        <div style="padding: 9px 0 4px 0;"><?php echo $question_title_text; ?></div>
                                        <?php endif?>
                                        <p style="text-align:center;"><?php echo esc_attr($question_results[ $question['id'] ]['sum_of_answers_count']); echo __(' submissions',"survey-maker"); ?></p>
                                    </div>
                                    <div class="ays-survey-submission-summary-question-container-buttons">
                                        <a href="https://ays-pro.com/wordpress/survey-maker" target="_blank" title="Export to PNG (PRO feature)"  style='outline: none;box-shadow: none;opacity: 0.5;'>
                                            <img src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/icons/download-file.svg" alt="Export to PNG (PRO feature)">
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="ays-survey-submission-summary-question-content">
                                    <?php
                                        if( in_array( $question_results[ $question['id'] ]['question_type'], $text_types ) ):
                                    ?>
                                    <div class="ays-survey-submission-text-answers-div">
                                        <?php
                                            if( isset( $question_results[ $question['id'] ]['answers'] ) && !empty( $question_results[ $question['id'] ]['answers'] ) ):
                                                if( isset( $question_results[ $question['id'] ]['answers'][ $question['id'] ] ) && !empty( $question_results[ $question['id'] ]['answers'][ $question['id'] ] ) ):
                                                    $filtered_text_answers = array_values(array_unique($question_results[ $question['id'] ]['answers'][ $question['id'] ]));
                                                    foreach( $filtered_text_answers as $aid => $answer ):
                                                        $text_answer_count = isset($question_results[ $question['id'] ]['sum_of_same_answers'][$answer]) && $question_results[ $question['id'] ]['sum_of_same_answers'][$answer] != "" ? $question_results[ $question['id'] ]['sum_of_same_answers'][$answer] : "";
                                                        ?>
                                                        <div class="ays-survey-submission-text-answer">
                                                            <div class="ays-survey-submission-text-answer-each"><?php echo stripslashes(nl2br( htmlentities( $answer )) ); ?></div>
                                                            <div><?php echo stripslashes(nl2br( $text_answer_count) ); ?></div>
                                                        </div>
                                                        <?php
                                                    endforeach;
                                                endif;
                                            endif;
                                        ?>
                                    </div>
                                    <?php
                                        else:
                                        ?>
                                        <div id="survey_answer_chart_<?php echo esc_attr($question_results[ $question['id'] ]['question_id']); ?>" style="width: 100%;" class="chart_div"></div>
                                        <?php
                                            if( !empty( $question_results[ $question['id'] ]['otherAnswers'] ) ):
                                        ?>
                                        <h2 class="ays-survey-subtitle"><?php echo __( '"Other" answers', "survey-maker" ); ?></h2>
                                        <div class="ays-survey-submission-text-answers-div">
                                            <?php
                                                if( isset( $question_results[ $question['id'] ]['otherAnswers'] ) && !empty( $question_results[ $question['id'] ]['otherAnswers'] ) ):
                                                    $filtered_other_answers = array_values(array_unique($question_results[ $question['id'] ]['otherAnswers']));
                                                    foreach( $filtered_other_answers as $aid => $answer ):
                                                        $other_answer_count = isset($question_results[ $question['id'] ]['same_other_count'][$answer]) && $question_results[ $question['id'] ]['same_other_count'][$answer] != "" ? $question_results[ $question['id'] ]['same_other_count'][$answer] : "";
                                                        ?>
                                                        <div class="ays-survey-submission-text-answer">
                                                            <div><?php echo stripslashes(nl2br( htmlentities( $answer )) ); ?></div>
                                                            <div><?php echo stripslashes($other_answer_count); ?></div>
                                                        </div>
                                                        
                                                        <?php
                                                    endforeach;
                                                endif;
                                            ?>
                                        </div>
                                        <?php
                                            endif;
                                        endif;
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
            endif;
            ?> 
        </div>
    </div>

    <div id="ays-results-modal" class="ays-modal">
        <div class="ays-modal-content">
            <div class="ays-preloader">
                <img class="loader" src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/loaders/3-1.svg">
            </div>
            <div class="ays-modal-header">
                <span class="ays-close" id="ays-close-results">&times;</span>
                <h2><?php echo __("Detailed report", "survey-maker"); ?></h2>
            </div>
            <div class="ays-modal-body" id="ays-results-body">
            </div>
        </div>
    </div>

    <div class="ays-modal" id="export-answers-filters">
        <div class="ays-modal-content">
            <div class="ays-preloader">
                <img class="loader" src="<?php echo esc_attr(SURVEY_MAKER_ADMIN_URL); ?>/images/loaders/3-1.svg">
            </div>
          <!-- Modal Header -->
            <div class="ays-modal-header">
                <span class="ays-close">&times;</span>
                <h2><?=__('Export Filter', "survey-maker")?></h2>
            </div>

          <!-- Modal body -->
            <div class="ays-modal-body">
                <form method="post" id="ays_export_answers_filter">
                    <div class="filter-col">
                        <label for="user_id-answers-filter"><?=__("Users", "survey-maker")?></label>
                        <button type="button" class="ays_userid_clear button button-small wp-picker-default"><?=__("Clear", "survey-maker")?></button>
                        <select name="user_id-select[]" id="user_id-answers-filter" multiple="multiple"></select>
                        <input type="hidden" name="quiz_id-answers-filter" id="quiz_id-answers-filter" value="<?php echo esc_attr($survey_id); ?>">
                    </div>
                    <div class="filter-block">
                        <div class="filter-block filter-col">
                            <label for="start-date-answers-filter"><?=__("Start Date from", "survey-maker")?></label>
                            <input type="date" name="start-date-filter" id="start-date-answers-filter">
                        </div>
                        <div class="filter-block filter-col">
                            <label for="end-date-answers-filter"><?=__("Start Date to", "survey-maker")?></label>
                            <input type="date" name="end-date-filter" id="end-date-answers-filter">
                        </div>
                    </div>
                </form>
            </div>

          <!-- Modal footer -->
            <div class="ays-modal-footer">
                <div class="export_results_count">
                    <p>Matched <span></span> results</p>
                </div>
                <span><?php echo __('Export to', "survey-maker"); ?></span>
                <button type="button" class="button button-primary export-anwers-action" data-type="xlsx" quiz-id="<?php echo esc_attr($survey_id); ?>"><?=__('XLSX', "survey-maker")?></button>
                <a download="" id="downloadFile" hidden href=""></a>
            </div>

        </div>
    </div>
    
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

