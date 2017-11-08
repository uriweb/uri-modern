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
    
    // rename "Header Image" section to "Header"
	//$wp_customize->get_section('header_image')->title = esc_html__( 'Header', 'uri2016' );
    
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


}

/**
 * Sanitize input from a checkbox.  It'll be 0 or 1.
 *
 * @param mixed $value
 * @return int
 */
function uri_modern_validate_checkbox($value) {
	return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function uri_modern_customize_preview_js() {
	wp_enqueue_script( 'uri-modern-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), uri_modern_cache_buster(), true );
}
add_action( 'customize_preview_init', 'uri_modern_customize_preview_js' );