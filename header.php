<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
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

        <div id="globalbanner">
            <div id="globalnav">
                <a href="http://www.uri.edu/" title="University of Rhode Island"><div id="identity">University of Rhode Island</div></a>
                <?php if (of_get_option('urim_gnvis') == 'on') : ?>
                    <input type="checkbox" id="gnmenu-toggle">
                    <label for="gnmenu-toggle" id="gnmenu">Menu</label>
                    <ul id="gn">
                        <li id="gn-apply"><a href="#" title="Apply">Apply</a></li>
                        <li id="gn-academics"><a href="#" title="Academics">Academics</a></li>
                        <li id="gn-research"><a href="#" title="Research">Research</a></li>
                        <li id="gn-you"><a href="#" title="You">You</a></li>
                    </ul>
                <?php endif; ?>
                <div id="globalsearch">
                    <form method="get" action="http://www.uri.edu/search" name="global_general_search_form">
                        <input type="hidden" name="cx" value="016863979916529535900:17qai8akniu" />
                        <input type="hidden" name="cof" value="FORID:11" />
                        <input name="q" id="gs-query" value="<?php print (isset($_GET['q'])) ? htmlentities($_GET['q']) : '' ?>" type="text" placeholder="Search" />
                        <input type="submit" id="gs-submit" class="searchsubmit" name="searchsubmit" value="Search" />
                    </form>
                </div>
            </div>
        </div>
        
		<div class="site-branding">
            
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

            <?php $description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
            
		</div><!-- .site-branding -->

        <!--
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', '_s' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
