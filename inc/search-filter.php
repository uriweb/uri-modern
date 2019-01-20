<?php
/**
 * Search / Search and Filter helpers
 *
 * @package uri-modern
 */


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
