<?php
/**
 * Default Theme Customizer Values
 *
 * @package kingston
 */

function kingston_get_default_theme_options() {
	$kingston_default_options = array(
		// default options

		/* Homepage Sections */

		// Slider
		'enable_slider'			=> true,
		'slider_btn_label'		=> esc_html__( 'Learn More', 'kingston' ),

		// Introduction
		'enable_introduction'		=> true,
		'introduction_btn_label'	=> esc_html__( 'Explore Us', 'kingston' ),

		// Service
		'enable_service'		=> true,
		'service_title'			=> esc_html__( 'Our Service', 'kingston' ),

		// Portfolio
		'enable_portfolio'		=> true,
		'portfolio_title'		=> esc_html__( 'Portfolio', 'kingston' ),
		'portfolio_btn_label'	=> esc_html__( 'Read More', 'kingston' ),

		// Testimonial
		'enable_testimonial'	=> true,

		// Recent
		'enable_recent'			=> true,
		'recent_title'			=> esc_html__( 'Latest News', 'kingston' ),

		// Footer
		'slide_to_top'			=> true,
		'copyright_text'		=> esc_html__( 'Copyright &copy; 2019 | All Rights Reserved.', 'kingston' ),

		/* Theme Options */

		// blog / archive
		'latest_blog_title'		=> esc_html__( 'Blogs', 'kingston' ),
		'excerpt_count'			=> 25,
		'pagination_type'		=> 'numeric',
		'sidebar_layout'		=> 'right-sidebar',
		'column_type'			=> 'column-2',
		'show_date'				=> true,
		'show_category'			=> true,
		'show_author'			=> true,
		'show_comment'			=> true,

		// single post
		'sidebar_single_layout'	=> 'right-sidebar',
		'show_single_date'		=> true,
		'show_single_category'	=> true,
		'show_single_tags'		=> true,
		'show_single_author'	=> true,

		// page
		'sidebar_page_layout'	=> 'right-sidebar',

		// global
		'enable_loader'			=> true,
		'enable_breadcrumb'		=> true,
		'enable_sticky_header'	=> false,
		'loader_type'			=> 'spinner-dots',
		'site_layout'			=> 'full',

	);

	$output = apply_filters( 'kingston_default_theme_options', $kingston_default_options );
	return $output;
}