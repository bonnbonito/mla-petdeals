jQuery( document ).ready( function( $ ) {
	$( '#datepicker' ).datepicker({
		altFormat: 'yymmdd',
		altField: '#pet_dob'
	});

	let avatarFrame = wp.media({
		title: 'Select or Upload Media',
		library: {
			type: 'image'
		},
        button: {
            text: 'Use this media'
        },
        multiple: false
	});

	$( '#add-image-avatar' ).on( 'click', function( e ) {
        e.preventDefault();
        avatarFrame.open();
	});

	avatarFrame.on( 'select', function() {
        var attachment = avatarFrame.state().get( 'selection' ).first().toJSON();
        $( '#add-image-avatar img' ).attr( 'src', attachment.url );
        $( '#avatar_image' ).val( attachment.id );
	});

	let featuredFrame1 = wp.media({
		title: 'Select or Upload Media',
		library: {
			type: 'image'
		},
        button: {
            text: 'Use this media'
        },
        multiple: false
	});

	let featuredFrame2 = wp.media({
		title: 'Select or Upload Media',
		library: {
			type: 'image'
		},
        button: {
            text: 'Use this media'
        },
        multiple: false
	});

	let featuredFrame3 = wp.media({
		title: 'Select or Upload Media',
		library: {
			type: 'image'
		},
        button: {
            text: 'Use this media'
        },
        multiple: false
	});

	let featuredFrame4 = wp.media({
        title: 'Select or Upload Media',
        button: {
            text: 'Use this media'
		},
		library: {
			type: 'image'
		},
        multiple: false
	});

	let featuredFrame5 = wp.media({
		title: 'Select or Upload Media',
		library: {
			type: 'image'
		},
        button: {
            text: 'Use this media'
        },
        multiple: false
	});

	$( '#add-image-1-btn' ).on( 'click', function( e ) {
        e.preventDefault();
        featuredFrame1.open();
	});

	featuredFrame1.on( 'select', function() {
        var attachment = featuredFrame1.state().get( 'selection' ).first().toJSON();
        $( '#add-image-1-btn img' ).attr( 'src', attachment.url );
        $( '#ad_image_1' ).val( attachment.id );
	});

	$( '#add-image-2-btn' ).on( 'click', function( e ) {
        e.preventDefault();
        featuredFrame2.open();
	});

	featuredFrame2.on( 'select', function() {
        var attachment = featuredFrame2.state().get( 'selection' ).first().toJSON();
        $( '#add-image-2-btn img' ).attr( 'src', attachment.url );
        $( '#ad_image_2' ).val( attachment.id );
	});

	$( '#add-image-3-btn' ).on( 'click', function( e ) {
        e.preventDefault();
        featuredFrame3.open();
	});

	featuredFrame3.on( 'select', function() {
        var attachment = featuredFrame3.state().get( 'selection' ).first().toJSON();
        $( '#add-image-3-btn img' ).attr( 'src', attachment.url );
        $( '#ad_image_3' ).val( attachment.id );
	});

	$( '#add-image-4-btn' ).on( 'click', function( e ) {
        e.preventDefault();
        featuredFrame4.open();
	});

	featuredFrame4.on( 'select', function() {
        var attachment = featuredFrame4.state().get( 'selection' ).first().toJSON();
        $( '#add-image-4-btn img' ).attr( 'src', attachment.url );
        $( '#ad_image_4' ).val( attachment.id );
	});

	$( '#add-image-5-btn' ).on( 'click', function( e ) {
        e.preventDefault();
        featuredFrame5.open();
	});

	featuredFrame5.on( 'select', function() {
        var attachment = featuredFrame5.state().get( 'selection' ).first().toJSON();
        $( '#add-image-5-btn img' ).attr( 'src', attachment.url );
        $( '#ad_image_5' ).val( attachment.id );
    });

	let allowsubmit = false;
	$( '#confpass' ).keyup( function( e ) {
		var pass = $( '#pass' ).val();
		var confpass = $( this ).val();

		// check the strings
		if ( pass == confpass ) {

			// if both are same remove the error and allow to submit.
			$( '.error' ).text( '' );
			allowsubmit = true;
		} else {

			// if not matching show error and not allow to submit.
			$( '.error' ).text( 'Password not matching' );
			allowsubmit = false;
		}
	});

	$( '#changeLoginDetails' ).on( 'submit', function( e ) {
		e.preventDefault();
	});

	$( '#pet-form' ).on( 'submit', function( e ) {
		e.preventDefault();

		if ( true != $( '#agree-privacy' ).prop( 'checked' ) ) {
			alert( 'Please check that you agree to our policy.' );
		} else {
			let account = $( '#account_type' ).val();
			$( '#register-status' ).html(
				'<div class="alert alert-info">Please wait while your account is being created.</div>'
			);
			$( '.loading-overlay' ).show();

			let form                =   {
				action: 'petdeals_create_account',
				accountType: account,
				fname: $( '#pet-form-fname' ).val(),
				lname: $( '#pet-form-lname' ).val(),
				tel: $( '#pet-form-tel' ).val(),
				email: $( '#pet-form-email' ).val(),
				pass: $( '#pet-form-password' ).val(),
				subscribe: $( '#subscribe-newsletter' ).val(),
				confirmPass: $( '#pet-form-repassword' ).val(),
				_wpnonce: $( '#_wpnonce' ).val()
			};

			if ( $( '#pet-form-password' ).val() !== $( '#pet-form-repassword' ).val() ) {

				$( '#register-status' ).html(
					'<div class="alert alert-danger">' +
					'Unable to create an account. Passwords are not the same.' +
					'</div>'
				);

				$( '.loading-overlay' ).hide();

			} else {
				$.post( petDeals.ajax_url, form ).always( function( response ) {
					console.log( response );
					switch ( response.status ) {
						case 3:
						$( '#register-status' ).html(
							'<div class="alert alert-danger">' +
							'Unable to create an account. Username exists.' +
							'</div>'
						);
						$( '.loading-overlay' ).hide();
						break;
						case 4:
						$( '#register-status' ).html(
							'<div class="alert alert-danger">' +
							'Unable to create an account. Please try again with a different email.' +
							'</div>'
						);
						$( '.loading-overlay' ).hide();
						break;
						case 5:
						$( '#register-status' ).html(
							'<div class="alert alert-danger">' +
							'Unable to create an account. Passwords are not the same.' +
							'</div>'
						);
						$( '.loading-overlay' ).hide();
						break;
						case 6:
						$( '#register-status' ).html(
							'<div class="alert alert-danger">' +
							'Unable to create an account. Please input a correct email.' +
							'</div>'
						);
						$( '.loading-overlay' ).hide();
						break;
						case 1:
						$( '#register-status' ).html(
							'<div class="alert alert-danger">' +
							'Unable to create an account. Try again later.' +
							'</div>'
						);
						$( '.loading-overlay' ).hide();
						break;
						default:
						$( '#pet-form' ).hide();
						$( '.loading-overlay' ).hide();
						$( '#register-status' ).html( '<div class="alert alert-success">Account created! Please check your email for verification.</div>' );
					}
				});
			}
		}
	});

	$( '#newadvert' ).on( 'submit', function( e ) {
		e.preventDefault();

		if ( true != $( '#agree-privacy' ).prop( 'checked' ) ) {
			alert( 'Please check that you agree to our terms and policy privacy.' );
		} else {
			$( '#submit-ad' ).html( 'Please wait <i class="fas fa-spinner fa-spin"></i>' );
			let form = $( this ).serialize();
			console.log( form );
			$.post( petDeals.ajax_url, form ).always( function( response ) {
				console.log( response );
				if ( 2 == response.status ) {
					window.location.replace( petDeals.root_url + '/my-account/manage-ads/' );
				} else {
					alert( 'Something wrong. Please contact us.' );
				}
			});
		}
	});

	$( '#editadvert' ).on( 'submit', function( e ) {
		e.preventDefault();
		if ( true != $( '#agree-privacy' ).prop( 'checked' ) ) {
			alert( 'Please check that you agree to our terms and policy privacy.' );
		} else {
		$( '#submit-edit' ).html( 'Please wait <i class="fas fa-spinner fa-spin"></i>' );
			let form = $( this ).serialize();
			console.log( form );
			$.post( petDeals.ajax_url, form ).always( function( response ) {
				if ( 2 == response.status ) {
					window.location.replace( petDeals.root_url + '/my-account/manage-ads/' );
				} else {
					alert( 'Something wrong. Please contat us.' );
				}
			});
		}
	});
	$( '#submit-delete' ).on( 'click', function( e ) {
		e.preventDefault();
		let ad      = $( this ).data( 'ad' ),
			approve = confirm( 'Do you really want to delete this advert?' );

		if ( true == approve ) {

			$( this ).html( '<i class="fas fa-trash-alt"></i> DELETING... <i class="fas fa-spinner fa-spin"></i>' );

			console.log( ad );

			$.ajax({
				beforeSend: ( xhr ) => {
					xhr.setRequestHeader( 'X-WP-Nonce', favorite.nonce );
				},
				url: favorite.root_url + '/wp-json/petdeals/v1/ad',
				type: 'DELETE',
				data: { 'id': ad },
				success: ( response ) => {
					console.log( response );
					alert( 'Ad Deleted' );
					window.location.replace( petDeals.root_url + '/my-account/manage-ads/' );
				},
				error: ( response ) => {
					console.log( response );
				}
			});

		}
	});

	function checkPasswordStrength( $pass1, $pass2, $strengthResult, $submitButton, blacklistArray ) {

		let pass1 = $pass1.val();
		let pass2 = $pass2.val();

		// Reset the form & meter
		// $submitButton.attr( 'disabled', 'disabled' ).html( '<i class="fas fa-exclamation-triangle"></i> CREATE MY ACCOUNT' );
		$strengthResult.removeClass( 'short bad good strong' );

		// Extend our blacklist array with those from the inputs & site data
		blacklistArray = blacklistArray.concat( wp.passwordStrength.userInputBlacklist() );

		// Get the password strength
		let strength = wp.passwordStrength.meter( pass1, blacklistArray, pass2 );

		// Add the strength meter results
		switch ( strength ) {

		case 2:
		$( '#pass-review' ).html().show();
		$strengthResult.addClass( 'bad' ).html( pwsL10n.bad );
		break;

		case 3:
		$( '#pass-review' ).hide();
		$strengthResult.addClass( 'good' ).html( pwsL10n.good );
		break;

		case 4:
		$( '#pass-review' ).hide();
		$strengthResult.addClass( 'strong' ).html( pwsL10n.strong );
		break;

		case 5:
		$( '#pass-review' ).show();
		$strengthResult.addClass( 'short' ).html( pwsL10n.mismatch );
		break;

		default:
		$( '#pass-review' ).show();
			$strengthResult.addClass( 'short' ).html( pwsL10n.short );
		}

		// The meter function returns a result even if pass2 is empty,
		// enable only the submit button if the password is strong and
		// both passwords are filled up
		if ( ( 4 === strength || 3 === strength || 2 === strength ) && '' !== pass2.trim() ) {
			$submitButton.removeAttr( 'disabled' ).html( '<i class="fas fa-check-circle"></i> CREATE MY ACCOUNT' );
		}

		return strength;
	}

	// $( '#pet-form' ).on( 'keyup', '#pet-form-password, #pet-form-repassword',
    //     function( event ) {
    //         checkPasswordStrength(
    //             $( '#pet-form-password' ), // First password field
    //             $( '#pet-form-repassword' ), // Second password field
    //             $( '#password-strength' ), // Strength meter
    //             $( '#pet-form-submit' ), // Submit button
    //             []        // Blacklisted words
    //         );
    //     }
	// );

	$( '.show-dashboard button' ).on( 'click', function( e ) {
		e.preventDefault();
		$( '.show-dashboard' ).toggleClass( 'show' );
		if ( $( '.show-dashboard' ).hasClass( 'show' ) ) {
			$( '.show-dashboard button' ).html( '<i class="fas fa-times"></i> CLOSE' );
		} else {
			$( '.show-dashboard button' ).html( '<i class="fas fa-bars"></i> DASHBOARD' );
		}
		$( '.dashboard-left' ).toggleClass( 'show' );
	});

});
