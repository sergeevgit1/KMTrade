<?php
/**
 * Template Name: Быстрый заказ
 */

get_header();
?>

<!-- Hero секция -->
<div class="bg-gradient-to-br from-gray-50 to-gray-100 border-b">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                Быстрый заказ запчастей
            </h1>
            <p class="text-xl text-gray-600">
                Заполните форму, и наши специалисты подберут необходимые запчасти для вашего крана
            </p>
        </div>
    </div>
</div>

<!-- Основной контент -->
<div class="container mx-auto px-4 py-12">
    <div class="mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Левая колонка с формой -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Форма заказа</h2>
                
                <form id="quick-order-form" class="space-y-6">
                    <!-- Контактные данные -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900">Контактные данные</h3>
                        
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ваше имя *</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Телефон *</label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" 
                                   id="email" 
                                   name="email"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                            <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Название организации</label>
                            <input type="text" 
                                   id="company" 
                                   name="company"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>

                    <!-- Информация о кране -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900">Информация о кране</h3>
                        
                        <div>
                            <label for="crane_manufacturer" class="block text-sm font-medium text-gray-700 mb-1">Производитель крана *</label>
                            <select id="crane_manufacturer" 
                                    name="crane_manufacturer" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Выберите производителя</option>
                                <option value="Potain">Potain</option>
                                <option value="Liebherr">Liebherr</option>
                                <option value="Zoomlion">Zoomlion</option>
                                <option value="Comansa">Comansa</option>
                                <option value="Terex">Terex</option>
                            </select>
                        </div>

                        <div>
                            <label for="crane_model" class="block text-sm font-medium text-gray-700 mb-1">Модель крана *</label>
                            <input type="text" 
                                   id="crane_model" 
                                   name="crane_model" 
                                   required
                                   placeholder="Например: MC 85"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>

                    <!-- Дополнительная информация -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Описание необходимых запчастей</label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="4"
                                  placeholder="Укажите какие запчасти вам нужны, или опишите проблему"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-orange-500 text-white py-3 px-4 rounded-md hover:bg-orange-600 transition-colors">
                        Отправить заказ
                    </button>
                </form>
            </div>

            <!-- Правая колонка с дополнительной информацией -->
            <div class="space-y-8">
                <!-- Блок с преимуществами -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Наши преимущества</h2>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Быстрый подбор</h3>
                                <p class="text-gray-600">Наши специалисты оперативно подберут необходимые запчасти для вашего крана</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Оперативная доставка</h3>
                                <p class="text-gray-600">Доставляем запчасти в кратчайшие сроки по всей России</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">Гарантия качества</h3>
                                <p class="text-gray-600">Предоставляем гарантию на все поставляемые запчасти</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Блок с контактами -->
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Нужна консультация?</h2>
                    <p class="text-gray-600 mb-4">Наши специалисты готовы ответить на все ваши вопросы</p>
                    <div class="space-y-2">
                        <a href="tel:<?php echo get_theme_mod('phone_number'); ?>" 
                           class="flex items-center text-lg font-medium text-orange-500 hover:text-orange-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <?php echo get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX'); ?>
                        </a>
                        <div class="text-sm text-gray-600">
                            <?php echo get_theme_mod('work_hours', 'Пн-Пт: 9:00 - 18:00'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?> 