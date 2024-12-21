<?php
/*
Template Name: Мой заказ
*/

get_header();
?>

<div class="container mx-auto px-4 py-8">
    <!-- Хлебные крошки -->
    <div class="mb-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo esc_url(home_url('/wp/')); ?>" class="text-gray-700 hover:text-primary">
                        Главная
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500">Мой заказ</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Мой заказ</h1>

        <!-- Список выбранных запчастей -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Выбранные запчасти</h2>
            <div id="selected-parts" class="space-y-4">
                <!-- Здесь будут отображаться выбранные запчасти -->
            </div>
            <div id="empty-cart" class="text-gray-500 text-center py-8 hidden">
                Список заказа пуст
            </div>
        </div>

        <!-- Форма заказа -->
        <form id="order-form" class="space-y-6">
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
                        Организация
                    </label>
                    <input type="text" 
                           name="company" 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Комментарий к заказу
                </label>
                <textarea name="comment" 
                          rows="4" 
                          class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"></textarea>
            </div>

            <div class="flex justify-between items-center pt-6 border-t">
                <div>
                    <p class="text-sm text-gray-500">* Обязательные поля</p>
                </div>
                <button type="submit" 
                        class="px-8 py-3 bg-primary text-white rounded-lg font-medium hover:bg-primary-hover transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                        id="submit-order">
                    Отправить заказ
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Проверяем параметр order_part в URL
    const urlParams = new URLSearchParams(window.location.search);
    const orderPart = urlParams.get('order_part');
    
    if (orderPart) {
        // Если есть параметр, добавляем запчасть в список
        const selectedParts = JSON.parse(localStorage.getItem('selectedParts') || '[]');
        if (!selectedParts.includes(decodeURIComponent(orderPart))) {
            selectedParts.push(decodeURIComponent(orderPart));
            localStorage.setItem('selectedParts', JSON.stringify(selectedParts));
        }
        // Очищаем URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    
    // Функция для отображения списка выбранных запчастей
    function displaySelectedParts() {
        const selectedParts = JSON.parse(localStorage.getItem('selectedParts') || '[]');
        const container = document.getElementById('selected-parts');
        const emptyCart = document.getElementById('empty-cart');
        const submitButton = document.getElementById('submit-order');

        container.innerHTML = '';

        if (selectedParts.length === 0) {
            emptyCart.classList.remove('hidden');
            submitButton.disabled = true;
            return;
        }

        emptyCart.classList.add('hidden');
        submitButton.disabled = false;

        selectedParts.forEach((part, index) => {
            const partElement = document.createElement('div');
            partElement.className = 'flex items-center justify-between p-4 bg-gray-50 rounded-lg';
            partElement.innerHTML = `
                <div class="flex-1">
                    <p class="font-medium text-gray-900">
                        ${part.name} 
                        <span class="ml-2 text-sm text-gray-500">
                            (${part.quantity} шт.)
                        </span>
                    </p>
                </div>
                <button onclick="removePart(${index})" 
                        class="ml-4 text-gray-400 hover:text-red-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;
            container.appendChild(partElement);
        });
    }

    // Функция удаления запчасти из списка
    window.removePart = function(index) {
        const selectedParts = JSON.parse(localStorage.getItem('selectedParts') || '[]');
        selectedParts.splice(index, 1);
        localStorage.setItem('selectedParts', JSON.stringify(selectedParts));
        displaySelectedParts();
    }

    // Обработка отправки формы
    document.getElementById('order-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const selectedParts = JSON.parse(localStorage.getItem('selectedParts') || '[]');
        
        formData.append('action', 'submit_parts_order');
        formData.append('parts', JSON.stringify(selectedParts));

        // Отправка заказа через AJAX
        fetch(ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Очищаем список заказа
                localStorage.removeItem('selectedParts');
                displaySelectedParts();
                
                // Показываем сообщение об успехе
                alert('Ваш заказ успешно отправлен!');
                
                // Очищаем форму
                this.reset();
            } else {
                alert('Произошла ошибка при отправке заказа. Пожалуйста, попробуйте еще раз.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Произошла ошибка при отправке заказа. Пожалуйста, попробуйте еще раз.');
        });
    });

    // Инициализация отображения списка
    displaySelectedParts();
});
</script>

<?php get_footer(); ?> 