<?php
/**
 * Slider Customizer Options
 *
 * @package kingston
 */

// Add slider section
$wp_customize->add_section( 'kingston_slider_section', array(
	'title'             => esc_html__( 'Slider Section','kingston' ),
	'description'       => esc_html__( 'Slider Setting Options', 'kingston' ),
	'panel'             => 'kingston_homepage_sections_panel',
) );

// slider menu enable setting and control.
$wp_customize->add_setting( 'kingston_theme_options[enable_slider]', array(
	'default'           => kingston_theme_option('enable_slider'),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[enable_slider]', array(
	'label'             => esc_html__( 'Enable Slider', 'kingston' ),
	'section'           => 'kingston_slider_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// slider btn label chooser control and setting
$wp_customize->add_setting( 'kingston_theme_options[slider_btn_label]', array(
	'default'          	=> kingston_theme_option('slider_btn_label'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'kingston_theme_options[slider_btn_label]', array(
	'label'             => esc_html__( 'Button Label', 'kingston' ),
	'section'           => 'kingston_slider_section',
	'type'				=> 'text',
) );


for ( $i = 1; $i <= 5; $i++ ) :

	// slider pages drop down chooser control and setting
	$wp_customize->add_setting( 'kingston_theme_options[slider_content_page_' . $i . ']', array(
		'sanitize_callback' => 'kingston_sanitize_page_post',
	) );

	$wp_customize->add_control( new Kingston_Dropdown_Chosen_Control( $wp_customize, 'kingston_theme_options[slider_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'kingston' ), $i ),
		'section'           => 'kingston_slider_section',
		'choices'			=> kingston_page_choices(),
	) ) );

endfor;
