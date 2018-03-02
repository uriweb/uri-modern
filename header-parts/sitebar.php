<?php
/**
 * Template part for displaying the sitebar
 * Used on Content Pages and Internal Landing Pages
 *
 * @package uri-modern
 */

?>


<div id="sitebanner"<?php if ( get_header_image() ) { echo ' style="background-image:url(' . get_header_image() . ')"'; }; if ( get_option('site_header_text_color') ) { echo ' class="light"'; } ?>>
        
    <div id="sb-screen"></div>
    
    <div id="sitebranding">

        <div id="siteidentity">
            
            <h1 class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php 
                    
                    $bases = array(
                        'https://www.uri.edu',
                        'http://quack.uri.edu'
                        );
                    
                    $pages = array(
                        '/admissions',
                        '/academics',
                        '/research',
                        '/campus-life',
                        '/about'
                        );
                    
                    $url = get_permalink();
                                        
                    foreach($bases as $b) {
                        foreach($pages as $p) {
                            $test = $b . $p . '/';
                            if ($url == $test) {
                                $usetitle = true;
                                return;
                            }
                        }
                    }
                    
                    if ($usetitle) {
                        the_title();
                    } else {
                        bloginfo( 'name' );
                    }
                    
                    ?>
                </a>
            </h1>
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
                    
                    $style = 'dark';
                    
                    if ( get_option('site_header_text_color') ) {
                        $style = 'light';
                    }
                        
                    echo do_shortcode('[cl-social style="' . $style . '" facebook="' . $socials['facebook'] . '" instagram="' . $socials['instagram'] . '" twitter="' . $socials['twitter'] . '" youtube="' . $socials['youtube'] . '" snapchat="' . $socials['snapchat'] . '" linkedin="' . $socials['linkedin'] . '"]');
                }
            ?>
        </div>

    </div><!-- #sitebranding -->

</div><!-- #sitebanner -->