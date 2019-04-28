<?php
/**
 * Catch Vogue functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Catch Vogue
 */

if ( ! function_exists( 'catch_vogue_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function catch_vogue_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Catch Vogue, use a find and replace
		 * to change 'catch-vogue' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'catch-vogue', get_template_directory() . '/languages' );

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

		// Used in Recent Posts, Featured Content and Portfolio Section
		set_post_thumbnail_size( 596, 447, true ); // Ratio 4:3

		// Used in Slider and Promotion
		add_image_size( 'catch-vogue-slider', 1920, 1080, true ); // Image Ratio 16:9

		// Used in Custom Header for single and archive pages
		add_image_size( 'catch-vogue-header-inner', 1920, 480, true );

		//Used in Hero Content and Skills Section
		add_image_size( 'catch-vogue-hero-content', 600, 600, true ); // Image Ratio 1:1

		// Used in Testimonial Section and Service Section
		add_image_size( 'catch-vogue-testimonial', 150, 150, true ); // Image Ratio 1:1

		// Used in Team and Shop Sections.
		add_image_size( 'catch-vogue-team', 596, 795, true ); //  Image Ratio 3:4

		// Used in Logo Sections.
		add_image_size( 'catch-vogue-logo-slider', 216, 108, true ); //  Image Ratio 16:8

		// Used in Why Choose Us Sections.
		add_image_size( 'catch-vogue-why-choose-us', 75, 75, true ); //  Image Ratio 16:8

		// Used in Blog.
		add_image_size( 'catch-vogue-blog', 940, 528, true ); //  Image Ratio 16:9

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'        => esc_html__( 'Primary', 'catch-vogue' ),
			'social-footer' => esc_html__( 'Social On Footer', 'catch-vogue' ),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'catch-vogue' ),
					'shortName' => esc_html__( 'S', 'catch-vogue' ),
					'size'      => 14,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'catch-vogue' ),
					'shortName' => esc_html__( 'M', 'catch-vogue' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'catch-vogue' ),
					'shortName' => esc_html__( 'L', 'catch-vogue' ),
					'size'      => 35,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'catch-vogue' ),
					'shortName' => esc_html__( 'XL', 'catch-vogue' ),
					'size'      => 42,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'catch-vogue' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Black', 'catch-vogue' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => esc_html__( 'Medium Black', 'catch-vogue' ),
				'slug'  => 'medium-black',
				'color' => '#333333',
			),
			array(
				'name'  => esc_html__( 'Gray', 'catch-vogue' ),
				'slug'  => 'gray',
				'color' => '#999999',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'catch-vogue' ),
				'slug'  => 'light-gray',
				'color' => '#fafafa',
			),
			array(
				'name'  => esc_html__( 'Yellow', 'catch-vogue' ),
				'slug'  => 'yellow',
				'color' => '#ffa415',
			),
		) );

		add_editor_style( array( 'assets/css/editor-style.css', catch_vogue_fonts_url() ) );

		// Support Alternate image for services, testimonials when using Essential Content Types Pro.
		if ( class_exists( 'Essential_Content_Types_Pro' ) ) {
			add_theme_support( 'ect-alt-featured-image-jetpack-testimonial' );
		}

		/**
		 * Add Support for Sticky Menu.
		 */
		add_theme_support( 'catch-sticky-menu', apply_filters( 'catch_wedding_sticky_menu_args', array(
			'sticky_desktop_menu_selector' => '#masthead',
			'sticky_mobile_menu_selector'  => '#masthead',
			'sticky_background_color'      => '#ffffff',
			'sticky_text_color'            => '#000000',
		) ) );
	}
endif;
add_action( 'after_setup_theme', 'catch_vogue_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function catch_vogue_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'catch_vogue_content_width', 1040 );
}
add_action( 'after_setup_theme', 'catch_vogue_content_width', 0 );

if ( ! function_exists( 'catch_vogue_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function catch_vogue_template_redirect() {
		$layout = catch_vogue_get_theme_layout();

		if ( 'no-sidebar-full-width' === $layout ) {
			$GLOBALS['content_width'] = 1520;
		}
	}
endif;
add_action( 'template_redirect', 'catch_vogue_template_redirect' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function catch_vogue_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'catch-vogue' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'catch-vogue' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'catch-vogue' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'catch-vogue' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'catch-vogue' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'catch-vogue' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'catch-vogue' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'catch-vogue' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Optional Sidebar Five Footer Instagram
	if ( class_exists( 'Catch_Instagram_Feed_Gallery_Widget' ) ||  class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Instagram', 'catch-vogue' ),
			'id'            => 'sidebar-instagram',
			'description'   => esc_html__( 'Appears above footer. This sidebar is only for Widget from plugin Catch Instagram Feed Gallery Widget and Catch Instagram Feed Gallery Widget Pro', 'catch-vogue' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<div class="section-title-wrapper"><h2 class="section-title">',
			'after_title'   => '</h2></div>',
		) );
	}
}
add_action( 'widgets_init', 'catch_vogue_widgets_init' );

if ( ! function_exists( 'catch_vogue_fonts_url' ) ) :
	/**
	 * Register Google fonts for Verity Pro.
	 *
	 * Create your own catch_vogue_fonts_url() function to override in a child theme.
	 *
	 * @since Catch Vogue 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function catch_vogue_fonts_url() {
		$fonts_url = '';
		
		/* Translators: If there are characters in your language that are not
		* supported by Montserrat, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$merriweather = _x( 'on', 'Merriweather: on or off', 'catch-vogue' );

		/* Translators: If there are characters in your language that are not
		* supported by Pt Serif, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$playfair_display = _x( 'on', 'Playfair Display: on or off', 'catch-vogue' );

		/* Translators: If there are characters in your language that are not
		* supported by Pt Serif, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$oswald = _x( 'on', 'Oswald: on or off', 'catch-vogue' );

			if ( 'off' !== $merriweather || 'off' !== $playfair_display  || 'off' !== $oswald ) {
			$font_families = array();

			if ( 'off' !== $merriweather ) {
				$font_families[] = 'Merriweather:300,400,500,700,900';
			}

			if ( 'off' !== $playfair_display ) {
				$font_families[] = 'Playfair Display:300,400,500,700,900';
			}

			if ( 'off' !== $oswald ) {
				$font_families[] = 'Oswald:300,400,500,700,900';
			}
			
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Add preconnect for Google Fonts.
 */
function catch_vogue_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'catch-vogue-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'catch_vogue_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function catch_vogue_scripts() {
	wp_enqueue_style( 'catch-vogue-fonts', catch_vogue_fonts_url(), array(), null );

	wp_enqueue_style( 'font-awesome', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/css/font-awesome/css/font-awesome.css', array(), '4.7.0', 'all' );

	// Theme stylesheet.
	wp_enqueue_style( 'catch-vogue-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'catch-vogue-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'catch-vogue-style' ), '1.0' );

	wp_register_script( 'jquery-match-height', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.matchHeight.min.js', array( 'jquery' ), '20171226', true );

	wp_enqueue_script( 'catch-vogue-custom-script', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/custom-scripts.min.js', array( 'jquery', 'jquery-match-height' ), '20171226', true );

	wp_localize_script( 'catch-vogue-custom-script', 'catchVogueScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'catch-vogue' ),
		'collapse' => esc_html__( 'collapse child menu', 'catch-vogue' ),
	) );

	wp_enqueue_script( 'catch-vogue-navigation', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/navigation.min.js', array(), '20171226', true );

	wp_enqueue_script( 'catch-vogue-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/skip-link-focus-fix.min.js', array(), '20171226', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Slider Scripts
	$enable_slider       = catch_vogue_check_section( get_theme_mod( 'catch_vogue_slider_option', 'disabled' ) );
	$enable_testimonial  = catch_vogue_check_section( get_theme_mod( 'catch_vogue_testimonial_option', 'disabled' ) );
	$enable_logo         = catch_vogue_check_section( get_theme_mod( 'catch_vogue_logo_slider_option', 'disabled' ) );

	if ( $enable_slider || $enable_testimonial || $enable_logo ) {
		wp_enqueue_script( 'jquery-cycle2', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		$transition_effects = array(
			get_theme_mod( 'catch_vogue_slider_transition_effect', 'fade' ),
		);

		// Carousel transition plugin addition.
		if ( $enable_logo ) {
			wp_enqueue_script( 'jquery-cycle2-carousel', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.cycle/jquery.cycle2.carousel.min.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'catch_vogue_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function catch_vogue_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'catch-vogue-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/css/editor-blocks.css' );
	// Add custom fonts.
	wp_enqueue_style( 'catch-vogue-fonts', catch_vogue_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'catch_vogue_block_editor_styles' );

if ( ! function_exists( 'catch_vogue_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Catch Vogue 1.0
	 */
	function catch_vogue_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$length	= get_theme_mod( 'catch_vogue_excerpt_length', 10 );
		return absint( $length );
	}
endif; //catch_vogue_excerpt_length
add_filter( 'excerpt_length', 'catch_vogue_excerpt_length', 999 );

if ( ! function_exists( 'catch_vogue_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer.
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function catch_vogue_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text	= get_theme_mod( 'catch_vogue_excerpt_more_text',  esc_html__( 'Continue reading', 'catch-vogue' ) );

		$link = sprintf( '<span class="more-button"><a href="%1$s" class="more-link">%2$s</a></span>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

		return $link;
	}
endif;
add_filter( 'excerpt_more', 'catch_vogue_excerpt_more' );


if ( ! function_exists( 'catch_vogue_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Catch Vogue 1.0
	 */
	function catch_vogue_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = get_theme_mod( 'catch_vogue_excerpt_more_text', esc_html__( 'Continue reading', 'catch-vogue' ) );

			$link = sprintf( '<span class="more-button"><a href="%1$s" class="more-link">%2$s</a></span>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

			$link = ' &hellip; ' . $link;

			$output .= $link;
		}

		return $output;
	}
endif; //catch_vogue_custom_excerpt
add_filter( 'get_the_excerpt', 'catch_vogue_custom_excerpt' );


if ( ! function_exists( 'catch_vogue_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Catch Vogue 1.0
	 */
	function catch_vogue_more_link( $more_link, $more_link_text ) {
		$more_tag_text = get_theme_mod( 'catch_vogue_excerpt_more_text', esc_html__( 'Continue reading', 'catch-vogue' ) );

		return ' &hellip; ' . str_replace( $more_link_text, $more_tag_text, $more_link );
	}
endif; //catch_vogue_more_link
add_filter( 'the_content_more_link', 'catch_vogue_more_link', 10, 2 );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Catch Vogue 1.0
 */
function catch_vogue_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . $class . '"'; // WPCS: XSS OK.
	}
}

/**
 * Implement the Custom Header feature
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Include Header Background Color Options
 */
require get_parent_theme_file_path( 'inc/header-background-color.php' );

/**
 * Custom template tags for this theme
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Add theme admin page.
 */
if ( is_admin() ) {
	require get_parent_theme_file_path( 'inc/about.php' );
}

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Featured Slider
 */
require get_parent_theme_file_path( '/inc/featured-slider.php' );

/**
 * Metabox Options
 */
require get_parent_theme_file_path( '/inc/metabox/metabox.php' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Load Social Widget
 */
require get_parent_theme_file_path( '/inc/widget-social-icons.php' );

/**
 * Load TGMPA
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

/**
 * Include Demo Importer
 */
require get_parent_theme_file_path( '/inc/demo-importer.php' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function catch_vogue_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// Catch Web Tools.
		array(
			'name' => 'Catch Web Tools', // Plugin Name, translation not required.
			'slug' => 'catch-web-tools',
		),
		// Catch IDs
		array(
			'name' => 'Catch IDs', // Plugin Name, translation not required.
			'slug' => 'catch-ids',
		),
		// To Top.
		array(
			'name' => 'To top', // Plugin Name, translation not required.
			'slug' => 'to-top',
		),
		// Catch Gallery.
		array(
			'name' => 'Catch Gallery', // Plugin Name, translation not required.
			'slug' => 'catch-gallery',
		),
	);

	if ( ! class_exists( 'Catch_Infinite_Scroll_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Infinite Scroll', // Plugin Name, translation not required.
			'slug' => 'catch-infinite-scroll',
		);
	}

	if ( ! class_exists( 'Essential_Content_Types_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Content Types', // Plugin Name, translation not required.
			'slug' => 'essential-content-types',
		);
	}

	if ( ! class_exists( 'Essential_Widgets_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Widgets', // Plugin Name, translation not required.
			'slug' => 'essential-widgets',
		);
	}

	if ( ! class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Instagram Feed Gallery & Widget', // Plugin Name, translation not required.
			'slug' => 'catch-instagram-feed-gallery-widget',
		);
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'catch-vogue',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'catch_vogue_register_required_plugins' );

/**
 * Checks if there are options already present in free version and adds it to the Pro version
 *
 * @since Catch Vogue 1.0
 * @hook after_theme_switch
 */
function catch_vogue_setup_options( $old_theme_name ) {
	if ( $old_theme_name ) {
		$old_theme_slug = sanitize_title( $old_theme_name );

		$free_version_slug = 'catch-vogue';
		$pro_version_slug  = 'catch-vogue';

		$free_options = get_option( 'theme_mods_' . $old_theme_slug );

		// Perform action only if options of free version exists and theme is being switched from free version
		if ( $free_version_slug === $old_theme_slug && $free_options && '1' !== get_theme_mod( 'free_pro_migration' ) ) {
			$new_options = wp_parse_args( get_theme_mods(), $free_options );

			if ( update_option( 'theme_mods_' . $pro_version_slug, $free_options ) ) {
				// Set Migration Parameter to true so that this script does not run multiple times.
				set_theme_mod( 'free_pro_migration', '1' );
			}
		}
	}
}
add_action( 'after_switch_theme', 'catch_vogue_setup_options', 100 );
