<?php //Template Name:Login
get_header('dashboard');
//google login api
$client = new Google_Client();
$clientid        = get_theme_value('g_client_id');
$setClientSecret = get_theme_value('g_setClientSecretss_id');
$setRedirectUri  = get_theme_value('g_setRedirectUri_id');
//$client->setClientId('597289695234-fn9kpkepnsn50s1pu4qd2cjskv7pdq0c.apps.googleusercontent.com');
//$client->setClientSecret('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');
$client->setClientId($clientid);
$client->setClientSecret($setClientSecret);
$client->setRedirectUri($setRedirectUri);
$client->addScope('email');
$client->addScope('profile');
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    $oauth = new Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get();

   $googleuserEmail      = $userInfo['email'];
   $googleuserFirstName  = $userInfo['given_name'];
   $googleuserLastName   = $userInfo['family_name'];
   $googleuserid         = $userInfo['id'];

    //exit();
} else {
    $authUrl = $client->createAuthUrl();
}
//facebook login
// Set your Facebook App credentials

?>

<main>
    <section class="login-section common-padding">
        <div class="container">
            <div class="form-holder">
                <div class="title-heading text-center">
                    <?php echo get_post_field("post_content", $post->ID); ?>
                </div>
                <div class="form-wraper">
                    <form id="loginform">
                        <div class="form-row">
                            <input type="email" placeholder="Email*" id="email" class="form-control" required>
                        </div>
                        <div class="form-row">
                            <input type="password" placeholder="Password*" id="password" class="form-control" required>
                            <a href="<?php echo get_theme_value('fgt_btn_link'); ?>" draggable="false" class="forgot-pass">Forgot?</a>
                            <span id="togglePasswordlogin" class="fa fa-eye" aria-hidden="true"></span>
                        </div>
                        <div class="button-row text-center">
                            <input type="submit" value="Sign in" class="btn">
                            <div class="create-accout-wrap mt-3">
                            <a href="<?php echo get_theme_value('new_acnt_btn_link'); ?>" class="p-0">Don't have an account ? Create
                                Account</a>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong id="errormessage"></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="singe-social-wrap text-center">
                    <p>Sign In with Social</p>
                    <ul class="d-flex justify-content-center">
                        <li>
                            <a href=""><img
                                    src="<?php echo get_template_directory_uri() ?>/assets/auth/images/icon-facebook.svg"
                                    alt=""></a>
                            <span>Facebook</span>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="googleLogin('<?php echo $authUrl;?>')"><img
                                    src="<?php echo get_template_directory_uri() ?>/assets/auth/images/icon-gmail.svg"
                                    alt=""></a>
                                    <span>Gmail</span>


                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    jQuery(".alert").hide();
    jQuery(".close").click(function () {
        jQuery(".alert").hide();
    });
    jQuery("#loginform").submit(function () {
        event.preventDefault();

        var email = jQuery('#email').val();
        var password = jQuery('#password').val();
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php') ?>',
            //dataType: "json",

            data: {
                action: 'signIn_form',
                email: email,
                password: password,

            },
            success: function (result) {
                if (result === "agent" || result === "buyer") {
                    if (result === "agent") {
                        var agentDasbordUrl = '<?php echo get_the_permalink(562); ?>';
                        window.location.href = agentDasbordUrl;
                        return false;

                    } else {
                        var agentDasbordUrl = '<?php echo get_the_permalink(745); ?>';
                        window.location.href = agentDasbordUrl;
                        return false;
                    }

                } else {
                    alert(result);

                }


            }
        });
    });
    //google Login
    function googleLogin(loginurl){
     //  var role =  confirm('are you Agent ?')
    //    if(role){
    //     role = "agent";
    //    }else{
    //     role = "buyer";
    //    }
       window.location.href = loginurl;
        //alert(loginurl);
    }
  // get token from google
  document.addEventListener('DOMContentLoaded', function () {
      // Get the URL parameters
      var urlParams = new URLSearchParams(window.location.search);

      // Check if the "code" parameter is present in the URL
      if (urlParams.has('code')) {
        var role =  confirm('are you Agent ?')
       if(role){
        role = "agent";
       }else{
        role = "buyer";
       }
        var email      = '<?php echo $googleuserEmail; ?>';
        var firstname  = '<?php echo $googleuserFirstName; ?>';
        var lastName   = '<?php echo $googleuserLastName; ?>';
        var id         = '<?php echo $googleuserid; ?>';
        //console.log(role);
       // console.log(email);
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php') ?>',
            //dataType: "json",

            data: {
                action: 'signIn_form_social',
                email: email,
                firstname: firstname,
                lastName: lastName,
                id: id,
                role: role,

            },
              success: function (result) {
                if (result === "agent" || result === "buyer") {
                    if (result === "agent") {
                        var agentDasbordUrl = '<?php echo get_the_permalink(562); ?>';
                        window.location.href = agentDasbordUrl;
                        return false;

                    } else {
                        var agentDasbordUrl = '<?php echo get_the_permalink(745); ?>';
                        window.location.href = agentDasbordUrl;
                        return false;
                    }

                } else {
                    alert(result);

                }


            }
        });

      } else {
        console.log('Code parameter not found in the URL.');
      }
    } );
    jQuery('#togglePasswordlogin').click(function() {
        var passwordField = jQuery('#password');
        var fieldType = passwordField.attr('type');
        
        // Toggle between password and text
        if (fieldType === 'password') {
            passwordField.attr('type', 'text');
            jQuery(this).removeClass('fa-eye').addClass('fa-eye-slash'); // Change eye icon to slashed eye
        } else {
            passwordField.attr('type', 'password');
            jQuery(this).removeClass('fa-eye-slash').addClass('fa-eye'); // Change slashed eye icon to eye
        }
    });
        
</script>
<?php get_footer(); ?>