<?php
/**
 * Search & Filter Pro
 *
 * Results Template for URI Policies
 *
 * @package uri-modern
 */

?>
	<tr>
		<td class="policy">
		<?php
			$title = get_the_title();
			$policy = uri_modern_get_field( 'policy' );
			if ( $policy ) {
			echo '<a href="' . $policy . '">';
			}
			echo uri_modern_result_highlight( $title, $search );
			if ( $policy ) {
			echo '</a>';
			}
		?>
		</a></td>
		
		<td class="category">
		<?php
			// the_category(',');
			$cats = array();
			$categories = get_the_category();
			foreach ( $categories as $c ) {
			$cats[] = $c->name;
			}
			echo implode( ',', $cats );
		?>
		</td>

		<td class="procedure">
		<?php
			$procedure = uri_modern_get_field( 'procedure' );
			if ( $procedure ) {
			echo '<a href="' . $procedure . '">';
			echo 'Procedure';
			echo '</a>';
			}
		?>
		</td>
	</tr>
	<tr class="excerpt">
		<td colspan="3">
		<?php
			$excerpt = get_the_excerpt();
			echo uri_modern_result_highlight( $excerpt, $search );
		?>
		</td>
	</tr>
		

