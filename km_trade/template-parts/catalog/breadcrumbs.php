<div class="max-w-screen-2xl mx-auto px-[30px] lg:px-[120px] py-6">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs text-gray-600">', '</div>');
            } else {
                ?>
                <li class="inline-flex items-center">
                    <a href="<?php echo esc_url(home_url('/')); ?>" 
                       class="text-gray-600 hover:text-[#F38D19] transition-colors">
                        Главная
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500"><?php echo get_the_title(); ?></span>
                    </div>
                </li>
                <?php
            }
            ?>
        </ol>
    </nav>
</div> 