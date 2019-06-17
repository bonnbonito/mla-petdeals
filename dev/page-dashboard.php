<?php
/**
 * Template Name: Dashboard
 *
 * @package wprig
 */

if ( ! is_user_logged_in() ) {
	wp_safe_redirect( home_url( '/' ) );
	exit;
}
acf_form_head();
get_header(); ?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			/*
			 * Include the component stylesheet for the content.
			 * This call runs only once on index and archive pages.
			 * At some point, override functionality should be built in similar to the template part below.
			 */
			wp_print_styles( array( 'wprig-content' ) ); // Note: If this was already done it will be skipped.

			get_template_part( 'template-parts/content', 'dashboard' );

		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_footer();
