<?php get_header(); ?>

<?php
// Значения по умолчанию для hero-секции
$hero_defaults = [
    'title' => 'Запчасти для башенных кранов всех видов и моделей',
    'subtitle' => 'Подберём и доставим нужную деталь — быстро, надёжно, выгодно. Работаем с ведущими производителями: Potain, Liebherr, Zoomlion, Comansa',
    'advantages' => [
        1 => [
            'title' => 'Быстрая доставка',
            'text' => 'Отправляем запчасти в день заказа при наличии на складе'
        ],
        2 => [
            'title' => 'Гарантия качества',
            'text' => 'Только оригинальные запчасти от производителей'
        ],
        3 => [
            'title' => 'Техподдержка',
            'text' => 'Помощь в подборе и консультации специалистов'
        ]
    ]
];

// Значения по умолчанию для секц��и о компании
$about_defaults = [
    'title' => 'О компании',
    'text' => '<p>Мы специализируемся на поставках запасных частей для башенных кранов ведущих мировых производителей. Более 10 лет опыта в подборе и поставке запчастей.</p>
               <p>Прямые поставки от производителей позволяют нам предлагать лучшие цены и гарантировать качество продукции.</p>'
];

// Значения по умолчанию для секции поиска запчастей
$how_to_find_defaults = [
    'title' => 'Как найти нужную запчасть?',
    'text' => 'Воспользуйтесь нашим каталогом: выберите категорию запчастей, укажите производителя и модель крана. Если у вас возникнут вопросы, наши специалисты помогут подобрать необходимую деталь.'
];

// Значения по умолчанию для шагов заказа
$order_steps_defaults = [
    1 => [
        'title' => 'Оформите заявку',
        'text' => 'Через са��т или по телефону'
    ],
    2 => [
        'title' => 'Получите расчет',
        'text' => 'Мы подберем оптимальный вариант'
    ],
    3 => [
        'title' => 'Подтвердите заказ',
        'text' => 'Согласуйте условия поставки'
    ],
    4 => [
        'title' => 'Получите товар',
        'text' => 'Доставка в любой регион России'
    ]
];

// Значения по умолчанию для FAQ
$faq_defaults = [
    1 => [
        'question' => 'Как быстро обрабатываются заказы?',
        'answer' => 'Мы обрабатываем заказы в течение 1-2 рабочих дней. При наличии запчастей на складе, отправка происходит в день оплаты.'
    ],
    2 => [
        'question' => 'Какие способы оплаты вы принимаете?',
        'answer' => 'Мы работаем как с физическими, так и с юридическими лицами. Доступна оплата по безналичному расчету, банковскими картами и наличными.'
    ],
    3 => [
        'question' => 'Есть ли гарантия на запчасти?',
        'answer' => 'Да, на все запчасти предоставляется гарантия. Срок гарантии зависит от производителя и типа детали.'
    ],
    4 => [
        'question' => 'Как осуществляется доставка?',
        'answer' => 'Доставка осуществляется транспортными компаниями по всей России. Также возможен самовывоз со склада в Москве.'
    ],
    5 => [
        'question' => 'Работаете ли вы с регионами?',
        'answer' => 'Да, мы работаем со всеми регионами России. Доставка осуществляется любой удобной для вас транспортной компанией.'
    ]
];

// Значения по умолчанию для контактной формы
$contact_defaults = [
    'title' => 'Остались вопросы?',
    'phone' => '+7 (495) 123-45-67',
    'email' => 'info@element-kran.ru',
    'address' => 'г. Москва, ул. Промышленная, д. 1'
];
?>

<!-- Hero блок -->
<section class="relative overflow-hidden">
    <div class="relative container mx-auto px-4 py-24">
        <div class="grid lg:grid-cols-2 gap-8 items-center">
            <!-- Левая колонка с контентом -->
            <div class="relative z-10">
                <!-- Основной контент -->
                <div class="mb-12">
                    <div class="inline-block bg-orange-600 text-white px-4 py-1 text-sm font-medium rounded mb-4">
                        Поставка запчастей с 2010 года
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-zinc-900 mb-6 leading-tight">
                        <?php echo esc_html(get_theme_mod('hero_title', $hero_defaults['title'])); ?>
                    </h1>
                    <p class="text-xl text-zinc-600 mb-8 leading-relaxed max-w-2xl">
                        <?php echo esc_html(get_theme_mod('hero_subtitle', $hero_defaults['subtitle'])); ?>
                    </p>
                    
                    <!-- Кнопки действий -->
                    <div class="flex flex-wrap gap-4">
                        <a href="/new/parts/" 
                           class="inline-flex items-center px-8 py-4 bg-orange-600 text-white rounded hover:bg-orange-700 transition-colors font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                            </svg>
                            Перейти в каталог
                        </a>
                        <a href="#contacts" 
                           class="inline-flex items-center px-8 py-4 border border-zinc-200 text-zinc-800 rounded hover:bg-zinc-50 transition-colors font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Связаться с нами
                        </a>
                    </div>
                </div>

                <!-- Преимущества -->
                <div class="grid md:grid-cols-3 gap-6">
                    <?php for ($i = 1; $i <= 3; $i++) : 
                        $default_advantage = $hero_defaults['advantages'][$i];
                    ?>
                        <div class="bg-white rounded p-6 border border-zinc-200">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-zinc-900 font-bold mb-2">
                                <?php echo esc_html(get_theme_mod("hero_advantage_{$i}_title", $default_advantage['title'])); ?>
                            </h3>
                            <p class="text-zinc-600 text-sm">
                                <?php echo esc_html(get_theme_mod("hero_advantage_{$i}_text", $default_advantage['text'])); ?>
                            </p>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Правая колонка с изображением крана -->
            <div class="absolute right-0 top-0 bottom-0 w-1/2 hidden lg:block" 
                 style="clip-path: inset(0);">
                <?php 
                $crane_image_id = get_theme_mod('hero_crane_image');
                $crane_image_url = $crane_image_id ? wp_get_attachment_image_url($crane_image_id, 'full') : get_template_directory_uri() . '/assets/images/placeholder.png';
                ?>
                <img src="<?php echo esc_url($crane_image_url); ?>"
                     alt="Башенный кран"
                     class="absolute inset-0 w-full h-full object-contain"
                     style="object-position: right center; transform: scale(1.2);">
            </div>
        </div>
    </div>
</section>

<!-- Поиск запчастей -->
<section class="mb-16">
    <div class="container mx-auto px-4">
        <!-- Поисковая форма -->
        <div class="bg-white rounded-xl border border-zinc-100 p-8">
            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <input type="text" 
                           placeholder="Введите артикул или название детали" 
                           class="w-full px-4 py-3 rounded-lg border border-zinc-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-colors">
                </div>
                <button class="bg-orange-600 text-white px-8 py-3 rounded-lg hover:bg-orange-700 transition-colors flex items-center justify-center whitespace-nowrap">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Найти запчасть
                </button>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="text-sm text-zinc-500">Популярные запросы:</span>
                <a href="#" class="text-sm text-orange-600 hover:text-orange-700">Подшипник 6204</a>
                <span class="text-zinc-300">•</span>
                <a href="#" class="text-sm text-orange-600 hover:text-orange-700">Трос D15</a>
                <span class="text-zinc-300">•</span>
                <a href="#" class="text-sm text-orange-600 hover:text-orange-700">Анкер M24</a>
                <span class="text-zinc-300">•</span>
                <a href="#" class="text-sm text-orange-600 hover:text-orange-700">Гидроцилиндр HC-200</a>
            </div>
        </div>

        <!-- Варианты поиска -->
        <div class="grid md:grid-cols-3 gap-6 mt-6">
            <!-- Поиск по каталогу -->
            <a href="/catalog/" class="group">
                <div class="bg-white rounded-xl border border-zinc-100 p-6 h-full hover:border-orange-200 transition-colors">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-zinc-900 mb-2 group-hover:text-orange-600 transition-colors">Каталог запчастей</h3>
                    <p class="text-sm text-zinc-600">Поиск по категориям и производителям</p>
                </div>
            </a>

            <!-- Поиск по модели -->
            <a href="/models/" class="group">
                <div class="bg-white rounded-xl border border-zinc-100 p-6 h-full hover:border-orange-200 transition-colors">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-zinc-900 mb-2 group-hover:text-orange-600 transition-colors">Подбор по модели</h3>
                    <p class="text-sm text-zinc-600">Поиск по производителю и модели крана</p>
                </div>
            </a>

            <!-- Консультация -->
            <a href="#contacts" class="group">
                <div class="bg-white rounded-xl border border-zinc-100 p-6 h-full hover:border-orange-200 transition-colors">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-zinc-900 mb-2 group-hover:text-orange-600 transition-colors">Консультация</h3>
                    <p class="text-sm text-zinc-600">Помощь специалиста в подборе запчастей</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Катог -->
<section class="container mx-auto px-4 mb-16">
    <div class="flex items-center justify-between mb-12">
        <div class="max-w-2xl">
            <div class="flex items-center space-x-2 mb-4">
                <div class="w-12 h-1 bg-orange-600 rounded-full"></div>
                <span class="text-orange-600 font-medium">Каталог</span>
            </div>
            <h2 class="text-4xl font-bold text-zinc-900 mb-3">
                Запчасти для башенных кранов
            </h2>
            <p class="text-zinc-600">
                Оригинальные комплектующие от ведущих производителей
            </p>
        </div>
        <a href="/new/parts/" class="hidden lg:inline-flex items-center px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
            <span class="font-medium">Весь каталог</span>
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>

    <!-- Основная сетка каталога -->
    <div class="grid grid-cols-12 gap-6">
        <?php
        // Определяем категории
        $categories_data = array(
            'Подшипники' => array(
                'description' => 'Оригинальные подшипники для всех узлов башенного крана',
                'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
                'image' => 'bearings.jpg',
                'color' => 'orange'
            ),
            'Анкеры' => array(
                'description' => 'Анкерные системы и крепления для надежной фиксации',
                'icon' => 'M19 9l-7 7-7-7',
                'image' => 'anchors.jpg',
                'color' => 'blue'
            ),
            'Троса' => array(
                'description' => 'Тросы, канаты и комплектующие высокой прочности',
                'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                'image' => 'ropes.jpg',
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

        // Функция для безопасного получения ссылки
        function get_safe_term_link($term_name, $taxonomy) {
            $term = get_term_by('name', $term_name, $taxonomy);
            return ($term && !is_wp_error($term)) ? get_term_link($term) : home_url('/wp/parts/');
        }
        ?>

        <!-- Гавна каточка каталога -->
        <div class="col-span-12 lg:col-span-8 row-span-2">
            <div class="bg-gradient-to-br from-orange-600 to-orange-700 rounded-2xl p-8 h-full relative overflow-hidden group">
                <div class="relative z-10">
                    <h2 class="text-4xl font-bold text-white mb-4">Каталог запчастей</h2>
                    <p class="text-white/80 text-lg mb-8 max-w-xl">
                        Более 10 000 наименованй запчастей для башенных кранов в наличии и под заказ
                    </p>
                    <a href="<?php echo home_url('/wp/parts/'); ?>" 
                       class="inline-flex items-center bg-white text-orange-600 px-6 py-3 rounded-lg font-medium group-hover:bg-orange-50 transition-colors">
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
            <div class="bg-zinc-900 rounded-2xl p-8 h-full relative overflow-hidden group">
                <div class="relative z-10">
                    <div class="mb-6">
                        <h3 class="text-3xl font-bold text-white">Zoomlion</h3>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Официальный поставщик</h3>
                    <p class="text-zinc-400 mb-8">
                        Оригинальные запчасти для башенных кранов Zoomlion с гарантией производителя
                    </p>
                    <a href="<?php echo add_query_arg(['manufacturer' => 'zoomlion'], home_url('/wp/parts/')); ?>" 
                       class="inline-flex items-center text-white group-hover:text-orange-400 transition-colors">
                        Подробнее
                        <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Категории в новом дизайне -->
        <?php foreach ($categories_data as $name => $data) : ?>
            <div class="col-span-12 md:col-span-6 lg:col-span-4">
                <div class="relative bg-white rounded-xl border border-zinc-100 overflow-hidden h-full group">
                    <!-- Фоновое изображение -->
                    <div class="absolute inset-0 bg-zinc-100">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png"
                                 alt="<?php echo esc_attr($name); ?>"
                                 class="w-full h-full object-cover opacity-20 group-hover:opacity-30 transition-opacity">
                    </div>
                    
                    <!-- Контет -->
                    <div class="relative p-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="<?php echo $data['icon']; ?>"/>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <h3 class="text-xl font-bold text-zinc-900 mb-2">
                                    <?php echo $name; ?>
                                </h3>
                                <p class="text-zinc-600 text-sm mb-4">
                                    <?php echo $data['description']; ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Кнопка и счетчик -->
                        <div class="mt-4 flex items-center justify-between">
                            <a href="<?php echo get_safe_term_link($name, 'product_cat'); ?>" 
                               class="inline-flex items-center text-orange-600 font-medium group-hover:text-orange-700">
                                Смотреть все
                                <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            <?php 
                            $term = get_term_by('name', $name, 'product_cat');
                            if ($term && !is_wp_error($term) && $term->count > 0) : 
                            ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-600">
                                    <?php echo $term->count; ?> <?php echo plural_form($term->count, 'позиция', 'позиции', 'позиций'); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Остальные производители в новом дизайне -->
        <?php 
        foreach ($manufacturers as $slug => $data) : 
            if ($data['name'] !== 'Zoomlion') :
        ?>
            <div class="col-span-12 md:col-span-6 lg:col-span-4">
                <div class="bg-white rounded-xl p-6 border border-zinc-100 h-full group">
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
                                    <?php echo $model; ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <a href="<?php echo add_query_arg(['manufacturer' => $slug], home_url('/wp/parts/')); ?>" 
                       class="inline-flex items-center text-orange-600 font-medium group-hover:text-orange-700">
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

<!-- О компании -->
<section class="py-16 mb-16">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Левая колонка с контентом -->
            <div>
                <div class="inline-flex items-center space-x-2 mb-4">
                    <div class="w-12 h-1 bg-orange-600 rounded-full"></div>
                    <span class="text-orange-600 font-medium">О компании</span>
                </div>
                
                <h2 class="text-4xl font-bold text-zinc-900 mb-6">
                <?php echo esc_html(get_theme_mod('about_title', $about_defaults['title'])); ?>
            </h2>
                
                <!-- Краткое описание -->
                <div class="text-zinc-600 space-y-4 mb-8">
                    <?php 
                    $short_text = wp_trim_words(
                        wp_strip_all_tags(get_theme_mod('about_text', $about_defaults['text'])), 
                        40, 
                        '...'
                    ); 
                    echo wpautop($short_text);
                    ?>
                </div>

                <!-- Ключевые показатели в строку -->
                <div class="flex flex-wrap gap-8 mb-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-orange-500">10+</div>
                            <div class="text-sm text-zinc-500">лет опыта</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-orange-500">1000+</div>
                            <div class="text-sm text-zinc-500">клиентов</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-orange-500">100%</div>
                            <div class="text-sm text-zinc-500">гарантия</div>
                        </div>
                    </div>
                </div>

                <!-- Кнопки действий -->
                <div class="flex flex-wrap gap-4">
                    <a href="/about/" class="inline-flex items-center px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                        <span class="font-medium">Подробнее о компании</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="#contacts" class="inline-flex items-center px-6 py-3 border border-zinc-200 text-zinc-800 rounded-lg hover:bg-zinc-50 transition-colors">
                        <span class="font-medium">Связаться с нами</span>
                    </a>
                </div>
            </div>

            <!-- Правая колонка с изображением -->
            <div class="relative">
                <?php 
                $about_image_id = get_theme_mod('about_image');
                $about_image_url = $about_image_id ? wp_get_attachment_image_url($about_image_id, 'full') : get_template_directory_uri() . '/assets/images/placeholder.png';
                ?>
                <div class="relative rounded-2xl overflow-hidden aspect-4/3">
                    <img src="<?php echo esc_url($about_image_url); ?>" 
                         alt="О компании Element Kran" 
                         class="w-full h-full object-cover rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Почему выбирают нас -->
<section class="py-16 mb-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <div class="inline-flex items-center space-x-2 mb-4">
                <div class="w-12 h-1 bg-orange-600 rounded-full"></div>
                <span class="text-orange-600 font-medium">Преимущества</span>
            </div>
            <h2 class="text-3xl font-bold text-zinc-900 mb-4">Почему выбирают нас</h2>
            <p class="text-zinc-600 max-w-2xl mx-auto">Мы предлагаем комплексный подход к поставке запчастей для башенных кранов</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Оригинальные запчасти -->
            <div class="bg-white rounded-xl p-6 border border-zinc-100">
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-zinc-900 mb-3">Оригинальные запчасти</h3>
                <p class="text-zinc-600">Прямые поставки от производителей. Гарантия подлинности и качества каждой детали.</p>
                <ul class="mt-4 space-y-2">
                    <li class="flex items-center text-sm text-zinc-600">
                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Сертификаты качества
                    </li>
                    <li class="flex items-center text-sm text-zinc-600">
                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Га��антия производителя
                    </li>
                </ul>
            </div>

            <!-- Техническая поддержка -->
            <div class="bg-white rounded-xl p-6 border border-zinc-100">
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-zinc-900 mb-3">Техническая поддержка</h3>
                <p class="text-zinc-600">Квалифицированные специалисты помогут подобрать необходимые запчасти и ответят на все вопросы.</p>
                <ul class="mt-4 space-y-2">
                    <li class="flex items-center text-sm text-zinc-600">
                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Консультации 24/7
                    </li>
                    <li class="flex items-center text-sm text-zinc-600">
                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Помощь в подборе
                    </li>
                </ul>
            </div>

            <!-- Удобная логистика -->
            <div class="bg-white rounded-xl p-6 border border-zinc-100">
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-zinc-900 mb-3">Удобная логистика</h3>
                <p class="text-zinc-600">Быстрая доставка в любой регион России. Собственный склад запчастей в Москве.</p>
                <ul class="mt-4 space-y-2">
                    <li class="flex items-center text-sm text-zinc-600">
                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Доставка по России
                    </li>
                    <li class="flex items-center text-sm text-zinc-600">
                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Отправка в день заказа
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Блог и новости -->
<section class="py-16 mb-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-12">
            <div>
                <div class="inline-flex items-center space-x-2 mb-4">
                    <div class="w-12 h-1 bg-orange-600 rounded-full"></div>
                    <span class="text-orange-600 font-medium">Наш блог</span>
                </div>
                <h2 class="text-3xl font-bold text-zinc-900 mb-3">Экспертные статьи и новости</h2>
                <p class="text-zinc-600 max-w-2xl">
                    Делимся опытом в обслуживании башенных кранов, рассказываем о новинках и трендах в сфере строительной техники
                </p>
            </div>
            <a href="/blog/" class="inline-flex items-center px-6 py-3 mt-6 lg:mt-0 border border-zinc-200 text-zinc-800 rounded-lg hover:bg-zinc-50 transition-colors">
                <span class="font-medium">Все публикации</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Статья 1 -->
            <article class="bg-white rounded-xl border border-zinc-100 overflow-hidden group">
                <div class="aspect-video relative overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" 
                         alt="Обслуживание башенных кранов"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="inline-block bg-white/90 backdrop-blur-sm text-zinc-900 text-sm font-medium px-3 py-1 rounded-full">
                            Обслуживание
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-zinc-500 mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        15.03.2024
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-3 group-hover:text-orange-600 transition-colors">
                        <a href="#">Как продлить срок службы башенного крана: 10 ключевых правил</a>
                    </h3>
                    <p class="text-zinc-600 mb-4">
                        Регулярное обслуживание и своевременная замена запчастей позволяют значительно увеличить срок эксплуатации башенного крана...
                    </p>
                    <a href="#" class="inline-flex items-center text-orange-600 font-medium group-hover:text-orange-700">
                        Читать д��лее
                        <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </article>

            <!-- Статья 2 -->
            <article class="bg-white rounded-xl border border-zinc-100 overflow-hidden group">
                <div class="aspect-video relative overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" 
                         alt="Новинки Zoomlion"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="inline-block bg-white/90 backdrop-blur-sm text-zinc-900 text-sm font-medium px-3 py-1 rounded-full">
                            Новости
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-zinc-500 mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        10.03.2024
                        </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-3 group-hover:text-orange-600 transition-colors">
                        <a href="#">Zoomlion представил новую линейку башенных кранов на выставке Bauma 2024</a>
                        </h3>
                    <p class="text-zinc-600 mb-4">
                        Компания Zoomlion представила инновационные решения в области башенных кранов на международной выставке строительной техники...
                    </p>
                    <a href="#" class="inline-flex items-center text-orange-600 font-medium group-hover:text-orange-700">
                        Читать далее
                        <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </article>

            <!-- Статья 3 -->
            <article class="bg-white rounded-xl border border-zinc-100 overflow-hidden group">
                <div class="aspect-video relative overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" 
                         alt="Технический гид"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="inline-block bg-white/90 backdrop-blur-sm text-zinc-900 text-sm font-medium px-3 py-1 rounded-full">
                            Руководство
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-zinc-500 mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        05.03.2024
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-3 group-hover:text-orange-600 transition-colors">
                        <a href="#">Подбор запчастей для башенного крана: полное руководство</a>
                    </h3>
                    <p class="text-zinc-600 mb-4">
                        Пошаговая инструкция по определению необходимых запчастей, проверке совместимости и оформлению заказа...
                    </p>
                    <a href="#" class="inline-flex items-center text-orange-600 font-medium group-hover:text-orange-700">
                        Читать далее
                        <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="container mx-auto px-4 mb-16">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <div class="inline-block bg-orange-100 text-orange-600 px-4 py-1 text-sm font-medium rounded mb-4">
                Поддержка
            </div>
            <h2 class="text-3xl font-bold text-zinc-900 mb-4">Часто задаваемые вопросы</h2>
            <p class="text-zinc-600">Ответы на самые популярне вопросы наших клиентов</p>
        </div>

        <div class="space-y-4">
            <?php 
            $has_faq_items = false;
            for ($i = 1; $i <= 5; $i++) : 
                $question = get_theme_mod("faq_{$i}_question", $faq_defaults[$i]['question']);
                $answer = get_theme_mod("faq_{$i}_answer", $faq_defaults[$i]['answer']);
                if ($question || $answer) :
                    $has_faq_items = true;
            ?>
                <div class="bg-white rounded-lg shadow-sm border border-zinc-100">
                    <button class="w-full text-left px-6 py-4 focus:outline-none group" 
                            onclick="toggleFAQ(this)">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-zinc-900 group-hover:text-orange-600">
                                <?php echo esc_html($question); ?>
                            </h3>
                            <svg class="w-5 h-5 text-zinc-500 transform transition-transform group-hover:text-orange-600" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </button>
                    <div class="hidden px-6 pb-4 text-zinc-600">
                        <?php echo wp_kses_post($answer); ?>
                    </div>
                </div>
            <?php 
                endif;
            endfor;
            
            // Если нет ни одного FAQ, скрываем секцию
            if (!$has_faq_items) echo '<style>.faq-section{display:none;}</style>';
            ?>
        </div>
    </div>
</section>

<!-- Форма обратной связи -->
<section class="py-16 mb-16" id="contacts">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="grid lg:grid-cols-2">
                <!-- Форма -->
                <div class="p-8 lg:p-12">
                    <h2 class="text-3xl font-bold text-zinc-900 mb-6">
                        <?php echo esc_html(get_theme_mod('contact_form_title', $contact_defaults['title'])); ?>
                    </h2>
                    <form class="space-y-4">
                        <!-- ... форма ... -->
                    </form>
                </div>

                <!-- Контактная информация -->
                <div class="bg-zinc-50 p-8 lg:p-12">
                    <h3 class="text-xl font-bold text-zinc-900 mb-6">Контактная информация</h3>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0 mr-4">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-zinc-900 mb-1">Телефон</h4>
                                <p class="text-zinc-600">
                                    <?php echo esc_html(get_theme_mod('contact_phone', $contact_defaults['phone'])); ?>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0 mr-4">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-zinc-900 mb-1">Email</h4>
                                <p class="text-zinc-600">
                                    <?php echo esc_html(get_theme_mod('contact_email', $contact_defaults['email'])); ?>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0 mr-4">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-zinc-900 mb-1">Адрес</h4>
                                <p class="text-zinc-600">
                                    <?php echo esc_html(get_theme_mod('contact_address', $contact_defaults['address'])); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?> 