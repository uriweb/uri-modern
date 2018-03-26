<?php
/**
 * Template part for displaying the banner widget area.
 *
 * @package uri-modern
 */

if ( is_active_sidebar( 'banner' ) ) : ?>
	<div id="region-banner" class="region-banner widgets">
		<?php dynamic_sidebar( 'banner' ); ?>
	</div><!-- #region-banner -->
<?php
endif;
