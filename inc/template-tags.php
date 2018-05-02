<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package uri-modern
 */

if ( ! function_exists( 'uri_modern_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function uri_modern_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'uri' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'uri' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'uri_modern_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function uri_modern_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items */
			$categories_list = get_the_category_list( esc_html__( ' ', 'uri' ) );
			if ( $categories_list && uri_modern_categorized_blog() && get_option( 'display_post_categories' ) ) {
				/* translators: %s: the list of categories */
				printf( '<span class="cat-links"><span class="screen-reader-text">Posted in:</span>' . esc_html__( ' %s', 'uri' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items */
			$tags_list = get_the_tag_list( '<span class="screen-reader-text">Tagged as:</span>', '' );
			if ( $tags_list && get_option( 'display_post_tags' ) ) {
				/* translators: %s: the list of tags */
				printf( '<span class="tags-links">' . esc_html__( ' %s', 'uri' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'uri' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function uri_modern_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'uri_modern_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'uri_modern_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so uri_modern_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so uri_modern_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in uri_modern_categorized_blog.
 */
function uri_modern_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'uri_modern_categories' );
}
add_action( 'edit_category', 'uri_modern_category_transient_flusher' );
add_action( 'save_post', 'uri_modern_category_transient_flusher' );
