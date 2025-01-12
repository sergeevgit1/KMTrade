<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div>
    <h3 class="text-lg font-bold mb-6">Подписка на новости</h3>
    <p class="text-zinc-400 text-sm mb-4">
        Будьте в курсе новых поступлений и специальных предложений
    </p>
    
    <form id="subscribe-form" class="space-y-3">
        <input type="email" 
               name="email" 
               required
               placeholder="Ваш email"
               class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white placeholder-zinc-500 focus:outline-none focus:border-primary">
        
        <button type="submit" 
                class="w-full px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            Подписаться
        </button>
    </form>
</div> 