<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package uri-modern
 */

get_header();
get_template_part( 'template-parts/sitebar' );
?>

    <main id="main" class="site-main" role="main">
        
        <div id="breadcrumbs">
            Breadcrumbs go here
        </div>
        
        <?php if(has_nav_menu('menu-1')) : ?>
        <!-- This is the primary site navigation. It only shows up if the menu location is selected as 'Primary'. -->
        <div id="localnav">
            <input type="checkbox" id="lnmenu-toggle">
            <label for="lnmenu-toggle" id="lnmenu">Menu</label>
            <?php wp_nav_menu( array('theme_location' => 'menu-1', 'container' => '', 'fallback_cb' => false) ); ?>
        </div>
        <?php endif; ?>

        <section class="error-404 not-found">
            <div id="rhody404"></div>
            <div class="content-404">
                <header class="page-header">
                    <h1 class="page-title super"><?php esc_html_e( 'It looks like you&rsquo;ve rammed into our 404 page.', 'uri-modern' ); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php esc_html_e( 'We can&rsquo;t seem to find what you&rsquo;re looking for.', 'uri-modern' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .page-content -->
            </div>
        </section><!-- .error-404 -->

    </main><!-- #main -->

<?php
get_footer();
