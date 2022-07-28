<?php
/**
 * Template part for displaying the global nav.
 * Use it by adding the shortcode [uri-modern-gn] to a customizer widget
 *
 * @package uri-modern
 */

?>
	<input type="checkbox" id="globalnav-toggle" role="presentation" aria-label="Open the global navigation menu when browsing on mobile">
	<label for="globalnav-toggle" id="globalnav-label">Main Menu <span role="presentation">open/close</span></label>
	<ul id="globalnav-menu" class="content-width" role="menu">
		<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/admission">Admission</a></li>
		<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/academics">Academics</a></li>
		<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/research">Research</a></li>
		<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/campus-life">Campus Life</a></li>
		<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/about">About</a></li>
		<li role="menuitem"><a href="https://<?php uri_modern_the_domain(); ?>/giving">Giving</a></li>
	</ul>
