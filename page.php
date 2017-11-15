<?php
/**
 *
 *
 * This is the Content Page template (i.e. 'Default Template')
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri-modern
 */

get_header();
get_template_part( 'template-parts/sitebar' );
?>

    <main id="main" class="site-main" role="main">
        
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        
        <?php if(has_nav_menu('menu-1')) : ?>
        <!-- This is the primary site navigation. It only shows up if the menu location is selected as 'Primary'. -->
        <div id="localnav">
            <input type="checkbox" id="lnmenu-toggle">
            <label for="lnmenu-toggle" id="lnmenu">Menu</label>
            <?php wp_nav_menu( array('theme_location' => 'menu-1', 'container' => '', 'fallback_cb' => false) ); ?>
        </div>
        <?php endif; ?>

        <?php
        while ( have_posts() ) : the_post();

            get_template_part( 'template-parts/content', 'page' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->

<?php
get_footer();
