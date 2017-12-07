<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uri-modern
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
    
<!-- Typekit embed code -->
<script type="text/javascript" src="//use.typekit.com/qcq6uhe.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<!-- End TK -->


</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<!-- <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'uri-modern' ); ?></a> -->

	<header id="brandbar" class="site-header" role="banner">
        
        <!-- This URL will need to change, but for now it works for testing -->
        <div id="identity-print"><img src="http://web.uri.edu/business/wp-content/themes/urideptbranch/images/logo-print.png" width="120px" alt="University of Rhode Island"></div>
        
        <div id="globalsearch" role="search">
            <input type="checkbox" id="gsform-toggle" role="presentation" aria-label="Toggle visibility of the search box.">
            <label for="gsform-toggle" id="gsform"><span>Search</span></label>
            <form id="gs" method="get" action="http://www.uri.edu/search" name="global_general_search_form">
                <input type="hidden" name="cx" value="016863979916529535900:17qai8akniu" />
                <input type="hidden" name="cof" value="FORID:11" />
                <input role="searchbox" name="q" id="gs-query" value="<?php print (isset($_GET['q'])) ? htmlentities($_GET['q']) : '' ?>" type="text" placeholder="Search" />
                <input type="submit" id="gs-submit" class="searchsubmit" name="searchsubmit" value="Search" />
            </form>
        </div>
        
        <div id="globalbanner-wrapper">
            <div id="globalbanner">
                <a href="http://www.uri.edu/" title="University of Rhode Island"><div id="identity">University of Rhode Island</div></a>
                                    
                <input type="checkbox" id="gateways-toggle" role="presentation" aria-label="Open the audience gateways menu when browsing on mobile">
                <label for="gateways-toggle" id="gateways-label"><span>You</span></label>
                <ul id="gateways-menu" role="menu">
                    <li role="presentation"><a href="#" role="menuitem">Prospective Students</a></li>
                    <li role="presentation"><a href="#" role="menuitem">Students</a></li>
                    <li role="presentation"><a href="#" role="menuitem">Faculty and Staff</a></li>
                    <li role="presentation"><a href="#" role="menuitem">Parents and Families</a></li>
                    <li role="presentation"><a href="#" role="menuitem">Alumni</a></li>
                    <li role="presentation"><a href="#" role="menuitem">Community</a></li>
                </ul>
                                
            </div>
        </div>

	</header><!-- #brandbar -->
    
	<div id="content" class="site-content">
