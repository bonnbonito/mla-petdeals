<?php
/**
 * The template for displaying blog pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

get_header(); ?>

	<main id="primary" class="site-main">

	<div class="header-dog-imgs">
		<div class="container">
			<h2 class="title-head">News</h2>
		</div>
	</div>

		<div class="container">

			<div class="blog-list">

				<?php
				while ( have_posts() ) :
					the_post();

					/*
					* Include the component stylesheet for the content.
					* This call runs only once on index and archive pages.
					* At some point, override functionality should be built in similar to the template part below.
					*/
					wp_print_styles( array( 'wprig-content' ) ); // Note: If this was already done it will be skipped.

					get_template_part( 'template-parts/content', 'blog' );


				endwhile; // End of the loop.
				?>

			</div>

		</div>

	</main><!-- #primary -->

<?php
get_footer();
