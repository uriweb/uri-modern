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

$site_name = strtolower( get_bloginfo( 'name' ) );


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
			
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();

				if ( get_post_type() === 'people' ) { // it's a people post, customize result display
					include 'people.php';
				} else { // not a people post, use default search and filter template
					include 'default.php';
				}
			} // end while
			?>
			
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

	
<?php else : ?>

	<p class="no-results">No Results Found.</p>

<?php endif; ?>
