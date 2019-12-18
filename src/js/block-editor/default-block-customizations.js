/**
 * Block Editor
 *
 * @package uri-modern
 */

// jshint esversion: 6
// jscs:disable requireVarDeclFirst
( function() {

	'use strict';

	wp.domReady(
		() => {
			wp.blocks.unregisterBlockType( 'core/button' );
			// Possible alternatives
			// wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
			// wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
			// wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );
		}
	);

	jQuery( document ).ready(
		function( $ ) {

			// Featured image checkbox id: #acf-field_5afadb7ad2b38
			// featured image checkbox id: #acf-field_502b9eb29fc45
			// @see inc/layout-options.php
			var f = $( '#acf-field_502b9eb29fc45' );
			if ( f.is( ':checked' ) ) {
				toggleTitle();
			}
			f.on( 'change', toggleTitle );
		}
	);

	function toggleTitle() {
		jQuery( '.editor-post-title' ).toggle( 400 );
	}
}
)();
