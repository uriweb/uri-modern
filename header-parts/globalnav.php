<?php
/**
 * Template part for displaying the global nav.
 * Use it by adding the shortcode [uri-modern-gn] to a customizer widget
 *
 * @package uri-modern
 */

?>
	<input type="checkbox" id="globalnav-toggle" role="presentation" aria-label="Open the global navigation menu when browsing on mobile">
	<label for="globalnav-toggle" id="globalnav-label">Main Menu<span role="presentation">open/close</span></label>
	<ul id="globalnav-menu" class="content-width" role="menu">
		<li rule="menuitem"><a href="https://<?php uri_modern_the_subdomain(); ?>.uri.edu/admission">Admission</a></li>
		<li rule="menuitem"><a href="https://<?php uri_modern_the_subdomain(); ?>.uri.edu/academics">Academics</a></li>
		<li rule="menuitem"><a href="https://<?php uri_modern_the_subdomain(); ?>.uri.edu/research">Research</a></li>
		<li rule="menuitem"><a href="https://<?php uri_modern_the_subdomain(); ?>.uri.edu/campus-life">Campus Life</a></li>
		<li rule="menuitem"><a href="https://<?php uri_modern_the_subdomain(); ?>.uri.edu/about">About</a></li>
	</ul>
