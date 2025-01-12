<?php
// Функция фильтрации товаров
function km_trade_filter_products() {
    check_ajax_referer('km_trade_nonce', 'nonce');

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 20,
    );

    // Добавляем фильтры
    if (!empty($_POST['manufacturer'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'manufacturer',
            'field' => 'slug',
            'terms' => $_POST['manufacturer']
        );
    }

    if (!empty($_POST['category'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $_POST['category']
        );
    }

    ob_start();
    $products = new WP_Query($args);
    
    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            global $product;
            ?>
            <tr class="hover:bg-zinc-50/50">
                <td class="px-6 py-4">
                    <a href="<?php the_permalink(); ?>" class="text-zinc-900 hover:text-[#F38D19] font-medium">
                        <?php the_title(); ?>
                    </a>
                </td>
                <td class="px-6 py-4 text-sm text-zinc-600">
                    <?php echo $product->get_sku(); ?>
                </td>
                <td class="px-6 py-4 text-sm text-zinc-600">
                    <?php echo $product->get_attribute('manufacturer'); ?>
                </td>
                <td class="px-6 py-4">
                    <?php if ($product->get_price()): ?>
                        <div class="text-zinc-900 font-medium"><?php echo $product->get_price_html(); ?></div>
                    <?php else: ?>
                        <div class="text-zinc-500">Цена по запросу</div>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 text-right">
                    <button onclick="addToOrder('<?php echo esc_attr(get_the_title()); ?>')" 
                            class="inline-flex items-center text-[#F38D19] hover:text-[#E07D08] transition-colors">
                        <span class="mr-2">Заказать</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </td>
            </tr>
            <?php
        }
        wp_reset_postdata();
    }
    $html = ob_get_clean();

    wp_send_json_success($html);
}
add_action('wp_ajax_filter_products', 'km_trade_filter_products');
add_action('wp_ajax_nopriv_filter_products', 'km_trade_filter_products'); 