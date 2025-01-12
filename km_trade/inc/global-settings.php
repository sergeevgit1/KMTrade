<?php
if (!defined('ABSPATH')) {
    exit;
}

function km_trade_register_global_settings() {
    register_setting(
        'km_trade_settings',
        'km_trade_contact_address',
        array(
            'type'         => 'string',
            'show_in_rest' => true,
            'default'      => 'г. Москва, ул. Примерная, 123',
        )
    );

    register_setting(
        'km_trade_settings',
        'km_trade_work_hours',
        array(
            'type'         => 'string',
            'show_in_rest' => true,
            'default'      => 'Пн-Пт: 9:00-18:00',
        )
    );

    register_setting(
        'km_trade_settings',
        'km_trade_phone',
        array(
            'type'         => 'string',
            'show_in_rest' => true,
            'default'      => '+7 (999) 123-45-67',
        )
    );
}
add_action('init', 'km_trade_register_global_settings');

function km_trade_add_settings_page() {
    add_action('admin_menu', function() {
        add_menu_page(
            'Глобальные настройки',
            'Глобальные настройки',
            'manage_options',
            'km-trade-settings',
            function() {
                echo '<div id="km-trade-settings"></div>';
            },
            'dashicons-admin-generic',
            20
        );
    });

    add_action('admin_enqueue_scripts', function($hook) {
        if ('toplevel_page_km-trade-settings' !== $hook) {
            return;
        }

        wp_enqueue_script(
            'km-trade-settings',
            get_template_directory_uri() . '/js/settings.js',
            array('wp-api', 'wp-components', 'wp-element', 'wp-i18n'),
            filemtime(get_template_directory() . '/js/settings.js'),
            true
        );
    });
}
add_action('init', 'km_trade_add_settings_page'); 