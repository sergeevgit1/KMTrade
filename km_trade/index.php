<?php
/**
 * Основной шаблон
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main>
    <div class="container mx-auto px-4 py-8">
        <?php if (have_posts()) : ?>
            <div class="max-w-4xl mx-auto">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('mb-12'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="mb-6">
                                <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg')); ?>
                            </div>
                        <?php endif; ?>

                        <h1 class="text-3xl font-bold mb-4">
                            <?php the_title(); ?>
                        </h1>

                        <div class="prose max-w-none">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>

                <!-- Пагинация -->
                <?php
                the_posts_pagination(array(
                    'prev_text' => '&larr;',
                    'next_text' => '&rarr;',
                    'class' => 'flex justify-center space-x-2 mt-8'
                ));
                ?>
            </div>
        <?php else : ?>
            <div class="text-center py-12">
                <h1 class="text-2xl font-bold mb-4">
                    <?php esc_html_e('Ничего не найдено', 'km-trade'); ?>
                </h1>
                <p class="text-gray-600">
                    <?php esc_html_e('По вашему запросу ничего не найдено', 'km-trade'); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
