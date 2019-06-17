<?php
/**
 * Swiper Slider
 *
 * Most modern mobile touch slider and framework with hardware accelerated transitions.
 *
 * @link https://www.idangero.us/swiper/
 *
 * @package wprig
 */

/**
 * Main Swiper Class.
 */
class BJE_Swiper {
	/**
	 * Main function. Runs everything.
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'swiper' ) );
		add_action( 'wp_head', array( $this, 'swiper_add_body_style' ) );
	}
	/**
	 * Main function. Runs everything.
	 */
	public function swiper() {

		// If this is the admin page, do nothing.
		if ( is_admin() ) {
			return;
		}
		add_action( 'wp_enqueue_scripts', array( $this, 'swiper_styles' ) );
	}


	/**
	 * Enqueue and defer lazyload script.
	 */
	public function swiper_styles() {
		wp_register_style( 'wprig-swiper-style', '//cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css', array(), '20190131' );

		if ( is_front_page() || is_product() || is_singular( 'ad' ) || is_shop() || is_tax( 'product_cat' ) ) {
			wp_enqueue_script( 'wprig-swiper-js', '//cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js', array(), '4.5.0', false );
		}
	}

	/**
	 * Adds preload for in-body stylesheets depending on what templates are being used.
	 * Disabled when AMP is active as AMP injects the stylesheets inline.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
	 */
	public function swiper_add_body_style() {

		// If AMP is active, do nothing.
		if ( wprig_is_amp() ) {
			return;
		}

		// Get registered styles.
		$wp_styles = wp_styles();

		$preloads = array();

		// Preload front-page.css.
		global $template;
		if ( 'front-page.php' === basename( $template ) ) {
			$preloads['wprig-swiper-style'] = wprig_get_preload_stylesheet_uri( $wp_styles, 'wprig-swiper-style' );
		}

		// Output the preload markup in <head>.
		foreach ( $preloads as $handle => $src ) {
			echo '<link rel="preload" id="' . esc_attr( $handle ) . '-preload" href="' . esc_url( $src ) . '" as="style" />';
			echo "\n";
		}
	}
}

$swiper = new BJE_Swiper();
