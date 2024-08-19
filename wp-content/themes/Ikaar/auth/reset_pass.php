<?php //Template Name:Resetpass
get_header('dashboard');
$user_id = base64_decode($_GET['id']);
$otp = get_user_meta($user_id, "forgot_otp", true); ?>

<main>
    <section class="login-section common-padding">
        <div class="container">
            <div class="form-holder">
                <div class="title-heading text-center">
                    <h1>
                        <?php echo get_post_field('post_content', $post->ID); ?>
                    </h1>
                </div>
                <div class="form-wraper">
                    <form method="post" action="">
                        <div class="form-row">
                            <input type="text" placeholder="Enter OTP" class="form-control" id="otpid" required>
                        </div>
                        <div class="form-row">
                            <input type="password" placeholder="Enter new password" class="form-control" id="newpassid"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                required>
                                <span id="togglePassword" class="fa fa-eye" aria-hidden="true"></span>
                        </div>
                        <div class="form-row">
                            <input type="password" placeholder="Reenter password" class="form-control" id="conpasid" required>
                            <span id="togglePasswordconfirm" class="fa fa-eye" aria-hidden="true"></span>
                        </div>
                        <div class="button-row text-center">
                            <input type="submit" value="Save" class="btn">
                        </div>
                    </form>
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
                            <a href=""><img
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

<?php get_footer(); ?>
<script>
    jQuery("form").submit(function () {
        event.preventDefault();
        var enterotp = jQuery('#otpid').val();
        var password = jQuery('#newpassid').val();
        var confirm = jQuery('#conpasid').val();
        var mailotp = "<?php echo $otp; ?>"
        var uid = "<?php echo $user_id ?>"

        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php') ?>',
            data: {
                action: 'reset_pass',
                enterotp: enterotp,
                password: password,
                confirm: confirm,
                mailotp: mailotp,
                uid: uid,

            },
            success: function (data) {
                if (data == 1) {
                    alert('Password changed successfully');
                    window.location.href = '<?php echo get_the_permalink(544); ?>';
                }
                else {
                    alert(data);
                }
            }
        });
    });
    jQuery('#togglePassword').click(function() {
        var passwordField = jQuery('#newpassid');
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
    jQuery('#togglePasswordconfirm').click(function() {
        var passwordField = jQuery('#conpasid');
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