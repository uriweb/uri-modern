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


/**
 * Returns the subdomain to use
 *
 * @return str
 */
function uri_modern_get_the_subdomain() {

	$default = 'www';

	$whitelist = array(
		'www',
		'next',
		'quack',
	);

	$parsed_url = parse_url( get_site_url() );
	$host = explode( '.', $parsed_url['host'] );
	$subdomain = $host[0];

	return in_array( $subdomain, $whitelist ) ? $subdomain : $default;

}


/**
 * Echos the subdomain to use
 */
function uri_modern_the_subdomain() {
	echo uri_modern_get_the_subdomain();
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
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'uri_modern_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for post formats
		add_theme_support(
			'post-formats',
			array(
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
		 $sizes,
		array(
			'thumbnail@2x' => __( 'Thumbnail @2x', 'uri' ),
			'third_column' => __( 'Third Column', 'uri' ),
			'half_column' => __( 'Half Column', 'uri' ),
			'full_column' => __( 'Full Column', 'uri' ),
			'hero' => __( 'Hero', 'uri' ),
			'full_column@2x' => __( 'Full Column @2x', 'uri' ),
			'hero@2x' => __( 'Hero @2x', 'uri' ),
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
 * Enables the Excerpt meta box in Page edit screen.
 */
function uri_modern_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'uri_modern_add_excerpt_support_for_pages' );


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

		$excerpt = get_the_excerpt();

		if ( empty( $excerpt ) ) {
			if ( strpos( $post->post_content, '<!--more' ) !== false ) {
				$bits = explode( '<!--more', $post->post_content );
			} else {
				$bits = explode( "\n", wordwrap( $post->post_content, 400 ) );
			}
			$excerpt = $bits[0];
		}

		$excerpt = do_shortcode( $excerpt ); // parse shortcodes
		$excerpt = preg_replace( '/(<[^>]+>)+/', ' ... ', $excerpt ); // replace html
		$excerpt = ltrim( $excerpt, ' .' ); // remove leading points of ellipses from replace
		$excerpt = str_replace( '"', '&quot;', $excerpt ); // sanitize quotes
		$excerpt = trim( $excerpt ); // remove whitespace on either end

		?>
<meta name="description" content="<?php echo $excerpt; ?>" />
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

	$values = array(
		'base' => get_site_url(),
		'path' => array(
			'page' => get_permalink(),
			'theme' => get_stylesheet_directory_uri(),
			'themes' => get_theme_root_uri(),
			'plugins' => WP_PLUGIN_URL,
		),
		'theme' => array(
			'name' => wp_get_theme()->get( 'Name' ),
			'version' => wp_get_theme()->get( 'Version' ),
			'textDomain' => wp_get_theme()->get( 'TextDomain' ),
		),
		'is' => array(
			'404' => is_404(),
			'childTheme' => get_template_directory_uri() != get_stylesheet_directory_uri() ? true : false,
			'admin' => uri_modern_has_admin_privilages(),
		),
		'features' => array(),
	);

	wp_enqueue_style( 'uri-modern-style', get_template_directory_uri() . '/style.css', array(), uri_modern_cache_buster(), 'all' );

	wp_enqueue_script( 'uri-modern-color-scheme', get_template_directory_uri() . '/js/color-scheme.js', array(), uri_modern_cache_buster(), false );

	wp_enqueue_script( 'uri-modern-navigation', get_template_directory_uri() . '/js/navigation.js', array(), uri_modern_cache_buster(), true );

	wp_enqueue_script( 'uri-modern-smoothscroll', get_template_directory_uri() . '/js/smoothscroll.min.js', array(), uri_modern_cache_buster(), true );

	wp_enqueue_script( 'uri-modern-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), uri_modern_cache_buster(), true );

	wp_enqueue_script( 'uri-modern-scripts', get_template_directory_uri() . '/js/script.min.js', array(), uri_modern_cache_buster(), true );
	wp_localize_script( 'uri-modern-scripts', 'URIMODERN', $values );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'uri_modern_scripts' );


/**
 * Enable styles in the WYSIWYG Editor (BETA FEATURE)
 */
if ( get_option( 'beta_editor_theme_styles' ) ) {

	if ( is_admin() ) {
		add_editor_style( get_template_directory_uri() . '/style.css', __FILE__ );
	}
}


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

	if ( ! isset( $_SERVER['HTTP_REFERER'] ) || strpos( $_SERVER['HTTP_REFERER'], 'wp-admin/customize.php' ) === false ) {
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
	if ( ! empty( $current_path ) && ! empty( $base_bits['path'] ) ) {
		if ( strpos( $current_path, $base_bits['path'] ) === 0 ) {
			$current_path = substr( $current_path, strlen( $base_bits['path'] ) );
		}
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
 * Remove WordPress page title prepends
 *
 * @param str $t the post title.
 */
function uri_modern_sanitize_title( $t ) {

	$prepends = array(
		'Category: ',
		'Archive: ',
		'Tag: ',
	);

	foreach ( $prepends as $p ) {
		if ( substr( $t, 0, strlen( $p ) ) == $p ) {
			 return substr( $t, strlen( $p ) );
		}
	}
	// still here, title can go out the way it came in.
	return $t;

}


/**
 * Wrapper for Advanced Custom Fields get_field()
 */
function uri_modern_get_field() {

	$r = false;

	if ( function_exists( 'get_field' ) ) {
		$r = call_user_func_array( 'get_field', func_get_args() );
	}

	return $r;

}


/**
 * Get user role
 */
function uri_modern_has_admin_privilages() {

	$admin = false;

	global $current_user;
	$role = array_shift( $current_user->roles );

	if ( 'administrator' == $role || 'Webadmin' == $role ) {
		$admin = true;
	}

	return $admin;

}


/**
 * Callback function for Action Bar buttons
 */
function uri_modern_action_bar_link( $link ) {

	$apply = apply_filters( 'uri_modern_action_bar_link', $link );

	$atts = '';
	if ( ! empty( $apply['title'] ) ) {
		$atts .= ' title="' . esc_attr( $apply['title'] ) . '"';
	}
	if ( ! empty( $apply['class'] ) ) {
		$atts .= ' class="' . esc_attr( $apply['class'] ) . '"';
	}
	return '<a href="' . esc_url( $apply['href'] ) . '" id="' . esc_attr( $apply['id'] ) . '" role="menuitem"><span role="presentation"' . $atts . '></span>' . wp_filter_post_kses( $apply['text'] ) . '</a>';
}

/**
 * Filter for action bar buttons
 */
function uri_modern_action_bar_filter_callback( $a ) {
	$defaults = array(
		'class' => '',
		'href' => 'https://www.uri.edu/apply',
		'id' => 'action-apply',
		'text' => 'Apply',
		'title' => '',
	);

	// if we're in a graduate context, and it's the apply button, override the passed values
	// @todo: how to allow for overrides in a non-clunky way?
	// - changing $GLOBALS['actionbar_apply'] works
	// - getting away from a global would be better
	if ( empty( $a['text'] ) || 'Apply' === $a['text'] ) {
		// it's an apply button, let's check for a context to determine grad or undergrad
		$is_grad = get_option( 'action_bar_apply_url_is_graduate', false );

		if ( ! $is_grad ) {
			$field = uri_modern_get_field( 'is_graduate' );
			if ( isset( $field[0] ) && 'graduate' === strtolower( $field[0] ) ) {
				$is_grad = true;
			}
		}

		if ( $is_grad ) {
			// it's a grad school page, override the link
			$a['href'] = 'https://www.uri.edu/apply/graduate';
			$a['title'] = 'Apply with GradCAS';
		}
	}

	// Finally, customize the link with supplied input
	$link = array_replace( $defaults, $a );

	return $link;
}
add_filter( 'uri_modern_action_bar_link', 'uri_modern_action_bar_filter_callback', 10, 1 );



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
 * Theme options
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 * Layout options
 */
require get_template_directory() . '/inc/layout-options.php';

/**
 * Shortcodes additions.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * WYSIWYG additions
 */
require get_template_directory() . '/inc/wysiwyg.php';

/**
 * Gutenberg additions
 */
require get_template_directory() . '/inc/gutenberg.php';

/**
 * Display Posts customizations
 */
require get_template_directory() . '/inc/display-posts.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load the Search and Filter helper functions
 */
require get_template_directory() . '/inc/search-filter.php';

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

/**
 * Add to body class list depending on which color scheme should be honored
 *
 * @param array $classes the classes.
 */
function uri_modern_color_scheme_body_class( $classes ) {
	global $post;
	$scheme = uri_modern_get_field( 'uri_modern_color_scheme' );
	if ( isset( $post ) ) {
		if ( 'user' === $scheme || null === $scheme ) {
			$classes[] = 'honor-color-scheme';
		} else if ( 'dark' === $scheme ) {
			$classes[] = 'force-dark-color-scheme';
		}
	}
	return $classes;
}
add_filter( 'body_class', 'uri_modern_color_scheme_body_class' );

/**
 * Add a span around the title prefix so that the prefix can be hidden with CSS
 * if desired.
 * Note that this will only work with LTR languages.
 *
 * @see https://www.binarymoon.co.uk/2017/02/hide-archive-title-prefix-wordpress/
 *
 * @param string $title Archive title.
 * @return string Archive title with inserted span around prefix.
 */
function uri_modern_hide_archive_title( $title ) {
	// Skip if the site isn't LTR, this is visual, not functional.
	// Should try to work out an elegant solution that works for both directions.
	if ( is_rtl() ) {
		return $title;
	}

	// Split the title into parts so we can wrap them with spans.
	$title_parts = explode( ': ', $title, 2 );

	// Given higher ed's propensity for colons in titles, let's be specific with our targeting
	$hide = array( 'Category', 'Tag', 'Archives' );

	// Glue it back together again.
	if ( ! empty( $title_parts[1] ) && in_array( trim( $title_parts[0] ), $hide ) ) {
		$title = wp_kses(
			$title_parts[1],
			array(
				'span' => array(
					'class' => array(),
				),
			)
		);
		$title = '<span class="screen-reader-text">' . esc_html( $title_parts[0] ) . ': </span>' . $title;
	}

	return $title;

}

add_filter( 'get_the_archive_title', 'uri_modern_hide_archive_title' );


/**
 * Adds an image to the rss and atom feeds
 */
function uri_modern_add_image_to_feed() {
	global $post;

	$output = "\n";
	if ( has_post_thumbnail( $post->ID ) ) {
		$id = get_post_thumbnail_id( $post->ID );
		$thumbnail = wp_get_attachment_image_src( $id, 'thumbnail' );
		$type = get_post_mime_type( $id );
		if ( ! empty( $thumbnail ) ) {
			$output .= "\t" . '<media:thumbnail url="' . $thumbnail[0] . '" width="' . $thumbnail[1] . '" height="' . $thumbnail[2] . '" />' . "\n";
		} else {
			$url = get_template_directory_uri() . '/img/default/uri-200.png';
			if ( 'rss2_item' === current_filter() ) {
				$output .= '<enclosure url="' . $url . '" type="image/png" />' . "\n";
			}
			if ( 'atom_entry' === current_filter() ) {
				$output .= '<link rel="enclosure" href="' . $url . '" type="image/png" />' . "\n";
			}
		}
		$original = wp_get_attachment_image_src( $id, null );
		if ( ! empty( $original ) ) {
			$bytes = filesize( get_attached_file( $id ) );
			$output .= "\t" . '<media:content url="' . $original[0] . '" type="' . $type . '" width="' . $original[1] . '" height="' . $original[2] . '" />' . "\n";
			if ( 'rss2_item' === current_filter() ) {
				$output .= "\t" . '<enclosure url="' . $original[0] . '" length="' . $bytes . '" type="' . $type . '" />' . "\n";
			}
			if ( 'atom_entry' === current_filter() ) {
				$output .= "\t" . '<link rel="enclosure" href="' . $original[0] . '" length="' . $bytes . '" type="' . $type . '" />' . "\n";
			}
}
}
	echo $output;
}
add_action( 'rss2_item', 'uri_modern_add_image_to_feed' );
add_action( 'atom_entry', 'uri_modern_add_image_to_feed' );

/**
 * Adds the correct name space for media elements in rss feed
 */
function uri_modern_add_media_namespace() {
  echo "xmlns:media=\"http://search.yahoo.com/mrss/\"\n";
}
add_action( 'rss2_ns', 'uri_modern_add_media_namespace' );
add_action( 'atom_ns', 'uri_modern_add_media_namespace' );
