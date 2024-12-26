class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= '<li class="' . implode(' ', $item->classes) . '">';
        $output .= '<a href="' . $item->url . '" class="text-gray-600 hover:text-gray-900 transition-colors">';
        $output .= $item->title;
        $output .= '</a>';
    }
} 