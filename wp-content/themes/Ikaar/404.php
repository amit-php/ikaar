<?php get_header(); ?>
<section class="common-padding">
	<div class="container">
	    <div class="row">
            <div class="col-lg-12 text-center">
				<h1><?php _e('Error') ?></span>404 - <?php _e('Not Found') ?></h1>
				<h2>This is somewhat embarrassing, isn’t it?</h2>
				<p>It seems we can’t find what you’re looking for. Perhaps searching can help.</p>
				<a href="<?php echo site_url(); ?>" class="btn">Back To Home</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>