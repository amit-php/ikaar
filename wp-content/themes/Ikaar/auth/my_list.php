<?php
//Template Name:Mylist
get_header(); ?>
<main>
    <div class="dashbord-section common-padding">
        <div class="container">
            <div class="dashbord-inner-row  d-flex align-items-start">
                <div class="dashboard-menu">
                    <div class="top-row d-flex justify-content-between align-items-center">
                        <div class="tittle-wrap">
                            <h4 class="mb-0">dashboard-menu</h3>
                        </div>
                        <div class="toggle-menu-icon">
                            <span class="line-toggle"></span>
                            <span class="line-toggle"></span>
                            <span class="line-toggle"></span>
                        </div>
                    </div>
                    <ul>
                        <li>
                            <a href="">
                                <span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/person.svg" alt=""></span>
                                My Account
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/lock.svg" alt=""></span>
                                Change password
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/favorite.svg" alt=""></span>
                                Favorite
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/home.svg" alt=""></span>
                                Contacted Properties
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/question.svg" alt=""></span>
                                instead of Enquiries
                            </a>
                        </li>
                        <li class="active">
                            <a href="">
                                <span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/list.svg" alt=""></span>
                                My List
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/logout.svg" alt=""></span>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dashboard-info">
                    <div class="Favorite-section mylist-section">
                        <div class="title-heading">
                            <h1>Mylist</h1>
                        </div>
                        <div class="card-blog-wraper">
                            <div class="row">
                                <div class="col-md-6 card-blog-item">
                                    <div class="card-blog">
                                        <div class="card-blog-row d-flex align-items-start">
                                            <div class="image-box"><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/card-blog-1.jpg" alt=""></div>
                                            <div class="info-box">
                                                <h6>Fantastic New Golden Mile apartment within walking distance to the
                                                    beach</h6>
                                                <div class="location-wrap">
                                                    <ul class="d-flex">
                                                        <li>Sierra Blanca</li>
                                                        <li>Ref #: P8272</li>
                                                    </ul>
                                                </div>
                                                <div class="provide-item-row">
                                                    <ul class="d-flex align-items-center">
                                                        <li><span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/bed.svg" alt=""></span>2</li>
                                                        <li><span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/bathroom.svg" alt=""></span>2</li>
                                                    </ul>
                                                </div>
                                                <h6 class="price-wrap">€5.000.000</h6>
                                                <div class="bottom-row">
                                                    <div class="size-box">
                                                        <p><strong>Built Size:</strong> 175 sqft</p>
                                                        <p><strong>Terrace Size:</strong> 140</p>
                                                    </div>
                                                    <div class="button-holder">
                                                        <ul class="d-flex">
                                                            <li><a href="" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"><img
                                                                        src="<?php echo get_template_directory_uri()?>/assets/auth/images/icon-download.svg" alt=""></a></li>
                                                            <li><a href=""><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/icon-share.svg" alt=""></a>
                                                            </li>
                                                            <li class="list-btn"><a href=""><img
                                                                        src="<?php echo get_template_directory_uri()?>/assets/auth/images/Icon-heart-1.svg" alt=""></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 card-blog-item">
                                    <div class="card-blog">
                                        <div class="card-blog-row d-flex align-items-start">
                                            <div class="image-box"><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/card-blog-1.jpg" alt=""></div>
                                            <div class="info-box">
                                                <h6>Fantastic New Golden Mile apartment within walking distance to the
                                                    beach</h6>
                                                <div class="location-wrap">
                                                    <ul class="d-flex">
                                                        <li>Sierra Blanca</li>
                                                        <li>Ref #: P8272</li>
                                                    </ul>
                                                </div>
                                                <div class="provide-item-row">
                                                    <ul class="d-flex align-items-center">
                                                        <li><span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/bed.svg" alt=""></span>2</li>
                                                        <li><span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/bathroom.svg" alt=""></span>2</li>
                                                    </ul>
                                                </div>
                                                <h6 class="price-wrap">€5.000.000</h6>
                                                <div class="bottom-row">
                                                    <div class="size-box">
                                                        <p><strong>Built Size:</strong> 175 sqft</p>
                                                        <p><strong>Terrace Size:</strong> 140</p>
                                                    </div>
                                                    <div class="button-holder">
                                                        <ul class="d-flex">
                                                            <li><a href="" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"><img
                                                                        src="<?php echo get_template_directory_uri()?>/assets/auth/images/icon-download.svg" alt=""></a></li>
                                                            <li><a href=""><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/icon-share.svg" alt=""></a>
                                                            </li>
                                                            <li class="list-btn"><a href=""><img
                                                                        src="<?php echo get_template_directory_uri()?>/assets/auth/images/Icon-heart-1.svg" alt=""></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 card-blog-item">
                                    <div class="card-blog">
                                        <div class="card-blog-row d-flex align-items-start">
                                            <div class="image-box"><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/card-blog-1.jpg" alt=""></div>
                                            <div class="info-box">
                                                <h6>Fantastic New Golden Mile apartment within walking distance to the
                                                    beach</h6>
                                                <div class="location-wrap">
                                                    <ul class="d-flex">
                                                        <li>Sierra Blanca</li>
                                                        <li>Ref #: P8272</li>
                                                    </ul>
                                                </div>
                                                <div class="provide-item-row">
                                                    <ul class="d-flex align-items-center">
                                                        <li><span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/bed.svg" alt=""></span>2</li>
                                                        <li><span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/bathroom.svg" alt=""></span>2</li>
                                                    </ul>
                                                </div>
                                                <h6 class="price-wrap">€5.000.000</h6>
                                                <div class="bottom-row">
                                                    <div class="size-box">
                                                        <p><strong>Built Size:</strong> 175 sqft</p>
                                                        <p><strong>Terrace Size:</strong> 140</p>
                                                    </div>
                                                    <div class="button-holder">
                                                        <ul class="d-flex">
                                                            <li><a href="" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"><img
                                                                        src="<?php echo get_template_directory_uri()?>/assets/auth/images/icon-download.svg" alt=""></a></li>
                                                            <li><a href=""><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/icon-share.svg" alt=""></a>
                                                            </li>
                                                            <li class="list-btn"><a href=""><img
                                                                        src="<?php echo get_template_directory_uri()?>/assets/auth/images/Icon-heart-1.svg" alt=""></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 card-blog-item">
                                    <div class="card-blog">
                                        <div class="card-blog-row d-flex align-items-start">
                                            <div class="image-box"><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/card-blog-1.jpg" alt=""></div>
                                            <div class="info-box">
                                                <h6>Fantastic New Golden Mile apartment within walking distance to the
                                                    beach</h6>
                                                <div class="location-wrap">
                                                    <ul class="d-flex">
                                                        <li>Sierra Blanca</li>
                                                        <li>Ref #: P8272</li>
                                                    </ul>
                                                </div>
                                                <div class="provide-item-row">
                                                    <ul class="d-flex align-items-center">
                                                        <li><span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/bed.svg" alt=""></span>2</li>
                                                        <li><span><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/bathroom.svg" alt=""></span>2</li>
                                                    </ul>
                                                </div>
                                                <h6 class="price-wrap">€5.000.000</h6>
                                                <div class="bottom-row">
                                                    <div class="size-box">
                                                        <p><strong>Built Size:</strong> 175 sqft</p>
                                                        <p><strong>Terrace Size:</strong> 140</p>
                                                    </div>
                                                    <div class="button-holder">
                                                        <ul class="d-flex">
                                                            <li><a href="" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"><img
                                                                        src="<?php echo get_template_directory_uri()?>/assets/auth/images/icon-download.svg" alt=""></a></li>
                                                            <li><a href=""><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/icon-share.svg" alt=""></a>
                                                            </li>
                                                            <li class="list-btn"><a href=""><img
                                                                        src="<?php echo get_template_directory_uri()?>/assets/auth/images/Icon-heart-1.svg" alt=""></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="upload-wrap text-center">
                                <a href="" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Upload
                                    New </a>
                            </div>
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
                                                <div class="icon-holder"><img src="<?php echo get_template_directory_uri()?>/assets/auth/images/upload.svg" alt=""></div>
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
                                            <!-- <div class="form-row">
                           <select multiple placeholder="Choose skills" data-allow-clear="1">
                              <option>HTML</option>
                              <option>CSS</option>
                              <option>JavaScript</option>
                              <option>PHP</option>
                              <option>MySQL</option>
                            </select>
                        </div> -->
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