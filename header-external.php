<?php
/**
 * The external landing page header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uri-modern
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php get_template_part( 'header-parts/head' ); ?>

<body <?php body_class(); ?>>
    
<?php
    $gtm = uri_modern_gtm_value();
    if ( ! empty ( $gtm ) ) {
        echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . $gtm . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
    }
?>
    
<div id="page" class="site">
	<!-- <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'uri' ); ?></a> -->

	<?php get_template_part( 'header-parts/brandbar' ); ?>
    <?php get_template_part( 'header-parts/widgetarea-banner' ); ?>
    
    <div class="content-width">
        <?php get_template_part( 'header-parts/widgetarea-before-content' ); ?>
    </div>
    
	<div id="content" class="site-content">
        
    