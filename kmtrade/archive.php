<?php
/**
 * Шаблон архивных страниц
 * 
 * Используется для отображения архивных страниц, включая категории,
 * теги, авторов и даты. Если записей нет, отображает страницу 404.
 * 
 * @package KMTrade
 * @since 1.0.0
 */

get_header(); ?>

<?php if (have_posts()) : ?>
    <main class="site-main">
        <div class="container">
            <header class="archive-header">
                <?php
                the_archive_title('<h1 class="archive-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header>

            <div class="archive-content">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content', get_post_type()); ?>
                <?php endwhile; ?>

                <?php the_posts_pagination(); ?>
            </div>
        </div>
    </main>
<?php else : ?>
    <?php get_template_part('404'); ?>
<?php endif; ?>

<?php get_footer(); ?> 