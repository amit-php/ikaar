<?php
//Template Name:SubscriptionsAgent
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
                                        // Assuming your Paid Memberships Pro shortcode is something like [pmpro_membership_levels]
                                        $shortcode_output = do_shortcode('[pmpro_levels]');

                                        // Echo the output
                                        echo $shortcode_output;
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

    <!-- Modal -->
    <div class="list-modal">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="list-form-wraper">
                            <h1>Upload Properties</h1>
                            <div class="form-wraper">
                                <form action="">
                                    <div class="upload-wrap">
                                        <input type="file" id="upload-file">
                                        <label for="upload-file">
                                            <div class="inner-label">
                                                <div class="icon-holder"><img
                                                        src="<?php echo get_template_directory_uri() ?>/assets/auth/images/upload.svg"
                                                        alt=""></div>
                                                Upload image
                                            </div>
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input type="text" placeholder="Property Type" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input type="text" placeholder="Property Area(Sq.ft)"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input type="text" placeholder="Property Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input type="text" placeholder="Property Price" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-row">
                                                <input type="text" placeholder="Property Location" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input type="text" placeholder="Phone no." class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <input type="text" placeholder="Email:" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <select name="" id="" class="form-control">
                                                    <option value="">BHK</option>
                                                    <option value="">1BHK</option>
                                                    <option value="">2BHK</option>
                                                    <option value="">3BHK</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <select name="" id="" class="form-control">
                                                    <option value="">Property Status</option>
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-row">
                                                <select multiple placeholder="Choose skills" data-allow-clear="1">
                                                    <option>HTML</option>
                                                    <option>CSS</option>
                                                    <option>JavaScript</option>
                                                    <option>PHP</option>
                                                    <option>MySQL</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="button-row">
                                                <input type="submit" value="upload" class="btn">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->



</main>
<?php get_footer(); ?>