<?php
/**
 * Search & Filter Pro
 *
 * Default Results Template
 *
 * @package uri-modern
 */

?>
	<div>
		<h2><a href="<?php the_permalink(); ?>">
											<?php
			// the_title();
			$title = get_the_title();
			echo uri_modern_result_highlight( $title, $search );
		?>
		</a></h2>

		<p><br />
		<?php
			// the_excerpt();
			$excerpt = get_the_excerpt();
			echo uri_modern_result_highlight( $excerpt, $search );
		?>
		</p>
		<?php
			if ( has_post_thumbnail() ) {
			echo '<p>';
			the_post_thumbnail( 'small' );
			echo '</p>';
			}
		?>
		<p><?php the_category(); ?></p>
		<p><?php the_tags(); ?></p>
		<p><small><?php the_date(); ?></small></p>

	</div>
