<!-- video-section start -->
<?php $common_section_video = get_theme_value('common_section_video');
$video_title = get_theme_value('video_title');
$video_sub_title = get_theme_value('video_sub_title');
?>
<section class="video-section position-relative">
    <?php if (!empty($common_section_video)) { ?>
        <div class="video-wraper">
            <video autoplay muted loop id="myVideo">
                <source src="<?php echo $common_section_video; ?>" type="video/mp4">
            </video>
        </div>
    <?php } ?>
    <div class="container-holder">
        <div class="container">
            <div class="info-wraper">
                <?php if (!empty($video_title)) { ?>
                    <h3>
                        <?php echo $video_title; ?>
                    </h3>
                <?php }
                if (!empty($video_sub_title)) { ?>
                    <h4>
                        <?php echo $video_sub_title; ?>
                    </h4>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- video-section start -->