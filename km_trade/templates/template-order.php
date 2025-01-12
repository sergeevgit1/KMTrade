<?php
/**
 * Template Name: Заказ запчастей
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
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Заказ запчастей</h1>
                <p class="text-xl text-zinc-300">Заполните форму заказа, и мы свяжемся с вами для уточнения деталей</p>
            </div>
        </div>
    </section>

    <!-- Основной контент -->
    <div class="container mx-auto px-4 mb-16">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-8">
                <form id="order-form" class="space-y-6">
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

                    <!-- Email и компания -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <input type="email" 
                                   name="email"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Компания
                            </label>
                            <input type="text" 
                                   name="company"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                    </div>

                    <!-- Информация о кране -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Производитель крана
                            </label>
                            <select name="manufacturer"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                                <option value="">Выберите производителя</option>
                                <option value="Potain">Potain</option>
                                <option value="Liebherr">Liebherr</option>
                                <option value="Zoomlion">Zoomlion</option>
                                <option value="Comansa">Comansa</option>
                                <option value="other">Другой</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Модель крана
                            </label>
                            <input type="text" 
                                   name="crane_model"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                    </div>

                    <!-- Список запчастей -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Список запчастей *
                        </label>
                        <textarea name="parts_list" 
                                  required
                                  rows="4"
                                  placeholder="Укажите наименования или артикулы необходимых запчастей"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"></textarea>
                    </div>

                    <!-- Комментарий -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Дополнительная информация
                        </label>
                        <textarea name="comment" 
                                  rows="3"
                                  placeholder="Укажите дополнительную информацию, если необходимо"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"></textarea>
                    </div>

                    <!-- Кнопка отправки -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="px-8 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                            Отправить заявку
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
