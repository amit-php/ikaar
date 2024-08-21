<section

    class="recommendations-section latest-project-section <?php echo is_singular('property') ? 'common-padding-top' : 'common-padding'; ?>">
    <div class="container">
        <div class="title-heading text-center">
            <?php $lat_prop_title = get_theme_value("lat_prop_title");
            if ($lat_prop_title != "") { ?>
                <h3>
                    <?php echo $lat_prop_title ?>
                </h3>
            <?php } ?>
            <?php $lat_prop_sub_title = get_theme_value("lat_prop_sub_title");
            if ($lat_prop_sub_title != "") { ?>
                <p>
                    <?php echo $lat_prop_sub_title ?>
                </p>
            <?php } ?>
        </div>
        <div class="row">
                <?php
                    $dynamic_params = [
                        'p_agency_filterid' => 1,
                        'P_PageSize'=>3,
                        'P_sandbox' => true
                    ];
                    $data = fetch_data_from_resales_api($dynamic_params);
                    // echo "<pre/>";
                    // print_r($data);
                    // echo "<pre/>";
                    if ($data["status"] === "success") {
                        // Process and display the data
                        foreach ($data["result"] as $key => $value) {
                    ?>
                    <div class="col-lg-4 col-md-6 category-item-box">
                        <div class="category-box position-relative">
                            <a href="<?php echo esc_url(get_the_permalink(1417)).'?refid='.$value['Reference']; ?>">
                                <div class="image-box position-relative">
                                    <?php
                                    if ($value['Pictures']['Picture'][0]) {
                                        echo "<img src='".$value['Pictures']['Picture'][0]['PictureURL']."' />";
                                    } ?>
                                    <div class="category-title">
                                        <h6>
                                            <?php echo $value['PropertyType']['NameType']; ?>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                            <div class="category-list-row d-flex align-items-center justify-content-between">
                                <div class="provide-item-row">
                                    <ul class="d-flex align-items-center">
                                        <?php
                                        $bedrooms_image = get_theme_value('pro_bedrooms_image_icon');
                                        $bwdrooms_qtt = $value['Bedrooms'];
                                        $bathroom_image = get_theme_value('pro_bathrooms_image_icon');
                                        $bathrooms_qtt = $value['Bathrooms'];
                                        $sq_ft_image = get_theme_value('pro_squ_imag_icon');
                                        $property_area_sq = $value['Built'].'m²';
                                        $terrace_img = get_theme_value('pro_terrace_image_icon');
                                        $temperature = 0;
                                        $property_price = $value['OriginalPrice'];
                                        if (!empty($bwdrooms_qtt)) { ?>
                                            <li><span><img src="<?php echo $bedrooms_image; ?>" alt=""></span>
                                                <?php echo $bwdrooms_qtt; ?>
                                            </li>
                                        <?php }
                                        if (!empty($bathrooms_qtt)) { ?>
                                            <li><span><img src="<?php echo $bathroom_image; ?>" alt=""></span>
                                                <?php echo $bathrooms_qtt; ?>
                                            </li>
                                        <?php }
                                        if (!empty($property_area_sq)) { ?>
                                            <li><span><img src="<?php echo $sq_ft_image; ?>" alt=""></span>
                                                <?php echo $property_area_sq; ?>
                                            </li>
                                        <?php }
                                        if (!empty($temperature)) { ?>
                                            <li><span><img src="<?php echo $terrace_img; ?>" alt=""></span>
                                                <?php echo $temperature; ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="total-price-row">
                                    <span>
                                        <?php echo get_theme_value('pro_currency'); ?>
                                    </span>
                                    <?php
                                    if (!empty($property_price)) { ?>
                                        <span>
                                            <?php echo $property_price ; ?>
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
                ?>
            </div>
    </div>
</section>