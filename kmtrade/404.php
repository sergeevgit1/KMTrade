<?php
/**
 * Шаблон страницы 404
 * 
 * Этот шаблон используется для отображения страницы с ошибкой 404 (страница не найдена).
 * Включает в себя анимированный кран и кнопку возврата на главную страницу.
 * 
 * @package KMTrade
 * @since 1.0.0
 */

get_header(); ?>

<div class="error-404">
    <div class="container">
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
                <h1>404</h1>
                <h2>Страница не найдена</h2>
                <p>К сожалению, запрашиваемая страница не существует или была перемещена</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="back-home">Вернуться на главную</a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?> 