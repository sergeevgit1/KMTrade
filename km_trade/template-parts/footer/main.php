<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
            <h4>О компании</h4>
            <p class="mt-4"><?php echo get_theme_mod('footer_about', 'Мы - ведущий поставщик надежной строительной техники и оборудования. Наша цель - помочь вам реализовать самые амбициозные проекты.'); ?></p>
        </div>
        
        <div class="col-md-4 mb-4 mb-md-0">
            <h4>Меню</h4>
            <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer-menu',
                        'container'      => false,
                        'menu_class'     => 'list-unstyled mt-4',
                        'walker'         => new KM_Trade_Footer_Nav_Walker(),
                    )
                );
            ?>
        </div>

        <div class="col-md-4">
            <h4>Контакты</h4>
            <ul class="list-unstyled mt-4">
                <li>
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo get_theme_mod('contact_address', 'г. Москва, ул. Строителей, д. 10'); ?>
                </li>
                <li>
                    <i class="fas fa-phone-alt"></i>
                    <?php echo get_theme_mod('contact_phone', '+7 (495) 123-45-67'); ?>
                </li>
                <li>
                    <i class="fas fa-envelope"></i>
                    <?php echo get_theme_mod('contact_email', 'info@km-trade.ru'); ?>
                </li>
            </ul>
        </div>
    </div>
</div> 