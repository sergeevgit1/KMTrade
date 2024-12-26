<?php
/*
Template Name: Каталог запчастей
*/

get_header();
?>

<main>
    <!-- Баннер -->
    <section class="container mx-auto px-4 py-8">
        <div class="bg-[#080808] text-white py-16 px-8 rounded-2xl">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Каталог запчастей для башенных кранов</h1>
                <p class="text-xl mb-8">В нашем каталоге более 1000 наименований запчастей для башенных кранов ведущих производителей: Potain, Liebherr, Zoomlion и Comansa</p>
                <button onclick="openOrderModal()" 
                        class="inline-block bg-white text-[#080808] px-10 py-4 rounded-full font-semibold hover:bg-gray-100 transition-colors text-lg">
                    Быстрый заказ
                </button>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 py-8">
        <!-- Хлебные крошки -->
        <div class="mb-12">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="<?php echo esc_url(home_url('/wp/')); ?>" class="text-gray-700 hover:text-primary">
                            Главная
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-500">Каталог запчастей</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Удаляем старый заголовок -->
        <?php
        // Массив нужных категорий
        $needed_categories = array('Подшипники', 'Анкеры', 'Троса');
        
        // Получаем только нужные категории
        $categories = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'name' => $needed_categories
        ));

        // Получаем производителей из атрибута и создаем для них виртуальные категории
        $manufacturers = array('Potain', 'Liebherr', 'Comansa', 'Zoomlion');
        
        // Объединяем обычные категории и производителей в один массив для отображения
        $all_items = array();
        
        // Добавляем обычные категории
        foreach ($categories as $category) {
            $all_items[] = array(
                'name' => $category->name,
                'description' => $category->description,
                'link' => get_term_link($category),
                'type' => 'category'
            );
        }
        
        // Добавляем производителей
        foreach ($manufacturers as $manufacturer) {
            // Формируем URL для фильтрации по производителю
            $manufacturer_url = add_query_arg(array(
                'filter_brand' => strtolower($manufacturer)
            ), get_permalink(wc_get_page_id('shop')));
            
            // Получаем описание для производителя
            $description = '';
            switch($manufacturer) {
                case 'Potain':
                    $description = 'MC 175, MC 2358, HMC 205, MC 310, MDT 178, MCT 205, MD 205';
                    break;
                case 'Zoomlion':
                    $description = 'WA6017-10, WA7025-12';
                    break;
                case 'Liebherr':
                    $description = '112 EC-H, 132 EC-H';
                    break;
                case 'Comansa':
                    $description = '10LC140';
                    break;
            }
            
            $all_items[] = array(
                'name' => $manufacturer,
                'description' => "Запчасти для кранов {$manufacturer}. Модели: {$description}",
                'link' => $manufacturer_url,
                'type' => 'manufacturer'
            );
        }
        ?>

        <!-- Категории -->
        <div class="grid gap-6">
            <!-- Две большие карточки -->
            <div class="grid md:grid-cols-3 gap-6">
                <?php
                // Выводим первый элемент (большая карточка слева)
                if (!empty($all_items)) {
                    $first_item = $all_items[0];
                    $image = get_template_directory_uri() . '/assets/images/placeholder.png';
                ?>
                    <div class="md:col-span-2 relative flex bg-primary text-white rounded-lg shadow-sm hover:shadow-md transition-shadow h-72 overflow-hidden">
                        <div class="w-[60%] p-6 flex flex-col justify-between relative z-10">
                            <div>
                                <h2 class="text-2xl font-bold text-white mb-3">
                                    <?php echo esc_html($first_item['name']); ?>
                                </h2>
                                <p class="text-white/90 text-base mb-4 pr-6">
                                    <?php echo esc_html($first_item['description']); ?>
                                </p>
                            </div>
                            <a href="<?php echo esc_url($first_item['link']); ?>" 
                               class="inline-flex items-center text-white hover:text-white/90 font-medium group">
                                <span>
                                    <?php echo $first_item['type'] === 'category' ? 'Перейти в категорию' : 'Смотреть все запчасти'; ?>
                                </span>
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                        <div class="absolute right-0 top-0 h-full w-[45%]">
                            <img src="<?php echo esc_url($image); ?>" 
                                 alt="<?php echo esc_attr($first_item['name']); ?>"
                                 class="h-full w-full object-contain object-right scale-110 transform translate-x-4 opacity-90">
                        </div>
                    </div>

                    <!-- Средние карточки -->
                    <?php
                    // Получаем средние элементы (со 2-го по предпоследний)
                    $middle_items = array_slice($all_items, 1, -1);
                    foreach ($middle_items as $item) :
                    ?>
                        <div class="relative flex bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow h-72 overflow-hidden border border-primary/10">
                            <div class="w-full p-6 flex flex-col justify-between">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900 mb-2">
                                        <?php echo esc_html($item['name']); ?>
                                    </h2>
                                    <p class="text-gray-600 text-sm mb-4">
                                        <?php echo esc_html($item['description']); ?>
                                    </p>
                                </div>
                                <a href="<?php echo esc_url($item['link']); ?>" 
                                   class="inline-flex items-center text-primary hover:text-primary-hover font-medium group">
                                    <span>
                                        <?php echo $item['type'] === 'category' ? 'Перейти в категорию' : 'Смотреть все запчасти'; ?>
                                    </span>
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Последняя большая карточка -->
                    <?php
                    $last_item = end($all_items);
                    $is_zoomlion = $last_item['name'] === 'Zoomlion'; ?>
                    <div class="md:col-span-2 relative flex <?php echo $is_zoomlion ? 'bg-[#080808] text-white' : 'bg-gray-50'; ?> rounded-lg shadow-sm hover:shadow-md transition-shadow h-72 overflow-hidden">
                        <div class="w-[60%] p-6 flex flex-col justify-between relative z-10">
                            <div>
                                <h2 class="text-xl font-bold <?php echo $is_zoomlion ? 'text-white' : 'text-gray-900'; ?> mb-2">
                                    <?php echo esc_html($last_item['name']); ?>
                                </h2>
                                <p class="<?php echo $is_zoomlion ? 'text-white/90' : 'text-gray-600'; ?> text-sm mb-4 pr-6">
                                    <?php echo esc_html($last_item['description']); ?>
                                </p>
                            </div>
                            <a href="<?php echo esc_url($last_item['link']); ?>" 
                               class="inline-flex items-center <?php echo $is_zoomlion ? 'text-white hover:text-white/90' : 'text-primary hover:text-primary-hover'; ?> font-medium group">
                                <span>
                                    <?php echo $last_item['type'] === 'category' ? 'Перейти в категорию' : 'Смотреть все запчасти'; ?>
                                </span>
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                        <div class="absolute right-0 top-0 h-full w-[45%]">
                            <img src="<?php echo esc_url($image); ?>" 
                                 alt="<?php echo esc_attr($last_item['name']); ?>"
                                 class="h-full w-full object-contain object-right scale-110 transform translate-x-4 <?php echo $is_zoomlion ? 'opacity-90' : ''; ?>">
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Преимущества -->
        <div class="mt-16 bg-white rounded-lg shadow-sm p-8 <?php echo $is_zoomlion ? 'bg-green-50' : ''; ?>">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-primary mb-4 flex justify-center">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Оригинальные запчасти</h3>
                    <p class="text-gray-600">Гарантируем подлинность всех запчастей</p>
                </div>

                <div class="text-center">
                    <div class="text-primary mb-4 flex justify-center">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Быстрая доставка</h3>
                    <p class="text-gray-600">Отправка в день заказа при наличии</p>
                </div>

                <div class="text-center <?php echo $is_zoomlion ? 'text-green-500' : 'text-primary'; ?>">
                    <div class="text-primary mb-4 flex justify-center">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Консультация</h3>
                    <p class="text-gray-600">Поможем подобрать нужные детали</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?> 