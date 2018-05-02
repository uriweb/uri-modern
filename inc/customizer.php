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

	// rename "Header Image" section to "Header".
	$wp_customize->get_section( 'header_image' )->title = esc_html__( 'Header / Footer', 'uri' );

	// remove unwanted sections.
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );

	// add custom sections and settings/controls
	uri_modern_options_social_media( $wp_customize );
	uri_modern_options_site_header( $wp_customize );
	uri_modern_options_posts( $wp_customize );
}
add_action( 'customize_register', 'uri_modern_customize_register' );


/**
 * Creates options for social media
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uri_modern_options_social_media( $wp_customize ) {

	// Add section for social media.
	$wp_customize->add_section(
		'uri_modern_customizer_social', array(
			'title'    => __( 'Social Media', 'uri' ),
			'priority' => 70,
		)
	);

	// Add field for Facebook URL.
	$wp_customize->add_setting(
		'department_facebook_URL', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'uri_modern_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'department_facebook_URL',
			array(
				'section'     => 'uri_modern_customizer_social',
				'label'       => __( 'Facebook URL', 'uri' ),
				'description' => __( 'Enter a complete URL to include Facebook in the site header social bar.', 'uri' ),
				'type'        => 'text',
			)
		)
	);

	// Add field for Instagram URL.
	$wp_customize->add_setting(
		'department_instagram_URL', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'uri_modern_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'department_instagram_URL',
			array(
				'section'     => 'uri_modern_customizer_social',
				'label'       => __( 'Instagram URL', 'uri' ),
				'description' => __( 'Enter a complete URL to include Instagram in the site header social bar.', 'uri' ),
				'type'        => 'text',
			)
		)
	);

	// Add field for Twitter URL.
	$wp_customize->add_setting(
		'department_twitter_URL', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'uri_modern_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'department_twitter_URL',
			array(
				'section'     => 'uri_modern_customizer_social',
				'label'       => __( 'Twitter URL', 'uri' ),
				'description' => __( 'Enter a complete URL to include Twitter in the site header social bar.', 'uri' ),
				'type'        => 'text',
			)
		)
	);

	// Add field for YouTube URL.
	$wp_customize->add_setting(
		'department_youtube_URL', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'uri_modern_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'department_youtube_URL',
			array(
				'section'     => 'uri_modern_customizer_social',
				'label'       => __( 'YouTube URL', 'uri' ),
				'description' => __( 'Enter a complete URL to include YouTube in the site header social bar.', 'uri' ),
				'type'        => 'text',
			)
		)
	);

	// Add field for Snapchat URL.
	$wp_customize->add_setting(
		'department_snapchat_URL', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'uri_modern_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'department_snapchat_URL',
			array(
				'section'     => 'uri_modern_customizer_social',
				'label'       => __( 'Snapchat URL', 'uri' ),
				'description' => __( 'Enter a complete URL to include Snapchat in the site header social bar.', 'uri' ),
				'type'        => 'text',
			)
		)
	);

	// Add field for LinkedIn URL.
	$wp_customize->add_setting(
		'department_linkedin_URL', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'uri_modern_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'department_linkedin_URL',
			array(
				'section'     => 'uri_modern_customizer_social',
				'label'       => __( 'LinkedIn URL', 'uri' ),
				'description' => __( 'Enter a complete URL to include LinkedIn in the site header social bar.', 'uri' ),
				'type'        => 'text',
			)
		)
	);

}

/**
 * Creates options for site header and footer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uri_modern_options_site_header( $wp_customize ) {

	/* Site Header text color */
	$wp_customize->add_setting(
		'site_header_text_color', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'uri_modern_validate_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'site_header_text_color',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Use light colors', 'uri' ),
				'description' => __( 'Use light colors for header text and social media icons.  Check when using most background images.', 'uri' ),
				'type'        => 'checkbox',
			)
		)
	);

	/* Action Bar Give url */
	$wp_customize->add_setting(
		'action_bar_give_url', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'uri_modern_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'action_bar_give_url',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Give Link', 'uri' ),
				'description' => __( 'Set a custom URL for Give in the Action Bar (default: www.uri.edu/give)', 'uri' ),
				'type'        => 'text',
			)
		)
	);

}


/**
 * Creates options for posts
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uri_modern_options_posts( $wp_customize ) {

	// Add section for post options.
	$wp_customize->add_section(
		'uri_modern_customizer_posts', array(
			'title'    => __( 'Post Options', 'uri' ),
			'priority' => 70,
		)
	);

	/* Display categories */
	$wp_customize->add_setting(
		'display_post_categories', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'uri_modern_validate_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_post_categories',
			array(
				'section'     => 'uri_modern_customizer_posts',
				'label'       => __( 'Display post categories', 'uri' ),
				'description' => __( 'Display categories on posts and archive pages', 'uri' ),
				'type'        => 'checkbox',
			)
		)
	);

	/* Display tags */
	$wp_customize->add_setting(
		'display_post_tags', array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'uri_modern_validate_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'display_post_tags',
			array(
				'section'     => 'uri_modern_customizer_posts',
				'label'       => __( 'Display post tags', 'uri' ),
				'description' => __( 'Display tags on posts and archive pages', 'uri' ),
				'type'        => 'checkbox',
			)
		)
	);

}


/**
 * Sanitize input from a checkbox.  It'll be 0 or 1.
 *
 * @param mixed $value the value to be sanitized.
 * @return int
 */
function uri_modern_validate_checkbox( $value ) {
		return filter_var( $value, FILTER_SANITIZE_NUMBER_INT );
}


/**
 * Sanitizes a URL
 * esc_url_raw() could also do it, but the UX is less robust.
 * This function improves on esc_url_raw in that it
 * provides feedback when URLs are invalid
 * (mostly, that is. One can still fool the validator to add sanitized but malformed URLs
 * like https://twitter.comuniversityofri but TLDs are hard to validate these days.)
 *
 * @param str $url is the URL to test.
 * @return mixed: str on success; NULL on failure
 */
function uri_modern_sanitize_url( $url ) {
		$out = filter_var( $url, FILTER_VALIDATE_URL );
		if ( ! empty( $url ) && false === $out ) {
		// returning NULL triggers the WP UI to show that the value is unacceptable.
		return null;
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
