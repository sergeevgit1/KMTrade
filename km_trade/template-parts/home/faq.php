<?php
if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args, [
    'faq_defaults' => []
]);

// Демо-контент для FAQ
$faqs = [
    [
        'question' => 'Как заказать запчасти для крана?',
        'answer' => 'Вы можете заказать запчасти через каталог на сайте, оставить заявку или позвонить нам напрямую. Наши специалисты помогут подобрать необходимые детали и оформить заказ.'
    ],
    [
        'question' => 'Какие документы нужны для заказа?',
        'answer' => 'Для юридических лиц потребуются реквизиты компании. Для физических лиц - паспортные данные. При необходимости мы подготовим все документы для бухгалтерии.'
    ],
    [
        'question' => 'Есть ли гарантия на запчасти?',
        'answer' => 'Да, мы предоставляем гарантию на все поставляемые запчасти. Срок гарантии зависит от типа детали и производителя. Подробные условия гарантии можно уточнить у менеджера.'
    ],
    [
        'question' => 'Как осуществляется доставка?',
        'answer' => 'Доставка осуществляется по всей России через надежные транспортные компании. Сроки и стоимость доставки рассчитываются индивидуально в зависимости от региона и веса заказа.'
    ],
    [
        'question' => 'Работаете ли вы с регионами?',
        'answer' => 'Да, мы работаем со всеми регионами России. У нас налажена система логистики, позволяющая оперативно доставлять запчасти в любую точку страны.'
    ],
    [
        'question' => 'Возможна ли срочная доставка?',
        'answer' => 'Да, мы предлагаем услугу срочной доставки для критически важных заказов. Стоимость и возможность срочной доставки обсуждается индивидуально.'
    ]
];
?>

<section class="mx-auto px-[30px] md:px-[60px] lg:px-[120px] max-w-[1920px] mt-[60px]">
    <div class="flex flex-col items-center text-center mb-[60px]">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-[45px] h-[2px] bg-[#F38D19]"></div>
            <span class="text-[#F38D19] font-medium">FAQ</span>
            <div class="w-[45px] h-[2px] bg-[#F38D19]"></div>
        </div>
        <h2 class="text-[32px] font-bold text-black mb-3">Часто задаваемые вопросы</h2>
        <p class="text-[#999999] text-[16px] leading-[150%] max-w-[600px]">
            Ответы на популярные вопросы о запчастях для башенных кранов
        </p>
    </div>

    <div class="grid lg:grid-cols-2 gap-[30px]">
        <?php foreach ($faqs as $index => $faq) : ?>
            <div class="bg-white rounded-[5px] border border-[#E3E3E3] overflow-hidden" x-data="{ open: false }">
                <button class="w-full text-left p-[30px] focus:outline-none" @click="open = !open">
                    <div class="flex items-center justify-between">
                        <h3 class="text-[20px] font-bold text-black group-hover:text-[#F38D19]">
                            <?php echo esc_html($faq['question']); ?>
                        </h3>
                        <svg class="w-6 h-6 text-[#999999] transform transition-transform" 
                             :class="{ 'rotate-180': open }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button>
                <div class="overflow-hidden transition-all duration-300" 
                     x-show="open" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-4">
                    <div class="px-[30px] pb-[30px] text-[#999999] text-[16px] leading-[150%]">
                        <?php echo esc_html($faq['answer']); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- AlpineJS для функциональности аккордеона -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>