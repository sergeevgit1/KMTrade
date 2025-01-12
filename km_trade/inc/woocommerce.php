<?php
if (!defined('ABSPATH')) {
    exit;
}

// Перенаправление с product-category на страницу каталога с фильтрами
function km_trade_redirect_product_category() {
    if (!function_exists('is_product_category')) {
        return;
    }

    if (is_product_category()) {
        $category = get_queried_object();
        $catalog_url = home_url('/catalog/');
        $redirect_url = add_query_arg(array(
            'product_cat' => $category->slug,
            'filter' => 'category'
        ), $catalog_url);
        
        wp_redirect($redirect_url);
        exit;
    }
}
add_action('template_redirect', 'km_trade_redirect_product_category', 5);

// Модифицируем ссылки категорий
function km_trade_modify_category_links($url, $term, $taxonomy) {
    if ($taxonomy === 'product_cat') {
        $catalog_url = home_url('/catalog/');
        return add_query_arg(array(
            'product_cat' => $term->slug,
            'filter' => 'category'
        ), $catalog_url);
    }
    return $url;
}
add_filter('term_link', 'km_trade_modify_category_links', 10, 3);
