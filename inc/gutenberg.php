<?php
/**
 * Gutenberg
 *
 * @package uri-modern
 */

// @see https://www.billerickson.net/getting-your-theme-ready-for-gutenberg/

/**
 *
 */

// @todo: do we want align wide for images?
// @todo: how about caption styles?
//add_theme_support( 'align-wide' );

// js way to disable a block:
// wp.blocks.unregisterBlockType( 'core/verse' );

/**
 * Specifiy which core blocks are permitted.
 *
 * @return arr
 */

function uri_modern_allowed_blocks( $allowed_blocks ) {
	return array(
		'core/shortcode',
		'core/image',
		'core/gallery',
		'core/heading',
		'core/quote',
		'core/embed',
		'core/list',
		'core/separator',
		'core/more',
// 		'core/button',
		'core/pullquote',
		'core/table',
		'core/preformatted',
		'core/code',
		'core/html',
		'core/freeform',
		'core/latest-posts',
		'core/categories',
		'core/cover-image',
		'core/text-columns',
// 		'core/verse',
		'core/video',
		'core/audio',
		'core/block',
		'core/paragraph',
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
// 		'core-embed/collegehumor',
// 		'core-embed/dailymotion',
// 		'core-embed/funnyordie',
		'core-embed/hulu',
		'core-embed/imgur',
		'core-embed/issuu',
// 		'core-embed/kickstarter',
// 		'core-embed/meetup-com',
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
		'core-embed/wordpress-tv'
	);
}
add_filter( 'allowed_block_types', 'uri_modern_allowed_blocks' );


// Editor Styles
add_theme_support( 'editor-styles' );
add_editor_style( 'style.css' );






// COLORS //

// disable option for custom colors
add_theme_support( 'disable-custom-colors' );

// Adds support for editor color palette.
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'URI Blue', 'uri' ),
		'slug'  => 'uri-gray',
		'color'	=> '#002147',
	),
	array(
		'name'  => __( 'Light Blue', 'uri' ),
		'slug'  => 'light-blue',
		'color' => '#c0ddf2',
	),
	array(
		'name'  => __( 'Keaney Blue', 'uri' ),
		'slug'  => 'keaney-blue',
		'color' => '#2277b3',
	),
	array(
		'name'  => __( 'Dark Blue', 'uri' ),
		'slug'  => 'dark-blue',
		'color' => '#001228',
	),
	array(
		'name'  => __( 'URI Gold', 'uri' ),
		'slug'  => 'uri-gold',
		'color' => '#b5985a',
	),
	array(
		'name'  => __( 'Mid Gold', 'uri' ),
		'slug'  => 'mid-gold',
		'color' => '#ffd453',
	),
	array(
		'name'  => __( 'Light Gold', 'uri' ),
		'slug'  => 'light-gold',
		'color' => '#fefada',
	),
	array(
		'name'  => __( 'URI Gray', 'uri' ),
		'slug'  => 'uri-gray',
		'color' => '#dddddd',
	),
	array(
		'name'  => __( 'Light Gray', 'uri' ),
		'slug'  => 'light-gray',
		'color' => '#fafafa',
	),
	array(
		'name'  => __( 'Mid Gray', 'uri' ),
		'slug'  => 'mid-gray',
		'color' => '#999999',
	),
	array(
		'name'  => __( 'Dark Gray', 'uri' ),
		'slug'  => 'dark-gray',
		'color' => '#555555',
	),
	array(
		'name'  => __( 'White', 'uri' ),
		'slug'  => 'white',
		'color' => '#fff',
	),
	array(
		'name'  => __( 'Black', 'uri' ),
		'slug'  => 'black',
		'color' => '#000',
	),
	array(
		'name'  => __( 'Link Blue', 'uri' ),
		'slug'  => 'link-blue',
		'color' => '#005eff',
	),
	array(
		'name'  => __( 'Link Hover Blue', 'uri' ),
		'slug'  => 'link-hover-blue',
		'color' => '#003287',
	),

) );