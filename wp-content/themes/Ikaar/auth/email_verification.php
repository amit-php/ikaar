<?php
//Template Name:Emailverified
get_header('dashboard');
$user_id = base64_decode($_GET['id']);
$otp = get_user_meta($user_id,"_otp",true);

?>
<main>
    <section class="login-section common-padding">
        <div class="container">
            <div class="form-holder">
                <div class="title-heading text-center">
                    <?php echo  get_post_field('post_content',$post->ID) ?>
              
                </div>
                <div class="form-wraper" id="f1">
                    <form>
                        <div class="form-row">
                            <input type="text" placeholder="Enter OTP" class="form-control" id="code">
                        </div>
                        <div class="button-row text-center">
                            <input type="submit" value="verify" class="btn" name="verify">

                        </div>
                    </form>
                </div>
                <!-- <div class="singe-social-wrap text-center">
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
                </div> -->
            </div>
        </div>
    </section>
</main>
<script>
    jQuery("form").submit(function (event) {
        event.preventDefault();
        //alert("ok");
        // var inputValue = $("#myInput").val(); demo
        var newOTP = jQuery('#code').val();
        var oldOTP = "<?php echo $otp ; ?>";
        var userid = "<?php echo $user_id ; ?>";
        if(newOTP === oldOTP){
            jQuery.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php') ?>',
            data: {
                action: 'emailVarification',
                otp: newOTP,
                uid: userid,

            },
            success: function (data) {
                if(data == 200){
                    alert('your email is verified now!');
                    window.location.href = '<?php echo get_the_permalink(544) ?>';

                }else{
                    alert(data);  
                }

            }
        });
        
        
        }else{
            alert("your OTP is not matched!");

        }
       
        

    })
</script>
<?php get_footer(); ?>