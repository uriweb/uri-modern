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
			// wp.blocks.unregisterBlockType( 'core/button' );
			// wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
			wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
			wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );
		}
	);

})();
