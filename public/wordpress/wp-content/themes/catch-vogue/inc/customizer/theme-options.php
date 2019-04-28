<?php
/**
 * Theme Options
 *
 * @package Catch Vogue
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_vogue_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'catch_vogue_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'catch-vogue' ),
		'priority' => 130,
	) );

	// Layout Options
	$wp_customize->add_section( 'catch_vogue_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'catch-vogue' ),
		'panel' => 'catch_vogue_theme_options',
		)
	);

	/* Default Layout */
	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'catch-vogue' ),
			'section'           => 'catch_vogue_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-vogue' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'catch-vogue' ),
			),
		)
	);

	/* Homepage Layout */
	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_homepage_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'label'             => esc_html__( 'Homepage Layout', 'catch-vogue' ),
			'section'           => 'catch_vogue_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-vogue' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'catch-vogue' ),
			),
		)
	);

	/* Blog/Archive Layout */
	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_archive_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'label'             => esc_html__( 'Blog/Archive Layout', 'catch-vogue' ),
			'section'           => 'catch_vogue_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'catch-vogue' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'catch-vogue' ),
			),
		)
	);

	// Single Page/Post Image
	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'catch-vogue' ),
			'section'           => 'catch_vogue_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'disabled'            => esc_html__( 'Disabled', 'catch-vogue' ),
				'post-thumbnail'      => esc_html__( 'Post Thumbnail (1060x596)', 'catch-vogue' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'catch_vogue_excerpt_options', array(
		'panel' => 'catch_vogue_theme_options',
		'title' => esc_html__( 'Excerpt Options', 'catch-vogue' ),
	) );

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_excerpt_length',
			'default'           => '10',
			'sanitize_callback' => 'absint',
			'description' => esc_html__( 'Excerpt length. Default is 55 words', 'catch-vogue' ),
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'catch-vogue' ),
			'section'  => 'catch_vogue_excerpt_options',
			'type'     => 'number',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading', 'catch-vogue' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'catch-vogue' ),
			'section'           => 'catch_vogue_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'catch_vogue_search_options', array(
		'panel'     => 'catch_vogue_theme_options',
		'title'     => esc_html__( 'Search Options', 'catch-vogue' ),
	) );

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_search_text',
			'default'           => esc_html__( 'Search ...', 'catch-vogue' ),
			'sanitize_callback' => 'wp_kses_data',
			'label'             => esc_html__( 'Search Text', 'catch-vogue' ),
			'section'           => 'catch_vogue_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'catch_vogue_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'catch-vogue' ),
		'panel'       => 'catch_vogue_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'catch-vogue' ),
	) );

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_front_page_category',
			'sanitize_callback' => 'catch_vogue_sanitize_category_list',
			'custom_control'    => 'Catch_Vogue_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'catch-vogue' ),
			'section'           => 'catch_vogue_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	$wp_customize->add_section( 'catch_vogue_menu_options', array(
		'panel'       => 'catch_vogue_theme_options',
		'title'       => esc_html__( 'Menu Options', 'catch-vogue' ),
	) );

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_primary_subtitle_popup_disable',
			'default'			=> 1,
			'sanitize_callback' => 'catch_vogue_sanitize_checkbox',
			'label'             => esc_html__( 'Show Submenu below Parent menu(Disable submenu hover popup)', 'catch-vogue' ),
			'section'           => 'catch_vogue_menu_options',
			'custom_control'    => 'Catch_Vogue_Toggle_Control',
		)
	);

	// Pagination Options.
	$wp_customize->add_section( 'catch_vogue_pagination_options', array(
		'panel'       => 'catch_vogue_theme_options',
		'title'       => esc_html__( 'Pagination Options', 'catch-vogue' ),
	) );

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'choices'           => catch_vogue_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'catch-vogue' ),
			'section'           => 'catch_vogue_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'catch_vogue_scrollup', array(
		'panel'    => 'catch_vogue_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'catch-vogue' ),
	) );

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_display_scrollup',
			'sanitize_callback' => 'catch_vogue_sanitize_checkbox',
			'default'           => 1,
			'label'             => esc_html__( 'Display Scroll Up', 'catch-vogue' ),
			'section'           => 'catch_vogue_scrollup',
			'custom_control'    => 'Catch_Vogue_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_vogue_theme_options' );
