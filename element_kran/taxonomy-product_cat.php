<?php
// Перенаправляем на страницу parts
$category = get_queried_object();
$catalog_url = home_url('/catalog');
$redirect_url = add_query_arg(array(
    'product_cat' => $category->slug,
    'filter' => 'category'
), $catalog_url);

wp_redirect($redirect_url);
exit;
?> 