<?php
/**
 * URI Modern Theme Customizer
 *
 * @package uri-modern
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uri_modern_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    uri_modern_options_customizer( $wp_customize );
}
add_action( 'customize_register', 'uri_modern_customize_register' );


/**
 * Creates the Theme Options customizer panel
 * Used for contact information and social media information
 * keeping its code in its own container
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uri_modern_options_customizer($wp_customize) {

	// set up the panel
	$panel = 'uri_modern_options';

	$wp_customize->add_panel($panel, array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => 'URI Theme Options',
    'description'    => '',
	));


	// set up the sections
    $section_frontpage = 'uri_modern_options_dev';
	$wp_customize->add_section($section_dev, array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => 'DEVELOPMENT',
    'description'    => '',
    'panel'          => $panel,
	));
    
	$section_globalheader = 'uri_modern_options_header';
	$wp_customize->add_section($section_globalheader, array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => 'Header',
    'description'    => '',
    'panel'          => $panel,
	));
    
    
 
    // set up the individual settings
	
	$elements = array();
    
    $elements[] = array(
		'name' => 'uri_modern_options_dev_cl',
        'type' => '',
		'options' => array(
			'sanitize_callback' => 'uri_modern_sanitize_checkbox',
		),
		'control' => array(
			'label'    => __( 'DEV CL', 'uri-modern' ),
			'section'  => $section_dev,
            'description' => __( 'Check to enable the development version of the Component Library if the plugin is not activated.', 'uri-modern' ),
	 		'type' => 'checkbox'
		)
	);
    
    $elements[] = array(
		'name' => 'uri_modern_options_hideglobalnav',
        'type' => '',
		'options' => array(
			'sanitize_callback' => 'uri_modern_sanitize_checkbox',
		),
		'control' => array(
			'label'    => __( 'Hide Global Navigation', 'uri-modern' ),
			'section'  => $section_globalheader,
            'description' => __( 'Check to hide global navigation on this site', 'uri-modern' ),
	 		'type' => 'checkbox'
		)
	);
    

    // loop over the elements 
	foreach($elements as $el) {
		uri_modern_add_customizer_element( $wp_customize, $el['name'], $el['type'], $el['options'], $el['control'] );
	}
    
}

/**
 * Creates a customizer element (setting and control)
 * this just keeps the repetitive code in its own function so that the 
 * "settings" part of the code is cleaner and easier to manage
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @param str $name The machine-readable name of the element
 * @param arr $options The setting options args
 * @param arr $control The control args
 */

function uri_modern_add_customizer_element( $wp_customize_object, $name, $type, $options=array(), $control=array() ) {

	$default_options = array(
		'type' => 'option',
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_textarea_field',
	);
	$args = array_merge($default_options, $options);
		
	$wp_customize_object->add_setting( $name, $args );

	$default_control = array(
		'label'    => __( 'URI Field', 'uri-modern' ),
		'section'  => 'uri_modern_section',
		'capability' => 'edit_theme_options',
		'type' => 'text',
		'settings' => $name,
		'priority' => 20,
		'input_attrs' => array(
			'checked' => ''
		)
	);
	
	$args = array_merge( $default_control, $control );
            
    //uri_console('type', $type);
    //uri_console('args', $args);
    //uri_console('args[input_attrs]', $args['input_attrs']);
    
    switch ($type) {
        case 'image':
            $wp_customize_object->add_control( new WP_Customize_Image_Control( $wp_customize_object, $name, $args ));
            break;
        default:
            $wp_customize_object->add_control( new WP_Customize_Control( $wp_customize_object, $name, $args ));
    }

}

/**
 * Sanitizes a checkbox
 *
 * @param mixed $value
 * @return mixed: str on success; NULL on failure
 */
function uri_modern_sanitize_checkbox( $value ) {	
	if( is_bool( $value ) ) {
		return $value;
	} else {
		return NULL;
	}
}

/**
 * Sanitizes a URL
 * esc_url_raw() could also do it, but the UX is less robust.  
 * This function improves on esc_url_raw in that it
 * provides feedback when URLs are invalid 
 * (mostly, that is. One can still fool the validator to add sanitized but malformed URLs
 * like https://twitter.comuniversityofri but TLDs are hard to validate these days.)
 *
 * @param str $url is the URL to test
 * @return mixed: str on success; NULL on failure
 */
function uri_modern_sanitize_url( $url ) {
	$out = filter_var($url, FILTER_VALIDATE_URL);
	if( ! empty($url) && $out === FALSE ) {
		// returning NULL triggers the WP UI to show that the value is unacceptable
		return NULL;
	} else {
		return $out;
	}
}