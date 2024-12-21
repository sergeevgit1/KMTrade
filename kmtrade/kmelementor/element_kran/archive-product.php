<?php get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Боковая панель с категориями -->
        <div class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Категории</h2>
                <div class="space-y-2">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                        'parent' => 0
                    ));

                    if (!empty($categories) && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            $current = is_tax('product_cat', $category->term_id) ? 'text-primary font-semibold' : 'text-gray-600';
                            ?>
                            <div class="category-item">
                                <a href="<?php 
                                    // Формируем URL каталога с фильтром по категории
                                    $catalog_url = get_permalink(get_page_by_path('catalog'));
                                    $filter_url = add_query_arg(array(
                                        'product_cat' => $category->slug,
                                        'filter' => 'category'
                                    ), $catalog_url);
                                    echo esc_url($filter_url);
                                ?>" 
                                   class="flex items-center gap-2 hover:text-primary transition-colors <?php echo $current; ?>">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                    <?php echo esc_html($category->name); ?>
                                    <span class="text-sm text-gray-400">(<?php echo $category->count; ?>)</span>
                                </a>
                                <?php
                                // Подкатегории
                                $subcategories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => false,
                                    'parent' => $category->term_id
                                ));

                                if (!empty($subcategories) && !is_wp_error($subcategories)) {
                                    echo '<div class="ml-4 mt-2 space-y-2">';
                                    foreach ($subcategories as $subcategory) {
                                        $current_sub = is_tax('product_cat', $subcategory->term_id) ? 'text-primary font-semibold' : 'text-gray-500';
                                        // Формируем URL для подкатегории
                                        $subcat_url = add_query_arg(array(
                                            'product_cat' => $subcategory->slug,
                                            'filter' => 'category'
                                        ), $catalog_url);
                                        ?>
                                        <a href="<?php echo esc_url($subcat_url); ?>" 
                                           class="flex items-center gap-2 text-sm hover:text-primary transition-colors <?php echo $current_sub; ?>">
                                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                            <?php echo esc_html($subcategory->name); ?>
                                            <span class="text-sm text-gray-400">(<?php echo $subcategory->count; ?>)</span>
                                        </a>
                                        <?php
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Фильтры -->
            <div class="bg-white rounded-lg shadow-sm p-6 mt-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Фильтры</h2>
                <?php dynamic_sidebar('shop-sidebar'); ?>
            </div>
        </div>

        <!-- Основной контент -->
        <div class="flex-1">
            <?php if (woocommerce_product_loop()): ?>
                <!-- Заголовк и сортировка -->
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">
                        <?php woocommerce_page_title(); ?>
                    </h1>
                    <div class="flex items-center gap-4">
                        <?php woocommerce_catalog_ordering(); ?>
                    </div>
                </div>

                <!-- Табличное отображение товаров -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Фото
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Наименование
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Артикул
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Цена
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Действия
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php
                            while (have_posts()) {
                                the_post();
                                global $product;
                                ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="w-16 h-16">
                                            <?php if (has_post_thumbnail()): ?>
                                                <img src="<?php echo get_the_post_thumbnail_url(null, 'thumbnail'); ?>" 
                                                     alt="<?php the_title_attribute(); ?>"
                                                     class="w-full h-full object-cover rounded">
                                            <?php else: ?>
                                                <div class="w-full h-full bg-gray-100 rounded flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-primary">
                                            <div class="font-medium"><?php the_title(); ?></div>
                                            <?php if ($product->get_short_description()): ?>
                                                <div class="text-sm text-gray-500 mt-1">
                                                    <?php echo wp_trim_words($product->get_short_description(), 10); ?>
                                                </div>
                                            <?php endif; ?>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo $product->get_sku() ? $product->get_sku() : '—'; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($product->get_price()): ?>
                                            <div class="text-gray-900 font-medium"><?php echo $product->get_price_html(); ?></div>
                                        <?php else: ?>
                                            <div class="text-gray-500">Цена по запросу</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="<?php the_permalink(); ?>" 
                                           class="inline-flex items-center text-primary hover:text-primary-hover transition-colors">
                                            Подробнее
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Пагинация -->
                <?php if ($wp_query->max_num_pages > 1): ?>
                    <div class="mt-8">
                        <?php woocommerce_pagination(); ?>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-gray-500">Товары не найдены</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 