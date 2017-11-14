<?php
/**
 * URI Modern Theme Layout Options
 *
 * @package uri-modern
 */	

/**
 * Register field groups
 * The register_field_group function accepts 1 array which holds the relevant data to register a field group
 * You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 * This code must run every time the functions.php file is read
 */

if(function_exists('register_field_group')) {

    register_field_group(array (
		'id' => '502b9f08e2358',
		'title' => 'Layout Options',
		'fields' => array (
			array (
				'key' => 'field_502b9eb29fc45',
				'label' => 'Use Custom Page or Post Title?',
				'name' => 'pagetitle',
				'type' => 'true_false',
				'instructions' => '',
				'required' => '0',
				'message' => 'If checked the standard page title will not be used and you can use your own in the body content of the page.',
				'order_no' => '0',
			),
			array (
				'key' => 'field_502b9eb29fc46',
				'label' => 'Use Manual Formatting?',
				'name' => 'autop_disable',
				'type' => 'true_false',
				'instructions' => '',
				'required' => '0',
				'message' => 'If checked WordPress will not autoformat your HTML and you will be expected to create your own linebreaks and paragraphs in HTML.',
				'order_no' => '0',
			),
		),
		'location' => array (
			'rules' => array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
				),
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 1,
				),
			),
			'allorany' => 'any',
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => 
			array (),
		),
		'menu_order' => 0,
	));
    
};


/**
 * Disables the wpautop() on a post by post (or page by page) basis.
 * @param str
 * @return str
 */
function uri_modern_bypass_auto_formatting($content) {
	global $post;
	if( get_post_meta($post->ID, 'autop_disable', true) == 1) {
		remove_filter('the_content', 'wpautop');
	}
	return $content;   
}
add_filter( 'the_content', 'uri_modern_bypass_auto_formatting', 1 );