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


$is_table = false;
$is_policies = false;

$site_name = strtolower( get_bloginfo( 'name' ) );
if ( false !== strpos( $site_name, 'policies' ) ) { // @todo: find a better condition
	$is_table = true;
	$is_policies = true;
}


$query_id = $query->query['search_filter_id'];

$sf_current_query = $searchandfilter->get( $query_id )->current_query();


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
			<?php if ( $is_table ) : ?>
			<table class="search-filter-results">
			<?php if ( $is_policies ) : ?>
			<thead>
			<tr>
				<th>Policy</th>
				<th>Category</th>
				<th>Procedure</th>
			</tr>
			</thead>
			<?php endif; ?>
			<tbody>
			<?php endif; ?>
			
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();

				if ( get_post_type() === 'people' ) { // it's a people post, customize result display
					include 'people.php';
				} elseif ( $is_policies ) { // it's a polcy
					include 'policies.php';
				} else { // not a people post, use default search and filter template
					include 'default.php';
				}
			} // end while
			?>
			
			<?php if ( $is_table ) : ?>
				</tbody>
				</table>
			<?php endif; ?>
			
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

		$("table.search-filter-results thead tr").eq(0).append("<th></th>");
		
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
