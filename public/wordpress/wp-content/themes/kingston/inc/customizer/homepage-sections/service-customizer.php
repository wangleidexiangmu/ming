<?php
/**
 * Service Customizer Options
 *
 * @package kingston
 */

// Add service section
$wp_customize->add_section( 'kingston_service_section', array(
	'title'             => esc_html__( 'Service Section','kingston' ),
	'description'       => esc_html__( 'Service Setting Options', 'kingston' ),
	'panel'             => 'kingston_homepage_sections_panel',
) );

// service menu enable setting and control.
$wp_customize->add_setting( 'kingston_theme_options[enable_service]', array(
	'default'           => kingston_theme_option('enable_service'),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[enable_service]', array(
	'label'             => esc_html__( 'Enable Service', 'kingston' ),
	'section'           => 'kingston_service_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// service label chooser control and setting
$wp_customize->add_setting( 'kingston_theme_options[service_title]', array(
	'default'          	=> kingston_theme_option('service_title'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kingston_theme_options[service_title]', array(
	'label'             => esc_html__( 'Title', 'kingston' ),
	'section'           => 'kingston_service_section',
	'type'				=> 'text',
) );

for ( $i = 1; $i <= 3; $i++ ) :

	// service menu enable setting and control.
	$wp_customize->add_setting( 'kingston_theme_options[service_icon_' . $i . ']', array(
		// 'default'           => kingston_theme_option('service_icon_' . $i . ''),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Kingston_Icon_Picker_Control( $wp_customize, 'kingston_theme_options[service_icon_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Icon %d', 'kingston' ), $i ),
		'section'           => 'kingston_service_section',
		'type' 				=> 'icon_picker',
	) ) );

	// service pages drop down chooser control and setting
	$wp_customize->add_setting( 'kingston_theme_options[service_content_page_' . $i . ']', array(
		'sanitize_callback' => 'kingston_sanitize_page_post',
	) );

	$wp_customize->add_control( new Kingston_Dropdown_Chosen_Control( $wp_customize, 'kingston_theme_options[service_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'kingston' ), $i ),
		'section'           => 'kingston_service_section',
		'choices'			=> kingston_page_choices(),
	) ) );

	// service hr control and setting
	$wp_customize->add_setting( 'kingston_theme_options[service_custom_hr_' . $i . ']', array(
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( new Kingston_Horizontal_Line( $wp_customize, 'kingston_theme_options[service_custom_hr_' . $i . ']', array(
		'section'           => 'kingston_service_section',
	) ) );

endfor;
