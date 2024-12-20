<?php
/**
 * Основные функции темы
 * 
 * Этот файл содержит основные функции и настройки темы:
 * - Подключение стилей и скриптов
 * - Регистрация меню
 * - Поддержка различных возможностей темы
 * - Проверка пустых терминов
 * 
 * @package KMTrade
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Подключение стилей и скриптов
function kmtrade_scripts() {
    wp_enqueue_style('kmtrade-style', get_stylesheet_uri());
    wp_enqueue_style('kmtrade-main', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('kmtrade-responsive', get_template_directory_uri() . '/assets/css/responsive.css');
    wp_enqueue_script('kmtrade-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'kmtrade_scripts');

// Регистрация меню
function kmtrade_menus() {
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'kmtrade'),
        'footer' => esc_html__('Footer Menu', 'kmtrade'),
    ));
}
add_action('init', 'kmtrade_menus');

// Поддержка темы
function kmtrade_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'kmtrade_setup');

// Добавьте эту функцию в functions.php
function kmtrade_check_empty_terms() {
    if (is_tax() || is_category() || is_tag()) {
        $queried_object = get_queried_object();
        if ($queried_object && !get_term_children($queried_object->term_id, $queried_object->taxonomy)) {
            if (!have_posts()) {
                global $wp_query;
                $wp_query->set_404();
                status_header(404);
            }
        }
    }
}
add_action('wp', 'kmtrade_check_empty_terms'); 