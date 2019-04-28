<?php
/**
 * Testimonial Customizer Options
 *
 * @package kingston
 */

// Add testimonial section
$wp_customize->add_section( 'kingston_testimonial_section', array(
	'title'             => esc_html__( 'Testimonial Section','kingston' ),
	'description'       => esc_html__( 'Testimonial Setting Options', 'kingston' ),
	'panel'             => 'kingston_homepage_sections_panel',
) );

// testimonial enable setting and control.
$wp_customize->add_setting( 'kingston_theme_options[enable_testimonial]', array(
	'default'           => kingston_theme_option('enable_testimonial'),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[enable_testimonial]', array(
	'label'             => esc_html__( 'Enable Testimonial', 'kingston' ),
	'section'           => 'kingston_testimonial_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// testimonial additional image setting and control.
$wp_customize->add_setting( 'kingston_theme_options[testimonial_image]', array(
	'sanitize_callback' => 'kingston_sanitize_image',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kingston_theme_options[testimonial_image]',
		array(
		'label'       		=> esc_html__( 'Select Background Image', 'kingston' ),
		'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'kingston' ), 1920, 1080 ),
		'section'     		=> 'kingston_testimonial_section',
) ) );

for ( $i = 1; $i <= 3; $i++ ) :

	// testimonial pages drop down chooser control and setting
	$wp_customize->add_setting( 'kingston_theme_options[testimonial_content_page_' . $i . ']', array(
		'sanitize_callback' => 'kingston_sanitize_page_post',
	) );

	$wp_customize->add_control( new Kingston_Dropdown_Chosen_Control( $wp_customize, 'kingston_theme_options[testimonial_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'kingston' ), $i ),
		'section'           => 'kingston_testimonial_section',
		'choices'			=> kingston_page_choices(),
	) ) );	

endfor;
