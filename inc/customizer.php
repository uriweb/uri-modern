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
    
    // Add section for social media
    $wp_customize->add_section( 'uri_modern_customizer_social' , array(
        'title'      => __( 'Social Media', 'uri-modern' ),
        'priority'   => 70,
    ) );
    
    // Add field for Facebook URL
    $wp_customize->add_setting( 'department_facebook_URL', array(
        'default' => '',
        'type' => 'option',
        'sanitize_callback' => 'uri_modern_sanitize_url'
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( 
	   $wp_customize, 
        'department_facebook_URL',
        array(
            'section' => 'uri_modern_customizer_social',
            'label' => __( 'Facebook URL', 'uri-modern' ),
            'description' => __( 'Enter a complete URL to include Facebook in the site header social bar.', 'uri-modern' ),
            'type' => 'text'
        )
    ) );
    
    // Add field for Instagram URL
    $wp_customize->add_setting( 'department_instagram_URL', array(
        'default' => '',
        'type' => 'option',
        'sanitize_callback' => 'uri_modern_sanitize_url'
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( 
	   $wp_customize, 
        'department_instagram_URL',
        array(
            'section' => 'uri_modern_customizer_social',
            'label' => __( 'Instagram URL', 'uri-modern' ),
            'description' => __( 'Enter a complete URL to include Instagram in the site header social bar.', 'uri-modern' ),
            'type' => 'text'
        )
    ) );
    
    // Add field for Twitter URL
    $wp_customize->add_setting( 'department_twitter_URL', array(
        'default' => '',
        'type' => 'option',
        'sanitize_callback' => 'uri_modern_sanitize_url'
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( 
	   $wp_customize, 
        'department_twitter_URL',
        array(
            'section' => 'uri_modern_customizer_social',
            'label' => __( 'Twitter URL', 'uri-modern' ),
            'description' => __( 'Enter a complete URL to include Twitter in the site header social bar.', 'uri-modern' ),
            'type' => 'text'
        )
    ) );
    
    // Add field for YouTube URL
    $wp_customize->add_setting( 'department_youtube_URL', array(
        'default' => '',
        'type' => 'option',
        'sanitize_callback' => 'uri_modern_sanitize_url'
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( 
	   $wp_customize, 
        'department_youtube_URL',
        array(
            'section' => 'uri_modern_customizer_social',
            'label' => __( 'YouTube URL', 'uri-modern' ),
            'description' => __( 'Enter a complete URL to include YouTube in the site header social bar.', 'uri-modern' ),
            'type' => 'text'
        )
    ) );
    
    // Add field for Snapchat URL
    $wp_customize->add_setting( 'department_snapchat_URL', array(
        'default' => '',
        'type' => 'option',
        'sanitize_callback' => 'uri_modern_sanitize_url'
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( 
	   $wp_customize, 
        'department_snapchat_URL',
        array(
            'section' => 'uri_modern_customizer_social',
            'label' => __( 'Snapchat URL', 'uri-modern' ),
            'description' => __( 'Enter a complete URL to include Snapchat in the site header social bar.', 'uri-modern' ),
            'type' => 'text'
        )
    ) );
    
    // Add field for LinkedIn URL
    $wp_customize->add_setting( 'department_linkedin_URL', array(
        'default' => '',
        'type' => 'option',
        'sanitize_callback' => 'uri_modern_sanitize_url'
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( 
	   $wp_customize, 
        'department_linkedin_URL',
        array(
            'section' => 'uri_modern_customizer_social',
            'label' => __( 'LinkedIn URL', 'uri-modern' ),
            'description' => __( 'Enter a complete URL to include LinkedIn in the site header social bar.', 'uri-modern' ),
            'type' => 'text'
        )
    ) );


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


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function uri_modern_customize_preview_js() {
	wp_enqueue_script( 'uri-modern-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), uri_modern_cache_buster(), true );
}
add_action( 'customize_preview_init', 'uri_modern_customize_preview_js' );