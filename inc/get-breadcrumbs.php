<?php
/**
 * Breadcrumbs
 *
 * @package uri-modern
 */

/**
 * Call the breadcrumbs
 */
function uri_modern_breadcrumbs() {
	$crumbs  = array();

	$option_val = get_option( 'breadcrumbs_prepend' );
	$default = 'The University of Rhode Island' == get_bloginfo( 'name' ) ? '' : '[URI](https://' . uri_modern_the_domain() . ')';
	$prepend = empty( $option_val ) ? array( $default ) : explode( "\n", $option_val );

	foreach ( $prepend as $l ) {
		$bits = explode( '(', $l );
		$name = trim( $bits[0], '[]' );
		$href = @rtrim( $bits[1], ')' );
		if ( ! empty( $name ) && ! empty( $href ) ) {
			$crumbs[] = array(
				'name' => $name,
				'href' => $href,
			);
		}
	}

	$crumbs[] = array(
		'name' => get_bloginfo(),
		'href' => get_site_url(),
	);

	$url           = uri_modern_get_current_path();
	$path_segments = explode( '/', $url );

	$path = '';

	foreach ( $path_segments as $p ) {
		if ( empty( $p ) ) {
			continue;
		}
		$path = $path . '/' . $p;
		$link = uri_modern_breadcrumbs_get_link( $path );

		if ( ! empty( $link ) ) {
			$crumbs[] = $link;
		}
	}
	return uri_modern_format_breadcrumbs( $crumbs );
}


/**
 * WP lets us hunt and peck to see what the URL might be
 *
 * @param str $path the path.
 */
function uri_modern_breadcrumbs_get_link( $path ) {

	// ignore pagination i.e. if the path ends in /page/N
	if ( preg_match( '/\/page(\/(\d)*)?$/', $path ) !== 0 ) {
		return;
	}

	$p       = '';
	$post_id = url_to_postid( $path );

	if ( 0 !== $post_id ) { // it's a post or a page.
		$p      = get_page_by_path( $path );
		if ( ! is_object( $p ) ) { // solves an issue with page break paginated pages and posts
			return;
		}
		$output = array(
			'name' => get_the_title( $p->ID ),
			'href' => get_site_url() . $path,
		);
		return $output;
	}

	// is it a custom post type?
	// check this first so that it takes precedent over category
	$post_type_object = get_post_type_object( get_post_type() );
	if ( is_object( $post_type_object ) ) {
		$slug = $post_type_object->rewrite['slug'];
	}

	if ( isset( $slug ) ) {
		$output = array(
			'name' => ucfirst( $slug ),
			'href' => get_site_url() . $path,
		);
		return $output;
	}

	// is it a category?
	// @todo Catch custom post type categories too.
	$category = get_category_by_path( $path );

	if ( is_object( $category ) && isset( $category->term_id ) ) {
		$output = array(
			'name' => $category->name,
			'href' => get_site_url() . '/' . $category->slug,
		);
		return $output;
	}

}

/**
 * Format the breadcrumbs
 *
 * @param arr $crumbs the crumbs.
 * @return $output
 */
function uri_modern_format_breadcrumbs( $crumbs ) {
	$output = '<ol>';
	$last   = end( $crumbs );
	foreach ( $crumbs as $c ) {
		if ( $c === $last ) { // last crumb isn't a hyperlink.
			$output .= '<li aria-current="page">' . $c['name'] . '</li>';
		} else {
			$output .= '<li><a href="' . $c['href'] . '">' . $c['name'] . '</a></li>';
		}
	}
	$output .= '</ol>';
	return $output;
}
