    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 text-gray-800">
        <!-- Основная информация -->
        <div class="border-t border-gray-200">
            <div class="container mx-auto px-4 py-12">
                <div class="grid md:grid-cols-4 gap-8">
                    <!-- О компании -->
                    <div class="col-span-2">
                        <h3 class="text-xl font-bold mb-4">О компании</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed"><?php echo get_theme_mod('footer_about', 'Поставка запчастей для башенных кранов с 2010 года. Мы специализируемся на поставке качественных комплектующих от проверенных производителей.'); ?></p>
                        <div class="flex space-x-4">
                            <?php if(get_theme_mod('social_vk')): ?>
                            <a href="<?php echo esc_url(get_theme_mod('social_vk')); ?>" class="text-gray-500 hover:text-gray-900">
                                <span class="sr-only">VK</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M15.684 0H8.316C1.592 0 0 1.592 0 8.316v7.368C0 22.408 1.592 24 8.316 24h7.368C22.408 24 24 22.408 24 15.684V8.316C24 1.592 22.408 0 15.684 0zm3.692 17.123h-1.744c-.66 0-.862-.523-2.049-1.712-1.033-1.033-1.49-1.172-1.745-1.172-.356 0-.458.102-.458.597v1.573c0 .424-.135.636-1.253.636-1.846 0-3.896-1.12-5.339-3.202-2.17-3.042-2.763-5.32-2.763-5.785 0-.254.102-.491.596-.491h1.744c.44 0 .61.203.78.677.848 2.46 2.274 4.617 2.867 4.617.22 0 .322-.102.322-.66V9.721c-.068-1.186-.695-1.287-.695-1.71 0-.203.17-.407.44-.407h2.748c.373 0 .508.203.508.643v3.473c0 .372.17.508.271.508.22 0 .407-.136.813-.542 1.254-1.406 2.15-3.574 2.15-3.574.119-.254.305-.491.729-.491h1.744c.525 0 .643.27.525.643-.22 1.017-2.357 4.031-2.357 4.031-.186.305-.254.44 0 .78.186.254.796.779 1.203 1.253.745.847 1.32 1.558 1.473 2.05.17.474-.085.716-.576.716z"/>
                                </svg>
                            </a>
                            <?php endif; ?>
                            <?php if(get_theme_mod('social_telegram')): ?>
                            <a href="<?php echo esc_url(get_theme_mod('social_telegram')); ?>" class="text-gray-500 hover:text-gray-900">
                                <span class="sr-only">Telegram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.223-.548.223l.18-2.935 5.36-4.82c.23-.21-.054-.33-.354-.12l-6.62 4.17-2.86-.89c-.62-.194-.63-.62.13-.92l11.15-4.29c.51-.19.96.13.79.71z"/>
                                </svg>
                            </a>
                            <?php endif; ?>
                            <?php if(get_theme_mod('social_whatsapp')): ?>
                            <a href="<?php echo esc_url(get_theme_mod('social_whatsapp')); ?>" class="text-gray-500 hover:text-gray-900">
                                <span class="sr-only">WhatsApp</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Меню -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Меню</h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'container' => 'ul',
                            'container_class' => '',
                            'menu_class' => 'space-y-2',
                            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                            'walker' => new Footer_Menu_Walker()
                        ));
                        ?>
                    </div>

                    <!-- Контакты -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Контакты</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start space-x-2">
                                <svg class="w-6 h-6 text-gray-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-gray-600"><?php echo get_theme_mod('phone_number', '+7 (XXX) XXX-XX-XX'); ?></span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <svg class="w-6 h-6 text-gray-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-600"><?php echo get_theme_mod('contact_email', 'info@example.com'); ?></span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <svg class="w-6 h-6 text-gray-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-gray-600"><?php echo get_theme_mod('contact_address', 'г. Москва, ул. Примерная, д. 1'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-gray-500 text-sm">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Все права защищены.
                </div>
                <div class="text-gray-500 text-sm">
                    <a href="<?php echo get_privacy_policy_url(); ?>" class="hover:text-gray-900">
                        Политика конфиденциальности
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html> 