<?php
/**
 * Pet Deals API
 *
 * @package wprig
 */

/**
 * Add custom api
 */
function petdeals_search_api() {
	register_rest_route( 'petdeals/v1', 'search', array(
		'methods'  => WP_REST_SERVER::READABLE,
		'callback' => 'pet_deals_search_results',
	) );

	register_rest_route( 'petdeals/v1', 'search', array(
		'methods'  => 'DELETE',
		'callback' => 'delete_ad',
	));
}
add_action( 'rest_api_init', 'petdeals_search_api' );

/**
 * Get Ad using ID
 */
function petdeals_ad_id() {
	register_rest_route( 'petdeals/v1', 'ad', array(
		'methods'  => 'DELETE',
		'callback' => 'pet_deals_delete_ad',
	) );
}
add_action( 'rest_api_init', 'petdeals_ad_id' );

function pet_deals_delete_ad( $data ) {

	$ad_id = sanitize_text_field( $data['id'] );

	if ( get_current_user_id() == get_post_field( 'post_author', $ad_id ) && get_post_type( $ad_id ) == 'ad' ) {
		wp_delete_post( $ad_id, true );
		return 'Congrats, ad deleted.';
	} else {
		die( 'You do not have permission to delete that.' );
	}

}

/**
 * Search Results API
 */
function pet_deals_search_results( $data ) {
	$ads = new WP_Query( array(
		'post_type'      => 'ad',
		'posts_per_page' => -1,
	));
	$ads_results = array();
	while ( $ads->have_posts() ) {
		$ads->the_post();
		array_push( $ads_results, array(
			'id'        => get_the_ID(),
			'title'     => get_the_title(),
			'permalink' => get_the_permalink()
		));
	}
	return $ads_results;
}

add_action( 'rest_api_init', 'petdeals_favorite_route' );

/**
 * API Favorite route
 */
function petdeals_favorite_route() {
	register_rest_route( 'petdeals/v1', 'manageFavorite', array(
		'methods'  => 'POST',
		'callback' => 'create_favorite',
	));

	register_rest_route( 'petdeals/v1', 'manageFavorite', array(
		'methods'  => 'DELETE',
		'callback' => 'delete_favorite',
	));
}

/**
 * Create Favorite.
 *
 * @param @array $data Array.
 */
function create_favorite( $data ) {

	if ( is_user_logged_in() ) {
		$ad_id = sanitize_text_field( $data['adID'] );

		$exist_query = new WP_Query( array(
			'author'     => get_current_user_id(),
			'post_type'  => 'favorite',
			'meta_query' => array(
				array(
					'key'     => 'favorite_ad_id',
					'compare' => '=',
					'value'   => $ad_id,
				),
			),
		));

		if ( 0 == $exist_query->found_posts && get_post_type( $ad_id ) == 'ad' ) {
			$post_id = wp_insert_post( array(
				'post_type'   => 'favorite',
				'post_status' => 'publish',
				'post_title'  => 'Favorite Item',
			));

			update_field( 'field_5cbdd2fe5689f', $ad_id, $post_id );
			return $post_id;
		} else {
			die( 'Invalid advert id' );
		}
	} else {
		die( 'Only logged in users can create a favorite.' );
	}
}

/**
 * Delete Favorite.
 *
 * @param @array $data Array.
 */
function delete_favorite( $data ) {
	$fave_id = sanitize_text_field( $data['faveid'] );
	if ( get_current_user_id() == get_post_field( 'post_author', $fave_id ) && get_post_type( $fave_id ) == 'favorite' ) {
		wp_delete_post( $fave_id, true );
		return 'Congrats, favorite deleted.';
	} else {
		die( 'You do not have permission to delete that.' );
	}
}
