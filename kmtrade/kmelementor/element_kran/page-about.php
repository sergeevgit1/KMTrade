<?php
/*
Template Name: О компании
*/

get_header();
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<style>
html {
    scroll-behavior: smooth;
}

.projectsSwiper {
    position: relative;
    padding: 0 50px;
}

.projectsSwiper .swiper-slide {
    height: auto;
}

.projects-button-prev,
.projects-button-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 40px;
    height: 40px;
    border: 1px solid #e5e7eb;
    border-radius: 50%;
    background: white;
    color: #9ca3af;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}

.projects-button-prev:hover,
.projects-button-next:hover {
    color: var(--color-primary);
    border-color: var(--color-primary);
}

.projects-button-prev {
    left: 0;
}

.projects-button-next {
    right: 0;
}

.projectsSwiper .swiper-slide > div {
    box-shadow: none;
    border: 1px solid #e5e7eb;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.projectsSwiper', {
        slidesPerView: 1,
        spaceBetween: 32,
        navigation: {
            nextEl: '.projects-button-next',
            prevEl: '.projects-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            }
        }
    });
});
</script>

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
                        <span class="text-gray-500">О компании</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Hero секция -->
    <section class="relative mb-16 bg-[#080808] rounded-2xl overflow-hidden">
        <div class="absolute inset-0">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about/hero-bg.jpg" 
                 alt="О компании" 
                 class="w-full h-full object-cover opacity-50">
        </div>
        <div class="relative px-4 py-20">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Поставляем запчасти для башенных кранов с 2010 года
                </h1>
                <p class="text-xl text-white/90 mb-8">
                    Мы специализируемся на поставках оригинальных запчастей и комплектующих для башенных кранов ведущих мировых производителей
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#contacts" 
                       class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Связаться с нами
                    </a>
                    <a href="/wp/parts/" 
                       class="inline-flex items-center px-6 py-3 bg-white text-gray-900 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                        Перейти в каталог
                    </a>
                </div>
                <!-- Статистика -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-16">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">13+</div>
                        <div class="text-white/80">лет на рынке</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">1000+</div>
                        <div class="text-white/80">наименований запчастей</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">500+</div>
                        <div class="text-white/80">довольных клиентов</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white mb-2">24/7</div>
                        <div class="text-white/80">техподдержка</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- О компании -->
    <section class="mb-16">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2 p-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">О нашей компании</h1>
                    <div class="prose max-w-none">
                        <p class="mb-4">Компания КМ-Трейд специализируется на поставках запасных частей для башенных кранов ведущих мировых производителей. Мы работаем на рынке с 2010 года и за это время накопили богатый опыт в подборе и поставке запчастей.</p>
                        <p class="mb-4">Наша главная цель - обеспечить бесперебойную работу башенных кранов наших клиентов, предоставляя качественные запчасти и профессиональную консультацию по их подбору.</p>
                        <p>Мы поставляем оригинальные запчасти для кранов Potain, Liebherr, Zoomlion и Comansa, а также предлагем качественные аналоги от проверенных производителей.</p>
                    </div>
                </div>
                <div class="md:w-1/2 bg-gray-100">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about/company.jpg" 
                         alt="О компании" 
                         class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Наши преимущества -->
    <section class="mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Наши преимущества</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Качество</h3>
                <p class="text-gray-600">Только оригинальные запчасти и качественные аналоги от проверенных производителей</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Оперативность</h3>
                <p class="text-gray-600">Быстрая обработка заказов и отправка в день оплаты при наличии на складе</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Экспертиза</h3>
                <p class="text-gray-600">Профессиональная консультация по подбору запчастей от опытных специалистов</p>
            </div>
        </div>
    </section>

    <!-- Наши проекты -->
    <section class="mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Реализованные проекты</h2>
        
        <!-- Слайдер проектов -->
        <div class="swiper projectsSwiper">
            <!-- Кнопки навигации -->
            <button class="projects-button-prev">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="projects-button-next">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <div class="swiper-wrapper">
                <?php
                $projects = [
                    [
                        'title' => 'ЖК "Новые горизонты"',
                        'description' => 'Поставка запчастей для башенных кранов Potain MC 175 и MC 310',
                        'location' => 'Москва',
                        'year' => '2023',
                        'image' => 'project1.jpg'
                    ],
                    [
                        'title' => 'Логистический центр "Восток"',
                        'description' => 'Комплексное обслуживание кранов Liebherr 132 EC-H',
                        'location' => 'Санкт-Петербург',
                        'year' => '2022',
                        'image' => 'project2.jpg'
                    ],
                    [
                        'title' => 'ЖК "Солнечный"',
                        'description' => 'Поставка запчастей для кранов Zoomlion',
                        'location' => 'Казань',
                        'year' => '2023',
                        'image' => 'project3.jpg'
                    ],
                    [
                        'title' => 'Промышленный парк "Развитие"',
                        'description' => 'Сервисное обслуживание кранов Comansa',
                        'location' => 'Екатеринбург',
                        'year' => '2022',
                        'image' => 'project4.jpg'
                    ]
                ];

                foreach ($projects as $project) :
                ?>
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg overflow-hidden h-full border border-gray-200">
                            <div class="relative">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/projects/<?php echo $project['image']; ?>" 
                                     alt="<?php echo $project['title']; ?>" 
                                     class="w-full h-64 object-cover">
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                                    <h3 class="text-xl font-bold text-white"><?php echo $project['title']; ?></h3>
                                </div>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-600 mb-4"><?php echo $project['description']; ?></p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <?php echo $project['location']; ?>, <?php echo $project['year']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Наши партнеры -->
    <section class="mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Наши партнеры</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <?php
            $partners = [
                'potain' => 'Potain',
                'liebherr' => 'Liebherr',
                'zoomlion' => 'Zoomlion',
                'comansa' => 'Comansa'
            ];

            foreach ($partners as $slug => $name) :
            ?>
                <div class="bg-white p-6 rounded-lg shadow-sm flex items-center justify-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/partners/<?php echo $slug; ?>.png" 
                         alt="<?php echo $name; ?>" 
                         class="max-h-12">
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Наша команда -->
    <section class="mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Наша команда</h2>
        <div class="grid md:grid-cols-4 gap-8">
            <?php
            $team = [
                [
                    'name' => 'Алесандр Иванов',
                    'position' => 'Генеральный директор',
                    'photo' => 'team1.jpg'
                ],
                [
                    'name' => 'Елена Петрова',
                    'position' => 'Руководитель отдела продаж',
                    'photo' => 'team2.jpg'
                ],
                [
                    'name' => 'Сергей Смирнов',
                    'position' => 'Технический специалист',
                    'photo' => 'team3.jpg'
                ],
                [
                    'name' => 'Мария Козлова',
                    'position' => 'Менеджер по работе с клиентами',
                    'photo' => 'team4.jpg'
                ]
            ];

            foreach ($team as $member) :
            ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/<?php echo $member['photo']; ?>" 
                         alt="<?php echo $member['name']; ?>" 
                         class="w-full h-48 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="font-bold text-gray-900"><?php echo $member['name']; ?></h3>
                        <p class="text-sm text-gray-500"><?php echo $member['position']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Контакты -->
    <section id="contacts" class="mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Контакты</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="space-y-4">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-primary mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Адрес</h3>
                            <p class="text-gray-600">г. Москва, ул. Примерная, д. 1, офис 123</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-primary mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Телефон</h3>
                            <p class="text-gray-600">+7 (495) 123-45-67</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-primary mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Email</h3>
                            <p class="text-gray-600">info@km-trade.ru</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-primary mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Режим работы</h3>
                            <p class="text-gray-600">Пн-Пт: 9:00 - 18:00</p>
                            <p class="text-gray-600">Сб-Вс: выходной</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- Карта -->
                <div class="h-full min-h-[400px]" id="map"></div>
            </div>
        </div>
    </section>
</div>

<!-- Скрипт для карты -->
<script src="https://api-maps.yandex.ru/2.1/?apikey=ваш_api_ключ&lang=ru_RU"></script>
<script>
ymaps.ready(init);

function init() {
    var myMap = new ymaps.Map("map", {
        center: [55.76, 37.64], // Координаты Москвы
        zoom: 15
    });

    var myPlacemark = new ymaps.Placemark([55.76, 37.64], {
        hintContent: 'КМ-Трейд',
        balloonContent: 'г. Москва, ул. Примерная, д. 1, офис 123'
    });

    myMap.geoObjects.add(myPlacemark);
}
</script>

<?php get_footer(); ?> 