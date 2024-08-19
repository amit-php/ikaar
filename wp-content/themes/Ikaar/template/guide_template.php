<?php
//Template Name:Guide-templates
get_header();
$page_id = get_queried_object_id();
?>
     <!-- header section end -->
     <!-- body section start -->
     <main>
        <section class="hero-banner inner-banner position-relative">
            <div class="banner-bg" style="background: url(<?php echo get_template_directory_uri(); ?>/assets/images/inner-banner.jpg);"></div>
            <div class="container-holder">
               <div class="container overlay-content">
                  <div class="banner-info">
                     <h1><?php the_title();?></h1>
                  </div>
               </div>
            </div>
         </section>
         <section class="service-details-section details-section body-bg">
            <div class="container">
                <div class="details-wraper">
                    <!-- <div class="section-title text-center">
                        <h2>Property in the Costa del Sol – is new build the way forward?</h2>
                        <h4>August 22, 2022 by Paramount Digital</h4>
                    </div> -->
                    <div class="image-box"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog-details.jpg" alt=""></div>
                    <?php the_content(); ?>
                </div>
            </div>
         </section>
         <section class="guide-faq-section common-padding">
            <div class="container">
              <?php 
              $arrFaq = get_field("add_faq",$post->ID);
              if($arrFaq){
              ?>
               <div class="faq-wraper">
                  <div class="section-title text-center">
                     <h2>guide-faq</h2>
                  </div>
                  <div class="accordion" id="guideaccordionExample">
                    <?php
                    foreach ($arrFaq as $key => $faqvalue) {
                      if($key == 0){
                        $collapsed = "";
                        $expanded = true;
                        $show = "show";
                      }else{
                        $collapsed = "collapsed";
                        $expanded = false;
                        $show = "";
                      }
                    ?>
                     <div class="accordion-item">
                       <h2 class="accordion-header" id="headingOne<?=$key;?>">
                         <button class="accordion-button <?=$collapsed ; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?=$key;?>" aria-expanded="<?=$expanded ; ?>" aria-controls="collapseOne<?=$key;?>">
                           <?php echo $faqvalue["question"];?>
                         </button>
                       </h2>
                       <div id="collapseOne<?=$key;?>" class="accordion-collapse collapse <?=$show;?>" aria-labelledby="headingOne<?=$key;?>" data-bs-parent="#guideaccordionExample">
                         <div class="accordion-body">
                          <p><?php echo $faqvalue["answer"];?></p>
                         </div>
                       </div>
                     </div>
                     <?php } ?>
                   </div>
                   <div class="button-wrap text-center">
                     <a href="<?php echo get_field("add_pdf_file",$post->ID) ; ?>" class="btn" target="_blank">Download</a>
                   </div>
               </div>
               <?php } ?>
            </div>
         </section>
         <section class="contact-section contact-wraper common-padding">
        <div class="container container-custome">
            <div class="title-heading text-center">
           
                    <h3>
                   <?php echo get_field("contact_form_title");?>
                    </h3>
              
                    <p>
                    <?php echo get_field("contact_form_subtitle");?>
                    </p>
             
            </div>
       
                <div class="form-wraper">
                    <?php echo do_shortcode('[contact-form-7 id="e333e8d" title="guide page"]'); ?>
                </div>
        
        </div>
    </section>
     </main>   
<?php get_footer(); ?>