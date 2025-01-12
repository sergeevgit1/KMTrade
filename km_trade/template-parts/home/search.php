<?php
if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args, [
    'how_to_find' => []
]);

$how_to_find = $args['how_to_find'];
?>

<section class="container mx-auto px-4 mb-8">
    <div class="bg-white rounded-xl border border-zinc-100 p-8">
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex flex-col md:flex-row gap-4 flex-1">
                <div class="flex-1">
                    <input type="search" 
                        name="s"
                        placeholder="Введите категорию или название детали" 
                        class="w-full px-4 py-3 rounded-lg border border-zinc-200 focus:border-brand-orange focus:outline-none focus:ring-0 transition-colors">
                </div>
                <button type="submit" 
                    class="bg-brand-orange text-white px-8 py-3 rounded-lg hover:bg-brand-orange-dark transition-colors flex items-center justify-center whitespace-nowrap">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Найти запчасть
                </button>
            </form>
        </div>
        <div class="flex flex-wrap gap-2">
            <span class="text-sm text-zinc-500">Популярные запросы:</span>
            <a href="<?php echo esc_url(add_query_arg('s', 'Подшипник 6204', home_url('/'))); ?>" 
                class="text-sm text-brand-orange hover:text-brand-orange-dark">Подшипник 6204</a>
            <span class="text-zinc-300">•</span>
            <a href="<?php echo esc_url(add_query_arg('s', 'Трос D15', home_url('/'))); ?>" 
                class="text-sm text-brand-orange hover:text-brand-orange-dark">Трос D15</a>
            <span class="text-zinc-300">•</span>
            <a href="<?php echo esc_url(add_query_arg('s', 'Анкер M24', home_url('/'))); ?>" 
                class="text-sm text-brand-orange hover:text-brand-orange-dark">Анкер M24</a>
            <span class="text-zinc-300">•</span>
            <a href="<?php echo esc_url(add_query_arg('s', 'Гидроцилиндр HC-200', home_url('/'))); ?>" 
                class="text-sm text-brand-orange hover:text-brand-orange-dark">Гидроцилиндр HC-200</a>
        </div>
    </div>
</section> 