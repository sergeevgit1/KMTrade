<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div>
    <!-- Логотип -->
    <?php if (has_custom_logo()) : ?>
        <div class="mb-6 invert">
            <?php the_custom_logo(); ?>
        </div>
    <?php else : ?>
        <div class="text-xl font-bold mb-6">
            <?php bloginfo('name'); ?>
        </div>
    <?php endif; ?>

    <!-- Описание -->
    <p class="text-zinc-400 text-sm mb-6">
        <?php echo esc_html(get_theme_mod('footer_about_text')); ?>
    </p>

    <!-- Социальные сети -->
    <div class="flex items-center space-x-4">
        <?php if (get_theme_mod('social_vk')) : ?>
            <a href="<?php echo esc_url(get_theme_mod('social_vk')); ?>" 
               class="text-zinc-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <!-- VK иконка -->
                </svg>
            </a>
        <?php endif; ?>

        <?php if (get_theme_mod('social_telegram')) : ?>
            <a href="<?php echo esc_url(get_theme_mod('social_telegram')); ?>" 
               class="text-zinc-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <!-- Telegram иконка -->
                </svg>
            </a>
        <?php endif; ?>
    </div>
</div> 