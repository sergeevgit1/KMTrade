<div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 12,
    );

    $products = new WP_Query($args);

    if ($products->have_posts()) :
        while ($products->have_posts()) : $products->the_post();
            global $product;
    ?>
        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
            <!-- Изображение товара -->
            <div class="aspect-w-4 aspect-h-3">
                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php echo get_the_post_thumbnail_url(null, 'medium'); ?>"
                         alt="<?php the_title_attribute(); ?>"
                         class="w-full h-full object-cover">
                <?php endif; ?>
            </div>
            
            <!-- Информация о товаре -->
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    <a href="<?php the_permalink(); ?>" class="hover:text-[#F38D19]">
                        <?php the_title(); ?>
                    </a>
                </h3>
                
                <?php if ($product->get_price()) : ?>
                    <div class="text-[#F38D19] font-bold mb-4">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                <?php endif; ?>
                
                <button onclick="addToOrder('<?php echo esc_attr(get_the_title()); ?>')"
                        class="w-full bg-[#F38D19] text-white py-2 rounded hover:bg-[#E07D08] transition-colors">
                    Заказать
                </button>
            </div>
        </div>
    <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div> 