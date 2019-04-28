<?php
/**
 * Single Post Customizer Options
 *
 * @package kingston
 */

// Add excerpt section
$wp_customize->add_section( 'kingston_single_section', array(
	'title'             => esc_html__( 'Single Post Setting','kingston' ),
	'description'       => esc_html__( 'Single Post Setting Options', 'kingston' ),
	'panel'             => 'kingston_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'kingston_theme_options[sidebar_single_layout]', array(
	'sanitize_callback'   => 'kingston_sanitize_select',
	'default'             => kingston_theme_option('sidebar_single_layout'),
) );

$wp_customize->add_control(  new Kingston_Radio_Image_Control ( $wp_customize, 'kingston_theme_options[sidebar_single_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'kingston' ),
	'section'             => 'kingston_single_section',
	'choices'			  => kingston_sidebar_position(),
) ) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'kingston_theme_options[show_single_date]', array(
	'default'           => kingston_theme_option( 'show_single_date' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[show_single_date]', array(
	'label'             => esc_html__( 'Show Date', 'kingston' ),
	'section'           => 'kingston_single_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'kingston_theme_options[show_single_category]', array(
	'default'           => kingston_theme_option( 'show_single_category' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[show_single_category]', array(
	'label'             => esc_html__( 'Show Category', 'kingston' ),
	'section'           => 'kingston_single_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'kingston_theme_options[show_single_tags]', array(
	'default'           => kingston_theme_option( 'show_single_tags' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[show_single_tags]', array(
	'label'             => esc_html__( 'Show Tags', 'kingston' ),
	'section'           => 'kingston_single_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'kingston_theme_options[show_single_author]', array(
	'default'           => kingston_theme_option( 'show_single_author' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[show_single_author]', array(
	'label'             => esc_html__( 'Show Author', 'kingston' ),
	'section'           => 'kingston_single_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );
