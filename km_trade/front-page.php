<?php
/**
 * Шаблон главной страницы
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

/**
 * Получаем значения по умолчанию для всех секций
 */
$defaults = km_trade_get_home_defaults();

// Hero секция с основным предложением
get_template_part('template-parts/home/hero', null, [
    'hero_defaults' => $defaults['hero']
]);

// Секция поиска запчастей
get_template_part('template-parts/home/search-section');

// Шаги оформления заказа
?>
<div class="order-steps hidden lg:block">
    <?php get_template_part('template-parts/home/steps', null, [
        'steps_defaults' => $defaults['order_steps']
    ]); ?>
</div>
<?php

// Каталог продукции
get_template_part('template-parts/home/catalog-section');

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
