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
					<?php
					$user_id = get_the_author_meta( 'ID' );
					$avatar = get_user_meta( $user_id, 'avatar', true );
					if ( $avatar ) :
						?>
						<img src="<?php echo esc_url( wp_get_attachment_image_src( $avatar )[0] ); ?>" alt="<?php echo esc_attr( get_the_author_meta( 'display_name' ) ); ?>">
						<?php
					else :
						?>
						<img src="<?php echo esc_url( get_theme_file_uri( '/images/user.png' ) ); ?>" alt="">
					<?php endif; ?>
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

		<div class="reportform-on" id="report" style="display: none;">
			<div class="container">
				<p style="text-align: right;"><a href="" id="closereport" title="Close Form" ><i class="far fa-times-circle"></i></a></p>

				<?php echo do_shortcode( '[contact-form-7 id="193" title="Report Form"]' ); ?>

			</div>
		</div>

		<div class="reportform-off">

			<div class="container">

			<h2>Description</h2>


			<?php the_field( 'description' ); ?>

			&nbsp;

			</div>


			<div class="key-wrap">

				<div class="container">

				<table class="advert-facts">
					<thead>
						<tr>
							<td colspan="2"><h3 style="color: #fff; text-align: center;">KEY ADVERT FACTS</h3></td>
						</tr>
					</thead>
					<tr>
						<td><strong>Ad reference :</strong></td>
						<td><?php echo esc_html( get_the_ID() ); ?></td>
					</tr>
					<tr>
						<td><strong>Advert Type:</strong></td>
						<td> <?php echo esc_html( get_field( 'advert_type' ) ? get_field( 'advert_type' ) : '' ); ?></td>
					</tr>
					<tr>
						<td><strong>Pet Type:</strong></td>
						<td><span style="text-transform: capitalize;"><?php echo esc_html( get_field( 'pet_type' ) ? get_field( 'pet_type' ) : '' ); ?></span></td>
					</tr>
					<tr>
						<td><strong>Pet Breed:</strong></td>
						<td><?php echo ( get_field( 'pet_breed' ) ? esc_html( get_field( 'pet_breed' ) ) : '' ); ?></td>
					</tr>
					<?php if ( get_field( 'date_of_birth' ) ) : ?>
					<tr>
						<td><strong>Age:</strong></td>
						<td><?php echo esc_html( get_age()); ?> old</td>
					</tr>
					<?php endif; ?>
					<tr>
						<td><strong>Microchipped:</strong></td>
						<td><?php echo esc_html( get_field( 'microchipped' ) ? 'Yes' : 'No' ); ?> <a href="#" id="microshipped-modal">(More Info)</a></td>
					</tr>
					<tr>
						<td><strong>Neutered:</td>
						<td><?php echo esc_html( get_field( 'neutered' ) ? 'Yes' : 'No' ); ?> <a href="#" id="neutered-modal">(More Info)</a></td>
					</tr>
					<tr>
						<td><strong>Vaccinations Up-to-date:</strong></td>
						<td><?php echo esc_html( get_field( 'vaccinations_up_to_date' ) ? 'Yes' : 'No' ); ?> <a href="#" id="vaccinations-modal">(More Info)</a></td>
					</tr>
					<tr>
						<td><strong><?php echo esc_html( 'dogs' == get_field( 'pet_type' ) ? 'KC registered' : 'Registered' ); ?>:</strong></td>
						<td><?php echo esc_html( get_field( 'kc_registered' ) ? 'Yes' : 'No' ); ?> <a href="#" id="registered-modal">(More Info)</a></td>
					</tr>
				</table>

				</div>

			</div>

			<div class="container">
			<?php

				$pet_type =  get_field( 'pet_type' );

				$pet = get_page_by_path( $pet_type, OBJECT, 'pet' );
				if ( $pet ) :
					?>
				<h2><?php echo get_the_title( $pet->ID ); ?> Buying Checklist</h2>

					<?php
					the_field( 'buying_checklist', $pet->ID );
				endif;
				?>

			</div>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
<div class="ui modal" id="microchipped-wrap">
	<i class="close icon"></i>
	<div class="header">
	Microchipped
	</div>
	<div class="content">
	<div class="description">
		<?php the_field( 'microchipped_content', 'option' ) ?>
	</div>
	</div>
	<div class="actions">
	<button class="yellow btn closemodal" style="margin-bottom: 0;">OK</button>
	</div>
</div>
<div class="ui modal" id="neutered-wrap">
	<i class="close icon"></i>
	<div class="header">
	Neutered
	</div>
	<div class="content">
	<div class="description">
		<?php the_field( 'neutered_content', 'option' ) ?>
	</div>
	</div>
	<div class="actions">
	<button class="yellow btn closemodal" style="margin-bottom: 0;">OK</button>
	</div>
</div>
<div class="ui modal" id="vaccinations-wrap">
	<i class="close icon"></i>
	<div class="header">
	Vaccinations
	</div>
	<div class="content">
	<div class="description">
		<?php the_field( 'vaccinations_content', 'option' ) ?>
	</div>
	</div>
	<div class="actions">
	<button class="yellow btn closemodal" style="margin-bottom: 0;">OK</button>
	</div>
</div>
<div class="ui modal" id="registered-wrap">
	<i class="close icon"></i>
	<div class="header">
	Registered
	</div>
	<div class="content">
	<div class="description">
		<?php the_field( 'registered_content', 'option' ) ?>
	</div>
	</div>
	<div class="actions">
	<button class="yellow btn closemodal" style="margin-bottom: 0;">OK</button>
	</div>
</div>
<script>
	jQuery( document ).ready( function( $ ) {
		$( '#microshipped-modal' ).on( 'click', function( e ) {
			e.preventDefault();
			$( '#microchipped-wrap' ).modal( 'show' );
		});
		$( '#registered-modal' ).on( 'click', function( e ) {
			e.preventDefault();
			$( '#registered-wrap' ).modal( 'show' );
		});
		$( '#vaccinations-modal' ).on( 'click', function( e ) {
			e.preventDefault();
			$( '#vaccinations-wrap' ).modal( 'show' );
		});
		$( '#neutered-modal' ).on( 'click', function( e ) {
			e.preventDefault();
			$( '#neutered-wrap' ).modal( 'show' );
		});
		$( '.modal' ).modal({
			closable: true
		});
		$( '.closemodal' ).on( 'click', function(){
			$( this ).closest( '.ui.modal' ).modal( 'hide' );
		} );
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
