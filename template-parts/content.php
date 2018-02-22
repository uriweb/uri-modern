<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri-modern
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
		<?php
		/*
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php uri_modern_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		*/ ?>
	</header><!-- .entry-header -->

	<?php
		get_template_part( 'template-parts/featured-image' );
	?>

	<div class="entry-content">
		<?php
			
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'uri-modern' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uri-modern' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<!-- <footer class="entry-footer">
		<?php uri_modern_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
