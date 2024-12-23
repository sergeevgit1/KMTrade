<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-zinc-200">
        <thead class="bg-zinc-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                    Наименование
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                    Производитель
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                    Модель крана
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                    Метки
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                    Действия
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-zinc-200">
            <?php
            if ($products->have_posts()) :
                while ($products->have_posts()) : $products->the_post();
                    global $product;
                    
                    // Получаем кастомные поля
                    $manufacturer = get_post_meta(get_the_ID(), '_crane_manufacturer', true);
                    $model = get_post_meta(get_the_ID(), '_crane_model', true);
                    $labels = get_post_meta(get_the_ID(), '_product_labels', true);
                    
                    // Преобразуем метки в массив
                    $labels_array = $labels ? array_map('trim', explode(',', $labels)) : array();
                    
                    // Получаем производителей из справочника
                    $manufacturers = array(
                        'potain' => 'Potain',
                        'liebherr' => 'Liebherr',
                        'zoomlion' => 'Zoomlion',
                        'comansa' => 'Comansa'
                    );
            ?>
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="flex-shrink-0 h-10 w-10">
                                    <?php echo get_the_post_thumbnail(null, 'thumbnail', array('class' => 'h-10 w-10 rounded-lg object-cover')); ?>
                                </div>
                            <?php endif; ?>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-zinc-900">
                                    <?php the_title(); ?>
                                </div>
                                <div class="text-sm text-zinc-500">
                                    Артикул: <?php echo $product->get_sku(); ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-zinc-900">
                            <?php echo isset($manufacturers[$manufacturer]) ? $manufacturers[$manufacturer] : '—'; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-zinc-900">
                            <?php echo $model ? esc_html($model) : '—'; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($labels_array as $label) : ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    <?php echo esc_html($label); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <button onclick="addToCart(<?php echo get_the_ID(); ?>)" 
                                class="text-orange-600 hover:text-orange-900">
                            Добавить в заказ
                        </button>
                    </td>
                </tr>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </tbody>
    </table>
</div> 