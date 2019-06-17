<?php
/**
 * Template part for displaying page content in single-ad.php
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

		<div class="product-wrap">

			<div class="product-left">
				<?php get_template_part( 'template-parts/ad', 'slider' ); ?>
			</div>

			<div class="product-right">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<hr class="black">
				<h2 class="ad-price">£<?php the_field( 'asking_price' ); ?></h2>
				<div class="seller-wrap">

					<div class="seller-img">
						<img src="<?php echo esc_url( get_theme_file_uri( '/images/user.png' ) ); ?>" alt="">
					</div>
					<div class="seller-name">
						<h3><?php the_field( 'seller_name' ); ?></h3>
						<p>Private Seller</p>
					</div>

				</div>

				<div class="ad-meta">
					<p><span>LOCATION:</span> <?php echo esc_html( get_field( 'contact_details' )['address'] ); ?></p>
				</div>

				<a href="mailto:<?php the_field( 'seller_email' ); ?>" class="btn yellow huge block">Email Us</a>
				<a href="tel:<?php the_field( 'seller_telephone' ); ?>" class="btn yellow huge block">Call Us: <?php the_field( 'seller_telephone' ); ?></a>


				<hr>
				<?php
				$fave_exist = new WP_Query( array(
					'post_type'  => 'favorite',
					'author'     => get_current_user_id(),
					'meta_query' => array(
						array(
							'key'     => 'favorite_ad_id',
							'compare' => '=',
							'value'   => get_the_ID(),
						),
					),
				));
				?>
				<button id="favorite" class="yellow btn" data-faveid="<?php echo esc_attr( $fave_exist->found_posts > 0 ? esc_attr( $fave_exist->posts[0]->ID ) : '' ); ?>" data-id="<?php the_ID(); ?>" data-favorite="<?php echo esc_attr( $fave_exist->found_posts > 0 ? 'yes' : 'no' ); ?>"><?php echo esc_html( $fave_exist->found_posts > 0 ? 'REMOVE TO ' : 'SAVE TO ' ); ?>FAVORTIES</button>
				<a href="#report" id="showreport" class="yellow btn wide">REPORT</a>
				<?php the_content(); ?>

				<div class="ad-meta light">
					<p><span>Categories:</span> <a href="#">Breed</a></p>
				</div>

			</div>

		</div>

	</div>

	<div class="description-section">
		<div class="container">

			<div class="reportform-on" id="report" style="display: none;">

				<p style="text-align: right;"><a href="" id="closereport" title="Close Form" ><i class="far fa-times-circle"></i></a></p>

				<?php echo do_shortcode( '[contact-form-7 id="193" title="Report Form"]' ); ?>

			</div>

			<div class="reportform-off">

				<h2>Description</h2>


				<?php the_field( 'description' ); ?>

				&nbsp;

				<h3 style="color: #3dc6f0;">KEY ADVERT FACTS</h3>

				<ul class="advert-facts">
					<li>Ad reference : <?php echo esc_html( get_the_ID() ); ?></li>
					<li>Advert Type: <?php echo esc_html( get_field( 'advert_type' ) ? get_field( 'advert_type' ) : '' ); ?> </li>
					<li>Pet Type: <span style="text-transform: capitalize;"><?php echo esc_html( get_field( 'pet_type' ) ? get_field( 'pet_type' ) : '' ); ?></span></li>
					<li>Pet Breed: <?php echo ( get_field( 'pet_breed' ) ? esc_html( get_field( 'pet_breed' ) ) : '' ); ?></li>
					<?php if ( get_field( 'date_of_birth' ) ) : ?>
					<li>Age: <?php echo esc_html( get_age() ); ?> old</li>
					<?php endif; ?>
					<li>Council Licenced: <?php echo esc_html( get_field( 'advert_type' ) ? 'Yes' : 'No' ); ?></li>
					<li>Microchipped: <?php echo esc_html( get_field( 'microchipped' ) ? 'Yes' : 'No' ); ?></li>
					<li>Neutered: <?php echo esc_html( get_field( 'neutered' ) ? 'Yes' : 'No' ); ?></li>
					<li>Vaccinations Up-to-date: <?php echo esc_html( get_field( 'vaccinations_up_to_date' ) ? 'Yes' : 'No' ); ?></li>
					<li>KC registered: <?php echo esc_html( get_field( 'kc_registered' ) ? 'Yes' : 'No' ); ?></li>
				</ul>

				<hr>

				<?php

				$pet_type =  get_field( 'pet_type' );

				$pet = get_page_by_path( $pet_type, OBJECT, 'pet' );

				?>


				<h2><?php echo get_the_title( $pet->ID ); ?> Buying Checklist</h2>

				<?php the_field( 'buying_checklist', $pet->ID ); ?>

			</div>

		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
<script>
	jQuery( document ).ready( function( $ ) {
		var report = 0;
		$( '#showreport' ).on( 'click', function(){
			if ( report == 0) {
				report = 1;
				$( '.reportform-off' ).hide();
				$( '.reportform-on' ).show();
			}
		});
		$( '#closereport' ).on( 'click', function( e ){
			e.preventDefault();
			if ( report == 1) {
				report = 0;
				$( '.reportform-off' ).show();
				$( '.reportform-on' ).hide();
			}
		});
	});
</script>
