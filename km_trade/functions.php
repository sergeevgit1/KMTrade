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
function km_trade_get_plural_form($n, $form1, $form2, $form5) {
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) return $form5;
    if ($n1 > 1 && $n1 < 5) return $form2;
    if ($n1 == 1) return $form1;
    return $form5;
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

function km_trade_enqueue_scripts() {
    // Отключаем лишние стили WordPress
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
    
    // Основные стили с атрибутом preload
    wp_enqueue_style(
        'km-trade-style',
        get_stylesheet_uri(),
        array(),
        filemtime(get_stylesheet_directory() . '/style.css')
    );
    add_preload_link(get_stylesheet_uri(), 'style');

    // Font Awesome подключаем только там, где используется
    if (is_front_page() || is_page_template('template-parts/catalog/page-catalog.php')) {
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
            array(),
            '5.15.4'
        );
    }

    // Swiper только на главной
    if (is_front_page()) {
        wp_enqueue_style(
            'swiper-css',
            'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css',
            array(),
            '8.0.0'
        );
        wp_enqueue_script(
            'swiper-js',
            'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js',
            array(),
            '8.0.0',
            true
        );
    }

    // Мобильное меню
    wp_enqueue_script(
        'km-trade-mobile-menu',
        get_template_directory_uri() . '/assets/js/mobile-menu.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/mobile-menu.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'km_trade_enqueue_scripts');

// Функция для добавления preload
function add_preload_link($url, $type) {
    echo '<link rel="preload" href="' . esc_url($url) . '" as="' . esc_attr($type) . '" crossorigin="anonymous">';
}

// Отложенная загрузка изображений
function km_trade_lazy_loading_images($content) {
    return preg_replace('/<img(.*?)src=/i', '<img$1loading="lazy" src=', $content);
}
add_filter('the_content', 'km_trade_lazy_loading_images');

// Оптимизация загрузки WordPress
function km_trade_optimize_loading() {
    // Отключаем emoji
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Отключаем генерацию XML-RPC и RSD ссылок
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');

    // Отключаем REST API если не используется
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('template_redirect', 'rest_output_link_header', 11);

    // Отключаем версию WordPress
    remove_action('wp_head', 'wp_generator');
}
add_action('init', 'km_trade_optimize_loading');

// Добавляем async/defer для скриптов
function km_trade_async_defer_scripts($tag, $handle, $src) {
    // Список скриптов для async загрузки
    $async_scripts = array('swiper-js');
    
    // Список скриптов для defer загрузки
    $defer_scripts = array('km-trade-mobile-menu');
    
    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'km_trade_async_defer_scripts', 10, 3);

// Включаем кэширование браузера
function km_trade_add_caching_headers() {
    if (!is_admin()) {
        header('Cache-Control: public, max-age=31536000');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
    }
}
add_action('send_headers', 'km_trade_add_caching_headers');

// Автоматическое сжатие загружаемых изображений
function km_trade_compress_images($image_data) {
    if (!isset($image_data['type']) || !in_array($image_data['type'], array('image/jpeg', 'image/png'))) {
        return $image_data;
    }

    $quality = 80; // Уровень сжатия
    $image = wp_get_image_editor($image_data['file']);
    
    if (!is_wp_error($image)) {
        $image->set_quality($quality);
        $image->save($image_data['file']);
    }
    
    return $image_data;
}
add_filter('wp_handle_upload', 'km_trade_compress_images');

/**
 * Улучшаем поиск WordPress
 */
function km_trade_improve_search($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $search_term = get_search_query();
        
        // Если поисковый запрос пустой, возвращаем пустой результат
        if (empty($search_term)) {
            $query->set('post__in', array(0));
            return;
        }

        // Очищаем поисковый запрос для собственной обработки
        $query->set('s', '');
        
        // Создаем массивы для условий поиска
        $meta_query = array('relation' => 'OR');
        $tax_query = array('relation' => 'OR');
        
        // Добавляем поиск по заголовкам через posts_where
        add_filter('posts_where', function($where) use ($search_term) {
            global $wpdb;
            $search_terms = explode(' ', $search_term);
            $title_where = array();
            
            foreach ($search_terms as $term) {
                $title_where[] = $wpdb->prepare(
                    "$wpdb->posts.post_title LIKE %s OR $wpdb->posts.post_content LIKE %s",
                    '%' . $wpdb->esc_like($term) . '%',
                    '%' . $wpdb->esc_like($term) . '%'
                );
            }
            
            if (!empty($title_where)) {
                $where .= " AND (" . implode(" OR ", $title_where) . ")";
            }
            
            return $where;
        });

        // Устанавливаем параметры запроса
        $query->set('post_type', array('post', 'page', 'product'));
        $query->set('posts_per_page', 10);
        $query->set('orderby', 'relevance');
        $query->set('meta_query', $meta_query);
        $query->set('tax_query', $tax_query);
    }
}
add_action('pre_get_posts', 'km_trade_improve_search');

/**
 * Добавляем релевантность в сортировку результатов
 */
function km_trade_search_by_title_relevance($orderby, $query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        global $wpdb;
        $search_term = get_search_query();
        $search_terms = explode(' ', $search_term);
        $relevance_parts = array();
        
        foreach ($search_terms as $term) {
            $relevance_parts[] = $wpdb->prepare(
                "IF($wpdb->posts.post_title LIKE '%%%s%%', 2, 0)",
                $term
            );
            $relevance_parts[] = $wpdb->prepare(
                "IF($wpdb->posts.post_content LIKE '%%%s%%', 1, 0)",
                $term
            );
        }
        
        $relevance = implode(' + ', $relevance_parts);
        $orderby = "($relevance) DESC, " . $orderby;
    }
    
    return $orderby;
}
add_filter('posts_orderby', 'km_trade_search_by_title_relevance', 10, 2);

/**
 * Получаем правильное склонение для результатов поиска
 */
function km_trade_get_search_plural($total) {
    return km_trade_get_plural_form(
        $total,
        'результат',
        'результата',
        'результатов'
    );
}

/**
 * Подсветка поисковых терминов
 */
function km_trade_highlight_search_terms($text) {
    if (!is_search() || empty(get_search_query())) {
        return $text;
    }

    $keys = explode(' ', get_search_query());
    $keys = array_filter($keys);
    
    if (empty($keys)) {
        return $text;
    }

    $text = wp_strip_all_tags($text);
    
    foreach ($keys as $key) {
        $key = preg_quote($key, '/');
        $text = preg_replace(
            '/(' . $key . ')/iu',
            '<mark class="bg-[#F38D19]/10 text-[#F38D19] px-1 rounded">$1</mark>',
            $text
        );
    }

    return $text;
}
add_filter('the_title', 'km_trade_highlight_search_terms');
add_filter('the_excerpt', 'km_trade_highlight_search_terms');

/**
 * Отключаем страницы товаров WooCommerce
 */
function km_trade_disable_product_pages() {
    // Отключаем просмотр отдельных товаров
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    
    // Перенаправляем со страниц товаров на каталог
    if (is_product()) {
        wp_redirect(get_permalink(get_page_by_path('catalog')));
        exit;
    }
}
add_action('template_redirect', 'km_trade_disable_product_pages');

/**
 * Удаляем ссылки на товары в каталоге
 */
function km_trade_remove_product_links($html, $product) {
    return strip_tags($html);
}
add_filter('woocommerce_get_product_thumbnail', 'km_trade_remove_product_links', 10, 2);

/**
 * Отключаем генерацию ненужных страниц и функций WooCommerce
 */
function km_trade_disable_wc_features() {
    // Отключаем корзину и оформление заказа
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    
    // Отключаем вкладки на странице товара
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    
    // Отключаем связанные товары
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    
    // Отключаем отзывы
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_review_order_before_submit', 'woocommerce_checkout_privacy_policy_text', 10);
}
add_action('init', 'km_trade_disable_wc_features');

/**
 * Отключаем ненужные эндпоинты WooCommerce API
 */
function km_trade_disable_wc_rest_endpoints($endpoints) {
    $disabled_endpoints = [
        'product',
        'product_variation',
        'product_attribute',
        'product_cat',
        'product_shipping_class',
        'product_tag'
    ];

    foreach ($disabled_endpoints as $endpoint) {
        if (isset($endpoints['/wc/v3/' . $endpoint])) {
            unset($endpoints['/wc/v3/' . $endpoint]);
        }
    }
    
    return $endpoints;
}
add_filter('rest_endpoints', 'km_trade_disable_wc_rest_endpoints');

function km_trade_pagination() {
    global $wp_query;
    
    if ($wp_query->max_num_pages <= 1) {
        return;
    }
    
    $big = 999999999;
    
    echo '<div class="pagination">';
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'type' => 'list'
    ));
    echo '</div>';
}

// Изменяем поведение поиска
function km_trade_redirect_search() {
    if (is_search() && !is_admin()) {
        $search_query = get_search_query();
        $catalog_url = home_url('/catalog/');
        
        // Добавляем параметр поиска к URL каталога, используя параметр table-search
        $redirect_url = add_query_arg('table-search', urlencode($search_query), $catalog_url);
        
        wp_redirect($redirect_url);
        exit;
    }
}
add_action('template_redirect', 'km_trade_redirect_search');

// Переопределяем стандартную форму поиска WordPress
function km_trade_custom_search_form($form) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/catalog/')) . '">
        <div class="relative">
            <input type="search" 
                   name="table-search" 
                   class="w-full h-[40px] px-4 rounded-l-[5px] border border-zinc-200 focus:outline-none focus:border-[#F38D19] text-[14px]" 
                   placeholder="Поиск запчастей..."
                   value="' . (isset($_GET['table-search']) ? esc_attr($_GET['table-search']) : '') . '"
            >
            <button type="submit" 
                    class="h-[40px] px-6 bg-[#F38D19] text-white font-medium rounded-r-[5px] hover:bg-[#E07D08] transition-colors">
                Найти
            </button>
        </div>
    </form>';
    return $form;
}
add_filter('get_search_form', 'km_trade_custom_search_form');
