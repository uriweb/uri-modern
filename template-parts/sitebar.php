<?php
/**
 * Template part for displaying the sitebar
 * Used on Content Pages and Internal Landing Pages
 *
 * @package uri-modern
 */

?>


<div id="sitebanner"<?php if ( get_header_image() ) { echo ' style="background-image:url(' . get_header_image() . ')"'; } ?>>
        
    <div id="sitebranding">

        <div id="siteidentity">
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <h2 class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></h2>
            <?php
            endif; ?>
        </div>
        
        <div id="sitesocial">
            <?php 
                if (function_exists('uri_cl_shortcode_social')) {
                    $socials = array(
                        'facebook' => get_option('department_facebook_URL'),
                        'instagram' => get_option('department_instagram_URL'),
                        'twitter' => get_option('department_twitter_URL'),
                        'youtube' => get_option('department_youtube_URL'),
                        'snapchat' => get_option('department_snapchat_URL'),
                        'linkedin' => get_option('department_linkedin_URL')
                    );
                        
                    echo do_shortcode('[cl-social style="white" facebook="' . $socials['facebook'] . '" instagram="' . $socials['instagram'] . '" twitter="' . $socials['twitter'] . '" youtube="' . $socials['youtube'] . '" snapchat="' . $socials['snapchat'] . '" linkedin="' . $socials['linkedin'] . '"]');
                }
            ?>
        </div>

    </div><!-- #sitebranding -->

</div><!-- #sitebanner -->