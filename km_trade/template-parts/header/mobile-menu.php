<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Мобильное меню -->
<div id="mobile-menu" class="fixed inset-0 z-50 lg:hidden hidden">
    <!-- Затемненный фон -->
    <div class="absolute inset-0 bg-black/50 transition-opacity"></div>

    <!-- Контент меню -->
    <div class="absolute left-0 top-0 h-full w-[300px] bg-white transform transition-transform duration-300 -translate-x-full">
        <!-- Шапка меню -->
        <div class="flex items-center justify-between p-4 border-b">
            <!-- Логотип и название -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                <?php 
                $custom_logo_id = get_theme_mod('custom_logo');
                if ($custom_logo_id) {
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    ?>
                    <img src="<?php echo esc_url($logo[0]); ?>" 
                         alt="<?php echo get_bloginfo('name'); ?> логотип"
                         class="w-[32px] h-[32px] flex-shrink-0 object-contain mr-3">
                <?php } ?>
                <div class="space-y-[1px]">
                    <div class="text-[16px] font-bold font-inter leading-normal">
                        <span class="text-[#F38E19]">КМ</span><span class="text-black">-Трейд</span>
                    </div>
                    <div class="text-[10px] font-inter font-normal leading-normal text-black/60">
                        Торговая компания
                    </div>
                </div>
            </a>

            <!-- Кнопка закрытия -->
            <button data-action="close-menu"
                    class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-6 h-6 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Контент меню -->
        <div class="overflow-y-auto h-[calc(100%-64px)]">
            <!-- Основные кнопки -->
            <div class="p-4 space-y-3 border-b">
                <!-- Каталог -->
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>" 
                   class="flex items-center gap-3 w-full px-4 py-3 bg-[#F38D19] text-white rounded-lg hover:bg-[#E07D08] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <span class="font-medium">Каталог запчастей</span>
                </a>

                <!-- Мой заказ -->
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" 
                   class="flex items-center gap-3 w-full px-4 py-3 bg-white border-2 border-[#F38D19] text-[#F38D19] rounded-lg hover:bg-[#F38D19]/5 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="font-medium">Мой заказ</span>
                </a>

                <!-- Быстрый заказ -->
                <a href="#" 
                   class="flex items-center gap-3 w-full px-4 py-3 bg-white border-2 border-[#F38D19] text-[#F38D19] rounded-lg hover:bg-[#F38D19]/5 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span class="font-medium">Быстрый заказ</span>
                </a>
            </div>

            <!-- Основное меню -->
            <div class="p-4 border-b">
                <div class="font-medium text-gray-900 mb-3">Навигация</div>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'space-y-2',
                    'fallback_cb' => false,
                    'depth' => 2
                ));
                ?>
            </div>

            <!-- Контакты -->
            <div class="p-4 space-y-4">
                <div class="font-medium text-gray-900 mb-3">Контакты</div>
                
                <!-- Телефон -->
                <a href="tel:<?php echo esc_html(get_option('km_trade_phone')); ?>" 
                   class="flex items-center text-gray-700 hover:text-[#F38E19] transition-colors">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-[#F38E19]/10 mr-3">
                        <svg class="w-4 h-4 text-[#F38E19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </span>
                    <?php echo esc_html(get_option('km_trade_phone')); ?>
                </a>

                <!-- Время работы -->
                <div class="flex items-center text-gray-700">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-[#F38E19]/10 mr-3">
                        <svg class="w-4 h-4 text-[#F38E19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    <?php echo esc_html(get_option('km_trade_work_hours')); ?>
                </div>

                <!-- Адрес -->
                <div class="flex items-center text-gray-700">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-[#F38E19]/10 mr-3">
                        <svg class="w-4 h-4 text-[#F38E19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    <?php echo esc_html(get_option('km_trade_contact_address')); ?>
                </div>
            </div>
        </div>
    </div>
</div> 