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

		/*if ( document.body.classList.contains( 'ln-search' ) ) {
			gstoggle.checked = true;
		} */

		gstoggle.addEventListener(
			'click',
			() => {
				gstoggle.classList.toggle("gsform-show");
				gstoggle.setAttribute('aria-expanded', "true");
				gs.classList.toggle("gs-show");
				gsquery.focus();

				/*if ( this.checked ) {
					gsquery.focus();
				} else {
					gsquery.blur();
				}
					*/
			}
		);
	}
}() );
