<?php
/**
 * Catch Themes Demo Importer
 *
 * @package Catch Vogue
 */

/**
 * @since Catch Vogue 1.0.1
 *
 */
function catch_vogue_import_files() {
  $url = 'https://catchthemes.com/demo/import/catch-vogue/';
  return array(
    array(
       'import_file_name'           => esc_html__( 'Free', 'catch-vogue' ),
       'categories'                 => array( esc_html__( 'Free', 'catch-vogue' ) ),
       'import_file_url'            => $url . 'free/demo-content.xml',
       'import_widget_file_url'     => $url . 'free/widgets.wie',
       'import_customizer_file_url' => $url . 'free/customizer.dat',
       'import_preview_image_url'   => 'https://catchthemes.com/demo/catch-vogue/assets/images/catch-vogue-free.jpg',
       'preview_url'                => 'https://catchthemes.com/demo/catch-vogue-free/',
    ),
    array(
       'import_file_name'           => esc_html__( 'Premium', 'catch-vogue' ),
       'categories'                 => array( esc_html__( 'Premium', 'catch-vogue' ) ),
       'import_file_url'            => $url . 'pro/demo-content.xml',
       'import_widget_file_url'     => $url . 'pro/widgets.wie',
       'import_customizer_file_url' => $url . 'pro/customizer.dat',
       'import_preview_image_url'   => 'https://catchthemes.com/demo/catch-vogue/assets/images/catch-vogue-pro.jpg',
       'preview_url'                => 'https://catchthemes.com/demo/catch-vogue-pro/',
       'isPro'                      => true,
       'buy_url'                    => 'https://catchthemes.com/themes/catch-vogue-pro/'
    ),
    array(
       'import_file_name'           => esc_html__( 'Dark Premium', 'catch-vogue' ),
       'categories'                 => array( esc_html__( 'Premium', 'catch-vogue' ) ),
       'import_file_url'            => $url . 'dark/demo-content.xml',
       'import_widget_file_url'     => $url . 'dark/widgets.wie',
       'import_customizer_file_url' => $url . 'dark/customizer.dat',
       'import_preview_image_url'   => 'https://catchthemes.com/demo/catch-vogue/assets/images/catch-vogue-dark-pro.jpg',
       'preview_url'                => 'https://catchthemes.com/demo/catch-vogue-dark/',
       'isPro'                      => true,
       'buy_url'                    => 'https://catchthemes.com/themes/catch-vogue-pro/'
    ),
  );
}
add_filter( 'cp-ctdi/import_files', 'catch_vogue_import_files' );

function catch_vogue_after_import_setup() {
   // Assign menus to their locations.
    $main_menu            = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
    $social_menu          = get_term_by( 'name', 'Social', 'nav_menu' );
    
    set_theme_mod( 'nav_menu_locations', array(
            'menu-1'        => $main_menu->term_id,
            'social-footer' => $social_menu->term_id,
        )
    );
}
add_action( 'cp-ctdi/after_import', 'catch_vogue_after_import_setup' );