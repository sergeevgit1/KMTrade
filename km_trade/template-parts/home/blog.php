<?php
if (!defined('ABSPATH')) {
    exit;
}

// Демо-контент для постов
$demo_posts = [
    [
        'category' => 'Обслуживание',
        'date' => '15.03.2024',
        'title' => 'Как правильно обслуживать башенный кран: основные правила',
        'excerpt' => 'Регулярное техническое обслуживание башенного крана - залог его долгой и безопасной работы. Рассказываем об основных правилах и периодичности обслуживания.',
        'image' => 'maintenance.jpg'
    ],
    [
        'category' => 'Запчасти',
        'date' => '10.03.2024',
        'title' => 'Топ-10 самых востребованных запчастей для кранов Liebherr',
        'excerpt' => 'Разбираем наиболее часто заменяемые детали в башенных кранах Liebherr и рассказываем, на что обратить внимание при их выборе.',
        'image' => 'parts.jpg'
    ],
    [
        'category' => 'Инструкции',
        'date' => '05.03.2024',
        'title' => 'Подготовка башенного крана к зимнему периоду',
        'excerpt' => 'Пошаговая инструкция по подготовке крановой техники к работе в условиях низких температур. Советы от специалистов.',
        'image' => 'winter.jpg'
    ]
];
?>

<section class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px] mt-[60px]">
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-[60px]">
        <div>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-[45px] h-[2px] bg-[#F38D19]"></div>
                <span class="text-[#F38D19] font-medium">Наш блог</span>
            </div>
            <h2 class="text-[32px] font-bold text-black mb-3">Экспертные статьи и новости</h2>
            <p class="text-[#999999] text-[16px] leading-[150%] max-w-[600px]">
                Делимся опытом в обслуживании башенных кранов, рассказываем о новинках и трендах в сфере строительной техники
            </p>
        </div>
        <a href="/blog/" 
           class="flex items-center justify-center w-[184px] h-[45px] border border-[#E3E3E3] text-black rounded-[5px] hover:bg-[#F38D19] hover:text-white hover:border-[#F38D19] transition-colors mt-6 lg:mt-0">
            <span class="font-bold">Все публикации</span>
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
    
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-[30px]">
        <?php foreach ($demo_posts as $post) : ?>
            <article class="bg-white rounded-[5px] border border-[#E3E3E3] overflow-hidden group">
                <div class="aspect-video relative overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/<?php echo $post['image']; ?>" 
                         alt="<?php echo esc_attr($post['title']); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="inline-block bg-white/90 backdrop-blur-sm text-black text-[14px] font-medium px-3 py-1 rounded-[5px]">
                            <?php echo $post['category']; ?>
                        </span>
                    </div>
                </div>
                <div class="p-[30px]">
                    <div class="flex items-center text-[14px] text-[#999999] mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <?php echo $post['date']; ?>
                    </div>
                    <h3 class="text-[20px] font-bold text-black mb-3 group-hover:text-[#F38D19] transition-colors">
                        <a href="#"><?php echo $post['title']; ?></a>
                    </h3>
                    <p class="text-[#999999] text-[16px] leading-[150%] mb-4">
                        <?php echo $post['excerpt']; ?>
                    </p>
                    <a href="#" class="inline-flex items-center text-[#F38D19] font-bold group-hover:text-[#E07D08]">
                        Читать далее
                        <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section> 