<?php
// Подключаем все необходимые файлы
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/woocommerce.php';
require_once get_template_directory() . '/inc/filters.php';
require_once get_template_directory() . '/inc/helpers.php';

if (!defined('ABSPATH')) {
    exit;
}

// Поддержка основных возможностей WordPress
function crane_parts_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 40,
        'width'       => 160,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    )); // Поддержка Elementor
}
add_action('after_setup_theme', 'crane_parts_setup');

// Регистрация меню
function crane_parts_menus() {
    register_nav_menus(array(
        'primary' => __('Главное меню', 'crane-parts'),
        'footer' => __('Меню в подвале', 'crane-parts'),
        'catalog_menu' => __('Меню каталога', 'crane-parts'),
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
            'label' => 'Ссылка ' . $i . ' - иконка',
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

    // Секция настроек главной страницы
    $wp_customize->add_section('homepage_settings', array(
        'title' => 'Настройки главной страницы',
        'priority' => 30,
    ));

    // Hero Section
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Запчасти для башенных кранов всех видов и моделей',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => 'Заголовок Hero-секции',
        'section' => 'homepage_settings',
        'type' => 'text'
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Подберём и доставим нужную деталь — быстро, надёжно, выгодно',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => 'Подзаголовок Hero-секции',
        'section' => 'homepage_settings',
        'type' => 'textarea'
    ));

    $wp_customize->add_setting('hero_background', array(
        'default' => '',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_background', array(
        'label' => 'Фоновое изображение Hero-секции',
        'section' => 'homepage_settings',
        'mime_type' => 'image',
    )));

    $wp_customize->add_setting('hero_crane_image', array(
        'default' => '',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_crane_image', array(
        'label' => 'Изображение крана',
        'section' => 'homepage_settings',
        'mime_type' => 'image',
    )));

    // Преимущества в Hero-секции
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("hero_advantage_{$i}_title", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control("hero_advantage_{$i}_title", array(
            'label' => "Преимущество {$i} - Заголовок",
            'section' => 'homepage_settings',
            'type' => 'text'
        ));

        $wp_customize->add_setting("hero_advantage_{$i}_text", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control("hero_advantage_{$i}_text", array(
            'label' => "Преимущество {$i} - Текст",
            'section' => 'homepage_settings',
            'type' => 'textarea'
        ));
    }

    // О компании
    $wp_customize->add_setting('about_title', array(
        'default' => 'О компании',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('about_title', array(
        'label' => 'Заголовок секции "О компании"',
        'section' => 'homepage_settings',
        'type' => 'text'
    ));

    $wp_customize->add_setting('about_text', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post'
    ));
    
    $wp_customize->add_control('about_text', array(
        'label' => 'Текст секции "О компании"',
        'section' => 'homepage_settings',
        'type' => 'textarea'
    ));

    // Как найти запчасть
    $wp_customize->add_setting('how_to_find_title', array(
        'default' => 'Как найти нужную запчасть?',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('how_to_find_title', array(
        'label' => 'Заголовок секции "Как найти запчасть"',
        'section' => 'homepage_settings',
        'type' => 'text'
    ));

    $wp_customize->add_setting('how_to_find_text', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post'
    ));
    
    $wp_customize->add_control('how_to_find_text', array(
        'label' => 'Описание процесса поиска',
        'section' => 'homepage_settings',
        'type' => 'textarea'
    ));

    // Как оформить заказ
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("order_step_{$i}_title", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control("order_step_{$i}_title", array(
            'label' => "Шаг {$i} - Заголовок",
            'section' => 'homepage_settings',
            'type' => 'text'
        ));

        $wp_customize->add_setting("order_step_{$i}_text", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control("order_step_{$i}_text", array(
            'label' => "Шаг {$i} - Описание",
            'section' => 'homepage_settings',
            'type' => 'textarea'
        ));
    }

    // FAQ
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting("faq_{$i}_question", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control("faq_{$i}_question", array(
            'label' => "Вопрос {$i}",
            'section' => 'homepage_settings',
            'type' => 'text'
        ));

        $wp_customize->add_setting("faq_{$i}_answer", array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post'
        ));
        
        $wp_customize->add_control("faq_{$i}_answer", array(
            'label' => "Ответ {$i}",
            'section' => 'homepage_settings',
            'type' => 'textarea'
        ));
    }

    // Контактная форма
    $wp_customize->add_setting('contact_form_title', array(
        'default' => 'Остались вопросы?',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('contact_form_title', array(
        'label' => 'Заголовок формы обратной связи',
        'section' => 'homepage_settings',
        'type' => 'text'
    ));

    // Контктные данные
    $wp_customize->add_setting('contact_phone', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label' => 'Телефон',
        'section' => 'homepage_settings',
        'type' => 'text'
    ));

    $wp_customize->add_setting('contact_email', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email'
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label' => 'Email',
        'section' => 'homepage_settings',
        'type' => 'email'
    ));

    $wp_customize->add_setting('contact_address', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label' => 'Адрес',
        'section' => 'homepage_settings',
        'type' => 'text'
    ));

    // Секция FAQ
    $wp_customize->add_section('faq_settings', array(
        'title' => 'Настройки FAQ',
        'priority' => 35,
    ));

    // Заголовок секции FAQ
    $wp_customize->add_setting('faq_title', array(
        'default' => 'Часто задаваемые вопросы',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('faq_title', array(
        'label' => 'Заголовок FAQ',
        'section' => 'faq_settings',
        'type' => 'text'
    ));

    // Подзаголовок секции FAQ
    $wp_customize->add_setting('faq_subtitle', array(
        'default' => 'Ответы на популярные вопросы о запчастях для башенных кранов',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('faq_subtitle', array(
        'label' => 'Подзаголовок FAQ',
        'section' => 'faq_settings',
        'type' => 'text'
    ));

    // Добавляем 6 вопросов-ответов
    for ($i = 1; $i <= 6; $i++) {
        // Вопрос
        $wp_customize->add_setting('faq_question_' . $i, array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control('faq_question_' . $i, array(
            'label' => 'Вопрос ' . $i,
            'section' => 'faq_settings',
            'type' => 'text'
        ));

        // Ответ
        $wp_customize->add_setting('faq_answer_' . $i, array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post'
        ));

        $wp_customize->add_control('faq_answer_' . $i, array(
            'label' => 'Ответ ' . $i,
            'section' => 'faq_settings',
            'type' => 'textarea'
        ));
    }

    // Добавляем секцию для настройки отступов
    $wp_customize->add_section('spacing_settings', array(
        'title' => 'Настройки отступов',
        'priority' => 35,
        'description' => 'Настройка расстояний между секциями сайта (в пикселях)',
    ));

    // Массив с настройками отступов для разных секций
    $spacing_settings = array(
        'hero_spacing' => array(
            'label' => 'Отступ после главного баннера',
            'default' => '32'
        ),
        'about_spacing' => array(
            'label' => 'Отступ после секции "О компании"',
            'default' => '32'
        ),
        'how_to_find_spacing' => array(
            'label' => 'Отступ после секции "Как найти"',
            'default' => '32'
        ),
        'order_steps_spacing' => array(
            'label' => 'Отступ после секции "Шаги заказа"',
            'default' => '32'
        ),
        'faq_spacing' => array(
            'label' => 'Отступ после секции FAQ',
            'default' => '32'
        ),
        'blog_spacing' => array(
            'label' => 'Отступ после секции блога',
            'default' => '32'
        ),
        'manufacturers_spacing' => array(
            'label' => 'Отступ после секции производителей',
            'default' => '32'
        ),
        'advantages_spacing' => array(
            'label' => 'Отступ после секции "Преимущества"',
            'default' => '32'
        ),
        'contact_spacing' => array(
            'label' => 'Отступ после формы обратной связи',
            'default' => '32'
        )
    );

    // Регистрируем настройки для каждой секции
    foreach ($spacing_settings as $setting_id => $setting_data) {
        $wp_customize->add_setting($setting_id, array(
            'default' => $setting_data['default'],
            'sanitize_callback' => 'absint',
            'transport' => 'postMessage' // Для живого предпросмотра
        ));

        $wp_customize->add_control($setting_id, array(
            'label' => $setting_data['label'],
            'section' => 'spacing_settings',
            'type' => 'number',
            'input_attrs' => array(
                'min' => 0,
                'max' => 200,
                'step' => 8,
            )
        ));
    }

    // Добавляем поддержку живого предпросмотра
    if ($wp_customize->is_preview() && !is_admin()) {
        add_action('wp_footer', 'crane_parts_spacing_customize_preview', 21);
    }

    // Добавляем секцию для меню каталога
    $wp_customize->add_section('catalog_menu_section', array(
        'title' => 'Меню каталога',
        'priority' => 35,
    ));

    // Массив пунктов меню по умолчанию
    $default_menu_items = array(
        'item1' => array(
            'title' => 'Механизмы подъема',
            'url' => '#'
        ),
        'item2' => array(
            'title' => 'Электрооборудование',
            'url' => '#'
        ),
        'item3' => array(
            'title' => 'Тормозная система',
            'url' => '#'
        ),
        'item4' => array(
            'title' => 'Кабины и пульты',
            'url' => '#'
        ),
        'item5' => array(
            'title' => 'Металлоконструкции',
            'url' => '#'
        )
    );

    // Добавляем настройки для каждого пункта меню
    foreach ($default_menu_items as $key => $item) {
        // Название пункта меню
        $wp_customize->add_setting("catalog_menu_{$key}_title", array(
            'default' => $item['title'],
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control("catalog_menu_{$key}_title", array(
            'label' => "Название пункта меню " . ($key[4]),
            'section' => 'catalog_menu_section',
            'type' => 'text',
        ));

        // URL пункта меню
        $wp_customize->add_setting("catalog_menu_{$key}_url", array(
            'default' => $item['url'],
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("catalog_menu_{$key}_url", array(
            'label' => "Ссылка пункта меню " . ($key[4]),
            'section' => 'catalog_menu_section',
            'type' => 'url',
        ));
    }

    // Добавляем секцию для навигации
    $wp_customize->add_section('navigation_settings', array(
        'title' => 'Настройки навигации',
        'priority' => 35,
    ));

    // Настройки для кнопки "Каталог"
    $wp_customize->add_setting('catalog_button_text', array(
        'default' => 'КАТАЛОГ',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('catalog_button_text', array(
        'label' => 'Текст кнопки "Каталог"',
        'section' => 'navigation_settings',
        'type' => 'text',
    ));

    // Обновляем дефолтное значение для URL кнопки каталога
    $wp_customize->add_setting('catalog_button_url', array(
        'default' => '/new/catalog',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('catalog_button_url', array(
        'label' => 'Ссылка кнопки "Каталог"',
        'section' => 'navigation_settings',
        'type' => 'url',
    ));

    // Настройки для кнопки "Быстрый заказ"
    $wp_customize->add_setting('quick_order_text', array(
        'default' => 'Быстрый заказ',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('quick_order_text', array(
        'label' => 'Текст кнопки "Быстрый заказ"',
        'section' => 'navigation_settings',
        'type' => 'text',
    ));

    $wp_customize->add_setting('quick_order_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('quick_order_url', array(
        'label' => 'Ссылка кнопки "Быстрый заказ"',
        'section' => 'navigation_settings',
        'type' => 'url',
    ));

    // Настройки для кнопки "Корзина"
    $wp_customize->add_setting('cart_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('cart_url', array(
        'label' => 'Ссылка корзины',
        'section' => 'navigation_settings',
        'type' => 'url',
    ));
}

// Функция для живого предпросмотра
function crane_parts_spacing_customize_preview() {
    ?>
    <script type="text/javascript">
        (function($) {
            wp.customize.bind('preview-ready', function() {
                // Обновляем отступы при изменении значений
                wp.customize('hero_spacing', function(value) {
                    value.bind(function(newval) {
                        $('.hero-section').css('margin-bottom', newval + 'px');
                    });
                });
                wp.customize('about_spacing', function(value) {
                    value.bind(function(newval) {
                        $('.about-section').css('margin-bottom', newval + 'px');
                    });
                });
                wp.customize('how_to_find_spacing', function(value) {
                    value.bind(function(newval) {
                        $('.how-to-find-section').css('margin-bottom', newval + 'px');
                    });
                });
                wp.customize('order_steps_spacing', function(value) {
                    value.bind(function(newval) {
                        $('.order-steps-section').css('margin-bottom', newval + 'px');
                    });
                });
                wp.customize('faq_spacing', function(value) {
                    value.bind(function(newval) {
                        $('.faq-section').css('margin-bottom', newval + 'px');
                    });
                });
                wp.customize('blog_spacing', function(value) {
                    value.bind(function(newval) {
                        $('.blog-section').css('margin-bottom', newval + 'px');
                    });
                });
                wp.customize('manufacturers_spacing', function(value) {
                    value.bind(function(newval) {
                        $('.manufacturers-section').css('margin-bottom', newval + 'px');
                    });
                });
                wp.customize('advantages_spacing', function(value) {
                    value.bind(function(newval) {
                        $('.advantages-section').css('margin-bottom', newval + 'px');
                    });
                });
                wp.customize('contact_spacing', function(value) {
                    value.bind(function(newval) {
                        $('.contact-section').css('margin-bottom', newval + 'px');
                    });
                });
            });
        })(jQuery);
    </script>
    <?php
}

// Добавляем динамические стили
function crane_parts_dynamic_spacing_styles() {
    $spacing_settings = array(
        'hero_spacing' => '.hero-section',
        'about_spacing' => '.about-section',
        'how_to_find_spacing' => '.how-to-find-section',
        'order_steps_spacing' => '.order-steps-section',
        'faq_spacing' => '.faq-section',
        'blog_spacing' => '.blog-section',
        'manufacturers_spacing' => '.manufacturers-section',
        'advantages_spacing' => '.advantages-section',
        'contact_spacing' => '.contact-section'
    );

    $styles = '<style type="text/css">';
    foreach ($spacing_settings as $setting_id => $selector) {
        $spacing = get_theme_mod($setting_id, '64');
        $styles .= sprintf(
            '%s { margin-bottom: %spx; }',
            $selector,
            esc_attr($spacing)
        );
    }
    $styles .= '</style>';

    echo $styles;
}
add_action('wp_head', 'crane_parts_dynamic_spacing_styles');

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
            'label' => 'Выберите категории для отображения',
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

        <!-- Список послднх 404 ошибок -->
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

    // Категории по моделям кранов
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
        // Проверяем, является ли элемент меню каталогом или моим заказом
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
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $output .= sprintf(
            '<a href="%s" class="group relative px-5 py-3.5 text-white hover:bg-brand-orange-dark transition-colors">
                <span class="font-medium whitespace-nowrap text-sm uppercase">%s</span>
            </a>',
            esc_url($item->url),
            esc_html($item->title)
        );
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

// Добавляем фильтрцию товаров по категории
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
    // Проверяем, активирован ли WooCommerce
    if (!function_exists('is_product_category')) {
        return;
    }

    // Проверяем, является ли текущий запрос страницей категории товара
    if (is_product_category()) {
        // Получаем текущую категорию
        $category = get_queried_object();
        
        // Формируем URL для страницы parts с фильтром
        $catalog_url = home_url('/catalog/');
        $redirect_url = add_query_arg(array(
            'product_cat' => $category->slug,
            'filter' => 'category'
        ), $catalog_url);
        
        // Выполняем перенаправление
        wp_redirect($redirect_url);
        exit;
    }
}

// Проверяем наличие WooCommerce перед добавлением хука
if (function_exists('is_product_category')) {
    add_action('template_redirect', 'redirect_product_category_to_catalog', 5);
}

// Модифицируем все ссылки категорий
function modify_product_category_links($url, $term, $taxonomy) {
    // Проверяем, активирован ли WooCommerce
    if (!function_exists('is_product_category')) {
        return $url;
    }

    if ($taxonomy === 'product_cat') {
        $catalog_url = home_url('/catalog/');
        return add_query_arg(array(
            'product_cat' => $term->slug,
            'filter' => 'category'
        ), $catalog_url);
    }
    return $url;
}

// Проверяем наличие WooCommerce перед добавлением фильтра
if (function_exists('is_product_category')) {
    add_filter('term_link', 'modify_product_category_links', 10, 3);
}

// Отключаем отдельные страницы товаров
function disable_single_product_pages() {
    // Проверяем, активирован ли WooCommerce
    if (!function_exists('is_singular')) {
        return;
    }

    if (is_singular('product')) {
        wp_redirect(home_url('/new/catalog/'));
        exit();
    }
}

// Проверяем наличие WooCommerce перед добавлением хука
if (function_exists('is_singular')) {
    add_action('template_redirect', 'disable_single_product_pages');
}

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

// Функция для склонения слов
function plural_form($n, $form1, $form2, $form5) {
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) return $form5;
    if ($n1 > 1 && $n1 < 5) return $form2;
    if ($n1 == 1) return $form1;
    return $form5;
}

// Добавляем кастомные поля в товары WooCommerce
function add_custom_fields_product_tab($tabs) {
    $tabs['crane_specs'] = array(
        'label'    => 'Характеристики крана',
        'target'   => 'crane_specifications',
        'priority' => 60
    );
    return $tabs;
}
add_filter('woocommerce_product_data_tabs', 'add_custom_fields_product_tab');

// Добавляем поля в вкладку
function add_crane_specifications_fields() {
    echo '<div id="crane_specifications" class="panel woocommerce_options_panel">';
    
    // Производитель крана
    woocommerce_wp_select(array(
        'id'      => '_crane_manufacturer',
        'label'   => 'Производитель крана',
        'options' => array(
            ''          => 'Выберите производителя',
            'potain'    => 'Potain',
            'liebherr'  => 'Liebherr',
            'zoomlion'  => 'Zoomlion',
            'comansa'   => 'Comansa'
        )
    ));
    
    // Модель крана
    woocommerce_wp_text_input(array(
        'id'          => '_crane_model',
        'label'       => 'Модель крана',
        'placeholder' => 'Например: MC 85'
    ));
    
    // Метки
    woocommerce_wp_textarea_input(array(
        'id'          => '_product_labels',
        'label'       => 'Метки',
        'placeholder' => 'Введите метки через запятую',
        'desc_tip'    => true,
        'description' => 'Метки помогут быстрее находить запчасть. Например: оригинал, новая, б/у'
    ));

    echo '</div>';
}
add_action('woocommerce_product_data_panels', 'add_crane_specifications_fields');

// Сохраняем значения полей
function save_crane_specifications_fields($post_id) {
    $crane_manufacturer = isset($_POST['_crane_manufacturer']) ? sanitize_text_field($_POST['_crane_manufacturer']) : '';
    update_post_meta($post_id, '_crane_manufacturer', $crane_manufacturer);
    
    $crane_model = isset($_POST['_crane_model']) ? sanitize_text_field($_POST['_crane_model']) : '';
    update_post_meta($post_id, '_crane_model', $crane_model);
    
    $product_labels = isset($_POST['_product_labels']) ? sanitize_textarea_field($_POST['_product_labels']) : '';
    update_post_meta($post_id, '_product_labels', $product_labels);
}
add_action('woocommerce_process_product_meta', 'save_crane_specifications_fields');

// Добавим функцию для установки категории по умолчанию
function set_default_catalog_category($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('product')) {
        // Если не выбрана категория, показываем "Все запчасти"
        if (!isset($_GET['product_cat'])) {
            $tax_query = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => 'spare-parts', // слаг категории "Все запчасти"
                    'operator' => 'IN',
                )
            );
            $query->set('tax_query', $tax_query);
        }
    }
}
add_action('pre_get_posts', 'set_default_catalog_category');

// Добавим создание категории при активации темы
function create_default_categories() {
    // Создаем основную категорию "Все запчасти"
    if (!term_exists('spare-parts', 'product_cat')) {
        wp_insert_term(
            'Все запчасти', 
            'product_cat',
            array(
                'slug' => 'spare-parts',
                'description' => 'Все запчасти для башенных кранов'
            )
        );
    }
}
add_action('after_switch_theme', 'create_default_categories');

// Добавляем поддержку Max Mega Menu
function element_kran_mega_menu_support() {
    add_theme_support('max-mega-menu');
}
add_action('after_setup_theme', 'element_kran_mega_menu_support');

// Настройка стилей для Max Mega Menu
function element_kran_megamenu_override_default_theme($themes) {
    $themes["default"] = [
        'title' => 'Element Kran Theme',
        'container_background_from' => '#ffffff',
        'container_background_to' => '#ffffff',
        'menu_item_align' => 'left',
        'menu_item_background_hover_from' => '#f97316',
        'menu_item_background_hover_to' => '#f97316',
        'menu_item_link_height' => '50px',
        'menu_item_link_color' => '#374151',
        'menu_item_link_weight' => 'bold',
        'menu_item_link_text_align' => 'left',
        'menu_item_link_color_hover' => '#ffffff',
        'menu_item_link_padding_left' => '20px',
        'menu_item_link_padding_right' => '20px',
        'menu_item_border_color' => '#e5e7eb',
        'panel_background_from' => '#ffffff',
        'panel_background_to' => '#ffffff',
        'panel_width' => '100%',
        'panel_inner_width' => '1280px',
        'panel_border_color' => '#e5e7eb',
        'panel_border_radius' => '0 0 8px 8px',
        'panel_header_color' => '#111827',
        'panel_header_text_transform' => 'none',
        'panel_header_font_size' => '18px',
        'panel_header_font_weight' => 'bold',
        'panel_header_margin_bottom' => '16px',
        'panel_padding_left' => '24px',
        'panel_padding_right' => '24px',
        'panel_padding_top' => '24px',
        'panel_padding_bottom' => '24px',
        'panel_widget_padding' => '0px',
        'panel_font_size' => '14px',
        'panel_font_color' => '#4b5563',
        'panel_font_family' => 'inherit',
        'panel_second_level_font_color' => '#374151',
        'panel_second_level_font_size' => '16px',
        'panel_second_level_font_weight' => 'bold',
        'panel_second_level_text_transform' => 'none',
        'panel_second_level_margin_bottom' => '10px',
        'panel_third_level_font_color' => '#4b5563',
        'panel_third_level_font_size' => '14px',
        'panel_third_level_padding' => '5px 0',
        'flyout_width' => '200px',
        'flyout_background_from' => '#ffffff',
        'flyout_background_to' => '#ffffff',
        'flyout_border_color' => '#e5e7eb',
        'flyout_border_radius' => '4px',
        'flyout_padding' => '16px',
        'responsive_breakpoint' => '768px',
        'responsive_text' => 'Меню',
        'mobile_columns' => 1,
        'mobile_background_from' => '#ffffff',
        'mobile_background_to' => '#ffffff',
        'mobile_menu_item_height' => '40px',
        'mobile_menu_padding' => '20px',
        'shadow' => 'on',
        'shadow_horizontal' => '0px',
        'shadow_vertical' => '4px',
        'shadow_blur' => '12px',
        'shadow_spread' => '0px',
        'shadow_color' => 'rgba(0, 0, 0, 0.1)',
        'transitions' => 'on'
    ];
    return $themes;
}
add_filter('megamenu_themes', 'element_kran_megamenu_override_default_theme');

// Регистрируем области для виджетов мега-меню
function element_kran_mega_menu_widgets() {
    register_sidebar([
        'name' => 'Мега-меню - Запчасти',
        'id' => 'mega-menu-parts',
        'description' => 'Виджеты для раздела запчастей в мега-меню',
        'before_widget' => '<div class="mega-menu-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="text-lg font-bold mb-4">',
        'after_title' => '</h4>'
    ]);

    register_sidebar([
        'name' => 'Мега-меню - Производители',
        'id' => 'mega-menu-manufacturers',
        'description' => 'Виджеты для раздела производителей в мега-меню',
        'before_widget' => '<div class="mega-menu-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="text-lg font-bold mb-4">',
        'after_title' => '</h4>'
    ]);
}
add_action('widgets_init', 'element_kran_mega_menu_widgets');

function element_kran_scripts() {
    // ... другие скрипты ...
    
    wp_enqueue_script(
        'element-kran-mega-menu',
        get_template_directory_uri() . '/assets/js/mega-menu.js',
        array(),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'element_kran_scripts');

function add_quick_order_scripts() {
    wp_enqueue_script('quick-order', get_template_directory_uri() . '/js/quick-order.js', array('jquery'), '1.0', true);
    wp_localize_script('quick-order', 'quickOrderAjax', array(
        'url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('quick-order-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'add_quick_order_scripts');

function handle_quick_order() {
    check_ajax_referer('quick-order-nonce', 'nonce');
    
    $name = sanitize_text_field($_POST['name']);
    $phone = sanitize_text_field($_POST['phone']);
    $email = sanitize_email($_POST['email']);
    $company = sanitize_text_field($_POST['company']);
    $crane_manufacturer = sanitize_text_field($_POST['crane_manufacturer']);
    $crane_model = sanitize_text_field($_POST['crane_model']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Формируем сообщение
    $to = get_option('admin_email');
    $subject = 'Новый быстрый заказ - ' . get_bloginfo('name');
    $body = "Получен новый быстрый заказ:\n\n";
    $body .= "Имя: $name\n";
    $body .= "Телефон: $phone\n";
    if ($email) $body .= "Email: $email\n";
    if ($company) $body .= "Организация: $company\n";
    $body .= "Производитель крана: $crane_manufacturer\n";
    $body .= "Модель крана: $crane_model\n";
    if ($message) $body .= "Описание необходимых запчастей:\n$message\n";
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    $sent = wp_mail($to, $subject, $body, $headers);
    
    if ($sent) {
        wp_send_json_success('Ваш заказ успешно отправлен');
    } else {
        wp_send_json_error('Произошла ошибка при отправке заказа');
    }
}
add_action('wp_ajax_quick_order', 'handle_quick_order');
add_action('wp_ajax_nopriv_quick_order', 'handle_quick_order');

// В функцию enqueue_scripts добавляем стили
function enqueue_custom_styles() {
    // ... существующий код ...
    
    wp_add_inline_style('main-style', '
        .faq-section {
            padding: 60px 0;
            background: #f8f8f8;
        }
        
        .faq-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-top: 40px;
        }
        
        .faq-item {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .faq-item:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .faq-question {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            position: relative;
            cursor: pointer;
            padding-right: 30px;
        }
        
        .faq-question:after {
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            border-right: 2px solid #666;
            border-bottom: 2px solid #666;
            transform: translateY(-50%) rotate(45deg);
            transition: transform 0.3s ease;
        }
        
        .faq-item.active .faq-question:after {
            transform: translateY(-50%) rotate(-135deg);
        }
        
        .faq-answer {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            display: none;
        }
        
        @media (max-width: 768px) {
            .faq-grid {
                grid-template-columns: 1fr;
            }
        }
    ');

    wp_add_inline_style('crane-parts-theme', '
        .btn-primary {
            background-color: #f38e19;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: #e07d08;
        }
    ');
}
add_action("wp_enqueue_scripts", "enqueue_custom_styles");

// Добавляем в функцию enqueue_scripts
function enqueue_custom_scripts() {
    // ... существующий код ...
    
    wp_add_inline_script('jquery', '
        jQuery(document).ready(function($) {
            $(".faq-question").click(function() {
                $(this).next(".faq-answer").slideToggle();
                $(this).parent(".faq-item").toggleClass("active");
            });
            
            // Скрываем все ответы изначально
            $(".faq-answer").hide();
        });
    ');
}
add_action("wp_enqueue_scripts", "enqueue_custom_scripts");

function add_faq_script() {
    wp_add_inline_script('jquery', '
        function toggleFAQ(button) {
            var content = button.nextElementSibling;
            var icon = button.querySelector("svg");
            
            if (content.classList.contains("hidden")) {
                content.classList.remove("hidden");
                icon.style.transform = "rotate(180deg)";
            } else {
                content.classList.add("hidden");
                icon.style.transform = "rotate(0)";
            }
        }
    ');
}
add_action('wp_enqueue_scripts', 'add_faq_script');

// Функция для правильного склонения слов
function get_russian_plural($number, $one, $two, $five) {
    $number = abs($number);
    $number = $number % 100;
    
    if ($number >= 11 && $number <= 19) {
        return $five;
    }
    
    $number = $number % 10;
    
    if ($number == 1) {
        return $one;
    }
    if ($number >= 2 && $number <= 4) {
        return $two;
    }
    
    return $five;
}