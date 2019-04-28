<?php
/**
 * Global Customizer Options
 *
 * @package kingston
 */

// Add Global section
$wp_customize->add_section( 'kingston_global_section', array(
	'title'             => esc_html__( 'Global Setting','kingston' ),
	'description'       => esc_html__( 'Global Setting Options', 'kingston' ),
	'panel'             => 'kingston_theme_options_panel',
) );

// header sticky setting and control.
$wp_customize->add_setting( 'kingston_theme_options[enable_sticky_header]', array(
	'default'           => kingston_theme_option( 'enable_sticky_header' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[enable_sticky_header]', array(
	'label'             => esc_html__( 'Make Header Sticky', 'kingston' ),
	'section'           => 'kingston_global_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// breadcrumb setting and control.
$wp_customize->add_setting( 'kingston_theme_options[enable_breadcrumb]', array(
	'default'           => kingston_theme_option( 'enable_breadcrumb' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[enable_breadcrumb]', array(
	'label'             => esc_html__( 'Enable Breadcrumb', 'kingston' ),
	'section'           => 'kingston_global_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// site layout setting and control.
$wp_customize->add_setting( 'kingston_theme_options[site_layout]', array(
	'sanitize_callback'   => 'kingston_sanitize_select',
	'default'             => kingston_theme_option('site_layout'),
) );

$wp_customize->add_control(  new Kingston_Radio_Image_Control ( $wp_customize, 'kingston_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'kingston' ),
	'section'             => 'kingston_global_section',
	'choices'			  => kingston_site_layout(),
) ) );

// loader setting and control.
$wp_customize->add_setting( 'kingston_theme_options[enable_loader]', array(
	'default'           => kingston_theme_option( 'enable_loader' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[enable_loader]', array(
	'label'             => esc_html__( 'Enable Loader', 'kingston' ),
	'section'           => 'kingston_global_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// loader type control and setting
$wp_customize->add_setting( 'kingston_theme_options[loader_type]', array(
	'default'          	=> kingston_theme_option('loader_type'),
	'sanitize_callback' => 'kingston_sanitize_select',
) );

$wp_customize->add_control( 'kingston_theme_options[loader_type]', array(
	'label'             => esc_html__( 'Loader Type', 'kingston' ),
	'section'           => 'kingston_global_section',
	'type'				=> 'select',
	'choices'			=> kingston_get_spinner_list(),
) );
