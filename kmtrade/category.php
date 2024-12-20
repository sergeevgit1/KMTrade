<?php
/**
 * Шаблон страницы категории
 * 
 * Отображает записи определенной категории.
 * При отсутствии записей показывает страницу 404.
 * 
 * @package KMTrade
 * @since 1.0.0
 */

get_header(); ?>

<?php if (have_posts()) : ?>
    <main class="site-main">
        <div class="container">
            <header class="category-header">
                <h1 class="category-title"><?php single_cat_title(); ?></h1>
                <?php the_archive_description('<div class="category-description">', '</div>'); ?>
            </header>

            <div class="category-content">
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