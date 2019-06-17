<?php
/**
 * Template part for displaying dashboard favorites.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

?>
<?php
$fave_ids = array();
$fave_query = new WP_Query( array(
	'post_type'  => 'favorite',
	'author'     => get_current_user_id(),
));
if ( $fave_query->have_posts() ) :
	while ( $fave_query->have_posts() ) :
		$fave_query->the_post();
		array_push( $fave_ids, $post->ID );
	endwhile;
	wp_reset_postdata();
endif;

if ( $fave_ids ) :
	?>
	<div class="manage-ads-list">
		<?php

		foreach ( $fave_ids as $id ) {
			$ad_id = get_field( 'favorite_ad_id', $id );
			?>
			<div class="manage-item">
				<div class="pet_img">
					<a href="<?php get_the_permalink( $ad_id ); ?>">
						<img src="<?php echo esc_url( get_field( 'image_1', $ad_id )['sizes']['thumbnail'] ); ?>" alt="<?php get_the_title( $ad_id ); ?> Image" />
					</a>
				</div>
				<div class="pet_details">
					<a href="<?php the_permalink(); ?>"><h2><?php echo esc_html( get_the_title( $ad_id ) ); ?></h2></a>
					<div class="pet_description">
						<?php the_field( 'description', $ad_id ); ?>
					</div>

					<div class="manage-footer">
					<p class="location">LOCATION: <?php echo esc_html( get_field( 'contact_details', $ad_id )['address'] ); ?></p>
					<div class="manage-btn">
						<a class="yellow btn fluid delete-fave" href="#" data-ad="<?php echo esc_attr( $id ); ?>">DELETE FAVORITE</a>
					</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php
	else :
		?>
	<h2>No Favorite Ads Yet.</h2>
		<?php
endif;
