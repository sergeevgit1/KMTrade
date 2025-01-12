<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="min-h-screen">
    <!-- Основной контент с отступом от шапки -->
    <div class="pt-[180px]">
        <!-- Хлебные крошки -->
        <div class="max-w-screen-2xl mx-auto px-[30px] lg:px-[120px]">
            <?php get_template_part('template-parts/catalog/breadcrumbs'); ?>
        </div>

        <!-- Баннер -->
        <div class="w-full py-16 mt-8">
            <div class="max-w-screen-2xl mx-auto px-[30px] lg:px-[120px]">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl font-bold text-zinc-900 mb-6">
                        <?php 
                        if (is_product_category()) {
                            single_cat_title();
                        } else {
                            echo get_the_title();
                        }
                        ?>
                    </h1>
                    <div class="text-xl text-zinc-600">
                        <?php 
                        if (is_product_category() && category_description()) {
                            echo category_description();
                        } else {
                            echo '<p>Широкий выбор запчастей для башенных кранов от ведущих производителей</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 