<?php
/**
 * Search & Filter Pro
 *
 * Sample Results Template
 *
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      http://www.designsandcode.com/
 * @copyright 2015 Designs & Code
 *
 * Note: these templates are not full page templates, rather
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think
 * of it as a template part
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags -
 *
 * http://codex.wordpress.org/Template_Tags
 */

$search = ( ! empty( $_REQUEST['_sf_s'] ) ) ? $_REQUEST['_sf_s'] : false;

/**
 * Quick and dirty pagination
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
 */
function uri_modern_search_filter_number_of_results( $total ) {
	$r = ( 1 == $total ) ? 'result' : 'results';
	return '<div class="search-filter-total">Found ' . $total . ' ' . $r . '</div>';
}


/**
 * Quick and dirty relevanssi highlight
 * if relevanssi is present, highlight search terms found in the string.
 * otherwise, return the field contents
 */
function uri_modern_result_highlight( $string, $search ) {
	if ( false !== $search && function_exists( 'relevanssi_highlight_terms' ) ) {
		return relevanssi_highlight_terms( $string, $search );
	}
	return $string;
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
		<div class="results-meta">
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

				?>
		
				<?php if ( get_post_type() === 'people' ) : // it's a people post, customize result display ?>
			
					<div class="people-result">

						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>"><figure><?php the_post_thumbnail( 'small', array( 'class' => 'u-photo' ) ); ?></figure></a>
						<?php else : ?>
							<a href="<?php the_permalink(); ?>"><figure><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/default/uri80.gif" alt="Person Icon" /></figure></a>
						<?php endif; ?>

						<h3><a href="<?php the_permalink(); ?>">
															<?php
							// the_title();
							$title = get_the_title();
							echo uri_modern_result_highlight( $title, $search );
						?>
						</a></h3>

			
						<?php if ( $people_title = uri_modern_get_field( 'peopletitle' ) ) : ?>
							<div class="people-title people-field">
							<?php
								 // the_field( 'peopletitle' );
								 echo uri_modern_result_highlight( $people_title, $search );
							?>
							</div>
						<?php endif; ?>
			
						<?php if ( $people_department = uri_modern_get_field( 'peopledepartment' ) ) : ?>
							<div class="people-department people-field">
							<?php
								// the_field( 'peopledepartment' );
								 echo uri_modern_result_highlight( $people_department, $search );
							?>
							</div>
						<?php endif; ?>
			
						<?php if ( $people_research = uri_modern_get_field( 'peopleresearch' ) ) : ?>
							<div class="people-research people-field">
							<?php
								// the_field( 'peopleresearch' );
								 echo uri_modern_result_highlight( $people_research, $search );
							?>
							</div>
						<?php endif; ?>
			
						<?php
							// $term_lists = get_the_term_list( $post->ID, 'peoplegroups', '', ', ' );
							// format the links so that they point to new searches
							$terms_raw = get_the_terms( $post, 'peoplegroups' );
							$terms = array();
							foreach ( $terms_raw as $t ) {
							$terms[] = '<a href="?_sft_peoplegroups=' . $t->slug . '">' . $t->name . '</a>';
							}
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
							?>
							<div class="people-expertise people-field">Areas of expertise: 
							<?php
							$terms = implode( '<span class="separator">, </span>', $terms );
							// echo $terms;
							echo uri_modern_result_highlight( $terms, $search );
							?>
							</div>
							<?php endif; ?>
			
					</div>
			
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
		</div>

		<div class="results-meta">
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

	<p>No Results Found.</p>

<?php endif; ?>
