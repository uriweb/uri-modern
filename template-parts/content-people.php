<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri-modern
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

			<?php
				get_template_part( 'template-parts/featured-image' );
			?>
			
			<ul class="people-list">
				<?php
				if ( uri_modern_get_field( 'peopletitle' ) ) :
?>
<li class="people-title"><?php the_field( 'peopletitle' ); ?></li><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peopledepartment' ) ) :
?>
<li class="people-department"><?php the_field( 'peopledepartment' ); ?></li><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peoplephone' ) ) :
?>
<li class="people-phone"><strong>Phone:</strong> <?php the_field( 'peoplephone' ); ?></li><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peoplefax' ) ) :
?>
<li class="people-fax"><strong>Fax:</strong> <?php the_field( 'peoplefax' ); ?></li><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peopleemail' ) ) :
?>
<li class="people-email"><strong>Email:</strong> <a href="mailto:<?php the_field( 'peopleemail' ); ?>"><?php the_field( 'peopleemail' ); ?></a></li><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peoplemail' ) ) :
?>
<li class="people-location"><strong>Office Location:</strong> <?php the_field( 'peoplemail' ); ?></li><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peopleurl' ) ) :
?>
<li class="people-url"><strong>Website:</strong> <a href="<?php the_field( 'peopleurl' ); ?>"><?php the_field( 'peopleurl' ); ?></a></li><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peoplegooglescholar' ) ) :
?>
<li class="people-google"><strong>Google Scholar:</strong> <a href="<?php the_field( 'peoplegooglescholar' ); ?>"><?php the_field( 'peoplegooglescholar' ); ?></a><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peopleresearchgate' ) ) :
?>
<li class="people-researchgate"><strong>ResearchGate:</strong> <a href="<?php the_field( 'peopleresearchgate' ); ?>"><?php the_field( 'peopleresearchgate' ); ?></a><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peopleacceptingstudents' ) === 'Yes' && uri_modern_get_field('peopletypestudent')) :
?>
<li class="people-acceptingstudents"><strong>Accepting Students:</strong> <?php the_field( 'peopletypestudent' ); ?></li><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peopleacceptingstudents' ) === 'Yes' and !uri_modern_get_field('peopletypestudent')) :
?>
<li class="people-acceptingstudents"><strong>Accepting Students:</strong> <?php the_field( 'peopleacceptingstudents' ); ?></li><?php endif; ?>
				<?php
				if ( uri_modern_get_field( 'peopleacceptingstudents' ) === 'Not at this time') :
?>
<li class="people-acceptingstudents"><strong>Accepting Students:</strong> <?php the_field( 'peopleacceptingstudents' ); ?></li><?php endif; ?>


</ul>
			
			<?php
				the_content();
			?>

			<?php if ( uri_modern_get_field( 'peoplebio' ) ) { ?>
				<div class="people-bio">
					<h3>Biography</h3>
					<?php the_field( 'peoplebio' ); ?>
				</div>
			<?php } ?>

			<?php if ( uri_modern_get_field( 'peopleresearch' ) ) { ?>
				<div class="people-research">
					<h3>Research</h3>
					<?php the_field( 'peopleresearch' ); ?>
				</div>
			<?php } ?>

			<?php if ( uri_modern_get_field( 'peopleedu' ) ) { ?>
				<div class="people-education">
					<h3>Education</h3>
					<?php the_field( 'peopleedu' ); ?>
				</div>
			<?php } ?>

			<?php if ( uri_modern_get_field( 'peoplepubs' ) ) { ?>
				<div class="people-publications">
					<h3>Selected Publications</h3>
					<?php the_field( 'peoplepubs' ); ?>
				</div>
			<?php } ?>

			<?php if ( uri_modern_get_field( 'peoplecustom' ) ) { ?>
				<div class="people-custom">
					<?php
					$getcustom = uri_modern_get_field( 'peoplecustom' );
					apply_filters( 'the_content', $getcustom );
					echo wpautop( $getcustom );
?>
				</div>
			<?php } ?>


			<p><?php the_tags(); ?></p>


			<?php
			if ( get_site_option( 'uri_comments' ) ) {
				comments_template();
			}
			?>


		<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uri' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'uri' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->


