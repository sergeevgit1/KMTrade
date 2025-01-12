<?php
/**
 * Template Name: Быстрый заказ
 */

get_header();
?>

<main>
    <!-- Баннер -->
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
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-8">
                <form id="quick-order-form" class="space-y-6">
                    <!-- Контактные данные -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ваше имя *
                            </label>
                            <input type="text" 
                                   name="customer_name" 
                                   required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Телефон *
                            </label>
                            <input type="tel" 
                                   name="phone" 
                                   required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                    </div>

                    <!-- Информация о кране -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Модель крана
                        </label>
                        <input type="text" 
                               name="crane_model"
                               class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>

                    <!-- Список запчастей -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Необходимые запчасти *
                        </label>
                        <textarea name="parts_list" 
                                  required
                                  rows="4"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"></textarea>
                    </div>

                    <!-- Кнопка отправки -->
                    <div>
                        <button type="submit" 
                                class="w-full md:w-auto px-8 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                            Отправить заявку
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?> 