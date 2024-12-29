            <?php
                if (get_post_meta( getbowtied_page_id(), 'footer_meta_box_check', true )) {
                    $page_footer_option = get_post_meta( getbowtied_page_id(), 'footer_meta_box_check', true );
                } else {
                    $page_footer_option = "on";
                }
            ?>

<script>
	
window.onload = function() {
if(document.querySelector('a[href^="tel:"]')) { document.querySelector('a[href^="tel:"]').onclick = function() {
   yaCounter61812592.reachGoal('klik-na-nomer-telephona');
   gtag('config', 'UA-158352555-1', {'page_path': '/klik-na-nomer-telephona'});
};}
if(document.querySelector('div#header-right-sidebar a[href^="tel:+7985"]')) { document.querySelector('div#header-right-sidebar a[href^="tel:+7985"]').onclick = function() {
	 yaCounter61812592.reachGoal('onсlick_tel_header');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_tel_header'});
};} 
if(document.querySelector('div#header-right-sidebar a[href^="tel:+7495"]')) { document.querySelector('div#header-right-sidebar a[href^="tel:+7495"]').onclick = function() {
	 yaCounter61812592.reachGoal('onсlick_tel_header');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_tel_header'});
};} 
if(document.querySelector('div.site-prefooter a[href^="tel:+7985"]')) { document.querySelector('div.site-prefooter a[href^="tel:+7985"]').onclick = function() {
	 yaCounter61812592.reachGoal('onсlick_tel_futer');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_tel_futer'});
};}
if(document.querySelector('div.site-prefooter a[href^="tel:+7 (913)"]')) { document.querySelector('div.site-prefooter a[href^="tel:+7 (913)"]').onclick = function() {
	 yaCounter61812592.reachGoal('onсlick_tel_futer');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_tel_futer'});
};}
if(document.querySelector('div.megamenu_contact_info a[href^="tel:+7985"]')) { document.querySelector('div.megamenu_contact_info a[href^="tel:+7985"]').onclick = function() {
	 yaCounter61812592.reachGoal('onсlick_tel_contacts');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_tel_contacts'});
};}
if(document.querySelector('div.megamenu_contact_info a[href^="tel:+7913"]')) { document.querySelector('div.megamenu_contact_info a[href^="tel:+7913"]').onclick = function() {
	 yaCounter61812592.reachGoal('onсlick_tel_contacts');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_tel_contacts'});
};}
if(document.querySelector('a[href^="mailto:"]')) { document.querySelector('a[href^="mailto:"]').onclick = function() {
     yaCounter61812592.reachGoal('klik-na-pochty');
	 gtag('config', 'UA-158352555-1', {'page_path': '/klik-na-pochty'});
};} 
if(document.querySelector('div#header-right-sidebar a[href^="mailto:"]')) { document.querySelector('div#header-right-sidebar a[href^="mailto:"]').onclick = function() {
     yaCounter61812592.reachGoal('onсlick_mail');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_mail'});
};}
if(document.querySelector('div.megamenu_contact_info a[href^="mailto:"]')) { document.querySelector('div.megamenu_contact_info a[href^="mailto:"]').onclick = function() {
     yaCounter61812592.reachGoal('onсlick_mail_contacts');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_mail_contacts'});
};} 
if(document.querySelector('div.site-prefooter a[href^="mailto:"]')) { document.querySelector('div.site-prefooter a[href^="mailto:"]').onclick = function() {
     yaCounter61812592.reachGoal('onсlick_mail_futer');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_mail_futer'});
};}	
if(document.querySelector('div.header-navigation-wrapper a[href="/zayavka.doc"]')) { document.querySelector('div.header-navigation-wrapper a[href="/zayavka.doc"]').onclick = function() {
     yaCounter61812592.reachGoal('onсlick_zayavka');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_zayavka'});
};}
if(document.querySelector('form#contact-form-gl')) { document.querySelector('form#contact-form-gl').onclick = function() {
     yaCounter61812592.reachGoal('onsubmit_zayavka_uspex');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onsubmit_zayavka_uspex'});
};}
if(document.querySelector('form#contact-form-foot')) { document.querySelector('form#contact-form-foot').onclick = function() {
     yaCounter61812592.reachGoal('onsubmit_zayavka_futer');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onsubmit_zayavka_futer'});
};}

if(document.querySelector('div.elementor-button-wrapper a[href="/zayavka"]')) {
var elements = document.querySelectorAll('div.elementor-button-wrapper a[href="/zayavka"]');
for (var i = 0; i < elements.length; i++) {
  elements[i].onclick = function(){
    yaCounter61812592.reachGoal('onсlick_arenda');
	gtag('config', 'UA-158352555-1', {'page_path': '/onсlick_arenda'});
  };
}
}


if(document.querySelector('form#contact-form')) { document.querySelector('form#contact-form').onclick = function() {
     yaCounter61812592.reachGoal('onsubmit_arenda');
	 gtag('config', 'UA-158352555-1', {'page_path': '/onsubmit_arenda'});
};} 




} 


 function setCursorPosition(pos, e) {
  //  e.focus();
    if (e.setSelectionRange) e.setSelectionRange(pos, pos);
    else if (e.createTextRange) {
      var range = e.createTextRange();
      range.collapse(true);
      range.moveEnd("character", pos);
      range.moveStart("character", pos);
      range.select()
    }
  }

  function mask(e) {
    //console.log('mask',e);
    var matrix = this.placeholder,// .defaultValue
        i = 0,
        def = matrix.replace(/\D/g, ""),
        val = this.value.replace(/\D/g, "");
    def.length >= val.length && (val = def);
    matrix = matrix.replace(/[_\d]/g, function(a) {
      return val.charAt(i++) || "_"
    });
    this.value = matrix;
    i = matrix.lastIndexOf(val.substr(-1));
    i < matrix.length && matrix != this.placeholder ? i++ : i = matrix.indexOf("_");
    setCursorPosition(i, this)
  }
  window.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector('input[type="tel"]');
	input.setAttribute("pattern", "\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}");
	console.log(input.getAttribute("pattern"));
    input.addEventListener("input", mask, false);
  //  input.focus();
    setCursorPosition(3, input);
  });
</script>

            <div class="hover_overlay_content"></div>

        </div><!-- .site-content-wrapper -->

        <?php if ( (1 == GBT_Opt::getOption('footer_prefooter')) && ($page_footer_option == "on") ) : ?>
            <?php get_template_part( 'template-parts/footers/prefooter' ) ?>
        <?php endif; ?>

        <?php if ( $page_footer_option == "on" ) : ?>
            <?php get_template_part( 'template-parts/footers/footer', 'style-1' ) ?>
        <?php endif; ?>     

        <div class="site-content" id="getbowtied_woocommerce_quickview">
            <div class="getbowtied_qv_content site-content"></div>
        </div> 

    </div><!-- .site-wrapper -->

    <!-- .site-search -->
    <?php if( 1 == GBT_Opt::getOption('simple_header_search_toggle') && 'style-2' == GBT_Opt::getOption('header_template') ) : ?>
        <div class="off-canvas-wrapper">
            <div class="site-search off-canvas position-top is-transition-overlap" id="searchOffCanvas" data-off-canvas>
                <div class="row has-scrollbar">

                    <div class="header-search">
                                    
                        <?php if ( GETBOWTIED_WOOCOMMERCE_IS_ACTIVE ) : ?>
                            <?php do_action('getbowtied_ajax_search_form'); ?>
                        <?php else: ?>
                            <?php get_search_form(); ?>
                        <?php endif; ?>

                        <button class="close-button" aria-label="Close menu" type="button" data-close>
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>

                </div>
            </div>
        </div><!-- .site-search -->
    <?php endif; ?>

    <?php wp_footer(); ?>
<?php add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method() {
	$script_url = plugins_url( '/d-goals.js', __FILE__ );
	wp_enqueue_script('custom-script', $script_url, array('jquery') );
}?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "//mc.yandex.ru/metrika/tag.js", "ym");

   ym(61812592, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="//mc.yandex.ru/watch/61812592" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script src="//code.jivosite.com/widget/zuQDcQ4LjG" async></script>



<script>
  jQuery('a, span').each(function() {
    if (jQuery(this).text().indexOf('Скачать технические характеристики') === 0) {
        jQuery(this).replaceWith('<a href="/zayavka/" class="zayavka elementor-button-link elementor-button elementor-size-sm" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-text">Арендовать</span> </span> </a>');
    }
});

jQuery(document).ready(function() {
    jQuery('.elementor-col-33 .elementor-col-50').each(function() {
        if (jQuery(this).find('a[href^="/zayavka"]').length > 0) {
            jQuery(this).hide();
        }
    });
});
jQuery('.elementor-col-50').each(function() {
    if (jQuery(this).find('.elementor-button-text:contains("Подробнее")').length > 0) {
        jQuery(this).css('width', '100%');
        jQuery(this).find('a.elementor-button').css('width', '100%');
    }
});
  
    
    
</script>
<script src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
