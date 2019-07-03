<?php
/**
 * WP Rig functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wprig
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wprig_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wprig, use a find and replace
		* to change 'wprig' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wprig', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'left'    => esc_html__( 'Left Menu', 'wprig' ),
			'right'   => esc_html__( 'Right Menu', 'wprig' ),
			'mobile'  => esc_html__( 'Mobile Menu', 'wprig' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background', apply_filters(
			'wprig_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => false,
			'flex-height' => false,
		)
	);

	/**
	 * Add support for default block styles.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#default-block-styles
	 */
	add_theme_support( 'wp-block-styles' );
	/**
	 * Add support for wide aligments.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#wide-alignment
	 */
	add_theme_support( 'align-wide' );

	/**
	 * Add support for block color palettes.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#block-color-palettes
	 */
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Dusty orange', 'wprig' ),
			'slug'  => 'dusty-orange',
			'color' => '#ed8f5b',
		),
		array(
			'name'  => __( 'Dusty red', 'wprig' ),
			'slug'  => 'dusty-red',
			'color' => '#e36d60',
		),
		array(
			'name'  => __( 'Dusty wine', 'wprig' ),
			'slug'  => 'dusty-wine',
			'color' => '#9c4368',
		),
		array(
			'name'  => __( 'Dark sunset', 'wprig' ),
			'slug'  => 'dark-sunset',
			'color' => '#33223b',
		),
		array(
			'name'  => __( 'Almost black', 'wprig' ),
			'slug'  => 'almost-black',
			'color' => '#0a1c28',
		),
		array(
			'name'  => __( 'Dusty water', 'wprig' ),
			'slug'  => 'dusty-water',
			'color' => '#41848f',
		),
		array(
			'name'  => __( 'Dusty sky', 'wprig' ),
			'slug'  => 'dusty-sky',
			'color' => '#72a7a3',
		),
		array(
			'name'  => __( 'Dusty daylight', 'wprig' ),
			'slug'  => 'dusty-daylight',
			'color' => '#97c0b7',
		),
		array(
			'name'  => __( 'Dusty sun', 'wprig' ),
			'slug'  => 'dusty-sun',
			'color' => '#eee9d1',
		),
	) );

	/**
	 * Optional: Disable custom colors in block color palettes.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
	 *
	 * add_theme_support( 'disable-custom-colors' );
	 */

	/**
	 * Add support for font sizes.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#block-font-sizes
	 */
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'small', 'wprig' ),
			'shortName' => __( 'S', 'wprig' ),
			'size'      => 16,
			'slug'      => 'small',
		),
		array(
			'name'      => __( 'regular', 'wprig' ),
			'shortName' => __( 'M', 'wprig' ),
			'size'      => 20,
			'slug'      => 'regular',
		),
		array(
			'name'      => __( 'large', 'wprig' ),
			'shortName' => __( 'L', 'wprig' ),
			'size'      => 36,
			'slug'      => 'large',
		),
		array(
			'name'      => __( 'larger', 'wprig' ),
			'shortName' => __( 'XL', 'wprig' ),
			'size'      => 48,
			'slug'      => 'larger',
		),
	) );

	/**
	 * Optional: Add AMP support.
	 *
	 * Add built-in support for the AMP plugin and specific AMP features.
	 * Control how the plugin, when activated, impacts the theme.
	 *
	 * @link https://wordpress.org/plugins/amp/
	 */
	add_theme_support( 'amp', array(
		'comments_live_list' => true,
	) );

}
add_action( 'after_setup_theme', 'wprig_setup' );

/**
 * Set the embed width in pixels, based on the theme's design and stylesheet.
 *
 * @param array $dimensions An array of embed width and height values in pixels (in that order).
 * @return array
 */
function wprig_embed_dimensions( array $dimensions ) {
	$dimensions['width'] = 720;
	return $dimensions;
}
add_filter( 'embed_defaults', 'wprig_embed_dimensions' );

/**
 * Register Google Fonts
 */
function wprig_fonts_url() {
	$fonts_url = '';

	/**
	 * Translator: If Lato does not support characters in your language, translate this to 'off'.
	 */
	$lato = esc_html_x( 'on', 'Lato font: on or off', 'wprig' );

	$font_families = array();

	if ( 'off' !== $lato ) {
		$font_families[] = 'Lato:300,400,700';
	}

	if ( in_array( 'on', array( $lato ), true ) ) {
		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );

}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function wprig_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'wprig-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'wprig_resource_hints', 10, 2 );

/**
 * Enqueue WordPress theme styles within Gutenberg.
 */
function wprig_gutenberg_styles() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'wprig-fonts', wprig_fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

	// Enqueue main stylesheet.
	wp_enqueue_style( 'wprig-base-style', get_theme_file_uri( '/css/editor-styles.css' ), array(), '20180514' );
}
add_action( 'enqueue_block_editor_assets', 'wprig_gutenberg_styles' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wprig_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wprig' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wprig' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'wprig' ),
		'id'            => 'shop',
		'description'   => esc_html__( 'Add widgets here.', 'wprig' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wprig_widgets_init' );

/**
 * Enqueue styles.
 */
function wprig_styles() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'wprig-fonts', wprig_fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

	// Enqueue main stylesheet.
	wp_enqueue_style( 'wprig-base-style', get_stylesheet_uri(), array(), microtime() );

	// Register component styles that are printed as needed.
	wp_register_style( 'wprig-comments', get_theme_file_uri( '/css/comments.css' ), array(), '20180514' );
	wp_register_style( 'wprig-content', get_theme_file_uri( '/css/content.css' ), array(), '20180514' );
	// wp_register_style( 'wprig-sidebar', get_theme_file_uri( '/css/sidebar.css' ), array(), '20180514' ).
	// wp_register_style( 'wprig-widgets', get_theme_file_uri( '/css/widgets.css' ), array(), '20180514' ).
	wp_register_style( 'wprig-front-page', get_theme_file_uri( '/css/front-page.css' ), array(), '20180514' );
}
add_action( 'wp_enqueue_scripts', 'wprig_styles' );

/**
 * Enqueue scripts.
 */
function wprig_scripts() {

	wp_enqueue_script( 'wprig-fa', '//use.fontawesome.com/releases/v5.3.1/js/all.js', array(), 'v5.3.1', false );
	wp_script_add_data( 'wprig-fa', 'defer', true );

	// If the AMP plugin is active, return early.
	if ( wprig_is_amp() ) {
		return;
	}

	// Enqueue the navigation script.
	wp_enqueue_script( 'wprig-navigation', get_theme_file_uri( '/js/navigation.js' ), array(), '20180514', false );
	wp_script_add_data( 'wprig-navigation', 'async', true );
	wp_localize_script( 'wprig-navigation', 'wprigScreenReaderText', array(
		'expand'   => __( 'Expand child menu', 'wprig' ),
		'collapse' => __( 'Collapse child menu', 'wprig' ),
		'nonce'    => wp_create_nonce( 'wp_rest' ),
	));

	// Enqueue skip-link-focus script.
	wp_enqueue_script( 'wprig-skip-link-focus-fix', get_theme_file_uri( '/js/skip-link-focus-fix.js' ), array(), '20180514', false );
	wp_script_add_data( 'wprig-skip-link-focus-fix', 'defer', true );

	// Enqueue comment script on singular post/page views only.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'wprig_scripts' );

/**
 * Custom responsive image sizes.
 */
require get_template_directory() . '/inc/image-sizes.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/pluggable/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Optional: Add theme support for lazyloading images.
 *
 * @link https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/
 */
require get_template_directory() . '/pluggable/lazyload/lazyload.php';

/**
 * Optional: Add theme support for swiper slider.
 */
require get_template_directory() . '/pluggable/swiper/class-bje-swiper.php';

/**
 * Optional: Add Geo search.
 */
require get_template_directory() . '/pluggable/petdeals/geosearch.php';

/**
 * Optional: Add pet deals functions.
 */
require get_template_directory() . '/pluggable/petdeals/petdeals.php';

/**
 * Optional: Add pet deals Cat Walker Class.
 */
require get_template_directory() . '/pluggable/petdeals/cat-walker.php';

/**
 * Optional: Add pet deals woocommerce functions.
 */
require get_template_directory() . '/pluggable/petdeals/woocommerce.php';

/**
 * Optional: Add api search.
 */
require get_template_directory() . '/pluggable/petdeals/api.php';

/**
 * Optional: Add Semantic.
 */
require get_template_directory() . '/pluggable/semantic/semantic.php';

/**
 * Optional: ACF Google API
 */
function my_acf_init() {
	acf_update_setting( 'google_api_key', 'AIzaSyB-_PqrHq4IRAeTdHj3Kj-31XbGkV3gmq0' );
}

add_action( 'acf/init', 'my_acf_init' );

/**
 * Optional: If user can still post
 */
function petdeals_can_post_ad() {

	if ( ! current_user_can( 'administrator' ) ) {

		$ad_count   = count_user_posts( get_current_user_id(), 'ad' );
		$udata      = get_userdata( get_current_user_id() );
		$registered = $udata->user_registered;

		$date1 = strtotime( $registered );
		$date2 = strtotime( date( 'Y-m-d' ) );

		$diff = abs( $date2 - $date1 );

		$years = floor( $diff / ( 365 * 60 * 60 * 24 ) ) + 1;

		return ( ( $years * 3 ) > $ad_count );

	}
	return true;

}

/**
 * Optional: User available post left
 */
function petdeals_ads_left() {

	if ( ! current_user_can( 'administrator' ) ) {

		$ad_count   = count_user_posts( get_current_user_id(), 'ad' );
		$udata      = get_userdata( get_current_user_id() );
		$registered = $udata->user_registered;

		$date1 = strtotime( $registered );
		$date2 = strtotime( date( 'Y-m-d' ) );

		$diff = abs( $date2 - $date1 );

		$years = floor( $diff / ( 365 * 60 * 60 * 24 ) ) + 1;

		return ( ( $years * 3 ) - $ad_count );

	}

	return '∞';

}

/**
 * Get Lat Lang.
 *
 * @param string $origin Address.
 */
function petdeals_get_lat_and_lng( $origin ) {
	$api_key       = 'AIzaSyB-_PqrHq4IRAeTdHj3Kj-31XbGkV3gmq0';
	$url           = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode( $origin ) . '&key=' . $api_key;
	$result_string = file_get_contents( $url );
	$result        = json_decode( $result_string, true );
	$result1[]     = $result['results'][0];
	$result2[]     = $result1[0]['geometry'];
	$result3[]     = $result2[0]['location'];
	return $result3[0];
}

/**
 * Return Distance.
 *
 * @param string $origin Address.
 * @param string $address_lat Lat.
 * @param string $address_lng Lng.
 */
function petdeals_get_distance( $origin, $address_lat, $address_lng ) {

	// get lat and lng from provided location.
	$origin_coords = petdeals_get_lat_and_lng( $origin );
	$lat1          = $origin_coords['lat'];
	$lng1          = $origin_coords['lng'];

	// get lat and lng from the address field on the custom post type.
	$lat2 = $address_lat;
	$lng2 = $address_lng;

	// calculate distance between locations.
	$theta         = $lng1 - $lng2;
	$dist  = sin( deg2rad( $lat1 ) ) * sin( deg2rad( $lat2 ) ) + cos( deg2rad( $lat1 ) ) * cos( deg2rad( $lat2 ) ) * cos( deg2rad( $theta ) );
	$dist  = acos( $dist );
	$dist  = rad2deg( $dist );
	$miles = $dist * 60 * 1.1515;
	return $miles;
}

/**
 * Save Lat Lng from ACF Map Field.
 *
 * @param string $post_id Post ID.
 * @param string $post Post.
 * @param string $update Update.
 */
function petdeals_update_latlon( $post_id, $post, $update ) {

	$map = get_post_meta( $post_id, 'contact_details', true );

	if ( ! empty( $map ) ) {

		remove_action( 'save_post_ad', 'petdeals_update_latlon', 90, 3 );

		update_post_meta( $post_id, 'pet_lat', $map['lat'] );
		update_post_meta( $post_id, 'pet_lng', $map['lng'] );

		add_action( 'save_post_ad', 'petdeals_update_latlon', 90, 3 );
	}

}
add_action( 'save_post_ad', 'petdeals_update_latlon', 90, 3 );


/**
 * Optional: Show template
 */
function show_template() {
	global $template;
	print_r( $template );
}

/**
 * Optional: Show all pets
 */
function show_all_pets() {

	$pet_query = new WP_Query( array(
		'post_type'  => 'pet',
		'posts_per_page' => -1,
	));
	ob_start();
	if ( $pet_query->have_posts() ) :
		while ( $pet_query->have_posts() ) :
			$pet_query->the_post();
			$postname = get_post_field( 'post_name', get_the_ID() );
			?>
			<option value="<?php echo esc_attr( $postname ); ?>" <?php echo ( ( isset( $_GET['pet_type'] ) && $postname == $_GET['pet_type'] ) || ( isset( $_GET['ad_id'] ) && $postname == get_field( 'pet_type', $_GET['ad_id'] ) ) ? 'selected' : '' ); ?>><?php the_title(); ?></option>
			<?php
		endwhile;
		wp_reset_postdata();
	endif;
	return ob_get_clean();

}

/**
 * Optional: Allow upload media
 */
function allow_subscriber_media() {
	$role = 'subscriber';
	if ( ! current_user_can( $role ) || current_user_can( 'upload_files' ) )
		return;
	$subscriber = get_role( $role );
	$subscriber->add_cap( 'upload_files' );
}
add_action( 'admin_init', 'allow_subscriber_media' );


/**
 * Optional: Only show owned media
 *
 * @param string $query Post ID.
 */
function show_current_user_attachments( $query = array() ) {
	$user_id = get_current_user_id();
	if ( $user_id ) {
		$query['author'] = $user_id;
	}
	return $query;
}
add_filter( 'ajax_query_attachments_args', 'show_current_user_attachments', 10, 1 );

/**
 * Optional: Add Options Page
 *
 * @param string $query Post ID.
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(array(
		'page_title'  => 'Other Contents',
		'menu_title'  => 'Other Contents',
		'menu_slug'   => 'other-contents-settings',
		'capability'  => 'edit_posts',
		'redirect'    => false
	));

}

/**
 * Disable Comments URL field.
 */
function wprig_disable_comment_url( $fields ) {
	unset( $fields['url'] );
	return $fields;
}

add_filter( 'comment_form_default_fields', 'wprig_disable_comment_url' );

/**
 * Get Age of Pet.
 */
function get_age() {
	$petdob = get_field( 'date_of_birth' );
	$date   = new DateTime( $petdob );
	$now    = new DateTime();
	return $now->diff( $date )->format( '%y years %m months' );
}


add_action( 'woocommerce_thankyou', 'adding_customers_details_to_thankyou', 10, 1 );

/**
 * Show Customer Details even not logged in.
 *
 * @param string $order_id order ID.
 */
function adding_customers_details_to_thankyou( $order_id ) {
	if ( ! $order_id || is_user_logged_in() ) return;
	$order = wc_get_order( $order_id );
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}

add_action( 'woocommerce_thankyou', 'adding_return_to_shop', 10, 1 );

/**
 * Show Customer Details even not logged in.
 *
 * @param string $order_id order ID.
 */
function adding_return_to_shop( $order_id ) {
	if ( ! $order_id ) return;
	?>
	<a href="<?php bloginfo( 'url' ); ?>/shop/" class="btn yellow">Return to shop</a>
	<?php
}


if ( ! current_user_can( 'manage_options' ) ) {
	add_filter( 'show_admin_bar', '__return_false' );
}


add_action( 'wp_footer', 'mla_add_cart_quantity_plus_minus' );

function mla_add_cart_quantity_plus_minus() {
   // Only run this on the single product page
   if ( ! is_product() ) return;
   ?>
      <script type="text/javascript">

      jQuery(document).ready(function($){

         $('form.cart, form.woocommerce-cart-form').on( 'click', 'button.plus, button.minus', function() {

            // Get current quantity values
            var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));

            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }

         });

      });

      </script>
   <?php
}

add_action( 'wp_footer', 'mla_add_cart_quantity_plus_minus2' );

function mla_add_cart_quantity_plus_minus2() {
   // Only run this on the single product page
   if ( ! is_cart() ) return;
   ?>
      <script type="text/javascript">

      jQuery(document).ready(function($){

         $('.quantity-wrap').on( 'click', 'button.plus, button.minus', function() {
			 $( 'button[name="update_cart"]' ).removeProp( 'disabled');
            // Get current quantity values
            var qty = $( this ).closest( '.quantity' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));

            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } else {
                  qty.val( val + step );
               }
            } else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }

         });

      });

      </script>
   <?php
}

/**
 * Email when ad is online
 *
 * @param string $post_id Post ID.
 */
function ad_published_send_email( $post_id ) {

	if ( is_admin() ) {
		return;
	}

	if ( 'ad' != get_post_type( $post_id ) ) {
		return;
	}

	$post   = get_post( $post_id );
	$author = get_userdata( $post->post_author );

	$message = '
	  Hi ' . $author->display_name . ',
	  Your listing, ' . $post->post_title . ' has just been approved at ' . get_permalink( $post_id ) . ' . Well done!
	';

	wp_mail( $author->user_email, 'Your ad listing is online', $message );
}

add_action( 'pending_to_publish', 'ad_published_send_email' );


add_filter( 'manage_users_columns', 'petdeals_add_user_activated_column' );

function petdeals_add_user_activated_column( $columns ) {
	$columns['activated'] = 'Activated';
	return $columns;
}

add_action( 'manage_users_custom_column',  'petdeals_show_user_activated_column_content', 10, 3 );

function petdeals_show_user_activated_column_content( $value, $column_name, $user_id ) {
	$activated = get_user_meta( $user_id, 'account_activated', true );
	if ( 'activated' == $column_name )
		return ( 0 == $activated ? 'No' : 'Yes' );
	return $value;
}
