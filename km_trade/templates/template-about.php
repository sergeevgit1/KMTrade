<?php
/**
 * Template Name: О компании
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main>
    <!-- Баннер -->
    <section class="bg-zinc-900 py-12 mb-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">О компании</h1>
                <p class="text-xl text-zinc-300">Поставляем запчасти для башенных кранов с 2010 года</p>
            </div>
        </div>
    </section>

    <!-- Основной контент -->
    <div class="container mx-auto px-4 mb-16">
        <!-- О нас -->
        <div class="max-w-4xl mx-auto mb-16">
            <div class="prose prose-lg mx-auto">
                <?php the_content(); ?>
            </div>
        </div>

        <!-- Преимущества -->
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <div class="text-center">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Гарантия качества</h3>
                <p class="text-gray-600">Все запчасти проходят строгий контроль качества</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Оперативность</h3>
                <p class="text-gray-600">Быстрая обработка заказов и доставка</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Поддержка</h3>
                <p class="text-gray-600">Консультации по подбору запчастей</p>
            </div>
        </div>

        <!-- Форма заказа -->
        <?php get_template_part('template-parts/home/order-form'); ?>
    </div>
</main>

<?php get_footer(); ?>
