<?php
$content = get_post_field("post_content", 374);
$content2 = get_field('partners', 374);
?>
<section class="partner-section common-padding">
   <div class="container">
      <div class="title-heading text-center">
         <?php echo wpautop($content); ?>
      </div>
      <div class="brand-holder">
         <ul>
            <?php
            $counter = 0;
            foreach ($content2 as $partner_img) {
               if ($counter > 8) {
                  break;
               }
               ?>
               <li><img src="<?php echo $partner_img['partners__images']; ?>" alt=''></li>
               <?php
               $counter++;
            }
            ?>
         </ul>
      </div>
   </div>
</section>