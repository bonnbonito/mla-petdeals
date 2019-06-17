jQuery( document ).ready( function( $ ) {
	$( 'input[type="number"]' ).spinner();
	$( '.show-sub' ).on( 'click', function( e ) {
		e.preventDefault();
		$( this ).next().slideToggle();
	});
});
