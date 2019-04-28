<?php
/**
 * Blog / Archive / Search Customizer Options
 *
 * @package kingston
 */

// Add blog section
$wp_customize->add_section( 'kingston_blog_section', array(
	'title'             => esc_html__( 'Blog/Archive Page Setting','kingston' ),
	'description'       => esc_html__( 'Blog/Archive/Search Page Setting Options', 'kingston' ),
	'panel'             => 'kingston_theme_options_panel',
) );

// latest blog title drop down chooser control and setting
$wp_customize->add_setting( 'kingston_theme_options[latest_blog_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> kingston_theme_option( 'latest_blog_title' ),
) );

$wp_customize->add_control( new Kingston_Dropdown_Chosen_Control( $wp_customize, 'kingston_theme_options[latest_blog_title]', array(
	'label'             => esc_html__( 'Latest Blog Title', 'kingston' ),
	'description'       => esc_html__( 'Note: This title is displayed when your homepage displays option is set to latest posts.', 'kingston' ),
	'section'           => 'kingston_blog_section',
	'type'				=> 'text',
) ) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'kingston_theme_options[sidebar_layout]', array(
	'sanitize_callback'   => 'kingston_sanitize_select',
	'default'             => kingston_theme_option( 'sidebar_layout' ),
) );

$wp_customize->add_control(  new Kingston_Radio_Image_Control ( $wp_customize, 'kingston_theme_options[sidebar_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'kingston' ),
	'section'             => 'kingston_blog_section',
	'choices'			  => kingston_sidebar_position(),
) ) );

// column control and setting
$wp_customize->add_setting( 'kingston_theme_options[column_type]', array(
	'default'          	=> kingston_theme_option( 'column_type' ),
	'sanitize_callback' => 'kingston_sanitize_select',
) );

$wp_customize->add_control( 'kingston_theme_options[column_type]', array(
	'label'             => esc_html__( 'Column Layout', 'kingston' ),
	'section'           => 'kingston_blog_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'column-1' 		=> esc_html__( 'One Column', 'kingston' ),
		'column-2' 		=> esc_html__( 'Two Column', 'kingston' ),
	),
) );

// excerpt count control and setting
$wp_customize->add_setting( 'kingston_theme_options[excerpt_count]', array(
	'default'          	=> kingston_theme_option( 'excerpt_count' ),
	'sanitize_callback' => 'kingston_sanitize_number_range',
	'validate_callback' => 'kingston_validate_excerpt_count',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'kingston_theme_options[excerpt_count]', array(
	'label'             => esc_html__( 'Excerpt Length', 'kingston' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 50.', 'kingston' ),
	'section'           => 'kingston_blog_section',
	'type'				=> 'number',
	'input_attrs'		=> array(
		'min'	=> 1,
		'max'	=> 50,
		),
) );

// pagination control and setting
$wp_customize->add_setting( 'kingston_theme_options[pagination_type]', array(
	'default'          	=> kingston_theme_option( 'pagination_type' ),
	'sanitize_callback' => 'kingston_sanitize_select',
) );

$wp_customize->add_control( 'kingston_theme_options[pagination_type]', array(
	'label'             => esc_html__( 'Pagination Type', 'kingston' ),
	'section'           => 'kingston_blog_section',
	'type'				=> 'select',
	'choices'			=> array( 
		'default' 		=> esc_html__( 'Default', 'kingston' ),
		'numeric' 		=> esc_html__( 'Numeric', 'kingston' ),
	),
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'kingston_theme_options[show_date]', array(
	'default'           => kingston_theme_option( 'show_date' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[show_date]', array(
	'label'             => esc_html__( 'Show Date', 'kingston' ),
	'section'           => 'kingston_blog_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'kingston_theme_options[show_category]', array(
	'default'           => kingston_theme_option( 'show_category' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[show_category]', array(
	'label'             => esc_html__( 'Show Category', 'kingston' ),
	'section'           => 'kingston_blog_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'kingston_theme_options[show_author]', array(
	'default'           => kingston_theme_option( 'show_author' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[show_author]', array(
	'label'             => esc_html__( 'Show Author', 'kingston' ),
	'section'           => 'kingston_blog_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );

// Archive comment meta setting and control.
$wp_customize->add_setting( 'kingston_theme_options[show_comment]', array(
	'default'           => kingston_theme_option( 'show_comment' ),
	'sanitize_callback' => 'kingston_sanitize_switch',
) );

$wp_customize->add_control( new Kingston_Switch_Control( $wp_customize, 'kingston_theme_options[show_comment]', array(
	'label'             => esc_html__( 'Show Comment', 'kingston' ),
	'section'           => 'kingston_blog_section',
	'on_off_label' 		=> kingston_show_options(),
) ) );