<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="pb-[14px]">
    <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px]">
        <!-- Верхний ярус шапки -->
        <div class="flex items-center gap-4">
            <!-- Бургер меню для планшетов и мобильных -->
            <button type="button" 
                    id="burger-menu"
                    class="lg:hidden flex items-center justify-center w-10 h-10 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Логотип и название компании -->
            <div class="flex-shrink-0">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                    <?php 
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id) {
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        ?>
                        <img src="<?php echo esc_url($logo[0]); ?>" 
                             alt="<?php echo get_bloginfo('name'); ?> логотип"
                             class="w-[40px] h-[40px] lg:w-[56px] lg:h-[56px] flex-shrink-0 object-contain mr-[7px]">
                    <?php } ?>
                    <div class="hidden sm:block space-y-[1px]">
                        <div class="text-[16px] lg:text-[20px] font-bold font-inter leading-normal">
                            <span class="text-[#F38E19]">КМ</span><span class="text-black">-Трейд</span>
                        </div>
                        <div class="text-[10px] lg:text-[11px] font-inter font-normal leading-normal text-black">
                            Торговая компания
                        </div>
                    </div>
                </a>
            </div>

            <!-- Поиск (скрыт на мобильных, показан на десктопе) -->
            <div class="hidden lg:block flex-1 mx-8">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/catalog/')); ?>" 
                      class="relative flex w-full max-w-[720px] mx-auto">
                    <div class="relative flex-grow">
                        <input type="search" 
                               name="table-search" 
                               class="w-full h-[48px] rounded-l-[5px] border border-r-0 border-[#9F9F9F] bg-transparent pl-12 pr-4 focus:border-[#F38D19] focus:ring-2 focus:ring-[#F38D19]/20" 
                               placeholder="Поиск по каталогу"
                               value="<?php echo isset($_GET['table-search']) ? esc_attr($_GET['table-search']) : ''; ?>">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                    </div>
                    <button type="submit" 
                            class="h-[48px] px-6 bg-[#F38D19] text-white font-medium rounded-r-[5px] hover:bg-[#E07D08] transition-colors">
                        Найти
                    </button>
                </form>
            </div>

            <!-- Контакты и корзина - скрыты на мобильных -->
            <div class="hidden md:flex items-center gap-6 ml-auto">
                <div class="text-right">
                    <a href="tel:<?php echo esc_html(get_option('km_trade_phone')); ?>" 
                       class="text-base lg:text-lg font-bold text-gray-900 hover:text-[#F38E19] transition-colors">
                        <?php echo esc_html(get_option('km_trade_phone')); ?>
                    </a>
                    <div class="text-xs lg:text-sm text-gray-500">
                        <?php echo esc_html(get_option('km_trade_work_hours')); ?>
                    </div>
                </div>
            </div>

            <!-- Корзина -->
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" 
               class="flex items-center justify-center w-10 h-10 bg-[#F38E19] rounded-full ml-auto md:ml-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </a>
        </div>

        <!-- Поиск для мобильных и планшетов -->
        <div class="mt-4 lg:hidden">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/catalog/')); ?>" 
                  class="relative flex w-full">
                <div class="relative flex-grow">
                    <input type="search" 
                           name="table-search" 
                           class="w-full h-[40px] rounded-l-[5px] border border-r-0 border-[#9F9F9F] bg-transparent pl-12 pr-4 focus:border-[#F38D19] focus:ring-2 focus:ring-[#F38D19]/20" 
                           placeholder="Поиск по каталогу"
                           value="<?php echo isset($_GET['table-search']) ? esc_attr($_GET['table-search']) : ''; ?>">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                </div>
                <button type="submit" 
                        class="h-[40px] px-4 bg-[#F38D19] text-white font-medium rounded-r-[5px] hover:bg-[#E07D08] transition-colors">
                    Найти
                </button>
            </form>
        </div>
    </div>
</div> 