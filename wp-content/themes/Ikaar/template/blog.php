<?php
//Template name:bloglist
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
            <div class="title-heading text-center">
                <?php $blog_title = get_field('blog_title', $page_id);
                $sub_title = get_field('sub_title', $page_id);
                if (!empty($blog_title)) { ?>
                    <h3>
                        <?php echo $blog_title; ?>
                    </h3>
                <?php }
                if (!empty($sub_title)) {
                    ?>
                    <p>
                        <?php echo $sub_title; ?>
                    </p>
                <?php } ?>
            </div>
            <?php $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 4,
            );
            $blogs = new WP_Query($args);
            if ($blogs->have_posts()) { ?>

                <div class="row project">
                    <?php while ($blogs->have_posts()) {
                        $blogs->the_post(); ?>
                        <div class="col-lg-3 col-md-6 card-item-box ">
                            <div class="card-box">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="image-box position-relative">

                                        <?php echo get_the_post_thumbnail(); ?>
                                        <div class="card-title">
                                            <?php $special_points = get_post_meta($post->ID, 'special_points', true);
                                            if (!empty($special_points)) { ?>
                                                <h6>
                                                    <?php echo $special_points; ?>
                                                </h6>
                                            <?php } ?>
                                            <p>
                                                <?php echo get_the_date(); ?>
                                            </p>
                                        </div>

                                    </div>
                                </a>
                                <div class="card-info">
                                    <h6><a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h6>
                                    <p>
                                        <?php the_excerpt(); ?>
                                    </p>
                                    <?php $read_more = get_post_meta($post->ID, 'read_more', true) ?>
                                    <div class="button-row">
                                        <a href="<?php echo the_permalink(); ?>" class="more-btn">
                                            <?php echo $read_more; ?>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php }
                    wp_reset_postdata(); ?>
                </div>
            <?php } ?>
            <div class="button-wrap text-center">
                <a href="javascript:void(0)" class="btn" id="LoadId"><?php echo get_theme_value('load_more_button'); ?></a>
            </div>
        </div>
    </section>
    <?php get_template_part("/template_part/trusted_partners") ?>;
</main>
<?php get_footer(); ?>


<script>
    jQuery(document).ready(function ($) {
        jQuery(function ($) {
            var loadMoreButton = $('#LoadId');
            var paged = 2;
            var container = $('.project');

            function loadposts() {
                var data = {
                    'action': 'load_more_posts',
                    'paged': paged,
                };

                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (response) {
                        if (paged >= response.max) {
                            $('#LoadId').hide();
                        }
                        container.append(response.html);
                        paged++;
                    }
                });
            }
            loadMoreButton.on('click', function (e) {
                e.preventDefault();
                loadposts();
            });
        });
    });
</script>