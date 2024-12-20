<?php
/**
 * Шаблон страницы результатов поиска
 * 
 * Отображает результаты поиска по сайту. При отсутствии результатов
 * показывает специальное сообщение с формой повторного поиска.
 * 
 * @package KMTrade
 * @since 1.0.0
 */

get_header(); ?>

<div class="search-results">
    <div class="container">
        <header class="search-header">
            <h1 class="search-title">
                <?php printf(esc_html__('Результаты поиска: %s', 'kmtrade'), '<span>' . get_search_query() . '</span>'); ?>
            </h1>
        </header>

        <?php if (have_posts()) : ?>
            <div class="search-content">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content', 'search'); ?>
                <?php endwhile; ?>

                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <div class="error-404 search-no-results">
                <div class="error-content">
                    <div class="crane-animation">
                        <svg viewBox="0 0 800 600" class="construction-crane">
                            <!-- Основание крана -->
                            <rect x="350" y="500" width="100" height="20" class="crane-base"/>
                            <!-- Вертикальная мачта -->
                            <rect x="380" y="200" width="40" height="300" class="crane-mast"/>
                            <!-- Стрела крана -->
                            <rect x="400" y="180" width="300" height="30" class="crane-jib"/>
                            <!-- Противовес -->
                            <rect x="200" y="180" width="200" height="30" class="crane-counter-jib"/>
                            <!-- Кабина -->
                            <rect x="360" y="160" width="80" height="50" class="crane-cabin"/>
                            <!-- Трос -->
                            <line x1="600" y1="180" x2="600" y2="350" class="crane-cable"/>
                            <!-- Крюк -->
                            <path d="M580,350 L620,350 L600,380 Z" class="crane-hook"/>
                        </svg>
                    </div>
                    <div class="error-text">
                        <h2>По вашему запросу ничего не найдено</h2>
                        <p>Попробуйте изменить поисковый запрос или вернитесь на главную страницу</p>
                        <div class="search-actions">
                            <?php get_search_form(); ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="back-home">Вернуться на главную</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?> 