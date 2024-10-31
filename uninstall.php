<?php
/**
 * File: uninstall.php
 * Description: Handles cleanup tasks, including deleting test posts and categories.
 */

// Exit if accessed directly
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

function dmuk_bo_uninstall() {

    // Delete all test posts
    $posts = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => 'any',
        'numberposts'    => -1,
        's'              => 'WPPT Test Post'
    ));

    if ( ! empty( $posts ) ) {
        foreach ( $posts as $post ) {
            wp_delete_post( $post->ID, true ); // Force delete
        }
    }

    // Delete test categories
    $categories = array( 'WPPT Test Cat 01', 'WPPT Test Cat 02', 'WPPT Test Cat 03', 'WPPT Test Cat 04', 'WPPT Test Cat 05' );
    foreach ( $categories as $cat_name ) {
        $term = get_term_by( 'name', sanitize_text_field( $cat_name ), 'category' );
        if ( $term ) {
            wp_delete_term( $term->term_id, 'category' );
        }
    }

    // Reset the last post number
    delete_option( 'dmuk_bo_last_post_number' );

    // Delete feedback option
    delete_option( 'dmuk_bo_feedback' );

    // Remove any other plugin-specific options if needed
    // delete_option('your_option_name');

    // No need to optimize tables during uninstall
}

// Run the uninstall function
dmuk_bo_uninstall();
