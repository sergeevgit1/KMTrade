<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
    </main>

    <!-- Разделитель между контентом и футером -->
    <div class="h-[60px] md:h-[90px]"></div>

    <footer class="relative before:absolute before:top-0 before:left-0 before:w-full before:h-[1px] before:bg-[#E3E3E3]">
        <!-- Основной контент футера -->
        <div class="bg-black text-white">
            <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px] py-[60px]">
                <div class="grid md:grid-cols-2 lg:grid-cols-12 gap-[30px]">
                    <!-- Информация о компании -->
                    <div class="lg:col-span-3 relative after:absolute after:right-0 after:top-0 after:h-full after:w-[1px] after:bg-white/10 lg:after:block after:hidden">
                        <!-- Логотип и название - кликабельный блок -->
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block">
                            <div class="mb-4 max-w-[100px]">
                                <?php if (has_custom_logo()) : ?>
                                    <?php 
                                    $custom_logo_id = get_theme_mod('custom_logo');
                                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                                    ?>
                                    <img src="<?php echo esc_url($logo[0]); ?>" 
                                         alt="<?php echo get_bloginfo('name'); ?>"
                                         class="w-full h-auto">
                                <?php endif; ?>
                            </div>
                            
                            <h3 class="text-[20px] font-bold mb-1">
                                <span class="text-[#F38D19]">КМ</span>
                                <span class="text-white">-Трейд</span>
                            </h3>
                            <p class="text-white/60 text-[14px]">Торговая компания</p>
                        </a>
                        
                        <div class="h-4"></div> <!-- Отступ после кликабельного блока -->
                        
                        <p class="text-white/60 text-[14px] leading-[150%] mb-4">
                            Поставка запчастей для башенных кранов с доставкой по всей России
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="w-8 h-8 rounded-full bg-[#F38D19] flex items-center justify-center text-white hover:bg-[#E07D08] transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692h1.971v3z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-8 h-8 rounded-full bg-[#F38D19] flex items-center justify-center text-white hover:bg-[#E07D08] transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.066 9.645c.183 4.04-2.83 8.544-8.164 8.544-1.622 0-3.131-.476-4.402-1.291 1.524.18 3.045-.244 4.252-1.189-1.256-.023-2.317-.854-2.684-1.995.451.086.895.061 1.298-.049-1.381-.278-2.335-1.522-2.304-2.853.388.215.83.344 1.301.359-1.279-.855-1.641-2.544-.889-3.835 1.416 1.738 3.533 2.881 5.92 3.001-.419-1.796.944-3.527 2.799-3.527.825 0 1.572.349 2.096.907.654-.128 1.27-.368 1.824-.697-.215.671-.67 1.233-1.263 1.589.581-.07 1.135-.224 1.649-.453-.384.578-.87 1.084-1.433 1.489z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-8 h-8 rounded-full bg-[#F38D19] flex items-center justify-center text-white hover:bg-[#E07D08] transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Навигация -->
                    <div class="lg:col-span-3 relative after:absolute after:right-0 after:top-0 after:h-full after:w-[1px] after:bg-white/10 lg:after:block after:hidden">
                        <?php get_template_part('template-parts/footer/menu'); ?>
                    </div>

                    <!-- Контакты -->
                    <div class="lg:col-span-3 relative after:absolute after:right-0 after:top-0 after:h-full after:w-[1px] after:bg-white/10 lg:after:block after:hidden">
                        <h4 class="text-[16px] font-bold text-white mb-4">Контакты</h4>
                        <div class="space-y-4">
                            <a href="tel:+78001234567" 
                               class="flex items-center text-[14px] text-white/60 hover:text-white transition-colors group">
                                <span class="w-8 h-8 rounded-full bg-[#F38D19] flex items-center justify-center mr-3 group-hover:bg-[#E07D08] transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </span>
                                8 (800) 123-45-67
                            </a>
                            <a href="mailto:info@example.com" 
                               class="flex items-center text-[14px] text-white/60 hover:text-white transition-colors group">
                                <span class="w-8 h-8 rounded-full bg-[#F38D19] flex items-center justify-center mr-3 group-hover:bg-[#E07D08] transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                info@example.com
                            </a>
                            <div class="flex items-center text-[14px] text-white/60 group">
                                <span class="w-8 h-8 rounded-full bg-[#F38D19] flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </span>
                                г. Москва, ул. Примерная, д. 1
                            </div>
                        </div>
                    </div>

                    <!-- Форма обратной связи -->
                    <div class="lg:col-span-3">
                        <h4 class="text-[16px] font-bold text-white mb-4">Остались вопросы?</h4>
                        <form id="footer-contact-form" class="space-y-3">
                            <input type="text" 
                                   name="name"
                                   required
                                   placeholder="Ваше имя" 
                                   class="w-full h-[40px] px-4 rounded-[5px] bg-white/5 border border-white/10 text-white placeholder:text-white/40 focus:outline-none focus:border-[#F38D19] text-[14px]">
                            
                            <input type="tel" 
                                   name="phone"
                                   required
                                   placeholder="Телефон" 
                                   class="w-full h-[40px] px-4 rounded-[5px] bg-white/5 border border-white/10 text-white placeholder:text-white/40 focus:outline-none focus:border-[#F38D19] text-[14px]">
                            
                            <textarea name="message"
                                      required
                                      placeholder="Сообщение" 
                                      class="w-full h-[80px] p-4 rounded-[5px] bg-white/5 border border-white/10 text-white placeholder:text-white/40 focus:outline-none focus:border-[#F38D19] text-[14px] resize-none"></textarea>
                            
                            <div class="flex flex-col gap-3">
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="checkbox" 
                                           required
                                           class="w-4 h-4 rounded border-white/10 bg-white/5 text-[#F38D19] focus:ring-[#F38D19]">
                                    <span class="text-[12px] text-white/60 group-hover:text-white transition-colors">
                                        Согласен с политикой конфиденциальности
                                    </span>
                                </label>
                                <button type="submit" 
                                        class="w-full h-[40px] bg-[#F38D19] text-white font-bold rounded-[5px] hover:bg-[#E07D08] transition-colors text-[14px]">
                                    Отправить
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Копирайт -->
        <div class="bg-black border-t border-white/10">
            <div class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px] py-[30px]">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-[14px] text-white/60">
                        © <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?>. Все права защищены
                    </div>
                    <div class="flex gap-4">
                        <a href="#" class="text-[14px] text-white/60 hover:text-[#F38D19] transition-colors">
                            Политика конфиденциальности
                        </a>
                        <a href="#" class="text-[14px] text-white/60 hover:text-[#F38D19] transition-colors">
                            Пользовательское соглашение
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

    <script>
        // Обработка отправки формы
        document.getElementById('footer-contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Здесь будет AJAX запрос для отправки формы
            const formData = new FormData(this);
            
            // Добавить обработку отправки
        });
    </script>
</body>
</html>
