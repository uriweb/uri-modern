/**
 * Block Editor
 *
 */

// jshint esversion: 6
// jscs:disable requireVarDeclFirst
( function() {
	'use strict';

	wp.domReady(
		() => {
			wp.blocks.unregisterBlockStyle( 'core/image', 'circle-mask' );
			wp.blocks.unregisterBlockStyle( 'core/image', 'rounded' );
			wp.blocks.unregisterBlockStyle( 'core/table', 'stripes' );
			wp.blocks.unregisterBlockStyle( 'core/separator', 'wide' );

			// Possible alternatives
			// wp.blocks.unregisterBlockType( 'core/button' );
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


/**
 * Disables the drop cap feature in the block editor
 */
var removeDropCap = function(settings, name) {
	if (name !== 'core/paragraph') {
		return settings;
	}

	var newSettings = Object.assign({}, settings);

	if (
		newSettings.supports &&
		newSettings.supports.__experimentalFeatures &&
		newSettings.supports.__experimentalFeatures.typography &&
		newSettings.supports.__experimentalFeatures.typography.dropCap
	) {
		newSettings.supports.__experimentalFeatures.typography.dropCap = false;
	}

	return newSettings;
	};

	wp.hooks.addFilter(
		'blocks.registerBlockType',
		'sc/gb/remove-drop-cap',
		removeDropCap
	);