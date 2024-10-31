<?php
/**
 * File: includes/functions.php
 * Description: Contains functions for creating and deleting test posts in the DMUK Bulk Out plugin.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function dmuk_bo_create_posts( $num_posts, $num_words, $category_id ) {
    global $wpdb;

    // Validate parameters
    $num_posts = intval( $num_posts );
    $num_words = intval( $num_words );
    $category_id = intval( $category_id );

    if ( $num_posts <= 0 || $num_posts > 1000 || $num_words <= 0 || $num_words > 100 || $category_id <= 0 ) {
        return; // Invalid input, no action performed
    }
    
    // Get the last post number used
    $last_post_number = get_option('dmuk_bo_last_post_number', 0);
    
    for ( $i = 0; $i < $num_posts; $i++ ) {
        $post_number = $last_post_number + 1;
        $post_title = sprintf('WPPT Test Post %06d', $post_number);
        
        // Add blank lines between blocks
        $paragraph = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ipsum neque, aliquam quis euismod a, ' .
            'pellentesque convallis nibh. Pellentesque venenatis porttitor neque, a eleifend velit ultrices id. Morbi eros velit, suscipit vitae ipsum vel, ' .
            'finibus elementum erat. Cras venenatis nec augue posuere suscipit. Aliquam in interdum metus. Suspendisse tincidunt, ' .
            'ex porttitor suscipit gravida, elit erat rhoncus diam, sed sagittis arcu orci vitae nibh. Nam tincidunt auctor convallis. Donec quis elementum quam. ' . 
            'Integer congue justo quis nunc fermentum elementum. Praesent tempor, metus dictum maximus ultrices, nibh sem cursus erat, id euismod augue elit vel turpis. ' .
            'Nulla sed scelerisque massa, vitae euismod.';

        $post_content = str_repeat( sanitize_textarea_field( $paragraph . "\n\n" ), $num_words);

        $post_data = array(
            'post_title'   => sanitize_text_field( $post_title ),
            'post_content' => $post_content,
            'post_status'  => 'publish',
            'post_category'=> array( $category_id ),
        );
        
        wp_insert_post( $post_data );
        $last_post_number++;
    }
    
    // Update the last post number
    update_option('dmuk_bo_last_post_number', $last_post_number);
    
    // Provide feedback
    wp_cache_flush(); // Ensure all caches are cleared
    $total_size = dmuk_bo_get_database_size();
    update_option( 'dmuk_bo_feedback', sprintf(
        'Successfully added %d test posts. Due to the way the database works, there may be a delay until the correct size is registered, so you may have to refresh this screen momentarily by pressing F5.',
        $num_posts
    ));
}

function dmuk_bo_delete_posts() {
    // Get the IDs of the test posts
    $post_ids = get_posts(array(
        'post_type'      => 'post',
        'post_status'    => 'any',
        'numberposts'    => -1,
        's'              => 'WPPT Test Post'
    ));

    if ( ! empty( $post_ids ) ) {
        // Delete the test posts
        foreach ($post_ids as $post) {
            wp_delete_post($post->ID, true); // Force delete
        }
    }
    
    // Reset the post number counter
    update_option('dmuk_bo_last_post_number', 0);
    
    // Clean up options that might have been used during post creation
    delete_option('dmuk_bo_feedback');
    
    // Flush cache to ensure size reflects recent changes
    wp_cache_flush();
    
    // Provide feedback
    update_option('dmuk_bo_feedback', 'Successfully deleted ALL test posts. Other posts should be unaffected. Due to the way the database works, there may be a delay until the correct size is registered, so you may have to refresh this screen momentarily by pressing F5.');
}


function dmuk_bo_get_database_size() {
    global $wpdb;

    // Attempt to get the database size from cache
    $cache_key = 'dmuk_bo_database_size';
    $size = wp_cache_get($cache_key);

    // If not in cache, retrieve from the database
    if ($size === false) {
        // Initialize size
        $size = 0;

        /**
         * Direct database queries are discouraged, but there is no $wpdb method
         * or WordPress function to retrieve the database size. The query is safely handled using $wpdb->prepare().
         */
        $result = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT SUM(data_length + index_length) AS size 
                 FROM information_schema.TABLES 
                 WHERE table_schema = %s",
                DB_NAME
            )
        );

        // If result is valid, calculate the size in MB
        if ($result !== null) {
            $size = round(floatval($result) / 1024 / 1024, 2); // Convert to MB and round to 2 decimals
        }

        // Store the calculated size in cache for 1 hour (3600 seconds)
        wp_cache_set($cache_key, $size, '', 3600);
    }

    return floatval($size); // Return the size as a float value
}


?>
