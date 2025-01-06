<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="bg-white">
    <!-- Верхний уровень: Контакты и доп. информация -->
    <div class="bg-gray-50 py-2">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center text-sm">
                <!-- Левая часть -->
                <div class="flex items-center space-x-6">
                    <span class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-1 text-[#f38e19]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <?php echo get_theme_mod('contact_address', 'г. Москва, ул. Примерная, 123'); ?>
                    </span>
                    <span class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-1 text-[#f38e19]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <?php echo get_theme_mod('work_hours', 'Пн-Пт: 9:00-18:00'); ?>
                    </span>
                </div>

                <!-- Правая часть -->
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-gray-600 hover:text-gray-900">О компании</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Доставка</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Оплата</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Контакты</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Средний уровень: логотип, поиск и контакты -->
    <div class="py-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between gap-8">
                <!-- Логотип -->
                <div class="flex items-center gap-4">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-4">
                    <div class="relative">
                        <?php 
                        $custom_logo_id = get_theme_mod('custom_logo');
                        if ($custom_logo_id) {
                            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                            ?>
                            <img src="<?php echo esc_url($logo[0]); ?>" 
                                 alt="<?php echo get_bloginfo('name'); ?> логотип"
                                 class="w-auto h-[40px] object-contain">
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/test_view/logo.svg" 
                                 alt="<?php echo get_bloginfo('name'); ?> логотип"
                                 class="w-auto h-[40px] object-contain">
                        <?php } ?>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 hover:text-gray-700 transition-colors">
                            <span class="text-[#f38e19]">КМ</span>-Трейд
                        </h1>
                        <p class="text-sm text-gray-500">Торговая компания</p>
                    </div>
                    </a>
                </div>

                <!-- Поиск -->
                <div class="flex-1 max-w-3xl">
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative">
                        <input type="search" name="s" 
                               class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#f38e19]" 
                               placeholder="Поиск по каталогу запчастей...">
                        <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Контакты -->
                <div class="flex items-center space-x-8">
                    <div class="text-right">
                        <a href="tel:<?php echo get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX'); ?>" 
                           class="text-lg font-bold text-gray-900">
                            <?php echo get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX'); ?>
                        </a>
                        <div class="text-sm text-gray-500">
                            <?php echo get_theme_mod('work_hours', 'Пн-Пт: 9:00-18:00'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Нижний уровень: навигация по каталогу запчастей -->
    <div class="container mx-auto px-4">
        <div class="bg-[#f38e19] rounded-lg">
            <div class="flex items-stretch">
                <!-- Каталог запчастей -->
                <div class="relative">
                    <a href="#"
                       class="flex h-full items-center gap-2 bg-[#e07d08] text-white px-6 py-3.5 hover:bg-[#d17207] transition-colors rounded-l-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <span class="font-medium whitespace-nowrap">КАТАЛОГ</span>
                    </a>
                </div>

                <!-- Основная навигация -->
                <nav class="flex flex-1">
                    <div class="flex items-center justify-between w-full">
                        <!-- Левая группа -->
                        <div class="flex items-center">
                            <a href="#" class="group relative px-5 py-3.5 text-white hover:bg-[#e07d08] transition-colors">
                                <span class="font-medium whitespace-nowrap text-sm uppercase">
                                    Механизмы подъема
                                </span>
                            </a>
                            <a href="#" class="group relative px-5 py-3.5 text-white hover:bg-[#e07d08] transition-colors">
                                <span class="font-medium whitespace-nowrap text-sm uppercase">
                                    Электрооборудование
                                </span>
                            </a>
                            <a href="#" class="group relative px-5 py-3.5 text-white hover:bg-[#e07d08] transition-colors">
                                <span class="font-medium whitespace-nowrap text-sm uppercase">
                                    Тормозная система
                                </span>
                            </a>
                            <a href="#" class="group relative px-5 py-3.5 text-white hover:bg-[#e07d08] transition-colors">
                                <span class="font-medium whitespace-nowrap text-sm uppercase">
                                    Кабины и пульты
                                </span>
                            </a>
                            <a href="#" class="group relative px-5 py-3.5 text-white hover:bg-[#e07d08] transition-colors">
                                <span class="font-medium whitespace-nowrap text-sm uppercase">
                                    Металлоконструкции
                                </span>
                            </a>
                        </div>

                        <!-- Корзина -->
                        <div class="flex items-center gap-4">
                            <a href="#" class="inline-flex items-center px-6 py-2 my-2 bg-white text-[#f38e19] rounded-lg hover:bg-gray-50 transition-colors">
                                <span class="font-medium whitespace-nowrap text-sm uppercase">
                                    Быстрый заказ
                                </span>
                            </a>
                            <a href="#"
                               class="flex items-center px-5 py-3.5 text-white hover:bg-[#e07d08] transition-colors rounded-r-lg bg-[#e07d08]/20">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
</body> 