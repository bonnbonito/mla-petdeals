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
					<form action="https://petdeals.us20.list-manage.com/subscribe/post-json?u=9e923c1e05ce439f55d4ef527&amp;id=f3f8dd6936&c=?" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form">
						<input type="email" placeholder="Enter your email" name="EMAIL" id="mce-EMAIL" required>
						<input type="submit" value="Subscribe" class="send-btn" id="mailchimp-send">
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
				<div>
					<p class="footer-title">Follow Us</p>
					<div class="footer-social">
						<a href="#">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="https://www.instagram.com/petdeals.1/" target="_blank">
							<i class="fab fa-instagram"></i>
						</a>
					</div>
					<ul class="cc-cards">
						<li><i class="fab fa-cc-visa"></i></li>
						<li><i class="fab fa-cc-amex"></i></li>
						<li><i class="fab fa-cc-mastercard"></i></li>
					</ul>
				</div>
				<div class="fz12">
					<p class="footer-title" style="color: #000;">PET DEALS LIMITED</p>
					<p>PetDeals Limited is a company registered in England and Wales
with company number 10008494.</p>
					<p><b>Address:</b> 3rd Floor, The Pinnacle, Station Way, Crawley, West Sussex,
				England, RH10 1JH.</p>
					<p><b>Registration Number:</b> 10008494</p>
					<p><b>Tel:</b> 0203 673 7354</p>
					<p><b>Email:</b> info@petdeals.co.uk</p>
				</div>
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
				<p>&copy; PetDeals.co.uk 2019 by OneClick</p>
			</div><!-- .site-info -->
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
