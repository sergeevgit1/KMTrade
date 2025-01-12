<?php
if (!defined('ABSPATH')) {
    exit;
}

// Определяем константы
define('KM_TRADE_VERSION', '1.0.0');
define('KM_TRADE_DIR', get_template_directory());
define('KM_TRADE_URI', get_template_directory_uri());

// Подключаем файлы
require_once KM_TRADE_DIR . '/inc/setup.php';
require_once KM_TRADE_DIR . '/inc/defaults/home-defaults.php';
require_once KM_TRADE_DIR . '/inc/customizer.php';
require_once KM_TRADE_DIR . '/inc/filters.php';
require_once KM_TRADE_DIR . '/inc/ajax-handlers.php';

// Подключаем файл с глобальными настройками
require get_template_directory() . '/inc/global-settings.php';

// Подключаем класс навигации
require_once get_template_directory() . '/inc/class-km-trade-nav-walker.php';

/**
 * Функция для склонения существительных после числительных
 *
 * @param int $number Число
 * @param string $one Форма для 1
 * @param string $two Форма для 2-4
 * @param string $many Форма для 5-20
 * @return string
 */
function km_trade_get_plural_form($number, $one, $two, $many) {
    $number = abs($number) % 100;
    
    if ($number > 10 && $number < 20) {
        return $many;
    }
    
    $last_digit = $number % 10;
    
    if ($last_digit === 1) {
        return $one;
    }
    
    if ($last_digit >= 2 && $last_digit <= 4) {
        return $two;
    }
    
    return $many;
}

/**
 * Регистрация меню сайта
 */
function km_trade_register_menus() {
    register_nav_menus([
        'header_menu' => 'Главное меню',
        'footer_menu' => 'Меню в футере', // Добавляем меню для футера
    ]);
}
add_action('init', 'km_trade_register_menus');

function km_trade_enqueue_styles() {
    // Основные стили темы
    wp_enqueue_style('km-trade-style', get_stylesheet_uri(), array(), KM_TRADE_VERSION);
    
    // Font Awesome для иконок
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4');
    
    // Bootstrap если используется
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', array(), '5.1.3');
    
    // Компоненты темы
    wp_enqueue_style('km-trade-components', get_template_directory_uri() . '/assets/css/components.css', array('bootstrap'), KM_TRADE_VERSION);
}
add_action('wp_enqueue_scripts', 'km_trade_enqueue_styles');

class KM_Trade_Button_Nav_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        if ($args->theme_location === 'catalog-menu') {
            $output .= sprintf(
                '<a href="%s" class="flex items-center gap-2 bg-brand-orange px-6 py-2.5 hover:bg-brand-orange-dark transition-colors rounded-lg">
                    <svg class="w-5 h-5 !text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="!text-white !font-bold">%s</span>
                </a>',
                esc_url($item->url),
                esc_html($item->title)
            );
        } elseif ($args->theme_location === 'quick-order-menu') {
            $output .= sprintf(
                '<a href="%s" class="bg-black px-6 py-2.5 hover:bg-brand-orange transition-colors rounded-lg">
                    <span class="!text-white !font-bold">%s</span>
                </a>',
                esc_url($item->url),
                esc_html($item->title)
            );
        }
    }
}

function km_trade_enqueue_catalog_scripts() {
    if (is_page_template('template-parts/catalog/page-catalog.php')) {
        wp_enqueue_script('km-trade-catalog-filters', 
            get_template_directory_uri() . '/assets/js/catalog/filters.js', 
            array('jquery'), 
            '1.0', 
            true
        );

        wp_localize_script('km-trade-catalog-filters', 'kmTradeData', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('km_trade_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'km_trade_enqueue_catalog_scripts');
