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
function uri_modern_gutenberg_scripts() {
	$file = get_template_directory_uri() . '/js/block-editor.min.js';
	wp_enqueue_script( 'uri-modern-block-editor', $file, array( 'wp-blocks', 'wp-dom' ), uri_modern_cache_buster(), true );
}
add_action( 'enqueue_block_editor_assets', 'uri_modern_gutenberg_scripts' );

/**
 * Specifiy which core blocks are permitted.
 *
 * @return arr
 */
function uri_modern_allowed_blocks( $allowed_blocks, $post ) {
	return array(
		'core/block',
		// ===== CORE - COMMON =====
		'core/paragraph',
		'core/image',
		'core/heading',
		// 'core/subhead',
		'core/gallery',
		'core/list',
		// 'core/quote',
		//'core/audio',
		//'core/cover',
		'core/file',
		//'core/video',
		// ===== CORE - FORMATTING =====
		'core/table',
		//'core/verse',
		'core/code',
		'core/freeform', // Classic
		'core/html',
		//'core/preformatted',
		// 'core/pullquote',
		// ===== CORE - LAYOUT =====
		// 'core/button',
		'core/columns',
		'core/group',
		'core/media-text',
		//'core/more',
		//'core/nextpage', // Page break
		'core/separator',
		'core/spacer',
		// ===== CORE - WIDGETS =====
		'core/shortcode',
		//'core/archives',
		//'core/categories',
		//'core/latest-comments',
		//'core/latest-posts',
		'core/calendar',
		'core/rss',
		'core/search',
		//'core/tag-cloud',
		// ===== CORE - EMBEDS =====
		//'core/embed', // @see https://wordpress.stackexchange.com/questions/379612/how-to-remove-the-core-embed-blocks-in-wordpress-5-6
		// ===== URI - COMPONENT LIBRARY =====
		'uri-cl/abstract',
		'uri-cl/boxout',
		'uri-cl/breakout',
		'uri-cl/button',
		'uri-cl/card',
		'uri-cl/date',
		'uri-cl/hero',
		//'uri-cl/hero2', // Legacy hero registration (I think) -BF
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
		'uri/dynamic-metrics',
		// ===== THIRD-PARTY =====
		'gravityforms/form',
		'ninja-tables/guten-block',
	);
}
add_filter( 'allowed_block_types', 'uri_modern_allowed_blocks', 10, 2 );



/**
 * Custom editor colors.
 */
function uri_modern_custom_colors() {
	add_theme_support( 'editor-color-palette', array() );
	add_theme_support( 'editor-gradient-presets', array() );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-gradients' );
}
add_action( 'after_setup_theme', 'uri_modern_custom_colors' );

/**
 * Removes options for different font sizes
 * Not in use since we're using CSS to hide the entire pane
 *
 * @see https://make.wordpress.org/core/2020/01/23/controlling-the-block-editor/
 */
function uri_modern_set_font_sizes() {
	// removes the text box where users can specify custom font sizes
	add_theme_support( 'editor-font-sizes', array() );
}
add_action( 'after_setup_theme', 'uri_modern_set_font_sizes' );

/**
 * Custom block editor CSS.
 */
function uri_modern_block_editor_styles() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.admin.css' );
}
add_action( 'after_setup_theme', 'uri_modern_block_editor_styles' );




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
