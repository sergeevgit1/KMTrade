<section class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px] mt-[60px]">
    <div class="bg-white rounded-[5px] border border-[#E3E3E3] p-[30px]">
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex flex-col md:flex-row gap-4 flex-1">
                <div class="flex-1">
                    <input type="search" 
                        name="s"
                        placeholder="Введите категорию или название детали" 
                        class="w-full h-[45px] px-4 rounded-[5px] border border-[#E3E3E3] focus:border-[#F38D19] focus:outline-none focus:ring-0 transition-colors">
                </div>
                <button type="submit" 
                    class="bg-[#F38D19] text-white w-[184px] h-[45px] rounded-[5px] hover:bg-[#E07D08] transition-colors flex items-center justify-center whitespace-nowrap">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Найти запчасть
                </button>
            </form>
        </div>
        <div class="flex flex-wrap gap-2">
            <span class="text-sm text-[#999999]">Популярные запросы:</span>
            <a href="<?php echo esc_url(add_query_arg('s', 'Подшипник 6204', home_url('/'))); ?>" 
                class="text-sm text-[#F38D19] hover:text-[#E07D08]">Подшипник 6204</a>
            <span class="text-[#E3E3E3]">•</span>
            <a href="<?php echo esc_url(add_query_arg('s', 'Трос D15', home_url('/'))); ?>" 
                class="text-sm text-[#F38D19] hover:text-[#E07D08]">Трос D15</a>
            <span class="text-[#E3E3E3]">•</span>
            <a href="<?php echo esc_url(add_query_arg('s', 'Анкер M24', home_url('/'))); ?>" 
                class="text-sm text-[#F38D19] hover:text-[#E07D08]">Анкер M24</a>
            <span class="text-[#E3E3E3]">•</span>
            <a href="<?php echo esc_url(add_query_arg('s', 'Гидроцилиндр HC-200', home_url('/'))); ?>" 
                class="text-sm text-[#F38D19] hover:text-[#E07D08]">Гидроцилиндр HC-200</a>
        </div>
    </div>
</section> 