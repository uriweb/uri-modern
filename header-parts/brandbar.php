<?php
/**
 * Template part for displaying the brandbar.
 *
 * @package uri-modern
 */

?>

	<header id="brandbar" class="site-header" role="banner">
		
		<div id="identity-print"><img src="<?php echo get_template_directory_uri() . '/images/logo-print.png'; ?>" width="120px" alt="University of Rhode Island"></div>
		
		<div id="globalsearch" role="search">
			<input type="checkbox" id="gsform-toggle" role="presentation" aria-label="Toggle visibility of the search box.">
			<label for="gsform-toggle" id="gsform"><span>Search</span></label>
			<form id="gs" method="get" action="https://www.uri.edu/search" name="global_general_search_form">
				<input type="hidden" name="cx" value="016863979916529535900:17qai8akniu" />
				<input type="hidden" name="cof" value="FORID:11" />
				<label id="gs-query-label" for="gs-query">Searchbox</label>
				<input role="searchbox" name="q" id="gs-query" value="<?php print ( isset( $_GET['q'] ) ) ? htmlentities( $_GET['q'] ) : ''; ?>" type="text" placeholder="Search" />
				<input type="submit" id="gs-submit" class="searchsubmit" name="searchsubmit" value="Search" />
			</form>
		</div>
		
		<div id="globalbanner-wrapper">
			<div id="globalbanner">
				<a href="http://<?php echo uri_modern_get_subdomain(); ?>.uri.edu/" title="University of Rhode Island"><div id="identity">University of Rhode Island</div></a>
				
				<?php if ( URI_BETA_FEATURES !== null && URI_BETA_FEATURES === true ) : ?>
				
				<div id="gateways">
					<input type="checkbox" id="gateways-toggle" role="presentation" aria-label="Open the audience gateways menu when browsing on mobile">
					<label for="gateways-toggle" id="gateways-label"><span><?php echo ( URI_EASTER_EGGS !== null && URI_EASTER_EGGS === true ) ? '&#128017' : 'You'; ?></span></label>
					<ul id="gateways-menu" role="menu">
						<li><a href="https://<?php echo uri_modern_get_subdomain(); ?>.uri.edu/gateway/future-students" role="menuitem">Future Students</a></li>
						<li><a href="https://<?php echo uri_modern_get_subdomain(); ?>.uri.edu/gateway/students" role="menuitem">Students</a></li>
						<li><a href="https://<?php echo uri_modern_get_subdomain(); ?>.uri.edu/gateway/faculty" role="menuitem">Faculty</a></li>
						<li><a href="https://<?php echo uri_modern_get_subdomain(); ?>.uri.edu/gateway/staff" role="menuitem">Staff</a></li>
						<li><a href="https://<?php echo uri_modern_get_subdomain(); ?>.uri.edu/gateway/families" role="menuitem">Parents and Families</a></li>
						<li><a href="https://<?php echo uri_modern_get_subdomain(); ?>.uri.edu/gateway/alumni" role="menuitem">Alumni</a></li>
						<li><a href="https://<?php echo uri_modern_get_subdomain(); ?>.uri.edu/gateway/community" role="menuitem">Community</a></li>
					</ul>
				</div>
				<?php endif ?>
								
			</div>
		</div>

	</header><!-- #brandbar -->
