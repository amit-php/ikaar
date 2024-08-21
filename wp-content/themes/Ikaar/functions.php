<?php
//for google login
$googliauthpath = get_template_directory() . '/google-api-php-client/vendor/';
require_once($googliauthpath . 'autoload.php');
//for facebook login
//for google login
//$facebookauthpath = get_template_directory() . '/php-graph-sdk/src/Facebook/';
//require_once($facebookauthpath . 'autoload.php');

/*****************************************
 * Weaver's Web Functions & Definitions *
 *****************************************/
foreach (glob(get_template_directory() . '/functions/*.php') as $files) {
	include_once $files;
}
/*--------------------------------------*/
/* Post Type Helper Functions
/*--------------------------------------*/
foreach (glob(get_template_directory() . '/inc/post-types/*.php') as $file) {
	include_once $file;
}

//for fetching api
foreach (glob(get_template_directory() . '/resales-web-api/*.php') as $file) {
	include_once $file;
}


function weaversweb_ftn_wp_enqueue_scripts()
{
	if (!is_admin()) {
		wp_enqueue_script('jquery');
		if (is_singular() and get_site_option('thread_comments')) {
			wp_print_scripts('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'weaversweb_ftn_wp_enqueue_scripts');
function weaversweb_ftn_get_option($name)
{
	$options = get_option('weaversweb_ftn_options');
	if (isset($options[$name]))
		return $options[$name];
}
function weaversweb_ftn_update_option($name, $value)
{
	$options = get_option('weaversweb_ftn_options');
	$options[$name] = $value;
	return update_option('weaversweb_ftn_options', $options);
}
function weaversweb_ftn_delete_option($name)
{
	$options = get_option('weaversweb_ftn_options');
	unset($options[$name]);
	return update_option('weaversweb_ftn_options', $options);
}
function get_theme_value($field)
{
	$field1 = weaversweb_ftn_get_option($field);
	if (!empty($field1)) {
		$field_val = $field1;
	}
	return $field_val;
}


/*--------------------------------------*/
/* Theme Helper Functions
/*--------------------------------------*/
if (!function_exists('weaversweb_theme_setup')):
	function weaversweb_theme_setup()
	{
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		// add_theme_support('excerpts');
		register_nav_menus(
			array(
				'primary_left' => __('Primary Menu Left', 'weaversweb'),
				'primary_right' => __('Primary Menu Right', 'weaversweb'),
				'secondary_explore' => __('Secondary Menu Explore', 'weaversweb'),
				'secondary_company' => __('Secondary Menu Company', 'weaversweb'),
				'secondary_resource' => __('Secondary Menu Resource', 'weaversweb'),
				'mobile_menu' => __('Mobile Menu', 'weaversweb'),
			)
		);

		add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
	}
endif;
add_action('after_setup_theme', 'weaversweb_theme_setup');

function weaversweb_scripts()
{
	wp_enqueue_style('bootstrap.min', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array());

	wp_enqueue_style('all.min', get_template_directory_uri() . '/assets/css/all.min.css', array());

	wp_enqueue_style('slick', get_template_directory_uri() . '/assets/css/slick.css', array());

	wp_enqueue_style('slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array());
	wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array());
	wp_enqueue_style('owl.theme', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css', array());

	wp_enqueue_style('custom.css', get_template_directory_uri() . '/assets/css/custom.css', array());
	//wp_enqueue_style('custom-css-auth', get_template_directory_uri() . '/assets/auth/css/custom.css', array());
	// Load the Internet Explorer specific script.

	global $wp_scripts;

	wp_enqueue_script('bootstrap.bundle.min', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), true);
	wp_enqueue_script('slick.min', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), true);
	wp_enqueue_script('owl', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), true);
	wp_enqueue_script('custom.js', get_template_directory_uri() . '/assets/js/custom.js', array(), 1, 1, 1);
	//wp_enqueue_script('custom-js-auth', get_template_directory_uri() . '/assets/auth/js/custom.js', array(), 1, 1, 1);
}
add_action('wp_enqueue_scripts', 'weaversweb_scripts');
// Body Class

//For svg support

// Wp v4.7.1 and higher
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
	$filetype = wp_check_filetype($filename, $mimes);
	return [
		'ext' => $filetype['ext'],
		'type' => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4);

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
}
add_action('admin_head', 'fix_svg');


//ajax for loadmore
function load_more_posts()
{


	$args = [
		'post_type' => 'post',
		'posts_per_page' => 4,
		'paged' => $_POST['paged'],
		'post_status' => 'publish',
	];

	$my_post = new WP_Query($args);
	$nex_pages = $my_post->max_num_pages;

	if ($my_post->have_posts()) {
		ob_start();
		while ($my_post->have_posts()) {
			$my_post->the_post(); ?>
			<div class="col-lg-3 col-md-6 card-item-box ">
				<div class="card-box">
					<a href="<?php the_permalink(); ?>">
						<div class="image-box position-relative">
							<?php echo get_the_post_thumbnail(); ?>
							<div class="card-title">
								<?php $special_points = get_post_meta(get_the_ID(), 'special_points', true);
								if (!empty($special_points)) { ?>
									<h6>
										<?php echo $special_points; ?>
									</h6>
								<?php } ?>
								<p>
									<?php echo get_the_date(); ?>
								</p>
							</div>
						</div>
					</a>
					<div class="card-info">
						<h6><a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a></h6>
						<p>
							<?php the_excerpt(); ?>
						</p>
						<?php $read_more = get_post_meta(get_the_ID(), 'read_more', true) ?>
						<div class="button-row">
							<a href="<?php echo the_permalink(); ?>" class="more-btn">
								<?php echo $read_more; ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php }
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
	}
	$result = [
		'max' => $nex_pages,
		'html' => $output,
	];

	echo json_encode($result);
	wp_die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');



//ajax Load more for Property Listing
function load_more_postsProperty() {
	$page        = $_POST['paged'];
	$queryid     = $_POST['queryid'];
	$postperpage = $_POST['postperpage'];

	$dynamic_params = [
		'p_agency_filterid' => 1,
		'P_PageSize'=>$postperpage,
		'P_PageNo'=>$page, 
		'P_QueryId'=>$queryid,
		'P_sandbox' => true
	];
	$data = fetch_data_from_resales_api($dynamic_params);
	if ($data["status"] === "success") {
		// Process and display the data
		foreach ($data["result"] as $key => $value) {
	?>
	<div class="col-lg-4 col-md-6 category-item-box">
		<div class="category-box position-relative">
			<a href="<?php echo esc_url(get_the_permalink(1417)).'?refid='.$value['Reference']; ?>">
				<div class="image-box position-relative">
					<?php
					if ($value['Pictures']['Picture'][0]) {
						echo "<img src='".$value['Pictures']['Picture'][0]['PictureURL']."' />";
					} ?>
					<div class="category-title">
						<h6>
							<?php echo $value['PropertyType']['NameType']; ?>
						</h6>
					</div>
				</div>
			</a>
			<div class="category-list-row d-flex align-items-center justify-content-between">
				<div class="provide-item-row">
					<ul class="d-flex align-items-center">
						<?php
						$bedrooms_image = get_theme_value('pro_bedrooms_image_icon');
						$bwdrooms_qtt = $value['Bedrooms'];
						$bathroom_image = get_theme_value('pro_bathrooms_image_icon');
						$bathrooms_qtt = $value['Bathrooms'];
						$sq_ft_image = get_theme_value('pro_squ_imag_icon');
						$property_area_sq = $value['Built'].'m²';
						$terrace_img = get_theme_value('pro_terrace_image_icon');
						$temperature = 0;
						$property_price = $value['OriginalPrice'];
						if (!empty($bwdrooms_qtt)) { ?>
							<li><span><img src="<?php echo $bedrooms_image; ?>" alt=""></span>
								<?php echo $bwdrooms_qtt; ?>
							</li>
						<?php }
						if (!empty($bathrooms_qtt)) { ?>
							<li><span><img src="<?php echo $bathroom_image; ?>" alt=""></span>
								<?php echo $bathrooms_qtt; ?>
							</li>
						<?php }
						if (!empty($property_area_sq)) { ?>
							<li><span><img src="<?php echo $sq_ft_image; ?>" alt=""></span>
								<?php echo $property_area_sq; ?>
							</li>
						<?php }
						if (!empty($temperature)) { ?>
							<li><span><img src="<?php echo $terrace_img; ?>" alt=""></span>
								<?php echo $temperature; ?>
							</li>
						<?php } ?>
					</ul>
				</div>
				<div class="total-price-row">
					<span>
						<?php echo get_theme_value('pro_currency'); ?>
					</span>
					<?php
					if (!empty($property_price)) { ?>
						<span>
							<?php echo $property_price ; ?>
						</span>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<?php
     }
        $output2 = ob_get_contents();
		ob_end_clean();	
    }
$result2 = [
			'queryinfo' => $data['queryinfo'],
			'html' => $output2,
		];
	
		echo json_encode($result2);
		wp_die();
}

add_action('wp_ajax_load_more_postsProperty', 'load_more_postsProperty');
add_action('wp_ajax_nopriv_load_more_postsProperty', 'load_more_postsProperty');




//for signup verification
add_action('wp_ajax_signup_form', 'signup_form');
add_action('wp_ajax_nopriv_signup_form', 'signup_form');
function signup_form()
{

	$selectval = sanitize_text_field($_POST['selectval']);
	$fastname = sanitize_text_field($_POST['fastname']);
	$lastname = sanitize_text_field($_POST['lastname']);
	$email = sanitize_text_field($_POST['email']);
	$number = sanitize_text_field($_POST['number']);
	$nationality = sanitize_text_field($_POST['nationality']);
	$address = sanitize_text_field($_POST['address']);
	$password = sanitize_text_field($_POST['password']);
	$confirm = sanitize_text_field($_POST['confirm']);

	if ($password == $confirm) {
		$user_data = array(
			'user_login' => $email,
			'user_email' => $email,
			'first_name' => $fastname,
			'last_name' => $lastname,
			'user_pass' => $password,
			'role' => $selectval,
			'user_registered' => date('Y-m-d H:i:s'),
			'show_admin_bar_front' => false

		);

		$user_id = wp_insert_user($user_data);
		if (!is_wp_error($user_id)) {
			update_user_meta($user_id, 'is_active', 'no');
			update_user_meta($user_id, 'nationality', $nationality);
			update_user_meta($user_id, 'address', $address);
			update_user_meta($user_id, 'number', $number);
			$value_is_active = get_user_meta($user_id, 'is_active', true);
			$user_obj = get_user_by('id', $user_id);
			$name = $user_obj->first_name;
			//send email
			$otp = rand(100000, 999999);
			update_user_meta($user_id, '_otp', $otp);
			$uid = base64_encode($user_id);
			$url = get_the_permalink(594) . "?id=" . $uid;
			$subject = 'OTP For Email Verification';
			$message = '<h2>Email Verification</h2><h3>Hello! ' . $name . '</h3><p>We received a request to verify your email. If you didnot make this request, you can ignore this email.</p><p>To verify your email, click the button below:</p><p>Your OTP is ' . $otp . ' </p><button><a href="' . $url . '" target="_blank">Verify your email</a></button><p>Thank you for using <strong>IKAAR</strong></p>';
			$headers = array('Content-Type: text/html; charset=UTF-8');
			wp_mail($email, $subject, $message, $headers);

			echo $value_is_active;
			die;
		} else {
			$error_message = $user_id->get_error_message();
			echo $error_message;
			die;
		}


		die();
	} else {
		echo "Password does not match";
		die();
	}
}
// Email varification
add_action('wp_ajax_emailVarification', 'emailVarification');
add_action('wp_ajax_nopriv_emailVarification', 'emailVarification');
function emailVarification()
{
	if ($_POST) {
		$userid = $_POST['uid'];
		$opt = $_POST['otp'];
		$oldOtp = get_user_meta($userid, '_otp', true);
		if ($oldOtp == $opt) {
			update_user_meta($userid, 'is_active', 'yes');
			update_user_meta($userid, '_otp', "");
			$errormessage = "your email is verified now!";
			echo 200;
			die;
		} else {
			echo "your OTP is not matched!";
			die;
		}
	}
}


//forget pass

add_action('wp_ajax_forget_pass', 'forget_pass');
add_action('wp_ajax_nopriv_forget_pass', 'forget_pass');

function forget_pass()
{
	$email = $_POST['email'];
	$user_details = get_user_by('email', $email);
	if ($user_details != false) {
		$user_id = $user_details->ID;
		$name = $user_details->first_name;
		;
		$forget_otp = rand(200000, 888888);
		update_user_meta($user_id, 'forgot_otp', $forget_otp);
		$uid = base64_encode($user_id);
		$url = get_the_permalink(648) . "?id=" . $uid;
		$subject = 'OTP For Forget password';
		$message = '<h2>Reset Password</h2><h3>Hello! ' . $name . '</h3><p>We received a request to reset your password. If you didnot make this request, you can ignore this email.</p><p>To reset password, click the button below:</p><p>Your OTP is ' . $forget_otp . ' </p><button><a href="' . $url . '" target="_blank">Reset Password</a></button><p>Thank you for using <strong>IKAAR</strong></p>';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		wp_mail($email, $subject, $message, $headers);
		echo 1;
		die;
	} else {
		echo "User Not Found";
		die;
	}
}

//reset  pass
add_action('wp_ajax_reset_pass', 'reset_pass');
add_action('wp_ajax_nopriv_reset_pass', 'reset_pass');

function reset_pass()
{
	$enterotp = $_POST['enterotp'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
	$mailotp = $_POST['mailotp'];
	$uid = $_POST['uid'];
	if ($enterotp == $mailotp && $password == $confirm) {
		wp_set_password($password, $uid);
		update_user_meta($uid, 'forgot_otp', '');
		echo 1;
		die();
	} else if ($enterotp == $mailotp && $password != $confirm) {
		echo "Password does not matched";
		die();
	} else if ($enterotp != $mailotp && $password == $confirm) {
		echo "Incorrect OTP";
		die();
	} else {
		echo "Password and OTP both are incorrect";
		die();
	}
}

//set sender name
add_filter('wp_mail_from_name', 'custom_wp_mail_from_name');
function custom_wp_mail_from_name($original_email_from)
{
	// Your desired sender name here
	return 'IKKAR';
}

// change password for login user
add_action('wp_ajax_change_pass', 'change_pass');
add_action('wp_ajax_nopriv_change_pass', 'change_pass');
function change_pass()
{
	$current_user = wp_get_current_user();
	$oldpass = sanitize_text_field($_POST['oldpass']);
	$confirmpass = sanitize_text_field($_POST['confirmpass']);
	$user_pass = $current_user->user_pass;
	$user_id = $current_user->ID;
	$check = wp_check_password($oldpass, $user_pass, $user_id);
	if ($check) {
		wp_set_password($confirmpass, $user_id);
		echo "200";
		die();
	} else {
		echo "Incorrect old password";
		die();
	}
}

// Guide page View More

//

add_action('wp_ajax_edit_profile', 'edit_profile');
add_action('wp_ajax_nopriv_edit_profile', 'edit_profile');

function edit_profile()
{
	$firstname = sanitize_text_field($_POST['firstname']);
	$lastname = sanitize_text_field($_POST['lastname']);
	$phone = sanitize_text_field($_POST['phone']);
	$address = sanitize_text_field($_POST['address']);
	$description = sanitize_text_field($_POST['description']);

	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	if (!empty($firstname)) {

		wp_update_user(
			array(
				'ID' => $user_id,
				'first_name' => $firstname,

			)
		);
	}

	if (!empty($lastname)) {


		wp_update_user(
			array(
				'ID' => $user_id,
				'last_name' => $lastname,
			)
		);
	}

	if (!empty($description)) {

		wp_update_user(
			array(
				'ID' => $user_id,
				'description' => $description,
			)
		);
	}



	if (!empty($phone)) {
		update_user_meta($user_id, 'number', $phone);
	}

	if (!empty($address)) {
		update_user_meta($user_id, 'address', $address);
	}


	echo "200";
	die();
}


// for wishlist
// add_action('wp_ajax_single_property', 'single_property');
// add_action('wp_ajax_nopriv_single_property', 'single_property');
// function single_property()
// {
// 	$current_user = wp_get_current_user();
// 	$user_id = $current_user->ID;
// 	$pid = $_POST['postId'];
// 	//echo $pid;
// 	// $meta_id = update_user_meta($user_id, 'add_user_post', $pid);
// 	// $meta_id = add_user_meta($user_id, 'add_user_post', $pid);
// 	$meta_id = add_user_meta($user_id, 'add_user_post', $pid, true);
// 	echo $meta_id;
// 	die;
// }
add_action('wp_ajax_add_to_wishlist', 'add_to_wishlist');
add_action('wp_ajax_nopriv_add_to_wishlist', 'add_to_wishlist');

function add_to_wishlist()
{

	if ($_POST['propertyId']) {
		$user_id = get_current_user_id();
		$propertyId = $_POST['propertyId'];
		if ($_POST['wishstatus'] === "yes") {
			add_user_meta($user_id, "_iswishlist", $propertyId);
			$week_start_date = date('Y-m-d', strtotime('today'));
			update_number_of_views($user_id, "fav", $week_start_date, $propertyId);
		} else {
			delete_user_meta($user_id, "_iswishlist", $propertyId);
		}
	}


	// $current_user = wp_get_current_user();
	// $user_id = $current_user->ID;

	// $pid = isset($_POST['postId']) ? $_POST['postId'] : 0;


	// $existing_post_ids = get_user_meta($user_id, 'user_post', true);
	// $existing_post_ids = is_array($existing_post_ids) ? $existing_post_ids : array();

	// if (!in_array($pid, $existing_post_ids)) {

	// 	$existing_post_ids[] = $pid;

	// 	update_user_meta($user_id, 'user_post', $existing_post_ids);

	// 	echo "Product added to favourite ";
	// 	die();
	// } else {

	// 	echo "Product already is in favourite";
	// 	die();
	// }
}

//property details page registration form

add_action('wp_ajax_property_signup', 'property_signup');
add_action('wp_ajax_nopriv_property_signup', 'property_signup');

function property_signup()
{
	$fast_name = sanitize_text_field($_POST['fastname']);

	$last_name = sanitize_text_field($_POST['lastname']);

	$mail = sanitize_text_field($_POST['mail']);

	$number = sanitize_text_field($_POST['number']);

	$message = sanitize_text_field($_POST['message']);

	$role = $_POST['role'];

	$current_post_id = $_POST['current_post_id'];
	$current_posproperty_signupt_title = $_POST['current_post_title'];

	$random_no = rand(100000, 999999);

	$pass = ucfirst($fast_name) . "@" . $random_no;

	if (is_user_logged_in()) {

		$user = wp_get_current_user();
		$user_id = $user->ID;
		$query_post = get_posts(
			array(
				'post_type' => 'enquiry',
				'post_status' => 'publish',
				'author' => $user_id,
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						array(
							'key' => 'current_post_id',
							'value' => $current_post_id,
						),
					)
				),

			)
		);
		if (empty($query_post)) {
			$enq_post = array(
				'post_title' => 'New enquiry by ' . $role,
				//'post_content' => $message,
				'post_type' => 'enquiry',
				'post_status' => 'publish',
				'post_author' => $user_id,
				'post_date' => date('Y-m-d H:i:s')
			);
			$post_id = wp_insert_post($enq_post);

			if (!is_wp_error($post_id)) {
				update_post_meta($post_id, '_role', $role);
				update_post_meta($post_id, 'first_name', $fast_name);
				update_post_meta($post_id, 'last_name', $last_name);
				update_post_meta($post_id, 'contact_no', $number);
				update_post_meta($post_id, 'email_id', $mail);
				update_post_meta($post_id, 'user_msg', $message);
				update_post_meta($post_id, 'current_post_id', $current_post_id);
				update_post_meta($post_id, 'current_post_title', $current_post_title);
				$week_start_date = date('Y-m-d', strtotime('today'));
				update_number_of_views($user_id, "enq", $week_start_date, $current_post_id);

				$admin_subject = 'A New Enquiry';
				$admin_content = '<h2>A New Enquiry by ' . $role . '</h2><p>User Name: ' . $fast_name . ' ' . $last_name . '</p><p>Role: ' . $role . '</p><p>Email id: ' . $mail . '</p><p>Contact number: ' . $number . '</p><p>Post name: ' . $current_post_title . '</p><p>Query: ' . $message . '</p>';
				$admin_headers = array('Content-Type: text/html; charset=UTF-8');
				$admin_email = get_theme_value('admin_mail_id');
				;
				wp_mail($admin_email, $admin_subject, $admin_content, $admin_headers);

				$reply_subject = 'Thank you';
				$reply_message = "<p>Hi ".$fast_name.",</p>
				<p>You're very welcome! I'm glad I could be of assistance. If you have any more questions or need help in the future, don't hesitate to reach out.</p><br/><br/>
				<p>Thank you for using IKAAR</p>";
				wp_mail($mail, $reply_subject, $reply_message, $admin_headers);
				echo "Yor enquiry is submitted!We will Reply shortly";
				die();
			}
		} else {
			echo "You have already enquired about this property!We will reply shortly";
			die();
		}
	} else {
		if (!email_exists($mail)) {
			$reg_data = array(
				'user_login' => $mail,
				'user_email' => $mail,
				'first_name' => $fast_name,
				'last_name' => $last_name,
				'user_pass' => $pass,
				'role' => $role,
				'user_registered' => date('Y-m-d H:i:s'),
				'show_admin_bar_front' => false

			);
			$user_id = wp_insert_user($reg_data);
			if (!is_wp_error($user_id)) {
				update_user_meta($user_id, 'is_active', 'no');
				update_user_meta($user_id, 'number', $number);
				update_user_meta($user_id, 'message', $message);
				$otp = rand(100000, 999999);
				update_user_meta($user_id, '_otp', $otp);
				$uid = base64_encode($user_id);
				$url = get_the_permalink(594) . "?id=" . $uid;
				$subject = 'OTP For Email Verification';
				$mail_obdy = '<h2>Email Verification</h2><h3>Hello! ' . $fast_name . '</h3><p>We received a request to verify your email. If you didnot make this request, you can ignore this email.</p><p>User ID: ' . $mail . '</p><p>Password: ' . $pass . '</p><p>To verify your email, click the button below:</p><p>Your OTP is ' . $otp . ' </p><button><a href="' . $url . '" target="_blank">Verify your email</a></button><p>Thank you for using <strong>IKAAR</strong></p>';
				$headers = array('Content-Type: text/html; charset=UTF-8');
				wp_mail($mail, $subject, $mail_obdy, $headers);
				$value_is_active = get_user_meta($user_id, 'is_active', true);
				$enq_post = array(
					'post_title' => 'New enquiry by ' . $role,
					//'post_content' => $message,
					'post_type' => 'enquiry',
					'post_status' => 'publish',
					'post_author' => $user_id,
					'post_date' => date('Y-m-d H:i:s')
				);
				$post_id = wp_insert_post($enq_post);
				if (!is_wp_error($post_id)) {
					update_post_meta($post_id, '_role', $role);
					update_post_meta($post_id, 'first_name', $fast_name);
					update_post_meta($post_id, 'last_name', $last_name);
					update_post_meta($post_id, 'contact_no', $number);
					update_post_meta($post_id, 'email_id', $mail);
					update_post_meta($post_id, 'user_msg', $message);
					update_post_meta($post_id, 'current_post_id', $current_post_id);
					update_post_meta($post_id, 'current_post_title', $current_post_title);
					$week_start_date = date('Y-m-d', strtotime('today'));
					update_number_of_views($user_id, "enq", $week_start_date, $current_post_id);

					$admin_subject = 'A New Enquiry';
					$admin_content = '<h2>A New Enquiry by ' . $role . '</h2><p>User Name: ' . $fast_name . ' ' . $last_name . '</p><p>Role: ' . $role . '</p><p>Email id: ' . $mail . '</p><p>Contact number: ' . $number . '</p><p>Post name: ' . $current_post_title . '</p><p>Query: ' . $message . '</p>';
					$admin_headers = array('Content-Type: text/html; charset=UTF-8');

					$admin_email = get_theme_value('admin_mail_id');
					wp_mail($admin_email, $admin_subject, $admin_content, $admin_headers);
					$reply_subject = 'Thank you';
				$reply_message = "<p>Hi ".$fast_name.",</p>
				<p>You're very welcome! I'm glad I could be of assistance. If you have any more questions or need help in the future, don't hesitate to reach out.</p><br/><br/>
				<p>Thank you for using IKAAR</p>";
				wp_mail($mail, $reply_subject, $reply_message, $admin_headers);
					echo "200";
					die();
				}
			} else {
				$error_message = $user_id->get_error_message();
				echo $error_message;
				die;
			}
		} else {
			echo "Please login to perform this action!";
			die;
		}
	}
}

//Listing page Ajax Filter

add_action('wp_ajax_listing_postfilter', 'listing_postfilter');
add_action('wp_ajax_nopriv_listing_postfilter', 'listing_postfilter');

function listing_postfilter()
{


	$cat = $_POST['cat'];
	$min = (int) $_POST['min'];
	$max = (int) $_POST['max'];
	$loc = $_POST['loc'];


	$area     = $_POST['area'];
	$bhk      = (int) $_POST['bhk'];
	$bedroom  = (int) $_POST['bedroom'];
	$bathroom = $_POST['bathroom'];
	$type     = $_POST['type'];
	$refId     = $_POST['refid'];
	$fetures     = $_POST['fetures'];

	$args = array(
		'post_type' => 'property',
		'post_status' => 'publish',
		'posts_per_page' => -1,
	);
	$all_posts = new WP_Query($args);

	if ($all_posts->have_posts()) {
		$propPrice = [];
		while ($all_posts->have_posts()) {
			$all_posts->the_post();
			$price = get_post_meta(get_the_ID(), 'property_price', true);

			array_push($propPrice, $price);
		}

	}
	$max_price = max($propPrice);
	$min_price = min($propPrice);
	if (empty($min_price)) {
		$min_price = 1;
	}



	$aurgs = array(
		'post_type' => 'property',
		'post_status' => 'publish',
		'meta_query' => array(
				'relation' => 'AND',
			),
		'tax_query' => array(
			'relation' => 'AND',

		)
	);

	if (!empty($cat)) {
		$aurgs['tax_query'][] = array(
			'taxonomy' => 'property_type',
			'field' => 'slug',
			'terms' => $cat,
		);
	}

	if (!empty($loc)) {

		$aurgs['tax_query'][] = array(
			'taxonomy' => 'property_location',
			'field' => 'slug',
			'terms' => $loc,
		);

	}

	if (!empty($fetures)) {

		$aurgs['tax_query'][] = array(
			'taxonomy' => 'amenities',
			'field' => 'slug',
			'terms' => $fetures,
		);

	}

	if (!empty($min) && empty($max)) {
		$aurgs['meta_query'][] = array(
			'key' => 'property_price',
			'value' => array($min, $max_price),
			'type' => 'numeric',
			'compare' => 'between'
		);
	}
	if (!empty($max) && empty($min)) {
		$aurgs['meta_query'][] = array(
			'key' => 'property_price',
			'value' => array($min_price, $max),
			'type' => 'numeric',
			'compare' => 'between'
		);
	}

	if (!empty($max) && !empty($min)) {
		$aurgs['meta_query'][] = array(
			'key' => 'property_price',
			'value' => array($min, $max),
			'type' => 'numeric',
			'compare' => 'between'
		);

	}
	$area     = $_POST['area'];
	$bhk      = (int) $_POST['bhk'];
	$bedroom  = (int) $_POST['bedroom'];
	$bathroom = $_POST['bathroom'];
	$type     = $_POST['type'];

	if (!empty($refId) ) {
		$aurgs['meta_query'][] = array(
			'key' => 'ref_no',
			'value' => $refId,
			'compare' => '='
		);

	}

	if (!empty($area) ) {
		$aurgs['meta_query'][] = array(
			'key' => 'property_area_sq',
			'value' => $area,
			'compare' => '='
		);

	}
	if (!empty($bhk) ) {
		$aurgs['meta_query'][] = array(
			'key' => 'bhk',
			'value' => $bhk,
			'compare' => '='
		);

	}
	if (!empty($bedroom) ) {
		$aurgs['meta_query'][] = array(
			'key' => 'bwdrooms_qtt',
			'value' => $bedroom,
			'compare' => '='
		);

	}
	if (!empty($bathroom) ) {
		$aurgs['meta_query'][] = array(
			'key' => 'bathrooms_qtt',
			'value' => $bathroom,
			'compare' => '='
		);

	}
	if (!empty($type) ) {
		$aurgs['meta_query'][] = array(
			'key' => 'service_type',
			'value' => $type,
			'compare' => '='
		);

	}


	$property = new WP_Query($aurgs);
	//print_r($property);
	if ($property->have_posts()) {
		while ($property->have_posts()) {
			$property->the_post();
			?>
			<div class="col-lg-4 col-md-6 category-item-box">
				<div class="category-box position-relative">
					<a href="<?php echo esc_url(get_permalink()); ?>">
						<div class="image-box position-relative">
							<?php echo get_the_post_thumbnail(); ?>
							<div class="category-title">
								<h6>
									<?php the_title(); ?>
								</h6>
							</div>
						</div>
					</a>
					<div class="category-list-row d-flex align-items-center justify-content-between">
						<div class="provide-item-row">
							<ul class="d-flex align-items-center">
								<li><span><img src="<?php echo get_theme_value('pro_bedrooms_image_icon'); ?>" alt=""></span>
									<?php echo get_field('bwdrooms_qtt'); ?>
								</li>
								<li><span><img src="<?php echo get_theme_value('pro_bathrooms_image_icon'); ?>" alt=""></span>
									<?php echo get_field('bathrooms_qtt'); ?>
								</li>
								<li><span><img src="<?php echo get_theme_value('pro_squ_imag_icon'); ?>" alt=""></span>
									<?php echo get_field('property_area_sq'); ?>
								</li>
								<li><span><img src="<?php echo get_theme_value('pro_terrace_image_icon');?>"
											alt=""></span><?php echo get_field('temperature'); ?></li>
							</ul>
						</div>
						<div class="total-price-row">
							<span>
								<?php echo get_theme_value('pro_currency'); ?>
							</span>
							<?php $formatted_price = number_format(get_field('property_price')); ?>
							<span>
								<?php echo $formatted_price; ?>
							</span>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();

	} else {
		echo "No post found";
	}



	die();
}
add_action('wp_ajax_download_property', 'download_property');
add_action('wp_ajax_nopriv_download_property', 'download_property');

function download_property()
{
	$user_id = get_current_user_id();
	$week_start_date = $_POST['week_start_date'];
	$post_ids = $_POST['post_ids'];
	update_number_of_views($user_id, "download", $week_start_date, $post_ids);
	$meta_key = 'my_broucher_list';
	// Generate a unique meta value (you can adjust this according to your requirements)
	$unique_value = $post_ids;
	
	// Check if the meta key already exists for the user
	$existing_value = get_user_meta($user_id, $meta_key, false);

	if (in_array($unique_value, $existing_value)) {
		$val = "Value exists in the array.";
	} else {
		add_user_meta($user_id, $meta_key, $unique_value);
	}
	
	

}


// pagination function 
function guide_post()
{


	$args = [
		'post_type' => 'area_guide',
		'posts_per_page' => 4,
		'paged' => $_POST['paged'],
		'post_status' => 'publish',
	];

	$my_post = new WP_Query($args);
	$max_pages = $my_post->max_num_pages;

	if ($my_post->have_posts()) {
		ob_start();
		while ($my_post->have_posts()) {
			$my_post->the_post(); ?>

			<div class="col-lg-3 col-md-6">
				<a href="<?php the_permalink(); ?>">
					<div class="property-box position-relative">
						<div class="image-holder position-relative">
							<?php echo get_the_post_thumbnail(); ?>
						</div>
						<div class="info-holder">
							<h3>
								<?php the_title() ?>
							</h3>

							<?php $location_ids = get_post_meta(get_the_ID(), 'select_area', true);
							// print_r($location_ids);
							foreach ($location_ids as $location_id) {
								$term = get_term($location_id);
								if ($term && !is_wp_error($term)) { ?>
									<h4>
										<?php echo $term->name; ?>
									</h4>
								<?php }
							} ?>
						</div>
					</div>
				</a>
			</div>
		<?php }
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
	}
	$result = [
		'max' => $max_pages,
		'html' => $output,
	];

	echo json_encode($result);
	wp_die();
}

add_action('wp_ajax_guide_post', 'guide_post');
add_action('wp_ajax_nopriv_guide_post', 'guide_post');