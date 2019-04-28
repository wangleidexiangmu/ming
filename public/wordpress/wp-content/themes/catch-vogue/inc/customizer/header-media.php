<?php
/**
 * Header Media Options
 *
 * @package Catch Vogue
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_vogue_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'catch-vogue' );

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'catch-vogue' ),
				'exclude-home'           => esc_html__( 'Excluding Homepage', 'catch-vogue' ),
				'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'catch-vogue' ),
				'entire-site'            => esc_html__( 'Entire Site', 'catch-vogue' ),
				'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'catch-vogue' ),
				'pages-posts'            => esc_html__( 'Pages and Posts', 'catch-vogue' ),
				'disable'                => esc_html__( 'Disabled', 'catch-vogue' ),
			),
			'label'             => esc_html__( 'Enable on', 'catch-vogue' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_content_align',
			'default'           => 'content-aligned-center',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'choices'           => array(
				'content-aligned-center' => esc_html__( 'Center', 'catch-vogue' ),
				'content-aligned-right'  => esc_html__( 'Right', 'catch-vogue' ),
				'content-aligned-left'   => esc_html__( 'Left', 'catch-vogue' ),
			),
			'label'             => esc_html__( 'Content Position', 'catch-vogue' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_text_align',
			'default'           => 'text-aligned-center',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'choices'           => array(
				'text-aligned-right'  => esc_html__( 'Right', 'catch-vogue' ),
				'text-aligned-center' => esc_html__( 'Center', 'catch-vogue' ),
				'text-aligned-left'   => esc_html__( 'Left', 'catch-vogue' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'catch-vogue' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_opacity',
			'default'           => 20,
			'sanitize_callback' => 'catch_vogue_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'catch-vogue' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_scroll_down',
			'sanitize_callback' => 'catch_vogue_sanitize_checkbox',
			'default'           => 1,
			'label'             => esc_html__( 'Scroll Down Button', 'catch-vogue' ),
			'section'           => 'header_image',
			'custom_control'    => 'Catch_Vogue_Toggle_Control',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'catch-vogue' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_image',
			'sanitize_callback' => 'catch_vogue_sanitize_image',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Header Media Logo', 'catch-vogue' ),
			'section'           => 'header_image',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_subtitle',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Sub Title', 'catch-vogue' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Text', 'catch-vogue' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_url',
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'catch-vogue' ),
			'section'           => 'header_image',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'catch-vogue' ),
			'section'           => 'header_image',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_header_url_target',
			'sanitize_callback' => 'catch_vogue_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'catch-vogue' ),
			'section'           => 'header_image',
			'custom_control'    => 'Catch_Vogue_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'catch_vogue_header_media_options' );
