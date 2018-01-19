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