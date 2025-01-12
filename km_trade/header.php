<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            orange: "#f38e19",
                            "orange-light": "#ff8533",
                            "orange-dark": "#e07d08",
                        }
                    }
                }
            }
        };
    </script>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="bg-white">
    <?php 
    // Подключаем компоненты хедера
    get_template_part('template-parts/header/top-bar');
    get_template_part('template-parts/header/middle-section');
    get_template_part('template-parts/header/navigation');
    ?>
</header>

<main>
