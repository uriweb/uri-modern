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
		// common
		'core/paragraph',
		'core/image',
		'core/heading',
		// 'core/subhead',
		'core/gallery',
		'core/list',
		// 'core/quote',
		'core/audio',
		'core/cover', // previously core/cover-image
		'core/file',
		'core/video',
		// formatting
		'core/table',
		'core/verse',
		'core/code',
		'core/freeform', // Classic
		'core/html', // Custom HTML
		'core/preformatted',
		// 'core/pullquote',
		// layout
		// 'core/button',
		'core/columns',
		'core/media-text',
		'core/more',
		'core/nextpage', // Page break
		'core/separator',
		'core/spacer',
		// widgets
		'core/shortcode',
		'core/archives',
		'core/categories',
		'core/latest-comments',
		'core/latest-posts',
		'core/calendar',
		'core/rss',
		'core/search',
		'core/tag-cloud',
		// embeds
		'core/embed',
		'core-embed/twitter',
		'core-embed/youtube',
		'core-embed/facebook',
		'core-embed/instagram',
		'core-embed/wordpress',
		'core-embed/soundcloud',
		'core-embed/spotify',
		'core-embed/flickr',
		'core-embed/vimeo',
		'core-embed/animoto',
		'core-embed/cloudup',
		'core-embed/collegehumor',
		'core-embed/dailymotion',
		'core-embed/funnyordie',
		'core-embed/hulu',
		'core-embed/imgur',
		'core-embed/issuu',
		'core-embed/kickstarter',
		'core-embed/meetup-com',
		'core-embed/mixcloud',
		'core-embed/photobucket',
		'core-embed/polldaddy',
		'core-embed/reddit',
		'core-embed/reverbnation',
		'core-embed/screencast',
		'core-embed/scribd',
		'core-embed/slideshare',
		'core-embed/smugmug',
		'core-embed/speaker',
		'core-embed/ted',
		'core-embed/tumblr',
		'core-embed/videopress',
		'core-embed/wordpress-tv',
		// component library
		'uri-cl/boxout',
		'uri-cl/button',
		'uri-cl/card',
		'uri-cl/date',
		'uri-cl/hero',
		'uri-cl/hero2',
		'uri-cl/metric',
		'uri-cl/menu',
		'uri-cl/notice',
		'uri-cl/panel',
		'uri-cl/promo',
		'uri-cl/quote',
		'uri-cl/tab',
		'uri-cl/tabs',
		'uri-courses/by-subject',
		'gravityforms/form',
	);
}
add_filter( 'allowed_block_types', 'uri_modern_allowed_blocks', 10, 2 );


// Editor Styles
add_theme_support( 'editor-styles' );
add_editor_style( 'style.admin.css' );




// COLORS //
// disable option for custom colors
add_theme_support( 'disable-custom-colors' );
// register custom palette with no colors to hide the color options entirely
add_theme_support( 'editor-color-palette' );


/**
 * Removes some core patterns, adds a few new ones.
 */
function uri_modern_manage_patterns() {

	if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
		return false;
	}

	$patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();

	// unregister every core pattern
// foreach( $patterns as $p ) {
// if ( 'core' === substr( $p['name'], 0, 4 ) ) {
// unregister_block_pattern( $p['name'] );
// }
// }
	// unregister selected core patterns
	unregister_block_pattern( 'core/two-buttons' );
	unregister_block_pattern( 'core/three-buttons' );
	// unregister_block_pattern( 'core/text-two-columns' );
	// unregister_block_pattern( 'core/two-images' );
	// unregister_block_pattern( 'core/text-two-columns-with-images' );
	unregister_block_pattern( 'core/text-three-columns-buttons' );
	// unregister_block_pattern( 'core/large-header' );
	// unregister_block_pattern( 'core/large-header-button' );
	// unregister_block_pattern( 'core/heading-paragraph' );
	// unregister_block_pattern( 'core/quote' );
	// unregister every core category
	unregister_block_pattern_category( 'buttons' );
// unregister_block_pattern_category( 'columns' );
// unregister_block_pattern_category( 'gallery' );
// unregister_block_pattern_category( 'header' );
// unregister_block_pattern_category( 'text' );
}
add_action( 'enqueue_block_editor_assets', 'uri_modern_manage_patterns' );

/**
 * Removes the dropcap widget with a little injected css.
 */
function uri_modern_hide_font_styles() {
	// https://github.com/WordPress/gutenberg/issues/6184
	// hide dropcap only
	// echo '<style>.blocks-font-size .components-base-control:first-of-type { margin-bottom: 0; } .blocks-font-size .components-toggle-control { display: none; }</style>';
	// hide the entire font size section
	echo '<style>.blocks-font-size * { display: none; } .blocks-font-size { border: 0 !important; height: 0; padding: 0 !important; margin-top: 32px !important; }</style>';
}
add_action( 'admin_head', 'uri_modern_hide_font_styles' );


/**
 * Removes options for different font sizes
 * Not in use since we're using CSS to hide the entire pane
 *
 * @see uri_modern_hide_font_styles
 */
function uri_modern_set_font_sizes() {
	// removes the text box where users can enter custom pixel sizes
	add_theme_support( 'disable-custom-font-sizes' );
	// forces the dropdown for font sizes to only contain "normal"
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => 'Normal',
				'size' => 20,
				'slug' => 'normal',
			),
		)
	);
}
// add_action( 'after_setup_theme', 'uri_modern_set_font_sizes' );
