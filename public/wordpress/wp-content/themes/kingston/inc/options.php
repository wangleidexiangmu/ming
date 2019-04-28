<?php
/**
 * Options functions
 *
 * @package kingston
 */

if ( ! function_exists( 'kingston_show_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function kingston_show_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'kingston' ),
            'off'       => esc_html__( 'No', 'kingston' )
        );
        return apply_filters( 'kingston_show_options', $arr );
    }
endif;

if ( ! function_exists( 'kingston_page_choices' ) ) :
    /**
     * List of pages for page choices.
     * @return Array Array of page ids and name.
     */
    function kingston_page_choices() {
        $pages = get_pages();
        $choices = array();
        $choices[0] = esc_html__( 'None', 'kingston' );
        foreach ( $pages as $page ) {
            $choices[ $page->ID ] = $page->post_title;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'kingston_post_choices' ) ) :
    /**
     * List of posts for post choices.
     * @return Array Array of post ids and name.
     */
    function kingston_post_choices() {
        $posts = get_posts( array( 'numberposts' => -1 ) );
        $choices = array();
        $choices[0] = esc_html__( 'None', 'kingston' );
        foreach ( $posts as $post ) {
            $choices[ $post->ID ] = $post->post_title;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'kingston_category_choices' ) ) :
    /**
     * List of categories for category choices.
     * @return Array Array of category ids and name.
     */
    function kingston_category_choices() {
        $args = array(
                'type'          => 'post',
                'child_of'      => 0,
                'parent'        => '',
                'orderby'       => 'name',
                'order'         => 'ASC',
                'hide_empty'    => 0,
                'hierarchical'  => 0,
                'taxonomy'      => 'category',
            );
        $categories = get_categories( $args );
        $choices = array();
        $choices[0] = esc_html__( 'None', 'kingston' );
        foreach ( $categories as $category ) {
            $choices[ $category->term_id ] = $category->name;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'kingston_site_layout' ) ) :
    /**
     * site layout
     * @return array site layout
     */
    function kingston_site_layout() {
        $kingston_site_layout = array(
            'full'    => get_template_directory_uri() . '/assets/uploads/full.png',
            'boxed'   => get_template_directory_uri() . '/assets/uploads/boxed.png',
        );

        $output = apply_filters( 'kingston_site_layout', $kingston_site_layout );

        return $output;
    }
endif;

if ( ! function_exists( 'kingston_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidebar position
     */
    function kingston_sidebar_position() {
        $kingston_sidebar_position = array(
            'right-sidebar' => get_template_directory_uri() . '/assets/uploads/right.png',
            'no-sidebar'    => get_template_directory_uri() . '/assets/uploads/full.png',
        );

        $output = apply_filters( 'kingston_sidebar_position', $kingston_sidebar_position );

        return $output;
    }
endif;

if ( ! function_exists( 'kingston_get_spinner_list' ) ) :
    /**
     * List of spinner icons options.
     * @return array List of all spinner icon options.
     */
    function kingston_get_spinner_list() {
        $arr = array(
            'spinner-two-way'       => esc_html__( 'Two Way', 'kingston' ),
            'spinner-umbrella'      => esc_html__( 'Umbrella', 'kingston' ),
            'spinner-dots'          => esc_html__( 'Dots', 'kingston' ),
            'spinner-one-way'       => esc_html__( 'One Way', 'kingston' ),
        );
        return apply_filters( 'kingston_spinner_list', $arr );
    }
endif;

if ( ! function_exists( 'kingston_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function kingston_selected_sidebar() {
        $kingston_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'kingston' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar', 'kingston' ),
        );

        $output = apply_filters( 'kingston_selected_sidebar', $kingston_selected_sidebar );

        return $output;
    }
endif;
