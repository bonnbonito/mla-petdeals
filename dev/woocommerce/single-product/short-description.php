<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">
	<h2>Information</h2>
	<?php echo $short_description; // WPCS: XSS ok. ?>
	<div class="social-share">
		<?php $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
		<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
		<a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $featured_img_url; ?>&description=<?php the_excerpt(); ?>" target="_blank"><i class="fab fa-pinterest"></i></a>
	</div>
</div>
