<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wprig
 */

?>

<footer id="colophon" class="site-footer">
	<div class="yellow-bg">
		<div class="container">
			<div class="subscribe-wrap">
				<div>
					<h3>Subscribe to our newletter</h3>
				</div>
				<div class="subscribeform">
					<form action="">
						<input type="email" placeholder="Enter your email" required>
						<input type="submit" value="Subscribe" class="send-btn">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="footer-top">
			<div class="footer-left">
				<img src="<?php echo esc_url( get_theme_file_uri( '/images/footer-logo.png' ) ); ?>" alt="">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
			</div>
			<div class="footer-right">
				<p class="footer-title">Follow Us</p>
				<ul class="footer-social">
					<a href="#">
						<svg class="svg-icon" viewBox="0 0 20 20">
							<path fill="none" d="M11.344,5.71c0-0.73,0.074-1.122,1.199-1.122h1.502V1.871h-2.404c-2.886,0-3.903,1.36-3.903,3.646v1.765h-1.8V10h1.8v8.128h3.601V10h2.403l0.32-2.718h-2.724L11.344,5.71z"></path>
						</svg>
					</a>
					<a href="#">
						<svg class="svg-icon" viewBox="0 0 20 20">
							<path fill="none" d="M18.258,3.266c-0.693,0.405-1.46,0.698-2.277,0.857c-0.653-0.686-1.586-1.115-2.618-1.115c-1.98,0-3.586,1.581-3.586,3.53c0,0.276,0.031,0.545,0.092,0.805C6.888,7.195,4.245,5.79,2.476,3.654C2.167,4.176,1.99,4.781,1.99,5.429c0,1.224,0.633,2.305,1.596,2.938C2.999,8.349,2.445,8.19,1.961,7.925C1.96,7.94,1.96,7.954,1.96,7.97c0,1.71,1.237,3.138,2.877,3.462c-0.301,0.08-0.617,0.123-0.945,0.123c-0.23,0-0.456-0.021-0.674-0.062c0.456,1.402,1.781,2.422,3.35,2.451c-1.228,0.947-2.773,1.512-4.454,1.512c-0.291,0-0.575-0.016-0.855-0.049c1.588,1,3.473,1.586,5.498,1.586c6.598,0,10.205-5.379,10.205-10.045c0-0.153-0.003-0.305-0.01-0.456c0.7-0.499,1.308-1.12,1.789-1.827c-0.644,0.28-1.334,0.469-2.06,0.555C17.422,4.782,17.99,4.091,18.258,3.266"></path>
						</svg>
					</a>
				</ul>

			</div>
		</div>
		<div class="footer-bottom">
			<nav id="footer-menu" class="footer-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'mobile',
						'menu_id'        => 'mobile-menu',
						'container'      => 'ul',
					)
				);
				?>
			</nav>
			<div class="site-info">
				<p>&copy; PetDeals.co.uk 2019</p>
			</a>
		</div><!-- .site-info -->

		</div>

	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
