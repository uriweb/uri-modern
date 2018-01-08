<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package uri-modern
 */

get_header();
get_template_part( 'template-parts/sitebar' );
?>

    <main id="main" class="site-main" role="main">
        
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>

        <?php
        if(has_nav_menu('menu-1')) {
            get_template_part( 'template-parts/localnav' );
        }
        ?>

        <?php
        while ( have_posts() ) : the_post();

            get_template_part( 'template-parts/content', get_post_format() );

            the_post_navigation();

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->

<?php
get_footer();
