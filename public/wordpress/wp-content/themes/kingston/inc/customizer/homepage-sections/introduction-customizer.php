<?php
/**
 * Introduction Customizer Options
 *
 * @package kingston
 */

// Add introduction section
$wp_customize->add_section( 'kingston_introduction_section', array(
	'title'             => esc_html__( 'Introduction Section','kingston' ),
	'description'       => esc_html__( 'Introduction Setting Options', 'kingston' ),
	'panel'             => 'kingston_homepage_sections_panel',
) );

// introduction menu enable setting and control.
$wp_customize->add_setting( 'kingston_theme_options[enable_introduction]', array(
	'default'           => kingston_theme_option('enable_introduction'),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[enable_introduction]', array(
	'label'             => esc_html__( 'Enable Introduction', 'kingston' ),
	'section'           => 'kingston_introduction_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// introduction pages drop down chooser control and setting
$wp_customize->add_setting( 'kingston_theme_options[introduction_content_page]', array(
	'sanitize_callback' => 'kingston_sanitize_page_post',
) );

$wp_customize->add_control( new Kingston_Dropdown_Chosen_Control( $wp_customize, 'kingston_theme_options[introduction_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'kingston' ),
	'section'           => 'kingston_introduction_section',
	'choices'			=> kingston_page_choices(),
) ) );

// introduction btn label chooser control and setting
$wp_customize->add_setting( 'kingston_theme_options[introduction_btn_label]', array(
	'default'          	=> kingston_theme_option('introduction_btn_label'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kingston_theme_options[introduction_btn_label]', array(
	'label'             => esc_html__( 'Button Label', 'kingston' ),
	'section'           => 'kingston_introduction_section',
	'type'				=> 'text',
) );
