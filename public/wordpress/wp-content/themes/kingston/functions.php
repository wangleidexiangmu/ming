<?php
/**
 * Kingston functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kingston
 */

if ( ! function_exists( 'kingston_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kingston_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Kingston, use a find and replace
		 * to change 'kingston' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kingston', get_template_directory() . '/languages' );

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
		set_post_thumbnail_size( 600, 450, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> esc_html__( 'Primary Menu', 'kingston' ),
			'footer' 	=> esc_html__( 'Footer Menu', 'kingston' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'kingston_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for page excerpt.
		add_post_type_support( 'page', 'excerpt' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 400,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Load Footer Widget Support.
		require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/footer-widget.php' );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
	           	'name' => esc_html__( 'Dark Blue', 'kingston' ),
	           	'slug' => 'dark-blue',
	           	'color' => '#171a1f',
	       	),
	       	array(
	           	'name' => esc_html__( 'Orange', 'kingston' ),
	           	'slug' => 'orange',
	           	'color' => '#ed6510',
	       	),
	       	array(
	           	'name' => esc_html__( 'Gray', 'kingston' ),
	           	'slug' => 'gray',
	           	'color' => '#484848',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'kingston' ),
		       	'shortName' => esc_html__( 'S', 'kingston' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'kingston' ),
		       	'shortName' => esc_html__( 'M', 'kingston' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'large', 'kingston' ),
		       	'shortName' => esc_html__( 'L', 'kingston' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'extra large', 'kingston' ),
		       	'shortName' => esc_html__( 'XL', 'kingston' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'kingston_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kingston_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kingston_content_width', 819 );
}
add_action( 'after_setup_theme', 'kingston_content_width', 0 );

if ( ! function_exists( 'kingston_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function kingston_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'kingston' ) ) {
		$fonts[] = 'Poppins:200,300,400,500,600,700';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @since Kingston 1.0.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function kingston_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'kingston-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'kingston_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kingston_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'kingston' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'kingston' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Optional Sidebar', 'kingston' ),
		'id'            => 'optional-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'kingston' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'kingston_widgets_init' );

/**
 * Function to detect SCRIPT_DEBUG on and off.
 * @return string If on, empty else return .min string.
 */
function kingston_min() {
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
}

/**
 * Enqueue scripts and styles.
 */
function kingston_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'kingston-fonts', kingston_fonts_url(), array(), null );

	// slick
	wp_enqueue_style( 'jquery-slick', get_template_directory_uri() . '/assets/css/slick' . kingston_min() . '.css' );

	// slick theme
	wp_enqueue_style( 'jquery-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme' . kingston_min() . '.css' );

	// font awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome' . kingston_min() . '.css' );

	// blocks
	wp_enqueue_style( 'kingston-blocks', get_template_directory_uri() . '/assets/css/blocks' . kingston_min() . '.css' );

	wp_enqueue_style( 'kingston-style', get_stylesheet_uri() );

	if ( ! in_array( kingston_theme_option( 'theme_color', 'default' ), array( 'default', 'custom' ) ) ) :
		wp_enqueue_style( 'kingston-colors', get_template_directory_uri() . '/assets/css/' . kingston_theme_option( 'theme_color', 'red' )  . kingston_min() . '.css', array( 'kingston-style' ), '1.0' );
	endif;

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/assets/js/html5' . kingston_min() . '.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'kingston-navigation', get_template_directory_uri() . '/assets/js/navigation' . kingston_min() . '.js', array(), '20151215', true );

	$kingston_l10n = array(
		'quote'          => kingston_get_svg( array( 'icon' => 'quote-right' ) ),
		'expand'         => esc_html__( 'Expand child menu', 'kingston' ),
		'collapse'       => esc_html__( 'Collapse child menu', 'kingston' ),
		'icon'           => kingston_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) ),
	);
	wp_localize_script( 'kingston-navigation', 'kingston_l10n', $kingston_l10n );

	wp_enqueue_script( 'kingston-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . kingston_min() . '.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick' . kingston_min() . '.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'kingston-custom', get_template_directory_uri() . '/assets/js/custom' . kingston_min() . '.js', array( 'jquery' ), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'kingston_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function kingston_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'kingston-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks' . kingston_min() . '.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'kingston-fonts', kingston_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'kingston_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
* TGM plugin additions.
*/
require get_template_directory() . '/inc/tgm-plugin/tgm-hook.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * WooCommerce plugin compatibility.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * OCDI plugin demo importer compatibility.
 */
if ( class_exists( 'OCDI_Plugin' ) ) {
    require get_template_directory() . '/inc/demo-import.php';
}
