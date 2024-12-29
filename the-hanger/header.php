<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">

<head>
	
	<meta name="cmsmagazine" content="6e8a796f731743be14649414df09d8f0" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    
	<link rel="profile" href="//gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="canonical" href="<?php echo esc_url(get_permalink()); ?>" />

	<?php wp_head(); ?>
	<?php if( get_field('keywords') ): ?>
   
   <meta name="keywords" content="<?php the_field('keywords'); ?>" />
<?php endif; ?>
	<?php if( get_field('meta-description') ): ?>
   
   <meta name="description" content='<?php the_field('meta-description'); ?>' />
<?php endif; ?>
    
    <!-- Open Graph теги -->
    <meta property="og:title" content="<?php echo wp_get_document_title(); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <?php if (has_post_thumbnail()): ?>
        <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>">
    <?php endif; ?>
    <?php if(get_field('meta-description')): ?>
        <meta property="og:description" content="<?php the_field('meta-description'); ?>">
    <?php endif; ?>
    
        <link rel="stylesheet" href="/wp-content/themes/the-hanger/style.css" />
	<meta name="yandex-verification" content="f5311a46a58ea323" />
<meta name="google-site-verification" content="7L3PWNgNypr34O-CB6ntjnVl8IHrYaMKYoM_WObNLf4" />
	<?if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/google-bot.php')) {
	include ($_SERVER['DOCUMENT_ROOT'] . '/google-bot.php');
	}?>

	<title><?php
		if (is_front_page()) {
			bloginfo('name'); echo ' - '; bloginfo('description');
		} else {
			wp_title(''); echo ' | '; bloginfo('name');
		}
	?></title>

<style>
    
.elementor-col-33  .elementor-row .elementor-col-50:not(.elementor-hidden-phone), .elementor-button-wrapper a[href^="/zayavka"] {
    display: none;
}
.elementor-col-33  .elementor-row .elementor-col-50.elementor-hidden-phone{
 width:100%;   
    
}

.zayavka{
	    margin: 0 auto;
    display: block;
	font-family: "Akrobat", Akrobat, Arial;
    text-transform: uppercase;
    color: #ffffff;
    background-color: #f38e19;
    padding: 11px 11px 11px 11px;
    font-weight: 600;
    font-size: 15px;
    width: 80%;
    margin-top: 20px;
    border-radius: 3px;
}   
</style>
	
	
</head>

<body <?php body_class(); ?>>

	<div class="site-wrapper">	

		<div class="hover_overlay_body"></div>

		<?php if (get_post_meta( getbowtied_page_id(), 'header_meta_box_check', true ) != 'off'): ?>

			<?php if ( 1 == GBT_Opt::getOption('topbar_toggle') ) : ?>
				<?php get_template_part( 'template-parts/headers/header-topbar' ) ?>
			<?php endif; ?>
			
			<?php get_template_part( 'template-parts/headers/header', GBT_Opt::getOption('header_template') ) ?>

			<div class="sticky_header_placeholder">

				<?php if ( ( 1 == GBT_Opt::getOption('header_sticky_topbar') ) && ( 1 == GBT_Opt::getOption('topbar_toggle') ) ) : ?>
				
					<?php get_template_part( 'template-parts/headers/header-topbar' ) ?>

				<?php endif; ?>

				<?php if ( 1 == GBT_Opt::getOption('header_sticky_visibility') ) : ?>

					<?php if (GETBOWTIED_WOOCOMMERCE_IS_ACTIVE) { ?>

						<?php if ( is_single() && !is_product() ) { ?>

							<?php get_template_part( 'template-parts/headers/header-sticky-blog' ) ?>

						<?php } elseif ( is_product() ) { ?>

							<?php get_template_part( 'template-parts/headers/header-sticky-product' ) ?>

						<?php } else { ?>

							<?php //get_template_part( 'template-parts/headers/header-sticky') ?>
							<?php get_template_part( 'template-parts/headers/header-sticky', GBT_Opt::getOption('header_template') ) ?>

						<?php } ?>

					<?php } else { ?>

						<?php if ( 'post' == get_post_type() ) { ?>

							<?php get_template_part( 'template-parts/headers/header-sticky-blog' ) ?>

						<?php } else { ?>

							<?php //get_template_part( 'template-parts/headers/header-sticky') ?>
							<?php get_template_part( 'template-parts/headers/header-sticky', GBT_Opt::getOption('header_template') ) ?>

						<?php } ?>

					<?php } ?>

				<?php endif; ?>

			</div>

			<?php get_template_part( 'template-parts/headers/header-mobiles' ) ?>

		<?php endif; ?>

		<div class="site-content-wrapper">
			
<?php if (!is_front_page()): ?>
    <div class="row top-marg">
        <?php if(function_exists('kama_breadcrumbs')) kama_breadcrumbs(' » '); ?>
    </div>
<?php endif; ?>