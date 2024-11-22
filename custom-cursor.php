<?php
/*
Plugin Name: Custom Cursor
Description: A plugin to add custom cursor shape to your WordPress website.
Version: 1.0
Author: Nauhyuh.com
Author URI: https://nauhyuh.com
Plugin URI: https://nauhyuh.com
Text Domain: custom-cursor
License: GPLv2 or later
*/


// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CUSTOM_CURSOR_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CUSTOM_CURSOR_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Include dependencies
require_once CUSTOM_CURSOR_PLUGIN_DIR . 'includes/settings-page.php';
require_once CUSTOM_CURSOR_PLUGIN_DIR . 'includes/enqueue-scripts.php';

// Hook to create admin menu
add_action('admin_menu', 'custom_cursor_create_menu');

// Hook to enqueue scripts and styles
add_action('wp_enqueue_scripts', 'custom_cursor_enqueue_scripts');

// Hook to register settings
add_action('admin_init', 'custom_cursor_register_settings');

function custom_cursor_add_action_links($links)
{
    $settings_link = '<a href="' . admin_url('admin.php?page=custom-cursor-settings') . '" class="custom-cursor-settings-link">Settings</a>';
    $pre_link = '<a href="https://nauhyuh.com" target="_blank" class="custom-cursor-pre">Update Premium</a>';

    // Add custom links
    $custom_links = array(
        $settings_link,
        $pre_link,
    );

    // Merge custom links with existing ones
    return array_merge($custom_links, $links);
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'custom_cursor_add_action_links');


add_action('admin_head', function () {
    echo '
    <style>
        .custom-cursor-pre {
            font-weight: bold;
            color: red;
        }

        .custom-cursor-pre:hover {
            color: red;
        }
    </style>';
});
