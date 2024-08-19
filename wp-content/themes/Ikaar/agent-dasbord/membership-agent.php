<?php
//Template Name:membership page default
get_header('dashboard'); ?>

<main>
    <div class="dashbord-section common-padding">
        <div class="container">
            <div class="dashbord-inner-row  d-flex align-items-start">
                <?php get_template_part('/agent-dasbord/dashboard_menu_agent'); ?>
                <div class="dashboard-info">
                    <div class="Favorite-section mylist-section">
                        <div class="title-heading">
                            <h1><?php the_title(); ?></h1>
                        </div>
                        <div class="card-blog-wraper">
                            <div class="row">
                                <div class="col-md-12 card-blog-item">
                                    <div class="card-blog">
                                <?php
                                    $post_content = get_post_field('post_content', get_the_ID());
                                    echo do_shortcode($post_content);
                                    ?>
                                    </div>
                                </div>


                            </div>
                            <!-- <div class="upload-wrap text-center">
                                <a href="" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Upload
                                    New </a>
                            </div> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

   



</main>
<?php get_footer(); ?>