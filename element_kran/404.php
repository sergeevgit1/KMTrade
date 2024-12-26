<?php get_header(); ?>

<main class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto text-center">
        <!-- Номер ошибки -->
        <h1 class="text-9xl font-bold text-primary mb-4">404</h1>
        
        <!-- Заголовок -->
        <h2 class="text-3xl font-bold text-gray-900 mb-4">
            <?php echo esc_html(get_theme_mod('404_title', 'Страница не найдена')); ?>
        </h2>
        
        <!-- Описание -->
        <p class="text-gray-600 mb-8">
            <?php echo esc_html(get_theme_mod('404_description', 'К сожалению, запрашиваемая страница не существует или была перемещена. Возможно, вы перешли по устаревшей ссылке или неверно ввели адрес.')); ?>
        </p>
        
        <!-- Поиск -->
        <div class="mb-8">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" 
                  class="flex max-w-md mx-auto">
                <input type="search" name="s" 
                       class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:border-primary"
                       placeholder="Поиск по сайту..." />
                <button type="submit" 
                        class="px-6 py-2 bg-primary text-white rounded-r-lg hover:bg-primary-hover transition-colors">
                    Найти
                </button>
            </form>
        </div>
        
        <!-- Полезные ссылки -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900">Возможно, вас заинтересует:</h3>
            <div class="flex flex-wrap justify-center gap-4">
                <?php for ($i = 1; $i <= 3; $i++): 
                    $title = get_theme_mod('404_link_' . $i . '_title');
                    $url = get_theme_mod('404_link_' . $i . '_url');
                    $icon = get_theme_mod('404_link_' . $i . '_icon');
                    
                    if ($title && $url):
                        // Получаем SVG иконки
                        $icon_svg = crane_parts_get_404_icon($icon);
                ?>
                    <a href="<?php echo esc_url($url); ?>" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <span class="w-5 h-5 mr-2"><?php echo $icon_svg; ?></span>
                        <?php echo esc_html($title); ?>
                    </a>
                <?php 
                    endif;
                endfor; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?> 