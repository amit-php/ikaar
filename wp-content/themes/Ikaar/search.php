<?php get_header(); ?>




</main>
<!-- body section start -->
<main class="body-bg">
	<section class="hero-banner inner-banner position-relative">
		<div class="banner-bg"
			style="background: url(<?php echo get_template_directory_uri() ?>/assets/images/inner-banner.jpg);"></div>
		<div class="container-holder">
			<div class="container overlay-content">
				<div class="banner-info">
					<h1>Search</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- <section class="Category-section">
		<div class="container container-custome">
			<form action="">
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="form-row">
							<input type="text" class="form-control" placeholder="Property Category">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="form-row">
							<input type="text" class="form-control" placeholder="Min Price">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="form-row">
							<input type="text" class="form-control" placeholder="Maximum price">
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="form-row">
							<input type="text" class="form-control" placeholder="Location">
						</div>
					</div>
				</div>
			</form>
		</div>
	</section> -->
	<section class="property-listing-section common-padding-top">
		<div class="container">
			<?php 
			$cat  = $_GET['s'];
			$min  = (int) $_GET['min'];
			$max  = (int) $_GET['max'];
			$loc  = $_GET['location'];
			$area  = $_GET['_area'];
			$bhk   = $_GET['_bhk'];
			$bed   = $_GET['_bedrooms'];
			$bath  = $_GET['_bathrooms'];
			$types = $_GET['_types'];
			$ref   = $_GET['_ref'];
			$fetures = $_GET['fetures'];
	

			$args = array(
				'post_type' => 'property',
				'post_status' => 'publish',
				'posts_per_page' => -1,
			);
			$all_posts = new WP_Query($args);

			if ($all_posts->have_posts()) {
				$propPrice = [];
				while ($all_posts->have_posts()) {
					$all_posts->the_post();
					$price = get_post_meta(get_the_ID(), 'property_price', true);

					array_push($propPrice, $price);
				}

			}
			$max_price = max($propPrice);
			$min_price = min($propPrice);
			if (empty($min_price)) {
				$min_price = 1;
			}



			$aurgs = array(
				'post_type' => 'property',
				'post_status' => 'publish',
				'meta_query' => array(
					'relation' => 'AND',
				),
				'tax_query' => array(
					'relation' => 'AND',

				)
			);

			if (!empty($cat)) {
				$aurgs['tax_query'][] = array(
					'taxonomy' => 'property_type',
					'field' => 'slug',
					'terms' => $cat,
				);
			}

			if (!empty($loc)) {

				$aurgs['tax_query'][] = array(
					'taxonomy' => 'property_location',
					'field' => 'slug',
					'terms' => $loc,
				);

			}
			if (!empty($fetures)) {

				$aurgs['tax_query'][] = array(
					'taxonomy' => 'amenities',
					'field' => 'slug',
					'terms' => $fetures,
				);

			}

			if (!empty($min) && empty($max)) {
				$aurgs['meta_query'][] = array(
					'key' => 'property_price',
					'value' => array($min, $max_price),
					'type' => 'numeric',
					'compare' => 'between'
				);
			}
			if (!empty($max) && empty($min)) {
				$aurgs['meta_query'][] = array(
					'key' => 'property_price',
					'value' => array($min_price, $max),
					'type' => 'numeric',
					'compare' => 'between'
				);
			}
			
			if (!empty($max) && !empty($min)) {
				$aurgs['meta_query'][] = array(
					'key' => 'property_price',
					'value' => array($min, $max),
					'type' => 'numeric',
					'compare' => 'between'
				);

			}
			if (!empty($ref) ) {
				$aurgs['meta_query'][] = array(
					'key' => 'ref_no',
					'value' => $ref,
					'compare' => '='
				);

			}
			if (!empty($area) ) {
				$aurgs['meta_query'][] = array(
					'key' => 'property_area_sq',
					'value' => $area,
					'compare' => '='
				);

			}
			if (!empty($bhk) ) {
				$aurgs['meta_query'][] = array(
					'key' => 'bhk',
					'value' => $bhk,
					'compare' => '='
				);

			}
			if (!empty($bed) ) {
				$aurgs['meta_query'][] = array(
					'key' => 'bwdrooms_qtt',
					'value' => $bed,
					'compare' => '='
				);

			}
			if (!empty($bath) ) {
				$aurgs['meta_query'][] = array(
					'key' => 'bathrooms_qtt',
					'value' => $bath,
					'compare' => '='
				);

			}
			if (!empty($types) ) {
				$aurgs['meta_query'][] = array(
					'key' => 'service_type',
					'value' => $types,
					'compare' => '='
				);

			}
			$property = new WP_Query($aurgs); ?>

			<div class="item-box-holder">
				<?php if ($property->have_posts()) {
					while ($property->have_posts()) {
						$property->the_post(); ?>
						<div class="item-box">
							<div class="row align-items-center">
								<div class="col-lg-6">
									<div class="iamge-box"><a href="<?php the_permalink(); ?>">
											<?php echo get_the_post_thumbnail(); ?>
										</a>

									</div>
								</div>
								<div class="col-lg-6">
									<div class="info-box">
										<div class="top-row d-flex justify-content-between">
											<div class="title-wrap">
												<h4 ><a href="<?php the_permalink(); ?>" style="color: black;">
														<?php the_title(); ?>
													</a>
												</h4>
											</div>
											<!-- <div class="button-holder">
										<ul class="d-flex">
											<li><a href=""><img src="images/icon-download.svg" alt=""></a></li>
											<li><a href=""><img src="images/icon-share.svg" alt=""></a></li>
											<li class="list-btn"><a href=""><img src="images/icon-heart.svg" alt=""></a>
											</li>
										</ul>
									</div> -->
										</div>
										<div class="location-wrap">
											<ul class="d-flex">
												<?php $ref_no = get_field('ref_no');
												$terms = get_the_terms(get_the_ID(), 'property_location');
												foreach ($terms as $term) {
													//$location = $terms[0]->name;
													$location = $term->name;
													$term_link = get_term_link($term); ?>
													<li><a href="<?php echo $term_link; ?>">
															<?php echo $location; ?>
														</a></li>
												<?php }
												if (!empty($ref_no)) { ?>
													<li>
														<?php echo $ref_no; ?>
													</li>
												<?php } ?>
											</ul>
										</div>
										<div class="provide-item-row">
											<ul class="d-flex align-items-center">
												<li><span><img src="<?php echo get_field('bedrooms_image'); ?>" alt=""></span>
													<?php echo get_field('bwdrooms_qtt'); ?>
												<li><span><img src="<?php echo get_field('bathroom_image'); ?>" alt=""></span>
													<?php echo get_field('bathrooms_qtt'); ?>
												</li>
											</ul>
										</div>
										<h5>
											<span>
												<?php echo get_field('currency'); ?>
											</span>
											<?php $formatted_price = number_format(get_field('property_price')); ?>
											<span>
												<?php echo $formatted_price; ?>
											</span>
										</h5>

										<?php the_content(); ?>

									</div>
								</div>
							</div>

						</div>
					<?php }
					wp_reset_postdata();
				} else {
					echo "No post found";
				} ?>
				<!-- <div class="item-box">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="iamge-box"><img src="images/listing.jpg" alt=""></div>
						</div>
						<div class="col-lg-6">
							<div class="info-box">
								<div class="top-row d-flex justify-content-between">
									<div class="title-wrap">
										<h4>Fantastic New Golden Mile apartment within walking distance to the beach
										</h4>
									</div>
									<div class="button-holder">
										<ul class="d-flex">
											<li><a href=""><img src="images/icon-download.svg" alt=""></a></li>
											<li><a href=""><img src="images/icon-share.svg" alt=""></a></li>
											<li class="list-btn"><a href=""><img src="images/icon-heart.svg" alt=""></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="location-wrap">
									<ul class="d-flex">
										<li>Sierra Blanca</li>
										<li>Ref #: P8272</li>
									</ul>
								</div>
								<div class="provide-item-row">
									<ul class="d-flex align-items-center">
										<li><span><img src="images/bed.svg" alt=""></span>2</li>
										<li><span><img src="images/bathroom.svg" alt=""></span>2</li>
									</ul>
								</div>
								<h5>€5.000.000</h5>
								<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
									laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
									architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia
									voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos
									qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum
									quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi
									tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
							</div>
						</div>
					</div>

				</div>
				<div class="item-box">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="iamge-box"><img src="images/listing.jpg" alt=""></div>
						</div>
						<div class="col-lg-6">
							<div class="info-box">
								<div class="top-row d-flex justify-content-between">
									<div class="title-wrap">
										<h4>Fantastic New Golden Mile apartment within walking distance to the beach
										</h4>
									</div>
									<div class="button-holder">
										<ul class="d-flex">
											<li><a href=""><img src="images/icon-download.svg" alt=""></a></li>
											<li><a href=""><img src="images/icon-share.svg" alt=""></a></li>
											<li class="list-btn"><a href=""><img src="images/icon-heart.svg" alt=""></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="location-wrap">
									<ul class="d-flex">
										<li>Sierra Blanca</li>
										<li>Ref #: P8272</li>
									</ul>
								</div>
								<div class="provide-item-row">
									<ul class="d-flex align-items-center">
										<li><span><img src="images/bed.svg" alt=""></span>2</li>
										<li><span><img src="images/bathroom.svg" alt=""></span>2</li>
									</ul>
								</div>
								<h5>€5.000.000</h5>
								<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
									laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
									architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia
									voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos
									qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum
									quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi
									tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
							</div>
						</div>
					</div>

				</div> -->
				<!-- <div class="button-row text-center">
					<a href="" class="btn">LOAD MORE</a>
				</div> -->
			</div>
		</div>
	</section>
	<!-- <section class="partner-section common-padding">
		<div class="container">
			<div class="title-heading text-center">
				<h3>Trusted partners</h3>
				<p>How we connect a global audience of luxury real estate sellers and buyers in Marbella.</p>
			</div>
			<div class="brand-holder">
				<ul>
					<li><img src="images/partner-1.jpg" alt=""></li>
					<li><img src="images/partner-2.jpg" alt=""></li>
					<li><img src="images/partner-3.jpg" alt=""></li>
					<li><img src="images/partner-4.jpg" alt=""></li>
					<li><img src="images/partner-5.jpg" alt=""></li>
					<li><img src="images/partner-1.jpg" alt=""></li>
					<li><img src="images/partner-2.jpg" alt=""></li>
					<li><img src="images/partner-3.jpg" alt=""></li>
				</ul>
			</div>
		</div>
	</section> -->
</main>
<!-- body section end -->
<?php get_footer(); ?>