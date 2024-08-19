<?php $bc_footerBg_logo = get_theme_value('bc_footerBg_logo');
if ($bc_footerBg_logo != "") { ?>
  <footer class="main-footer" style="background: url(<?php echo $bc_footerBg_logo; ?>);">
    <div class="container">
      <div class="top-footer common-padding">
        <div class="row">
          <div class="col-lg-2">
            <?php $bc_footer_logo = get_theme_value('bc_footer_logo');
            if ($bc_footer_logo != "") { ?> <div class="footer-logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo $bc_footer_logo; ?>" alt=""></a></div> <?php } ?>
          </div>
          <div class="col-lg-2 col-sm-6">
            <div class="footer-menu">
              <h6><?php echo get_theme_value('bc_footer_explore_title'); ?></h6>
              <?php wp_nav_menu(array('theme_location' => 'secondary_explore')); ?>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="footer-menu">
              <h6><?php echo get_theme_value('bc_footer_company_title'); ?></h6>
              <?php wp_nav_menu(array('theme_location' => 'secondary_company')); ?>

            </div>
          </div>
          <div class="col-lg-2 col-sm-6">
            <div class="footer-menu">
              <h6><?php echo get_theme_value('bc_footer_resource_title'); ?></h6>
              <?php wp_nav_menu(array('theme_location' => 'secondary_resource')); ?>
            </div>
            <div class="footer-social">
              <h6><?php echo get_theme_value('bc_footer_socialmedia_title'); ?></h6>
              <ul class="nav">
                <?php $driverite_facebook_link = get_theme_value('driverite_facebook_link');
                if ($driverite_facebook_link != "") { ?>
                  <li><a href="<?php echo $driverite_facebook_link; ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                <?php } ?>
                <?php $driverite_linkdin_link = get_theme_value('driverite_linkdin_link');
                if ($driverite_linkdin_link != "") { ?>
                  <li><a href="<?php echo $driverite_linkdin_link; ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
                <?php } ?>
                <?php $driverite_instagram_link = get_theme_value('driverite_instagram_link');
                if ($driverite_instagram_link != "") { ?>
                  <li><a href="<?php echo $driverite_instagram_link; ?>"><i class="fa-brands fa-instagram"></i></a></li>
                <?php } ?>
                <?php $driverite_twitter_link = get_theme_value('driverite_twitter_link');
                if ($driverite_twitter_link != "") { ?>
                  <li><a href="<?php echo $driverite_twitter_link; ?>"><i class="fa-brands fa-twitter"></i></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="footer-form">
              <h6><?php echo get_theme_value('bc_footer_newsletter_title'); ?></h6>
             <?php echo do_shortcode('[mc4wp_form id=1338]') ; ?>
            </div>
          </div>
        </div>
      </div>
      <?php $driverite_copyright_text = get_theme_value('driverite_copyright_text'); 
      $driverite_allright_text = get_theme_value('driverite_allright_text');?>

        <div class="bottom-footer text-center">
          <span><?php echo $driverite_copyright_text; ?> <?php echo date("Y"); ?> <?php echo $driverite_allright_text; ?></span>
        </div>

    </div>
  </footer>
<?php } ?>
<?php wp_footer(); ?>

</body>

</html>