<?php
/*
Plugin Name: Performance Checker by DMUK
Plugin URI: https://diversify.me.uk/wordpress-performance-tester-plugin/
Description: A simple plugin to create bulk test data and simulate heavy load for performance and scalability testing of WordPress installations, plugins and themes. Test data can be removed with one click when testing is complete.
Version: 2.26
Author: Diversify Me UK
Author URI: https://diversify.me.uk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Filename: performance-checker-by-dmuk.php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Include necessary files
require_once plugin_dir_path( __FILE__ ) . 'includes/activation.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/admin-page.php';

// Hook to create test categories on plugin activation
register_activation_hook( __FILE__, 'dmuk_bo_create_test_categories' );

// Hook to delete test posts and categories on plugin uninstallation
register_uninstall_hook( __FILE__, 'dmuk_bo_uninstall' );

// Add admin menu
add_action( 'admin_menu', 'dmuk_bo_add_admin_menu' );


function dmuk_bo_add_admin_menu() {
    add_menu_page(
        esc_html__( 'DMUK Performance Checker', 'performance-checker-by-dmuk' ), // Page Title
        esc_html__( 'DMUK Perf Check', 'performance-checker-by-dmuk' ), // Menu Title
        'manage_options',
        'dmuk_bulk_out',
        'dmuk_bo_admin_page',  // Ensure this function is defined in admin-page.php
        'dashicons-database', // Use the database icon
        80
    );
}

// Clear feedback message when the admin menu is loaded
add_action( 'admin_menu', function() {
    update_option( 'dmuk_bo_feedback', '' );
});

// Add a donate link to the plugin's row in the plugin listing page
function dmuk_bo_add_donate_link( $links, $file ) {
    if ( plugin_basename( __FILE__ ) === $file ) {
		$donate_link = '<a href="https://diversify.me.uk/donate/" target="_blank">' . esc_html__( 'performance-checker-by-dmuk', 'performance-checker-by-dmuk' ) . '</a>';
        array_push( $links, $donate_link );
    }
    return $links;
}
add_filter( 'plugin_row_meta', 'dmuk_bo_add_donate_link', 10, 2 );
?>
