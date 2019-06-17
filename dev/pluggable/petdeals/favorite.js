jQuery( document ).ready( function( $ ) {

	$( '#favorite' ).on( 'click', function( e ) {
		$( this ).html( 'PLEASE WAIT...' );
		let status = $( this ).data( 'favorite' ),
			faveid = $( this ).data( 'faveid' ),
			ad = $( this ).data( 'id' );

		if ( 'no' == status ) {
			$.ajax({
				beforeSend: ( xhr ) => {
					xhr.setRequestHeader( 'X-WP-Nonce', favorite.nonce );
				},
				url: favorite.root_url + '/wp-json/petdeals/v1/manageFavorite',
				type: 'POST',
				data: { 'adID': ad },
				success: ( response ) => {
					$( this ).data( 'favorite', 'yes' );
					$( this ).data( 'faveid', response );
					$( this ).html( 'REMOVE TO FAVORITES' );
					console.log( response );
				},
				error: ( response ) => {
					console.log( response );
				}
			});
		} else {
			$.ajax({
				beforeSend: ( xhr ) => {
					xhr.setRequestHeader( 'X-WP-Nonce', favorite.nonce );
				},
				url: favorite.root_url + '/wp-json/petdeals/v1/manageFavorite',
				type: 'DELETE',
				data: { 'faveid': faveid },
				success: ( response ) => {
					$( this ).data( 'favorite', 'no' );
					$( this ).data( 'faveid', '' );
					$( this ).html( 'SAVE TO FAVORITES' );
					console.log( response );
				},
				error: ( response ) => {
					console.log( response );
				}
			});
		}
	});


	$( '.delete-fave' ).on( 'click', function( e ) {
		e.preventDefault();
		$( this ).html( 'Please wait <i class="fas fa-spinner fa-spin"></i>' );
		let ad = $( this ).data( 'ad' );

			$.ajax({
				beforeSend: ( xhr ) => {
					xhr.setRequestHeader( 'X-WP-Nonce', favorite.nonce );
				},
				url: favorite.root_url + '/wp-json/petdeals/v1/manageFavorite',
				type: 'DELETE',
				data: { 'faveid': ad },
				success: ( response ) => {
					console.log( response );
					window.location.replace( favorite.root_url + '/my-account/favorite-ads/' );
				},
				error: ( response ) => {
					console.log( response );
				}
			});
	});
});
