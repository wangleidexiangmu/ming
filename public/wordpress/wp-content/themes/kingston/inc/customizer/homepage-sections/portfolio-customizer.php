<?php
/**
 * Portfolio Customizer Options
 *
 * @package kingston
 */

// Add portfolio section
$wp_customize->add_section( 'kingston_portfolio_section', array(
	'title'             => esc_html__( 'Portfolio Section','kingston' ),
	'description'       => esc_html__( 'Portfolio Setting Options', 'kingston' ),
	'panel'             => 'kingston_homepage_sections_panel',
) );

// portfolio menu enable setting and control.
$wp_customize->add_setting( 'kingston_theme_options[enable_portfolio]', array(
	'default'           => kingston_theme_option('enable_portfolio'),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[enable_portfolio]', array(
	'label'             => esc_html__( 'Enable Portfolio', 'kingston' ),
	'section'           => 'kingston_portfolio_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// portfolio label chooser control and setting
$wp_customize->add_setting( 'kingston_theme_options[portfolio_title]', array(
	'default'          	=> kingston_theme_option('portfolio_title'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kingston_theme_options[portfolio_title]', array(
	'label'             => esc_html__( 'Title', 'kingston' ),
	'section'           => 'kingston_portfolio_section',
	'type'				=> 'text',
) );

// portfolio button label chooser control and setting
$wp_customize->add_setting( 'kingston_theme_options[portfolio_btn_label]', array(
	'default'          	=> kingston_theme_option('portfolio_btn_label'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kingston_theme_options[portfolio_btn_label]', array(
	'label'             => esc_html__( 'Button Label', 'kingston' ),
	'section'           => 'kingston_portfolio_section',
	'type'				=> 'text',
) );

// portfolio pages drop down chooser control and setting
$wp_customize->add_setting( 'kingston_theme_options[portfolio_content_category]', array(
	'sanitize_callback' => 'kingston_sanitize_category',
) );

$wp_customize->add_control( new Kingston_Dropdown_Chosen_Control( $wp_customize, 'kingston_theme_options[portfolio_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'kingston' ),
	'description'       => esc_html__( 'Note: Latest six posts will be shown from the selected category.', 'kingston' ),
	'section'           => 'kingston_portfolio_section',
	'choices'			=> kingston_category_choices(),
) ) );
