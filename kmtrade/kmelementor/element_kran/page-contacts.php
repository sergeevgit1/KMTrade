<?php
/*
Template Name: Контакты
*/

get_header();
?>

<main>
    <!-- Баннер -->
    <section class="bg-zinc-900 py-12 mb-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Контакты</h1>
                <p class="text-xl text-zinc-300">Свяжитесь с нами любым удобным способом</p>
            </div>
        </div>
    </section>

    <!-- Основной контент -->
    <div class="container mx-auto px-4 mb-16">
        <!-- Карточки контактов -->
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <!-- Телефон -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-zinc-100">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-zinc-900 mb-2">Телефон</h3>
                <p class="text-zinc-600 mb-4">Звоните в рабочее время</p>
                <a href="tel:<?php echo get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX'); ?>" 
                   class="text-lg font-medium text-orange-600 hover:text-orange-700">
                    <?php echo get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX'); ?>
                </a>
            </div>

            <!-- Email -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-zinc-100">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-zinc-900 mb-2">Email</h3>
                <p class="text-zinc-600 mb-4">Напишите нам на почту</p>
                <a href="mailto:<?php echo get_theme_mod('email', 'info@example.com'); ?>" 
                   class="text-lg font-medium text-orange-600 hover:text-orange-700">
                    <?php echo get_theme_mod('email', 'info@example.com'); ?>
                </a>
            </div>

            <!-- Адрес -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-zinc-100">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-zinc-900 mb-2">Адрес</h3>
                <p class="text-zinc-600 mb-4">Наш офис</p>
                <address class="text-lg font-medium text-orange-600 not-italic">
                    <?php echo get_theme_mod('address', 'г. Москва, ул. Примерная, д. 1'); ?>
                </address>
            </div>
        </div>

        <!-- Карта и форма -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Карта -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-100 overflow-hidden">
                <iframe 
                    src="<?php echo get_theme_mod('map_url', 'https://www.google.com/maps/embed?pb=your-map-url'); ?>"
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <!-- Форма обратной связи -->
            <div class="bg-white rounded-xl p-8 shadow-sm border border-zinc-100">
                <h3 class="text-2xl font-bold text-zinc-900 mb-6">Напишите нам</h3>
                <?php echo do_shortcode('[contact-form-7 id="FORM_ID" title="Контактная форма"]'); ?>
            </div>
        </div>

        <!-- Режим работы -->
        <div class="mt-16 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-8">
            <h3 class="text-2xl font-bold text-zinc-900 mb-6">Режим работы</h3>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h4 class="font-medium text-zinc-900 mb-4">Офис</h4>
                    <ul class="space-y-2 text-zinc-600">
                        <li>Понедельник - Пятница: 9:00 - 18:00</li>
                        <li>Суббота: 10:00 - 15:00</li>
                        <li>Воскресенье: выходной</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-medium text-zinc-900 mb-4">Склад</h4>
                    <ul class="space-y-2 text-zinc-600">
                        <li>Понедельник - Пятница: 9:00 - 17:00</li>
                        <li>Суббота - Воскресенье: выходной</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?> 