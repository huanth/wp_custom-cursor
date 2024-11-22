<?php

function custom_cursor_enqueue_scripts()
{
    $options = get_option('custom_cursor_settings');

    // Kiểm tra nếu tùy chọn được bật và đang ở trang admin
    if (is_admin() && empty($options['apply_in_admin'])) {
        return;
    }

    // Kiểm tra nếu tùy chọn con trỏ bị tắt
    if (empty($options['enabled'])) {
        return;
    }

    wp_enqueue_script(
        'custom-cursor-script',
        CUSTOM_CURSOR_PLUGIN_URL . 'assets/js/custom-cursor.js',
        array('jquery'),
        '1.1',
        true
    );

    wp_enqueue_style(
        'custom-cursor-style',
        CUSTOM_CURSOR_PLUGIN_URL . 'assets/css/custom-cursor.css',
        array(),
        '1.1'
    );

    wp_localize_script('custom-cursor-script', 'cursorOptions', array(
        'cursorStyle' => $options['style'] ?? 'circle',
        'cursorColor' => $options['color'] ?? '#000000',
        'cursorSize'  => $options['size'] ?? '20',
    ));
}

// Thêm vào cả trang admin nếu tùy chọn được bật
add_action('admin_enqueue_scripts', 'custom_cursor_enqueue_scripts');
