<?php
get_header();
$page_id = get_queried_object_id();
$featured_image = get_the_post_thumbnail_url();
?>
<main>
    <section class="hero-banner inner-banner position-relative">
        <?php if (has_post_thumbnail()) { ?>
            <div class="banner-bg" style="background: url(<?php echo $featured_image; ?>);"></div>
        <?php } ?>
        <div class="container-holder">
            <div class="container overlay-content">
                <div class="banner-info">
                    <h1>
                        <?php the_title(); ?>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-section common-padding-top">
        <div class="container">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>  
        <?php the_content(); ?>
        <?php endwhile;

previous_posts_link();
next_posts_link();


else: ?>
<h1><?php _e('Not Found')?></h1>
<p><?php _e('Sorry,no posts matched your criteria.'); ?></p>
<?php endif; ?>
        </div>
    </section>
   
</main>
<?php get_footer(); ?>


