<div class="bg-white rounded-lg shadow-sm overflow-hidden group">
    <!-- Изображение товара -->
    <div class="aspect-w-1 aspect-h-1 bg-gray-200 relative">
        <?php woocommerce_template_loop_product_thumbnail(); ?>
        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-opacity"></div>
    </div>

    <!-- Информация о товаре -->
    <div class="p-4">
        <!-- Название -->
        <h2 class="text-lg font-medium mb-2">
            <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-primary transition-colors">
                <?php the_title(); ?>
            </a>
        </h2>

        <!-- Артикул -->
        <div class="text-sm text-gray-600 mb-2">
            Артикул: <?php echo esc_html(get_post_meta(get_the_ID(), '_manufacturer_sku', true)); ?>
        </div>

        <!-- Производитель -->
        <div class="text-sm text-gray-600 mb-4">
            Производитель: <?php echo esc_html(get_post_meta(get_the_ID(), '_manufacturer', true)); ?>
        </div>

        <!-- Цена -->
        <div class="flex justify-between items-center">
            <?php woocommerce_template_loop_price(); ?>
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>
    </div>
</div> 