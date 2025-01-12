<?php
if (!defined('ABSPATH')) {
    exit;
}

function km_trade_customize_register($wp_customize) {
    // Секция контактов
    $wp_customize->add_section('km_trade_contacts', array(
        'title' => __('Контактная информация', 'km-trade'),
        'priority' => 30,
    ));

    // Телефон
    $wp_customize->add_setting('phone_number', array(
        'default' => '+7 (999) 999-99-99',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('phone_number', array(
        'label' => __('Телефон', 'km-trade'),
        'section' => 'km_trade_contacts',
        'type' => 'text',
    ));

    // Email
    $wp_customize->add_setting('contact_email', array(
        'default' => 'info@example.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label' => __('Email', 'km-trade'),
        'section' => 'km_trade_contacts',
        'type' => 'email',
    ));

    // Адрес
    $wp_customize->add_setting('contact_address', array(
        'default' => 'г. Москва, ул. Примерная, д. 1',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label' => __('Адрес', 'km-trade'),
        'section' => 'km_trade_contacts',
        'type' => 'textarea',
    ));

    // Социальные сети
    $wp_customize->add_section('km_trade_social', array(
        'title' => __('Социальные сети', 'km-trade'),
        'priority' => 35,
    ));

    // VK
    $wp_customize->add_setting('social_vk', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('social_vk', array(
        'label' => __('VK', 'km-trade'),
        'section' => 'km_trade_social',
        'type' => 'url',
    ));

    // Telegram
    $wp_customize->add_setting('social_telegram', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('social_telegram', array(
        'label' => __('Telegram', 'km-trade'),
        'section' => 'km_trade_social',
        'type' => 'url',
    ));

    // Текст в футере
    $wp_customize->add_setting('footer_about_text', array(
        'default' => 'Поставляем запчасти для башенных кранов с 2010 года',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('footer_about_text', array(
        'label' => __('Текст о компании в футере', 'km-trade'),
        'section' => 'title_tagline',
        'type' => 'textarea',
    ));

    // Настройки футера
    $wp_customize->add_section('footer_settings', array(
        'title'    => __('Настройки футера', 'km-trade'),
        'priority' => 120,
    ));

    // О компании
    $wp_customize->add_setting('footer_about', array(
        'default'           => 'Мы - ведущий поставщик надежной строительной техники и оборудования.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('footer_about', array(
        'label'    => __('Текст о компании', 'km-trade'),
        'section'  => 'footer_settings',
        'type'     => 'textarea',
    ));

    // Контактные данные
    $contact_fields = array(
        'contact_address' => 'Адрес',
        'contact_phone'   => 'Телефон',
        'contact_email'   => 'Email',
    );

    foreach ($contact_fields as $setting => $label) {
        $wp_customize->add_setting($setting, array(
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control($setting, array(
            'label'    => __($label, 'km-trade'),
            'section'  => 'footer_settings',
            'type'     => 'text',
        ));
    }

    // Социальные сети
    $social_fields = array(
        'social_facebook'  => 'Facebook',
        'social_twitter'   => 'Twitter',
        'social_instagram' => 'Instagram',
    );

    foreach ($social_fields as $setting => $label) {
        $wp_customize->add_setting($setting, array(
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control($setting, array(
            'label'    => __($label, 'km-trade'),
            'section'  => 'footer_settings',
            'type'     => 'url',
        ));
    }
}
add_action('customize_register', 'km_trade_customize_register');
