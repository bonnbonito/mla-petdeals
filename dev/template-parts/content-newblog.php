<?php
/**
 * Template part for displaying new blogs.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

?>

<div class="welcome-section">
	<h2 class="section-title">Our Blogs</h2>
</div>
<?php
$blog = new WP_QUERY( array(
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
));
?>
<div class="container">
	<?php if ( $blog->have_posts() ) : ?>
	<div class="grid three-columns bloglist">
		<?php
		while ( $blog->have_posts() ) :
			$blog->the_post();
			?>
		<div>
			<div class="post-card">
				<a href="<?php the_permalink(); ?>">
				<div class="post-date">
					<span class="day"><?php echo get_the_date( 'j' ); ?></span><span class="month"><?php echo get_the_date( 'M' ); ?></span>
				</div>
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'medium' ); ?>
						<?php else : ?>
						<div class="img-placeholder"></div>
					<?php endif; ?>
				</a>
				<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
				<p><?php the_excerpt(); ?></p>
				<hr>
			</div>
		</div>
			<?php
			endwhile;
			wp_reset_postdata();
?>
	</div>
	<?php endif; ?>
</div>
