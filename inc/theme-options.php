<?php
/**
 * URI Modern Theme Options
 *
 * @package uri-modern
 */

/**
 * Register field groups
 * The register_field_group function accepts 1 array which holds the relevant data to register a field group
 * You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 * This code must run every time the functions.php file is read
 */

if ( function_exists( 'register_field_group' ) ) {

	register_field_group(
		array(
			'id' => '602ad5d57f139',
			'title' => 'Theme Options',
			'fields' => array(
				array(
					'key' => 'field_602ad77cfce9a',
					'label' => 'Color Scheme',
					'name' => 'uri_modern_color_scheme',
					'type' => 'button_group',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'choices' => array(
						'user' => 'User',
						'light' => 'Light',
						'dark' => 'Dark',
					),
					'allow_null' => 0,
					'default_value' => 'user',
					'layout' => 'horizontal',
					'return_format' => 'value',
				),
			),
			'location' => array(
				'rules' => array(
					array(
						'param' => 'current_user_role',
						'operator' => '==',
						'value' => 'super_admin',
					),
				),
				'allorany' => 'any',
			),
			'options'    => array(
				'position'       => 'side',
				'layout'         => 'default',
				'hide_on_screen' =>
				array(),
			),
			'menu_order' => 0,
		)
	);
};
