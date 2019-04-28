<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Catch Vogue
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_vogue_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Vogue_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options for Foodie World Theme, go %1$shere%2$s', 'catch-vogue' ),
                '<a href="javascript:wp.customize.section( \'catch_vogue_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'catch_vogue_testimonials', array(
            'panel'    => 'catch_vogue_theme_options',
            'title'    => esc_html__( 'Testimonials', 'catch-vogue' ),
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
            'name'              => 'catch_vogue_testimonial_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Vogue_Note_Control',
            'active_callback'   => 'catch_vogue_is_ect_testimonial_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'catch-vogue' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'catch_vogue_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_testimonial_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'catch_vogue_sanitize_select',
            'active_callback'   => 'catch_vogue_is_ect_testimonial_active',
            'choices'           => catch_vogue_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'catch-vogue' ),
            'section'           => 'catch_vogue_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_testimonial_bg_image',
            'sanitize_callback' => 'catch_vogue_sanitize_image',
            'active_callback'   => 'catch_vogue_is_testimonial_active',
            'custom_control'    => 'WP_Customize_Image_Control',
            'label'             => esc_html__( 'Section Background Image', 'catch-vogue' ),
           'section'           => 'catch_vogue_testimonials',
            'mime_type'         => 'image',
        )
    );

    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Vogue_Note_Control',
            'active_callback'   => 'catch_vogue_is_testimonial_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'catch-vogue' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'catch_vogue_testimonials',
            'type'              => 'description',
        )
    );

    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_testimonial_number',
            'default'           => 4,
            'sanitize_callback' => 'catch_vogue_sanitize_number_range',
            'active_callback'   => 'catch_vogue_is_testimonial_active',
            'label'             => esc_html__( 'No of items', 'catch-vogue' ),
            'section'           => 'catch_vogue_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 1,
                'max'               => 7,
            ),
        )
    );

    $number = get_theme_mod( 'catch_vogue_testimonial_number', 4 );

    for ( $i = 1; $i <= $number ; $i++ ) {
    
            //for CPT
        catch_vogue_register_option( $wp_customize, array(
                'name'              => 'catch_vogue_testimonial_cpt_' . $i,
                'sanitize_callback' => 'catch_vogue_sanitize_post',
                'active_callback'   => 'catch_vogue_is_testimonial_active',
                'label'             => esc_html__( 'Testimonial', 'catch-vogue' ) . ' ' . $i ,
                'section'           => 'catch_vogue_testimonials',
                'type'              => 'select',
                'choices'           => catch_vogue_generate_post_array( 'jetpack-testimonial' ),
            )
        );

    } // End for().
}
add_action( 'customize_register', 'catch_vogue_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'catch_vogue_is_testimonial_active' ) ) :
    /**
    * Return true if Testimonial is active
    *
    * @since Catch Vogue 1.0
    */
    function catch_vogue_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'catch_vogue_testimonial_option' )->value();
        //return true only if previwed page on customizer matches the type of content option selected
        return ( catch_vogue_is_ect_testimonial_active( $control ) &&  catch_vogue_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'catch_vogue_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since Catch Vogue 1.0
    */
    function catch_vogue_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'catch_vogue_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since Catch Vogue 1.0
    */
    function catch_vogue_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'catch_vogue_is_testimonial_bg_active' ) ) :
    /**
    * Return true if background is set
    *
    * @since Catch Vogue 1.0
    */
    function catch_vogue_is_testimonial_bg_active( $control ) {
        $bg_image = $control->manager->get_setting( 'catch_vogue_testimonial_bg_image' )->value();

        return ( catch_vogue_is_testimonial_active( $control ) && '' !== $bg_image );
    }
endif;
