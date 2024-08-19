<?php
//Template Name:InsteadEnquiries
get_header('dashboard');
?>

<main>
    <div class="dashbord-section common-padding">
        <div class="container">
            <div class="dashbord-inner-row align-items-start d-flex">
                <?php get_template_part('/agent-dasbord/dashboard_menu_agent'); ?>
                <div class="dashboard-info">
                    <div class="change-pasword-section">
                        <div class="title-heading">
                            <h1><?php the_title(); ?></h1>
                        </div>
                      <!-- body content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>