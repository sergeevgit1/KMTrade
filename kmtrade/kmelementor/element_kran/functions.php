<?php
if (!defined('ABSPATH')) {
    exit;
}

// Поддержка основных возможностей WordPress
function crane_parts_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('elementor'); // Поддержка Elementor
}
add_action('after_setup_theme', 'crane_parts_setup');

// Регистрация меню
function crane_parts_menus() {
    register_nav_menus(array(
        'primary' => __('Главное меню', 'crane-parts'),
        'footer' => __('Меню в подвале', 'crane-parts'),
    ));
}
add_action('init', 'crane_parts_menus');

// Подключение стилей и скриптов
function crane_parts_scripts() {
    wp_enqueue_style('crane-parts-theme', get_template_directory_uri() . '/style.css', array(), '1.0');
    wp_enqueue_script('crane-parts-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true);
    wp_enqueue_script('crane-parts-search', get_template_directory_uri() . '/js/search.js', array(), '1.0', true);
    wp_localize_script('crane-parts-search', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('crane_parts_search_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'crane_parts_scripts');

// Кастомный walker для меню
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    private $excluded_items = array('каталог', 'мой заказ');

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Пропускаем элементы "Каталог" и "Мой заказ"
        $title_lower = mb_strtolower(trim($item->title));
        if (in_array($title_lower, $this->excluded_items)) {
            return;
        }

        $output .= sprintf(
            '<a href="%s" class="text-gray-600 hover:text-gray-900">%s</a>',
            esc_url($item->url),
            esc_html($item->title)
        );
    }
}

// Добавляем настройки темы
function crane_parts_customize_register($wp_customize) {
    // Секция контактной информации
    $wp_customize->add_section('contact_info', array(
        'title' => 'Контактная информация',
        'priority' => 30,
    ));

    // Настройка номера телефона
    $wp_customize->add_setting('phone_number', array(
        'default' => '+7 (XXX) XXX-XX-XX',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('phone_number', array(
        'label' => 'Номер телефона',
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // Настройка часов работы
    $wp_customize->add_setting('work_hours', array(
        'default' => 'Пн-Пт: 9:00 - 18:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('work_hours', array(
        'label' => 'Часы работы',
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // Секция "Подвал сайта"
    $wp_customize->add_section('footer_settings', array(
        'title' => 'Настройки подвала',
        'priority' => 35,
    ));

    // О компании в подвале
    $wp_customize->add_setting('footer_about', array(
        'default' => 'Поставка запчастей для башенных кранов с 2010 года.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_about', array(
        'label' => 'Текст о компании',
        'section' => 'footer_settings',
        'type' => 'textarea',
    ));

    // Социальные сети
    $social_networks = array(
        'vk' => 'VKontakte',
        'telegram' => 'Telegram',
        'whatsapp' => 'WhatsApp'
    );

    foreach ($social_networks as $key => $label) {
        $wp_customize->add_setting('social_' . $key, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('social_' . $key, array(
            'label' => $label,
            'section' => 'footer_settings',
            'type' => 'url',
        ));
    }

    // Email для контактов
    $wp_customize->add_setting('contact_email', array(
        'default' => 'info@example.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label' => 'Email',
        'section' => 'contact_info',
        'type' => 'email',
    ));

    // Адрес
    $wp_customize->add_setting('contact_address', array(
        'default' => 'г. Москва, ул. Примерная, д. 1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label' => 'Адрес',
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // Секция "Стили темы"
    $wp_customize->add_section('theme_styles', array(
        'title' => 'Стили темы',
        'priority' => 25,
    ));

    // Основной цвет (оранжевый)
    $wp_customize->add_setting('primary_color', array(
        'default' => '#f97316', // orange-500
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => 'Основной цвет',
        'section' => 'theme_styles',
    )));

    // Цвет при наведении
    $wp_customize->add_setting('primary_hover_color', array(
        'default' => '#ea580c', // orange-600
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_hover_color', array(
        'label' => 'Цвет при наведении',
        'section' => 'theme_styles',
    )));

    // Цвет текста на темном фоне
    $wp_customize->add_setting('dark_bg_color', array(
        'default' => '#111827', // gray-900
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dark_bg_color', array(
        'label' => 'Цвет темного фона',
        'section' => 'theme_styles',
    )));

    // Радиус скругления для кнопок
    $wp_customize->add_setting('button_radius', array(
        'default' => '0.5rem', // rounded-lg
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('button_radius', array(
        'label' => 'Скругление кнопок',
        'section' => 'theme_styles',
        'type' => 'select',
        'choices' => array(
            '0.25rem' => 'Малое',
            '0.5rem' => 'Среднее',
            '0.75rem' => 'Большое',
            '9999px' => 'Круглое'
        )
    ));

    // Радиус скругления для карточек
    $wp_customize->add_setting('card_radius', array(
        'default' => '0.5rem',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('card_radius', array(
        'label' => 'Скругление карточек',
        'section' => 'theme_styles',
        'type' => 'select',
        'choices' => array(
            '0.25rem' => 'Малое',
            '0.5rem' => 'Среднее',
            '0.75rem' => 'Большое',
            '9999px' => 'Круглое'
        )
    ));

    // Секция настроек 404 страницы
    $wp_customize->add_section('404_settings', array(
        'title' => 'Настройки 404 страницы',
        'priority' => 40,
    ));

    // Заголовок
    $wp_customize->add_setting('404_title', array(
        'default' => 'Страница не найдена',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('404_title', array(
        'label' => 'Заголовок',
        'section' => '404_settings',
        'type' => 'text',
    ));

    // Описание
    $wp_customize->add_setting('404_description', array(
        'default' => 'К сожалению, запрашиваемая страница не существует или была перемещена. Возможно, вы перешли по устаревшей ссылке или неверно ввели адрес.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('404_description', array(
        'label' => 'Описание',
        'section' => '404_settings',
        'type' => 'textarea',
    ));

    // Полезные ссылки (до 3-х штук)
    for ($i = 1; $i <= 3; $i++) {
        // Название ссылки
        $wp_customize->add_setting('404_link_' . $i . '_title', array(
            'default' => $i == 1 ? 'Главная страница' : ($i == 2 ? 'Каталог запчастей' : 'Связаться с нами'),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('404_link_' . $i . '_title', array(
            'label' => 'Ссылка ' . $i . ' - Название',
            'section' => '404_settings',
            'type' => 'text',
        ));

        // URL ссылки
        $wp_customize->add_setting('404_link_' . $i . '_url', array(
            'default' => $i == 1 ? home_url('/') : ($i == 2 ? get_permalink(wc_get_page_id('shop')) : '/contacts'),
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('404_link_' . $i . '_url', array(
            'label' => 'Ссылка ' . $i . ' - URL',
            'section' => '404_settings',
            'type' => 'url',
        ));

        // Иконка ссылки
        $wp_customize->add_setting('404_link_' . $i . '_icon', array(
            'default' => $i == 1 ? 'home' : ($i == 2 ? 'shopping-bag' : 'mail'),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('404_link_' . $i . '_icon', array(
            'label' => 'Ссылка ' . $i . ' - Иконка',
            'section' => '404_settings',
            'type' => 'select',
            'choices' => array(
                'home' => 'Домик',
                'shopping-bag' => 'Корзина',
                'mail' => 'Конверт',
                'phone' => 'Телефон',
                'document' => 'Документ',
                'search' => 'Поиск'
            )
        ));
    }
}
add_action('customize_register', 'crane_parts_customize_register');

// Отключаем предупреждения Gutenberg
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

// Отключаем предупреждения о deprecated функциях
function disable_deprecated_warnings() {
    if (!WP_DEBUG) {
        error_reporting(E_ALL ^ E_DEPRECATED);
    }
}
add_action('init', 'disable_deprecated_warnings');

// Исправляем предупреждение о sandbox в iframe
function fix_customize_preview_iframe($url) {
    if (strpos($url, 'customize_messenger_channel=preview-') !== false) {
        $url = add_query_arg('sandbox', 'allow-scripts', $url);
    }
    return $url;
}
add_filter('customize_preview_link', 'fix_customize_preview_iframe');

// Отключаем загрузку статистики WordPress.com
function disable_wp_stats() {
    if (!is_admin()) {
        remove_action('wp_head', 'stats_header', 20);
        remove_action('wp_footer', 'stats_footer', 20);
    }
}
add_action('init', 'disable_wp_stats');

// Отключаем загрузку w.js
function dequeue_wp_stats() {
    wp_dequeue_script('wp-stats-js');
    wp_deregister_script('wp-stats-js');
}
add_action('wp_enqueue_scripts', 'dequeue_wp_stats', 100);

// Walker для меню в подвале
class Footer_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= '<li>';
        $output .= sprintf(
            '<a href="%s" class="text-gray-600 hover:text-gray-900">%s</a>',
            esc_url($item->url),
            esc_html($item->title)
        );
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= '</li>';
    }
}

// Добавляем динамические стили в head
function crane_parts_custom_styles() {
    $primary_color = get_theme_mod('primary_color', '#f97316');
    $primary_hover = get_theme_mod('primary_hover_color', '#ea580c');
    $dark_bg = get_theme_mod('dark_bg_color', '#111827');
    $button_radius = get_theme_mod('button_radius', '0.5rem');
    $card_radius = get_theme_mod('card_radius', '0.5rem');

    ?>
    <style>
        :root {
            --color-primary: <?php echo $primary_color; ?>;
            --color-primary-hover: <?php echo $primary_hover; ?>;
            --color-dark-bg: <?php echo $dark_bg; ?>;
            --radius-button: <?php echo $button_radius; ?>;
            --radius-card: <?php echo $card_radius; ?>;
        }
        .bg-primary { background-color: var(--color-primary) !important; }
        .hover\:bg-primary:hover { background-color: var(--color-primary) !important; }
        .text-primary { color: var(--color-primary) !important; }
        .hover\:text-primary:hover { color: var(--color-primary) !important; }
        .bg-dark { background-color: var(--color-dark-bg) !important; }
        .rounded-button { border-radius: var(--radius-button) !important; }
        .rounded-card { border-radius: var(--radius-card) !important; }
    </style>
    <?php
}
add_action('wp_head', 'crane_parts_custom_styles');

// Обработчик AJAX-поиска
function crane_parts_ajax_search() {
    check_ajax_referer('crane_parts_search_nonce', 'nonce');

    $query = sanitize_text_field($_POST['query']);
    $results = array();

    // Поиск страниц
    $pages = get_posts(array(
        'post_type' => 'page',
        'posts_per_page' => 3,
        's' => $query,
        'post_status' => 'publish'
    ));

    foreach ($pages as $page) {
        $results[] = array(
            'title' => $page->post_title,
            'url' => get_permalink($page->ID),
            'type' => 'page',
            'type_label' => 'Страница'
        );
    }

    // Поиск запчастей
    $parts = get_posts(array(
        'post_type' => 'product',
        'posts_per_page' => 5,
        's' => $query,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => 'spare-parts'
            )
        )
    ));

    foreach ($parts as $part) {
        $results[] = array(
            'title' => $part->post_title,
            'url' => get_permalink($part->ID),
            'type' => 'part',
            'type_label' => 'Запчасть'
        );
    }

    // Поиск категорий
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'name__like' => $query,
        'hide_empty' => false,
        'number' => 3
    ));

    foreach ($categories as $category) {
        $results[] = array(
            'title' => $category->name,
            'url' => get_term_link($category),
            'type' => 'category',
            'type_label' => 'Категория'
        );
    }

    // Поиск моделей кранов
    $cranes = get_posts(array(
        'post_type' => 'crane',
        'posts_per_page' => 3,
        's' => $query
    ));

    foreach ($cranes as $crane) {
        $results[] = array(
            'title' => $crane->post_title,
            'url' => get_permalink($crane->ID),
            'type' => 'crane',
            'type_label' => 'Модель крана'
        );
    }

    wp_send_json_success($results);
}
add_action('wp_ajax_crane_parts_search', 'crane_parts_ajax_search');
add_action('wp_ajax_nopriv_crane_parts_search', 'crane_parts_ajax_search');

// Добавляем настройки каталога
function crane_parts_catalog_settings($wp_customize) {
    // Секция каталога
    $wp_customize->add_section('catalog_settings', array(
        'title' => 'Настройки каталога',
        'priority' => 35,
    ));

    // Количество отображаемых категорий
    $wp_customize->add_setting('catalog_categories_count', array(
        'default' => 5,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('catalog_categories_count', array(
        'label' => 'Количество категорий в выпадающем меню',
        'section' => 'catalog_settings',
        'type' => 'number',
    ));

    // Выбранные категории
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
    ));

    if (!empty($categories) && !is_wp_error($categories)) {
        $category_choices = wp_list_pluck($categories, 'name', 'term_id');

        $wp_customize->add_setting('catalog_featured_categories', array(
            'default' => array(),
            'sanitize_callback' => 'crane_parts_sanitize_array',
        ));

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'catalog_featured_categories', array(
            'label' => 'Выберите категории дл отбжения',
            'section' => 'catalog_settings',
            'type' => 'select',
            'multiple' => true,
            'choices' => $category_choices,
        )));
    }
}
add_action('customize_register', 'crane_parts_catalog_settings');

// Функция для санитизации массива
function crane_parts_sanitize_array($input) {
    if (!is_array($input)) {
        return array();
    }
    return array_map('absint', $input);
}

// Обработка 404 ошибок
function crane_parts_handle_404() {
    // Проверяем, существует ли редирект для текущего URL
    $current_url = $_SERVER['REQUEST_URI'];
    $redirects = get_option('crane_parts_404_redirects', array());

    if (isset($redirects[$current_url])) {
        wp_redirect($redirects[$current_url], 301);
        exit;
    }

    // Логируем 404 ошибки
    if (is_404()) {
        $log_404 = array(
            'url' => $current_url,
            'referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
            'ip' => $_SERVER['REMOTE_ADDR'],
            'time' => current_time('mysql'),
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        );

        $logs = get_option('crane_parts_404_logs', array());
        array_unshift($logs, $log_404);
        $logs = array_slice($logs, 0, 100); // Храним только последние 100 записей
        update_option('crane_parts_404_logs', $logs);
    }
}
add_action('template_redirect', 'crane_parts_handle_404');

// Добавляем страницу настроек 404 в админку
function crane_parts_add_404_menu() {
    add_submenu_page(
        'tools.php',
        '404 Мониторинг',
        '404 Мониторинг',
        'manage_options',
        'crane-parts-404',
        'crane_parts_404_page'
    );
}
add_action('admin_menu', 'crane_parts_add_404_menu');

// Страница мониторинга 404 ошибок
function crane_parts_404_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Обработка добавления редиректа
    if (isset($_POST['add_redirect'])) {
        check_admin_referer('crane_parts_404_redirect');
        $from = sanitize_text_field($_POST['redirect_from']);
        $to = sanitize_text_field($_POST['redirect_to']);

        if ($from && $to) {
            $redirects = get_option('crane_parts_404_redirects', array());
            $redirects[$from] = $to;
            update_option('crane_parts_404_redirects', $redirects);
        }
    }

    // Получаем логи
    $logs = get_option('crane_parts_404_logs', array());
    $redirects = get_option('crane_parts_404_redirects', array());

    // Выводим интерфейс
    ?>
    <div class="wrap">
        <h1>Мониторинг 404 ошибок</h1>
        
        <!-- Форма добавления редиректа -->
        <div class="card">
            <h2>Добавить редирект</h2>
            <form method="post">
                <?php wp_nonce_field('crane_parts_404_redirect'); ?>
                <table class="form-table">
                    <tr>
                        <th><label for="redirect_from">С URL</label></th>
                        <td><input type="text" name="redirect_from" id="redirect_from" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label for="redirect_to">На URL</label></th>
                        <td><input type="text" name="redirect_to" id="redirect_to" class="regular-text"></td>
                    </tr>
                </table>
                <p class="submit">
                    <input type="submit" name="add_redirect" class="button button-primary" value="Добавить редирект">
                </p>
            </form>
        </div>

        <!-- Список послднх 404 ош��бок -->
        <div class="card">
            <h2>Последние 404 ошибки</h2>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Реферер</th>
                        <th>IP</th>
                        <th>Время</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?php echo esc_html($log['url']); ?></td>
                        <td><?php echo esc_html($log['referrer']); ?></td>
                        <td><?php echo esc_html($log['ip']); ?></td>
                        <td><?php echo esc_html($log['time']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}

// Функция для получения SVG иконок для 404 страницы
function crane_parts_get_404_icon($icon) {
    $icons = array(
        'home' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>',
        'shopping-bag' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>',
        'mail' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
        'phone' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>',
        'document' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
        'search' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>'
    );

    return isset($icons[$icon]) ? $icons[$icon] : $icons['document'];
}

// Настройки мега-меню
function crane_parts_megamenu_settings($wp_customize) {
    // Секция мега-меню
    $wp_customize->add_section('megamenu_settings', array(
        'title' => 'Настройки мега-меню',
        'priority' => 30,
    ));

    // Категории запчастей
    $wp_customize->add_setting('megamenu_parts_categories', array(
        'default' => array(),
        'sanitize_callback' => 'crane_parts_sanitize_array'
    ));

    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false
    ));

    if (!empty($categories) && !is_wp_error($categories)) {
        $category_choices = wp_list_pluck($categories, 'name', 'term_id');

        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'megamenu_parts_categories', array(
            'label' => 'Категории запчастей',
            'section' => 'megamenu_settings',
            'type' => 'select',
            'multiple' => true,
            'choices' => $category_choices
        )));
    }

    // Категории по ��оделям кранов
    $wp_customize->add_setting('megamenu_crane_categories', array(
        'default' => array(),
        'sanitize_callback' => 'crane_parts_sanitize_array'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'megamenu_crane_categories', array(
        'label' => 'Категории по моделям кранов',
        'section' => 'megamenu_settings',
        'type' => 'select',
        'multiple' => true,
        'choices' => $category_choices
    )));

    // Популярные товары
    $products = get_posts(array(
        'post_type' => 'product',
        'posts_per_page' => -1
    ));

    $product_choices = array();
    foreach ($products as $product) {
        $product_choices[$product->ID] = $product->post_title;
    }

    $wp_customize->add_setting('megamenu_featured_products', array(
        'default' => array(),
        'sanitize_callback' => 'crane_parts_sanitize_array'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'megamenu_featured_products', array(
        'label' => 'Популярные товары',
        'section' => 'megamenu_settings',
        'type' => 'select',
        'multiple' => true,
        'choices' => $product_choices
    )));

    // Ссылки на PDF каталог
    $wp_customize->add_setting('megamenu_catalog_pdf', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('megamenu_catalog_pdf', array(
        'label' => 'Ссылка на PDF каталог',
        'section' => 'megamenu_settings',
        'type' => 'url'
    ));
}
add_action('customize_register', 'crane_parts_megamenu_settings');

// Добавляем поддержку WooCommerce
function crane_parts_add_woocommerce_support() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'crane_parts_add_woocommerce_support');

// Создаем основные категории при активации темы
function crane_parts_create_categories() {
    $main_categories = array(
        'spare-parts' => 'Запчасти для кранов',
        'crane-models' => 'Модели кранов'
    );

    $spare_parts_subcategories = array(
        'engines' => 'Двигатели и моторы',
        'electrical' => 'Электрооборудование',
        'mechanical' => 'Механические части',
        'hydraulics' => 'Гидравлика',
        'controls' => 'Системы управления',
        'safety' => 'Системы безопасности'
    );

    foreach ($main_categories as $slug => $name) {
        if (!term_exists($slug, 'product_cat')) {
            wp_insert_term($name, 'product_cat', array('slug' => $slug));
        }
    }

    $parent_term = term_exists('spare-parts', 'product_cat');
    if ($parent_term) {
        foreach ($spare_parts_subcategories as $slug => $name) {
            if (!term_exists($slug, 'product_cat')) {
                wp_insert_term(
                    $name,
                    'product_cat',
                    array(
                        'slug' => $slug,
                        'parent' => $parent_term['term_id']
                    )
                );
            }
        }
    }
}
add_action('after_switch_theme', 'crane_parts_create_categories');

// Добавляем дополнительные поля для товаров
function crane_parts_add_product_fields() {
    add_action('woocommerce_product_options_general_product_data', 'crane_parts_add_custom_fields');
    add_action('woocommerce_process_product_meta', 'crane_parts_save_custom_fields');
}
add_action('init', 'crane_parts_add_product_fields');

function crane_parts_add_custom_fields() {
    global $woocommerce, $post;

    echo '<div class="options_group">';

    // Артикул производителя
    woocommerce_wp_text_input(array(
        'id' => '_manufacturer_sku',
        'label' => 'Артикул производителя',
        'desc_tip' => 'true',
        'description' => 'Введите оригинальный артикул производителя'
    ));

    // Совместимость с моделями кранов
    woocommerce_wp_textarea_input(array(
        'id' => '_compatible_cranes',
        'label' => 'Совместимые модели',
        'desc_tip' => 'true',
        'description' => 'Укажите модели кранов, с которыми совместима эта запчасть'
    ));

    // Производитель
    woocommerce_wp_text_input(array(
        'id' => '_manufacturer',
        'label' => 'Производитель',
        'desc_tip' => 'true',
        'description' => 'Укажите производителя запчасти'
    ));

    echo '</div>';
}

function crane_parts_save_custom_fields($post_id) {
    $fields = array('_manufacturer_sku', '_compatible_cranes', '_manufacturer');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}

// Добавляем фильтры для каталога
function crane_parts_add_filters() {
    // Фильтр по производителю
    add_filter('woocommerce_product_query_tax_query', 'crane_parts_filter_by_manufacturer', 10, 2);
    
    // Фильтр по совместимости с кранами
    add_filter('woocommerce_product_query_meta_query', 'crane_parts_filter_by_crane_model', 10, 2);
}
add_action('init', 'crane_parts_add_filters');

// Функция фильтрации по производителю
function crane_parts_filter_by_manufacturer($tax_query, $query) {
    if (!empty($_GET['manufacturer'])) {
        $manufacturer = sanitize_text_field($_GET['manufacturer']);
        
        $tax_query[] = array(
            'taxonomy' => 'product_manufacturer',
            'field' => 'slug',
            'terms' => $manufacturer
        );
    }
    
    return $tax_query;
}

// Функция фильтрации по модели крана
function crane_parts_filter_by_crane_model($meta_query, $query) {
    if (!empty($_GET['crane_model'])) {
        $crane_model = sanitize_text_field($_GET['crane_model']);
        
        $meta_query[] = array(
            'key' => '_compatible_cranes',
            'value' => $crane_model,
            'compare' => 'LIKE'
        );
    }
    
    return $meta_query;
}

// Регистрируем таксономию для производителей
function crane_parts_register_taxonomies() {
    register_taxonomy(
        'product_manufacturer',
        'product',
        array(
            'label' => 'Производители',
            'hierarchical' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'manufacturer'),
        )
    );
}
add_action('init', 'crane_parts_register_taxonomies');

// Добавляем производителей в фильтры WooCommerce
function crane_parts_add_manufacturer_filter() {
    $terms = get_terms(array(
        'taxonomy' => 'product_manufacturer',
        'hide_empty' => true,
    ));

    if ($terms && !is_wp_error($terms)) {
        echo '<div class="widget woocommerce widget_layered_nav">';
        echo '<h4 class="font-medium mb-2">Производитель</h4>';
        echo '<ul>';
        
        foreach ($terms as $term) {
            $selected = isset($_GET['manufacturer']) && $_GET['manufacturer'] === $term->slug ? 'checked' : '';
            echo sprintf(
                '<li><label class="flex items-center"><input type="checkbox" name="manufacturer[]" value="%s" %s><span class="ml-2">%s</span></label></li>',
                esc_attr($term->slug),
                $selected,
                esc_html($term->name)
            );
        }
        
        echo '</ul>';
        echo '</div>';
    }
}
add_action('woocommerce_before_shop_loop', 'crane_parts_add_manufacturer_filter', 30);

// Добавляем заголовок безопасности
function add_security_headers() {
    header("Content-Security-Policy: frame-ancestors 'self'");
    header("X-Frame-Options: SAMEORIGIN");
    header("X-Content-Type-Options: nosniff");
    header("X-XSS-Protection: 1; mode=block");
    header("Referrer-Policy: strict-origin-when-cross-origin");
}
add_action('send_headers', 'add_security_headers');

// Добавляем поддержку меню
function register_theme_menus() {
    register_nav_menus(array(
        'primary-menu' => 'Главное меню',
        'catalog-menu' => 'Меню каталога',
        'footer-menu' => 'Меню в подвале'
    ));
}
add_action('init', 'register_theme_menus');

// Кастомный walker для основного меню
class Primary_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        // Проверяем, является ли пункт меню каталогом или моим заказом
        $title_lower = mb_strtolower(trim($item->title));
        if ($title_lower === 'каталог') {
            // Пропускаем, так как каталог отображается отдельно слева
            return;
        } elseif ($title_lower === 'мой заказ') {
            // Пропускаем, так как "Мой заказ" отображается отдельно справа
            return;
        }

        // Для остальных пунктов меню добавляем стандартное оформление
        $output .= sprintf(
            '<a href="%s" class="text-gray-600 hover:text-gray-900">%s</a>',
            esc_url($item->url),
            esc_html($item->title)
        );
    }
}

// Кастомный walker для меню каталога
class Catalog_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= '<a href="' . $item->url . '" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">';
        $output .= '<svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>';
        $output .= '<span class="text-gray-700">' . $item->title . '</span>';
        $output .= '</a>';
    }
}

function element_kran_pagination_classes($html) {
    $html = str_replace('page-numbers', 'flex items-center justify-center w-10 h-10 rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors', $html);
    $html = str_replace('current', 'bg-primary border-primary text-white hover:bg-primary-hover', $html);
    return $html;
}
add_filter('wp_link_pages', 'element_kran_pagination_classes');
add_filter('paginate_links', 'element_kran_pagination_classes');

function element_kran_widgets_init() {
    register_sidebar(array(
        'name'          => 'Сайдбар магазина',
        'id'            => 'shop-sidebar',
        'description'   => 'Виджеты для страницы каталога',
        'before_widget' => '<div class="widget mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-lg font-semibold text-gray-900 mb-3">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'element_kran_widgets_init');

// Добавляем фильтрацию товаров по категории
function element_kran_filter_products_by_category($query) {
    if (!is_admin() && $query->is_main_query() && isset($_GET['product_cat'])) {
        $tax_query = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['product_cat'])
            )
        );
        
        // Если уже есть tax_query, добавляем к существующему
        if ($query->get('tax_query')) {
            $existing_tax_query = $query->get('tax_query');
            $tax_query = array_merge($existing_tax_query, $tax_query);
        }
        
        $query->set('tax_query', $tax_query);
    }
}
add_action('pre_get_posts', 'element_kran_filter_products_by_category');

// Сохраняем выбранные фильтры в сессии
function element_kran_save_filters() {
    if (isset($_GET['filter']) && $_GET['filter'] === 'category') {
        if (!session_id()) {
            session_start();
        }
        
        if (isset($_GET['product_cat'])) {
            $_SESSION['product_cat_filter'] = sanitize_text_field($_GET['product_cat']);
        }
    }
}
add_action('init', 'element_kran_save_filters');

// Применяем сохраненные фильтры
function element_kran_apply_saved_filters($query) {
    if (!session_id()) {
        session_start();
    }
    
    if (!is_admin() && $query->is_main_query() && isset($_SESSION['product_cat_filter'])) {
        $tax_query = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $_SESSION['product_cat_filter']
            )
        );
        
        if ($query->get('tax_query')) {
            $existing_tax_query = $query->get('tax_query');
            $tax_query = array_merge($existing_tax_query, $tax_query);
        }
        
        $query->set('tax_query', $tax_query);
    }
}
add_action('pre_get_posts', 'element_kran_apply_saved_filters');

// Перенаправление с product-category на страницу каталога с фильтрами
function redirect_product_category_to_catalog() {
    // Проверяем, является ли текущий запрос страницей категории товара
    if (is_product_category()) {
        // Получаем текущую категорию
        $category = get_queried_object();
        
        // Формируем URL для сраницы parts с ��ильтром
        $catalog_url = home_url('/wp/parts/');
        $redirect_url = add_query_arg(array(
            'product_cat' => $category->slug,
            'filter' => 'category'
        ), $catalog_url);
        
        // Выполняем перенаправление
        wp_redirect($redirect_url);
        exit;
    }
}
add_action('template_redirect', 'redirect_product_category_to_catalog', 5);

// Модифицируем все ссылки категорий, чтобы они вели на страницу каталога
function modify_product_category_links($url, $term, $taxonomy) {
    if ($taxonomy === 'product_cat') {
        $catalog_url = home_url('/wp/parts/');
        return add_query_arg(array(
            'product_cat' => $term->slug,
            'filter' => 'category'
        ), $catalog_url);
    }
    return $url;
}
add_filter('term_link', 'modify_product_category_links', 10, 3);

function custom_select_styles() {
    $custom_css = "
        select option {
            padding: 12px 16px;
            cursor: pointer;
            font-weight: 500;
        }

        select option:hover,
        select option:focus {
            background-color: rgba(234, 88, 12, 0.1) !important;
            color: #ea580c !important;
        }

        select option:checked {
            background-color: rgba(234, 88, 12, 0.1) !important;
            color: #ea580c !important;
            font-weight: 600;
        }

        /* Стилизация для Firefox */
        @-moz-document url-prefix() {
            select option:hover,
            select option:focus {
                background-color: rgba(234, 88, 12, 0.1) !important;
                color: #ea580c !important;
            }
            
            select option:checked {
                box-shadow: 0 0 0 100px rgba(234, 88, 12, 0.1) inset !important;
                color: #ea580c !important;
            }
        }

        /* Стилизация для Chrome/Safari */
        @media screen and (-webkit-min-device-pixel-ratio:0) {
            select option:hover,
            select option:focus {
                background-color: rgba(234, 88, 12, 0.1) !important;
                color: #ea580c !important;
            }
        }
    ";
    
    wp_add_inline_style('your-theme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'custom_select_styles');

// Отключаем отдельные страницы товаров
function disable_single_product_pages() {
    if (is_singular('product')) {
        wp_redirect(home_url('/catalog/parts/'));
        exit();
    }
}
add_action('template_redirect', 'disable_single_product_pages');

// Обработка отправки заказа
function handle_parts_order() {
    check_ajax_referer('wp_rest', '_wpnonce');

    $name = sanitize_text_field($_POST['customer_name']);
    $phone = sanitize_text_field($_POST['phone']);
    $email = sanitize_email($_POST['email']);
    $company = sanitize_text_field($_POST['company']);
    $comment = sanitize_textarea_field($_POST['comment']);
    $parts = json_decode(stripslashes($_POST['parts']), true);

    // Формируем сообщение
    $message = "Новый заказ запчастей\n\n";
    $message .= "Имя: {$name}\n";
    $message .= "Телефон: {$phone}\n";
    if ($email) $message .= "Email: {$email}\n";
    if ($company) $message .= "Организация: {$company}\n";
    if ($comment) $message .= "Комментарий: {$comment}\n\n";
    
    $message .= "Список запчастей:\n";
    foreach ($parts as $part) {
        $message .= "- {$part['name']} ({$part['quantity']} шт.)\n";
    }

    // Отправляем уведомление
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>'
    );

    $sent = wp_mail(
        $admin_email,
        'Новый заказ запчастей - ' . $site_name,
        $message,
        $headers
    );

    wp_send_json_success($sent);
}
add_action('wp_ajax_submit_parts_order', 'handle_parts_order');
add_action('wp_ajax_nopriv_submit_parts_order', 'handle_parts_order');