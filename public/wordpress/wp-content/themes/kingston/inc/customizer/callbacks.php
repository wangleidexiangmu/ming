<?php
/**
 * Callbacks functions
 *
 * @package kingston
 */

if ( ! function_exists( 'kingston_theme_color_custom_enable' ) ) :
	/**
	 * Check if theme color custom enabled
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function kingston_theme_color_custom_enable( $control ) {
		return 'custom' == $control->manager->get_setting( 'kingston_theme_options[theme_color]' )->value();
	}
endif;
