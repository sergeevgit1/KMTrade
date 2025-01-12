<?php
if (!defined('ABSPATH')) {
    exit;
}

// Получаем переданные аргументы
$args = wp_parse_args($args, [
    'hero_defaults' => []
]);

$hero_defaults = $args['hero_defaults'];
?>

<section class="relative overflow-hidden bg-gradient-to-br from-white to-gray-50">
    <div class="absolute inset-0 pattern-bg opacity-5"></div>
    <div class="relative container mx-auto px-4 py-12">
        <div class="grid lg:grid-cols-2 gap-8 items-center">
            <!-- Левая колонка с контентом -->
            <div class="relative z-10">
                <div class="mb-12">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-zinc-900 mb-6 leading-tight">
                        <?php echo esc_html(get_theme_mod('hero_title', $hero_defaults['title'])); ?>
                    </h1>
                    <p class="text-xl text-zinc-600 mb-8 leading-relaxed max-w-2xl">
                        <?php echo esc_html(get_theme_mod('hero_subtitle', $hero_defaults['subtitle'])); ?>
                    </p>
                    
                    <!-- Кнопки действий -->
                    <div class="flex flex-wrap gap-4">
                        <a href="/catalog/" 
                           class="inline-flex items-center px-8 py-4 bg-brand-orange text-white rounded hover:bg-brand-orange-dark transition-colors font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                            </svg>
                            Перейти в каталог
                        </a>
                        <a href="#contacts" 
                           class="inline-flex items-center px-8 py-4 border border-brand-orange/20 text-gray-900 rounded hover:bg-brand-orange/5 transition-colors font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Связаться с нами
                        </a>
                    </div>
                </div>

                <!-- Преимущества -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php foreach ($hero_defaults['advantages'] as $advantage): ?>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-brand-orange/10 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-brand-orange transition-colors">
                                    <?php echo esc_html($advantage['title']); ?>
                                </h3>
                                <p class="text-gray-600">
                                    <?php echo esc_html($advantage['text']); ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Правая колонка с изображением -->
            <div class="relative hidden lg:block">
                <img src="<?php echo get_theme_mod('hero_image', get_template_directory_uri() . '/assets/images/crane-hero.png'); ?>" 
                     alt="Башенный кран" 
                     class="w-full h-auto max-w-2xl mx-auto">
            </div>
        </div>
    </div>
</section> 