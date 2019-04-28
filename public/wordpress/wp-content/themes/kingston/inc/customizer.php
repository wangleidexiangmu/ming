<?php
/**
 * Kingston Theme Customizer
 *
 * @package kingston
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kingston_customize_register( $wp_customize ) {
	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/controls.php';

	// Load callback functions.
	require get_template_directory() . '/inc/customizer/callbacks.php';

	// Load validation functions.
	require get_template_directory() . '/inc/customizer/validate.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'kingston_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'kingston_customize_partial_blogdescription',
		) );
	}

	// Register custom section types.
	$wp_customize->register_section_type( 'Kingston_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Kingston_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Kingston Pro', 'kingston' ),
				'pro_text' => esc_html__( 'Buy Pro', 'kingston' ),
				'pro_url'  => 'http://www.sharkthemes.com/downloads/kingston-pro/',
				'priority'  => 10,
			)
		)
	);

	// Add panel for common Home Page Settings
	$wp_customize->add_panel( 'kingston_homepage_sections_panel' , array(
	    'title'      => esc_html__( 'Homepage Sections','kingston' ),
	    'description'=> esc_html__( 'Kingston Homepage Sections.', 'kingston' ),
	    'priority'   => 100,
	) );

	// slider settings
	require get_template_directory() . '/inc/customizer/homepage-sections/slider-customizer.php';

	// introduction settings
	require get_template_directory() . '/inc/customizer/homepage-sections/introduction-customizer.php';
	
	// service settings
	require get_template_directory() . '/inc/customizer/homepage-sections/service-customizer.php';

	// portfolio settings
	require get_template_directory() . '/inc/customizer/homepage-sections/portfolio-customizer.php';

	// testimonial settings
	require get_template_directory() . '/inc/customizer/homepage-sections/testimonial-customizer.php';

	// recent settings
	require get_template_directory() . '/inc/customizer/homepage-sections/recent-customizer.php';

	// Add panel for common Home Page Settings
	$wp_customize->add_panel( 'kingston_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','kingston' ),
	    'description'=> esc_html__( 'Kingston Theme Options.', 'kingston' ),
	    'priority'   => 100,
	) );

	// footer settings
	require get_template_directory() . '/inc/customizer/footer-customizer.php';
	
	// blog/archive settings
	require get_template_directory() . '/inc/customizer/blog-customizer.php';

	// single settings
	require get_template_directory() . '/inc/customizer/single-customizer.php';

	// page settings
	require get_template_directory() . '/inc/customizer/page-customizer.php';

	// global settings
	require get_template_directory() . '/inc/customizer/global-customizer.php';

}
add_action( 'customize_register', 'kingston_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function kingston_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function kingston_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kingston_customize_preview_js() {
	wp_enqueue_script( 'kingston-customizer', get_template_directory_uri() . '/assets/js/customizer' . kingston_min() . '.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'kingston_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function kingston_customize_control_js() {
	// Choose from select jquery.
	wp_enqueue_style( 'jquery-chosen', get_template_directory_uri() . '/assets/css/chosen' . kingston_min() . '.css' );
	wp_enqueue_script( 'jquery-chosen', get_template_directory_uri() . '/assets/js/chosen' . kingston_min() . '.js', array( 'jquery' ), '1.4.2', true );

	// Choose fontawesome select jquery.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome' . kingston_min() . '.css' );
	wp_enqueue_style( 'simple-iconpicker', get_template_directory_uri() . '/assets/css/simple-iconpicker' . kingston_min() . '.css' );
	wp_enqueue_script( 'jquery-simple-iconpicker', get_template_directory_uri() . '/assets/js/simple-iconpicker' . kingston_min() . '.js', array( 'jquery' ), '', true );

	// admin script
	wp_enqueue_style( 'kingston-customizer-style', get_template_directory_uri() . '/assets/css/customizer' . kingston_min() . '.css' );
	wp_enqueue_script( 'kingston-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls' . kingston_min() . '.js', array( 'jquery', 'jquery-chosen', 'jquery-simple-iconpicker' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'kingston_customize_control_js' );
