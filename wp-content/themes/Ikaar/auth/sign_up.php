<?php //Template Name:Signup 
get_header('dashboard');

?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/intlTelInput.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/auth/css/demo.css" />
<main>
    <section class="login-section common-padding">
        <div class="container">
            <div class="form-holder">
                <div class="title-heading text-center">
                    <?php echo get_post_field("post_content", $post->ID); ?>
                </div>
                <!--------- buyer form wraper start ----------->
                <form method="post" action="">
                    <div class="radio-row">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Sign-Up" id="radio1" value="buyer"
                                checked>
                            <label class="form-check-label" for="radio1">
                                Sign up as "Buyer"
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Sign-Up" id="radio2" value="agent">
                            <label class="form-check-label" for="radio2">
                                Sign up as "Agent"
                            </label>
                        </div>
                    </div>
                    <div class="form-wraper">

                        <div class="buyer-form">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input type="text" id="fastname" placeholder="First name*" pattern="[A-Za-z]+" title="Please enter only alphabetic characters" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <input type="text" id="lastname" placeholder="Last name*" pattern="[A-Za-z]+" title="Please enter only alphabetic characters" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-row">
                                        <input type="email" id="email" placeholder="Email*" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-row">
                                            <select  name="nationality" id="nationality"  class="form-control" required>
                                                <option value="">Select country</option>
                                                <?php 
                                                foreach ($countryArray as $key => $value) {
                                                ?>
                                                <option value="<?php echo $key;?>"><?php echo $value["name"];?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-12">

                                    <div class="form-row country-code-row">
                                   
                                        <input type="tel" id="number" pattern="^\+?[0-9]{4,15}$" title="Please enter a valid phone number (4 to 15 digits)" class="form-control" required>
                                    </div>
                                </div>
                             
                                <!-- <div class="col-12">
                                    <div class="form-row">
                                        <textarea id="address" placeholder="Location" class="form-control" rows="4"
                                            cols="50"></textarea>
                                    </div>
                                </div> -->
                                <div class="col-12">
                                    <div class="form-row">
                                        <input type="password" id="password" placeholder="Password*"
                                            class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                            required>
                                            <span id="togglePassword" class="fa fa-eye" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-row">
                                        <input type="text" id="confirm" placeholder="Confirm Password*"
                                            class="form-control" required>
                                            <span id="togglePasswordconfirm" class="fa fa-eye" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-row">
                                        <div class="form-check">
                                            <input class="" type="checkbox" value="1" name="check" id="flexCheckDefault"
                                                required>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I accept <a
                                                    href="<?php echo get_theme_value('term_conditn_link'); ?>">Terms &
                                                    Conditions</a> and <a
                                                    href="<?php echo get_theme_value('privacy_policy_link'); ?>">Privacy
                                                    Policy</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="button-row">
                                        <!-- <img src="<?php // echo get_template_directory_uri() ?>/assets/auth/images/button.jpg"
                                            alt="" class="captcha-image"> -->
                                        <input type="submit" value="Sign Up" name="Sign Up" class="btn">
                                        <!-- <a href="<?php //echo get_theme_value('login_btn_link'); ?>">Login</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>



                <!--------- buyer form wraper end ----------->

                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top:15px;">
                    <strong id="errormessage"></strong>
                    <button type="button" class="close custom-close-btn ml-auto" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- body section end -->

<?php get_footer(); ?>
<script>
    jQuery(".alert").hide();
    jQuery(".close").click(function () {
        jQuery(".alert").hide();
    });
    jQuery("form").submit(function () {
        event.preventDefault();
        var nationality      = jQuery("#nationality").val();
       // var countrycode      = jQuery("#countrycode").val();
        var selectval   = jQuery('.form-check-input:checked').val();
        var fastname    = jQuery('#fastname').val();
        var lastname    = jQuery('#lastname').val();
        var email       = jQuery('#email').val();
        var number      = jQuery('#number').val();
        var address     = jQuery('#address').val();
        var password    = jQuery('#password').val();
        var confirm     = jQuery('#confirm').val();
        var phoneWithcountry = number;


        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php') ?>',
            //dataType: "json",

            data: {
                action: 'signup_form',
                selectval: selectval,
                fastname: fastname,
                lastname: lastname,
                email: email,
                number: phoneWithcountry,
                nationality: nationality,
                address: address,
                password: password,
                confirm: confirm,
            },
            success: function (data) {
                if (data == 'no') {

                    //window.location.href = 'https://ikaar.weavers-web.com/email-verification/';
                    var errormessage = "You have registered successfully. An OTP is sent to your email id.";
                    jQuery('#errormessage').text(errormessage);
                    jQuery(".alert").show();
                }
                else {
                    //show.innerHTML = data;
                    // alert(data);
                    jQuery('#errormessage').text(data);
                    jQuery(".alert").show();
                }

            }
        });
        this.reset();
    });
</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/auth/js/intlTelInput.js"></script>
    <script>
    var phoneInput = document.querySelector("#number");
 
            var countryInput = document.querySelector("#nationality");

            // Initialize intlTelInput
            var iti = window.intlTelInput(phoneInput, {
                separateDialCode: true,
                autoPlaceholder: "off",
                utilsScript: "<?php echo get_template_directory_uri(); ?>/assets/auth/js/utils.js"
            });

            // Set initial country based on selection
            var initialCountry = countryInput.value;
            iti.setCountry(initialCountry);

            // Update phone input when country is changed
            countryInput.addEventListener("change", function() {
                
                var selectedCountry = countryInput.value;
                iti.setCountry(selectedCountry);

                // Update phone input value with the new phone code
                var selectedCountryData = iti.getSelectedCountryData();
                phoneInput.value = "+" + selectedCountryData.dialCode;
            });
           

        jQuery('#togglePassword').click(function() {
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
    jQuery('#togglePasswordconfirm').click(function() {
        var passwordField = jQuery('#confirm');
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