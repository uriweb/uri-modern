<?php
/**
 * Shortcodes
 *
 * @package uri-modern
 */

/**
 * Expose the Format menu in TinyMCE
 */
function uri_modern_wysiwyg_enable_styles_menu( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons_2', 'uri_modern_wysiwyg_enable_styles_menu' );


/**
 * Callback function to filter the MCE Format Menu settings
 * Add URI Modern styles to the menu
 */
function uri_modern_wysiwyg_insert_formats( $init_array ) {

	$style_formats = array(
		// for reasons unknown, WP doesn't like using p for 'block'
		array(
			'title' => 'Introduction',
			'block' => 'div',
			'classes' => 'type-intro',
			'wrapper' => true,
		),
		array(
			'title' => 'Full Width',
			'block' => 'div',
			'classes' => 'fullwidth',
			'wrapper' => true,
		),
		array(
			'title' => 'Breakout',
			'block' => 'div',
			'classes' => 'breakout',
			'wrapper' => true,
		),
		array(
			'title' => 'Feature Caption',
			'block' => 'div',
			'classes' => 'feature-caption',
			'wrapper' => true,
		),
	// array(
	// 'title' => 'Red Uppercase Text',
	// 'inline' => 'span',
	// 'styles' => array(
	// 'color' => '#ff0000',
	// 'fontWeight' => 'bold',
	// 'textTransform' => 'uppercase'
	// )
	// ),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
add_filter( 'tiny_mce_before_init', 'uri_modern_wysiwyg_insert_formats' );
