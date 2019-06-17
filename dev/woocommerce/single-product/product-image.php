<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
$attachment_ids = $product->get_gallery_image_ids();
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
.gallery-top {
	width: 100%;
	overflow: hidden;
	position: relative;
}
.gallery-thumbs {
	height: 100px;
	box-sizing: border-box;
	padding: 10px 0;
	overflow: hidden;
}
.gallery-thumbs .swiper-slide {
	width: 100%;
	height: 100%;
	opacity: 0.4;
}
.gallery-thumbs .swiper-slide-thumb-active {
	opacity: 1;
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
		<div class="swiper-slide">
			<img src="<?php echo esc_url( wp_get_attachment_image_src( $product->get_image_id(), 'full' )[0] ); ?>" alt="">
		</div>
		<?php
		if ( $attachment_ids ) :
			foreach ( $attachment_ids as $attachment_id ) {
				?>
				<div class="swiper-slide">
					<img src="<?php echo esc_url( wp_get_attachment_image_src( $attachment_id, 'full' )[0] ); ?>" alt="">
				</div>
				<?php
			}
			?>
		<?php endif; ?>
	</div>
	<!-- Add Arrows -->
	<div class="swiper-button-next swiper-button-white"></div>
	<div class="swiper-button-prev swiper-button-white"></div>
</div>
<div class="swiper-product-container gallery-thumbs">
	<div class="swiper-wrapper">
		<div class="swiper-slide" style="background-image: url( <?php echo esc_url( wp_get_attachment_image_src( $product->get_image_id(), 'thumbnail' )[0] ); ?> );"></div>
		<?php
		if ( $attachment_ids ) :
			foreach ( $attachment_ids as $attachment_id ) {
				?>
				<div class="swiper-slide" style="background-image: url( <?php echo esc_url( wp_get_attachment_image_src( $attachment_id, 'full' )[0] ); ?> );"></div>
				<?php
			}
			?>
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
	autoHeight: true,
	navigation: {
	nextEl: '.swiper-button-next',
	prevEl: '.swiper-button-prev',
	},
	thumbs: {
	swiper: galleryThumbs
	}
});
</script>
