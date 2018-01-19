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

			<figure class="people-image">
				<?php the_post_thumbnail('people-big'); ?>
			</figure>
			
			<ul class="people-list">
				<?php if(get_field('peopletitle')): ?><li class="people-title"><?php the_field('peopletitle'); ?></li><?php endif; ?>
				<?php if(get_field('peopledepartment')): ?><li class="people-department"><?php the_field('peopledepartment'); ?></li><?php endif; ?>
				<?php if(get_field('peoplephone')): ?><li class="people-phone"><strong>Phone:</strong> <?php the_field('peoplephone'); ?></li><?php endif; ?>
				<?php if(get_field('peoplefax')): ?><li class="people-fax"><strong>Fax:</strong> <?php the_field('peoplefax'); ?></li><?php endif; ?>
				<?php if(get_field('peopleemail')): ?><li class="people-email"><strong>Email:</strong> <a href="mailto:<?php the_field('peopleemail'); ?>"><?php the_field('peopleemail'); ?></a></li><?php endif; ?>
				<?php if(get_field('peoplemail')): ?><li class="people-location"><strong>Office Location:</strong> <?php the_field('peoplemail'); ?></li><?php endif; ?>
				<?php if(get_field('peopleurl')): ?><li class="people-url"><strong>Website:</strong> <a href="<?php the_field('peopleurl'); ?>"><?php the_field('peopleurl'); ?></a><?php endif; ?>
			</ul>

			<?php if(get_field('peoplebio')) { ?>
				<div class="people-bio">
					<h3>Biography</h3>
					<?php the_field('peoplebio'); ?>
				</div>
			<?php } ?>

			<?php if(get_field('peopleresearch')) { ?>
				<div class="people-research">
					<h3>Research</h3>
					<?php the_field('peopleresearch'); ?>
				</div>
			<?php } ?>

			<?php if(get_field('peopleedu')) { ?>
				<div class="people-education">
					<h3>Education</h3>
					<?php the_field('peopleedu'); ?>
				</div>
			<?php } ?>

			<?php if(get_field('peoplepubs')) { ?>
				<div class="people-publications">
					<h3>Publications</h3>
					<?php the_field('peoplepubs'); ?>
				</div>
			<?php } ?>

			<?php if(get_field('peoplecustom')) { ?>
				<div class="people-custom">
					<?php $getcustom = get_field('peoplecustom'); apply_filters('the_content', $getcustom); echo wpautop($getcustom); ?>
				</div>
			<?php } ?>


			<p><?php the_tags(); ?></p>


			<?php
				if (get_site_option('uri_comments') ) {
					comments_template();
				}
			?>


		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uri-modern' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'uri-modern' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->


