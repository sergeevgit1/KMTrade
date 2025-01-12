<?php
/*
Template Name: Каталог запчастей
*/

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

<?php get_footer(); ?> 