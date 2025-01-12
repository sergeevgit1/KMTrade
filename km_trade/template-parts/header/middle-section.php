<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="pb-[14px]">
    <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px]">
        <div class="flex flex-wrap items-center gap-4 lg:gap-8">
            <!-- Логотип и название компании -->
            <div class="w-full sm:w-auto lg:w-[250px] flex-shrink-0">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center justify-center sm:justify-start">
                    <?php 
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id) {
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        ?>
                        <img src="<?php echo esc_url($logo[0]); ?>" 
                             alt="<?php echo get_bloginfo('name'); ?> логотип"
                             class="w-[40px] h-[40px] lg:w-[56px] lg:h-[56px] flex-shrink-0 object-contain mr-[7px]">
                    <?php } else { ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" 
                             alt="<?php echo get_bloginfo('name'); ?> логотип"
                             class="w-[40px] h-[40px] lg:w-[56px] lg:h-[56px] flex-shrink-0 object-contain mr-[7px]">
                    <?php } ?>
                    <div class="space-y-[1px]">
                        <div class="text-[16px] lg:text-[20px] font-bold font-inter leading-normal">
                            <span class="text-[#F38E19]">КМ</span><span class="text-black">-Трейд</span>
                        </div>
                        <div class="text-[10px] lg:text-[11px] font-inter font-normal leading-normal text-black">
                            Торговая компания
                        </div>
                    </div>
                </a>
            </div>

            <!-- Поиск -->
            <div class="flex-1 w-full sm:w-auto flex justify-center">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative w-full max-w-[720px]">
                    <input type="search" 
                           name="s" 
                           class="w-full h-[40px] lg:h-[48px] flex-shrink-0 rounded-[5px] border border-[#9F9F9F] bg-transparent pl-12 pr-4" 
                           placeholder="Поиск по каталогу запчастей">
                    <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Контакты и корзина -->
            <div class="w-full sm:w-auto lg:w-[250px] flex-shrink-0 flex items-center gap-4 lg:gap-6 justify-between sm:justify-end">
                <div class="text-right hidden sm:block">
                    <a href="tel:<?php echo esc_html(get_option('km_trade_phone')); ?>" 
                       class="text-base lg:text-lg font-bold text-gray-900 hover:text-brand-orange transition-colors">
                        <?php echo esc_html(get_option('km_trade_phone')); ?>
                    </a>
                    <div class="text-xs lg:text-sm text-gray-500">
                        <?php echo esc_html(get_option('km_trade_work_hours')); ?>
                    </div>
                </div>
                
                <!-- Корзина -->
                <div class="relative">
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" 
                       class="flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 bg-[#F38E19] rounded-full">
                        <svg class="w-4 h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> 