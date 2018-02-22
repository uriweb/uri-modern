<?php
/**
 * URI Modern functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uri-modern
 */

include 'inc/get-breadcrumbs.php';

/**
 * returns a string to be used for cache busting
 * @return str
 */
function uri_modern_cache_buster() {
	static $cache_buster;
	if(empty($cache_buster)) {
		$cache_buster = wp_get_theme()->get('Version');
		//$cache_buster = date(time());
	}
	return $cache_buster;
}


if ( ! function_exists( 'uri_modern_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function uri_modern_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change 'uri-modern' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'uri-modern', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'uri-modern' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'uri_modern_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'uri_modern_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uri_modern_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uri_modern_content_width', 640 );
}
add_action( 'after_setup_theme', 'uri_modern_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uri_modern_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'uri-modern' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'uri-modern' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'uri_modern_widgets_init' );


/**
 * Add open graph elements to the <head>
 * @todo: allow other twitter handles
 */
function uri_modern_open_graph() {
	global $post;
	$summary_type = 'summary';
	if( is_single() || is_page() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		
		// use a larger image in twitter card if the image is wider than it is tall
		$landscape = ($image[1] > $image[2]);
		if($landscape === TRUE) {
			$summary_type = 'summary_large_image';
		}
		
		$image_thumb = $image[0];
		if( empty( $image_thumb ) ) {
			$image_thumb = get_template_directory_uri() . '/images/logo-wordmark.png';
			$summary_type = 'summary_large_image';
		}
		
		$title = get_the_title();
		if( empty ( $title) ) { $title = get_bloginfo( 'name', 'display' ); }
		
		//setup_postdata( $post );
		//$excerpt = get_the_excerpt($post);
		$excerpt = '';
		// since the excerpt is just about always empty...
		if( empty ( $excerpt ) ) {
			if( strpos( $post->post_content, '<!--more' ) !== FALSE && 1==2) {
				$bits = explode('<!--more', $post->post_content);
			} else {
				$bits = explode( "\n", wordwrap( $post->post_content, 200 ));
			}
			$excerpt = strip_tags($bits[0]);
			$excerpt = str_replace('"', '&quot;', $excerpt);
			$excerpt = trim($excerpt);
		}

		?>
<meta name="twitter:card" content="<?php echo $summary_type; ?>" />
<meta name="twitter:site" content="@universityofri" />
<meta name="twitter:creator" content="@universityofri" />
<meta property="og:url" content="<?php echo get_permalink(); ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $excerpt; ?>" />
<?php if( $image_thumb ): ?><meta property="og:image" content="<?php echo $image_thumb; ?>" /><?php endif;
	}
	//wp_reset_postdata();
}

add_action('wp_head', 'uri_modern_open_graph');


/**
 * Set the Google Tag Manager property ID
 * @return str
 */
function uri_modern_gtm_value() {
        
	return 'GTM-K5GL9W';
    
}


/**
 * Adds Google Tag Manager code to <head>
 */
function uri_modern_gtm() {
	$gtm = uri_modern_gtm_value();
	if ( ! empty ( $gtm ) ):
	?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo $gtm; ?>');</script>
	<?php
	endif;
}
add_action('wp_head', 'uri_modern_gtm');


/**
 * Enqueue scripts and styles.
 */
function uri_modern_scripts() {
	wp_enqueue_style( 'uri-modern-style', get_template_directory_uri() . '/style.css', array(), uri_modern_cache_buster(), 'all' );

	wp_enqueue_script( 'uri-modern-navigation', get_template_directory_uri() . '/js/navigation.js', array(), uri_modern_cache_buster(), true );

	wp_enqueue_script( 'uri-modern-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), uri_modern_cache_buster(), true );
    
    wp_enqueue_script( 'uri-modern-scripts', get_template_directory_uri() . '/js/script.min.js', array(), uri_modern_cache_buster(), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'uri_modern_scripts' );


/**
 * Gets the current WP path as known by Apache, not WordPress.
 * @param bool $right is a switch to strip slashes from the end of the URL
 * it does this so that paths like "who" and "who/*" can be differentiated
 * otherwise, there's no way to single out "who"
 * @return str
 */
function uri_modern_get_current_path($strip=TRUE) {

	
	if ( strpos($_SERVER['HTTP_REFERER'], 'wp-admin/customize.php') === FALSE ) {
		$current_path = trim($_SERVER['REQUEST_URI']);
	} else {
		// when the Customizer is being used, we need to use the referrer 
		// because the Request URI is a different endpoint.
		$url = parse_url( $_SERVER['HTTP_REFERER'] );
		$q = trim( urldecode ( $url['query'] ) );
		$q = str_replace( 'url=', '', $q );
		$url = parse_url ( $q );
		$current_path = $url['path'];
	}


	$base_bits = parse_url( site_url() );	
	if ( strpos ( $current_path, $base_bits['path'] ) === 0 ) {
		$current_path = substr( $current_path, strlen( $base_bits['path'] ) );
	}
	if($strip === TRUE) {
		$current_path = rtrim($current_path, '/');
	}
	
	return $current_path;
}


/**
 * Wrap oembeds with a styleable class
 */
function uri_modern_embed_oembed_html($html, $url, $attr, $post_id) {
	// $attr is an array with width and height... neither value seems to have a purpose
	// $post_id is the id of the current post
	// $url is the URL that was originally included in the post

	// parse the URL of the embed to convert the domain name into a CSS class
	preg_match('#(http|ftp)s?://(www\.)?([a-z0-9\.\-]+)/?.*#i', $url, $matches);
	$server_class = str_replace(".", "-", $matches[3]);

	return '<div class="oembed oembed-' . $server_class . '" style="" data-url="' . $url . '">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'uri_modern_embed_oembed_html', 99, 4);


/**
 * People Tool compatibility
 */
function uri_modern_people_page_template( $template ) {

	if ( is_singular( 'people' )  ) {
		$new_template = locate_template( array( 'page.php' ) );
		if ( '' != $new_template ) {
			return $new_template;
		}
	}

	return $template;
}
add_filter( 'template_include', 'uri_modern_people_page_template', 99 );


/**
 * Get the featured image caption
 */
function uri_modern_get_thumbnail_caption($post) {
	if( empty( $post ) ) {
		return FALSE;
	}

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    return nl2br($thumbnail_image[0]->post_excerpt);
  }
  return '';
}




/**
 * Debugging
 */
require get_template_directory() . '/console.php';

// Don't break the site if debugging is removed
if ( !function_exists( 'uri_console' ) ) {
	function uri_console() {
		return FALSE;
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Layout options
 */
require get_template_directory() . '/inc/layout-options.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Add page slug to body class list in the format 'ln-{slug}'
 */
function uri_modern_add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = 'ln-' . $post->post_name;
    }
    return $classes;
    }
add_filter( 'body_class', 'uri_modern_add_slug_body_class' );
