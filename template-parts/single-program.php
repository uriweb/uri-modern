<?php
/**
 * The template for displaying single programs
 *
 * @package uri-modern
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header();
?>

	<main id="main" class="site-main" role="main">
		
		<?php
		while ( have_posts() ) :
			the_post();
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
					</header><!-- .entry-header -->
					
					<div class="featured-image">
						<figure>

							<?php
							$width = ( is_single() ) ? 1200 : 300;
							the_post_thumbnail( array( $width, null ) );

							$figcaption = get_the_post_thumbnail_caption();
							if ( ( is_single() || is_page() ) && ! empty( $figcaption ) ) :
							?>
							<figcaption class="wp-caption"><?php print $figcaption; ?></figcpation>
							<?php endif; ?>
						</figure>
					</div><!-- .featured-image -->
		
					<div class="entry-content">
						<?php

						the_content(
							sprintf(
							/* translators: %s: Name of current post. */
							wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'uri-modern' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						)
							);

						wp_link_pages(
							 array(
								 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uri-modern' ),
								 'after'  => '</div>',
							 )
							);
						?>

						<?php if ( $time_to_completion = uri_modern_get_field( 'time_to_completion' ) ) { ?>
						<div class="time-to-completion">
							<h3>Time to Completion</h3>
							<?php print $time_to_completion; ?>
						</div>
						<?php } ?>

						<?php if ( $application_deadline = uri_modern_get_field( 'application_deadline' ) ) { ?>
						<div class="application-deadline">
							<h3>Application Deadline</h3>
							<?php print $application_deadline; ?>
						</div>
						<?php } ?>


					</div><!-- .entry-content -->
					
					<div class="cl-boxout program-links">
					
						<?php if ( $department_website = uri_modern_get_field( 'department_website' ) ) { ?>
						<div class="department-website">
							<?php echo do_shortcode( '[cl-button link="' . $department_website . '" text="Department Website"]' ); ?>
						</div>
						<?php } ?>

						<?php if ( $catalog_info = uri_modern_get_field( 'catalog_info' ) ) { ?>
						<div class="catalog-info">
							<?php echo do_shortcode( '[cl-button link="' . $catalog_info . '" text="Catalog Information"]' ); ?>
						</div>
						<?php } ?>

						<?php if ( $course_descriptions = uri_modern_get_field( 'course_descriptions' ) ) { ?>
						<div class="course-descriptions">
							<?php echo do_shortcode( '[cl-button link="' . $course_descriptions . '" text="Course Descriptions"]' ); ?>
						</div>
						<?php } ?>

						<?php if ( $course_schedule = uri_modern_get_field( 'course_schedule' ) ) { ?>
						<div class="course-schedule">
							<?php echo do_shortcode( '[cl-button link="' . $course_schedule . '" text="Course Schedule"]' ); ?>
						</div>
						<?php } ?>

						<?php if ( $admission_info = uri_modern_get_field( 'admission_info' ) ) { ?>
						<div class="admission-info">
							<?php echo do_shortcode( '[cl-button link="' . $admission_info . '" text="Admission Information"]' ); ?>
						</div>
						<?php } ?>

						<?php if ( has_category( 'bachelors' ) ) { ?>
						<div class="admission-info">
							<?php echo do_shortcode( '[cl-button link="https://web.uri.edu/advising/curriculum-sheets-all/" text="Curriculum Sheets"]' ); ?>
						</div>
						<?php } ?>

						<?php if ( $apply = uri_modern_get_field( 'apply' ) ) { ?>
						<div class="apply">
							<?php echo do_shortcode( '[cl-button link="' . $apply . '" text="Apply" style="prominent"]' ); ?>
						</div>
						<?php } ?>
					
					</div><!-- .program-links -->
		  
		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->

<?php
get_footer();
