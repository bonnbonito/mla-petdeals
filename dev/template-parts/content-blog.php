<?php
/**
 * Template part for displaying page content in blog
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

?>
<div class="blog-box">
	<div class="blog-image">
	<?php the_post_thumbnail( 'medium' ); ?>
	</div>
	<div class="blog-bottom">
		<div class="blog-content">
			<div class="blog-meta">
				<span class="by-author">by Lore Pap</span>
				<span class="by-date"><?php echo get_the_date( 'F, d j' ); ?></span>
			</div>
			<h3><?php the_title(); ?></h3>
			<div class="blog-excerpt">
				<p><?php the_excerpt(); ?></p>
			</div>
		</div>
		<div class="blog-footer">
			<a href="<?php the_permalink(); ?>" class="rm">Read More</a>
		</div>
	</div>
</div>
