<?php
/**
 * The template for displaying all single ad
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wprig
 */

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
			wp_print_styles( array( 'wprig-content', 'wprig-swiper-style' ) ); // Note: If this was already done it will be skipped.

			get_template_part( 'template-parts/content', get_post_type() );

		endwhile; // End of the loop.
		?>

		<div class="best-selling-products">

			<div class="container">

				<h2 style="text-align: center;">BEST SELLERS</h2>

				<?php echo do_shortcode( '[products limit="4" columns="4" orderby="popularity" class="no-heart" on_sale="true" ]' ); ?>

			</div>

		</div>



		<?php get_template_part( 'template-parts/content', 'newblog' ); ?>

	</main><!-- #primary -->

<?php
get_footer();
