<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Security-Policy" content="frame-ancestors 'self'">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Определение кастомных цветов */
        .bg-custom-primary {
            background-color: #f38e19;
        }
        .bg-custom-primary:hover {
            background-color: #d97d16;
        }
        .text-custom-primary {
            color: #f38e19;
        }
        .text-custom-primary:hover {
            color: #d97d16;
        }
        .from-custom-50 {
            --tw-gradient-from: #fef4e6;
        }
        .to-custom-100 {
            --tw-gradient-to: #fde9cc;
        }

        [x-cloak] { display: none !important; }
        
        .faq-item button:focus {
            outline: 2px solid rgba(249, 115, 22, 0.2);
            outline-offset: -2px;
        }
        
        .faq-item button:focus:not(:focus-visible) {
            outline: none;
        }
        
        /* Стили для анимации FAQ */
        .faq-item {
            transition: all 0.2s ease-in-out;
        }
        
        .faq-item:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .faq-item button svg {
            transition: transform 0.2s ease-in-out;
        }
        
        .faq-item button[aria-expanded="true"] svg {
            transform: rotate(180deg);
        }

        /* Стили для мобильных устройств */
        @media (max-width: 768px) {
            /* Верхняя часть шапки */
            .container .flex {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.5rem;
                padding: 0.5rem;
            }

            /* Логотип */
            .custom-logo {
                max-height: 40px;
                width: auto;
            }

            /* Поиск */
            .flex-1.max-w-3xl {
                order: 3;
                width: 100%;
                padding: 0;
                margin: 0.5rem 0;
            }

            .search-input {
                height: 40px;
                font-size: 14px;
            }

            /* Контакты и кнопка быстрого заказа */
            .flex.items-center.space-x-8 {
                gap: 0.5rem;
            }

            /* Телефон и время работы */
            .text-right {
                text-align: right;
                font-size: 0.875rem;
            }

            .text-lg.font-bold {
                font-size: 1rem;
            }

            .text-sm {
                font-size: 0.75rem;
            }

            /* Кнопка быстрого заказа */
            .bg-primary {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
                border-width: 1px !important;
            }

            /* Нижняя часть шапки */
            .bg-white.border-b .container {
                padding: 0.5rem;
            }

            nav.flex-1.flex.items-center.justify-between {
                gap: 0.5rem;
            }

            /* Кнопка каталога */
            #catalog-button {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }

            #catalog-button svg {
                width: 1.25rem;
                height: 1.25rem;
            }

            /* Мобильное меню */
            #mobile-menu > div {
                max-width: 100%;
                width: 300px;
            }

            #mobile-menu-content {
                padding: 0.5rem;
            }

            #mobile-menu-content a {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }

            /* Мега-меню на мобильных */
            #mega-menu {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                overflow-y: auto;
                background: white;
                z-index: 50;
            }

            #mega-menu .container {
                padding: 1rem;
            }

            #mega-menu .grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            /* Компактное отображение категорий */
            .mega-menu-category {
                padding: 0.5rem;
                font-size: 0.875rem;
            }

            /* Компактное отображение производителей */
            .mega-menu-manufacturer {
                padding: 0.5rem;
                font-size: 0.875rem;
            }

            .manufacturer-country {
                font-size: 0.75rem;
                padding: 0.125rem 0.5rem;
            }

            /* Кнопка заказа на мобильных */
            .order-button {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }

            .order-button svg {
                width: 1.25rem;
                height: 1.25rem;
            }

            /* Мобильная кнопка меню */
            #mobile-menu-button {
                padding: 0.5rem;
                margin-left: 0.5rem;
            }

            #mobile-menu-button svg {
                width: 1.5rem;
                height: 1.5rem;
            }
        }

        /* Стили для очень маленьких экранов */
        @media (max-width: 360px) {
            /* Скрываем время работы на самых маленьких экранах */
            .text-sm.text-gray-600 {
                display: none;
            }

            /* Уменьшаем размер телефона */
            .text-lg.font-bold {
                font-size: 0.875rem;
            }

            /* Минимизируем отступы */
            .container {
                padding: 0.25rem;
            }
        }

        /* Стили для планшетов */
        @media (min-width: 769px) and (max-width: 1024px) {
            /* Контейнер */
            .container {
                padding: 0 1rem;
            }

            /* Поиск */
            .flex-1.max-w-3xl {
                padding: 0 1rem;
            }

            /* Мега-меню */
            #mega-menu .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Стили для ноутбуков */
        @media (min-width: 1025px) and (max-width: 1366px) {
            /* Контейнер */
            .container {
                max-width: 1200px;
                padding: 0 2rem;
            }

            /* Логотип */
            .custom-logo {
                max-height: 50px;
            }

            /* Поиск */
            .flex-1.max-w-3xl {
                max-width: 500px;
                margin: 0 2rem;
            }

            /* Контакты */
            .text-lg.font-bold {
                font-size: 1.125rem;
            }

            /* Кнопки */
            .bg-primary,
            #catalog-button,
            .order-button {
                padding: 0.75rem 1.5rem;
            }

            /* Мега-меню */
            #mega-menu .container {
                padding: 2rem;
            }

            #mega-menu .grid {
                gap: 2rem;
            }
        }

        /* Общие стили для всех устройств больше мобильных */
        @media (min-width: 769px) {
            /* Верхняя часть шапки */
            .bg-white.border-b {
                padding: 1rem 0;
            }

            /* Навигация */
            nav.flex-1.flex.items-center.justify-between {
                position: relative;
            }

            /* Центральное меню */
            .flex-1.flex.items-center.justify-center.px-8 {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                width: auto;
            }

            /* Контейнер меню */
            .mega-menu-container {
                display: flex;
                justify-content: center;
                width: fit-content;
            }

            /* Обновляем HTML структуру меню */
            #mega-menu-wrap-primary #mega-menu-primary {
                display: inline-flex !important;
                justify-content: center !important;
                align-items: center !important;
                gap: 1rem !important;
                background-color: #f38e19!important;
                padding: 0.75rem 1.5rem !important;
                border-radius: 0.5rem !important;
                width: fit-content !important;
            }

            /* Обновляем стили для кнопки заказа */
            .order-button {
                display: flex !important;
                align-items: center !important;
                gap: 0.5rem !important;
                padding: 0.75rem 1.5rem !important;
                color: #374151 !important;
                border: 1px solid #e5e7eb !important;
                border-radius: 0.5rem !important;
                background-color: transparent !important;
            }

            .order-button:hover {
                background-color: #f3f4f6 !important;
                color: #f38e19 !important;
            }

            /* Обновляем стили для иконок в кнопках */
            #catalog-button svg,
            .order-button svg {
                stroke: currentColor;
            }
        }

        /* Стили для мобильного меню */
        .mobile-menu-active {
            overflow: hidden;
        }

        .mobile-menu-active #mobile-menu {
            display: block;
        }

        .mobile-menu-active #mobile-menu > div {
            transform: translateX(0);
        }

        #mobile-menu-content {
            padding: 1rem;
        }

        #mobile-menu-content a {
            display: block;
            padding: 0.75rem;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }

        #mobile-menu-content a:hover {
            background-color: #f3f4f6;
            color: #f38e19;
        }

        /* Верхняя часть шапки */
        .bg-white.border-b {
            background-color: #f38e19 !important;
            border-bottom: none;
        }

        /* Обновляем цвета текста для лучшей читаемости на оранжевом фоне */
        .text-gray-800 {
            color: white !important;
        }

        .text-gray-600 {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* Стили для поиска на оранжевом фоне */
        .search-input {
            background-color: rgba(255, 255, 255, 0.9);
            border-color: transparent !important;
        }

        .search-input:focus {
            background-color: white;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.2);
        }

        /* Кнопка быстрого заказа на оранжевом фоне */
        .bg-primary {
            background-color: #374151 !important;
            color: white !important;
            border: 2px solid white !important;
        }

        .bg-primary:hover {
            background-color: #1f2937 !important;
            border-color: rgba(255, 255, 255, 0.9) !important;
        }

        /* Нижняя часть шапки */
        .bg-white.border-b.border-gray-200 {
            background-color: white !important;
            border-bottom: 1px solid rgba(243, 142, 25, 0.1);
        }

        /* Обновляем стили для мобильных устройств */
        @media (max-width: 768px) {
            .bg-white.border-b {
                padding: 0.5rem 0;
            }
            
            .search-input {
                background-color: rgba(255, 255, 255, 0.95);
            }
        }

        /* Стили для подвала */
        footer {
            background-color: #f38e19 !important;
            color: white;
        }

        footer .text-gray-600,
        footer .text-gray-500 {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        footer .text-gray-900,
        footer .text-gray-800 {
            color: white !important;
        }

        footer a:not(.bg-primary) {
            color: white !important;
        }

        footer a:hover:not(.bg-primary) {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* Стили для разделителей в подвале */
        footer .border-t,
        footer .border-b {
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        /* Стили для иконок в подвале */
        footer svg {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* Стили для кнопок в подвале */
        footer .bg-gray-100 {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        footer .bg-gray-100:hover {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

        /* Адаптивные стили для подвала */
        @media (max-width: 768px) {
            footer {
                padding: 2rem 1rem;
            }
            
            footer .container {
                padding: 0;
            }
        }
    </style>
    <script>console.warn = () => {};</script>
    <?php wp_head(); ?>
    <style>
    /* Стили для мега-меню */
    .mega-menu-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.3);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease-in-out;
        z-index: 40;
    }

    /* Увеличиваем область наведения для кнопки каталога */
    .catalog-trigger {
        position: relative;
        z-index: 52;
    }

    #catalog-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        color: #374151;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        text-decoration: none;
        background-color: transparent;
    }

    #catalog-button:hover {
        background-color: #f3f4f6;
        color: #f97316;
    }

    .catalog-trigger a {
        pointer-events: auto;
    }

    #mega-menu {
        position: absolute;
        left: 0;
        right: 0;
        top: 100%;
        width: 100%;
        background: white;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        border-top: 1px solid #e5e7eb;
        transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
        opacity: 0;
        visibility: hidden;
        z-index: 51;
    }

    .catalog-active #mega-menu {
        opacity: 1;
        visibility: visible;
    }

    .catalog-active .mega-menu-overlay {
        opacity: 1;
        visibility: visible;
    }

    /* Стили для активного состояния */
    .catalog-active #catalog-button {
        background-color: #c2410c !important;
        color: white !important;
    }

    /* Стили для скроллбара */
    .mega-menu-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
    }

    .mega-menu-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .mega-menu-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .mega-menu-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    /* Стили для мега-меню */
    #mega-menu a {
        color: #374151;
        transition: color 0.2s ease-in-out;
    }

    #mega-menu a:hover {
        color: #f97316;
    }

    /* Стили для основного меню */
    .mega-menu-container ul {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        background-color: #ea580c;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        width: fit-content;
        flex-wrap: nowrap;
        white-space: nowrap;
    }

    .mega-menu-container ul li a {
        color: white !important;
        font-weight: 500;
        font-size: 1.125rem;
        transition: color 0.2s ease-in-out;
        position: relative;
        padding: 0 0.5rem !important;
        white-space: nowrap;
    }

    /* Стили для ховера и активного состояния пунктов меню */
    .mega-menu-container ul li a:hover,
    .mega-menu-container ul li.current-menu-item a {
        color: rgba(255, 255, 255, 0.8) !important; /* Немного прозрачный белый при наведении */
    }

    /* Стили для активного состояния каталога */
    .catalog-active #catalog-button {
        background-color: #c2410c !important;
    }

    /* Стили для основного меню с повышенной специфичностью */
    #mega-menu-wrap-primary #mega-menu-primary {
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 1rem !important;
        background-color: #ffffff !important;
        padding: 0.75rem 1.5rem !important;
        border-radius: 0.5rem !important;
        width: fit-content !important;
        flex-wrap: nowrap !important;
        white-space: nowrap !important;
    }

    #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link {
        color: white !important;
        font-weight: 500 !important;
        font-size: 1.125rem !important;
        background: transparent !important;
        transition: opacity 0.2s ease-in-out !important;
        position: relative !important;
        padding: 0 0.5rem !important;
        line-height: normal !important;
        height: auto !important;
        white-space: nowrap !important;
    }

    #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link:hover,
    #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link {
        color: rgba(255, 255, 255, 0.8) !important;
        background: transparent !important;
    }

    /* Выравнивание меню по центру */
    #mega-menu-wrap-primary {
        width: 100%;
    }

    #mega-menu-wrap-primary #mega-menu-primary {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 1rem !important;
    }

    /* Сброс стилей для мобильного меню */
    .mega-menu-toggle {
        display: none !important;
    }

    /* Анимация для категорий */
    #mega-menu .group {
        transition: all 0.2s ease-in-out;
    }

    #mega-menu .group:hover {
        transform: translateY(-2px);
    }

    /* Стили для счетчика товаров */
    .category-count {
        font-size: 0.875rem;
        color: #6B7280;
        transition: color 0.2s;
    }

    .group:hover .category-count {
        color: #F97316;
    }

    /* Стили для бейджа производителя */
    .manufacturer-badge {
        display: inline-block;
        padding: 0.125rem 0.5rem;
        font-size: 0.75rem;
        background-color: #FFF7ED;
        color: #EA580C;
        border-radius: 9999px;
        transition: all 0.2s;
    }

    .group:hover .manufacturer-badge {
        background-color: #EA580C;
        color: white;
    }

    /* Обновленные стили для содержимого мега-меню */
    .mega-menu-category {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
    }

    .mega-menu-category:hover {
        background-color: #fff7ed;
    }

    .mega-menu-category span {
        transition: color 0.2s ease-in-out;
    }

    .mega-menu-category:hover span:first-child {
        color: #f97316;
    }

    .mega-menu-category .count {
        font-size: 0.875rem;
        color: #9ca3af;
    }

    .mega-menu-category:hover .count {
        color: #f97316;
    }

    .mega-menu-manufacturer {
        display: flex;
        align-items: center;
        padding: 0.75rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
    }

    .mega-menu-manufacturer:hover {
        background-color: #fff7ed;
    }

    .manufacturer-country {
        font-size: 0.75rem;
        padding: 0.25rem 0.75rem;
        background-color: #f3f4f6;
        color: #6b7280;
        border-radius: 9999px;
        margin-left: 0.75rem;
        transition: all 0.2s ease-in-out;
    }

    .mega-menu-manufacturer:hover .manufacturer-country {
        background-color: #ffedd5;
        color: #f97316;
    }

    /* Обновим стил для кнопки быстрого заказа */
    .bg-primary {
        background-color: #f38e19!important;
    }

    .hover\:bg-primary-hover:hover {
        background-color: #c2410c !important;
    }

    /* Обновим стил для кнопки заказа */
    .order-button {
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        padding: 0.75rem 1.5rem !important;
        color: #374151 !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 0.5rem !important;
        background-color: transparent !important;
    }

    .order-button:hover {
        background-color: #f3f4f6 !important;
        color: #f97316 !important;
    }

    /* Обновляем стили контейнера центрального меню */
    nav.flex-1.flex.items-center.justify-between {
        position: relative;
    }

    /* Стили для центрального меню */
    .flex-1.flex.items-center.justify-center.px-8 {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: auto;
    }

    /* Обновляем стили для контейнера меню */
    .mega-menu-container {
        display: flex;
        justify-content: center;
        width: fit-content;
    }

    /* Обновляем HTML структуру меню */
    #mega-menu-wrap-primary #mega-menu-primary {
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 1rem !important;
        background-color: #f38e19!important;
        padding: 0.75rem 1.5rem !important;
        border-radius: 0.5rem !important;
        width: fit-content !important;
    }

    /* Обновляем стили для кнопки заказа */
    .order-button {
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        padding: 0.75rem 1.5rem !important;
        color: #374151 !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 0.5rem !important;
        background-color: transparent !important;
    }

    .order-button:hover {
        background-color: #f3f4f6 !important;
        color: #f97316 !important;
    }

    /* Обновляем стили для иконок в кнопках */
    #catalog-button svg,
    .order-button svg {
        stroke: currentColor;
    }

    /* Общие стили для планшетов и ноутбуков */
    @media (min-width: 769px) {
        /* Контейнер центрального меню */
        .mega-menu-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        /* Основное меню */
        #mega-menu-wrap-primary {
            width: 100%;
        }

        #mega-menu-wrap-primary #mega-menu-primary {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            gap: 1rem !important;
            background-color: #f38e19!important;
            padding: 0.75rem 1.5rem !important;
            border-radius: 0.5rem !important;
            width: fit-content !important;
            flex-wrap: nowrap !important;
            white-space: nowrap !important;
        }

        #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link {
            color: white !important;
            font-weight: 500 !important;
            font-size: 1.125rem !important;
            background: transparent !important;
            transition: opacity 0.2s ease-in-out !important;
            position: relative !important;
            padding: 0 0.5rem !important;
            line-height: normal !important;
            height: auto !important;
            white-space: nowrap !important;
        }

        #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link:hover,
        #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item.mega-current-menu-item > a.mega-menu-link {
            color: rgba(255, 255, 255, 0.8) !important;
            background: transparent !important;
        }

        /* Выравнивание меню по центру */
        #mega-menu-wrap-primary {
            width: 100%;
        }

        #mega-menu-wrap-primary #mega-menu-primary {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            gap: 1rem !important;
        }
    }

    /* Специфичные стили для планшетов */
    @media (min-width: 769px) and (max-width: 1024px) {
        #mega-menu-wrap-primary #mega-menu-primary {
            padding: 0.5rem 1rem !important;
        }

        #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link {
            font-size: 1rem !important;
            padding: 0 0.25rem !important;
        }
    }

    /* Специфичные стили для ноутбуков */
    @media (min-width: 1025px) and (max-width: 1366px) {
        #mega-menu-wrap-primary #mega-menu-primary {
            padding: 0.75rem 2rem !important;
        }

        #mega-menu-wrap-primary #mega-menu-primary > li.mega-menu-item > a.mega-menu-link {
            font-size: 1.125rem !important;
            padding: 0 0.75rem !important;
        }
    }

    /* Сброс стилей для мобильного меню */
    .mega-menu-toggle {
        display: none !important;
    }
    </style>
</head>
<body <?php body_class('bg-gray-50'); ?>>
<?php wp_body_open(); ?>

<!-- Шапка сайта -->
<header>
    <!-- Top Header -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Логотип -->
                <div class="flex items-center">
                    <?php 
                    if(has_custom_logo()):
                        the_custom_logo();
                    else:
                    ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-bold text-gray-800">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Поиск -->
                <div class="flex-1 max-w-3xl mx-auto px-16">
                    <div class="relative">
                        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <input
                                type="search"
                                name="s"
                                class="search-input w-full pl-6 pr-12 py-2 rounded-full border border-gray-300 focus:outline-none focus:border-orange-500"
                                placeholder="Поиск запчастей..." />
                            <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Контакты и кнопка -->
                <div class="flex items-center space-x-8">
                    <div class="text-right">
                        <div class="text-lg font-bold text-gray-800">
                            <?php echo get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX'); ?>
                        </div>
                        <div class="text-sm text-gray-600">
                            <?php echo get_theme_mod('work_hours', 'Пн-Пт: 9:00 - 18:00'); ?>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(home_url('/quick-order/')); ?>" 
                       class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-hover transition-colors inline-block">
                        Быстрый заказ
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Основное меню с каталогом и заказом -->
                <nav class="flex-1 flex items-center justify-between relative">
                    <!-- Каталог (левый край) -->
                    <div class="catalog-trigger">
                        <a href="<?php echo esc_url(home_url('/catalog/')); ?>"
                                id="catalog-button" 
                                class="flex items-center space-x-2 bg-custom-primary text-white px-6 py-3 rounded-lg hover:bg-custom-primary transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <span>Каталог</span>
                        </a>
                    </div>

                    <!-- Мега-меню каталога -->
                    <div id="mega-menu">
                        <div class="container mx-auto px-4">
                            <div class="grid grid-cols-3 gap-8 py-8">
                                <!-- Колонка 1: Категории -->
                                <div class="space-y-6">
                                    <h3 class="text-lg font-bold text-gray-900">Категории</h3>
                                    <div class="space-y-4">
                                        <?php
                                        $categories = get_terms([
                                            'taxonomy' => 'product_cat',
                                            'hide_empty' => false,
                                            'parent' => 0,
                                            'number' => 8
                                        ]);
                                        
                                        foreach ($categories as $category) :
                                        ?>
                                        <a href="<?php echo get_term_link($category); ?>" 
                                           class="mega-menu-category">
                                            <span class="text-gray-700"><?php echo $category->name; ?></span>
                                            <span class="count"><?php echo $category->count; ?></span>
                                        </a>
                                        <?php endforeach; ?>
                                        
                                        <a href="<?php echo esc_url(home_url('/catalog/')); ?>" 
                                           class="inline-flex items-center text-custom-primary hover:text-custom-primary">
                                            <span>Все категории</span>
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <!-- Колонка 2: Производители -->
                                <div class="space-y-6">
                                    <h3 class="text-lg font-bold text-gray-900">Производители</h3>
                                    <div class="space-y-4">
                                        <?php
                                        $manufacturers = [
                                            'Potain' => 'Франция',
                                            'Liebherr' => 'Германия',
                                            'Zoomlion' => 'Китай',
                                            'Comansa' => 'Испания',
                                            'Terex' => 'США'
                                        ];
                                        
                                        foreach ($manufacturers as $name => $country) :
                                        ?>
                                        <a href="<?php echo home_url("/manufacturer/{$name}"); ?>" 
                                           class="mega-menu-manufacturer">
                                            <span class="text-gray-700"><?php echo $name; ?></span>
                                            <span class="manufacturer-country"><?php echo $country; ?></span>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Колонка 3: Помощь -->
                                <div class="bg-gradient-to-br from-custom-50 to-custom-100 rounded-lg p-6 space-y-4">
                                    <h3 class="text-lg font-bold text-gray-900">Не нашли нужную деталь?</h3>
                                    <p class="text-gray-600">Наш специалист поможет подобрать необходимые запчасти для вашей техники</p>
                                    <a href="<?php echo esc_url(home_url('/quick-order/')); ?>" 
                                       class="w-full bg-custom-primary text-white py-2.5 px-4 rounded-lg hover:bg-custom-primary transition-colors inline-block text-center">
                                        Быстрый заказ
                                    </a>
                                    <div class="text-sm text-gray-500">
                                        Или позвоните нам:
                                        <a href="tel:<?php echo get_theme_mod('phone_number'); ?>" 
                                           class="block text-custom-primary font-medium hover:text-custom-primary mt-1">
                                            <?php echo get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Центральное меню -->
                    <div class="flex-1 flex items-center justify-center px-8">
                        <?php 
                        if (function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled('primary')) {
                            wp_nav_menu([
                                'theme_location' => 'primary',
                                'menu_class' => 'flex items-center space-x-8',
                                'container_class' => 'mega-menu-container'
                            ]);
                        }
                        ?>
                    </div>

                    <!-- Мой заказ (правый край) -->
                    <a href="<?php echo esc_url(home_url('/wp/my-order/')); ?>" 
                       class="order-button hidden md:flex items-center space-x-2 bg-custom-primary text-white px-6 py-3 rounded-lg hover:bg-custom-primary transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Мой заказ</span>
                    </a>
                </nav>

                <!-- Кнопка мобильного меню -->
                <button class="md:hidden" id="mobile-menu-button" aria-label="Открыть меню">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Мобильное меню -->
    <div id="mobile-menu" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="fixed inset-y-0 right-0 max-w-xs w-full bg-white shadow-xl transform transition-transform duration-300 translate-x-full">
            <div class="flex items-center justify-between p-4 border-b">
                <h2 class="text-xl font-bold text-gray-800">Мню</h2>
                <button id="close-mobile-menu" class="p-2 rounded-lg hover:bg-gray-100" aria-label="Закрыть меню">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-4 py-6">
                <div class="space-y-4" id="mobile-menu-content"></div>
            </div>
        </div>
    </div>
</header>
<div class="mega-menu-overlay"></div> 

<script>
document.addEventListener('DOMContentLoaded', function() {
    const catalogButton = document.getElementById('catalog-button');
    const megaMenu = document.getElementById('mega-menu');
    let isOverButton = false;
    let isOverMenu = false;
    let timeoutId;

    function showMenu() {
        clearTimeout(timeoutId);
        if (!document.body.classList.contains('catalog-active')) {
            document.body.classList.add('catalog-active');
        }
    }

    function hideMenu() {
        if (!isOverButton && !isOverMenu) {
            timeoutId = setTimeout(() => {
                document.body.classList.remove('catalog-active');
            }, 150);
        }
    }

    // Обработчики для кнопки
    catalogButton.addEventListener('mouseenter', () => {
        isOverButton = true;
        showMenu();
    });

    catalogButton.addEventListener('mouseleave', () => {
        isOverButton = false;
        hideMenu();
    });

    // Обработчики для мега-меню
    megaMenu.addEventListener('mouseenter', () => {
        isOverMenu = true;
        showMenu();
    });

    megaMenu.addEventListener('mouseleave', () => {
        isOverMenu = false;
        hideMenu();
    });

    // Добавим функционал мобильного меню
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const closeMobileMenu = document.getElementById('close-mobile-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuContent = document.getElementById('mobile-menu-content');

    // Клонируем основное меню для мобильной версии
    const mainMenu = document.querySelector('.mega-menu-container');
    if (mainMenu) {
        const mobileMenuItems = mainMenu.cloneNode(true);
        mobileMenuContent.appendChild(mobileMenuItems);
    }

    function toggleMobileMenu() {
        document.body.classList.toggle('mobile-menu-active');
    }

    mobileMenuButton.addEventListener('click', toggleMobileMenu);
    closeMobileMenu.addEventListener('click', toggleMobileMenu);

    // Закрытие при клике вне меню
    mobileMenu.addEventListener('click', (e) => {
        if (e.target === mobileMenu) {
            toggleMobileMenu();
        }
    });

    // Обработка ресайза окна
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768 && document.body.classList.contains('mobile-menu-active')) {
            document.body.classList.remove('mobile-menu-active');
        }
    });
});
</script> 

<div class="quick-order-modal" style="display: none;">
    <div class="quick-order-content">
        <span class="close-modal">&times;</span>
        <h3>Быстрый заказ</h3>
        <form id="quick-order-form">
            <input type="text" name="name" placeholder="Ваше имя" required>
            <input type="tel" name="phone" placeholder="Ваш телефон" required>
            <input type="email" name="email" placeholder="Ва�� email">
            <textarea name="message" placeholder="Сообщение"></textarea>
            <button type="submit">Отправить заказ</button>
        </form>
    </div>
</div>
</body> 