<?php
/**
 * Шаблон секции с шагами оформления заказа
 * 
 * Отображает пошаговую инструкцию процесса заказа в виде 4 карточек с номерами.
 * Каждая карточка содержит номер шага, заголовок и описание.
 *
 * @package KM_Trade
 * @version 1.0.0
 *
 * @param array $args {
 *     Параметры секции.
 *
 *     @type array $steps_defaults {
 *         Массив шагов, где ключ - номер шага (01, 02, ...).
 *         
 *         @type string $title Заголовок шага
 *         @type string $text  Описание шага
 *     }
 * }
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args, [
    'steps_defaults' => []
]);

$steps_defaults = $args['steps_defaults'];
?>

<section class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px] mt-[60px]">
    <!-- Шаги оформления заказа -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[30px]">
        <?php foreach ($steps_defaults as $index => $step): ?>
            <div class="relative flex flex-col items-center text-center">
                <!-- Номер шага в оранжевом круге -->
                <div class="w-[56px] h-[56px] bg-[#F38D19]/10 rounded-[5px] flex items-center justify-center mb-6">
                    <span class="text-[20px] font-bold text-[#F38D19]"><?php echo esc_html($index); ?></span>
                </div>
                
                <!-- Информация о шаге -->
                <h3 class="text-[20px] font-bold text-black mb-3">
                    <?php echo esc_html($step['title']); ?>
                </h3>
                <p class="text-[#999999] text-[16px] leading-[150%]">
                    <?php echo esc_html($step['text']); ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</section> 