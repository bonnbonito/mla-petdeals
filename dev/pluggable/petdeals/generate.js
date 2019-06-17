jQuery( document ).ready( function( $ ) {

	$( '#pet_type' ).on( 'change', function() {
		let petType = $( this ).val(),
			form     = {
				action: 'petdeals_generate_breeds',
				pet: petType
			};
			console.log( form );

		if ( petType ) {

			$( '#pet_breed' ).html( '<option value="">Getting breeds...</option' );

			$.post( generate.ajax_url, form ).always( function( response ) {
				$( '#pet_breed' ).html( response.breeds );
			});

		} else {
			$( '#pet_breed' ).html( '<option value="">Pet Breed (Any)</option' );
		}

	});

	$( '.show-search button' ).on( 'click', function( e ) {
		e.preventDefault();
		$( 'body' ).toggleClass( 'no-scroll' );
		$( '.show-search' ).toggleClass( 'show' );
		if ( $( '.show-search' ).hasClass( 'show' ) ) {
			$( '.body-overlay' ).attr( 'aria-hidden', false );
			$( '.show-search button' ).html( '<i class="fas fa-times"></i> CLOSE' );
		} else {
			$( '.show-search button' ).html( '<i class="fas fa-bars"></i> SEARCH' );
			$( '.body-overlay' ).attr( 'aria-hidden', true );
		}
		$( '.search-left' ).toggleClass( 'show' );
	});
});
