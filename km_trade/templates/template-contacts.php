<?php
/**
 * Template Name: Контакты
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
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Контакты</h1>
                <p class="text-xl text-zinc-300">Свяжитесь с нами любым удобным способом</p>
            </div>
        </div>
    </section>

    <!-- Основной контент -->
    <div class="container mx-auto px-4 mb-16">
        <div class="max-w-4xl mx-auto">
            <!-- Контактная информация -->
            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Телефон</h3>
                    <p class="text-gray-600">
                        <a href="tel:+78001234567" class="hover:text-primary">
                            8 (800) 123-45-67
                        </a>
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Email</h3>
                    <p class="text-gray-600">
                        <a href="mailto:info@example.com" class="hover:text-primary">
                            info@example.com
                        </a>
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Адрес</h3>
                    <p class="text-gray-600">
                        г. Москва, ул. Примерная, д. 1
                    </p>
                </div>
            </div>

            <!-- Форма обратной связи -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold mb-6">Напишите нам</h2>
                <form id="contact-form" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ваше имя *
                            </label>
                            <input type="text" 
                                   name="name" 
                                   required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email *
                            </label>
                            <input type="email" 
                                   name="email" 
                                   required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Сообщение *
                        </label>
                        <textarea name="message" 
                                  required
                                  rows="4"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"></textarea>
                    </div>

                    <div>
                        <button type="submit" 
                                class="w-full md:w-auto px-8 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                            Отправить сообщение
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
