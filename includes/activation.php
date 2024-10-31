<?php
/**
 * File: includes/activation.php
 * Description: Handles activation tasks, including creating test categories.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function dmuk_bo_create_test_categories() {
    $categories = array('WPPT Test Cat 01', 'WPPT Test Cat 02', 'WPPT Test Cat 03', 'WPPT Test Cat 04', 'WPPT Test Cat 05');
    foreach ( $categories as $cat_name ) {
        if ( ! term_exists( $cat_name, 'category' ) ) {
            wp_insert_term( $cat_name, 'category' );
        }
    }
    // Initialize the last post number
    if ( false === get_option( 'dmuk_bo_last_post_number' ) ) {
        update_option( 'dmuk_bo_last_post_number', 0 );
    }
}
?>
