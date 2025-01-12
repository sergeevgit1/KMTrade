<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('KM_Trade_Nav_Walker')) {
    class KM_Trade_Nav_Walker extends Walker_Nav_Menu {
        private $menu_type;

        public function __construct($menu_type = 'center') {
            $this->menu_type = $menu_type;
        }

        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
            switch ($this->menu_type) {
                case 'catalog':
                    // Кнопка Каталог в оранжевом прямоугольнике
                    $output .= '<div class="bg-[#F38E19] w-[184px] h-[32px] rounded-[5px] flex items-center justify-center">';
                    $output .= '<a href="' . esc_url($item->url) . '" class="inline-flex items-center text-white text-[13px] font-bold font-inter">';
                    $output .= '<svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>';
                    $output .= esc_html($item->title);
                    $output .= '</a>';
                    $output .= '</div>';
                    break;

                case 'quick-order':
                    // Кнопка Быстрый заказ
                    $output .= '<div class="menu-item">';
                    $output .= '<a href="' . esc_url($item->url) . '" class="inline-flex items-center justify-center w-[184px] h-[32px] bg-black rounded-[5px] text-white text-[13px] font-bold font-inter hover:bg-gray-800 transition-colors">';
                    $output .= esc_html($item->title);
                    $output .= '</a>';
                    $output .= '</div>';
                    break;

                default:
                    // Обычные пункты меню
                    $output .= '<li>';
                    $output .= '<a href="' . esc_url($item->url) . '" class="text-[13px] font-bold font-inter text-black hover:text-[#F38E19] transition-colors">';
                    $output .= esc_html($item->title);
                    $output .= '</a>';
                    break;
            }
        }

        public function end_el(&$output, $item, $depth = 0, $args = array()) {
            if ($this->menu_type === 'center') {
                $output .= '</li>';
            }
        }
    }
} 