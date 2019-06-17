<?php
/**
 * Pet Deals Functions
 *
 * @package wprig
 */

/**
 * Main Swiper Class.
 */
class BJE_PeatDeals {

	/**
	 * Main function. Runs everything.
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'petdeals' ) );
		add_action( 'init', array( $this, 'add_dashboard_newpost' ), 10, 0 );
		add_filter( 'query_vars', array( $this, 'add_query_vars_dashboard' ) );
		add_filter( 'display_post_states', array( $this, 'pet_add_post_state' ), 10, 2 );
		add_action( 'init', array( $this, 'verify_user_code' ) );
		add_action( 'wp_authenticate', array( $this, 'isUserActivated' ) );
		acf_register_form(array(
			'id'                 => 'new-ad',
			'post_id'            => 'new_post',
			'new_post'           => array(
				'post_type'      => 'ad',
				'post_status'    => 'publish',
			),
			'post_title'         => true,
			'post_content'       => false,
			'submit_value'       => __( 'Publish Ad', 'wprig' ),
			'updated_message'    => __( 'Ad Posted', 'wprig' ),
			'uploader'           => 'wp',
			'html_submit_button' => '<button type="submit" class="yellow btn">%s</button>',
		));
		add_action( 'wp_ajax_nopriv_petdeals_create_account', array( $this, 'petdeals_create_account' ) );
		add_action( 'wp_ajax_petdeals_newad', array( $this, 'petdeals_newad' ) );
		add_action( 'wp_ajax_petdeals_editad', array( $this, 'petdeals_editad' ) );
		add_action( 'wp_ajax_petdeals_generate_breeds', array( $this, 'petdeals_generate_breeds' ) );
		add_action( 'wp_ajax_nopriv_petdeals_generate_breeds', array( $this, 'petdeals_generate_breeds' ) );
	}
	/**
	 * Main function. Runs everything.
	 */
	public function petdeals() {

		// If this is the admin page, do nothing.
		if ( is_admin() ) {
			return;
		}
		add_action( 'wp_enqueue_scripts', array( $this, 'petdeals_script' ) );
	}

	/**
	 * Verify Email
	 */
	public function verify_user_code() {
		if ( isset( $_GET['act'] ) ) {
			$data = unserialize( base64_decode( $_GET['act'] ) );
			$code = get_user_meta( $data['id'], 'activation_code', true );
			// verify whether the code given is the same as ours.
			if ( $code == $data['code'] ) {
				// update the user meta.
				update_user_meta( $data['id'], 'account_activated', 1 );
				wc_add_notice( __( '<strong>Success:</strong> Your account has been activated! ', 'wprig' ) );
			}
		}
	}

	/**
	 * Check if user activated
	 */
	function isUserActivated( $username ) {

		// First need to get the user object.
		$user = get_user_by( 'login', $username );
		if ( ! $user ) {
			$user = get_user_by( 'email', $username );
			if ( ! $user ) {
				return $username;
			}
		}

		$user_status = get_user_meta( $user->ID, 'account_activated', true );

		if ( user_can( $user->ID, 'manage_options' ) ) {
			return $username;
		}

		//for testing $user_status = 1;
		$login_page  = home_url( '/my-account/' );
		if ( 0 == $user_status ) {
			wp_safe_redirect( $login_page . '?login=notactivated' );
			exit();
		}
	}

	/**
	 * Enqueue and defer lazyload script.
	 */
	public function petdeals_script() {
		if ( is_page( 'dashboard' ) || is_page( 'register' ) || is_account_page() ) {
			wp_enqueue_media();
			wp_enqueue_script( 'wprig-petdeals-js', get_theme_file_uri( '/pluggable/petdeals/js.js' ), array( 'jquery' ), '1.0.0', false );
			wp_enqueue_script( 'jquery-ui-datepicker' );
			// You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
			wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), '1.12.1' );
			wp_enqueue_style( 'jquery-ui' );
			wp_localize_script( 'wprig-petdeals-js', 'petDeals', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'root_url' => get_site_url(),
			));
		}
		if ( is_page( 'register' ) ) {
			wp_enqueue_script( 'password-strength-meter' );
		}
		if ( is_woocommerce() || is_singular( 'ad' ) || is_checkout() || is_cart() || is_page( 'checkout' ) ) {
			wp_enqueue_style( 'wprig-woo', get_theme_file_uri( '/pluggable/petdeals/woocommerce.css' ), array(), '20180514' );
		}
		if ( is_page( 'search' ) || is_woocommerce() || is_singular( 'ad' ) ) {
			wp_enqueue_style( 'wprig-search', get_theme_file_uri( '/pluggable/petdeals/search.css' ), array(), '20180514' );
			wp_enqueue_script( 'jquery-ui-slider' );
		}

		if ( is_singular( 'ad' ) || is_account_page() ) {

			wp_enqueue_script( 'wprig-favorite-js', get_theme_file_uri( '/pluggable/petdeals/favorite.js' ), array( 'jquery' ), '1.0.0', false );
			wp_localize_script( 'wprig-favorite-js', 'favorite', array(
				'root_url' => get_site_url(),
				'nonce'    => wp_create_nonce( 'wp_rest' ),
			));
		}
		if ( is_page( 'search' ) || is_account_page() || is_front_page() ) {
			wp_enqueue_script( 'wprig-gmap', '//maps.googleapis.com/maps/api/js?key=AIzaSyB-_PqrHq4IRAeTdHj3Kj-31XbGkV3gmq0&libraries=places', array(), '1.0.0', false );
			wp_enqueue_script( 'wprig-generatepets-js', get_theme_file_uri( '/pluggable/petdeals/generate.js' ), array( 'jquery' ), '1.0.0', false );
			wp_localize_script( 'wprig-generatepets-js', 'generate', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'generate_rest' ),
			));
		}
		if ( is_woocommerce() || is_cart() ) {
			wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), '1.12.1' );
			wp_enqueue_script( 'jquery-ui-spinner' );
			wp_enqueue_script( 'wprig-spinner-js', get_theme_file_uri( '/pluggable/petdeals/woo.js' ), array( 'jquery-ui-spinner' ), '1.0.0', true );
		}

		wp_enqueue_script( 'wprig-mailchimp-js', get_theme_file_uri( '/pluggable/petdeals/mailchimp.js' ), array( 'jquery' ), '1.0.0', false );
		wp_localize_script( 'wprig-mailchimp-js', 'mailchimp', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		));
	}

	/**
	 * Add Dashboard - Add new post
	 */
	public function add_dashboard_newpost() {
		add_rewrite_rule( '^dashboard/([^/]*)/?', 'index.php?pagename=dashboard&dashboard=$matches[1]', 'top' );
	}

	/**
	 * Add Query var dashboard
	 *
	 * @param array $vars The dashboard attrbutes.
	 * @return array
	 */
	public function add_query_vars_dashboard( $vars ) {
		$vars[] = 'dashboard';
		$vars[] = 'ad_id';
		return $vars;
	}

	/**
	 * Add Post State to page
	 *
	 * @param array $post_states The post state.
	 * @param array $post The post.
	 * @return array
	 */
	public function pet_add_post_state( $post_states, $post ) {
		if ( 'register' === $post->post_name ) {
			$post_states[] = 'Registration Page';
		}
		return $post_states;
	}

	/**
	 * Generate Breeds
	 */
	public function petdeals_generate_breeds() {
		$output['status'] = 1;

		$pet = isset( $_POST['pet'] ) ? sanitize_text_field( $_POST['pet'] ) : '';
		$petid = get_page_by_path( $pet, OBJECT, 'pet' )->ID;
		?>
		ob_start();
		<option value="">Pet Breed (Any <?php echo get_the_title( $petid ); ?>)</option>
		<?php
		if ( $petid ) {

			if ( have_rows( 'breeds', $petid ) ) :
				?>
				<?php
				while ( have_rows( 'breeds', $petid ) ) :
					the_row();
					?>
					<option value="<?php the_sub_field( 'breed' ); ?>"><?php the_sub_field( 'breed' ); ?></option>
					<?php
				endwhile;
			endif;
		}
		$output['breeds'] = ob_get_clean();
		$output['status'] = 2;
		wp_send_json( $output );
	}

	/**
	 * Create New Ad
	 */
	public function petdeals_newad() {
		$output['status'] = 1;
		$nonce  = isset( $_POST['_wpnonce'] ) ? $_POST['_wpnonce'] : '';

		if ( ! wp_verify_nonce( $nonce, 'new_advert' ) ) {
			wp_send_json( $output );
		}

		if ( ! petdeals_can_post_ad() ) {
			wp_send_json( $output );
		}

		$advert_type   = isset( $_POST['advert_type'] ) ? sanitize_text_field( wp_unslash( $_POST['advert_type'] ) ) : '';
		$title         = isset( $_POST['ad_title'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_title'] ) ) : '';
		$content       = isset( $_POST['description'] ) ? wp_kses_post( wp_unslash( $_POST['description'] ) ) : '';
		$pet_type      = isset( $_POST['pet_type'] ) ? sanitize_text_field( wp_unslash( $_POST['pet_type'] ) ) : '';
		$pet_breed     = isset( $_POST['pet_breed'] ) ? sanitize_text_field( wp_unslash( $_POST['pet_breed'] ) ) : '';
		$pet_dob       = isset( $_POST['pet_dob'] ) ? sanitize_text_field( wp_unslash( $_POST['pet_dob'] ) ) : '';
		$price         = isset( $_POST['price'] ) ? sanitize_text_field( wp_unslash( $_POST['price'] ) ) : '';
		$address       = isset( $_POST['address'] ) ? sanitize_text_field( wp_unslash( $_POST['address'] ) ) : '';
		$lat           = isset( $_POST['lat'] ) ? sanitize_text_field( wp_unslash( $_POST['lat'] ) ) : '';
		$lng           = isset( $_POST['lng'] ) ? sanitize_text_field( wp_unslash( $_POST['lng'] ) ) : '';
		$microchipped  = isset( $_POST['microchipped'] ) ? sanitize_text_field( wp_unslash( $_POST['microchipped'] ) ) : '';
		$agree         = isset( $_POST['agree'] ) ? sanitize_text_field( wp_unslash( $_POST['agree'] ) ) : '';
		$neutered      = isset( $_POST['neutered'] ) ? sanitize_text_field( wp_unslash( $_POST['neutered'] ) ) : '';
		$vacc          = isset( $_POST['vacc-up-to-date'] ) ? sanitize_text_field( wp_unslash( $_POST['vacc-up-to-date'] ) ) : '';
		$kc_registered = isset( $_POST['kc_registered'] ) ? sanitize_text_field( wp_unslash( $_POST['kc_registered'] ) ) : '';
		$image1        = isset( $_POST['ad_image_1'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_image_1'] ) ) : '';
		$image2        = isset( $_POST['ad_image_2'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_image_2'] ) ) : '';
		$image3        = isset( $_POST['ad_image_3'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_image_3'] ) ) : '';
		$image4        = isset( $_POST['ad_image_4'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_image_4'] ) ) : '';
		$image5        = isset( $_POST['ad_image_5'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_image_5'] ) ) : '';
		$seller_name   = isset( $_POST['seller_name'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_name'] ) ) : '';
		$seller_tel    = isset( $_POST['seller_tel'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_tel'] ) ) : '';
		$seller_email  = isset( $_POST['seller_email'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_email'] ) ) : '';

		$post_id = wp_insert_post( array(
			'post_title'  => $title,
			'post_status' => 'pending',
			'post_type'   => 'ad',
		));
		// Advert Type.
		if ( $advert_type ) {
			update_field( 'field_5ccacea8dec82', $advert_type, $post_id );
		}
		// Description.
		if ( $content ) {
			update_field( 'field_5c93863fbeb69', $content, $post_id );
		}

		if ( $lat || $lng ) {
			$location = array(
				'address' => $address,
				'lat'     => $lat,
				'lng'     => $lng,
			);
			update_post_meta( $post_id, 'pet_lat', $lat );
			update_post_meta( $post_id, 'pet_lng', $lng );
			// Location.
			update_field( 'field_5ca2faa42a025', $location, $post_id );
		}
		// Pet Type.
		if ( $pet_type ) {
			update_field( 'field_5ca2f9dc2a021', $pet_type, $post_id );
		}

		if ( $pet_breed ) {
			// Pet Breed.
			update_field( 'field_5c938661beb6a', $pet_breed, $post_id );
		}

		if ( $pet_dob ) {
			// Pet DOB.
			update_field( 'field_5ca2fa062a022', $pet_dob, $post_id );
		}

		if ( $price ) {
			// Price.
			update_field( 'field_5ca2fa362a023', $price, $post_id );
		}

		if ( $seller_name ) {
			// Seller Name.
			update_field( 'field_5cc85b22d12d3', $seller_name, $post_id );
		}

		if ( $seller_tel ) {
			// Seller Telephone.
			update_field( 'field_5cc85b22d12d3', $seller_tel, $post_id );
		}

		if ( $seller_email ) {
			// Seller Email.
			update_field( 'field_5cc85b22d12d3', $seller_email, $post_id );
		}

		// Microshipped.
		if ( $microchipped ) {
			update_field( 'field_5ca2fadf2a026', $microchipped, $post_id );
		}
		// Neutered.
		if ( $microchipped ) {
			update_field( 'field_5ca2faf92a027', $microchipped, $post_id );
		}
		// Vacc up to date.
		if ( $vacc ) {
			update_field( 'field_5ca2fb092a028', $vacc, $post_id );
		}
		// Microshipped.
		if ( $neutered ) {
			update_field( 'field_5ca2fadf2a026', $neutered, $post_id );
		}
		// KC Registered.
		if ( $kc_registered ) {
			update_field( 'field_5ca2fb252a029', $kc_registered, $post_id );
		}

		// Privacy Agree.
		if ( $agree ) {
			update_field( 'field_5ca2fb442a02a', $agree, $post_id );
		}
		// Image 1.
		if ( $image1 ) {
			update_field( 'field_5ca3646d36ad9', $image1, $post_id );
		}
		// Image 1.
		if ( $image2 ) {
			update_field( 'field_5ca3647b36ada', $image2, $post_id );
		}
		// Image 1.
		if ( $image3 ) {
			update_field( 'field_5ca3647d36adb', $image3, $post_id );
		}
		// Image 1.
		if ( $image4 ) {
			update_field( 'field_5ca3647f36adc', $image4, $post_id );
		}
		// Image 1.
		if ( $image5 ) {
			update_field( 'field_5ca3648036add', $image5, $post_id );
		}
		$output['status'] = 2;
		wp_send_json( $output );
	}

	/**
	 * Edit Ad
	 */
	public function petdeals_editad() {
		$output['status'] = 1;
		$nonce            = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'edit_advert' ) ) {
			wp_send_json( $output );
		}

		$ad_id         = isset( $_POST['ad_id'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_id'] ) ) : '';
		$title         = isset( $_POST['ad_title'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_title'] ) ) : '';
		$content       = isset( $_POST['description'] ) ? wp_kses_post( wp_unslash( $_POST['description'] ) ) : '';
		$pet_type      = isset( $_POST['pet_type'] ) ? sanitize_text_field( wp_unslash( $_POST['pet_type'] ) ) : '';
		$pet_breed     = isset( $_POST['pet_breed'] ) ? sanitize_text_field( wp_unslash( $_POST['pet_breed'] ) ) : '';
		$pet_dob       = isset( $_POST['pet_dob'] ) ? sanitize_text_field( wp_unslash( $_POST['pet_dob'] ) ) : '';
		$price         = isset( $_POST['price'] ) ? sanitize_text_field( wp_unslash( $_POST['price'] ) ) : '';
		$address       = isset( $_POST['address'] ) ? sanitize_text_field( wp_unslash( $_POST['address'] ) ) : '';
		$lat           = isset( $_POST['lat'] ) ? sanitize_text_field( wp_unslash( $_POST['lat'] ) ) : '';
		$lng           = isset( $_POST['lng'] ) ? sanitize_text_field( wp_unslash( $_POST['lng'] ) ) : '';
		$microchipped  = isset( $_POST['microchipped'] ) ? sanitize_text_field( wp_unslash( $_POST['microchipped'] ) ) : '';
		$agree         = isset( $_POST['agree'] ) ? sanitize_text_field( wp_unslash( $_POST['agree'] ) ) : '';
		$neutered      = isset( $_POST['neutered'] ) ? sanitize_text_field( wp_unslash( $_POST['neutered'] ) ) : '';
		$vacc          = isset( $_POST['vacc-up-to-date'] ) ? sanitize_text_field( wp_unslash( $_POST['vacc-up-to-date'] ) ) : '';
		$kc_registered = isset( $_POST['kc_registered'] ) ? sanitize_text_field( wp_unslash( $_POST['kc_registered'] ) ) : '';
		$image1        = isset( $_POST['ad_image_1'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_image_1'] ) ) : '';
		$image2        = isset( $_POST['ad_image_2'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_image_2'] ) ) : '';
		$image3        = isset( $_POST['ad_image_3'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_image_3'] ) ) : '';
		$image4        = isset( $_POST['ad_image_4'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_image_4'] ) ) : '';
		$image5        = isset( $_POST['ad_image_5'] ) ? sanitize_text_field( wp_unslash( $_POST['ad_image_5'] ) ) : '';
		$seller_name   = isset( $_POST['seller_name'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_name'] ) ) : '';
		$seller_tel    = isset( $_POST['seller_tel'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_tel'] ) ) : '';
		$seller_email  = isset( $_POST['seller_email'] ) ? sanitize_text_field( wp_unslash( $_POST['seller_email'] ) ) : '';

		$location = array(
			'address' => $address,
			'lat'     => $lat,
			'lng'     => $lng,
		);

		wp_update_post( array(
			'ID'          => $ad_id,
			'post_title'  => $title,
		));
		// Description.
		update_field( 'field_5c93863fbeb69', $content, $ad_id );
		update_post_meta( $ad_id, 'pet_lat', $lat );
		update_post_meta( $ad_id, 'pet_lng', $lng );
		// Location.
		update_field( 'field_5ca2faa42a025', $location, $ad_id );
		// Pet Type.
		update_field( 'field_5ca2f9dc2a021', $pet_type, $ad_id );
		// Pet Breed.
		update_field( 'field_5c938661beb6a', $pet_breed, $ad_id );
		// Pet DOB.
		update_field( 'field_5ca2fa062a022', $pet_dob, $ad_id );
		// Price.
		update_field( 'field_5ca2fa362a023', $price, $ad_id );
		// Seller Name.
		update_field( 'field_5cc85b22d12d3', $seller_name, $ad_id );
		// Seller Telephone.
		update_field( 'field_5cc85b38d12d4', $seller_tel, $ad_id );
		// Seller Email.
		update_field( 'field_5cc85b42d12d5', $seller_email, $ad_id );
		// Microshipped.
		if ( $microchipped ) {
			update_field( 'field_5ca2fadf2a026', $microchipped, $ad_id );
		}
		// Neutered.
		if ( $microchipped ) {
			update_field( 'field_5ca2faf92a027', $microchipped, $ad_id );
		}
		// Vacc up to date.
		if ( $vacc ) {
			update_field( 'field_5ca2fb092a028', $vacc, $ad_id );
		}
		// Microshipped.
		if ( $neutered ) {
			update_field( 'field_5ca2fadf2a026', $neutered, $ad_id );
		}
		// KC Registered.
		if ( $kc_registered ) {
			update_field( 'field_5ca2fb252a029', $kc_registered, $ad_id );
		}

		// Privacy Agree.
		if ( $agree ) {
			update_field( 'field_5ca2fb442a02a', $agree, $ad_id );
		}
		// Image 1.
		if ( $image1 ) {
			update_field( 'field_5ca3646d36ad9', $image1, $ad_id );
		}
		// Image 1.
		if ( $image2 ) {
			update_field( 'field_5ca3647b36ada', $image2, $ad_id );
		}
		// Image 1.
		if ( $image3 ) {
			update_field( 'field_5ca3647d36adb', $image3, $ad_id );
		}
		// Image 1.
		if ( $image4 ) {
			update_field( 'field_5ca3647f36adc', $image4, $ad_id );
		}
		// Image 1.
		if ( $image5 ) {
			update_field( 'field_5ca3648036add', $image5, $ad_id );
		}
		$output['status'] = 2;
		wp_send_json( $output );
	}

	/**
	 * Create Account
	 */
	public function petdeals_create_account() {
		$output['status'] = 1;
		$nonce  = isset( $_POST['_wpnonce'] ) ? wp_unslash( $_POST['_wpnonce'] ) : '';

		if ( ! wp_verify_nonce( $nonce, 'pet_auth' ) ) {
			wp_send_json( $output );
		}

		$fname        = isset( $_POST['fname'] ) ? sanitize_text_field( wp_unslash( $_POST['fname'] ) ) : '';
		$lname        = isset( $_POST['lname'] ) ? sanitize_text_field( wp_unslash( $_POST['lname'] ) ) : '';
		$tel          = isset( $_POST['tel'] ) ? sanitize_email( wp_unslash( $_POST['tel'] ) ) : '';
		$account_type = isset( $_POST['accountType'] ) ? sanitize_email( wp_unslash( $_POST['accountType'] ) ) : '';
		$subscribe    = isset( $_POST['subscribe'] ) ? sanitize_email( wp_unslash( $_POST['subscribe'] ) ) : '';
		$email        = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$pass         = isset( $_POST['pass'] ) ? sanitize_text_field( wp_unslash( $_POST['pass'] ) ) : '';
		$confirm_pass = isset( $_POST['confirmPass'] ) ? sanitize_text_field( wp_unslash( $_POST['confirmPass'] ) ) : '';

		if ( username_exists( $username ) ) {
			$output['status'] = 3;
			wp_send_json( $output );
		}

		if ( email_exists( $email ) ) {
			$output['status'] = 4;
			wp_send_json( $output );
		}

		if ( ! is_email( $email ) ) {
			$output['status'] = 6;
			wp_send_json( $output );
		}

		if ( $pass != $confirm_pass ) {
			$output['status'] = 5;
			wp_send_json( $output );
		}

		// create user.
		$user_id = wp_insert_user( array(
			'user_login'      => $email,
			'user_pass'       => $pass,
			'user_email'      => $email,
			'user_nicename'   => $fname,
		));

		if ( is_wp_error( $user_id ) ) {
			wp_send_json( $output );
		}

		update_user_meta( $user_id, 'first_name', $fname );
		update_user_meta( $user_id, 'last_name', $lname );
		update_user_meta( $user_id, 'telephone', $tel );
		update_user_meta( $user_id, 'account_type', $account_type );
		update_user_meta( $user_id, 'subscribe', $subscribe );

		$code   = md5( time() );
		$string = array(
			'id'   => $user_id,
			'code' => $code,
		);

		update_user_meta( $user_id, 'account_activated', 0 );
		update_user_meta( $user_id, 'activation_code', $code );

		// $user = get_user_by( 'id', $user_id );
		// wp_set_current_user( $user_id, $user->user_login );
		// wp_set_auth_cookie( $user_id, false );
		// do_action( 'wp_login', $user->user_login, $user );

		$url = get_site_url() . '/my-account/?act=' . base64_encode( serialize( $string ) );

		$html = 'Please click the following link <br/><br/> <a href="' . $url . '">' . $url . '</a>';
		$headers = array( 'Content-Type: text/html; charset=UTF-8' );
		// send an email out to user
		wp_mail( $email, __( 'Validate your account.', 'wprig' ), $html, $headers );
		$output['status'] = 2;
		wp_send_json( $output );
	}

}

new BJE_PeatDeals();
