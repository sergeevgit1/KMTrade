<?php
if (!defined('ABSPATH')) {
    exit;
}

// Получаем параметры
$per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 20;
$current_page = get_query_var('paged') ? get_query_var('paged') : 1;

// Получаем параметры сортировки
$orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'title';
$order = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'ASC';

// Получаем отфильтрованные товары
$args = array(
    'post_type' => 'product',
    'posts_per_page' => $per_page,
    'paged' => $current_page,
    'orderby' => $orderby,
    'order' => $order
);

// Добавляем фильтр по категории
if (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $_GET['product_cat']
        )
    );
}

// Добавляем фильтры по производителю и модели
if (isset($_GET['manufacturer']) && !empty($_GET['manufacturer'])) {
    if (!isset($args['meta_query'])) {
        $args['meta_query'] = array();
    }
    $args['meta_query'][] = array(
        'key' => '_crane_manufacturer',
        'value' => $_GET['manufacturer']
    );
}

if (isset($_GET['crane_model']) && !empty($_GET['crane_model'])) {
    if (!isset($args['meta_query'])) {
        $args['meta_query'] = array();
    }
    $args['meta_query'][] = array(
        'key' => '_crane_model',
        'value' => $_GET['crane_model']
    );
}

$products_query = new WP_Query($args);

// Функция для генерации URL сортировки
function get_sort_url($column) {
    $current_orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'title';
    $current_order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
    
    $new_order = ($current_orderby === $column && $current_order === 'ASC') ? 'DESC' : 'ASC';
    
    $args = array_merge($_GET, [
        'orderby' => $column,
        'order' => $new_order
    ]);
    
    return add_query_arg($args, '');
}

// Функция для отображения иконки сортировки
function get_sort_icon($column) {
    $current_orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'title';
    $current_order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
    
    if ($current_orderby !== $column) {
        return '<svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path></svg>';
    }
    
    if ($current_order === 'ASC') {
        return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>';
    }
    
    return '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
}

// В начале файла добавим получение URL каталога
$catalog_url = get_permalink(get_page_by_path('catalog'));
?>

<div class="space-y-6">
    <!-- Категории -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-3">
        <!-- Все запчасти -->
        <a href="<?php echo get_permalink(); ?>" 
           class="relative flex items-center justify-between p-4 bg-white rounded-xl border-2 border-zinc-100 group hover:shadow-[0_0_20px_rgba(243,141,25,0.1)] hover:border-[#F38D19] transition-all duration-200 overflow-hidden <?php echo !isset($_GET['product_cat']) ? 'border-[#F38D19] shadow-[0_0_20px_rgba(243,141,25,0.1)]' : ''; ?>">
            <div class="absolute inset-0 bg-gradient-to-br from-[#F38D19]/10 via-[#F38D19]/5 to-transparent opacity-0 group-hover:opacity-100 <?php echo !isset($_GET['product_cat']) ? 'opacity-100' : ''; ?> transition-opacity"></div>
            
            <span class="relative text-sm font-semibold text-zinc-900 group-hover:text-[#F38D19] <?php echo !isset($_GET['product_cat']) ? 'text-[#F38D19]' : ''; ?> transition-colors">
                Все запчасти
            </span>
            <span class="relative ml-4 px-2.5 py-1 bg-[#F38D19]/5 group-hover:bg-[#F38D19]/10 text-[#F38D19] text-xs font-medium rounded-full transition-colors">
                <?php echo wp_count_posts('product')->publish; ?>
            </span>
        </a>

        <?php
        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent' => 0
        ]);

        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $is_current = isset($_GET['product_cat']) && $_GET['product_cat'] === $category->slug;
                // Сохраняем текущие фильтры при смене категории
                $category_url = add_query_arg('product_cat', $category->slug);
                if (isset($_GET['manufacturer'])) {
                    $category_url = add_query_arg('manufacturer', $_GET['manufacturer'], $category_url);
                }
                if (isset($_GET['crane_model'])) {
                    $category_url = add_query_arg('crane_model', $_GET['crane_model'], $category_url);
                }
                ?>
                <a href="<?php echo esc_url($category_url); ?>" 
                   class="relative flex items-center justify-between p-4 bg-white rounded-xl border-2 border-zinc-100 group hover:shadow-[0_0_20px_rgba(243,141,25,0.1)] hover:border-[#F38D19] transition-all duration-200 overflow-hidden <?php echo $is_current ? 'border-[#F38D19] shadow-[0_0_20px_rgba(243,141,25,0.1)]' : ''; ?>">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#F38D19]/10 via-[#F38D19]/5 to-transparent opacity-0 group-hover:opacity-100 <?php echo $is_current ? 'opacity-100' : ''; ?> transition-opacity"></div>
                    
                    <span class="relative text-sm font-semibold text-zinc-900 group-hover:text-[#F38D19] <?php echo $is_current ? 'text-[#F38D19]' : ''; ?> transition-colors">
                        <?php echo esc_html($category->name); ?>
                    </span>
                    <span class="relative ml-4 px-2.5 py-1 bg-[#F38D19]/5 group-hover:bg-[#F38D19]/10 text-[#F38D19] text-xs font-medium rounded-full transition-colors">
                        <?php echo $category->count; ?>
                    </span>
                </a>
                <?php
            }
        }
        ?>
    </div>

    <!-- Таблица товаров -->
    <div class="bg-white rounded-[20px] border border-zinc-100">
        <?php if ($products_query->have_posts()) : ?>
            <!-- Шапка таблицы с поиском -->
            <div class="p-6 border-b border-zinc-100">
                <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                    <!-- Левая часть -->
                    <div class="flex-grow">
                        <div class="relative max-w-xl">
                            <input type="text" 
                                   id="table-search"
                                   placeholder="Поиск по названию, производителю или модели..." 
                                   class="w-full pl-10 pr-4 h-11 text-sm bg-white border border-zinc-200 rounded-xl focus:border-[#F38D19] focus:ring-2 focus:ring-[#F38D19]/20 outline-none"
                                   value="<?php echo isset($_GET['s']) ? esc_attr($_GET['s']) : ''; ?>">
                            <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <!-- Кнопка очистки поиска -->
                            <button type="button" 
                                    id="clear-search"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-zinc-600 transition-colors hidden">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Правая часть -->
                    <div class="flex flex-wrap items-center gap-4">
                        <!-- Количество на странице -->
                        <div class="relative">
                            <select onchange="window.location.href=this.value" 
                                    class="appearance-none pl-4 pr-10 py-2 text-sm bg-white border border-zinc-200 rounded-lg focus:border-[#F38D19] focus:ring-2 focus:ring-[#F38D19]/20 outline-none cursor-pointer hover:border-zinc-300 transition-colors">
                                <?php
                                $per_page_options = [20, 50, 100];
                                $current_per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 20;

                                foreach ($per_page_options as $option) {
                                    $url = add_query_arg('per_page', $option);
                                    $selected = $current_per_page === $option ? 'selected' : '';
                                    echo sprintf(
                                        '<option value="%s" %s>Показывать по %d</option>',
                                        esc_url($url),
                                        $selected,
                                        $option
                                    );
                                }
                                ?>
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-zinc-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Сортировка -->
                        <div class="relative">
                            <select onchange="window.location.href=this.value" 
                                    class="appearance-none pl-4 pr-10 py-2 text-sm bg-white border border-zinc-200 rounded-lg focus:border-[#F38D19] focus:ring-2 focus:ring-[#F38D19]/20 outline-none cursor-pointer hover:border-zinc-300 transition-colors">
                                <?php
                                $sort_options = [
                                    'title-asc' => 'По названию (А-Я)',
                                    'title-desc' => 'По названию (Я-А)',
                                    'date-desc' => 'Сначала новые',
                                    'date-asc' => 'Сначала старые'
                                ];

                                $current_orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'title';
                                $current_order = isset($_GET['order']) ? strtolower($_GET['order']) : 'asc';
                                $current_sort = $current_orderby . '-' . $current_order;

                                foreach ($sort_options as $value => $label) {
                                    list($orderby, $order) = explode('-', $value);
                                    $url = add_query_arg(['orderby' => $orderby, 'order' => strtoupper($order)]);
                                    $selected = $current_sort === $value ? 'selected' : '';
                                    echo sprintf(
                                        '<option value="%s" %s>%s</option>',
                                        esc_url($url),
                                        $selected,
                                        esc_html($label)
                                    );
                                }
                                ?>
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-zinc-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Количество найденных -->
                        <div class="px-3 py-2 bg-zinc-50 rounded-lg">
                            <div class="text-sm text-zinc-600">
                                Найдено: <span id="found-count" class="font-medium text-[#F38D19]"><?php echo $products_query->found_posts; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Таблица -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-zinc-50 border-b border-zinc-100">
                            <th class="px-6 py-4 text-left">
                                <a href="<?php echo get_sort_url('title'); ?>" 
                                   class="flex items-center gap-2 text-sm font-medium text-zinc-600 hover:text-[#F38D19]">
                                    Наименование
                                    <?php echo get_sort_icon('title'); ?>
                                </a>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-zinc-600">
                                Производитель крана
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-zinc-600">
                                Модель крана
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-zinc-600">
                                Категория
                            </th>
                            <th class="px-6 py-4 text-right text-sm font-medium text-zinc-600">
                                Действия
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100" id="products-table-body">
                        <?php while ($products_query->have_posts()) : $products_query->the_post(); 
                            $product = wc_get_product(get_the_ID());
                            $categories = get_the_terms(get_the_ID(), 'product_cat');
                            
                            // Получаем производителя и модель крана
                            $crane_manufacturer = get_post_meta(get_the_ID(), '_crane_manufacturer', true);
                            $crane_model = get_post_meta(get_the_ID(), '_crane_model', true);
                        ?>
                            <tr class="hover:bg-zinc-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <a href="<?php the_permalink(); ?>" 
                                       class="text-zinc-900 hover:text-[#F38D19] transition-colors font-medium">
                                        <?php the_title(); ?>
                                    </a>
                                    <?php if ($product->get_short_description()) : ?>
                                        <p class="text-sm text-zinc-500 mt-1">
                                            <?php echo wp_trim_words($product->get_short_description(), 10); ?>
                                        </p>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if ($crane_manufacturer) : ?>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-[#F38D19]/10 text-[#F38D19] font-medium">
                                            <?php echo esc_html($crane_manufacturer); ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="text-sm text-zinc-400">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if ($crane_model) : ?>
                                        <span class="text-sm text-zinc-600">
                                            <?php echo esc_html($crane_model); ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="text-sm text-zinc-400">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php 
                                    if ($categories) {
                                        foreach ($categories as $category) {
                                            echo '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-zinc-100 text-zinc-600 mr-1">' . 
                                                 esc_html($category->name) . 
                                                 '</span>';
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button 
                                        onclick="addToOrder('<?php echo esc_attr(get_the_title()); ?>')"
                                        class="inline-flex items-center px-4 py-2 bg-[#F38D19] text-white text-sm rounded-xl hover:bg-[#E07D08] transition-colors"
                                    >
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        Заказать
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Пагинация -->
            <?php if ($products_query->max_num_pages > 1) : ?>
                <div class="px-6 py-4 border-t border-zinc-100">
                    <div class="flex items-center justify-between">
                        <!-- Информация о страницах -->
                        <div class="text-sm text-zinc-500">
                            Страница <?php echo $current_page; ?> из <?php echo $products_query->max_num_pages; ?>
                        </div>

                        <!-- Пагинация -->
                        <div class="flex items-center gap-2">
                            <?php
                            $pagination = paginate_links(array(
                                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                'format' => '?paged=%#%',
                                'current' => $current_page,
                                'total' => $products_query->max_num_pages,
                                'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>',
                                'next_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>',
                                'type' => 'array',
                                'show_all' => false,
                                'end_size' => 1,
                                'mid_size' => 2,
                                'add_args' => array_map('urlencode', $_GET), // Сохраняем все параметры фильтрации
                            ));

                            if ($pagination) {
                                foreach ($pagination as $link) {
                                    if (strpos($link, 'current') !== false) {
                                        echo str_replace(
                                            ['page-numbers current', 'page-numbers'], 
                                            'inline-flex items-center justify-center w-10 h-10 text-white bg-[#F38D19] rounded-lg', 
                                            $link
                                        );
                                    } elseif (strpos($link, 'dots') !== false) {
                                        echo str_replace(
                                            'page-numbers dots', 
                                            'inline-flex items-center justify-center w-10 h-10 text-zinc-400', 
                                            $link
                                        );
                                    } else {
                                        echo str_replace(
                                            'page-numbers', 
                                            'inline-flex items-center justify-center w-10 h-10 text-zinc-900 hover:text-[#F38D19] hover:bg-[#F38D19]/5 rounded-lg transition-colors', 
                                            $link
                                        );
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- JavaScript для живого поиска -->
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('table-search');
                const clearButton = document.getElementById('clear-search');
                const tableBody = document.getElementById('products-table-body');
                const foundCount = document.getElementById('found-count');
                const rows = tableBody.getElementsByTagName('tr');

                // Показываем/скрываем кнопку очистки
                function toggleClearButton() {
                    clearButton.classList.toggle('hidden', !searchInput.value);
                }

                function filterTable() {
                    const searchText = searchInput.value.toLowerCase();
                    let visibleCount = 0;

                    Array.from(rows).forEach(row => {
                        const titleCell = row.querySelector('td:first-child');
                        const manufacturerCell = row.querySelector('td:nth-child(2)');
                        const modelCell = row.querySelector('td:nth-child(3)');
                        
                        const title = titleCell.textContent.toLowerCase();
                        const description = titleCell.querySelector('p') ? 
                                          titleCell.querySelector('p').textContent.toLowerCase() : '';
                        const manufacturer = manufacturerCell.textContent.toLowerCase();
                        const model = modelCell.textContent.toLowerCase();

                        if (searchText === '' || 
                            title.includes(searchText) || 
                            description.includes(searchText) || 
                            manufacturer.includes(searchText) || 
                            model.includes(searchText)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    foundCount.textContent = visibleCount;
                    toggleClearButton();
                    updateNoResultsMessage(visibleCount);
                }

                // Функция очистки поиска
                window.clearSearch = function() {
                    searchInput.value = '';
                    filterTable();
                    searchInput.focus();
                }

                // Слушатели событий
                searchInput.addEventListener('input', filterTable);
                clearButton.addEventListener('click', clearSearch);
                
                // Очистка поиска по Escape
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        clearSearch();
                    }
                });

                // Инициализация
                toggleClearButton();
            });

            function updateNoResultsMessage(visibleCount) {
                const noResultsMessage = document.getElementById('no-results-message');
                
                if (visibleCount === 0) {
                    if (!noResultsMessage) {
                        const message = document.createElement('tr');
                        message.id = 'no-results-message';
                        message.innerHTML = `
                            <td colspan="5" class="px-6 py-8 text-center">
                                <div class="max-w-sm mx-auto">
                                    <p class="text-zinc-500 mb-2">Запчасти не найдены</p>
                                    <button onclick="clearSearch()" 
                                            class="text-sm text-[#F38D19] hover:text-[#E07D08] transition-colors">
                                        Очистить поиск
                                    </button>
                                </div>
                            </td>
                        `;
                        tableBody.appendChild(message);
                    }
                } else if (noResultsMessage) {
                    noResultsMessage.remove();
                }
            }

            // Функция для обработки изменения производителя
            function handleManufacturerChange(input) {
                const manufacturer = input.value;
                const modelsContainer = document.getElementById('crane-models');
                
                if (!manufacturer) {
                    modelsContainer.innerHTML = '<div class="text-sm text-zinc-400 text-center py-6">Выберите производителя</div>';
                    filterTable();
                    return;
                }

                const manufacturerData = manufacturers[manufacturer];
                if (!manufacturerData) return;

                let html = '';
                manufacturerData.models.forEach(model => {
                    const modelValue = model.toLowerCase().replace(/\s+/g, '-');
                    html += `
                        <label class="flex items-center justify-between p-2 rounded-lg cursor-pointer hover:bg-zinc-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <input type="radio" 
                                       name="crane_model" 
                                       value="${modelValue}"
                                       class="w-4 h-4 border-zinc-300 text-[#F38D19] focus:ring-[#F38D19]/20"
                                       onchange="filterTable()">
                                <span class="text-sm text-zinc-600">
                                    ${model}
                                </span>
                            </div>
                            <span class="text-xs text-zinc-400 model-count" data-model="${modelValue}">0</span>
                        </label>
                    `;
                });
                
                modelsContainer.innerHTML = html;
                filterTable();
            }

            // Обновленная функция очистки всех фильтров
            window.clearAllFilters = function() {
                // Перенаправляем на страницу каталога без параметров
                window.location.href = window.location.pathname;
            }

            // Обновленная функция удаления конкретного фильтра
            window.removeFilter = function(type) {
                // Получаем текущий URL
                const url = new URL(window.location.href);
                
                if (type === 'manufacturer') {
                    // При очистке производителя удаляем также и модель
                    url.searchParams.delete('manufacturer');
                    url.searchParams.delete('crane_model');
                } else {
                    url.searchParams.delete(type);
                }
                
                // Перенаправляем на обновленный URL
                window.location.href = url.toString();
            }
            </script>

            <!-- Остальной код (пагинация и т.д.) остается без изменений -->
        <?php else : ?>
            <div class="text-center py-12">
                <p class="text-zinc-500">Запчасти не найдены</p>
            </div>
        <?php endif; 
        wp_reset_postdata();
        ?>
    </div>
</div> 