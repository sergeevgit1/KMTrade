<?php
/**
 * Related Products
 */

if (!defined('ABSPATH')) {
    exit;
}

if ($related_products) : ?>

    <section class="border-t border-gray-200 mt-8 pt-8">
        <h2 class="text-2xl font-bold mb-6">
            <?php esc_html_e('Похожие товары', 'km-trade'); ?>
        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($related_products as $related_product) : ?>
                <?php
                $post_object = get_post($related_product->get_id());
                setup_postdata($GLOBALS['post'] =& $post_object);
                ?>

                <?php wc_get_template_part('content', 'product'); ?>

            <?php endforeach; ?>
        </div>
    </section>

<?php endif;

wp_reset_postdata(); 