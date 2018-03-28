<?php
/**
 * Template part for displaying the before-content widget area.
 *
 * @package uri-modern
 */

if ( is_active_sidebar( 'before-content' ) ) : ?>
	<div id="region-before-content" class="region-before-content widgets">
		<?php dynamic_sidebar( 'before-content' ); ?>
	</div><!-- #region-before-content -->
<?php
endif;
