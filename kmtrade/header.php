<?php
/**
 * Шаблон шапки сайта
 * 
 * Отображает шапку сайта, включая:
 * - Мета-теги
 * - Логотип
 * - Основное меню
 * - Поиск
 * - Переключатель темы
 * 
 * @package KMTrade
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="topbar">
        <div class="container">
            <div class="logo">
                <?php if (has_custom_logo()) : ?>
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link" data-test-404="true">
                        <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link" data-test-404="true">
                        <?php echo esc_html(get_bloginfo('name')); ?>
                    </a>
                <?php endif; ?>
            </div>
            
            <div class="search-form">
                <?php get_search_form(); ?>
            </div>
            
            <div class="header-info">
                <div class="header-contacts">
                    <div class="phone">
                        <a href="tel:+79999999999">+7 (999) 999-99-99</a>
                    </div>
                    <div class="working-hours">
                        Пн-Пт: 9:00 - 18:00
                    </div>
                </div>
                <a href="/my-order" class="my-order-btn">Мой заказ</a>
            </div>
        </div>
    </div>
    
    <div class="mainbar">
        <div class="container">
            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
            </nav>
        </div>
    </div>
</header>
</rewritten_file> 