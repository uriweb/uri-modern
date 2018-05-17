/**
 * You menu control
 *
 * @package uri-modern
 */

( function() {

	'use strict';

	window.addEventListener( 'load', initYouMenu, false );

	function initYouMenu() {

		var gateways, input;

		gateways = document.getElementById( 'gateways' );
		input = document.getElementById( 'gateways-toggle' );

		window.addEventListener(
			'click', function( e ) {
				if ( input.checked && ! gateways.contains( e.target ) ) {
						input.checked = false;
				}
			}, false
			);

	}

})();
