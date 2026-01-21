/**
 * Search Bar Focus Control
 *
 */

( function() {
	'use strict';

	window.addEventListener( 'load', initSearchBar, false );

	function initSearchBar() {
		const gstoggle = document.getElementById( 'gsform' ),
			gsquery = document.getElementById( 'gs-query' ),
			gs = document.getElementById( 'gs' );

		gstoggle.addEventListener(
			'click',
			() => {
				gstoggle.classList.toggle( 'gsform-show' );
				gs.classList.toggle( 'gs-show' );
				gsquery.focus();

				if ( gstoggle.classList.contains( 'gsform-show' ) ) {
					gstoggle.setAttribute( 'aria-expanded', "true" );
				} else {
					gstoggle.setAttribute( 'aria-expanded', "false" );
				}
			}
		);
	}
}() );
