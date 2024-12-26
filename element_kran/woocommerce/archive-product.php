<?php get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap -mx-4">
        <!-- Сайдбар с фильтрами -->
        <div class="w-full md:w-1/4 px-4">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">Фильтры</h3>
                
                <?php
                // Категории
                $product_categories = get_terms('product_cat', array('hide_empty' => true));
                if ($product_categories) :
                ?>
                <div class="mb-6">
                    <h4 class="font-medium mb-2">Категории</h4>
                    <div class="space-y-2">
                        <?php foreach ($product_categories as $category) : ?>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox" name="product_cat[]" value="<?php echo esc_attr($category->slug); ?>">
                                <span class="ml-2"><?php echo esc_html($category->name); ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Другие фильтры -->
                <div class="mb-6">
                    <h4 class="font-medium mb-2">Производитель</h4>
                    <?php
                    $manufacturers = get_terms(array(
                        'taxonomy' => 'product_manufacturer',
                        'hide_empty' => true
                    ));
                    
                    if (!empty($manufacturers) && !is_wp_error($manufacturers)) {
                        echo '<div class="space-y-2">';
                        foreach ($manufacturers as $manufacturer) {
                            printf(
                                '<label class="flex items-center">
                                    <input type="checkbox" class="form-checkbox" name="manufacturer[]" value="%s"%s>
                                    <span class="ml-2">%s</span>
                                </label>',
                                esc_attr($manufacturer->slug),
                                checked(in_array($manufacturer->slug, (array) $_GET['manufacturer']), true, false),
                                esc_html($manufacturer->name)
                            );
                        }
                        echo '</div>';
                    }
                    ?>
                </div>

                <div class="mb-6">
                    <h4 class="font-medium mb-2">Модель крана</h4>
                    <?php
                    // Получаем уникальные модели кранов из мета-поля
                    global $wpdb;
                    $crane_models = $wpdb->get_col(
                        "SELECT DISTINCT meta_value 
                        FROM {$wpdb->postmeta} 
                        WHERE meta_key = '_compatible_cranes' 
                        AND meta_value != ''"
                    );
                    
                    if (!empty($crane_models)) {
                        echo '<div class="space-y-2">';
                        foreach ($crane_models as $model) {
                            printf(
                                '<label class="flex items-center">
                                    <input type="checkbox" class="form-checkbox" name="crane_model[]" value="%s"%s>
                                    <span class="ml-2">%s</span>
                                </label>',
                                esc_attr($model),
                                checked(in_array($model, (array) $_GET['crane_model']), true, false),
                                esc_html($model)
                            );
                        }
                        echo '</div>';
                    }
                    ?>
                </div>

                <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-hover transition-colors">
                    Применить фильтры
                </button>
            </div>
        </div>

        <!-- Список товаров -->
        <div class="w-full md:w-3/4 px-4">
            <?php if (woocommerce_product_loop()) : ?>
                <!-- Сортировка и количество товаров -->
                <div class="flex justify-between items-center mb-6">
                    <?php woocommerce_catalog_ordering(); ?>
                    <?php woocommerce_result_count(); ?>
                </div>

                <!-- Товары -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php
                    while (have_posts()) :
                        the_post();
                        wc_get_template_part('content', 'product');
                    endwhile;
                    ?>
                </div>

                <!-- Пагинация -->
                <?php woocommerce_pagination(); ?>

            <?php else : ?>
                <p class="text-center py-8">Товары не найдены</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 