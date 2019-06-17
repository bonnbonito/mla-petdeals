<?php
/**
 * Template part for displaying ad slider
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wprig
 */

?>
<style>
.swiper-container {
	width: 100%;
	height: auto;
	margin-left: auto;
	margin-right: auto;
}
.swiper-slide {
	background-size: cover;
	background-position: center;
}
.swiper-slide img {
	margin: auto;
}
.gallery-top {
	width: 100%;
	overflow: hidden;
	position: relative;
}
.gallery-top img {
	width: 100%;
}
.gallery-thumbs {
	height: 150px;
	box-sizing: border-box;
	padding: 10px 0;
	overflow: hidden;
}
.gallery-thumbs .swiper-slide {
	width: auto;
	height: auto;
	opacity: 0.4;
}
.gallery-thumbs .swiper-slide-thumb-active {
	opacity: 1;
}

.swiper-wrapper.swiper-wrapper {
	align-items: center;
}

@media ( max-width: 980px ) {
	.gallery-thumbs {
		height: 150px;
	}
	.gallery-thumbs .swiper-slide {
		width: 150px;
		height: 150px;
	}
}
</style>
<div class="swiper-product-container gallery-top">
	<div class="swiper-wrapper">
		<?php if ( get_field( 'image_1' ) ) : ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( get_field( 'image_1' )['url'] ); ?>" alt="">
			</div>
		<?php endif; ?>
		<?php if ( get_field( 'image_2' ) ) : ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( get_field( 'image_2' )['url'] ); ?>" alt="">
			</div>
		<?php endif; ?>
		<?php if ( get_field( 'image_3' ) ) : ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( get_field( 'image_3' )['url'] ); ?>" alt="">
			</div>
		<?php endif; ?>
		<?php if ( get_field( 'image_4' ) ) : ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( get_field( 'image_4' )['url'] ); ?>" alt="">
			</div>
		<?php endif; ?>
		<?php if ( get_field( 'image_5' ) ) : ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( get_field( 'image_5' )['url'] ); ?>" alt="">
			</div>
		<?php endif; ?>
	</div>
	<!-- Add Arrows -->
	<div class="swiper-button-next swiper-button-black"></div>
	<div class="swiper-button-prev swiper-button-black"></div>
</div>
<div class="swiper-product-container gallery-thumbs">
	<div class="swiper-wrapper">
		<?php if ( get_field( 'image_1' ) ) : ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( get_field( 'image_1' )['sizes']['thumbnail'] ); ?>" alt="">
			</div>
		<?php endif; ?>
		<?php if ( get_field( 'image_2' ) ) : ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( get_field( 'image_2' )['sizes']['thumbnail'] ); ?>" alt="">
			</div>
		<?php endif; ?>
		<?php if ( get_field( 'image_3' ) ) : ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( get_field( 'image_3' )['sizes']['thumbnail'] ); ?>" alt="">
			</div>
		<?php endif; ?>
		<?php if ( get_field( 'image_4' ) ) : ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( get_field( 'image_4' )['sizes']['thumbnail'] ); ?>" alt="">
			</div>
		<?php endif; ?>
		<?php if ( get_field( 'image_5' ) ) : ?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url( get_field( 'image_5' )['sizes']['thumbnail'] ); ?>" alt="">
			</div>
		<?php endif; ?>
	</div>
</div>
<script>
var galleryThumbs = new Swiper('.gallery-thumbs', {
	spaceBetween: 10,
	slidesPerView: 4,
	freeMode: true,
	watchSlidesVisibility: true,
	watchSlidesProgress: true,
});
var galleryTop = new Swiper('.gallery-top', {
	spaceBetween: 10,
	navigation: {
	nextEl: '.swiper-button-next',
	prevEl: '.swiper-button-prev',
	},
	thumbs: {
	swiper: galleryThumbs
	}
});
</script>
