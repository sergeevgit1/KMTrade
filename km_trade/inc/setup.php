<?php
if (!defined('ABSPATH')) {
    exit;
}

// Подключаем класс для меню
require_once KM_TRADE_DIR . '/inc/classes/class-km-trade-nav-walker.php';
require_once KM_TRADE_DIR . '/inc/classes/class-km-trade-mobile-nav-walker.php';
require_once KM_TRADE_DIR . '/inc/classes/class-km-trade-footer-nav-walker.php';

/**
 * Настройка темы
 */
function km_trade_setup() {
    // Поддержка заголовка
    add_theme_support('title-tag');

    // Поддержка миниатюр
    add_theme_support('post-thumbnails');

    // Поддержка HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Регистрируем меню
    register_nav_menus(array(
        'top' => __('Верхнее меню', 'km-trade'),
        'primary' => __('Основное меню', 'km-trade'),
        'footer' => __('Меню в подвале', 'km-trade'),
    ));
}
add_action('after_setup_theme', 'km_trade_setup');

/**
 * Подключаем скрипты и стили
 */
function km_trade_scripts() {
    // Стили Tailwind из CDN
    wp_enqueue_style(
        'tailwindcss',
        'https://unpkg.com/tailwindcss@3.3.0/dist/tailwind.min.css',
        array(),
        '3.3.0'
    );

    // Alpine.js для интерактивности
    wp_enqueue_script(
        'alpinejs',
        'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js',
        array(),
        '3.0.0',
        true
    );

    // Inter font
    wp_enqueue_style(
        'inter-font',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Кастомные стили
    wp_enqueue_style(
        'km-trade-custom',
        KM_TRADE_URI . '/assets/css/custom.css',
        array('tailwindcss', 'inter-font'),
        KM_TRADE_VERSION
    );

    // Скрипты
    wp_enqueue_script(
        'km-trade-scripts',
        KM_TRADE_URI . '/assets/js/scripts.js',
        array('jquery'),
        KM_TRADE_VERSION,
        true
    );

    // Локализация скриптов
    wp_localize_script('km-trade-scripts', 'kmTradeData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'orderNonce' => wp_create_nonce('order_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'km_trade_scripts');
