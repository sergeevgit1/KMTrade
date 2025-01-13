<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Top bar виден только на десктопе -->
<div class="hidden lg:block py-[14px]">
    <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px]">
        <div class="flex justify-between items-center">
            <!-- Левая часть -->
            <div class="flex items-center gap-6">
                <div class="flex items-center text-gray-600">
                    <svg class="w-4 h-4 mr-2 text-[#F38E19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm"><?php echo esc_html(get_option('km_trade_contact_address')); ?></span>
                </div>
                <div class="flex items-center text-gray-600">
                    <svg class="w-4 h-4 mr-2 text-[#F38E19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm"><?php echo esc_html(get_option('km_trade_work_hours')); ?></span>
                </div>
            </div>

            <!-- Правая часть -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'top-bar',
                'container' => false,
                'menu_class' => 'flex items-center gap-6 text-sm text-gray-600',
                'fallback_cb' => false,
                'depth' => 1
            ));
            ?>
        </div>
    </div>
</div>
