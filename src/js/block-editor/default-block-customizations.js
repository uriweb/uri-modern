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
			wp.blocks.unregisterBlockStyle( 'core/image', 'circle-mask' );
			wp.blocks.unregisterBlockType( 'core/button' );

			// Possible alternatives
			// wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
			// wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
			// wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );
			const f = jQuery( '#acf-field_502b9eb29fc45' );
			if ( f.prop( 'checked' ) ) {
				toggleTitle();
			}
			f.on( 'change', toggleTitle );
		}
	);

	function toggleTitle() {
		jQuery( '.editor-post-title' ).fadeToggle( 400 );
	}
}() );
