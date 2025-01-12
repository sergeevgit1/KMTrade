<?php
if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args, [
    'about_defaults' => []
]);

$about_defaults = $args['about_defaults'];
?>

<section class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px] mt-[60px]">
    <div class="grid lg:grid-cols-2 gap-[30px] items-center">
        <!-- Левая колонка с контентом -->
        <div>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-[45px] h-[2px] bg-[#F38D19]"></div>
                <span class="text-[#F38D19] font-medium">О компании</span>
            </div>
            
            <h2 class="text-[32px] font-bold text-black mb-6">
                <?php echo esc_html(get_theme_mod('about_title', $about_defaults['title'])); ?>
            </h2>
            
            <!-- Краткое описание -->
            <div class="text-[#999999] text-[16px] leading-[150%] space-y-4 mb-8">
                <?php 
                $short_text = wp_trim_words(
                    wp_strip_all_tags(get_theme_mod('about_text', $about_defaults['text'])), 
                    40, 
                    '...'
                ); 
                echo wpautop($short_text);
                ?>
            </div>

            <!-- Ключевые показатели -->
            <div class="grid grid-cols-3 gap-[30px] mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-[56px] h-[56px] bg-[#F38D19]/10 rounded-[5px] flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#F38D19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[24px] font-bold text-[#F38D19]">10+</div>
                        <div class="text-[14px] text-[#999999]">лет опыта</div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-[56px] h-[56px] bg-[#F38D19]/10 rounded-[5px] flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#F38D19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[24px] font-bold text-[#F38D19]">1000+</div>
                        <div class="text-[14px] text-[#999999]">клиентов</div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-[56px] h-[56px] bg-[#F38D19]/10 rounded-[5px] flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#F38D19]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[24px] font-bold text-[#F38D19]">100%</div>
                        <div class="text-[14px] text-[#999999]">гарантия</div>
                    </div>
                </div>
            </div>

            <!-- Кнопки действий -->
            <div class="flex gap-4">
                <a href="/new/about/" 
                   class="flex items-center justify-center w-[184px] h-[45px] bg-[#F38D19] text-white rounded-[5px] hover:bg-[#E07D08] transition-colors">
                    <span class="font-bold">Подробнее</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="#contacts" 
                   class="flex items-center justify-center w-[184px] h-[45px] border border-[#E3E3E3] text-black rounded-[5px] hover:bg-[#F38D19] hover:text-white hover:border-[#F38D19] transition-colors">
                    <span class="font-bold">Связаться с нами</span>
                </a>
            </div>
        </div>

        <!-- Правая колонка с изображением -->
        <div class="relative">
            <div class="relative overflow-hidden rounded-[5px]">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team.png" 
                     alt="Команда Element Kran" 
                     class="w-full h-full object-cover"
                     width="611"
                     height="429">
            </div>
        </div>
    </div>
</section>