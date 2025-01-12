<?php
/**
 * The Template for displaying product archives
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main>
    <!-- Баннер -->
    <?php get_template_part('template-parts/catalog/banner'); ?>

    <div class="container mx-auto px-4 py-8">
        <!-- Хлебные крошки -->
        <?php woocommerce_breadcrumb(); ?>

        <div class="grid lg:grid-cols-4 gap-8 mt-8">
            <!-- Сайдбар с фильтрами -->
            <aside class="lg:col-span-1">
                <?php get_template_part('template-parts/catalog/filters'); ?>
            </aside>

            <!-- Список товаров -->
            <div class="lg:col-span-3">
                <?php if (woocommerce_product_loop()) : ?>
                    <!-- Сортировка и количество -->
                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <?php
                        woocommerce_catalog_ordering();
                        woocommerce_result_count();
                        ?>
                    </div>

                    <!-- Товары -->
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                    <div class="text-center py-12">
                        <p class="text-gray-500"><?php esc_html_e('Товары не найдены', 'km-trade'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
