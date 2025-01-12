<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="border-t border-zinc-800 pt-8">
    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <!-- Копирайт -->
        <div class="text-zinc-400 text-sm">
            © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
            Все права защищены.
        </div>

        <!-- Политика конфиденциальности -->
        <div>
            <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" 
               class="text-zinc-400 hover:text-white text-sm transition-colors">
                Политика конфиденциальности
            </a>
        </div>
    </div>
</div> 