<?php
if (!defined('ABSPATH')) {
    exit;
}

// Проверяем, есть ли элементы в меню
if (has_nav_menu('footer_menu')) :
?>
    <div>
        <h4 class="text-[16px] font-bold text-white mb-4">Навигация</h4>
        <?php
        wp_nav_menu([
            'theme_location' => 'footer_menu',
            'container' => false,
            'menu_class' => 'grid grid-cols-2 gap-x-8 gap-y-2',
            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            'link_before' => '<span class="text-[14px] text-white/60 hover:text-[#F38D19] transition-colors flex items-center"><svg class="w-3 h-3 mr-2 text-[#F38D19]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>',
            'link_after' => '</span>'
        ]);
        ?>
    </div>
<?php endif; ?> 