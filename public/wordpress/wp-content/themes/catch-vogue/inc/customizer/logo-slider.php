<?php
/**
 * Logo Slider Options
 *
 * @package Catch Vogue
 */

/**
 * Add Logo Slider options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_vogue_logo_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_vogue_logo_slider', array(
			'title' => esc_html__( 'Logo Slider', 'catch-vogue' ),
			'panel' => 'catch_vogue_theme_options',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_logo_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'choices'           => catch_vogue_section_visibility_options(),
			'label'             => esc_html__( 'Enable Logo Slider on', 'catch-vogue' ),
			'section'           => 'catch_vogue_logo_slider',
			'type'              => 'select',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_logo_slider_title',
			'default'           => esc_html__( 'Logo Slider', 'catch-vogue' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_vogue_is_logo_slider_active',
			'label'             => esc_html__( 'Title', 'catch-vogue' ),
			'section'           => 'catch_vogue_logo_slider',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_logo_slider_sub_title',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'catch_vogue_is_logo_slider_active',
			'label'             => esc_html__( 'Sub Title', 'catch-vogue' ),
			'section'           => 'catch_vogue_logo_slider',
			'type'              => 'textarea',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_logo_slider_number',
			'default'           => 5,
			'sanitize_callback' => 'catch_vogue_sanitize_number_range',
			'active_callback'   => 'catch_vogue_is_logo_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed', 'catch-vogue' ),
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'catch-vogue' ),
			'section'           => 'catch_vogue_logo_slider',
			'type'              => 'number',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_logo_slider_visible_items',
			'default'           => 5,
			'sanitize_callback' => 'catch_vogue_sanitize_number_range',
			'active_callback'   => 'catch_vogue_is_logo_slider_active',
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 1,
				'max'   => 5,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of visible items', 'catch-vogue' ),
			'section'           => 'catch_vogue_logo_slider',
			'type'              => 'number',
		)
	);

	//loop for featured post sliders
	for ( $i=1; $i <= get_theme_mod( 'catch_vogue_logo_slider_number', 5 ); $i++ ) {
		//page content
		catch_vogue_register_option( $wp_customize, array(
				'name'              => 'catch_vogue_logo_slider_page_'. $i,
				'sanitize_callback' => 'catch_vogue_sanitize_post',
				'active_callback'   => 'catch_vogue_is_logo_slider_active',
				'label'             => esc_html__( 'Page', 'catch-vogue' ) . ' ' . $i ,
				'section'           => 'catch_vogue_logo_slider',
				'type'              => 'dropdown-pages',
			)
		);
	}
}
add_action( 'customize_register', 'catch_vogue_logo_slider_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_vogue_is_logo_slider_active' ) ) :
	/**
	* Return true if logo_slider is active
	*
	* @since Catch Vogue 1.0
	*/
	function catch_vogue_is_logo_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_vogue_logo_slider_option' )->value();

		return ( catch_vogue_check_section( $enable ) );
	}
endif;
