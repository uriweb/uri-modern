<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?> 

<div id="primarynav">
    <?php wp_nav_menu( array('theme_location' => 'menu-1', 'menu_class' => 'cl-menu', 'container' => '', 'fallback_cb' => false) ); ?>
</div>

<?php

if ( ! is_active_sidebar( 'primary_sidebar' ) ) {
	return;
}

?>

<div id="dynamicsidebar">  
    <?php dynamic_sidebar( 'primary_sidebar' ); ?>
</div>