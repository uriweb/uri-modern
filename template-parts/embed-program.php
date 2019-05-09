<?php
/**
 * The template for displaying oembed programs
 *
 * @package uri-modern
 */

function uri_modern_oembed_program_styles() {
	print '
	<style>
		@import url("' . get_stylesheet_uri() . '");
		@import url("' . plugins_url() . '/uri-component-library/css/cl.built.css");
	</style>
	';
}

add_action( 'embed_head', 'uri_modern_oembed_program_styles' );

get_header( 'embed' );
?>

		<?php
		
		while ( have_posts() ) :
			the_post();

			$sc = '[cl-card title="' . _uri_cl_escape_brackets( get_the_title() ) . '" body="' . _uri_cl_escape_brackets( get_the_excerpt() ) . '" link="' . get_the_permalink() . '" img="' . get_the_post_thumbnail_url( null, 'third_column' ) . '" button="Explore"]';

			print do_shortcode( $sc );


		?>

		<?php endwhile; // End of the loop. ?>

<?php
get_footer( 'embed' );
