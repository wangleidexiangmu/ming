<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package Catch Vogue
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function catch_vogue_portfolio_options( $wp_customize ) {
    // Add note to Jetpack Portfolio Section
    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_jetpack_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Vogue_Note_Control',
            'label'             => sprintf( esc_html__( 'For Portfolio Options for Catch Vogue Theme, go %1$shere%2$s', 'catch-vogue' ),
                 '<a href="javascript:wp.customize.section( \'catch_vogue_portfolio\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'jetpack_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	$wp_customize->add_section( 'catch_vogue_portfolio', array(
            'panel'    => 'catch_vogue_theme_options',
            'title'    => esc_html__( 'Portfolio', 'catch-vogue' ),
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
            'name'              => 'catch_vogue_portfolio_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Vogue_Note_Control',
            'active_callback'   => 'catch_vogue_is_ect_portfolio_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Type Enabled', 'catch-vogue' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'catch_vogue_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );
    
catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_portfolio_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'catch_vogue_sanitize_select',
            'active_callback'   => 'catch_vogue_is_ect_portfolio_active',
            'choices'           => catch_vogue_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'catch-vogue' ),
            'section'           => 'catch_vogue_portfolio',
            'type'              => 'select',
        )
    );

    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Catch_Vogue_Note_Control',
            'active_callback'   => 'catch_vogue_is_portfolio_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'catch-vogue' ),
                 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'catch_vogue_portfolio',
            'type'              => 'description',
        )
    );

    catch_vogue_register_option( $wp_customize, array(
            'name'              => 'catch_vogue_portfolio_number',
            'default'           => '6',
            'sanitize_callback' => 'catch_vogue_sanitize_number_range',
            'active_callback'   => 'catch_vogue_is_portfolio_active',
            'label'             => esc_html__( 'Number of items to show', 'catch-vogue' ),
            'section'           => 'catch_vogue_portfolio',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'catch_vogue_portfolio_number', 6 );

    for ( $i = 1; $i <= $number ; $i++ ) {

        //for CPT
        catch_vogue_register_option( $wp_customize, array(
                'name'              => 'catch_vogue_portfolio_cpt_' . $i,
                'sanitize_callback' => 'catch_vogue_sanitize_post',
                'active_callback'   => 'catch_vogue_is_portfolio_active',
                'label'             => esc_html__( 'Portfolio', 'catch-vogue' ) . ' ' . $i ,
                'section'           => 'catch_vogue_portfolio',
                'type'              => 'select',
                'choices'           => catch_vogue_generate_post_array( 'jetpack-portfolio' ),
            )
        );

    } // End for().
}
add_action( 'customize_register', 'catch_vogue_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'catch_vogue_is_portfolio_active' ) ) :
    /**
    * Return true if portfolio is active
    *
    * @since Catch Vogue 1.0
    */
    function catch_vogue_is_portfolio_active( $control ) {
        $enable = $control->manager->get_setting( 'catch_vogue_portfolio_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( catch_vogue_is_ect_portfolio_active( $control ) &&  catch_vogue_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'catch_vogue_is_ect_portfolio_inactive' ) ) :
    /**
    *
    * @since Catch Vogue 1.0
    */
    function catch_vogue_is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'catch_vogue_is_ect_portfolio_active' ) ) :
    /**
    *
    * @since Catch Vogue 1.0
    */
    function catch_vogue_is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;
