<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Обработчик формы быстрого заказа
 */
function km_trade_handle_quick_order() {
    // Проверка nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'quick_order_nonce')) {
        wp_send_json_error('Ошибка безопасности');
    }

    // Получаем данные
    $name = sanitize_text_field($_POST['customer_name'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $crane_model = sanitize_text_field($_POST['crane_model'] ?? '');
    $parts_list = sanitize_textarea_field($_POST['parts_list'] ?? '');

    // Проверяем обязательные поля
    if (empty($name) || empty($phone) || empty($parts_list)) {
        wp_send_json_error('Заполните все обязательные поля');
    }

    // Формируем сообщение
    $message = "Новый быстрый заказ:\n\n";
    $message .= "Имя: {$name}\n";
    $message .= "Телефон: {$phone}\n";
    $message .= "Модель крана: {$crane_model}\n";
    $message .= "Список запчастей:\n{$parts_list}";

    // Отправляем письмо
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>'
    );

    $sent = wp_mail(
        $admin_email,
        'Новый быстрый заказ на сайте ' . $site_name,
        $message,
        $headers
    );

    if ($sent) {
        wp_send_json_success('Заявка успешно отправлена');
    } else {
        wp_send_json_error('Ошибка при отправке заявки');
    }
}
add_action('wp_ajax_km_trade_quick_order', 'km_trade_handle_quick_order');
add_action('wp_ajax_nopriv_km_trade_quick_order', 'km_trade_handle_quick_order');

/**
 * Обработчик формы подписки
 */
function km_trade_handle_subscribe() {
    // Проверка nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'subscribe_nonce')) {
        wp_send_json_error('Ошибка безопасности');
    }

    $email = sanitize_email($_POST['email'] ?? '');

    if (empty($email)) {
        wp_send_json_error('Введите корректный email');
    }

    // Здесь можно добавить логику для сохранения email в базу данных
    // или интеграцию с сервисом рассылок

    // Отправляем уведомление администратору
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    
    $message = "Новая подписка на рассылку:\nEmail: {$email}";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>'
    );

    $sent = wp_mail(
        $admin_email,
        'Новая подписка на рассылку - ' . $site_name,
        $message,
        $headers
    );

    if ($sent) {
        wp_send_json_success('Вы успешно подписались на рассылку');
    } else {
        wp_send_json_error('Ошибка при оформлении подписки');
    }
}
add_action('wp_ajax_km_trade_subscribe', 'km_trade_handle_subscribe');
add_action('wp_ajax_nopriv_km_trade_subscribe', 'km_trade_handle_subscribe');

/**
 * Обработчик формы заказа
 */
function km_trade_submit_order() {
    // Проверка nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'order_nonce')) {
        wp_send_json_error(array('message' => 'Ошибка безопасности'));
    }

    // Получаем данные
    $name = sanitize_text_field($_POST['name'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $parts_list = sanitize_textarea_field($_POST['parts_list'] ?? '');

    // Проверяем обязательные поля
    if (empty($name) || empty($phone) || empty($parts_list)) {
        wp_send_json_error(array('message' => 'Заполните все обязательные поля'));
    }

    // Формируем сообщение
    $message = "Новый заказ:\n\n";
    $message .= "Имя: {$name}\n";
    $message .= "Телефон: {$phone}\n";
    if ($email) {
        $message .= "Email: {$email}\n";
    }
    $message .= "\nСписок запчастей:\n{$parts_list}";

    // Отправляем письмо
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>'
    );

    $sent = wp_mail(
        $admin_email,
        'Новый заказ на сайте ' . $site_name,
        $message,
        $headers
    );

    if ($sent) {
        wp_send_json_success(array('message' => 'Заявка успешно отправлена'));
    } else {
        wp_send_json_error(array('message' => 'Ошибка при отправке заявки'));
    }
}
add_action('wp_ajax_km_trade_submit_order', 'km_trade_submit_order');
add_action('wp_ajax_nopriv_km_trade_submit_order', 'km_trade_submit_order'); 