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
wp_print_styles( array( 'wprig-content', 'wprig-front-page', 'wprig-slick-style', 'wprig-slick-theme', 'wprig-slick-custom', 'wprig-swiper-style' ) ); // Note: If this was already done it will be skipped.

?>
	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<div class="banner-wrap">
				<div class="container">
					<div class="dog-container">
						<div class="carousel-wrap">
							<div class="carousel-slider">
								<!-- Slider main container -->
								<div class="carousel swiper-container">
									<!-- Additional required wrapper -->
									<div class="swiper-wrapper">
										<!-- Slides -->
										<div class="swiper-slide">
											<div class="carousel-item">
												<h2>Post FREE Pet Adverts</h2>
												<p>You can post any number of adverts of Puppies, Cats , Rabbits</p>
												<a href="#" class="btn yellow">REGISTER NOW</a>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="carousel-item">
												<h2>Post FREE Pet Adverts</h2>
												<p>You can post any number of adverts of Puppies, Cats , Rabbits</p>
												<a href="#" class="btn yellow">REGISTER NOW</a>
											</div>
										</div>
										<div class="swiper-slide">
											<div class="carousel-item">
												<h2>Post FREE Pet Adverts</h2>
												<p>You can post any number of adverts of Puppies, Cats , Rabbits</p>
												<a href="#" class="btn yellow">REGISTER NOW</a>
											</div>
										</div>
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
						<div class="dog-img">
							<img src="<?php echo esc_url( get_theme_file_uri( '/images/dog.png' ) ); ?>" alt="">
						</div>
						<div class="filterwrap">
							<div class="filter-left">
								<h3>Find your perfect pet here</h3>
							</div>
							<div class="filter-right">
								<div class="slant"></div>
								<form action="">
									<select name="" id="">
										<option value="">Pet Type</option>
									</select>
									<select name="" id="">
										<option value="">Pet Breed</option>
									</select>
									<select name="" id="">
									<option value="">Location</option>
									</select>
									<button type="submit">SEARCH NOW</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="sliderwrap">
				<div class="container">
					<h2 class="text-center">Latest Pet Sale</h2>

					<div class="slidewrap">
					<!-- Slider main container -->
					<div id="petslider" class="swiper-container">
						<!-- Additional required wrapper -->
						<div class="swiper-wrapper">
							<!-- Slides -->
							<div class="swiper-slide">
								<div class="item-slide">
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/cat.png' ) ); ?>" alt="">
									<h3>Lorem Ipsum</h3>
									<h3>£300</h3>
									<a href="#" class="btn">Click Here</a>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="item-slide">
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/cat.png' ) ); ?>" alt="">
									<h3>Lorem Ipsum</h3>
									<h3>£300</h3>
									<a href="#" class="btn">Click Here</a>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="item-slide">
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/cat.png' ) ); ?>" alt="">
									<h3>Lorem Ipsum</h3>
									<h3>£300</h3>
									<a href="#" class="btn">Click Here</a>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="item-slide">
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/cat.png' ) ); ?>" alt="">
									<h3>Lorem Ipsum</h3>
									<h3>£300</h3>
									<a href="#" class="btn">Click Here</a>
								</div>
							</div>
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
							nextEl: '#petslider-prev',
							prevEl: '#petslider-next',
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
				</div>
			</div>

			<div class="sliderwrap mt100">
				<div class="container">
					<h2 class="text-center">Latest Pet Sale</h2>

					<div class="slidewrap">
					<!-- Slider main container -->
					<div id="productslider" class="swiper-container product-slider">
						<!-- Additional required wrapper -->
						<div class="swiper-wrapper">
							<!-- Slides -->
							<div class="swiper-slide">
								<div class="item-slide">
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/dogfood.png' ) ); ?>" alt="">
									<h3>Lorem Ipsum</h3>
									<h3>£300</h3>
									<a href="#" class="btn">Click Here</a>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="item-slide">
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/dogfood.png' ) ); ?>" alt="">
									<h3>Lorem Ipsum</h3>
									<h3>£300</h3>
									<a href="#" class="btn">Click Here</a>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="item-slide">
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/dogfood.png' ) ); ?>" alt="">
									<h3>Lorem Ipsum</h3>
									<h3>£300</h3>
									<a href="#" class="btn">Click Here</a>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="item-slide">
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/dogfood.png' ) ); ?>" alt="">
									<h3>Lorem Ipsum</h3>
									<h3>£300</h3>
									<a href="#" class="btn">Click Here</a>
								</div>
							</div>
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
							nextEl: '#product-prev',
							prevEl: '#product-next',
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
				</div>
			</div>

			<div class="container mt100">
				<div class="gray-bg-link">
					<a href="#"><img src="<?php echo esc_url( get_theme_file_uri( '/images/pethouse.png' ) ); ?>" alt=""> See all our PetDeals</a>
				</div>
			</div>

			<div class="welcome-section">
				<h2 class="section-title">Welcome to Pet Deals</h2>
				<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
			</div>

			<div class="container">
				<div class="grid three-columns">
					<div>
						<div class="service-item">
							<figure>
								<img src="<?php echo esc_url( get_theme_file_uri( '/images/d1.png' ) ); ?>" alt="">
							</figure>
							<h3>Who we are</h3>
							<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.
							<a href="#" class="circle-arrow"><img src="<?php echo esc_url( get_theme_file_uri( '/images/circle-arrow.png' ) ); ?>" alt=""></a>
						</div>
					</div>
					<div>
						<div class="service-item">
							<figure>
								<img src="<?php echo esc_url( get_theme_file_uri( '/images/d2.png' ) ); ?>" alt="">
							</figure>
							<h3>How we work</h3>
							<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
							<a href="#" class="circle-arrow"><img src="<?php echo esc_url( get_theme_file_uri( '/images/circle-arrow.png' ) ); ?>" alt=""></a>
						</div>
					</div>
					<div>
						<div class="service-item">
							<figure>
								<img src="<?php echo esc_url( get_theme_file_uri( '/images/d3.png' ) ); ?>" alt="">
							</figure>
							<h3>Best Services</h3>
							<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
							<a href="#" class="circle-arrow"><img src="<?php echo esc_url( get_theme_file_uri( '/images/circle-arrow.png' ) ); ?>" alt=""></a>
						</div>
					</div>
				</div>
			</div>

			<div class="welcome-section">
				<h2 class="section-title">Services we offer</h2>
			</div>

			<div class="container">
				<div class="grid four-columns">
					<div>
						<div class="offer-item">
							<figure>
								<img src="<?php echo esc_url( get_theme_file_uri( '/images/s1.png' ) ); ?>" alt="">
							</figure>
							<h3>Lorem Ipsum</h3>
							<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
							<div class="clear"></div>
							<a href="#">Learn More</a>
						</div>
					</div>
					<div>
						<div class="offer-item">
							<figure>
								<img src="<?php echo esc_url( get_theme_file_uri( '/images/s2.png' ) ); ?>" alt="">
							</figure>
							<h3>Lorem Ipsum</h3>
							<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
							<div class="clear"></div>
							<a href="#">Learn More</a>
						</div>
					</div>
					<div>
						<div class="offer-item">
							<figure>
								<img src="<?php echo esc_url( get_theme_file_uri( '/images/s3.png' ) ); ?>" alt="">
							</figure>
							<h3>Lorem Ipsum</h3>
							<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
							<div class="clear"></div>
							<div class="clear"></div>
							<a href="#">Learn More</a>
						</div>
					</div>
					<div>
						<div class="offer-item">
							<figure>
								<img src="<?php echo esc_url( get_theme_file_uri( '/images/s4.png' ) ); ?>" alt="">
							</figure>
							<h3>Lorem Ipsum</h3>
							<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
							<div class="clear"></div>
							<a href="#">Learn More</a>
						</div>
					</div>
				</div>
			</div>

			<div class="blue-bg">
				<div class="container">
					<div class="testimonial-wrap">
						<div class="testislider">
							<div>
								<div class="testi-item">
									<p class="testi-content">Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/five-paws.png' ) ); ?>" alt="">
									<p class="testi-name">Nick Karvournis <span>Student</span></p>
								</div>
							</div>
							<div>
								<div class="testi-item">
									<p class="testi-content">Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/five-paws.png' ) ); ?>" alt="">
									<p class="testi-name">Nick Karvournis <span>Student</span></p>
								</div>
							</div>
							<div>
								<div class="testi-item">
									<p class="testi-content">Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
									<img src="<?php echo esc_url( get_theme_file_uri( '/images/five-paws.png' ) ); ?>" alt="">
									<p class="testi-name">Nick Karvournis <span>Student</span></p>
								</div>
							</div>
						</div>
						<script>
							jQuery(document).ready(function( $ ) {
								$('.testislider').slick({
									dots: false
								});
							});
						</script>
					</div>
				</div>
			</div>

			<div class="choose-us-section">
				<div class="container">
					<h2>WHY CHOOSE US</h2>
					<div class="choose-items">
						<div class="top left">
							<div class="choose-item">
								<div class="num">1</div>
								<h3>Friendly<span>support</span></h3>
								<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
							</div>
						</div>
						<div class="top right">
							<div class="choose-item">
								<div class="num">3</div>
								<h3>Quality<span>services</span></h3>
								<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
							</div>
						</div>
						<div class="center-left">
							<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
						</div>
						<div class="center-right">
							<p>Lorem ipsum dolor sit amet, quo ex deleniti prodesset, usu ea quod dicunt suavitate. Eu mea idque oporteat instructior.</p>
						</div>
						<div class="center-dog">
							<img src="<?php echo esc_url( get_theme_file_uri( '/images/puppy-basket.png' ) ); ?>" alt="">
						</div>
						<div class="bottom left">
							<div class="choose-item">
								<div class="num">2</div>
								<h3>Professional<span>team</span></h3>
							</div>
						</div>
						<div class="bottom right">
							<div class="choose-item">
								<div class="num">4</div>
								<h3>Quality<span>services</span></h3>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="welcome-section">
				<h2 class="section-title">Our Blogs</h2>
			</div>

			<div class="container">
				<div class="grid three-columns bloglist">
					<div>
						<div class="post-card">
							<a href="#">
							<div class="post-date">
								<span class="day">22</span><span class="month">Jan</span>
							</div>
								<img src="<?php echo esc_url( get_theme_file_uri( '/images/f1.png' ) ); ?>" alt="">
							</a>
							<a href="#"><h3>Lorem Ipsum</h3></a>
							<p>Adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							<hr>
						</div>
					</div>
					<div>
						<div class="post-card">
							<a href="#">
							<div class="post-date">
								<span class="day">22</span><span class="month">Jan</span>
							</div>
								<img src="<?php echo esc_url( get_theme_file_uri( '/images/f1.png' ) ); ?>" alt="">
							</a>
							<a href="#"><h3>Lorem Ipsum</h3></a>
							<p>Adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							<hr>
						</div>
					</div>
					<div>
						<div class="post-card">
							<a href="#">
							<div class="post-date">
								<span class="day">22</span><span class="month">Jan</span>
							</div>
								<img src="<?php echo esc_url( get_theme_file_uri( '/images/f1.png' ) ); ?>" alt="">
							</a>
							<a href="#"><h3>Lorem Ipsum</h3></a>
							<p>Adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							<hr>
						</div>
					</div>
				</div>
			</div>

			<?php
		endwhile; // End of the loop.
		?>
		<?php the_posts_navigation(); ?>

	</main><!-- #primary -->

<?php
get_footer();
