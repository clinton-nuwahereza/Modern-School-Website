<?php
function author_personal_blog_export_customizer_settings_to_json() {
    $theme = get_option('stylesheet');
    $theme_mods = get_theme_mods();

    // Add image URLs for logos
    if (isset($theme_mods['custom_logo'])) {
        $theme_mods['custom_logo_url'] = wp_get_attachment_url($theme_mods['custom_logo']);
    }
    if (isset($theme_mods['footer_logo'])) {
        $theme_mods['footer_logo_url'] = wp_get_attachment_url($theme_mods['footer_logo']);
    }

    $json_data = json_encode($theme_mods, JSON_PRETTY_PRINT);
    $file = wp_upload_dir()['basedir'] . "/customizer-export-{$theme}.json";
    file_put_contents($file, $json_data);
    return $file;
}

// Trigger export via URL
add_action('admin_init', function () {
    if (isset($_GET['export_customizer'])) {
        $file = author_personal_blog_export_customizer_settings_to_json();
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="customizer-export.json"');
        readfile($file);
        exit;
    }
});

function author_personal_blog_export_widgets_to_json() {
    // Get all active widgets
    $widgets = get_option('sidebars_widgets');

    // Prepare the widget data
    $export_data = [];
    foreach ($widgets as $sidebar => $widget_ids) {
        if (!is_array($widget_ids) || empty($widget_ids)) {
            continue;
        }

        foreach ($widget_ids as $widget_id) {
            $widget_base_id = preg_replace('/-\d+$/', '', $widget_id);
            $widget_data = get_option('widget_' . $widget_base_id);

            if (!empty($widget_data)) {
                $export_data[$sidebar][$widget_id] = $widget_data;
            }
        }
    }

    // Convert to JSON
    $json_data = json_encode($export_data, JSON_PRETTY_PRINT);

    // Save to a file
    $file = wp_upload_dir()['basedir'] . '/widgets-export.json';
    file_put_contents($file, $json_data);

    return $file;
}

// Example usage
add_action('admin_init', function () {
    if (isset($_GET['export_widgets'])) {
        $file = author_personal_blog_export_widgets_to_json();
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="widgets-export.json"');
        readfile($file);
        exit;
    }
});