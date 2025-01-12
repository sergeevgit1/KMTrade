<?php
function register_navigation_menu_block() {
    register_block_type('element-kran/navigation-menu', array(
        'editor_script' => 'navigation-menu-editor',
        'editor_style' => 'navigation-menu-editor',
        'render_callback' => 'render_navigation_menu_block',
        'attributes' => array(
            'menuItems' => array(
                'type' => 'array',
                'default' => array(
                    array(
                        'text' => 'Механизмы подъема',
                        'url' => '#'
                    ),
                    array(
                        'text' => 'Электрооборудование',
                        'url' => '#'
                    ),
                    array(
                        'text' => 'Тормозная система',
                        'url' => '#'
                    ),
                    array(
                        'text' => 'Кабины и пульты',
                        'url' => '#'
                    ),
                    array(
                        'text' => 'Металлоконструкции',
                        'url' => '#'
                    )
                )
            )
        )
    ));
}
add_action('init', 'register_navigation_menu_block'); 