<?php

function custom_cursor_create_menu()
{
    add_menu_page(
        'Custom Cursor Settings',
        'Custom Cursor',
        'manage_options',
        'custom-cursor-settings',
        'custom_cursor_settings_page',
        'dashicons-admin-customizer'
    );
}

function custom_cursor_register_settings()
{
    register_setting('custom_cursor_settings_group', 'custom_cursor_settings');
}

function custom_cursor_settings_page()
{
    $options = get_option('custom_cursor_settings');
    $current_color = esc_attr($options['color'] ?? '#000000'); // Default color is black
?>
    <div class="wrap">
        <h1>Custom Cursor Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('custom_cursor_settings_group'); ?>
            <?php do_settings_sections('custom_cursor_settings_group'); ?>

            <table class="form-table">
                <!-- Enable/Disable Custom Cursor -->
                <tr valign="top">
                    <th scope="row">Enable Custom Cursor</th>
                    <td>
                        <input type="checkbox" id="custom_cursor_enabled" name="custom_cursor_settings[enabled]" value="1" <?php checked($options['enabled'] ?? '', '1'); ?>>
                        <label for="custom_cursor_enabled">Enable custom cursor</label>
                    </td>
                </tr>

                <!-- Cursor Style Selection -->
                <tr valign="top" class="custom-cursor-config" style="<?php echo empty($options['enabled']) ? 'display: none;' : ''; ?>">
                    <th scope="row">Cursor Style</th>
                    <td>
                        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                            <?php
                            $styles = [
                                'circle' => '<circle cx="50" cy="50" r="50" fill="' . $current_color . '"/>',
                                'triangle' => '<polygon points="50,0 0,100 100,100" fill="' . $current_color . '"/>',
                                'star' => '<polygon points="50,0 61,35 98,35 68,57 79,91 50,70 21,91 32,57 2,35 39,35" fill="' . $current_color . '"/>',
                                'square' => '<rect x="10" y="10" width="80" height="80" fill="' . $current_color . '"/>',
                                'diamond' => '<polygon points="50,0 100,50 50,100 0,50" fill="' . $current_color . '"/>',
                                'cross' => '<path d="M45 0 H55 V45 H100 V55 H55 V100 H45 V55 H0 V45 H45 Z" fill="' . $current_color . '"/>',
                            ];

                            foreach ($styles as $key => $svg) {
                                echo '
                                    <label style="text-align: center; display: inline-block;">
                                        <input type="radio" name="custom_cursor_settings[style]" value="' . $key . '" ' . checked($options['style'] ?? '', $key, false) . '>
                                        <div style="width: 50px; height: 50px; margin-top: 10px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" style="width: 100%; height: 100%;">' . $svg . '</svg>
                                        </div>
                                        ' . ucfirst($key) . '
                                    </label>
                                ';
                            }
                            ?>
                        </div>
                    </td>
                </tr>

                <!-- Cursor Size -->
                <tr valign="top" class="custom-cursor-config" style="<?php echo empty($options['enabled']) ? 'display: none;' : ''; ?>">
                    <th scope="row">Cursor Size</th>
                    <td>
                        <input type="range" name="custom_cursor_settings[size]" min="10" max="100" value="<?php echo esc_attr($options['size'] ?? '20'); ?>">
                        <span><?php echo esc_attr($options['size'] ?? '20'); ?> px</span>
                    </td>
                </tr>

                <!-- Cursor Color -->
                <tr valign="top" class="custom-cursor-config" style="<?php echo empty($options['enabled']) ? 'display: none;' : ''; ?>">
                    <th scope="row">Cursor Color</th>
                    <td>
                        <input type="color" id="custom_cursor_color" name="custom_cursor_settings[color]" value="<?php echo $current_color; ?>">
                    </td>
                </tr>

                <!-- Apply in Admin -->
                <tr valign="top">
                    <th scope="row">Apply in Admin</th>
                    <td>
                        <input type="checkbox" name="custom_cursor_settings[apply_in_admin]" value="1" <?php checked($options['apply_in_admin'] ?? '', '1'); ?>>
                        <label for="custom_cursor_apply_in_admin">Enable custom cursor in admin pages</label>
                    </td>
                </tr>

            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <script>
        // Update preview colors in real-time
        document.getElementById('custom_cursor_color').addEventListener('input', function() {
            const newColor = this.value;
            document.querySelectorAll('svg').forEach(svg => {
                svg.querySelectorAll('*').forEach(shape => shape.setAttribute('fill', newColor));
            });
        });

        // Toggle visibility of configurations
        document.getElementById('custom_cursor_enabled').addEventListener('change', function() {
            const configRows = document.querySelectorAll('.custom-cursor-config');
            configRows.forEach(row => {
                row.style.display = this.checked ? '' : 'none';
            });
        });
    </script>
<?php
}
?>