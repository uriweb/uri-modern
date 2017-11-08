<?php
/**
 * Template part for displaying the sitebar
 * Used on Content Pages and Internal Landing Pages
 *
 * @package uri-modern
 */

?>


<div id="sitebanner">
        
    <div id="sitebranding">

        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

        <?php $description = get_bloginfo( 'description', 'display' );
        if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
        <?php
        endif; ?>

    </div><!-- #sitebranding -->

</div><!-- #sitebanner -->