<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="relative overflow-hidden">
    <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px] pt-8">
        <div class="flex items-start justify-between">
            <!-- Левая колонка с контентом -->
            <div class="max-w-[600px] lg:max-w-[600px] md:w-full">
                <h1 class="flex flex-col mb-6">
                    <span class="text-[64px] font-bold leading-[100%] text-black">Каталог</span>
                    <span class="text-[64px] font-bold leading-[100%] text-[#F38E19]">запчастей</span>
                    <span class="text-[64px] font-bold leading-[100%] text-black">для башенных<br/>кранов</span>
                </h1>
                
                <p class="text-[16px] leading-[150%] mb-8">
                    Более 1000 запчастей для:<br/>
                    <span class="font-medium">Potain, Liebherr, Zoomlion, Comansa</span>
                </p>

                <!-- Кнопки -->
                <div class="flex gap-4">
                    <a href="new/catalog/" 
                       class="flex items-center justify-center w-[184px] h-[45px] flex-shrink-0 rounded-[5px] bg-[#F38D19] text-white font-bold hover:bg-[#E07D08] transition-colors cursor-pointer">
                        Перейти в каталог
                    </a>
                    <a href="#" 
                       class="flex items-center justify-center w-[184px] h-[45px] flex-shrink-0 rounded-[5px] bg-black text-white font-bold hover:bg-[#F38D19] transition-colors">
                        Быстрый заказ
                    </a>
                </div>
            </div>

            <!-- Правая колонка с изображением -->
            <div class="relative hidden lg:block">
                <div class="relative z-10">
                    <?php 
                    $hero_image = get_theme_mod('hero_image', get_template_directory_uri() . '/assets/images/hero.png');
                    ?>
                    <img src="<?php echo esc_url($hero_image); ?>"
                         alt="Башенный кран"
                         class="w-full h-auto max-w-[800px]"
                         width="800"
                         height="600">
                </div>
                
                <!-- Фрейм за изображением -->
                <div class="absolute top-0 right-0 -z-10">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-frame.svg" 
                         alt="" 
                         class="w-full h-auto"
                         width="611"
                         height="429">
                </div>
            </div>
        </div>
    </div>
</section>