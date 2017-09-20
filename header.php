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
	<!-- <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_s' ); ?></a> -->

	<header id="masthead" class="site-header" role="banner">
        
        <!-- This URL will need to change, but for now it works for testing -->
        <div id="identity-print"><img src="http://web.uri.edu/business/wp-content/themes/urideptbranch/images/logo-print.png" width="120px" alt="University of Rhode Island"></div>
        
        <div id="globalsearch">
            <input type="checkbox" id="gsform-toggle">
            <label for="gsform-toggle" id="gsform"><span>Menu</span></label>
            <form id="gs" method="get" action="http://www.uri.edu/search" name="global_general_search_form">
                <input type="hidden" name="cx" value="016863979916529535900:17qai8akniu" />
                <input type="hidden" name="cof" value="FORID:11" />
                <input name="q" id="gs-query" value="<?php print (isset($_GET['q'])) ? htmlentities($_GET['q']) : '' ?>" type="text" placeholder="Search" />
                <!--<input type="submit" id="gs-submit" class="searchsubmit" name="searchsubmit" value="Search" />-->
            </form>
        </div>
        
        <div id="globalbanner">
            <div id="globalnav">
                <a href="http://www.uri.edu/" title="University of Rhode Island"><div id="identity">University of Rhode Island</div></a>
                
                <?php if (!get_option('uri_modern_options_hideglobalnav')) : ?>
                    
                <input type="checkbox" id="gnmenu-toggle">
                <label for="gnmenu-toggle" id="gnmenu"><span>Menu</span></label>
                <ul id="gn">
                    <li id="gn-apply"><a href="#" title="Apply">Apply</a></li>
                    <li id="gn-academics"><a href="#" title="Academics">Academics</a></li>
                    <li id="gn-research"><a href="#" title="Research">Research</a></li>
                    <li id="gn-you" class="multi"><a href="#" title="You">You</a></li>
                </ul>
                
                <?php endif; ?>
                
            </div>
        </div>
        
        <div id="sitebanner">
        
            <div id="sitebranding">

                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

                <!--  *** Hide the site description for now until we decide what to do with it.

                <?php $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                    <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                <?php
                endif; ?>

                -->

            </div><!-- #sitebranding -->
                    
        </div><!-- #sitebanner -->

	</header><!-- #masthead -->
    
	<div id="content" class="site-content">
