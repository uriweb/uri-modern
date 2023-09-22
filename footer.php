<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uri-modern
 */

?>

	</div><!-- #content -->

	<?php if ( is_active_sidebar( 'after-content' ) ) : ?>
		<div id="region-after-content" class="region-after-content">
			<div class="widgets content-width">
				<?php dynamic_sidebar( 'after-content' ); ?>
			</div>
		</div><!-- #region-after-content -->
	<?php endif; ?>

	<div id="actionbar-wrapper">
		<div id="actionbar" role="menu">
			<?php
				// connect
				$link = array(
					'href' => 'https://' . uri_modern_get_the_domain() . '/connect',
					'id' => 'action-connect',
					'text' => 'Connect',
					'title' => 'Learn more about URI: Get in touch',
				);
				echo uri_modern_action_bar_link( $link );

				// apply
				$link = array(
					'href' => 'https://' . uri_modern_get_the_domain() . '/apply',
					'id' => 'action-apply',
					'text' => 'Apply',
				);
				echo uri_modern_action_bar_link( $link );

				// tour
				$link = array(
					'href' => 'https://' . uri_modern_get_the_domain() . '/tour',
					'id' => 'action-tour',
					'text' => 'Tour',
				);
				echo uri_modern_action_bar_link( $link );

				// give
				$link = array(
					'href' => 'https://' . uri_modern_get_the_domain() . '/give',
					'id' => 'action-give',
					'text' => 'Give',
				);
				if ( ! empty( get_option( 'action_bar_give_url' ) ) ) {
					$link['href'] = get_option( 'action_bar_give_url' );
				}
				echo uri_modern_action_bar_link( $link );

			?>
		</div>
	</div><!-- #actionbar-wrapper -->

	<footer id="globalfooter">
		<div id="basement">
			<div id="storagebins">
				<div id="sb-university">
					<input id="sb-university-toggle" type="radio" name="storagebin" value="university" role="presentation" checked>
					<label for="sb-university-toggle" aria-label="Open the University footer menu when browsing on mobile."><span>University</span></label>
					<ul role="menu" aria-label="The University footer menu.">
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/about/leadership/">Leadership</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain( 'web' ); ?>/diversity/">Diversity and Inclusion</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain( 'web' ); ?>/global/">Global</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/about/campuses/">Campuses</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/safety/">Safety</a></li>
					</ul>
				</div>
				<div id="sb-campus-life">
					<input id="sb-campus-life-toggle" type="radio" name="storagebin" value="campus-life" role="presentation">
					<label for="sb-campus-life-toggle" aria-label="Open the Campus Life footer menu when browsing on mobile."><span>Campus Life</span></label>
					<ul role="menu" aria-label="The Campus Life footer menu.">
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain( 'web' ); ?>/housing/">Housing</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain( 'web' ); ?>/dining/">Dining</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/athletics/">Athletics and Recreation</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/campus-life/health-and-wellness/">Health and Wellness</a></li>
						<li role="menuitem"><a href="https://events.uri.edu" role="menuitem">Events</a></li>
					</ul>
				</div>
				<div id="sb-academics">
					<input id="sb-academics-toggle" type="radio" name="storagebin" value="academics" role="presentation">
					<label for="sb-academics-toggle" aria-label="Open the Academics footer menu when browsing on mobile."><span>Academics</span></label>
					<ul role="menu" aria-label="The Academics footer menu.">
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/academics/">Undergraduate</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain( 'web' ); ?>/graduate-school/">Graduate</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain( 'web' ); ?>/advising/">Advising</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain( 'web' ); ?>/library/">Libraries</a></li>
						<li role="menuitem"><a href="https://<?php uri_modern_the_domain( 'web' ); ?>/career/students/">Internships</a></li>
					</ul>
				</div>
			</div>
			<div id="gimmicks">
				<!-- Tides Widget -->
				<?php
				if ( function_exists( 'uri_tides_shortcode' ) ) {
					echo do_shortcode( '[uri-tides darkmode=true height=22]' );
				}
				?>

				<?php if ( function_exists( 'uri_tides_shortcode' ) && function_exists( 'uri_cl_shortcode_social' ) ) : ?>
				<hr>
				<?php endif ?>

				<!-- Social Media Component -->
				<?php
				if ( function_exists( 'uri_cl_shortcode_social' ) ) {
					$facebook  = 'https://www.facebook.com/universityofri';
					$instagram = 'https://www.instagram.com/universityofri/';
					$twitter   = 'https://twitter.com/universityofri';
					$youtube   = 'https://www.youtube.com/user/UniversityOfRI';
					echo do_shortcode( '[cl-social style="light" facebook="' . $facebook . '" instagram="' . $instagram . '" twitter="' . $twitter . '" youtube="' . $youtube . '"]' );
				}
				?>
			</div>
		</div>
		<div id="tagline"></div>
		<div id="legal">
			<p>Copyright &copy; <a class="subtle" href="http://<?php uri_modern_the_domain(); ?>/">University of Rhode Island</a> | University of Rhode Island, Kingston, RI 02881, USA | 1.401.874.1000</p>
			<p>URI is an equal opportunity employer committed to the principles of affirmative action.&nbsp;&nbsp;<a class="jobs" href="https://jobs.uri.edu/">Work at URI</a></p>
		</div>
	</footer><!-- #globalfooter -->
</div><!-- #page -->

<?php wp_footer(); ?>
<?php get_template_part( 'asciiart' ); ?>

</body>
</html>
