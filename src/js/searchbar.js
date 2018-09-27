/**
 * Search Bar Focus Control
 *
 * @package uri-modern
 */

( function() {

	'use strict';

	window.addEventListener( 'load', initSearchBar, false );

	function initSearchBar() {
		var gstoggle = document.getElementById( 'gsform-toggle' ),
			gsquery  = document.getElementById( 'gs-query' );

		if ( document.body.classList.contains( 'ln-search' ) ) {
			gstoggle.checked = true;
		}

		gstoggle.addEventListener(
			'change',
			function() {
				if ( this.checked ) {
					gsquery.focus();
				} else {
					gsquery.blur();
				}
			}
		);
	}

})();
