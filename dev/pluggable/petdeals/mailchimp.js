jQuery( document ).ready( function( $ ) {
	var $form = $( '#mc-embedded-subscribe-form' );
	if ( 0 <  $form.length ) {
		$form.on( 'submit', function( event ) {
			if ( event ) {
				event.preventDefault();
			}
			if ( ! $( '#mce-EMAIL' ).val() ) {
				alert( 'Email is required' );
			} else {
				register( $form );
			}
		});
	}

	function register( $form ) {
		$( '#mailchimp-send' ).val( 'Sending...' );
		$.ajax({
			type: $form.attr( 'method' ),
			url: $form.attr( 'action' ),
			data: $form.serialize(),
			cache: false,
			dataType: 'jsonp',
			contentType: 'application/json; charset=utf-8',
			error: function( err ) {
				alert( 'Could not connect to the registration server. Please try again later.' );
			},
			success: function( data ) {
			$( '#mc-embedded-subscribe' ).val( 'subscribe' );
				if (  'success' === data.result ) {
					console.log( data.msg );
					$( '.subscribeform' ).html( '<div class="mailchimp-result"><h2>' + data.msg + '</h2></div>' );
				} else {
					console.log( data.msg );
					$( '#mailchimp-send' ).val( 'Subscribe' );
					alert( data.msg.substring( 4 ) );
				}
			}
		});
	};
});
