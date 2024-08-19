
<?php //Template Name:EditProfileBuyer
get_header('dashboard');
//$current_user = wp_get_current_user();



//echo $user_email; ?>

<main>
   <div class="dashbord-section common-padding">
      <div class="container">
         <div class="dashbord-inner-row align-items-start d-flex">
         <?php get_template_part('/buyer-dashboard/dashboard_menu_buyer');
            $user_id = $current_user->ID;
            $fast_name = $current_user->get('first_name');
            $last_name = $current_user->get('last_name');
            $user_email = $current_user->user_email;
            $user_description = $current_user->description;
            $phone = get_user_meta($user_id, 'number', true);
            $address = get_user_meta($user_id, 'address', true);
            ?>
            <div class="dashboard-info">
               <div class="change-pasword-section">
                  <div class="title-heading">
                     <h1><?php the_title(); ?></h1>
                  </div>
                  <div class="change-pasword-wraper">
                     <div class="form-wraper">
                        <form action="">
                           <div class="form-row">
                              <label for="">First Name</label>
                              <input type="text" id="firstname" class="form-control" value="<?php echo $fast_name; ?>">
                           </div>
                           <div class="form-row">
                              <label for="">Last Name</label>
                              <input type="text" id="lastname" class="form-control" value="<?php echo $last_name; ?>">
                           </div>
                           <div class="form-row">
                              <label for="">Email</label>
                              <input type="Email" id="email" class="form-control" value="<?php echo $user_email; ?>"
                                 readonly>
                           </div>
                           <div class="form-row">
                              <label for="">Phone Number</label>
                              <input type="text" id="phone" class="form-control" value="<?php echo $phone; ?>">
                           </div>
                           <div class="form-row">
                              <label for="">Address</label>
                              <textarea id="address" class="form-control"> <?php echo $address; ?></textarea>
                           </div>
                           <div class="form-row">
                              <label for="">Description</label>
                              <textarea id="description" class="form-control"><?php echo $user_description; ?></textarea>
                           </div>
                           <div class="button-row">
                              <input type="submit" value="Save Change" class="btn d-block">
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
<?php get_footer(); ?>

<script>
   jQuery("form").submit(function () {
      event.preventDefault();
      var firstname = jQuery('#firstname').val();
      var lastname = jQuery('#lastname').val();
      var phone = jQuery('#phone').val();
      var address = jQuery('#address').val();
      var description = jQuery('#description').val();
      jQuery.ajax({
         type: "POST",
         url: '<?php echo admin_url('admin-ajax.php') ?>',
         data: {
            action: 'edit_profile',
            firstname: firstname,
            lastname: lastname,
            phone: phone,
            address: address,
            description: description
         },
         success: function (data) {
            if (data == "200") {
               alert("Data updated successfully");
               window.location.href = '<?php echo get_the_permalink(745) ?>';
            }


         }

      });

   });
</script>