<?php
/**
 * Semantic
 *
 * @link https://github.com/Semantic-Org
 *
 * @package wprig
 */

/**
 * Main Semantic Class.
 */
class BJE_Semantic {
	/**
	 * Main function. Runs everything.
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'semantic' ) );
		add_action( 'wp_head', array( $this, 'semantic_add_body_style' ) );
	}
	/**
	 * Main function. Runs everything.
	 */
	public function semantic() {

		// If this is the admin page, do nothing.
		if ( is_admin() ) {
			return;
		}
		add_action( 'wp_enqueue_scripts', array( $this, 'semantic_styles' ) );
	}


	/**
	 * Enqueue and defer lazyload script.
	 */
	public function semantic_styles() {
		wp_register_style( 'wprig-semantic-modal-style', 'https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/modal.min.css', array(), '20192606' );
		wp_register_style( 'wprig-semantic-transition-style', '//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/transition.min.css', array(), '20192606' );
		wp_register_style( 'wprig-semantic-dimmer-style', '//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dimmer.min.css', array(), '20192606' );

		if ( is_singular( 'ad' )) {
			wp_enqueue_script( 'wprig-semantic-js', '//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js', array( 'jquery' ), '20192606', false );
			wp_enqueue_script( 'wprig-semantic-transition-js', '//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/transition.min.js', array( 'jquery', 'wprig-semantic-js' ), '20192606', false );
			wp_enqueue_script( 'wprig-semantic-dimmerf-js', '//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dimmer.min.js', array( 'jquery', 'wprig-semantic-js' ), '20192606', false );
			wp_enqueue_script( 'wprig-semantic-modal-js', '//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/modal.min.js', array( 'jquery', 'wprig-semantic-js' ), '20192606', false );
		}
	}

	/**
	 * Adds preload for in-body stylesheets depending on what templates are being used.
	 * Disabled when AMP is active as AMP injects the stylesheets inline.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
	 */
	public function semantic_add_body_style() {

		// If AMP is active, do nothing.
		if ( wprig_is_amp() ) {
			return;
		}

		// Get registered styles.
		$wp_styles = wp_styles();

		$preloads = array();

		// Preload front-page.css.
		global $template;
		if ( 'single-ad.php' === basename( $template ) ) {
			$preloads['wprig-semantic-modal-style'] = wprig_get_preload_stylesheet_uri( $wp_styles, 'wprig-semantic-modal-style' );
		}

		// Output the preload markup in <head>.
		foreach ( $preloads as $handle => $src ) {
			echo '<link rel="preload" id="' . esc_attr( $handle ) . '-preload" href="' . esc_url( $src ) . '" as="style" />';
			echo "\n";
		}
	}
}

$swiper = new BJE_Semantic();
