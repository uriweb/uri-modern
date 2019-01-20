<?php
/**
 * Search & Filter Pro
 *
 * Results Template
 *
 * For more customization see the WordPress docs
 * and using template tags -
 *
 * http://codex.wordpress.org/Template_Tags
 *
 * @package uri-modern
 */

$search = ( ! empty( $_REQUEST['_sf_s'] ) ) ? $_REQUEST['_sf_s'] : false;

/**
 * Quick and dirty pagination
 *
 * @return string
 */
function uri_modern_search_filter_pagination( $current_page, $num_pages, $offset = 3, $separator = ' ' ) {

	$pagination = array();

	$page = 1;
	while ( $page <= $num_pages ) {

		if ( $page == $current_page ) {
			$pagination[] = '<span class="page-number">' . $page . '</span>';
		} else {
			$url = esc_url( add_query_arg( 'sf_paged', $page ) );
			$pagination[] = '<a href="' . $url . '" class="page-number">' . $page . '</a>';
		}

		$page++;
	}

	return implode( ' ', $pagination );
}



/**
 * Quick and dirty number of results
 *
 * @param int $total the number of results.
 * @return string
 */
function uri_modern_search_filter_number_of_results( $total ) {
	$r = ( 1 == $total ) ? 'result' : 'results';
	return '<div class="search-filter-total">Found ' . $total . ' ' . $r . '</div>';
}


/**
 * Highlight substring
 * if relevanssi is present, highlight search terms found in the string.
 * otherwise, return the field contents
 *
 * @param str $string is the haystack in which to search.
 * @param str $search is the needle to look for.
 * @param str $el is the HTML element to wrap matches in.  default: <mark>.
 * @return str
 */
function uri_modern_result_highlight( $string, $search = false, $el = 'mark' ) {
	if ( false === $search ) {
		return $string;
	}

	if ( function_exists( 'relevanssi_highlight_terms' ) ) {
		$string = relevanssi_highlight_terms( $string, $search );
	} else {
		$string = preg_replace( '/\p{L}*?' . preg_quote( $search ) . '\p{L}*/ui', "<$el>$0</$el>", $string );
	}

	return $string;
}


$is_table = false;
$is_policies = false;

$site_name = strtolower( get_bloginfo( 'name' ) );
if ( false !== strpos( $site_name, 'policies' ) ) {
	$is_table = true;
	$is_policies = true;
}


$query_id = $query->query['search_filter_id'];
// echo '<pre>';
// $vars = get_defined_vars();
// var_dump ( array_keys ( $vars ) );
$sf_current_query = $searchandfilter->get( $query_id )->current_query();

// var_dump ( $sf_current_query->get_search_term() );
//
// var_dump ( $sf_current_query->is_filtered() );
// echo '</pre>';
if ( $query->have_posts() ) : ?>
	<div class="search-filter-results">
		<div class="results-meta results-meta-before">
			<?php print uri_modern_search_filter_number_of_results( $query->found_posts ); ?>
			<div class="pagination">
				Page: 
				<?php
					$current_page = $_REQUEST['sf_paged'];
					if ( empty( $current_page ) ) {
					$current_page = 1;
					}
					print uri_modern_search_filter_pagination( $current_page, $query->max_num_pages );
				?>
			</div>
		</div>
	
		<div class="search-filter-results-posts ">
			<?php
			if ( $is_table ) :
?>
<table><?php endif; ?>
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();

				?>
		
				<?php if ( get_post_type() === 'people' ) : // it's a people post, customize result display ?>
			
					<?php
						include 'people.php';
					?>
			
				<?php elseif ( $is_policies ) : // it's a polcy ?>
					
					<?php
						include 'policies.php';
					?>

				<?php else : // not a people post, use default search and filter template ?>

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

				<?php endif; // end post type conditional ?>
									

			<?php } // end while ?>
			
			<?php
			if ( $is_table ) :
?>
</table><?php endif; ?>
			
		</div>

		<div class="results-meta results-meta-after">
			<?php print uri_modern_search_filter_number_of_results( $query->found_posts ); ?>
			<div class="pagination">
				Page: 
				<?php
					$current_page = $_REQUEST['sf_paged'];
					if ( empty( $current_page ) ) {
					$current_page = 1;
					}
					print uri_modern_search_filter_pagination( $current_page, $query->max_num_pages );
				?>
			</div>
		</div>
	
	
	</div>

			<?php if ( $is_table ) : ?>
			
			<script>

(function($) {

	$(document).ready( initExcerpter );

	function initExcerpter() {
		// hide all of the excerpt rows
		$("tr.excerpt").toggleClass('excerpt-hidden');
		
		// add an toggler widget to each row
		$("td.policy").each(function(){
			var excerpt = $(this).parents("tr").next();
			if( $(excerpt).hasClass('excerpt')) {
				$(this).parent("tr").append('<td><span class="excerpt-toggler">details</span></td>').click(function(){
					$(excerpt).toggleClass('excerpt-hidden');
				});
				// since we added a td, increase the colspan of the excerpt row by one
				var cols = $("td", excerpt).attr('colspan') * 1;
				$("td", excerpt).attr('colspan', cols + 1);
			}
		});
		
	}

})(jQuery);


			</script>
			
			
			<?php endif; ?>

	
<?php else : ?>

	<p>No Results Found.</p>

<?php endif; ?>
