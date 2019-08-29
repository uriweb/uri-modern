<?php
/**
 * Search & Filter Pro
 *
 * Default Results Template
 *
 * @package uri-modern
 */

?>
	<div class="search-filter-result-default">
		<h2 class="title"><a href="<?php the_permalink(); ?>">
		<?php
			// the_title();
			$title = get_the_title();
			echo uri_modern_result_highlight( $title, $search );
		?>
		</a></h2>

		<p class="excerpt"><br />
		<?php
			// the_excerpt();
			$excerpt = get_the_excerpt();
			echo uri_modern_result_highlight( $excerpt, $search );
		?>
		</p>
		<?php
			if ( has_post_thumbnail() ) {
			echo '<figure class="image"><a href="' . the_permalink() . '">';
			the_post_thumbnail( 'small' );
			echo '</a></figure>';
			}
		?>
		<p class="category"><?php the_category(); ?></p>
		<p class="tags"><?php the_tags(); ?></p>
		<p class="date"><small><?php the_date(); ?></small></p>

	</div>
