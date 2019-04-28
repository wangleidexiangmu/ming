<?php
/**
 * Hero Content Options
 *
 * @package Catch Vogue
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_vogue_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'catch_vogue_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'catch-vogue' ),
			'panel' => 'catch_vogue_theme_options',
		)
	);

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'choices'           => catch_vogue_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-vogue' ),
			'section'           => 'catch_vogue_hero_content_options',
			'type'              => 'select',
		)
	);

	/* Hero Background */
    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_hero_content_bg_image',
            'sanitize_callback' => 'esc_url_raw',
            'active_callback'   => 'catch_vogue_is_hero_content_active',
            'custom_control'    => 'WP_Customize_Image_Control',
            'label'             => esc_html__( 'Background Image', 'catch-vogue' ),
            'section'           => 'catch_vogue_hero_content_options',
        )
    );

    $wp_customize->add_setting( 'catch_vogue_hero_content_bg_position_x', array(
        'sanitize_callback' => 'catch_vogue_sanitize_hero_content_bg_position',
    ) );

    $wp_customize->add_setting( 'catch_vogue_hero_content_bg_position_y', array(
        'sanitize_callback' => 'catch_vogue_sanitize_hero_content_bg_position',
    ) );

    $wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'catch_vogue_hero_content_bg_position', array(
        'label'           => esc_html__( 'Background Image Position', 'catch-vogue' ),
        'active_callback' => 'catch_vogue_is_hero_content_bg_active',
        'section'         => 'catch_vogue_hero_content_options',
        'settings'        => array(
            'x' => 'catch_vogue_hero_content_bg_position_x',
            'y' => 'catch_vogue_hero_content_bg_position_y',
        ),
    ) ) );

    catch_vogue_register_option( $wp_customize, array(
        'name'              => 'catch_vogue_hero_content_bg_size',
        'default'           => 'auto',
        'description'       => esc_html__( 'In mobiles, Background Size is always cover', 'catch-vogue' ),
        'sanitize_callback' => 'catch_vogue_sanitize_select',
        'active_callback'   => 'catch_vogue_is_hero_content_bg_active',
        'label'             => esc_html__( 'Desktop Background Image Size', 'catch-vogue' ),
        'section'           => 'catch_vogue_hero_content_options',
        'type'              => 'select',
        'choices' => array(
            'auto'    => esc_html__( 'Original', 'catch-vogue' ),
            'contain' => esc_html__( 'Fit to Screen', 'catch-vogue' ),
            'cover'   => esc_html__( 'Fill Screen', 'catch-vogue' ),
        ),
    ) );

    catch_vogue_register_option( $wp_customize, array(
        'name'              => 'catch_vogue_hero_content_bg_repeat',
        'default'           => 'repeat',
        'sanitize_callback' => 'catch_vogue_sanitize_select',
        'active_callback'   => 'catch_vogue_is_hero_content_bg_active',
        'label'             => esc_html__( 'Repeat Background Image', 'catch-vogue' ),
        'type'              => 'select',
        'section'           => 'catch_vogue_hero_content_options',
        'choices'           => array(
            'no-repeat' =>  esc_html__( 'No Repeat', 'catch-vogue' ),
            'repeat'    =>  esc_html__( 'Repeat both vertically and horizontally (The last image will be clipped if it does not fit)', 'catch-vogue' ),
            'repeat-x'  =>  esc_html__( 'Repeat only horizontally', 'catch-vogue' ),
            'repeat-y'  =>  esc_html__( 'Repeat only vertically', 'catch-vogue' ),
        ),
    ) );

    catch_vogue_register_option( $wp_customize, array(
        'name'              => 'catch_vogue_hero_content_bg_attachment',
        'default'           => 1,
        'sanitize_callback' => 'catch_vogue_sanitize_checkbox',
        'active_callback'   => 'catch_vogue_is_hero_content_bg_active',
        'label'             => esc_html__( 'Scroll with Page', 'catch-vogue' ),
        'section'           => 'catch_vogue_hero_content_options',
        'custom_control'    => 'Catch_Vogue_Toggle_Control',
    ) );

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'catch_vogue_sanitize_post',
			'active_callback'   => 'catch_vogue_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'catch-vogue' ),
			'section'           => 'catch_vogue_hero_content_options',
			'type'              => 'dropdown-pages',
			'allow_addition'    => true,
		)
	);
}
add_action( 'customize_register', 'catch_vogue_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'catch_vogue_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Catch Vogue 1.0
	*/
	function catch_vogue_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_vogue_hero_content_visibility' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( catch_vogue_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_vogue_is_hero_content_bg_active' ) ) :
    /**
    * Return true if background is set
    *
    * @since Catch Vogue 1.0
    */
    function catch_vogue_is_hero_content_bg_active( $control ) {
        $bg_image = $control->manager->get_setting( 'catch_vogue_hero_content_bg_image' )->value();

        return ( catch_vogue_is_hero_content_active( $control ) && '' !== $bg_image );
    }
endif;
