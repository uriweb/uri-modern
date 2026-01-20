<?php

/**
 * Template part for displaying the brandbar.
 *
 * @package uri-modern
 * @todo #globalsearch currently cannot be focused; should be button, not checkbox
 * @todo #gateways currently cannot be focused; should be button, not checkbox
 */

?>

<div id="brandbar" class="site-header" role="none">

	<div id="identity-print"><img src="<?php echo get_template_directory_uri() . '/images/logo-print.png'; ?>" width="120px" alt="University of Rhode Island Home"></div>

	<div id="globalsearch">
		<button id="gsform" aria-controls="gs" aria-expanded="false" aria-label="Search URI"><span>Search</span></button>
		<form id="gs" method="get" class="" action="https://<?php uri_modern_the_domain(); ?>/search" name="global_general_search_form">
			<div role="search">
			<input type="hidden" name="cx" value="<?php uri_modern_the_gs_id(); ?>" />
			<input type="hidden" name="cof" value="FORID:11" />
			<label id="gs-query-label" for="gs-query">Search the URI website</label>
			<input role="searchbox" name="q" id="gs-query" value="<?php print (isset($_GET['q'])) ? htmlentities($_GET['q']) : ''; ?>" type="text" placeholder="Search" />
			<input type="submit" id="gs-submit" class="searchsubmit" name="searchsubmit" value="Search" />
		</div>
		</form>
	</div>

	<div id="globalbanner-wrapper">
		<div id="globalbanner">
			<a href="https://<?php uri_modern_the_domain(); ?>/" title="University of Rhode Island Home">
				<div id="identity"><span>University of Rhode Island</span></div>
			</a>

			<div id="gateways">
				<nav id="gateways-menu" aria-label="Resources for you">
					<ul>
						<li>
							<button id="gateways-toggle" class="gateways-label" aria-controls="gateways-dropdown" aria-expanded="false" aria-label="Resources for you navigation"><span>You</span></button>
						</li>
						<ul id="gateways-dropdown" class="you-dropdown"><!--submenu dropdown -->
							<li><a href="https://<?php uri_modern_the_domain(); ?>/gateway/future-students">Future Students</a></li>
							<li><a href="https://<?php uri_modern_the_domain(); ?>/gateway/students">Students</a></li>
							<li><a href="https://<?php uri_modern_the_domain(); ?>/gateway/faculty">Faculty</a></li>
							<li><a href="https://<?php uri_modern_the_domain(); ?>/gateway/staff">Staff</a></li>
							<li><a href="https://<?php uri_modern_the_domain(); ?>/gateway/families">Parents and Families</a></li>
							<li><a href="https://<?php uri_modern_the_domain(); ?>/gateway/alumni">Alumni</a></li>
							<li><a href="https://<?php uri_modern_the_domain(); ?>/gateway/community">Community</a></li>
						</ul> <!--end submenu dropdown-->
					</ul>
				</nav>
			</div>
		</div>
	</div>

</div><!-- #brandbar -->