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
    
    ob_start();
    get_template_part('header-parts/globalnav');
    return ob_get_clean();

}
add_shortcode( 'uri-modern-gn', 'uri_modern_shortcode_gn' ); 