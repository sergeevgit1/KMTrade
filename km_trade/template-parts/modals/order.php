<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div id="order-modal" class="fixed inset-0 bg-black/50 z-50 hidden">
    <div class="min-h-screen px-4 text-center">
        <!-- Вертикальное центрирование -->
        <div class="inline-block h-screen align-middle"></div>​
        
        <div class="inline-block w-full max-w-2xl p-6 my-8 text-left align-middle bg-white rounded-lg shadow-xl transform transition-all">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-2xl font-bold text-gray-900">
                    Быстрый заказ
                </h3>
                <button type="button" 
                        data-close-modal
                        class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

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

                <!-- Список запчастей -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Список запчастей *
                    </label>
                    <textarea id="parts-list" 
                              name="parts_list" 
                              required
                              rows="4"
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