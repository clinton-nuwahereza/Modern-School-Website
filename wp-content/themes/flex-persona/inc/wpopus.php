<?php
/**
 * functions and hooks for wpopus
 *
 * @package flex-persona
 */

if (!function_exists('flex_persona_theme_constant')):
    /**
     * theme details for wpopus 
     *
     * @since 1.0
     * @return void
     */
    function flex_persona_theme_constant()
    {
        $theme = wp_get_theme();
        $args = array(
            'theme_name' => $theme->get('Name'),
            'theme_author' => $theme->get('Author'),
            'demo_and_template_route_url' => 'https://wpopus.com',
            'theme_quick_links' => array(
                array(
                    'label' => esc_html__('Theme Documentation', 'flex-persona'),
                    'url' => 'https://wpopus.com/docs-category/themes/',
                ),
                array(
                    'label' => esc_html__('All Themes', 'flex-persona'),
                    'url' => 'https://wpopus.com/themes/',
                ),
            ),
        );
        return $args;
    }
endif;
add_filter('wpopus_theme_constant_filter', 'flex_persona_theme_constant');

// show admin notice
if (!function_exists('flex_persona_admin_notice')) {
    function flex_persona_admin_notice()
    {
        // Check if we're on the dashboard/index.php
        $screen = get_current_screen();
        if ($screen->id !== 'dashboard') {
            return;
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        // return if plugin exists
        if (function_exists('wpopus_pro') || function_exists('wpopus')) {
            return;
        }

        $theme = wp_get_theme();
        ?>
        <div class="notice notice-info is-dismissible">
            <h2><?php esc_html_e('Transform your website with the power of wpOpus - The Ultimate Gutenberg Toolkit and Site Builder.', 'flex-persona'); ?></h2>
            <p><?php printf('<b>%1$s</b> %2$s', esc_html($theme->get('Name')), esc_html__('is supported by wpOpus plugin, making it easy to create stunning websites with advanced blocks, pre-built templates, demo imports and powerful features!', 'flex-persona')); ?>
            </p>
            <p>
                <button id="install-wpopus"
                    class="button button-primary"><?php esc_html_e('Install and Activate', 'flex-persona'); ?></button>
                <a href="https://wpopus.com/" target="_blank"
                    class="button button-secondary"><?php esc_html_e('Learn More', 'flex-persona'); ?></a>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'flex_persona_admin_notice');

function flex_persona_admin_enqueue_scripts($hook)
{
    if ('index.php' !== $hook) {
        return;
    }

    if (!current_user_can('manage_options')) {
        return;
    }

    // return if plugin exists
    if (function_exists('wpopus_pro') || function_exists('wpopus')) {
        return;
    }

    wp_enqueue_script(
        'flex-persona-admin-js',
        get_template_directory_uri() . '/assets/js/admin.js',
        ['jquery'],
        '1.0',
        true
    );

    wp_localize_script('flex-persona-admin-js', 'wpopusAjax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('install_wpopus_nonce'),
        'label' => esc_html__('Install and Activate', 'flex-persona'),
        'success_label' => esc_html__('Installed and Activated', 'flex-persona'),
    ]);
}
add_action('admin_enqueue_scripts', 'flex_persona_admin_enqueue_scripts');

// install and activate wpopus
function flex_persona_install_and_activate_plugin()
{
    // Check if the current user has the capability to manage options
    if (!current_user_can('manage_options')) {
        wp_send_json_error(['message' => esc_html__('You are not authorized to perform this action.', 'flex-persona')]);
    }

    // Verify if the nonce is set and valid
    if (!isset($_POST['nonce'])) {
        wp_send_json_error(['message' => esc_html__('Nonce is missing.', 'flex-persona')]);
    }

    check_ajax_referer('install_wpopus_nonce', 'nonce');

    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    $plugin_slug = 'wpopus';
    $plugin_file = $plugin_slug . '/' . $plugin_slug . '.php';

    // Check if the plugin exists in the plugins directory
    if (file_exists(WP_PLUGIN_DIR . '/' . $plugin_file)) {
        // Plugin exists, activate it
        $activate = activate_plugin($plugin_file);

        if (is_wp_error($activate)) {
            wp_send_json_error(['message' => $activate->get_error_message()]);
        }

        wp_send_json_success(['message' => esc_html__('wpOpus activated successfully!', 'flex-persona')]);
    }

    // Plugin does not exist, proceed to install it
    $api = plugins_api('plugin_information', ['slug' => $plugin_slug]);

    if (is_wp_error($api)) {
        wp_send_json_error(['message' => $api->get_error_message()]);
    }

    $upgrader = new Plugin_Upgrader();
    $result = $upgrader->install($api->download_link);

    if (is_wp_error($result)) {
        wp_send_json_error(['message' => $result->get_error_message()]);
    }

    // Activate the plugin after installation
    $activate = activate_plugin($plugin_file);

    if (is_wp_error($activate)) {
        wp_send_json_error(['message' => $activate->get_error_message()]);
    }

    wp_send_json_success(['message' => esc_html__('wpOpus installed and activated successfully!', 'flex-persona')]);
}
add_action('wp_ajax_install_wpopus_plugin', 'flex_persona_install_and_activate_plugin');

