jQuery( document ).ready( function( $ ) {
	$( '.show-sub' ).on( 'click', function( e ) {
		e.preventDefault();
		$( this ).next().slideToggle();
	});
});
