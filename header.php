<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uri-modern
 */

get_template_part( 'header-parts/head' ); ?>

	<div id="masthead">
		<?php get_template_part( 'header-parts/brandbar' ); ?>
		<?php get_template_part( 'header-parts/widgetarea-banner' ); ?>

		<header id="siteheader">

			<?php get_template_part( 'header-parts/sitebar' ); ?>

			<div id="navigation" class="content-width">
				<?php get_template_part( 'header-parts/breadcrumbs' ); ?>  
				<?php
				if ( has_nav_menu( 'menu-1' ) ) {
					get_template_part( 'header-parts/localnav' );
				}
				?>
			</div>
			
			<?php get_template_part( 'header-parts/widgetarea-before-content' ); ?>

		</header>
	</div>
	
	<div id="content" class="site-content">
		
	
