<?php
/**
 * URI Modern Display Posts Customizations
 *
 * @package uri-modern
 */

/**
 * Template Parts
 *
 * @see https://www.billerickson.net/template-parts-with-display-posts-shortcode
 *
 * @param str $output Current output of post.
 * @param arr $original_atts Original attributes passed to shortcode.
 * @return str $output
 */
function uri_modern_display_posts_template( $output, $original_atts ) {

	// Return early if our "template" attribute is not specified
	if ( empty( $original_atts['template'] ) ) {
		return $output;
	}

	ob_start();
	get_template_part( $original_atts['template'] );
	$new_output = ob_get_clean();

	if ( ! empty( $new_output ) ) {
		$output = $new_output;
	}

	return $output;

}
add_action( 'display_posts_shortcode_output', 'uri_modern_display_posts_template', 10, 2 );
