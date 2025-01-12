<?php
// Фильтры по кранам
$manufacturers = [
    'potain' => [
        'name' => 'Potain',
        'models' => ['MC 175', 'MC 2358', 'HMC 205', 'MC 310', 'MDT 178', 'MCT 205', 'MD 205']
    ],
    'zoomlion' => [
        'name' => 'Zoomlion',
        'models' => ['WA6017-10', 'WA7025-12']
    ],
    'liebherr' => [
        'name' => 'Liebherr',
        'models' => ['112 EC-H', '132 EC-H']
    ],
    'comansa' => [
        'name' => 'Comansa',
        'models' => ['10LC140']
    ]
];

// Получаем активные фильтры
$active_filters = [];
if (isset($_GET['manufacturer'])) {
    $active_filters[] = [
        'type' => 'manufacturer',
        'value' => $_GET['manufacturer'],
        'label' => $manufacturers[$_GET['manufacturer']]['name']
    ];
}
if (isset($_GET['crane_model'])) {
    $active_filters[] = [
        'type' => 'model',
        'value' => $_GET['crane_model'],
        'label' => str_replace('-', ' ', ucfirst($_GET['crane_model']))
    ];
}
?>

<!-- Фильтры -->
<div class="bg-white rounded-[20px] border border-zinc-100">
    <!-- Заголовок -->
    <div class="p-4 border-b border-zinc-100">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-zinc-900">Фильтры</h2>
            <a href="<?php echo get_permalink(); ?>" 
               class="text-sm text-[#F38D19] hover:text-[#E07D08] transition-colors">
                Сбросить все
            </a>
        </div>
    </div>

    <!-- Активные фильтры -->
    <?php if (!empty($active_filters)): ?>
        <div class="p-3 border-b border-zinc-100 bg-zinc-50/50">
            <div class="flex flex-wrap gap-1.5">
                <?php foreach ($active_filters as $filter): ?>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white border border-zinc-200 text-sm rounded-lg">
                        <span class="text-zinc-900"><?php echo esc_html($filter['label']); ?></span>
                        <a href="<?php echo remove_query_arg($filter['type']); ?>" 
                           class="text-zinc-400 hover:text-[#F38D19] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <form method="get" action="<?php echo get_permalink(); ?>" class="divide-y divide-zinc-100">
        <!-- Производитель крана -->
        <div class="p-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm font-medium text-zinc-900">Производитель крана</h3>
                <?php if (isset($_GET['manufacturer'])): ?>
                    <a href="<?php echo remove_query_arg('manufacturer'); ?>" 
                       class="text-xs text-[#F38D19] hover:text-[#E07D08] transition-colors">
                        Очистить
                    </a>
                <?php endif; ?>
            </div>
            <div class="space-y-1">
                <?php foreach ($manufacturers as $key => $data): 
                    $checked = isset($_GET['manufacturer']) && $_GET['manufacturer'] === $key;
                    $count_args = array(
                        'post_type' => 'product',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => '_crane_manufacturer',
                                'value' => $key,
                                'compare' => '='
                            )
                        )
                    );
                    $count_query = new WP_Query($count_args);
                    $count = $count_query->found_posts;
                    wp_reset_postdata();
                ?>
                    <label class="flex items-center justify-between p-2 rounded-lg cursor-pointer hover:bg-zinc-50 <?php echo $checked ? 'bg-[#F38D19]/5' : ''; ?> transition-colors">
                        <div class="flex items-center gap-3">
                            <input type="radio" 
                                   name="manufacturer" 
                                   value="<?php echo esc_attr($key); ?>"
                                   <?php checked($checked); ?>
                                   onchange="this.form.submit()"
                                   class="w-4 h-4 border-zinc-300 text-[#F38D19] focus:ring-[#F38D19]/20">
                            <span class="text-sm <?php echo $checked ? 'text-[#F38D19] font-medium' : 'text-zinc-600'; ?>">
                                <?php echo esc_html($data['name']); ?>
                            </span>
                        </div>
                        <span class="text-xs text-zinc-400">
                            <?php echo $count; ?>
                        </span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Модель крана -->
        <div class="p-4">
            <h3 class="text-sm font-medium text-zinc-900 mb-3">Модель крана</h3>
            <div class="space-y-1">
                <?php
                if (isset($_GET['manufacturer']) && isset($manufacturers[$_GET['manufacturer']])) {
                    foreach ($manufacturers[$_GET['manufacturer']]['models'] as $model) {
                        $model_value = sanitize_title($model);
                        $checked = isset($_GET['crane_model']) && $_GET['crane_model'] === $model_value;
                        $count_args = array(
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'meta_query' => array(
                                array(
                                    'key' => '_crane_model',
                                    'value' => $model_value,
                                    'compare' => '='
                                )
                            )
                        );
                        $count_query = new WP_Query($count_args);
                        $count = $count_query->found_posts;
                        wp_reset_postdata();
                        ?>
                        <label class="flex items-center justify-between p-2 rounded-lg cursor-pointer hover:bg-zinc-50 <?php echo $checked ? 'bg-[#F38D19]/5' : ''; ?> transition-colors">
                            <div class="flex items-center gap-3">
                                <input type="radio" 
                                       name="crane_model" 
                                       value="<?php echo esc_attr($model_value); ?>"
                                       <?php checked($checked); ?>
                                       onchange="this.form.submit()"
                                       class="w-4 h-4 border-zinc-300 text-[#F38D19] focus:ring-[#F38D19]/20">
                                <span class="text-sm <?php echo $checked ? 'text-[#F38D19] font-medium' : 'text-zinc-600'; ?>">
                                    <?php echo esc_html($model); ?>
                                </span>
                            </div>
                            <span class="text-xs text-zinc-400">
                                <?php echo $count; ?>
                            </span>
                        </label>
                        <?php
                    }
                } else {
                    echo '<div class="text-sm text-zinc-400 text-center py-6">Выберите производителя</div>';
                }
                ?>
            </div>
        </div>
    </form>
</div>
