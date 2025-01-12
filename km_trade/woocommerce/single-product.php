<?php
/**
 * The Template for displaying all single products
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<main>
    <div class="container mx-auto px-4 py-8">
        <!-- Хлебные крошки -->
        <?php woocommerce_breadcrumb(); ?>

        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <div class="bg-white rounded-lg shadow-sm p-6 mt-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Галерея изображений -->
                    <div>
                        <?php
                        woocommerce_show_product_images();
                        ?>
                    </div>

                    <!-- Информация о товаре -->
                    <div>
                        <?php
                        woocommerce_template_single_title();
                        woocommerce_template_single_price();
                        woocommerce_template_single_excerpt();
                        ?>

                        <!-- Характеристики -->
                        <?php if ($product->get_attributes()) : ?>
                            <div class="border-t border-gray-200 mt-6 pt-6">
                                <h3 class="text-lg font-bold mb-4">Характеристики</h3>
                                <?php do_action('woocommerce_product_additional_information', $product); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Кнопка заказа -->
                        <div class="mt-6">
                            <button onclick="addToOrder('<?php echo esc_attr(get_the_title()); ?>')" 
                                    class="w-full md:w-auto px-8 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                                Заказать
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Описание -->
                <?php if ($product->get_description()) : ?>
                    <div class="border-t border-gray-200 mt-8 pt-8">
                        <h2 class="text-2xl font-bold mb-4">Описание</h2>
                        <div class="prose max-w-none">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Похожие товары -->
                <?php
                woocommerce_output_related_products();
                ?>
            </div>

        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
