<?php
/**
 * Template part for displaying posts
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
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
					wprig_posted_on();
					wprig_posted_by();
				?>
			</div><!-- .entry-meta -->
			<?php
		endif;
		?>
	</header><!-- .entry-header -->

	<?php wprig_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wprig' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wprig' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		wprig_post_categories();
		wprig_post_tags();
		wprig_edit_post_link();
		?>

		<div class="text-center">
			<div class="social-share">
				<?php $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>
				<h3>SHARE: </h3>
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
				<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
				<a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $featured_img_url; ?>&description=<?php the_excerpt(); ?>" target="_blank"><i class="fab fa-pinterest"></i></a>
			</div>

		</div>


	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php
if ( is_singular() ) :
	the_post_navigation(
		array(
			'prev_text' => '<div class="post-navigation-sub"><span>' . esc_html__( 'Previous:', 'wprig' ) . '</span></div>%title',
			'next_text' => '<div class="post-navigation-sub"><span>' . esc_html__( 'Next:', 'wprig' ) . '</span></div>%title',
		)
	);
endif;
