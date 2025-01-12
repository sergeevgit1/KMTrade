<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom Navigation Walker
 */
class KM_Trade_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Добавляем базовые классы для всех элементов
        $classes[] = 'flex items-center';

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        // Добавляем стили для ссылок
        $link_classes = array(
            'text-base',
            'font-medium',
            'text-zinc-900',
            'hover:text-brand-orange',
            'transition-colors'
        );

        // Если это активный пункт меню
        if (in_array('current-menu-item', $classes)) {
            $link_classes[] = 'text-brand-orange';
        }

        $attributes .= ' class="' . esc_attr(implode(' ', $link_classes)) . '"';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
} 