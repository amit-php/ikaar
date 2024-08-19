<?php
add_action('init', 'weaversweb_ftn_options');
if (!function_exists('weaversweb_ftn_options')) {
	function weaversweb_ftn_options()
	{
		// If using image radio buttons,define a directory path
		$imagepath = get_stylesheet_directory_uri() . '/images/';
		$options = array(
			/* ---------------------------------------------------------------------------- */
			/* Header Setting */
			/* ---------------------------------------------------------------------------- */
			array(
				"name" => "Header Section",
				"type" => "heading"
			),

			array(
				"name" => "Fav Icon",
				"id" => "driverite_fav_icon",
				"std" => "",
				"type" => "upload"
			),
			array(
				"name" => "Header Logo",
				"id" => "driverite_header_logo",
				"std" => "",
				"type" => "upload"
			),
			// array(
			// 	"name" => "Header Right User Image",
			// 	"id" => "driverite_header_right_user_img",
			// 	"std" => "",
			// 	"type" => "upload"
			// ),
			// array(
			// 	"name" => "Header Right User Link",
			// 	"desc" => "Enter user link",
			// 	"id" => "driverite_header_right_user_img_link",
			// 	"std" => "",
			// 	"type" => "text"
			// ),

			array(
				"name" => "Login heading",
				"id" => "login_title",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "Currency",
				"id" => "login_title_currency",
				"std" => "",
				"type" => "text"
			),

			// array(
			// 	"name" => "Login Logo",
			// 	"id" => "driverite_login_logo",
			// 	"std" => "",
			// 	"type" => "upload"
			// ),
			array(
				"name" => "Without Login Logo",
				"id" => "without_login_logo",
				"std" => "",
				"type" => "upload"
			),
			array(
				"name" => "Login Url",
				"id" => "login_url",
				"std" => "",
				"type" => "text"
			),
			/* ---------------------------------------------------------------------------- */

			/* Footer Setting */
			/* ---------------------------------------------------------------------------- */
			array(
				"name" => "Footer Section",
				"type" => "heading"
			),

			array(
				"name" => "Footer Logo",
				"id" => "bc_footer_logo",
				"std" => "",
				"type" => "upload"
			),
			array(
				"name" => "Footer Background Logo",
				"id" => "bc_footerBg_logo",
				"std" => "",
				"type" => "upload"
			),

			array(
				"name" => "Footer Explore Title",
				"desc" => "Enter Footer Explore Title",
				"id" => "bc_footer_explore_title",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Footer Company Title",
				"desc" => "Enter Footer Company Title",
				"id" => "bc_footer_company_title",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Footer Resource Title",
				"desc" => "Enter Footer Resource Title",
				"id" => "bc_footer_resource_title",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Footer Newsletter Title",
				"desc" => "Enter Footer Newsletter Title",
				"id" => "bc_footer_newsletter_title",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Footer Social Media Title",
				"desc" => "Enter Footer Social Media Title",
				"id" => "bc_footer_socialmedia_title",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Copyright Text",
				"desc" => "Enter Copyright Text",
				"id" => "driverite_copyright_text",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Allrights Text",
				"desc" => "Enter allright Text",
				"id" => "driverite_allright_text",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "Gmail Link",
				"desc" => "Enter Gmail",
				"id" => "driverite_gmail_link",
				"std" => "",
				"type" => "text"
			),


			/* ---------------------------------------------------------------------------- */

			/* Icon Link */
			/*------------------------------------------------*/
			array(
				"name" => "Facebook Link",
				"desc" => "Enter Facebook Link",
				"id" => "driverite_facebook_link",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Instagram Link",
				"desc" => "Enter Instagram Link",
				"id" => "driverite_instagram_link",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Twitter Link",
				"desc" => "Enter Twitter Link",
				"id" => "driverite_twitter_link",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Linkdin Link",
				"desc" => "Enter Linkdin Link",
				"id" => "driverite_linkdin_link",
				"std" => "",
				"type" => "text"
			),

			/* Social Link End */

			/* Common Section start */
			array(
				"name" => "Video Section",
				"type" => "heading"
			),

			array(
				"name" => "Common Section Video",
				"desc" => "Choose Video",
				"id" => "common_section_video",
				"std" => "",
				"type" => "upload"
			),
			array(
				"name" => "Video Title",
				"desc" => "Enter Video Title",
				"id" => "video_title",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "Video Sub Title",
				"desc" => "Enter Video Sub Title",
				"id" => "video_sub_title",
				"std" => "",
				"type" => "text"
			),



			/* Common Section End */
			array(
				"name" => "Property Section",
				"type" => "heading"
			),
			array(
				"name" => "Currency",
				"id" => "pro_currency",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => " SqFt. image icon",
				"id" => "pro_squ_imag_icon",
				"std" => "",
				"type" => "upload"
			),
			array(
				"name" => "Bedrooms image icon",
				"id" => "pro_bedrooms_image_icon",
				"std" => "",
				"type" => "upload"
			),
			array(
				"name" => "Bathroom image icon",
				"id" => "pro_bathrooms_image_icon",
				"std" => "",
				"type" => "upload"
			),
			array(
				"name" => "Terrace img icon",
				"id" => "pro_terrace_image_icon",
				"std" => "",
				"type" => "upload"
			),

			/* Latest Property start */
			array(
				"name" => "Latest Property",
				"type" => "heading"
			),
			array(
				"name" => "Load More button",
				"id" => "load_more_button",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Enquiry form Title",
				"desc" => "Enter Enquiry form Title",
				"id" => "form_title_we_are",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Download Modal Title",
				"desc" => "Enter Download Modal Title",
				"id" => "modal_title",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Download Modal Subtitle",
				"desc" => "Enter Download Modal Subtitle",
				"id" => "modal_sub_title",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Download Modal Buttontitle",
				"desc" => "Enter Download Modal Buttontitle",
				"id" => "modal_but_title",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Share Modal Title",
				"desc" => "Enter Share Modal Title",
				"id" => "modal_share_title",
				"std" => "",
				"type" => "text"
			),

			/* Latest Property End */


			/* Service Section start */
			array(
				"name" => "Service Section",
				"type" => "heading"
			),

			array(
				"name" => "Enter Service Listing Title",
				"desc" => "Enter Service Listing Title",
				"id" => "lat_prop_title",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "Enter Service Listing Subtitle",
				"desc" => "Enter Service Listing Subtitle",
				"id" => "lat_prop_sub_title",
				"std" => "",
				"type" => "text"
			),
			/* Service Section end */



			/* Amin section start*/
			array(
				"name" => "Admin email",
				"type" => "heading"
			),

			array(
				"name" => "Admin mail Id",
				"desc" => "Enter yor email",
				"id" => "admin_mail_id",
				"std" => "",
				"type" => "text"
			),
			/* Amin section end*/



			/* Buyer section start*/
			array(
				"name" => "Buyer section",
				"type" => "heading"
			),

			array(
				"name" => "Buyer dashboard link",
				"desc" => "Enter buyer dashboard link",
				"id" => "buyer_dashboard_link",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "Edit Profile Button",
				"desc" => "Enter Edit profile button title",
				"id" => "edit_btn_buyer",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Edit Profile Button Url",
				"desc" => "Enter Edit profile page url",
				"id" => "edit_url_buyer",
				"std" => "",
				"type" => "text"
			),


			/* Buyer section end*/



			/* Agent section start*/
			array(
				"name" => "Agent section",
				"type" => "heading"
			),

			array(
				"name" => "Agent dashboard link",
				"desc" => "Enter agent dashboard link",
				"id" => "agent_dashboard_link",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Edit Profile Button",
				"desc" => "Enter edit profile button title",
				"id" => "edit_btn_agent",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Edit Profile Button Url",
				"desc" => "Enter edit profile page url",
				"id" => "edit_url_agent",
				"std" => "",
				"type" => "text"
			),

			/* Agent section end*/


			/* Buyer and Agent Section start */

			array(
				"name" => "Buyer and Agent Section",
				"type" => "heading"
			),
			array(
				"name" => "Dashboard Title For Mobile Menu",
				"desc" => "Enter Title",
				"id" => "mobile_menu",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Welcome Text",
				"desc" => "Enter Text",
				"id" => "welcome_text",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Forget Password URL",
				"desc" => "Enter Forget Password Page Url",
				"id" => "fgt_btn_link",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Create New Account Url",
				"desc" => "Enter SignUp Page Url",
				"id" => "new_acnt_btn_link",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "Login Url",
				"desc" => "Enter login Page Url",
				"id" => "login_btn_link",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "Terms & condition URL",
				"desc" => "EnterTerms & condition Page Url",
				"id" => "term_conditn_link",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "Privacy Policy URL",
				"desc" => "Enter Privacy Policy Page Url",
				"id" => "privacy_policy_link",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "User Default Profile Picture",
				"desc" => "Choose profile Image",
				"id" => "user_default_images",
				"std" => "",
				"type" => "upload"
			),
			/* Buyer and Agent Section End */


			/* Button section start*/
			array(
				"name" => "Button section",
				"type" => "heading"
			),

			array(
				"name" => "view more button Text",
				"desc" => "Enter Button Text",
				"id" => "view_more_btn_txt",
				"std" => "",
				"type" => "text"
			),

			array(
				"name" => "view more button Url",
				"desc" => "Enter Button Url",
				"id" => "view_more_btn_link",
				"std" => "",
				"type" => "text"
			),
			/* Button section end*/

			/* Pdf section start*/
			array(
				"name" => "Brochure section",
				"type" => "heading"
			),
			array(
				"name" => "Property Information title",
				"desc" => "Enter title Text",
				"id" => "_brou_title_property_info",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "Title",
				"desc" => "Enter title Text",
				"id" => "_brou_title",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "Brand logo",
				"desc" => "Choose brand Image",
				"id" => "brand_default_images",
				"std" => "",
				"type" => "upload"
			),
			array(
				"name" => "Border image branded",
				"desc" => "Choose  Image",
				"id" => "border_default_images",
				"std" => "",
				"type" => "upload"
			),
			array(
				"name" => "Border image unbranded ",
				"desc" => "Choose  Image",
				"id" => "border_default_images_unbranded",
				"std" => "",
				"type" => "upload"
			),
			array(
				"name" => "Email",
				"desc" => "Enter email Text",
				"id" => "_brou_email",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "website url",
				"desc" => "Enter url Text",
				"id" => "web_urls",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "Phone",
				"desc" => "Enter contact number",
				"id" => "_brouc_con",
				"std" => "",
				"type" => "text"
			),

			/* Google login*/
			array(
				"name" => "Google login",
				"type" => "heading"
			),

			array(
				"name" => "ClientId",
				"desc" => "Enter setClientId Text",
				"id" => "g_client_id",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "ClientSecret",
				"desc" => "Enter setClientSecret Text",
				"id" => "g_setClientSecretss_id",
				"std" => "",
				"type" => "text"
			),
			array(
				"name" => "setRedirectUri",
				"desc" => "Enter setRedirect Url",
				"id" => "g_setRedirectUri_id",
				"std" => "",
				"type" => "text"
			),
			/* google end*/
		);
		weaversweb_ftn_update_option('of_template', $options);
	}
}
