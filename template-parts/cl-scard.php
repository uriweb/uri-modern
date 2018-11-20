<?php
/**
 * The template for displaying a post as a story card
 *
 * @package uri-modern
 */

echo do_shortcode( '[cl-scard post="' . $post->ID . '"]' );
