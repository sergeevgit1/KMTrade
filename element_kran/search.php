<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <!-- Заголовок поиска -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">
                <?php
                $search_query = get_search_query();
                printf(
                    esc_html__('Результаты поиска для: %s', 'element_kran'),
                    '<span class="text-primary">"' . esc_html($search_query) . '"</span>'
                );
                ?>
            </h1>
            <p class="text-gray-600">
                <?php
                $found_posts = $wp_query->found_posts;
                printf(
                    esc_html(_n(
                        'Найден %s результат',
                        'Найдено %s результатов',
                        $found_posts,
                        'element_kran'
                    )),
                    number_format_i18n($found_posts)
                );
                ?>
            </p>
        </div>

        <?php if (have_posts()) : ?>
            <!-- Результаты поиска -->
            <div class="space-y-6">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-6">
                        <div class="flex items-start gap-6">
                            <!-- Изображение товара -->
                            <div class="w-40 h-40 flex-shrink-0">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('medium'); ?>"
                                         alt="<?php the_title_attribute(); ?>"
                                         class="w-full h-full object-cover rounded-lg">
                                <?php else : ?>
                                    <div class="w-full h-full bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Информация о товаре -->
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-900 mb-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <?php if ('product' === get_post_type()) : ?>
                                    <!-- Дополнительная информация для товаров -->
                                    <?php
                                    $product = wc_get_product(get_the_ID());
                                    if ($product) :
                                        $categories = get_the_terms(get_the_ID(), 'product_cat');
                                        $brand = get_the_terms(get_the_ID(), 'brand');
                                    ?>
                                        <div class="flex flex-wrap gap-2 mb-3">
                                            <?php if ($categories && !is_wp_error($categories)) : ?>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800">
                                                    <?php echo esc_html($categories[0]->name); ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if ($brand && !is_wp_error($brand)) : ?>
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-primary/10 text-primary">
                                                    <?php echo esc_html($brand[0]->name); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="text-gray-600 mb-4">
                                    <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                                </div>

                                <div class="flex items-center justify-between">
                                    <?php if ('product' === get_post_type() && $product) : ?>
                                        <?php if ($product->get_price()) : ?>
                                            <div class="text-lg font-bold text-gray-900">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                        <?php else : ?>
                                            <div class="text-gray-600">
                                                Цена по запросу
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <a href="<?php the_permalink(); ?>" 
                                       class="inline-flex items-center text-primary hover:text-primary-hover transition-colors">
                                        Подробнее
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Пагинация -->
            <?php if ($wp_query->max_num_pages > 1) : ?>
                <div class="mt-8">
                    <div class="flex justify-center gap-2">
                        <?php
                        echo paginate_links(array(
                            'prev_text' => '&larr;',
                            'next_text' => '&rarr;',
                            'type' => 'list',
                            'class' => 'flex',
                        ));
                        ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <!-- Ничего не найдено -->
            <div class="text-center py-12">
                <div class="mb-6">
                    <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 mb-2">
                    Ничего не найдено
                </h2>
                <p class="text-gray-600 mb-6">
                    К сожалению, по вашему запросу ничего не найдено. Попробуйте изменить параметры поиска.
                </p>
                <a href="<?php echo esc_url(home_url('/')); ?>" 
                   class="inline-flex items-center justify-center px-6 py-2 bg-primary text-white rounded-full hover:bg-primary-hover transition-colors">
                    Вернуться на главную
                </a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?> 