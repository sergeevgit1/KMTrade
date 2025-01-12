<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="hidden lg:block py-[14px]">
    <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px]">
        <div class="flex flex-wrap justify-between items-center text-sm">
            <!-- Левая часть с контактной информацией -->
            <div class="flex flex-wrap items-center gap-4 lg:gap-6">
                <!-- Адрес -->
                <div class="flex items-center text-gray-600">
                    <svg class="w-4 h-4 mr-1 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-xs lg:text-sm"><?php echo esc_html(get_option('km_trade_contact_address')); ?></span>
                </div>
                
                <!-- Время работы -->
                <div class="flex items-center text-gray-600">
                    <svg class="w-4 h-4 mr-1 text-brand-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-xs lg:text-sm"><?php echo esc_html(get_option('km_trade_work_hours')); ?></span>
                </div>
            </div>

            <!-- Правая часть с меню -->
            <div class="flex items-center">
                <nav class="hidden lg:block">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'top-bar',
                        'container'      => false,
                        'menu_class'     => 'flex items-center space-x-4',
                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                        'fallback_cb'    => false,
                        'depth'          => 1
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </div>
</div>
