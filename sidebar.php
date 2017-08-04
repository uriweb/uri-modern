<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uri-modern
 */

?> 

<?php

if ( ! is_active_sidebar( 'primary_sidebar' ) ) {
	return;
}

?>

<div id="dynamicsidebar">  
    <?php dynamic_sidebar( 'primary_sidebar' ); ?>
</div>