<?php
if (!defined('ABSPATH')) {
    exit;
}

// Получаем последние посты
$posts = get_posts([
    'post_type' => 'post',
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC'
]);

if (!empty($posts)) :
?>
    <section class="py-[60px] bg-white">
        <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px]">
            <!-- Заголовок секции -->
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl lg:text-3xl font-bold">Блог компании</h2>
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" 
                   class="hidden md:flex items-center text-[#F38D19] hover:text-[#E07D08] transition-colors">
                    <span class="mr-2">Все статьи</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Десктопная версия -->
            <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($posts as $post) : setup_postdata($post); ?>
                    <article class="bg-white rounded-xl border border-zinc-100 overflow-hidden hover:shadow-lg transition-shadow">
                        <?php
                        // Получаем первое изображение из контента
                        $post_content = get_the_content();
                        preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post_content, $matches);
                        $first_image = !empty($matches[1]) ? $matches[1] : '';
                        
                        if ($first_image) : ?>
                            <a href="<?php the_permalink(); ?>" class="block aspect-[16/9] overflow-hidden">
                                <img src="<?php echo esc_url($first_image); ?>" 
                                     alt="<?php echo esc_attr(get_the_title()); ?>"
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                >
                            </a>
                        <?php else: ?>
                            <a href="<?php the_permalink(); ?>" class="block aspect-[16/9] bg-zinc-100 overflow-hidden">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" 
                                     alt="Изображение отсутствует"
                                     class="w-full h-full object-cover"
                                >
                            </a>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <div class="text-sm text-zinc-500 mb-2">
                                <?php echo get_the_date('d.m.Y'); ?>
                            </div>
                            <h3 class="text-lg font-bold mb-3">
                                <a href="<?php the_permalink(); ?>" 
                                   class="text-zinc-900 hover:text-[#F38D19] transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div class="text-zinc-600 text-sm mb-4">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" 
                               class="inline-flex items-center text-[#F38D19] hover:text-[#E07D08] transition-colors">
                                <span class="mr-2">Читать далее</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>

            <!-- Мобильная версия (слайдер) -->
            <div class="md:hidden">
                <div class="swiper blog-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($posts as $post) : setup_postdata($post); ?>
                            <div class="swiper-slide">
                                <article class="bg-white rounded-xl border border-zinc-100 overflow-hidden">
                                    <?php
                                    // Получаем первое изображение из контента
                                    $post_content = get_the_content();
                                    preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post_content, $matches);
                                    $first_image = !empty($matches[1]) ? $matches[1] : '';
                                    
                                    if ($first_image) : ?>
                                        <a href="<?php the_permalink(); ?>" class="block aspect-[16/9] overflow-hidden">
                                            <img src="<?php echo esc_url($first_image); ?>" 
                                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                            >
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php the_permalink(); ?>" class="block aspect-[16/9] bg-zinc-100 overflow-hidden">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" 
                                                 alt="Изображение отсутствует"
                                                 class="w-full h-full object-cover"
                                            >
                                        </a>
                                    <?php endif; ?>
                                    
                                    <div class="p-4">
                                        <div class="text-sm text-zinc-500 mb-2">
                                            <?php echo get_the_date('d.m.Y'); ?>
                                        </div>
                                        <h3 class="text-lg font-bold mb-3">
                                            <a href="<?php the_permalink(); ?>" 
                                               class="text-zinc-900 hover:text-[#F38D19] transition-colors">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="text-zinc-600 text-sm mb-4">
                                            <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" 
                                           class="inline-flex items-center text-[#F38D19] hover:text-[#E07D08] transition-colors">
                                            <span class="mr-2">Читать далее</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                </div>

                <!-- Кнопка "Все статьи" для мобильной версии -->
                <div class="text-center mt-6">
                    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" 
                       class="inline-flex items-center text-[#F38D19] hover:text-[#E07D08] transition-colors">
                        <span class="mr-2">Все статьи</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Инициализация слайдера -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.blog-slider')) {
        new Swiper('.blog-slider', {
            slidesPerView: 1.2,
            spaceBetween: 16,
            centeredSlides: true,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1.5,
                    spaceBetween: 20,
                }
            }
        });
    }
});
</script> 