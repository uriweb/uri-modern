<?php

/**
 * Gutenberg
 *
 * @package uri-modern
 */

// @see https://www.billerickson.net/getting-your-theme-ready-for-gutenberg/
// @todo: do we want align wide for images?
// add_theme_support( 'align-wide' );
// js way to disable a block:
// wp.blocks.unregisterBlockType( 'core/verse' );

/**
 * Gutenberg scripts and styles
 */
function uri_modern_gutenberg_scripts()
{
	$file = get_template_directory_uri() . '/js/block-editor.min.js';
	wp_enqueue_script('uri-modern-block-editor', $file, array('wp-blocks', 'wp-dom'), uri_modern_cache_buster(), true);
}
add_action('enqueue_block_editor_assets', 'uri_modern_gutenberg_scripts');

/**
 * Specifiy which core blocks are permitted.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/core-blocks/
 * @see https://wordpress.stackexchange.com/questions/379612/how-to-remove-the-core-embed-blocks-in-wordpress-5-6
 * @return arr
 */
function uri_modern_allowed_blocks($allowed_blocks, $post)
{

	$allowed_blocks = array(
		'core/block',
		// ===== CORE - COMMON =====
		'core/paragraph',
		'core/image',
		'core/heading',
		'core/gallery',
		'core/list',
		'core/list-item',
		// ===== CORE - FORMATTING =====
		'core/table',
		'core/freeform', // Classic
		'core/html',
		// ===== CORE - LAYOUT =====
		'core/columns',
		'core/column',
		'core/separator',
		'core/spacer',
		// ===== CORE - WIDGETS =====
		'core/shortcode',
		// ===== URI - COMPONENT LIBRARY =====
		'uri-cl/boxout',
		'uri-cl/breakout',
		'uri-cl/button',
		'uri-cl/card',
		'uri-cl/hero',
		'uri-cl/metric',
		'uri-cl/menu',
		'uri-cl/notice',
		'uri-cl/panel',
		'uri-cl/promo',
		'uri-cl/quote',
		'uri-cl/tab',
		'uri-cl/tabs',
		// ===== URI - MISC =====
		'uri-courses/by-subject',
		// ===== THIRD-PARTY =====
		'gravityforms/form',
		'ninja-tables/guten-block',
	);

	// Allow some blocks for admins only
	if (uri_modern_has_admin_privilages()) {
		array_push(
			$allowed_blocks,
			// ===== CORE - COMMON =====
			'core/file',
			// ===== CORE - FORMATTING =====
			'core/code',
			// ===== CORE - LAYOUT =====
			'core/group',
			'core/media-text',
			// ===== CORE - WIDGETS =====
			'core/calendar',
			'core/rss',
			'core/search',
			// ===== URI - COMPONENT LIBRARY =====
			'uri-cl/abstract', // in beta
			'uri-cl/date',
			// ===== URI - MISC =====
			'uri/dynamic-metrics', // in beta
		);
	}

	return $allowed_blocks;
}
add_filter('allowed_block_types_all', 'uri_modern_allowed_blocks', 10, 2);



/**
 * Custom editor colors.
 */
function uri_modern_custom_colors()
{
	add_theme_support('editor-color-palette', array());
	add_theme_support('editor-gradient-presets', array());
	add_theme_support('disable-custom-colors');
	add_theme_support('disable-custom-gradients');
}
add_action('after_setup_theme', 'uri_modern_custom_colors');

/**
 * Removes options for different font sizes
 * Not in use since we're using CSS to hide the entire pane
 *
 * @see https://make.wordpress.org/core/2020/01/23/controlling-the-block-editor/
 */
function uri_modern_set_font_sizes()
{
	// removes the text box where users can specify custom font sizes
	add_theme_support('editor-font-sizes', array());
	add_theme_support('disable-custom-font-sizes');
}
add_action('after_setup_theme', 'uri_modern_set_font_sizes');

/**
 * Custom block editor CSS.
 */
function uri_modern_block_editor_styles()
{
	add_theme_support('editor-styles');
	add_editor_style('style.admin.css');
}
add_action('after_setup_theme', 'uri_modern_block_editor_styles');


// Remove patterns
function uri_modern_remove_patterns()
{
	remove_theme_support('core-block-patterns');
}
add_action('after_setup_theme', 'uri_modern_remove_patterns');

/**
 * Removes the dropcap widget with a little injected css.
 */
// function uri_modern_hide_font_styles() {
// https://github.com/WordPress/gutenberg/issues/6184
// hide dropcap only
// echo '<style>.blocks-font-size .components-base-control:first-of-type { margin-bottom: 0; } .blocks-font-size .components-toggle-control { display: none; }</style>';
// hide the entire font size section
// echo '<style>.blocks-font-size * { display: none; } .blocks-font-size { border: 0 !important; height: 0; padding: 0 !important; margin-top: 32px !important; }</style>';
// }
// add_action( 'admin_head', 'uri_modern_hide_font_styles' );

/**
 * Disable Openverse
 */
function uri_modern_disable_openverse($settings)
{
	$settings['enableOpenverseMediaCategory'] = false;
	return $settings;
}
add_filter('block_editor_settings_all', 'uri_modern_disable_openverse');

/**
 * Disable Font Library
 */

function uri_modern_disable_font_library($settings)
{
	$settings['fontLibraryEnabled'] = false;
	return $settings;
}
add_filter('block_editor_settings_all', 'uri_modern_disable_font_library');

/**
 * Disable Style Tab in the Block Inspector
 */

function uri_modern_disable_inspector_tabs_by_default($settings)
{
	$settings['blockInspectorTabs'] = array('default' => false);
	return $settings;
}
add_filter('block_editor_settings_all', 'uri_modern_disable_inspector_tabs_by_default');


/**
 * Disable typography
 */
function uri_modern_disable_typography_for_specific_blocks($args, $block_type)
{

	// List of block types to modify.
	$block_types_to_modify = [
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/list-item',
		'core/columns',
		'core/column',
		'core/media-text',
		'core/table'
	];

	// Check if the current block type is in the list.
	if (in_array($block_type, $block_types_to_modify, true)) {
		// Disable typography controls.
		$args['supports']['typography'] = array(
			'defaultFontSizes' => false,
			'customFontSize' => false,
			'letterSpacing' => false,
			'textDecoration' => false
		);
	}

	return $args;
}
add_filter('register_block_type_args', 'uri_modern_disable_typography_for_specific_blocks', 10, 2);


/**
 * Disable duotone
 */
function uri_modern_disable_duotone_for_specific_blocks($args, $block_type)
{

	// List of block types to modify.
	$block_types_to_modify = [
		'core/image'
	];

	// Check if the current block type is in the list.
	if (in_array($block_type, $block_types_to_modify, true)) {
		// Disable duotone
		$args['supports']['filter'] = array(
			'duotone' => false
		);
	}

	return $args;
}
add_filter('register_block_type_args', 'uri_modern_disable_duotone_for_specific_blocks', 10, 2);


/**
 * Disable dropcap
 */
function uri_modern_disable_typography ($theme_json) {
	$new_data = array(
		'version'  => 3,
		'settings' => array(
			'appearanceTools' => false,
			'typography' => array(
				'customFontSize' => false,
				'dropCap' => false,
			),
		),
	);

	return $theme_json->update_with( $new_data );
}

add_filter( 'wp_theme_json_data_default', 'uri_modern_disable_typography', 10, 2 );


