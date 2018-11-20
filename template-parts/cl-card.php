<?php
/**
 * The template for displaying a post as a story card
 *
 * @package uri-modern
 */

echo do_shortcode( '[cl-card title="' . $post->post_title . '" body="' . $post->post_excerpt . '" link="' . get_permalink( $post->ID ) . '" img="' . get_the_post_thumbnail_url( $post->ID ) . '" button="Read More"]' );
