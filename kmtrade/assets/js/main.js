/**
 * Основной JavaScript файл темы
 * 
 * Содержит функционал:
 * - Переключение темной/светлой темы
 * - Обработка тестового режима 404
 * - Отслеживание системных настроек темы
 * 
 * @package KMTrade
 * @since 1.0.0
 */
document.addEventListener('DOMContentLoaded', function() {
    // Обработчик для тестирования 404
    const logoLink = document.querySelector('.logo-link[data-test-404="true"]');
    if (logoLink) {
        logoLink.addEventListener('click', function(e) {
            // Проверяем, зажата ли клавиша Alt при клике
            if (e.altKey) {
                e.preventDefault();
                // Перенаправляем на несуществующий URL для вызова 404
                window.location.href = '/page-not-found-test';
            }
        });
    }

    // Функция для установки темы
    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
    }

    // Функция для переключения темы
    function toggleTheme() {
        const currentTheme = localStorage.getItem('theme') || 'light';
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        setTheme(newTheme);
    }

    // Инициализация темы
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        setTheme(savedTheme);
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        setTheme('dark');
    }

    // Обработчик клика по кнопке переключения темы
    const themeToggle = document.querySelector('.theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', toggleTheme);
    }

    // Следим за системными настройками
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        const newTheme = e.matches ? 'dark' : 'light';
        setTheme(newTheme);
    });
}); 