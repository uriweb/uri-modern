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

get_template_part('header-parts/head'); ?>

<header id="masthead">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'uri' ); ?></a>
	<?php get_template_part('header-parts/brandbar'); ?>
	<?php get_template_part('header-parts/widgetarea-banner'); ?>

	<div id="siteheader">

		<?php get_template_part('header-parts/widgetarea-before-content'); ?>

	</div>
</header>

<div id="content" class="site-content">