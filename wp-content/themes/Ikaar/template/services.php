<?php
//Template Name:Services
get_header();
$propertyTypes = dynamic_property_type_search();
//echo "<pre/>";
//print_r($propertyTypes);

$types = $propertyTypes['PropertyTypes']['PropertyType'];
?>



<main>
    <section class="hero-banner inner-banner position-relative">
        <?php $banner_image_service = get_field("banner_image_service");
        if ($banner_image_service != "") { ?>
            <div class="banner-bg" style="background: url(<?php echo $banner_image_service; ?>);"></div>
        <?php } ?>
        <div class="container-holder">
            <div class="container overlay-content">
                <?php $banner_title_services = get_field("banner_title_services");
                if ($banner_title_services != "") { ?>
                    <div class="banner-info">
                        <h1><?php echo $banner_title_services; ?></h1>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="service-section body-bg common-padding-top">
        <div class="container">
            <div class="row">
            <div class="container mt-5">
    <div class="row">
        <?php foreach ($types as $type) : ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#" class="option-link" onclick="handleClick('<?= $type['OptionValue']; ?>')"><?= $type['Type']; ?></a></h5>
                       
                        <?php if (!empty($type['SubType'])) : ?>
                            <h6>Sub Types:</h6>
                            <ul>
                                <?php foreach ($type['SubType'] as $subtype) : ?>
                                    <li>
                                    <a href="#" class="option-link" onclick="handleClick('<?= $subtype['OptionValue']; ?>')"><?= $subtype['Type']; ?> </a>
                                       
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

            </div>
        </div>
    </section>
    <!-- trusted partners start-->
    <?php get_template_part("/template_part/partner_logo"); ?>
    <!-- trusted partners end-->
</main>
<?php get_footer(); ?>
<script>
    function handleClick(optionValue) {
        // Construct the URL with the passed option value
        const baseUrl = 'https://ikaar.weavers-web.com/listing/';
        const fullUrl = `${baseUrl}?ov=${optionValue}`;
        
        // Redirect to the constructed URL
        window.location.href = fullUrl;
    }
</script>