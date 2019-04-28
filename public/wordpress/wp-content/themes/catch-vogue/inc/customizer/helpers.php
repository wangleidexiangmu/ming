<?php

/**
 * Function to register control and setting
 */
function catch_vogue_register_option( $wp_customize, $option ) {
	// Initialize Setting.
	$wp_customize->add_setting( $option['name'], array(
		'sanitize_callback'    => $option['sanitize_callback'],
		'default'              => isset( $option['default'] ) ? $option['default'] : '',
		'transport'            => isset( $option['transport'] ) ? $option['transport'] : 'refresh',
		'theme_supports'       => isset( $option['theme_supports'] ) ? $option['theme_supports'] : '',
	) );

	$control = array(
		'label'    => $option['label'],
		'section'  => $option['section'],
		'settings' => isset( $option['settings'] ) ? $option['settings'] : $option['name'],
	);

	if ( isset( $option['active_callback'] ) ) {
		$control['active_callback'] = $option['active_callback'];
	}

	if ( isset( $option['priority'] ) ) {
		$control['priority'] = $option['priority'];
	}

	if ( isset( $option['choices'] ) ) {
		$control['choices'] = $option['choices'];
	}

	if ( isset( $option['type'] ) ) {
		$control['type'] = $option['type'];
	}

	if ( isset( $option['input_attrs'] ) ) {
		$control['input_attrs'] = $option['input_attrs'];
	}

	if ( isset( $option['description'] ) ) {
		$control['description'] = $option['description'];
	}

	if ( isset( $option['custom_control'] ) ) {
		$wp_customize->add_control( new $option['custom_control']( $wp_customize, $option['name'], $control ) );
	} else {
		$wp_customize->add_control( $option['name'], $control );
	}
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Catch Vogue 1.0
 * @see catch_vogue_customize_register()
 *
 * @return void
 */
function catch_vogue_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Catch Vogue 1.0
 * @see catch_vogue_customize_register()
 *
 * @return void
 */
function catch_vogue_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Alphabetically sort theme options sections
 *
 * @param  wp_customize object $wp_customize wp_customize object.
 */
function catch_vogue_sort_sections_list( $wp_customize ) {
	foreach ( $wp_customize->sections() as $section_key => $section_object ) {
		if ( false !== strpos( $section_key, 'catch_vogue_' ) && 'catch_vogue_important_links' !== $section_key ) {
			$options[] = $section_key;
		}
	}

	sort( $options );

	$priority = 1;
	foreach ( $options as  $option ) {
		$wp_customize->get_section( $option )->priority = $priority++;
	}
}
add_action( 'customize_register', 'catch_vogue_sort_sections_list' );

/**
 * Returns an array of visibility options for featured sections
 *
 * @since Catch Vogue 1.0
 */
function catch_vogue_section_visibility_options() {
	$options = array(
		'disabled'    => esc_html__( 'Disabled', 'catch-vogue' ),
		'homepage'    => esc_html__( 'Homepage / Frontpage', 'catch-vogue' ),
		'entire-site' => esc_html__( 'Entire Site', 'catch-vogue' ),
	);

	return apply_filters( 'catch_vogue_section_visibility_options', $options );
}

/**
 * Returns an array of featured content options
 *
 * @since Catch Vogue 1.0
 */
function catch_vogue_sections_layout_options() {
	$options = array(
		'layout-one'   => esc_html__( '1 column', 'catch-vogue' ),
		'layout-two'   => esc_html__( '2 columns', 'catch-vogue' ),
		'layout-three' => esc_html__( '3 columns', 'catch-vogue' ),
		'layout-four'  => esc_html__( '4 columns', 'catch-vogue' ),
	);

	return apply_filters( 'catch_vogue_sections_layout_options', $options );
}

/**
 * Returns an array of section types
 *
 * @since Catch Vogue 1.0
 */
function catch_vogue_section_type_options() {
	$options = array(
		'post'     => esc_html__( 'Post', 'catch-vogue' ),
		'page'     => esc_html__( 'Page', 'catch-vogue' ),
		'category' => esc_html__( 'Category', 'catch-vogue' ),
		'custom'   => esc_html__( 'Custom', 'catch-vogue' ),
	);

	return apply_filters( 'catch_vogue_section_type_options', $options );
}

/**
 * Returns an array of color schemes registered for catchresponsive.
 *
 * @since Catch Vogue 1.0
 */
function catch_vogue_get_pagination_types() {
	$pagination_types = array(
		'default' => esc_html__( 'Default(Older Posts/Newer Posts)', 'catch-vogue' ),
		'numeric' => esc_html__( 'Numeric', 'catch-vogue' ),
	);

	return apply_filters( 'catch_vogue_get_pagination_types', $pagination_types );
}

/**
 * Generate a list of all available post array
 *
 * @param  string $post_type post type.
 * @return post_array
 */
function catch_vogue_generate_post_array( $post_type = 'post' ) {
	$output = array();
	$posts = get_posts( array(
		'post_type'        => $post_type,
		'post_status'      => 'publish',
		'suppress_filters' => false,
		'posts_per_page'   => -1,
		)
	);

	$output['0']= esc_html__( '-- Select --', 'catch-vogue' );

	foreach ( $posts as $post ) {
		/* translators: 1: post id. */
		$output[ $post->ID ] = ! empty( $post->post_title ) ? $post->post_title : sprintf( __( '#%d (no title)', 'catch-vogue' ), $post->ID );
	}

	return $output;
}

/**
 * Generate a list of all available taxonomy
 *
 * @param  string $post_type post type.
 * @return post_array
 */
function catch_vogue_generate_taxonomy_array( $taxonomy = 'category' ) {
	$output = array();
	$taxonomy = get_categories( array( 'taxonomy' => $taxonomy ) );

	$output['0']= esc_html__( '-- Select --', 'catch-vogue' );

	foreach ( $taxonomy as $tax ) {
		$output[ $tax->term_id ] = ! empty($tax->name ) ?$tax->name : sprintf( __( '#%d (no title)', 'catch-vogue' ), $tax->term_id );
	}

	return $output;
}

/**
 * Returns an array of featured content show registered for vogue.
 *
 * @since Catch Vogue 1.0
 */
function catch_vogue_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'catch-vogue' ),
		'full-content' => esc_html__( 'Full Content', 'catch-vogue' ),
		'hide-content' => esc_html__( 'Hide Content', 'catch-vogue' ),
	);
	return apply_filters( 'catch_vogue_content_show', $options );
}

/**
 * Returns an array of featured content show registered for vogue.
 *
 * @since Catch Vogue 1.0
 */
function catch_vogue_meta_show() {
	$options = array(
		'show-meta' => esc_html__( 'Show Meta', 'catch-vogue' ),
		'hide-meta' => esc_html__( 'Hide Meta', 'catch-vogue' ),
	);
	return apply_filters( 'catch_vogue_content_show', $options );
}

/**
 * Returns an array of featured content show registered for vogue.
 *
 * @since Catch Vogue 1.0
 */
function catch_vogue_category_show() {
	$options = array(
		'show-cat' => esc_html__( 'Show Category', 'catch-vogue' ),
		'hide-cat' => esc_html__( 'Hide Category', 'catch-vogue' ),
	);
	return apply_filters( 'catch_vogue_content_show', $options );
}
