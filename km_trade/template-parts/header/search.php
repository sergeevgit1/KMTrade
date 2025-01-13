<div class="relative">
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative flex">
        <div class="relative flex-grow">
            <input type="search" 
                   name="s" 
                   value="<?php echo esc_attr(get_search_query()); ?>"
                   class="w-full h-[48px] rounded-l-lg border border-r-0 border-zinc-200 bg-transparent pl-12 pr-4 focus:border-[#F38D19] focus:ring-2 focus:ring-[#F38D19]/20" 
                   placeholder="Поиск по сайту">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
        </div>
        <button type="submit" 
                class="h-[48px] px-6 bg-[#F38D19] text-white font-medium rounded-r-lg hover:bg-[#E07D08] transition-colors">
            Найти
        </button>
    </form>
</div> 