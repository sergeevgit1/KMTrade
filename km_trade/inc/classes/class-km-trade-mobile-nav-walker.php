<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Кастомный класс для вывода мобильного меню
 */
class KM_Trade_Mobile_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Добавляем базовые классы для всех элементов
        $classes[] = 'relative';
        
        // Добавляем классы для активных элементов
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'text-primary';
        } else {
            $classes[] = 'text-gray-700 hover:text-primary transition-colors';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        // Добавляем классы для ссылок
        $atts['class']  = 'block py-3 px-4';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = '';
        
        // Проверяем наличие дочерних элементов
        $has_children = !empty($args->walker) && !empty($item->classes) && in_array('menu-item-has-children', $item->classes);
        
        // Если есть подменю, создаем кнопку-переключатель
        if ($has_children) {
            $item_output .= '<div class="flex items-center justify-between">';
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $title;
            $item_output .= '</a>';
            $item_output .= '<button type="button" 
                                   class="p-2 text-gray-500 hover:text-primary transition-colors"
                                   onclick="toggleSubmenu(this)">
                                <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>';
            $item_output .= '</div>';
        } else {
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $title;
            $item_output .= '</a>';
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        
        // Добавляем классы для подменю
        $classes = array(
            'pl-4',
            'hidden',
            'submenu'
        );
        
        $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $output .= "\n$indent<ul class=\"$class_names\">\n";
    }
} 