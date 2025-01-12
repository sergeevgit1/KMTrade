<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Мобильная навигация -->
<div class="lg:hidden">
    <div class="container mx-auto px-4">
        <div class="bg-brand-orange rounded-lg">
            <div class="flex items-stretch">
                <!-- Каталог -->
                <div class="relative">
                    <button type="button"
                            class="flex h-full items-center gap-2 bg-brand-orange-dark text-white px-6 py-3.5 hover:bg-opacity-90 transition-colors rounded-l-lg"
                            @click="mobileMenuOpen = !mobileMenuOpen">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <span class="font-medium whitespace-nowrap">МЕНЮ</span>
                    </button>
                </div>

                <!-- Быстрый заказ и корзина -->
                <div class="flex items-center ml-auto">
                    <a href="<?php echo esc_url(get_theme_mod('quick_order_url', '#')); ?>" 
                       class="px-4 py-2 text-white hover:bg-brand-orange-dark transition-colors">
                        <span class="text-sm uppercase">Заказ</span>
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('cart_url', '#')); ?>"
                       class="flex items-center px-4 py-3.5 text-white hover:bg-brand-orange-dark transition-colors rounded-r-lg">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Выпадающее мобильное меню -->
<div class="mobile-menu lg:hidden fixed inset-y-0 right-0 w-full max-w-sm bg-white shadow-xl z-50 transform translate-x-full transition-transform duration-300"
     x-show="mobileMenuOpen"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-x-full"
     x-transition:enter-end="translate-x-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="translate-x-0"
     x-transition:leave-end="translate-x-full"
     @click.away="mobileMenuOpen = false">
    
    <!-- Шапка мобильного меню -->
    <div class="p-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-lg font-bold text-gray-900">Меню</div>
            <button @click="mobileMenuOpen = false" class="p-2 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Основное меню -->
    <div class="flex-1 overflow-y-auto py-4">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'mobile',
            'container' => false,
            'menu_class' => 'space-y-2',
            'walker' => new KM_Trade_Nav_Walker(),
            'fallback_cb' => false
        ));
        ?>
    </div>

    <!-- Контакты -->
    <div class="p-4 border-t border-gray-200">
        <div class="space-y-4">
            <a href="tel:<?php echo esc_attr(get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX')); ?>" 
               class="flex items-center text-gray-600 hover:text-brand-orange">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <?php echo esc_html(get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX')); ?>
            </a>
            
            <!-- Социальные сети -->
            <div class="flex items-center space-x-4">
                <?php get_template_part('template-parts/footer/social-links'); ?>
            </div>
        </div>
    </div>
</div> 