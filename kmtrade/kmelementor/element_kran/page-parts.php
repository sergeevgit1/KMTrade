<?php
/*
Template Name: Parts Page
*/

get_header();
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Боковая панель с фильтрами -->
        <div class="w-full md:w-64 flex-shrink-0">
            <!-- Фильтры по кранам -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Фильтры по кранам</h2>
                <form method="get" class="space-y-4" id="crane-filters">
                    <!-- Сохраняем текущие параметры -->
                    <?php if (isset($_GET['product_cat'])): ?>
                        <input type="hidden" name="product_cat" value="<?php echo esc_attr($_GET['product_cat']); ?>">
                    <?php endif; ?>

                    <!-- Производитель -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Производитель крана
                        </label>
                        <div class="relative">
                            <select name="manufacturer" 
                                    class="block w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-gray-700 font-medium focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none appearance-none cursor-pointer hover:border-gray-300 transition-colors" 
                                    onchange="this.form.submit()"
                                    style="
                                        background-image: linear-gradient(45deg, transparent 50%, #666 50%), linear-gradient(135deg, #666 50%, transparent 50%);
                                        background-position: calc(100% - 20px) calc(1em + 2px), calc(100% - 15px) calc(1em + 2px);
                                        background-size: 5px 5px, 5px 5px;
                                        background-repeat: no-repeat;
                                    ">
                                <option value="" class="py-2">Все производители</option>
                                <?php
                                $manufacturers = [
                                    'potain' => [
                                        'name' => 'Potain',
                                        'models' => ['MC 175', 'MC 2358', 'HMC 205', 'MC 310', 'MDT 178', 'MCT 205', 'MD 205']
                                    ],
                                    'zoomlion' => [
                                        'name' => 'Zoomlion',
                                        'models' => ['WA6017-10', 'WA7025-12']
                                    ],
                                    'liebherr' => [
                                        'name' => 'Liebherr',
                                        'models' => ['112 EC-H', '132 EC-H']
                                    ],
                                    'comansa' => [
                                        'name' => 'Comansa',
                                        'models' => ['10LC140']
                                    ]
                                ];

                                foreach ($manufacturers as $slug => $data) {
                                    $selected = isset($_GET['manufacturer']) && $_GET['manufacturer'] === $slug ? 'selected' : '';
                                    echo sprintf(
                                        '<option value="%s" %s class="py-3 px-2 hover:bg-primary/10 %s" style="%s">%s</option>',
                                        esc_attr($slug),
                                        $selected,
                                        $selected ? 'bg-primary/10 text-primary' : '',
                                        $selected ? 'background-color: rgba(234, 88, 12, 0.1);' : '',
                                        esc_html($data['name'])
                                    );
                                }
                                ?>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Модель крана -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Модель крана
                        </label>
                        <div class="relative">
                            <select name="crane_model" 
                                    id="crane-model-select"
                                    onchange="this.form.submit()"
                                    class="block w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-gray-700 font-medium focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none appearance-none cursor-pointer hover:border-gray-300 transition-colors disabled:bg-gray-50 disabled:text-gray-400 disabled:cursor-not-allowed disabled:border-gray-200"
                                    style="
                                        background-image: linear-gradient(45deg, transparent 50%, #666 50%), linear-gradient(135deg, #666 50%, transparent 50%);
                                        background-position: calc(100% - 20px) calc(1em + 2px), calc(100% - 15px) calc(1em + 2px);
                                        background-size: 5px 5px, 5px 5px;
                                        background-repeat: no-repeat;
                                    ">
                                <option value="" class="py-2">Выберите модель</option>
                                <?php
                                if (isset($_GET['manufacturer']) && isset($manufacturers[$_GET['manufacturer']])) {
                                    foreach ($manufacturers[$_GET['manufacturer']]['models'] as $model) {
                                        $selected = isset($_GET['crane_model']) && $_GET['crane_model'] === sanitize_title($model) ? 'selected' : '';
                                        echo sprintf(
                                            '<option value="%s" %s class="py-3 px-2 hover:bg-primary/10 %s" style="%s">%s</option>',
                                            esc_attr(sanitize_title($model)),
                                            $selected,
                                            $selected ? 'bg-primary/10 text-primary' : '',
                                            $selected ? 'background-color: rgba(234, 88, 12, 0.1);' : '',
                                            esc_html($model)
                                        );
                                    }
                                }
                                ?>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Категории -->
            <div class="bg-white rounded-lg shadow-sm p-6 mt-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Категории</h2>
                <div class="space-y-2">
                    <?php
                    // Добавляем пункт "Все запчасти"
                    $current = !isset($_GET['product_cat']) ? 'text-primary font-semibold' : 'text-gray-600';
                    ?>
                    <div class="category-item">
                        <a href="<?php echo get_permalink(); ?>" 
                           class="flex items-center gap-2 hover:text-primary transition-colors <?php echo $current; ?>">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                            Все запчасти
                            <?php 
                            // Получаем общее количество товаров
                            $total_products = wp_count_posts('product')->publish;
                            ?>
                            <span class="text-sm text-gray-400">(<?php echo $total_products; ?>)</span>
                        </a>
                    </div>

                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                        'parent' => 0
                    ));

                    if (!empty($categories) && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            $current = isset($_GET['product_cat']) && $_GET['product_cat'] === $category->slug 
                                ? 'text-primary font-semibold' 
                                : 'text-gray-600';
                            ?>
                            <div class="category-item">
                                <a href="<?php echo add_query_arg('product_cat', $category->slug, get_permalink()); ?>" 
                                   class="flex items-center gap-2 hover:text-primary transition-colors <?php echo $current; ?>">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                    <?php echo esc_html($category->name); ?>
                                    <span class="text-sm text-gray-400">(<?php echo $category->count; ?>)</span>
                                </a>
                                <?php
                                // Подкатегории
                                $subcategories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => false,
                                    'parent' => $category->term_id
                                ));

                                if (!empty($subcategories) && !is_wp_error($subcategories)) {
                                    echo '<div class="ml-4 mt-2 space-y-2">';
                                    foreach ($subcategories as $subcategory) {
                                        $current_sub = isset($_GET['product_cat']) && $_GET['product_cat'] === $subcategory->slug 
                                            ? 'text-primary font-semibold' 
                                            : 'text-gray-500';
                                        ?>
                                        <a href="<?php echo add_query_arg('product_cat', $subcategory->slug, get_permalink()); ?>" 
                                           class="flex items-center gap-2 text-sm hover:text-primary transition-colors <?php echo $current_sub; ?>">
                                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                            <?php echo esc_html($subcategory->name); ?>
                                            <span class="text-sm text-gray-400">(<?php echo $subcategory->count; ?>)</span>
                                        </a>
                                        <?php
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Основной контент -->
        <div class="flex-1">
            <!-- Заголовок, результ��ты, поиск и сортировка - всегда видимы -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <!-- Заголовок и количество -->
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-gray-900">
                            <?php 
                            if (isset($_GET['product_cat'])) {
                                $current_cat = get_term_by('slug', $_GET['product_cat'], 'product_cat');
                                echo esc_html($current_cat->name);
                            } else {
                                echo 'Все запчасти';
                            }
                            ?>
                        </h1>
                        <div class="text-sm text-gray-600">
                            <?php
                            // Добавляем запрос для получения товаров перед выводом количества
                            $products_query = new WP_Query(array(
                                'post_type' => 'product',
                                'posts_per_page' => -1, // Получаем все товары
                                'post_status' => 'publish'
                            ));

                            // Теперь можно безопасно использовать $products_query->found_posts
                            ?>
                            <div class="mb-4">
                                <p class="text-gray-600">
                                    Найдено <?php echo $products_query->found_posts; ?> запчасти
                                </p>
                            </div>

                            <?php
                            // Не забываем сбросить запрос после использования
                            wp_reset_postdata();

                            if (isset($_GET['parts_search']) && !empty($_GET['parts_search'])) {
                                echo ' по запросу "' . esc_html($_GET['parts_search']) . '"';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Поиск -->
                    <div class="flex-1">
                        <div class="relative w-full">
                            <form class="relative w-full" method="get">
                                <?php
                                $current_filters = ['product_cat', 'manufacturer', 'crane_model', 'orderby'];
                                foreach ($current_filters as $filter) {
                                    if (isset($_GET[$filter])) {
                                        echo '<input type="hidden" name="' . esc_attr($filter) . '" value="' . esc_attr($_GET[$filter]) . '">';
                                    }
                                }
                                ?>
                                <input type="text" 
                                       name="parts_search" 
                                       value="<?php echo isset($_GET['parts_search']) ? esc_attr($_GET['parts_search']) : ''; ?>"
                                       class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary"
                                       placeholder="Поиск по названию..."
                                       autocomplete="off">
                                <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </button>
                            </form>

                            <!-- История поиска -->
                            <div class="absolute left-0 right-0 top-full mt-1 bg-white rounded-lg border border-gray-200 shadow-lg z-10 hidden" id="search-history">
                                <div class="py-2">
                                    <div class="px-4 py-2 text-sm text-gray-500">История поиска</div>
                                    <div class="divide-y divide-gray-100">
                                        <!-- Элементы истории -->
                                        <button class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-50 flex items-center justify-between group">
                                            <span>Подшипнк</span>
                                            <svg class="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                        <!-- Добавьте больше элементов истории по необходимости -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Сортировка -->
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <span class="text-sm text-gray-600">Сортировать:</span>
                        <div class="flex gap-2">
                            <?php
                            $sort_options = [
                                'title' => 'По алфавиту',
                                'type' => 'По типу'
                            ];
                            $current_sort = isset($_GET['orderby']) ? $_GET['orderby'] : 'title';
                            $current_order = isset($_GET['order']) ? $_GET['order'] : 'asc';

                            foreach ($sort_options as $value => $label):
                                $is_active = $current_sort === $value;
                                $new_order = $is_active && $current_order === 'asc' ? 'desc' : 'asc';
                                $url = add_query_arg([
                                    'orderby' => $value,
                                    'order' => $is_active ? $new_order : 'asc'
                                ]);
                            ?>
                                <a href="<?php echo esc_url($url); ?>" 
                                   class="inline-flex items-center px-3 py-1 rounded-full text-sm <?php echo $is_active ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?>">
                                    <?php echo $label; ?>
                                    <?php if ($is_active): ?>
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M<?php echo $current_order === 'asc' ? '8 16l4-4 4 4' : '8 8l4 4 4-4'; ?>"/>
                                        </svg>
                                    <?php endif; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            // Получаем все т��вары с учетом фильтров
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            
            // Базовые параметры запроса
            $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 20;
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => $per_page,
                'paged' => $paged,
                'orderby' => 'title',
                'order' => 'ASC'
            );

            // Проверяем наличие активных фильтров
            $has_filters = isset($_GET['product_cat']) || 
                          isset($_GET['manufacturer']) || 
                          isset($_GET['crane_model']) ||
                          (isset($_GET['orderby']) && $_GET['orderby'] !== 'title');

            // Проверяем наличие поискового запроса
            $search_query = isset($_GET['parts_search']) && !empty($_GET['parts_search']) ? 
                           sanitize_text_field($_GET['parts_search']) : '';

            // Если есть поисковый запрос, сначала ищем в текущей категории
            if ($search_query) {
                $args['s'] = $search_query;
                
                // Если выбрана категория, добавляем её в поиск
                if (isset($_GET['product_cat'])) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => sanitize_text_field($_GET['product_cat'])
                        )
                    );
                }

                // Первый поиск в текущей категории
                $products_query = new WP_Query($args);

                // Если ничего не найдено и была выбрана категория, 
                // делаем второй поиск по всем товарам
                if ($products_query->found_posts == 0 && isset($_GET['product_cat'])) {
                    // Убираем фильтр по категории для поиска везде
                    unset($args['tax_query']);
                    $products_query = new WP_Query($args);
                    
                    // Если что-то нашли, показываем уведомление
                    if ($products_query->found_posts > 0) {
                        ?>
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        В текущей категории ничего не найдено. Показаны результаты поиска по всем запчастям.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                // Если нет поискового запроса, применяем обычные фильтры
                if ($has_filters) {
                    // Поиск
                    if (isset($_GET['parts_search']) && !empty($_GET['parts_search'])) {
                        $args['s'] = sanitize_text_field($_GET['parts_search']);
                    }

                    // Сортировка
                    if (isset($_GET['orderby'])) {
                        switch($_GET['orderby']) {
                            case 'title':
                                $args['orderby'] = 'title';
                                break;
                            case 'type':
                                $args['orderby'] = 'tax_product_cat';
                                break;
                            default:
                                $args['orderby'] = 'title';
                        }
                        $args['order'] = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'ASC';
                    }

                    // Фильтр по категории
                    if (isset($_GET['product_cat'])) {
                        $args['tax_query'][] = array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => sanitize_text_field($_GET['product_cat'])
                        );
                    }

                    // Фильтр по производителю
                    if (isset($_GET['manufacturer'])) {
                        $args['meta_query'][] = array(
                            'key' => '_manufacturer',
                            'value' => sanitize_text_field($_GET['manufacturer']),
                            'compare' => 'LIKE'
                        );
                    }

                    // Фльтр по модели крана
                    if (isset($_GET['crane_model'])) {
                        $args['meta_query'][] = array(
                            'key' => '_compatible_cranes',
                            'value' => sanitize_text_field($_GET['crane_model']),
                            'compare' => 'LIKE'
                        );
                    }
                }
                $products_query = new WP_Query($args);
            }

            if ($products_query->have_posts()) :
            ?>
                <!-- Табличное отображение товаров -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ��аименование
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Действия
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php
                            while ($products_query->have_posts()) : $products_query->the_post();
                                global $product;
                                ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">
                                            <?php the_title(); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex justify-end items-center gap-3">
                                            <!-- Поле для количества -->
                                            <div class="flex items-center">
                                                <button onclick="decrementQuantity('qty_<?php echo get_the_ID(); ?>')" 
                                                        class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-primary border border-gray-200 rounded-l focus:outline-none">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                    </svg>
                                                </button>
                                                <input type="number" 
                                                       id="qty_<?php echo get_the_ID(); ?>" 
                                                       value="1" 
                                                       min="1"
                                                       class="w-14 h-8 text-center border-y border-gray-200 focus:outline-none focus:border-primary text-gray-700"
                                                       onchange="validateQuantity(this)">
                                                <button onclick="incrementQuantity('qty_<?php echo get_the_ID(); ?>')" 
                                                        class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-primary border border-gray-200 rounded-r focus:outline-none">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Кнопки действий -->
                                            <button onclick="orderAndRedirect('<?php echo esc_attr(get_the_title()); ?>', '<?php echo esc_url(home_url('/wp/my-order/')); ?>', document.getElementById('qty_<?php echo get_the_ID(); ?>').value)" 
                                                    class="inline-flex items-center px-3 py-1.5 bg-primary text-white text-sm font-medium rounded hover:bg-primary-hover transition-colors">
                                                Заказать
                                            </button>
                                            <button onclick="addToOrder('<?php echo esc_attr(get_the_title()); ?>', document.getElementById('qty_<?php echo get_the_ID(); ?>').value)" 
                                                    class="inline-flex items-center px-3 py-1.5 border border-primary text-primary text-sm font-medium rounded hover:bg-primary/5 transition-colors">
                                                Добавить в заказ
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    
                    <!-- Опции отображения -->
                    <div class="p-4 border-t border-gray-200 bg-gray-50 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600">Показывать по:</span>
                            <div class="flex gap-2">
                                <?php
                                $per_page_options = array(20, 50, 100);
                                $current_per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 20;
                                
                                foreach ($per_page_options as $option) {
                                    $url = add_query_arg('per_page', $option);
                                    $is_active = $current_per_page === $option;
                                    ?>
                                    <a href="<?php echo esc_url($url); ?>" 
                                       class="px-2 py-1 text-sm rounded <?php echo $is_active 
                                            ? 'bg-primary text-white font-medium' 
                                            : 'text-gray-600 hover:text-primary transition-colors'; ?>">
                                        <?php echo $option; ?>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="text-sm text-gray-600">
                            Всего найдено: <?php echo $products_query->found_posts; ?> запчастей
                        </div>
                    </div>
                </div>

                <!-- Пагинация -->
                <?php if ($products_query->max_num_pages > 1): ?>
                    <div class="mt-8 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <?php
                            $prev_link = get_pagenum_link(max(1, get_query_var('paged') - 1));
                            $next_link = get_pagenum_link(min($products_query->max_num_pages, get_query_var('paged') + 1));
                            $current_page = max(1, get_query_var('paged'));
                            $total_pages = $products_query->max_num_pages;
                            ?>
                            
                            <!-- Кнопка "Назад" -->
                            <a href="<?php echo esc_url($prev_link); ?>" 
                               class="inline-flex items-center px-4 py-2 rounded-lg border <?php echo $current_page === 1 ? 'border-gray-200 text-gray-400 cursor-not-allowed' : 'border-gray-300 text-gray-700 hover:bg-gray-50'; ?>"
                               <?php echo $current_page === 1 ? 'disabled' : ''; ?>>
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Назад
                            </a>

                            <!-- Информация о страницах -->
                            <span class="text-sm text-gray-600">
                                Страница <?php echo $current_page; ?> из <?php echo $total_pages; ?>
                            </span>

                            <!-- Кнопка "Вперед" -->
                            <a href="<?php echo esc_url($next_link); ?>" 
                               class="inline-flex items-center px-4 py-2 rounded-lg border <?php echo $current_page === $total_pages ? 'border-gray-200 text-gray-400 cursor-not-allowed' : 'border-gray-300 text-gray-700 hover:bg-gray-50'; ?>"
                               <?php echo $current_page === $total_pages ? 'disabled' : ''; ?>>
                                Вперед
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>

                        <!-- Быстрый переход на страницу -->
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600">Перейти на страницу:</span>
                            <select onchange="window.location.href=this.value" 
                                    class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm text-gray-700">
                                <?php
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    $selected = $i === $current_page ? 'selected' : '';
                                    echo sprintf(
                                        '<option value="%s" %s>%d</option>',
                                        esc_url(get_pagenum_link($i)),
                                        $selected,
                                        $i
                                    );
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <!-- Сообщение о том, что ничего не найдено -->
                <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-4 text-gray-500">
                        По вашему запросу ничего не найдено. Попробуйте изменить параметры поиска.
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- JavaScript для обновления моделей -->
<script>
const manufacturers = <?php echo json_encode($manufacturers); ?>;

function updateModels(manufacturer) {
    const modelSelect = document.getElementById('crane-model-select');
    modelSelect.innerHTML = '<option value="">��ыберите модель</option>';
    
    if (manufacturer && manufacturers[manufacturer]) {
        manufacturers[manufacturer].models.forEach(model => {
            const option = document.createElement('option');
            option.value = model.toLowerCase().replace(/\s+/g, '-');
            option.textContent = model;
            modelSelect.appendChild(option);
        });
        modelSelect.disabled = false;
    } else {
        modelSelect.disabled = true;
    }
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    const manufacturerSelect = document.querySelector('select[name="manufacturer"]');
    if (manufacturerSelect.value) {
        updateModels(manufacturerSelect.value);
    }
});
</script>

<script>
// Функции для работы с количеством
function incrementQuantity(inputId) {
    const input = document.getElementById(inputId);
    input.value = Math.min(9999, parseInt(input.value) + 1);
}

function decrementQuantity(inputId) {
    const input = document.getElementById(inputId);
    input.value = Math.max(1, parseInt(input.value) - 1);
}

function validateQuantity(input) {
    input.value = Math.max(1, Math.min(9999, parseInt(input.value) || 1));
}

// Обновленная функция ��обавления в заказ
function addToOrder(partName, quantity) {
    const selectedParts = JSON.parse(localStorage.getItem('selectedParts') || '[]');
    quantity = parseInt(quantity) || 1;
    
    // Ищем запчасть в списке
    const existingPartIndex = selectedParts.findIndex(item => item.name === partName);
    
    if (existingPartIndex === -1) {
        // Добавляем новую запчасть
        selectedParts.push({
            name: partName,
            quantity: quantity
        });
        showNotification('success', 'Запчасть добавлена в заказ');
    } else {
        // Обновляем количество существующей запчасти
        selectedParts[existingPartIndex].quantity += quantity;
        showNotification('warning', 'Количество запчастей в заказе обновлено');
    }
    
        localStorage.setItem('selectedParts', JSON.stringify(selectedParts));
}

// Обновленная функция заказа с редиректом
function orderAndRedirect(partName, orderUrl, quantity) {
    const selectedParts = JSON.parse(localStorage.getItem('selectedParts') || '[]');
    quantity = parseInt(quantity) || 1;
    
    // Ищем запчасть в списке
    const existingPartIndex = selectedParts.findIndex(item => item.name === partName);
    
    if (existingPartIndex === -1) {
        // Добавляем новую запчасть
        selectedParts.push({
            name: partName,
            quantity: quantity
        });
    } else {
        // Обновляем количество существующей запчасти
        selectedParts[existingPartIndex].quantity += quantity;
    }
    
    localStorage.setItem('selectedParts', JSON.stringify(selectedParts));
    window.location.href = orderUrl;
}

// Функция для показа уведомлений
function showNotification(type, message) {
        const notification = document.createElement('div');
    notification.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in ${
        type === 'success' ? 'bg-green-500' : 'bg-yellow-500'
    } text-white`;
    
    const icon = type === 'success' 
        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>'
        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>';
    
        notification.innerHTML = `
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${icon}
                </svg>
            <span>${message}</span>
            </div>
        `;
    
        document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}
</script>

<?php get_footer(); ?> 