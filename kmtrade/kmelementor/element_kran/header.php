<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Security-Policy" content="frame-ancestors 'self'">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>console.warn = () => {};</script>
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-gray-50'); ?>>
<?php wp_body_open(); ?>

<!-- Шапка сайта -->
<header>
    <!-- Top Header -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Логотип -->
                <div class="flex items-center">
                    <?php 
                    if(has_custom_logo()):
                        the_custom_logo();
                    else:
                    ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-bold text-gray-800">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Поиск -->
                <div class="flex-1 max-w-3xl mx-auto px-16">
                    <div class="relative">
                        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <input
                                type="search"
                                name="s"
                                class="search-input w-full pl-6 pr-12 py-2 rounded-full border border-gray-300 focus:outline-none focus:border-orange-500"
                                placeholder="Поиск запчастей..." />
                            <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Контакты и кнопка -->
                <div class="flex items-center space-x-8">
                    <div class="text-right">
                        <div class="text-lg font-bold text-gray-800">
                            <?php echo get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX'); ?>
                        </div>
                        <div class="text-sm text-gray-600">
                            <?php echo get_theme_mod('work_hours', 'Пн-Пт: 9:00 - 18:00'); ?>
                        </div>
                    </div>
                    <button class="bg-primary text-white px-6 py-2 rounded-full hover:bg-primary-hover transition-colors" 
                            onclick="openOrderModal()">
                        Быстрый заказ
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Каталог -->
                <div class="relative group">
                    <a href="<?php echo esc_url(home_url('/catalog/parts/')); ?>" 
                       class="flex items-center space-x-2 bg-primary text-white px-6 py-2 rounded-full hover:bg-primary-hover transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <span>Каталог</span>
                    </a>

                    <!-- Мега-меню каталога -->
                    <div class="fixed left-0 right-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-75 z-50">
                        <div class="container mx-auto px-4">
                            <div class="bg-white rounded-lg grid grid-cols-3 gap-6 p-6"
                                 onmouseleave="this.closest('.fixed').classList.add('invisible', 'opacity-0')">
                                <!-- Запчасти по типам -->
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-6">Запчасти по типам</h3>
                                    <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                                    <?php
                                    $featured_categories = ['Подшипники', 'Анкеры', 'Лебедка', 'Механизм телескопа'];
                                    $parts_categories = get_terms(array(
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => false,
                                    ));
                                    
                                    if (!empty($parts_categories) && !is_wp_error($parts_categories)) {
                                        // Сортируем категории по имени
                                        usort($parts_categories, function($a, $b) {
                                            return strcmp($a->name, $b->name);
                                        });
                                        
                                        foreach ($parts_categories as $category) {
                                            $is_featured = in_array($category->name, $featured_categories);
                                            $class = $is_featured 
                                                ? "flex items-center text-gray-900 font-semibold hover:text-gray-600 transition-colors" 
                                                : "flex items-center text-gray-600 hover:text-gray-900 transition-colors";
                                            
                                            echo '<a href="' . esc_url(add_query_arg(array(
                                                'product_cat' => $category->slug,
                                                'filter' => 'category'
                                            ), home_url('/catalog/parts/'))) . '" class="' . $class . '">' .
                                                 '<span class="w-1.5 h-1.5 rounded-full bg-gray-300 mr-2"></span>' .
                                                 '<span class="leading-relaxed">' . esc_html($category->name) . '</span></a>';
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>
                                
                                <!-- Производители кранов -->
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-6">Производители кранов</h3>
                                    <div class="space-y-6">
                                    <?php
                                    $manufacturers = [
                                        'Potain' => [
                                            'models' => 'MC 175, MC 2358, HMC 205, MC 310, MDT 178, MCT 205, MD 205',
                                            'featured' => true
                                        ],
                                        'Zoomlion' => [
                                            'models' => 'WA6017-10, WA7025-12',
                                            'featured' => true
                                        ],
                                        'Liebherr' => [
                                            'models' => '112 EC-H, 132 EC-H',
                                            'featured' => false
                                        ],
                                        'Comansa' => [
                                            'models' => '10LC140',
                                            'featured' => false
                                        ]
                                    ];

                                    foreach ($manufacturers as $name => $data) :
                                        $url = add_query_arg(['filter_brand' => strtolower($name)], get_permalink(wc_get_page_id('shop')));
                                        $nameClass = $data['featured'] 
                                            ? "flex items-center text-gray-900 font-semibold hover:text-gray-600 transition-colors" 
                                            : "flex items-center text-gray-900 hover:text-gray-600 transition-colors";
                                    ?>
                                        <div class="border-l-2 border-gray-100 pl-4">
                                            <a href="<?php echo esc_url($url); ?>" class="<?php echo $nameClass; ?>">
                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-2"></span>
                                                <?php echo esc_html($name); ?>
                                            </a>
                                            <p class="text-sm text-gray-500 mt-1 ml-3.5">
                                                <?php echo esc_html($data['models']); ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Быстрый заказ -->
                                <div class="bg-gray-900 rounded-lg overflow-hidden">
                                    <div class="relative">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/crane-bg.jpg" 
                                             alt="Башенный кран" 
                                             class="w-full h-48 object-cover opacity-50">
                                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-900"></div>
                                    </div>
                                    <div class="p-6 relative">
                                        <h3 class="text-xl font-bold text-white mb-3">Нужна помощь с выбором?</h3>
                                        <p class="text-gray-300 mb-6">Наши специалисты помогут подобрать необходимые запчасти для вашего крана</p>
                                        <button onclick="openOrderModal()" 
                                                class="w-full bg-primary text-white px-6 py-3 rounded-full font-semibold hover:bg-primary-hover transition-colors">
                                            Быстрый заказ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Главное меню -->
                <nav class="hidden md:flex items-center justify-center flex-1 px-8">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'flex items-center justify-center space-x-8',
                        'echo' => true,
                        'walker' => new Custom_Walker_Nav_Menu()
                    ));
                    ?>
                </nav>

                <!-- Мой заказ -->
                <a href="<?php echo esc_url(home_url('/wp/my-order/')); ?>" 
                   class="hidden md:flex items-center space-x-2 bg-primary text-white px-6 py-2 rounded-full hover:bg-primary-hover transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Мой заказ</span>
                </a>

                <!-- Кнопка мобильного меню -->
                <button class="md:hidden" id="mobile-menu-button" aria-label="Открыть меню">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Мобильное меню -->
    <div id="mobile-menu" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="fixed inset-y-0 right-0 max-w-xs w-full bg-white shadow-xl transform transition-transform duration-300 translate-x-full">
            <div class="flex items-center justify-between p-4 border-b">
                <h2 class="text-xl font-bold text-gray-800">Меню</h2>
                <button id="close-mobile-menu" class="p-2 rounded-lg hover:bg-gray-100" aria-label="Закрыть меню">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-4 py-6">
                <div class="space-y-4" id="mobile-menu-content"></div>
            </div>
        </div>
    </div>
</header>
</rewritten_file> 