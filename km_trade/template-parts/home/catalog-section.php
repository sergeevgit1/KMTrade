<?php
if (!defined('ABSPATH')) {
    exit;
}

// Определяем категории
$categories_data = array(
    'Подшипники' => array(
        'description' => 'Оригинальные подшипники для всех узлов башенного крана',
        'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
        'color' => 'orange'
    ),
    'Анкеры' => array(
        'description' => 'Анкерные системы и крепления для надежной фиксации',
        'icon' => 'M19 9l-7 7-7-7',
        'color' => 'blue'
    ),
    'Троса' => array(
        'description' => 'Тросы, канаты и комплектующие высокой прочности',
        'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
        'color' => 'green'
    )
);

// Определяем производителей
$manufacturers = array(
    'zoomlion' => array(
        'name' => 'Zoomlion',
        'description' => 'Официальный поставщик запчастей для башенных кранов Zoomlion',
        'models' => array('WA6017-10', 'WA7025-12'),
        'featured' => true
    ),
    'potain' => array(
        'name' => 'Potain',
        'description' => 'Запчасти для кранов Potain всех серий',
        'models' => array('MC 175', 'MC 2358', 'HMC 205', 'MC 310')
    ),
    'liebherr' => array(
        'name' => 'Liebherr',
        'description' => 'Комплетующие для башенных кранов Liebherr',
        'models' => array('112 EC-H', '132 EC-H')
    ),
    'comansa' => array(
        'name' => 'Comansa',
        'description' => 'Запасные части для кранов Comansa',
        'models' => array('10LC140')
    )
);
?>

<section class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px] mt-[60px]">
    <!-- Основная сетка каталога -->
    <div class="grid grid-cols-12 gap-[30px]">
        <?php
        // Функция для безопасного получения ссылки
        function get_safe_term_link($term_name, $taxonomy) {
            $term = get_term_by('name', $term_name, $taxonomy);
            return ($term && !is_wp_error($term)) ? get_term_link($term) : home_url('/new/catalog/');
        }
        ?>

        <!-- Главная карточка каталога -->
        <div class="col-span-12 lg:col-span-8 row-span-2">
            <div class="bg-gradient-to-br from-[#F38D19] to-[#E07D08] rounded-[5px] p-[30px] h-full relative overflow-hidden group">
                <div class="relative z-10">
                    <h2 class="text-4xl font-bold text-white mb-4">Каталог запчастей</h2>
                    <p class="text-white/80 text-lg mb-8 max-w-xl">
                        Более 10 000 наименованй запчастей для башенных кранов в наличии и под заказ
                    </p>
                    <a href="<?php echo esc_url(home_url('/catalog')); ?>" 
                       class="inline-flex items-center bg-white text-brand-orange px-6 py-3 rounded-lg font-medium hover:bg-zinc-900 hover:text-white transition-colors">
                        Перейти в каталог
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
                <!-- Декоративный лемт -->
                <div class="absolute right-0 bottom-0 w-64 h-64 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg fill="currentColor" class="text-white" viewBox="0 0 24 24">
                        <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Zoomlion - специальная карточка -->
        <div class="col-span-12 lg:col-span-4 row-span-2">
            <div class="bg-zinc-900 rounded-[5px] p-[30px] h-full relative overflow-hidden group">
                <div class="relative z-10 flex flex-col h-full">
                    <!-- Заголовок и бейдж -->
                    <div class="flex items-start justify-between mb-6">
                        <h3 class="text-3xl font-bold text-white">Zoomlion</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-brand-orange/10 text-brand-orange-dark border border-brand-orange/20">
                            Официальный поставщик
                        </span>
                    </div>

                    <!-- Описание -->
                    <p class="text-zinc-400 mb-auto">
                        Оригинальные запчасти для башенных кранов Zoomlion с гарантией производителя
                    </p>

                    <!-- Кнопка -->
                    <div class="mt-8">
                        <a href="<?php echo esc_url(add_query_arg(['manufacturer' => 'zoomlion'], home_url('/catalog/'))); ?>" 
                           class="inline-flex items-center text-white group-hover:text-brand-orange transition-colors">
                            <span class="font-medium">Подробнее</span>
                            <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Категории -->
        <?php foreach ($categories_data as $name => $data) : ?>
            <div class="col-span-12 md:col-span-6 lg:col-span-4">
                <div class="bg-white rounded-[5px] border border-[#E3E3E3] h-full group hover:border-[#F38D19] transition-colors">
                    <div class="p-[30px] flex flex-col h-full">
                        <!-- Верхняя часть с иконкой и описанием -->
                        <div class="mb-auto">
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="w-12 h-12 bg-brand-orange/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo $data['icon']; ?>"/>
                                    </svg>
                                </div>
                                <div class="flex-grow">
                                    <h3 class="text-xl font-bold text-zinc-900 mb-2 hover:text-brand-orange transition-colors">
                                        <?php echo esc_html($name); ?>
                                    </h3>
                                    <p class="text-zinc-600 text-sm">
                                        <?php echo esc_html($data['description']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Нижняя часть с кнопкой и счетчиком -->
                        <div class="flex items-center justify-between pt-4">
                            <a href="<?php echo esc_url(home_url('/catalog/?category=' . sanitize_title($name))); ?>" 
                               class="inline-flex items-center text-brand-orange font-medium group-hover:text-brand-orange-dark">
                                Смотреть все
                                <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            <?php
                            $category = get_term_by('name', $name, 'product_cat');
                            if ($category) {
                                $count = $category->count;
                                $text = $count . ' ' . ($count === 1 ? 'позиция' : ($count >= 2 && $count <= 4 ? 'позиции' : 'позиций'));
                            ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-brand-orange/10 text-brand-orange">
                                <?php echo esc_html($text); ?>
                            </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Остальные производители -->
        <?php 
        foreach ($manufacturers as $slug => $data) : 
            if ($data['name'] !== 'Zoomlion') :
        ?>
            <div class="col-span-12 md:col-span-6 lg:col-span-4">
                <div class="bg-white rounded-[5px] p-[30px] border border-[#E3E3E3] h-full group hover:border-[#F38D19] transition-colors">
                    <div class="mb-4">
                        <h3 class="text-2xl font-bold text-zinc-900"><?php echo esc_html($data['name']); ?></h3>
                    </div>
                    <p class="text-zinc-600 mb-6">
                        <?php echo esc_html($data['description']); ?>
                    </p>
                    
                    <!-- Модели -->
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($data['models'] as $model) : ?>
                                <span class="inline-flex items-center px-2 py-1 rounded bg-zinc-100 text-zinc-600 text-sm">
                                    <?php echo esc_html($model); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <a href="<?php echo esc_url(add_query_arg(['manufacturer' => $slug], home_url('/catalog/'))); ?>" 
                       class="inline-flex items-center text-brand-orange font-medium group-hover:text-brand-orange-dark">
                        Перейти в каталог
                        <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        <?php 
            endif;
        endforeach; 
        ?>
    </div>
</section>