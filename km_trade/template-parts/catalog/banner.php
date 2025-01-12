<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="py-12 mb-8">
    <div class="max-w-screen-2xl mx-auto px-[30px] lg:px-[120px]">
        <div class="max-w-4xl mx-auto text-center">
            <?php if (is_product_category()) : ?>
                <h1 class="text-4xl md:text-5xl font-bold text-zinc-900 mb-6">
                    <?php single_cat_title(); ?>
                </h1>
                <?php if (category_description()) : ?>
                    <div class="text-xl text-zinc-600">
                        <?php echo category_description(); ?>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <h1 class="text-4xl md:text-5xl font-bold text-zinc-900 mb-6">
                    Каталог запчастей
                </h1>
                <div class="text-xl text-zinc-600">
                    <p>Широкий выбор запчастей для башенных кранов от ведущих производителей</p>
                </div>
            <?php endif; ?>

            <?php 
            // Опционально: добавить изображение категории, если оно есть
            $thumbnail_id = get_term_meta(get_queried_object_id(), 'thumbnail_id', true);
            if ($thumbnail_id) : 
                $image_url = wp_get_attachment_image_url($thumbnail_id, 'full');
            ?>
                <div class="mt-8">
                    <img src="<?php echo esc_url($image_url); ?>" 
                         alt="<?php single_cat_title(); ?>"
                         class="mx-auto rounded-lg shadow-lg"
                         loading="lazy">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section> 