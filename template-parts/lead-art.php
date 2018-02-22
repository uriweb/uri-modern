<?php

	$link_to_fullsize = FALSE; // initialize as false, set to true later if single
	$link_to_article = FALSE;

	// show the lead art
	if ( has_post_thumbnail() && ! get_post_format( $post->ID ) == 'video') { // check if the post has a Post Thumbnail assigned to it.
		if ( is_single() ) {
			$image_id = get_post_thumbnail_id( $post->ID );
			$image = wp_get_attachment_image_src( $image_id, 'full' );
			$link_to_fullsize = TRUE;
		}
		if ( ! is_single() ) {
			$link_to_article = TRUE;
			$url = esc_url( get_permalink() );

		}
	?>
		<div class="featured-image">
			<figure>
			<?php if ( $link_to_fullsize ): ?>
			<a href="<?php print $image[0] ?>" rel="lightbox[<?php print $post->ID; ?>]">
			<?php endif; ?>
			<?php if ( $link_to_article ): ?>
			<a href="<?php print $url ?>">
			<?php endif; ?>
			<?php
				$width = ( is_single() || is_page() ) ? 1200 : 300 ;
				the_post_thumbnail( array( $width, NULL ) );
			?>
			<?php if ( $link_to_fullsize || $link_to_article): ?>
			</a>
			<?php endif; ?>
			<?php
			$figcaption = uri_modern_get_thumbnail_caption($post);
			if ( ( is_single() || is_page() ) && !empty( $figcaption ) ):
			?>
			<figcaption class="wp-caption"><?php print $figcaption; ?></figcpation>
			<?php endif; ?>
			</figure>
		</div>

	<?php
	}
