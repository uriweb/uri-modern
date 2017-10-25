<?php
/**
 *
 *
 * Template Name: Page With Sidebar
 *
 *
 * The template for displaying pages with a left-hand sidebar
 *
 */

get_header(); ?>

    <div id="twocol">
    
        <?php if(has_nav_menu('menu-1')) : ?>
            <!-- This is the primary site navigation. It only shows up if the menu location is selected as 'Primary'. -->
            <div id="localnav">
                <input type="checkbox" id="lnmenu-toggle">
                <label for="lnmenu-toggle" id="lnmenu">Menu</label>
                <?php wp_nav_menu( array('theme_location' => 'menu-1', 'container' => '', 'fallback_cb' => false) ); ?>
            </div>
        <?php endif; ?>
        
        <div id="primary" class="content-area">
            <div id="main" class="site-main" role="main">

                <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>

            </div><!-- #main -->
        </div><!-- #primary -->
        
        <div id="sidebar" role="complementary">
            <p>Here's some awesome sidebar content.  It should go on the left-hand side under the primary navigation (if it exists) on full-width, and bump down below the page content on mobile.</p>
            <?php get_sidebar(); ?>
        </div><!-- #sidebar -->
        
    </div><!-- #twocol -->

<?php
get_footer();
