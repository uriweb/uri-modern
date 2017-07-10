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
        <div id="sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </div><!-- #sidebar -->

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
    </div><!-- #twocol -->

<?php
get_footer();
