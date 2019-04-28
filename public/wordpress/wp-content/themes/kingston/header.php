<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kingston
 */

/**
 * kingston_doctype_action hook
 *
 * @hooked kingston_doctype -  10
 *
 */
do_action( 'kingston_doctype_action' );

/**
 * kingston_head_action hook
 *
 * @hooked kingston_head -  10
 *
 */
do_action( 'kingston_head_action' );

/**
 * kingston_body_start_action hook
 *
 * @hooked kingston_body_start -  10
 *
 */
do_action( 'kingston_body_start_action' );
 
/**
 * kingston_page_start_action hook
 *
 * @hooked kingston_page_start -  10
 * @hooked kingston_loader -  20
 *
 */
do_action( 'kingston_page_start_action' );

/**
 * kingston_header_start_action hook
 *
 * @hooked kingston_header_start -  10
 *
 */
do_action( 'kingston_header_start_action' );

/**
 * kingston_site_branding_action hook
 *
 * @hooked kingston_site_branding -  10
 *
 */
do_action( 'kingston_site_branding_action' );

/**
 * kingston_primary_nav_action hook
 *
 * @hooked kingston_primary_nav -  10
 *
 */
do_action( 'kingston_primary_nav_action' );

/**
 * kingston_header_ends_action hook
 *
 * @hooked kingston_header_ends -  10
 *
 */
do_action( 'kingston_header_ends_action' );

/**
 * kingston_site_content_start_action hook
 *
 * @hooked kingston_site_content_start -  10
 *
 */
do_action( 'kingston_site_content_start_action' );

/**
 * kingston_primary_content_action hook
 *
 * @hooked kingston_add_slider_section -  10
 *
 */
do_action( 'kingston_primary_content_action' );