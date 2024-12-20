<?php
/**
 * Шаблон архива продуктов
 * 
 * Используется для отображения архивной страницы
 * пользовательского типа записей 'products'.
 * При отсутствии продуктов отображает страницу 404.
 * 
 * @package KMTrade
 * @since 1.0.0
 */

get_header(); ?>

<?php if (have_posts()) : ?>
    <main class="site-main">
        <div class="container">
            <header class="products-header">
                <h1 class="products-title"><?php post_type_archive_title(); ?></h1>
            </header>

            <div class="products-content">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content', 'product'); ?>
                <?php endwhile; ?>

                <?php the_posts_pagination(); ?>
            </div>
        </div>
    </main>
<?php else : ?>
    <?php get_template_part('404'); ?>
<?php endif; ?>

<?php get_footer(); ?> 