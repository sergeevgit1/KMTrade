<?php
/**
 * Шаблон главной страницы
 * 
 * Основной шаблон для отображения главной страницы сайта.
 * Подключает все необходимые секции в нужном порядке.
 * 
 * Структура страницы:
 * 1. Hero секция с основным предложением
 * 2. Секция поиска запчастей
 * 3. Каталог продукции
 * 4. О компании
 * 5. Шаги оформления заказа
 * 6. Блог
 * 7. FAQ
 * 8. Контактная форма
 *
 * @package KM_Trade
 * @version 1.0.0
 * 
 * Использует функцию km_trade_get_home_defaults() для получения настроек секций
 * @see km_trade_get_home_defaults()
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

/**
 * Получаем значения по умолчанию для всех секций
 * 
 * @var array $defaults {
 *     Массив настроек для секций главной страницы
 * 
 *     @type array $hero        Настройки hero секции
 *     @type array $about       Настройки секции "О компании"
 *     @type array $order_steps Настройки секции с шагами заказа
 *     @type array $faq        Настройки FAQ секции
 *     @type array $contact    Настройки контактной формы
 * }
 */
$defaults = km_trade_get_home_defaults();

// Hero секция с основным предложением
get_template_part('template-parts/home/hero', null, [
    'hero_defaults' => $defaults['hero']
]);

// Секция поиска запчастей
get_template_part('template-parts/home/search-section');

// Шаги оформления заказа
get_template_part('template-parts/home/steps', null, [
    'steps_defaults' => $defaults['order_steps']
]);

// Каталог продукции
get_template_part('template-parts/home/catalog-section');

// Преимущества компании (отключено)
// get_template_part('template-parts/home/advantages');

// О компании
get_template_part('template-parts/home/about', null, [
    'about_defaults' => $defaults['about']
]);

// Блог
get_template_part('template-parts/home/blog');

// FAQ
get_template_part('template-parts/home/faq', null, [
    'faq_defaults' => $defaults['faq']
]);

// Контактная форма
get_template_part('template-parts/home/contact', null, [
    'contact_defaults' => $defaults['contact']
]);

get_footer();
?>
