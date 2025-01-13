<?php
/*
Template Name: Каталог запчастей
*/

// Получаем поисковый запрос из параметра
$search_query = isset($_GET['table-search']) ? sanitize_text_field($_GET['table-search']) : '';

// Модифицируем аргументы запроса WP_Query
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
);

// Если есть поисковый запрос, добавляем его в аргументы
if (!empty($search_query)) {
    $args['s'] = $search_query;
}

// Выводим форму поиска с текущим значением
if (!empty($search_query)) : ?>
    <div class="mb-6">
        <div class="bg-white rounded-lg p-4 shadow-sm">
            <p class="text-gray-600">
                Результаты поиска по запросу: <strong><?php echo esc_html($search_query); ?></strong>
            </p>
        </div>
    </div>
<?php endif;

get_header();
?>

<!-- Отступ от шапки -->
<div class="h-[120px] md:h-[150px]"></div>

<!-- Основной контент -->
<main class="pb-[60px] md:pb-[90px] max-w-screen-2xl mx-auto px-[30px] lg:px-[120px]">
    <?php
    // Hero секция
    get_template_part('template-parts/catalog/hero');

    // Преимущества
    get_template_part('template-parts/catalog/advantages');
    ?>

    <!-- Хлебные крошки и заголовок -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <?php get_template_part('template-parts/catalog/breadcrumbs'); ?>
            
            <!-- Сортировка -->
            <div class="flex items-center gap-2">
                <span class="text-sm text-zinc-600">Сортировать:</span>
                <select class="text-sm border-none bg-transparent text-zinc-900 focus:ring-0 cursor-pointer">
                    <option value="popular">По популярности</option>
                    <option value="price_asc">По возрастанию цены</option>
                    <option value="price_desc">По убыванию цены</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Фильтры и список товаров -->
    <?php get_template_part('template-parts/catalog/filters'); ?>
</main>

<!-- В JavaScript части -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('table-search');
    
    // Если есть поисковый запрос, заполняем поле поиска и запускаем фильтрацию
    <?php if (!empty($search_query)) : ?>
    searchInput.value = '<?php echo esc_js($search_query); ?>';
    filterTable(); // Запускаем фильтрацию сразу после загрузки
    <?php endif; ?>
    
    // Остальной код JavaScript...
});
</script>

<?php get_footer(); ?> 