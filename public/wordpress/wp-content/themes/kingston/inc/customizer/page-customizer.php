<?php
/**
 * Page Customizer Options
 *
 * @package kingston
 */

// Add excerpt section
$wp_customize->add_section( 'kingston_page_section', array(
	'title'             => esc_html__( 'Page Setting','kingston' ),
	'description'       => esc_html__( 'Page Setting Options', 'kingston' ),
	'panel'             => 'kingston_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'kingston_theme_options[sidebar_page_layout]', array(
	'sanitize_callback'   => 'kingston_sanitize_select',
	'default'             => kingston_theme_option('sidebar_page_layout'),
) );

$wp_customize->add_control(  new Kingston_Radio_Image_Control ( $wp_customize, 'kingston_theme_options[sidebar_page_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'kingston' ),
	'section'             => 'kingston_page_section',
	'choices'			  => kingston_sidebar_position(),
) ) );
