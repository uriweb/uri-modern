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
							wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'uri' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						)
							);

						wp_link_pages(
							 array(
								 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uri' ),
								 'after'  => '</div>',
							 )
							);
						?>

						<hr>

						<div class="program-options">

							<?php if ( has_category( 'accelerated' ) ) { ?>
							<div class="accelerated">
								<span class="icon"></span>
								<?php
									if ( $accelerated_language = uri_modern_get_field( 'accelerated_language' ) ) {
									print $accelerated_language;
									} else {
										echo '<a href="https://' . uri_modern_get_the_domain() . '/programs/abm/">Optional bachelor&#39;s to master&#39;s in five years</a>';
									}
								?>
							</div>
							<?php } ?>

							<?php if ( has_category( 'online' ) ) { ?>
							<div class="online">
								<span class="icon"></span>
								<a href="https://<?php uri_modern_the_domain(); ?>/programs/?program-type=14">Fully online program</a>
							</div>
							<?php } ?>

						</div>

						<div class="program-info">

							<?php if ( $accreditation = uri_modern_get_field( 'accreditation' ) ) { ?>
							<div class="accreditation">
								<h3>Accreditation</h3>
								<?php print $accreditation; ?>
							</div>
							<?php } ?>

							<?php if ( $specializations = uri_modern_get_field( 'specializations' ) ) { ?>
							<div class="specializations">
								<h3>Specializations</h3>
								<?php print $specializations; ?>
							</div>
							<?php } ?>

						</div>

						<div class="program-info">

							<?php if ( $classes_offered = uri_modern_get_field( 'classes_offered' ) ) { ?>
							<div class="classes-offered">
								<h3>Classes Offered</h3>
								<?php print $classes_offered; ?>
							</div>
							<?php } ?>

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

						</div>


					</div><!-- .entry-content -->

					<div class="program-links">

						<?php if ( $course_schedule = uri_modern_get_field( 'course_schedule' ) ) { ?>
						<div class="course-schedule">
							<a href="<?php echo $course_schedule; ?>"><span class="icon"></span>Course Schedule</a>
						</div>
						<?php } ?>

						<?php if ( $course_descriptions = uri_modern_get_field( 'course_descriptions' ) ) { ?>
						<div class="course-descriptions">
							<a href="<?php echo $course_descriptions; ?>"><span class="icon"></span>Course Descriptions</a>
						</div>
						<?php } ?>

						<?php
						$curriculum_sheets = get_field( 'curriculum_sheets' );
						$curriculum_default_link = 'https://' . uri_modern_get_the_domain( 'web' ) . '/advising/curriculum-sheets-all/';
						if ( ( null != $curriculum_sheets || ! empty( $curriculum_sheets ) ) && $curriculum_default_link != $curriculum_sheets ) {
										echo '<div class="advising">';
										echo '<a href="' . $curriculum_sheets . '"><span class="icon"></span>Advising</a>';
										echo '</div>';
						} else if ( has_category( 'bachelors' ) ) {
										echo '<div class="curriculum-sheets">';
										echo '<a href="' . $curriculum_default_link . '"><span class="icon"></span>Curriculum Sheets</a>';
										echo '</div>';
						}
						?>

						<?php if ( $catalog_info = uri_modern_get_field( 'catalog_info' ) ) { ?>
						<div class="catalog-info">
							<a href="<?php echo $catalog_info; ?>"><span class="icon"></span>Catalog Information</a>
						</div>
						<?php } ?>

					</div><!-- .program-links -->

					<div class="cl-tiles thirds">

						<?php if ( $department_website = uri_modern_get_field( 'department_website' ) ) { ?>
						<div class="department-website">
							<?php echo do_shortcode( '[cl-button link="' . $department_website . '" text="Department Website"]' ); ?>
						</div>
						<?php } ?>

						<?php if ( $admission_info = uri_modern_get_field( 'admission_info' ) ) { ?>
						<div class="admission-info">
							<?php echo do_shortcode( '[cl-button link="' . $admission_info . '" text="Admission Information"]' ); ?>
						</div>
						<?php } ?>

						<?php if ( $apply = uri_modern_get_field( 'apply' ) ) { ?>
						<div class="apply">
							<?php echo do_shortcode( '[cl-button link="' . $apply . '" text="Apply" style="prominent"]' ); ?>
						</div>
						<?php } ?>

					</div>

		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->

<?php
get_footer();
