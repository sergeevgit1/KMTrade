<?php
/*
Template Name: Catalog Page
*/

get_header();
?>

<main>
    <!-- Отступ от шапки -->
    <div class="pt-[50px]"></div>

    <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px]">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Боковая панель с фильтрами -->
            <div class="w-full md:w-64 flex-shrink-0">
                <?php get_template_part('template-parts/catalog/filters'); ?>
            </div>

            <!-- Основной контент -->
            <div class="flex-1">
                <?php get_template_part('template-parts/catalog/product-list'); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
