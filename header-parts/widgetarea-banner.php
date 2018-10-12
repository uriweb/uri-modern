<?php
/**
 * Template part for displaying the banner widget area.
 *
 * @package uri-modern
 */

if ( is_active_sidebar( 'banner' ) || is_404() ) : ?>
	<div id="region-banner" class="region-banner widgets">
		<?php

		if ( is_404() ) {
			echo do_shortcode( '[uri-modern-gn]' );
		}

		dynamic_sidebar( 'banner' );

		?>
	</div><!-- #region-banner -->
<?php
endif;
