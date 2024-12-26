<?php

// В начале файла добавим проверку и перенаправление
if (!isset($_GET['product_cat'])) {
    // Если категория не выбрана, добавляем параметр product_cat=spare-parts
    $redirect_url = add_query_arg(array(
        'product_cat' => 'spare-parts'
    ), get_permalink());
    wp_redirect($redirect_url);
    exit;
} 