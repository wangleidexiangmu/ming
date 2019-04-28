<?php
/**
 * Recent Customizer Options
 *
 * @package kingston
 */

// Add recent section
$wp_customize->add_section( 'kingston_recent_section', array(
	'title'             => esc_html__( 'Recent Section','kingston' ),
	'description'       => esc_html__( 'Note: Four latest posts will be shown.', 'kingston' ),
	'panel'             => 'kingston_homepage_sections_panel',
) );

// recent enable setting and control.
$wp_customize->add_setting( 'kingston_theme_options[enable_recent]', array(
	'default'           => kingston_theme_option('enable_recent'),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[enable_recent]', array(
	'label'             => esc_html__( 'Enable Recent', 'kingston' ),
	'section'           => 'kingston_recent_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// recent title chooser control and setting
$wp_customize->add_setting( 'kingston_theme_options[recent_title]', array(
	'default'          	=> kingston_theme_option('recent_title'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kingston_theme_options[recent_title]', array(
	'label'             => esc_html__( 'Title', 'kingston' ),
	'section'           => 'kingston_recent_section',
	'type'				=> 'text',
) );
