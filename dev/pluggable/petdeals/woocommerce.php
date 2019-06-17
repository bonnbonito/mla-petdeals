<?php
/**
 * Woocommerce Functions
 *
 * @package wprig
 */

/**
 * Woocommerce Support
 */
function petdeals_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'petdeals_add_woocommerce_support' );

/**
 * 1. Register new endpoint to use for My Account page
 * Note: Resave Permalinks or it will give 404 error *
 */
function petdeals_add_endpoint() {
	add_rewrite_endpoint( 'new-ad', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'manage-ads', EP_ROOT | EP_PAGES );
	add_rewrite_endpoint( 'favorite-ads', EP_ROOT | EP_PAGES );
}

add_action( 'init', 'petdeals_add_endpoint' );


/**
 * Add Query Var
 *
 * @param array $vars Array.
 */
function petdeals_query_vars( $vars ) {
	$vars[] = 'new-ad';
	$vars[] = 'manage-ads';
	$vars[] = 'favorite-ads';
	$vars[] = 'ad_id';
	return $vars;
}

add_filter( 'query_vars', 'petdeals_query_vars', 0 );


/**
 *  Insert the new endpoint into the My Account menu
 *
 * @param array $items Array.
 */
function petdeals_add_link_my_account( $items ) {
	$items['new-ad']       = 'Add New Advert';
	$items['manage-ads']   = 'Manage Adverts';
	$items['favorite-ads'] = 'Favorite Adverts';
	return $items;
}

add_filter( 'woocommerce_account_menu_items', 'petdeals_add_link_my_account' );

/**
 *  Add content to the favorite ad endpoint
 */
function petdeals_favorite_ads_content() {
	get_template_part( 'template-parts/dashboard', 'favorites' );
}
add_action( 'woocommerce_account_favorite-ads_endpoint', 'petdeals_favorite_ads_content' );

/**
 *  Add content to the new endpoint
 */
function petdeals_new_ad_content() {
	get_template_part( 'template-parts/dashboard', 'new' );
}
add_action( 'woocommerce_account_new-ad_endpoint', 'petdeals_new_ad_content' );

/**
 *  Add content to the manage ad endpoint
 */
function petdeals_manage_ads_content() {
	get_template_part( 'template-parts/dashboard', 'edit' );
}
add_action( 'woocommerce_account_manage-ads_endpoint', 'petdeals_manage_ads_content' );

/**
 * Remove account links
 *
 * @param array $menu_links Menu Links.
 */
function petdeals_remove_my_account_links( $menu_links ) {
	unset( $menu_links['payment-methods'] );
	unset( $menu_links['downloads'] );
	return $menu_links;

}
add_filter( 'woocommerce_account_menu_items', 'petdeals_remove_my_account_links' );

/**
 *  Dashboard Account Order.
 */
function petdeals_my_account_order() {
	$myorder = array(
		'dashboard'        => __( 'Dashboard', 'wprig' ),
		'new-ad'           => __( 'Add New Advert', 'wprig' ),
		'manage-ads'       => __( 'Manage Adverts', 'wprig' ),
		'favorite-ads'     => __( 'Favorite Ads', 'wprig' ),
		'orders'           => __( 'Orders', 'wprig' ),
		'edit-account'     => __( 'Change My Details', 'wprig' ),
		'edit-address'     => __( 'Addresses', 'wprig' ),
		'customer-logout'  => __( 'Logout', 'wprig' ),
	);
	return $myorder;
}
add_filter( 'woocommerce_account_menu_items', 'petdeals_my_account_order' );


add_filter( 'loop_shop_columns', 'loop_columns' );
if ( ! function_exists( 'loop_columns' ) ) {
	/**
	 * Optional: 4 Products.
	 */
	function loop_columns() {
		return 4; // 3 products per row.
	}
}

/**
 *  Related Products Columns.
 */
function woo_related_products_limit() {
	global $product;
	$args['posts_per_page'] = 4;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'petdeals_related_products_args', 20 );

/**
 *  Related Products Columns.
 *
 * @param array $args Args.
 */
function petdeals_related_products_args( $args ) {
	$args['posts_per_page'] = 4; // 4 related products.
	$args['columns']        = 4; // arranged in 4 columns.
	return $args;
}

/**
 *  Related Products Columns.
 */
function petdeals_output_cart_notices() {
	echo do_shortcode( '[woocommerce_cart_notice type="minimum_amount"]' );
}


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);


if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    }
}
if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
        global $post, $woocommerce;
        $output = '<div class="imagewrapper"><div class="prod-hover"><span>QUICK VIEW</span></div>';

        if ( has_post_thumbnail() ) {
            $output .= get_the_post_thumbnail( $post->ID, $size );
        }
        $output .= '</div>';
        return $output;
    }
}

class My_WC_Product_Cat_List_Walker extends Pet_Product_Cat_List_Walker {
	public $tree_type = 'product_cat';
	public $db_fields = array ( 'parent' => 'parent', 'id' => 'term_id', 'slug' => 'slug' );
	public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$output .= '<li class="cat-item cat-item-' . $cat->term_id;

		if ( $args['current_category'] == $cat->term_id ) {
			$output .= ' current-cat';
		}

		if ( $args['has_children'] && $args['hierarchical'] ) {
			$output .= ' cat-parent';
		}

		if ( $args['current_category_ancestors'] && $args['current_category'] && in_array( $cat->term_id, $args['current_category_ancestors'] ) ) {
			$output .= ' current-cat-parent';
		}

		$output .= '">';

		$output .= '<a href="' . get_term_link( (int) $cat->term_id, $this->tree_type ) . '">' . __( $cat->name, 'woocommerce' ) . '</a>';

		if ( $args['has_children'] && $args['hierarchical'] ) {
			$output .= ' <span class="show-sub"></span>';
		}

		if ( $args['show_count'] ) {
			$output .= ' <span class="count">(' . $cat->count . ')</span>';
		}
	}
}

add_filter( 'woocommerce_product_categories_widget_args', 'wprig_product_categories_widget_args', 10, 1);

function wprig_product_categories_widget_args( $args ) {
	$args['walker'] = new My_WC_Product_Cat_List_Walker;
	return $args;
}


add_filter( 'woocommerce_add_to_cart_fragments', 'pet_header_cart_count_fragments', 10, 1 );
function pet_header_cart_count_fragments( $fragments ) {
	$fragments['span.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
	return $fragments;
}


add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );

/**
 * Add a custom product data tab
 */
function woo_new_product_tab( $tabs ) {

	// Adds the new tab

	$tabs['buyersguide_tab'] = array(
		'title' 	=> __( 'Buyers Guide', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_new_product_tab_content'
	);

	return $tabs;

}

function woo_new_product_tab_content() {
	// The new tab content
	echo '<h2>Buyers Guide</h2>';
	echo '<p>Here\'s your new product tab.</p>';
}



add_action( 'woocommerce_edit_account_form_start', 'wprig_avatar_edit_account_form' );
add_action( 'woocommerce_save_account_details', 'wprig_avatar_save_account_details' );

/**
 * Add a avatar upload
 */
function wprig_avatar_edit_account_form() {
	$user_id = get_current_user_id();
	$user    = get_userdata( $user_id );
	if ( ! $user ) {
		return;
	}

	$avatar = get_user_meta( $user_id, 'avatar', true );
	?>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="account_display_name">User Avatar (<em>Click image to change</em>)</label>
		<div class="ads-images-wrap">
			<div class="image-item">
				<a href="#" id="add-image-avatar">
				<div class="hoverimg"></div>
				<?php if ( $avatar ) { ?>
					<img src="<?php echo esc_url( wp_get_attachment_image_src( $avatar )[0] ); ?>" alt="">
				<?php } else { ?>
					<img src="<?php echo esc_url( get_theme_file_uri( '/images/upload-btn.png' ) ); ?>" alt="">
				<?php } ?>
				</a>
				<input type="hidden" id="avatar_image" name="avatar_image" value="<?php echo esc_attr( $avatar ? $avatar : '' ); ?>">
			</div>
		</div>
	</p>
	<?php
}

/**
 * Save Avatar
 */
function wprig_avatar_save_account_details( $user_id ) {
	update_user_meta( $user_id, 'avatar', $_POST[ 'avatar_image' ] );
}
