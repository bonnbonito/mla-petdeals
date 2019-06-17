<?php
/**
 * Template part for displaying dashboard edit Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

global $current_user;
$id = sanitize_text_field( get_query_var( 'ad_id' ) );
$ad_author_id = get_post_field( 'post_author', $id );

if ( $id ) :

	if ( get_post_status( $id ) ) :

		if ( sanitize_text_field( get_current_user_id() ) === $ad_author_id ) :
			?>

			<h3>Editing <?php echo esc_html( get_the_title( $id ) ); ?></h3>
			<?php
			get_template_part( 'template-parts/ad', 'edit' );

		else :
			?>

			<h2>You cannot edit this AD.</h2>

			<?php

		endif;

	else :
		?>

		<h2>Ad not found</h2>

		<?php

	endif;

	else :
		$args = array(
			'post_type'      => 'ad',
			'posts_per_page' => -1,
			'author'         => get_current_user_id(),
			'post_status'    => array( 'publish', 'pending' ),
		);
		$ads_query = new WP_Query( $args );
		if ( $ads_query->have_posts() ) :
			?>
		<div class="manage-ads-list">
			<?php
			while ( $ads_query->have_posts() ) :
				$ads_query->the_post();
				?>
				<div class="manage-item">
					<div class="pet_img">
						<?php if ( 'pending' == get_post_status( $post->ID ) ) { ?>
						<a title="Not yet published.">
						<?php } else { ?>
						<a href="<?php the_permalink(); ?>">
						<?php } ?>
							<img src="<?php echo esc_url( get_field( 'image_1' )['sizes']['thumbnail'] ); ?>" alt="<?php the_title(); ?> Image" />
						</a>
					</div>
					<div class="pet_details">
						<?php if ( 'pending' == get_post_status( $post->ID ) ) { ?>
						<a title="Not yet published.">
						<?php } else { ?>
						<a href="<?php the_permalink(); ?>">
						<?php } ?>
							<h2><?php the_title(); ?></h2>
						</a>
						<div class="pet_description">
							<?php the_field( 'description' ); ?>
						</div>

						<p class="status">STATUS: <?php echo esc_html( get_post_status( $post->ID ) === 'publish' ? 'APPROVED' : 'PENDING' ); ?></p>

						<div class="manage-footer">
						<p class="location">LOCATION: <?php echo esc_html( get_field( 'contact_details' )['address'] ); ?></p>
						<div class="manage-btn">
							<a class="yellow btn fluid" href="<?php echo esc_url( get_home_url() ); ?>/my-account/manage-ads?ad_id=<?php echo esc_attr( $post->ID ); ?>">MANAGE AD</a>
						</div>
						</div>
					</div>

				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
			<?php
			else :
				?>
			<h2>No Ads Yet. <a href="<?php echo esc_url( home_url( '/my-account/new-ad' ) ); ?>">Create one</a></h2>
				<?php
		endif;
endif;
