<?php
if (!defined('ABSPATH')) {
    exit;
}

global $product;
?>

<div class="bg-white border border-zinc-100 rounded-[20px] overflow-hidden hover:shadow-md transition-shadow">
    <!-- Изображение товара -->
    <div class="aspect-w-4 aspect-h-3">
        <?php if (has_post_thumbnail()) : ?>
            <img src="<?php the_post_thumbnail_url('medium'); ?>"
                 alt="<?php the_title_attribute(); ?>"
                 class="w-full h-full object-cover">
        <?php else : ?>
            <div class="w-full h-full bg-zinc-50 flex items-center justify-center">
                <svg class="w-12 h-12 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        <?php endif; ?>
    </div>

    <!-- Информация о товаре -->
    <div class="p-6">
        <h2 class="text-lg font-medium text-zinc-900 mb-2">
            <a href="<?php the_permalink(); ?>" class="hover:text-[#F38D19] transition-colors">
                <?php the_title(); ?>
            </a>
        </h2>
        
        <?php if ($product->get_price()) : ?>
            <div class="text-lg font-bold text-[#F38D19] mb-4">
                <?php echo $product->get_price_html(); ?>
            </div>
        <?php else : ?>
            <div class="text-zinc-500 mb-4">Цена по запросу</div>
        <?php endif; ?>

        <button onclick="addToOrder('<?php echo esc_attr(get_the_title()); ?>')" 
                class="w-full bg-[#F38D19] text-white px-4 py-2 rounded-xl hover:bg-[#E07D08] transition-colors">
            Заказать
        </button>
    </div>
</div>
