<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/catalog/')); ?>">
    <div class="relative">
        <input type="search" 
               name="table-search" 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#F38D19]" 
               placeholder="Поиск по названию запчасти..." 
               value="<?php echo isset($_GET['table-search']) ? esc_attr($_GET['table-search']) : ''; ?>"
        >
        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </button>
    </div>
</form> 