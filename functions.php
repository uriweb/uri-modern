<?php
/**
 * URI Modern functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uri-modern
 */

require 'inc/get-breadcrumbs.php';

/**
 * Returns a string to be used for cache busting
 *
 * @return str
 */
function uri_modern_cache_buster() {
	static $cache_buster;
	if ( empty( $cache_buster ) ) {
		$cache_buster = wp_get_theme()->get( 'Version' );
		// $cache_buster = date(time());
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
		 * to change 'uri' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'uri', get_template_directory() . '/languages' );

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

		// add custom URI image sizes
		add_image_size( 'thumbnail@2x', 300, 300, true );
		add_image_size( 'third_column', 364 );
		add_image_size( 'half_column', 500 );
		add_image_size( 'full_column', 1000 );
		add_image_size( 'hero', 1280 );
		add_image_size( 'full_column@2x', 2000 );
		add_image_size( 'hero@2x', 2560 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'uri' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'uri_modern_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for post formats
		add_theme_support(
			'post-formats', array(
				'video',
			)
		);

	}
endif;
add_action( 'after_setup_theme', 'uri_modern_setup' );


/**
 * Label the custom image sizes.
 */
function uri_modern_custom_sizes( $sizes ) {
	return array_merge(
		 $sizes, array(
			 'thumbnail@2x' => __( 'Thumbnail @2x' ),
			 'third_column' => __( 'Third Column' ),
			 'half_column' => __( 'Half Column' ),
			 'full_column' => __( 'Full Column' ),
			 'hero' => __( 'Hero' ),
			 'full_column@2x' => __( 'Full Column @2x' ),
			 'hero@2x' => __( 'Hero @2x' ),
		 )
		);
}
add_filter( 'image_size_names_choose', 'uri_modern_custom_sizes' );


/**
 * Set max srcset image width to 2560px
 */
function set_max_srcset_image_width( $max_width ) {
	$max_width = 2560;
	return $max_width;
}
add_filter( 'max_srcset_image_width', 'set_max_srcset_image_width' );


/**
 * Add post-formats to post_type 'post'.
 */
function uri_modern_add_post_formats_to_post() {
	add_post_type_support( 'post', 'post-formats' );
	register_taxonomy_for_object_type( 'post_format', 'post' );
}
add_action( 'init', 'uri_modern_add_post_formats_to_post', 11 );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uri_modern_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uri_modern_content_width', 1000 );
}
add_action( 'after_setup_theme', 'uri_modern_content_width', 0 );


/**
 * Add open graph elements to the <head>
 *
 * @todo: allow other twitter handles
 */
function uri_modern_open_graph() {
	global $post;
	$summary_type = 'summary';
	if ( is_single() || is_page() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

		// use a larger image in twitter card if the image is wider than it is tall.
		$landscape = ( $image[1] > $image[2] );
		if ( true === $landscape ) {
			$summary_type = 'summary_large_image';
		}

		$image_thumb = $image[0];
		if ( empty( $image_thumb ) ) {
			$image_thumb  = get_template_directory_uri() . '/images/logo-wordmark.png';
			$summary_type = 'summary_large_image';
		}

		$title = get_the_title();
		if ( empty( $title ) ) {
			$title = get_bloginfo( 'name', 'display' ); }

		$excerpt = '';
		// since the excerpt is just about always empty...
		if ( empty( $excerpt ) ) {
			if ( strpos( $post->post_content, '<!--more' ) !== false && 1 == 2 ) {
				$bits = explode( '<!--more', $post->post_content );
			} else {
				$bits = explode( "\n", wordwrap( $post->post_content, 200 ) );
			}
			$excerpt = strip_tags( $bits[0] );
			$excerpt = str_replace( '"', '&quot;', $excerpt );
			$excerpt = trim( $excerpt );
		}

		?>
<meta name="twitter:card" content="<?php echo $summary_type; ?>" />
<meta name="twitter:site" content="@universityofri" />
<meta name="twitter:creator" content="@universityofri" />
<meta property="og:url" content="<?php echo get_permalink(); ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $excerpt; ?>" />
<?php
if ( $image_thumb ) :
?>
<meta property="og:image" content="<?php echo $image_thumb; ?>" />
			<?php
endif;
	}
}

add_action( 'wp_head', 'uri_modern_open_graph' );


/**
 * Set the Google Tag Manager property ID
 *
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
	if ( ! empty( $gtm ) ) :
	?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo $gtm; ?>');</script>
	<?php
	endif;
}
add_action( 'wp_head', 'uri_modern_gtm' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uri_modern_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Banner', 'uri' ),
			'id'            => 'banner',
			'description'   => esc_html__( 'Widgets here appear between the brandbar and sitebar', 'uri' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Content', 'uri' ),
			'id'            => 'before-content',
			'description'   => esc_html__( 'Widgets here appear after the header and above the content.', 'uri' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'After Content', 'uri' ),
			'id'            => 'after-content',
			'description'   => esc_html__( 'Widgets here appear after content and above the footer.', 'uri' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'uri_modern_widgets_init' );


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
 *
 * @param bool $strip is a switch to strip slashes from the end of the URL.
 * It does this so that paths like "who" and "who/*" can be differentiated.
 * Otherwise, there's no way to single out "who".
 *
 * @return str
 */
function uri_modern_get_current_path( $strip = true ) {

	if ( strpos( $_SERVER['HTTP_REFERER'], 'wp-admin/customize.php' ) === false ) {
		$current_path = trim( $_SERVER['REQUEST_URI'] );
	} else {
		// when the Customizer is being used, we need to use the referrer
		// because the Request URI is a different endpoint.
		$url          = parse_url( $_SERVER['HTTP_REFERER'] );
		$q            = trim( urldecode( $url['query'] ) );
		$q            = str_replace( 'url=', '', $q );
		$url          = parse_url( $q );
		$current_path = $url['path'];
	}

	$base_bits = parse_url( site_url() );
	if ( strpos( $current_path, $base_bits['path'] ) === 0 ) {
		$current_path = substr( $current_path, strlen( $base_bits['path'] ) );
	}
	if ( true === $strip ) {
		$current_path = rtrim( $current_path, '/' );
	}

	return $current_path;
}


/**
 * Wrap oembeds with a styleable class
 *
 * @param str $html the html.
 * @param str $url is the URL that was originally included in the post.
 * @param arr $attr is an array with width and height... neither value seems to have a purpose.
 * @param str $post_id is the id of the current post.
 */
function uri_modern_embed_oembed_html( $html, $url, $attr, $post_id ) {
	// parse the URL of the embed to convert the domain name into a CSS class.
	preg_match( '#(http|ftp)s?://(www\.)?([a-z0-9\.\-]+)/?.*#i', $url, $matches );
	$server_class = str_replace( '.', '-', $matches[3] );

	return '<div class="oembed oembed-' . $server_class . '" style="" data-url="' . $url . '">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'uri_modern_embed_oembed_html', 99, 4 );


/**
 * People Tool compatibility
 *
 * @param str $template the template.
 */
function uri_modern_people_page_template( $template ) {

	if ( is_singular( 'people' ) ) {
		$new_template = locate_template( array( 'page.php' ) );
		if ( '' != $new_template ) {
			return $new_template;
		}
	}

	return $template;
}
add_filter( 'template_include', 'uri_modern_people_page_template', 99 );


/**
 * Determine if the tagline should show on pages using
 * the page title in place of the site name in the header.
 *
 * @see inc/customizer.php
 * @return bool
 */
function uri_modern_show_alternate_site_title_tagline() {
	if ( get_option( 'site_header_alternate_titles_hide_tagline' ) && uri_modern_use_alternate_site_title() ) {
		return false;
	} else {
		return true;
	}
}


/**
 * Determine if the page should use the page title in
 * place of the site name in the header
 *
 * @see inc/customizer.php
 * @return bool
 */
function uri_modern_use_alternate_site_title() {

	$whitelist_str = get_option( 'site_header_alternate_titles' );
	if ( empty( $whitelist_str ) ) {
		return false;
	}

	$url       = get_site_url();
	$permalink = get_permalink();

	$whitelist = explode( PHP_EOL, $whitelist_str );

	foreach ( $whitelist as $w ) {
		if ( $url . $w == $permalink || $url . $w . '/' == $permalink ) {
			return true;
			break;
		}
	}
}


/**
 * Get the featured image caption
 *
 * @param obj $post the post.
 */
function uri_modern_get_thumbnail_caption( $post ) {
	if ( empty( $post ) ) {
		return false;
	}

	$thumbnail_id    = get_post_thumbnail_id( $post->ID );
	$thumbnail_image = get_posts(
		array(
			'p'         => $thumbnail_id,
			'post_type' => 'attachment',
		)
	);

	if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		return nl2br( $thumbnail_image[0]->post_excerpt );
	}
	return '';
}

/**
 * Enable shortcodes in text widgets
 */
add_filter( 'widget_text', 'do_shortcode' );

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
 * Shortcodes additions.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Add page slug to body class list in the format 'ln-{slug}'
 *
 * @param array $classes the classes.
 */
function uri_modern_add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = 'ln-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'uri_modern_add_slug_body_class' );
