<?php
//Template Name:Changepass Agent
get_header('dashboard');
$current_user = wp_get_current_user();
$user_pass = $current_user->user_pass;
$user_id = $current_user->ID;
?>

<!-- body section start -->
<main>
    <div class="dashbord-section common-padding">
        <div class="container">
            <div class="dashbord-inner-row align-items-start d-flex">
            <?php get_template_part('/agent-dasbord/dashboard_menu_agent');?>
                <div class="dashboard-info">
                    <div class="change-pasword-section">
                        <div class="title-heading">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <div class="change-pasword-wraper">
                            <div class="form-wraper">
                                <form action="">
                                    <div class="form-row">
                                        <label for="">Old Password</label>
                                        <input type="Password" id="oldpass" class="form-control"
                                            placeholder="Enter old password" required>
                                            <span id="togglePasswordOLD" class="fa fa-eye" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-row">
                                        <label for="">New Password</label>
                                        <input type="Password" id="newpass" class="form-control"
                                            placeholder="At least 8 digits" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                            required>
                                            <span id="togglePasswordNew" class="fa fa-eye" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-row">
                                        <label for="">Confirm Password</label>
                                        <input type="Password" id="confirmpass" class="form-control"
                                            placeholder="* * * * * *" required>
                                            <span id="togglePasswordConfirm" class="fa fa-eye" aria-hidden="true"></span>
                                    </div>
                                    <div class="button-row">
                                        <input type="submit" value="Save" class="btn d-block">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<!-- body section end -->
<?php get_footer(); ?>
<script>
    jQuery("form").submit(function () {
        event.preventDefault();
        var oldpass = jQuery('#oldpass').val();
        var newpass = jQuery('#newpass').val();
        var confirmpass = jQuery('#confirmpass').val();
        var userpass = "<?php echo $user_pass; ?>";
        if (newpass === confirmpass) {
            jQuery.ajax({
                type: "POST",
                url: '<?php echo admin_url('admin-ajax.php') ?>',
                data: {
                    action: 'change_pass',
                    oldpass: oldpass,
                    confirmpass: confirmpass
                },
                success: function (data) {
                    if (data == 200) {
                        alert('Password change successfully');
                        window.location.href = '<?php echo get_the_permalink(544); ?>';
                        return false;
                    }
                    else {
                        alert(data);
                        return false;
                    }
                }
            })
        } else {
            alert("confirm password is not matched!");
            return false;
        }
    });

    jQuery('#togglePasswordOLD').click(function() {
        var passwordField = jQuery('#oldpass');
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
    jQuery('#togglePasswordNew').click(function() {
        var passwordField = jQuery('#newpass');
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
    jQuery('#togglePasswordConfirm').click(function() {
        var passwordField = jQuery('#confirmpass');
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