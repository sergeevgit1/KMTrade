<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<hr>
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6 mb-3 mb-md-0">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> КМ-Трейд. Все права защищены.</p>
        </div>
        <div class="col-md-6 text-md-right">
            <div class="social-links">
                <?php if(get_theme_mod('social_facebook')): ?>
                    <a href="<?php echo esc_url(get_theme_mod('social_facebook')); ?>" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                <?php endif; ?>
                <?php if(get_theme_mod('social_twitter')): ?>
                    <a href="<?php echo esc_url(get_theme_mod('social_twitter')); ?>" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                <?php endif; ?>
                <?php if(get_theme_mod('social_instagram')): ?>
                    <a href="<?php echo esc_url(get_theme_mod('social_instagram')); ?>" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div> 