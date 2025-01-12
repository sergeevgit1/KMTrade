<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Регистрируем сайдбар для фильтров каталога
 */
function km_trade_widgets_init() {
    register_sidebar(array(
        'name'          => __('Фильтры каталога', 'km-trade'),
        'id'            => 'catalog-filters',
        'description'   => __('Добавьте сюда виджеты для фильтрации товаров', 'km-trade'),
        'before_widget' => '<div class="mb-8">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="font-medium mb-4">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'km_trade_widgets_init');

/**
 * Добавляем поддержку AJAX для фильтров
 */
function km_trade_add_ajax_filters() {
    if (is_shop() || is_product_category()) {
        wp_enqueue_script(
            'km-trade-filters',
            KM_TRADE_URI . '/assets/js/filters.js',
            array('jquery'),
            KM_TRADE_VERSION,
            true
        );

        wp_localize_script('km-trade-filters', 'kmTradeFilters', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('km_trade_filters')
        ));
    }
}
add_action('wp_enqueue_scripts', 'km_trade_add_ajax_filters');

/**
 * Обработчик AJAX запроса для фильтров
 */
function km_trade_filter_products() {
    check_ajax_referer('km_trade_filters', 'nonce');

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => get_option('posts_per_page'),
    );

    // Добавляем параметры фильтрации
    if (!empty($_POST['min_price'])) {
        $args['meta_query'][] = array(
            'key' => '_price',
            'value' => floatval($_POST['min_price']),
            'compare' => '>=',
            'type' => 'NUMERIC'
        );
    }

    if (!empty($_POST['max_price'])) {
        $args['meta_query'][] = array(
            'key' => '_price',
            'value' => floatval($_POST['max_price']),
            'compare' => '<=',
            'type' => 'NUMERIC'
        );
    }

    // Добавляем фильтрацию по атрибутам
    if (!empty($_POST['attributes'])) {
        foreach ($_POST['attributes'] as $taxonomy => $terms) {
            if (!empty($terms)) {
                $args['tax_query'][] = array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => array_map('intval', $terms),
                    'operator' => 'IN'
                );
            }
        }
    }

    $query = new WP_Query($args);
    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part('content', 'product');
        }
    } else {
        echo '<div class="text-center py-12"><p class="text-gray-500">Товары не найдены</p></div>';
    }

    wp_reset_postdata();
    $html = ob_get_clean();

    wp_send_json_success(array(
        'html' => $html,
        'found' => $query->found_posts
    ));
}
add_action('wp_ajax_km_trade_filter_products', 'km_trade_filter_products');
add_action('wp_ajax_nopriv_km_trade_filter_products', 'km_trade_filter_products');
