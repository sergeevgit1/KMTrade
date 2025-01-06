class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= sprintf(
            '<a href="%s" class="group relative px-5 py-3.5 text-white hover:bg-[#e07d08] transition-colors">
                <span class="font-medium whitespace-nowrap text-sm uppercase">
                    %s
                </span>
            </a>',
            esc_url($item->url),
            esc_html($item->title)
        );
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<div class="flex items-center">';
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</div>';
    }
} 