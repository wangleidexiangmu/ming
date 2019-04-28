<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kingston
 */

/**
 * kingston_site_content_ends_action hook
 *
 * @hooked kingston_site_content_ends -  10
 *
 */
do_action( 'kingston_site_content_ends_action' );

/**
 * kingston_footer_start_action hook
 *
 * @hooked kingston_footer_start -  10
 *
 */
do_action( 'kingston_footer_start_action' );

/**
 * kingston_site_info_action hook
 *
 * @hooked kingston_site_info -  10
 *
 */
do_action( 'kingston_site_info_action' );

/**
 * kingston_footer_ends_action hook
 *
 * @hooked kingston_footer_ends -  10
 * @hooked kingston_slide_to_top -  20
 *
 */
do_action( 'kingston_footer_ends_action' );

/**
 * kingston_page_ends_action hook
 *
 * @hooked kingston_page_ends -  10
 *
 */
do_action( 'kingston_page_ends_action' );

wp_footer();

/**
 * kingston_body_html_ends_action hook
 *
 * @hooked kingston_body_html_ends -  10
 *
 */
do_action( 'kingston_body_html_ends_action' );
