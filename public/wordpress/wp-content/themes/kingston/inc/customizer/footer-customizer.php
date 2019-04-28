<?php
/**
 * Footer Customizer Options
 *
 * @package kingston
 */

// Add footer section
$wp_customize->add_section( 'kingston_footer_section', array(
	'title'             => esc_html__( 'Footer Section','kingston' ),
	'description'       => esc_html__( 'Footer Setting Options', 'kingston' ),
	'panel'             => 'kingston_theme_options_panel',
) );

// slide to top enable setting and control.
$wp_customize->add_setting( 'kingston_theme_options[slide_to_top]', array(
	'default'           => kingston_theme_option('slide_to_top'),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[slide_to_top]', array(
	'label'             => esc_html__( 'Show Slide to Top', 'kingston' ),
	'section'           => 'kingston_footer_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// copyright text
$wp_customize->add_setting( 'kingston_theme_options[copyright_text]',
	array(
		'default'       		=> kingston_theme_option('copyright_text'),
		'sanitize_callback'		=> 'kingston_santize_allow_tags',
	)
);
$wp_customize->add_control( 'kingston_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'kingston' ),
		'section'    			=> 'kingston_footer_section',
		'type'		 			=> 'textarea',
    )
);

