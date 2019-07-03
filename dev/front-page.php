<?php
/**
 * Render your site front page, whether the front page displays the blog posts index or a static page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package wprig
 */

get_header();

/*
* Include the component stylesheet for the content.
* This call runs only once on index and archive pages.
* At some point, override functionality should be built in similar to the template part below.
*/
wp_print_styles( array( 'wprig-content', 'wprig-front-page', 'wprig-swiper-style' ) ); // Note: If this was already done it will be skipped.

?>
	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<div class="banner-wrap">
				<div class="container">
					<div class="dog-container">
					<?php
					if ( have_rows( 'top_slider' ) ) :
						?>
						<div class="carousel-wrap">
							<div class="carousel-slider">
								<!-- Slider main container -->
								<div class="carousel swiper-container">
									<!-- Additional required wrapper -->
									<div class="swiper-wrapper">
										<?php
										while ( have_rows( 'top_slider' ) ) :
											the_row();
											?>
											<!-- Slides -->
											<div class="swiper-slide">
												<div class="carousel-item">
													<h2 class="title is-2"><?php the_sub_field( 'title' ); ?></h2>
													<p><?php the_sub_field( 'content' ); ?></p>
													<a href="<?php the_sub_field( 'link' ); ?>" class="btn yellow"><?php the_sub_field( 'link_text' ); ?></a>
												</div>
											</div>
											<?php
										endwhile;
										?>
									</div>
									<!-- If we need pagination -->
									<div class="swiper-pagination"></div>
								</div>
							</div>
							<script>
								var swiper = new Swiper( '.carousel', {
									pagination: {
										el: '.carousel .swiper-pagination',
										clickable: true
									},
									autoplay: {
										delay: 4000,
										disableOnInteraction: false,
									},
									});
							</script>
						</div>
						<?php
					endif;
					?>
						<div class="dog-img">
							<img src="<?php echo esc_url( get_theme_file_uri( '/images/dog.png' ) ); ?>" alt="">
						</div>
						<div class="filterwrap">
							<div class="filter-left">
								<h3>Find your perfect pet here</h3>
							</div>
							<div class="filter-right">
								<div class="slant"></div>
								<form action="<?php bloginfo( 'url' ); ?>/search" method="get">
									<select name="pet_type" id="pet_type">
										<option value="">Pet Type (Any) </option>
										<?php
										$pet_query = new WP_Query( array(
											'post_type'  => 'pet',
											'posts_per_page' => -1,
										));
										if ( $pet_query->have_posts() ) :
											while ( $pet_query->have_posts() ) :
												$pet_query->the_post();
												$postname = get_post_field( 'post_name', get_the_ID() );
												?>
												<option value="<?php echo esc_attr( $postname ); ?>" <?php echo ( isset( $ad_id ) && get_field( 'pet_type', $ad_id ) == $postname ? 'selected' : '' ); ?>><?php the_title(); ?></option>
												<?php
											endwhile;
											wp_reset_postdata();
										endif;
										?>
									</select>
									<select name="pet_breed" id="pet_breed">
										<option value="">Pet Breed (Any)</option>
									</select>
									<input type="text" placeholder="Location" name="origin" id="autocomplete">
									<input type="hidden" name="distance" value="100">
									<button type="submit">SEARCH NOW</button>
								</form>
								<script>
									var input = document.getElementById('autocomplete');
									var options = {
										types: ['geocode'],
										componentRestrictions: {country: "uk"}
									};
									var autocomplete = new google.maps.places.Autocomplete(input, options);
									autocomplete.addListener('place_changed', function() {
										var lat = autocomplete.getPlace().geometry.location.lat();
										var lang = autocomplete.getPlace().geometry.location.lng();
										var adr = autocomplete.getPlace().formatted_address;
										document.getElementById('lat').value = lat;
										document.getElementById('lng').value = lang;
									});
								</script>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="sliderwrap petsale">
				<div class="container">
					<h2 class="text-center title is-2">Latest Pet Sale</h2>

					<?php
					$latest_ads = new WP_Query( array(
						'post_type'      => 'ad',
						'posts_per_page' => 5,
					));
					if ( $latest_ads->have_posts() ) :
						?>
					<div class="slidewrap">
					<!-- Slider main container -->
					<div id="petslider" class="swiper-container">
						<!-- Additional required wrapper -->
						<div class="swiper-wrapper">
							<!-- Slides -->
							<?php
							while ( $latest_ads->have_posts() ) :
								$latest_ads->the_post();
								?>
							<div class="swiper-slide">
								<div class="item-slide">
									<div class="figure-img">
										<?php
										$image = get_field( 'image_1' );
										if ( $image ) :
											?>
										<img src="<?php echo esc_url( $image['url'] ); ?>" alt="">
										<?php else : ?>
										<img src="<?php echo esc_url( get_theme_file_uri( '/images/dogfood.png' ) ); ?>" alt="">
										<?php endif; ?>
									</div>
									<h3 class="title is-3 mb0"><?php the_title(); ?></h3>
									<h4 class="light"><?php echo esc_attr( get_field( 'contact_details' )['address'] ); ?></h4>
									<h3 class="mt0">£<?php echo number_format( get_field( 'asking_price' ) ); ?>.00</h3>
									<a href="<?php the_permalink(); ?>" class="btn">Click Here</a>
								</div>
							</div>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
						<!-- If we need pagination -->
						<div id="petslider-pagination" class="swiper-pagination"></div>
					</div>

					<!-- If we need navigation buttons -->
					<div id="petslider-prev" class="swiper-button-prev swiper-button-black"></div>
					<div id="petslider-next" class="swiper-button-next swiper-button-black"></div>

					<script>
						var swiper = new Swiper( '#petslider', {
						slidesPerView: 3,
						spaceBetween: 30,
						centeredSlides: true,
						loop: true,
						// init: false,
						pagination: {
							el: '#petslider-pagination',
							clickable: true,
						},
						navigation: {
							nextEl: '#petslider-next',
							prevEl: '#petslider-prev',
						},
						breakpoints: {
							640: {
							slidesPerView: 1,
							spaceBetween: 20,
							},
							320: {
							slidesPerView: 1,
							spaceBetween: 10,
							}
						}
						});
					</script>
					</div>
						<?php
					endif;
					?>
				</div>
			</div>

			<div class="sliderwrap mt100">
				<div class="container">
					<h2 class="text-center title is-2">Latest Products Sale</h2>
					<?php
					$latest_products = new WP_Query( array(
						'post_type'      => 'product',
						'posts_per_page' => 5,
					));
					if ( $latest_products->have_posts() ) :
						?>

					<div class="slidewrap">
					<!-- Slider main container -->
					<div id="productslider" class="swiper-container product-slider">
						<!-- Additional required wrapper -->
						<div class="swiper-wrapper">
							<?php
							while ( $latest_products->have_posts() ) :
								$latest_products->the_post();
								?>
							<!-- Slides -->
							<div class="swiper-slide">
								<div class="item-slide">
									<?php the_post_thumbnail( 'full' ); ?>
									<h3 class="mb0"><?php the_title(); ?></h3>
									<div itemprop="description" class="description">
										<?php echo apply_filters( 'woocommerce_short_description', $latest_products->post->post_excerpt ); ?>
									</div>
									<?php $price = get_post_meta( get_the_ID(), '_price', true ); ?>
									<h3 class="mt0"><?php echo wc_price( $price ); ?></h3>
									<a href="<?php the_permalink(); ?>" class="btn">Click Here</a>
								</div>
							</div>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
						<!-- If we need pagination -->
						<div id="product-pagination" class="swiper-pagination"></div>
					</div>

					<!-- If we need navigation buttons -->
					<div id="product-prev" class="swiper-button-prev swiper-button-black"></div>
					<div id="product-next" class="swiper-button-next swiper-button-black"></div>

					<script>
						var swiper = new Swiper( '#productslider', {
						slidesPerView: 3,
						spaceBetween: 30,
						centeredSlides: true,
						loop: true,
						// init: false,
						pagination: {
							el: '#product-pagination',
							clickable: true,
						},
						navigation: {
							nextEl: '#product-next',
							prevEl: '#product-prev',
						},
						breakpoints: {
							640: {
							slidesPerView: 1,
							spaceBetween: 20,
							},
							320: {
							slidesPerView: 1,
							spaceBetween: 10,
							}
						}
						});
					</script>
					</div>
						<?php
					endif;
					?>
				</div>
			</div>

			<div class="container mt100">
				<div class="gray-bg-link">
					<a href="<?php bloginfo( 'url' ); ?>/shop/"><img src="<?php echo esc_url( get_theme_file_uri( '/images/pethouse.png' ) ); ?>" alt=""> See all our PetDeals</a>
				</div>
			</div>

			<div class="welcome-section">
				<h2 class="section-title  title is-2"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>

			<?php
			if ( have_rows( 'who_we_are' ) ) :
				?>
			<div class="container">
				<div class="grid three-columns">
				<?php
				while ( have_rows( 'who_we_are' ) ) :
					the_row();
					?>
					<div>
						<div class="service-item">
							<figure>
								<img src="<?php echo esc_url( get_sub_field( 'image' )['url'] ); ?>" alt="<?php echo esc_attr( get_sub_field( 'image' )['alt'] ); ?>">
							</figure>
							<h3><?php the_sub_field( 'title' ); ?></h3>
							<p><?php the_sub_field( 'content' ); ?></p>
							<a href="<?php the_sub_field( 'link' ); ?>" class="circle-arrow"><img src="<?php echo esc_url( get_theme_file_uri( '/images/circle-arrow.png' ) ); ?>" alt=""></a>
						</div>
					</div>
					<?php
				endwhile;
				?>
				</div>
			</div>
				<?php
			endif;
			?>

			<?php
			if ( have_rows( 'services_we_offer' ) ) :
				?>
			<div class="welcome-section">
				<h2 class="section-title  title is-2">Services we offer</h2>
			</div>

			<div class="container">
				<div class="grid three-columns">
				<?php
				while ( have_rows( 'services_we_offer' ) ) :
					the_row();
					?>
					<div>
						<div class="offer-item">
							<figure>
								<img src="<?php echo esc_url( get_sub_field( 'image' )['url'] ); ?>" alt="">
							</figure>
							<h3><?php the_sub_field( 'title' ); ?></h3>
							<p><?php the_sub_field( 'content' ); ?></p>
							<div class="clear"></div>
							<a href="<?php the_sub_field( 'link' ); ?>">Learn More</a>
						</div>
					</div>
					<?php
				endwhile;
				?>
				</div>
			</div>
				<?php
			endif;
			?>

			<?php
			if ( have_rows( 'testimonials', 'option' ) ) :
				if ( get_field( 'testimonial_image_background', 'option' ) ) :
				?>
				<div class="blue-bg" style="background-image: url(<?php echo get_field( 'testimonial_image_background', 'option' )['url']; ?>); background-size: cover;">
					<?php else : ?>
				<div class="blue-bg">
				<?php endif; ?>
					<div class="container">
						<div class="testimonial-wrap">
							<!-- Slider main container -->
							<div class="testislider swiper-container">
								<!-- Additional required wrapper -->
								<div class="swiper-wrapper">
								<?php
								while ( have_rows( 'testimonials', 'option' ) ) :
									the_row();
									?>
									<!-- Slides -->
									<div class="swiper-slide">
										<div class="testi-item">
											<p class="testi-content"><?php the_sub_field( 'content' ); ?></p>
											<img src="<?php echo esc_url( get_theme_file_uri( '/images/five-paws.png' ) ); ?>" alt="">
											<p class="testi-name"><?php the_sub_field( 'name' ); ?> <span><?php the_sub_field( 'job' ); ?></span></p>
										</div>
									</div>
									<?php
								endwhile;
								?>
								</div>
							</div>
						<!-- If we need navigation buttons -->
						<div id="testi-prev" class="swiper-button-prev swiper-button-white"></div>
						<div id="testi-next" class="swiper-button-next swiper-button-white"></div>
					</div>
					<script>
						var testislider = new Swiper('.testislider', {
						navigation: {
							nextEl: '#testi-next',
							prevEl: '#testi-prev',
						},
						});
					</script>
				</div>
			</div>
				<?php
			endif;

			get_template_part( 'template-parts/content', 'choose' );

			get_template_part( 'template-parts/content', 'newblog' );

		endwhile; // End of the loop.
		?>
		<?php the_posts_navigation(); ?>

	</main><!-- #primary -->

<?php
get_footer();
