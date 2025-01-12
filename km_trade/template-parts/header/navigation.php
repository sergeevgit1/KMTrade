<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="bg-white">
    <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px]">
        <nav class="hidden lg:flex items-center justify-between">
            <!-- Каталог -->
            <div class="flex-shrink-0">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'catalog-menu',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                    'walker'         => new KM_Trade_Button_Nav_Walker()
                ));
                ?>
            </div>

            <!-- Основное меню -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'flex items-center gap-[29px]',
                'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                'fallback_cb'    => false,
                'depth'          => 1,
                'walker'         => new KM_Trade_Nav_Walker('center')
            ));
            ?>

            <!-- Быстрый заказ -->
            <div class="flex-shrink-0">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'quick-order-menu',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                    'walker'         => new KM_Trade_Button_Nav_Walker()
                ));
                ?>
            </div>
        </nav>
    </div>
</div>

<!-- Мобильное меню -->
<?php get_template_part('template-parts/header/mobile-menu'); ?> 