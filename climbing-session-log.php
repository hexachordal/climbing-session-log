<?php
/**
 * Plugin Name:       Climbing Session Log
 * Description:       Personal climbing session log.
 * Version:           0.1.0
 * Author:            Francois Harewood
 * License:           MIT
 * Requires PHP:      8.0
 * Text Domain:       climbing-session-log
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

add_action( 'init', 'climbing_log_register_blocks' );

function climbing_log_register_blocks(): void {
    if ( file_exists( __DIR__ . '/build/recent-sessions/block.json' ) ) {
        register_block_type( __DIR__ . '/build/recent-sessions' );
    }
}
