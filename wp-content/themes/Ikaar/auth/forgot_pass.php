<?php
//Template Name:Forgotpass
get_header('dashboard');
?>
<!-- body section start -->
<main>
    <section class="login-section common-padding">
        <div class="container">
            <div class="form-holder">
                <div class="title-heading text-center">

                    <?php echo get_post_field('post_content', $post->ID) ?>
                </div>
                <div class="form-wraper">
                    <form method="post" action="">
                        <div class="form-row">
                            <input type="email" placeholder="Email" class="form-control" id="emailid" required>
                        </div>
                        <div class="button-row text-center">
                            <input type="submit" value="Send" class="btn">
                        </div>
                    </form>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top:15px;">
                        <strong id="errormessage"></strong>
                        <button type="button" class="close custom-close-btn" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
              
            </div>
        </div>
    </section>
</main>
<!-- body section end -->
<script>
    jQuery(".alert").hide();
    jQuery(".close").click(function () {
        jQuery(".alert").hide();
    });
    jQuery("form").submit(function () {
        event.preventDefault();
        var email = jQuery('#emailid').val();
        jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php') ?>',
            data: {
                action: 'forget_pass',
                email: email,
            },
            success: function (data) {
                if (data == 1) {
                    var errormessage = "A OTP is sent to your email id to reset password.";
                    jQuery('#errormessage').text(errormessage);
                    jQuery(".alert").show();
                }
                else {
                    alert(data);
                }

            }
        });
    })
</script>


<?php get_footer(); ?>