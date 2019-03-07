<?php
/**
 * Lazy-load images.
 *
 * Modified version of Lazy Images module in Jetpack.
 *
 * @link https://github.com/Automattic/jetpack/blob/master/modules/lazy-images/lazy-images.php
 *
 * @package wprig
 */

/**
 * Main function. Runs everything.
 */
function wprig_slick() {

	// If this is the admin page, do nothing.
	if ( is_admin() ) {
		return;
	}

	add_action( 'wp_enqueue_scripts', 'wprig_slick_styles' );
}
add_action( 'wp', 'wprig_slick' );

/**
 * Enqueue and defer lazyload script.
 */
function wprig_slick_styles() {
	wp_register_style( 'wprig-slick-style', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '20190131' );
	wp_register_style( 'wprig-slick-theme', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css', array( 'wprig-slick-style' ), '20190131' );
	wp_register_style( 'wprig-slick-custom', get_theme_file_uri( '/pluggable/slick/css/slick.css' ), array( 'wprig-slick-theme' ), '20190131' );

	if ( is_front_page() || is_singular( 'work' ) || is_singular( 'service' ) ) {
		wp_enqueue_script( 'wprig-slick-js', '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array( 'jquery' ), '1.9.0', false );
		wp_script_add_data( 'wprig-slick-js', 'defer', true );
	}
}

/**
 * Adds preload for in-body stylesheets depending on what templates are being used.
 * Disabled when AMP is active as AMP injects the stylesheets inline.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
 */
function wprig_slick_add_body_style() {

	// If AMP is active, do nothing.
	if ( wprig_is_amp() ) {
		return;
	}

	// Get registered styles.
	$wp_styles = wp_styles();

	$preloads = array();

	// Preload front-page.css.
	global $template;
	if ( 'front-page.php' === basename( $template ) || is_singular( 'work' ) || is_singular( 'service' ) ) {
		$preloads['wprig-slick-style']  = wprig_get_preload_stylesheet_uri( $wp_styles, 'wprig-slick-style' );
		$preloads['wprig-slick-theme']  = wprig_get_preload_stylesheet_uri( $wp_styles, 'wprig-slick-theme' );
		$preloads['wprig-slick-custom'] = wprig_get_preload_stylesheet_uri( $wp_styles, 'wprig-slick-custom' );
	}

	// Output the preload markup in <head>.
	foreach ( $preloads as $handle => $src ) {
		echo '<link rel="preload" id="' . esc_attr( $handle ) . '-preload" href="' . esc_url( $src ) . '" as="style" />';
		echo "\n";
	}

}
add_action( 'wp_head', 'wprig_slick_add_body_style' );
