<?php
/**
 * Template part for displaying page content in page-register.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

?>

<div class="header-dog-imgs">
	<div class="container">
		<?php the_title( '<h2 class="title-head">', '</h2>' ); ?>
	</div>
</div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="container">

	<div class="reg-wrap">
		<div class="register-slant"></div>
		<img src="<?php echo esc_url( get_theme_file_uri( '/images/reg-dog.png' ) ); ?>" alt="" class="reg-dog">
		<div class="register-wrap">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<hr class="hr-blue">

			<h3>Private sellers only less than 3 adverts a year<br>per account.</h3>

			<div id="register-status"></div>

			<form id="pet-form" class="pet-form" name="pet-form" class="nobottommargin" action="#" method="post" autocomplete="off">
				<div class="loading-overlay">
					<div class="loader-wrap">
						<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
					</div>
				</div>
				<select name="account_type" id="account_type" style="padding: .2em .6em; margin-bottom: 2rem;">
					<option value="private-seller">ACCOUNT TYPE</option>
					<option value="private-seller" selected>Private Seller</option>
				</select>
				<div class="col_2">
					<div class="group">
						<input type="text" id="pet-form-fname" name="pet-form-fname" required>
						<span class="highlight"></span>
						<span class="bar"></span>
						<label>First Name</label>
					</div>

					<div class="group">
						<input type="text" id="pet-form-lname" name="pet-form-lname" required>
						<span class="highlight"></span>
						<span class="bar"></span>
						<label>Last Name</label>
					</div>
				</div>

				<div class="group">
					<input type="text" id="pet-form-tel" name="pet-form-tel" required>
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Telephone Number</label>
				</div>

				<div class="group">
					<input type="text" id="pet-form-email" name="pet-form-email" required>
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Email Address</label>
				</div>

				<div class="group">
					<input type="password" id="pet-form-password" name="pet-form-password" required  autocomplete="off">
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Password:</label>
					<span id="password-strength"></span><span id="pass-review">(Strong passwords includes numbers, symbols, capital letters, and lower-case letters)</span>
				</div>

				<div class="group">
					<input type="password" id="pet-form-repassword" name="pet-form-repassword" required>
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Re-enter Password:</label>
				</div>

				<?php wp_nonce_field( 'pet_auth', '_wpnonce' ); ?>

				<div class="check-privacy">
					<div class="check-container">
						<input type="checkbox" name="agree" required id="agree-privacy" value="1">
						<span class="checkmark"></span>
					</div>
					<label for="agree-privacy">I agree to the <a href="">Terms & Condition</a> and <a href="#">Privacy Policy</a></label>
				</div>

				<div class="check-privacy">
					<div class="check-container">
						<input type="checkbox" name="subscribe" id="subscribe-newsletter" value="1">
						<span class="checkmark"></span>
					</div>
					<label for="subscribe-newsletter">Subscribe to our newsletter.</label>
				</div>

				<div class="space"></div>

				<button type="submit" class="yellow btn" id="pet-form-submit" name="pet-form-submit">Create my account</button>

			</form>

		</div>
	</div>



	</div><!-- .container -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				wprig_edit_post_link();
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
