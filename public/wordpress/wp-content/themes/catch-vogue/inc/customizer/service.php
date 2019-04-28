<?php
/**
 * Services options
 *
 * @package Catch Vogue
 */

/**
 * Add services content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_vogue_service_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Vogue_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options for Foodie World Theme, go %1$shere%2$s', 'catch-vogue' ),
                '<a href="javascript:wp.customize.section( \'catch_vogue_service\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'services',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'catch_vogue_service', array(
			'title' => esc_html__( 'Services', 'catch-vogue' ),
			'panel' => 'catch_vogue_theme_options',
		)
	);

	$action = 'install-plugin';
	$slug   = 'essential-content-types';

	$install_url = wp_nonce_url(
	    add_query_arg(
	        array(
	            'action' => $action,
	            'plugin' => $slug
	        ),
	        admin_url( 'update.php' )
	    ),
	    $action . '_' . $slug
	);

	catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_service_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Vogue_Note_Control',
            'active_callback'   => 'catch_vogue_is_ect_service_inactive',
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Services Content Type Enabled', 'catch-vogue' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'
            ),
            'section'           => 'catch_vogue_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_service_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'catch_vogue_sanitize_select',
			'active_callback'   => 'catch_vogue_is_ect_service_active',
			'choices'           => catch_vogue_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'catch-vogue' ),
			'section'           => 'catch_vogue_service',
			'type'              => 'select',
		)
	);

    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Vogue_Note_Control',
            'active_callback'   => 'catch_vogue_is_service_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'catch-vogue' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'catch_vogue_service',
            'type'              => 'description',
        )
    );

	catch_vogue_register_option( $wp_customize, array(
			'name'              => 'catch_vogue_service_number',
			'default'           => 6,
			'sanitize_callback' => 'catch_vogue_sanitize_number_range',
			'active_callback'   => 'catch_vogue_is_service_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Services is changed (Max no of Services is 20)', 'catch-vogue' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'catch-vogue' ),
			'section'           => 'catch_vogue_service',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'catch_vogue_service_number', 6 );

	//loop for services post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		catch_vogue_register_option( $wp_customize, array(
				'name'              => 'catch_vogue_service_cpt_' . $i,
				'sanitize_callback' => 'catch_vogue_sanitize_post',
				'active_callback'   => 'catch_vogue_is_service_active',
				'label'             => esc_html__( 'Services', 'catch-vogue' ) . ' ' . $i ,
				'section'           => 'catch_vogue_service',
				'type'              => 'select',
                'choices'           => catch_vogue_generate_post_array( 'ect-service' ),
			)
		);

	} // End for().
}
add_action( 'customize_register', 'catch_vogue_service_options', 10 );

if ( ! function_exists( 'catch_vogue_is_service_active' ) ) :
	/**
	* Return true if service is active
	*
	* @since Catch Vogue 1.0
	*/
	function catch_vogue_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'catch_vogue_service_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( catch_vogue_is_ect_service_active( $control ) &&  catch_vogue_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'catch_vogue_is_ect_service_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Catch Vogue 1.0
    */
    function catch_vogue_is_ect_service_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'catch_vogue_is_ect_service_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Catch Vogue 1.0
    */
    function catch_vogue_is_ect_service_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
