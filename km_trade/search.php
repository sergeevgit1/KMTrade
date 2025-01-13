<?php get_header(); ?>

<main>
    <div class="bg-zinc-50 min-h-[calc(100vh-var(--header-height))]">
        <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px] py-[40px] lg:py-[60px]">
            <!-- Заголовок и статистика -->
            <div class="mb-8">
                <h1 class="text-2xl lg:text-3xl font-bold mb-2">
                    Результаты поиска
                </h1>
                <div class="text-zinc-600">
                    <?php
                    global $wp_query;
                    $total = $wp_query->found_posts;
                    printf(
                        'Найдено %d %s по запросу «%s»',
                        $total,
                        km_trade_get_search_plural($total),
                        get_search_query()
                    );
                    ?>
                </div>
            </div>

            <!-- Форма поиска -->
            <div class="bg-white rounded-xl border border-zinc-100 p-6 mb-8">
                <?php get_search_form(); ?>
            </div>

            <!-- Результаты поиска -->
            <?php if (have_posts()) : ?>
                <div class="space-y-4">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="bg-white rounded-xl border border-zinc-100 p-6 hover:shadow-lg transition-shadow">
                            <div class="flex flex-col md:flex-row gap-6">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="flex-shrink-0">
                                        <?php the_post_thumbnail('thumbnail', ['class' => 'w-full md:w-[200px] h-auto object-cover rounded-lg']); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="flex-grow">
                                    <!-- Мета-информация -->
                                    <div class="flex items-center gap-4 text-sm text-zinc-500 mb-2">
                                        <span><?php echo get_post_type_object(get_post_type())->labels->singular_name; ?></span>
                                        <span>•</span>
                                        <time datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo get_the_date('d.m.Y'); ?>
                                        </time>
                                    </div>

                                    <h2 class="text-xl font-bold mb-3">
                                        <a href="<?php the_permalink(); ?>" class="text-zinc-900 hover:text-[#F38D19] transition-colors">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                    <div class="text-zinc-600 mb-4">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-[#F38D19] hover:text-[#E07D08] transition-colors">
                                        <span class="mr-2">Подробнее</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <?php km_trade_pagination(); ?>
                
            <?php else : ?>
                <div class="bg-white rounded-xl border border-zinc-100 p-6">
                    <p class="text-zinc-600">По вашему запросу ничего не найдено.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?> 