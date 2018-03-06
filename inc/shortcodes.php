<?php
/**
 * uri-modern Shortcodes
 *
 * @package uri-modern
 */


/**
 * Global Nav shortcode
 */
function uri_modern_shortcode_gn( $atts, $content = null ) {
    
    // Attributes
	extract( shortcode_atts(
		array(
            'style' => ''
		), $atts )
	);
    
    $output = '<div class="globalnav breakout ' . $style . '">';
    
    ob_start();
    get_template_part('header-parts/globalnav');
    $output .= ob_get_clean();
    
    $output .= '</div>';
    return $output;

}
add_shortcode( 'uri-modern-gn', 'uri_modern_shortcode_gn' ); 