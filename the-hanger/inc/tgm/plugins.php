<?php


function getbowtied_theme_register_required_plugins() {

  $plugins = array(
      'woocommerce' => array(
        'name'               => 'WooCommerce',
        'slug'               => 'woocommerce',
        'required'           => false,
        'description'        => 'The eCommerce engine',
        'demo_required'      => true
      ),
      'js_composer' => array(
          'name'               => 'WPBakery Page Builder',
          'slug'               => 'js_composer',
          'source'             => get_template_directory() . '/inc/plugins/js_composer.zip',
          'required'           => false,
          'external_url'       => '',
          'description'        => '#1 WordPress Page Builder Plugin',
          'demo_required'      => true,
          'version'            => '5.6'
        ),
        'one-click-demo-import'=> array(
          'name'               => 'One Click Demo Import',
          'slug'               => 'one-click-demo-import',
          'required'           => false,
          'description'        => 'Import your demo content, widgets and theme settings with one click.',
          'demo_required'      => true
        ),
        'envato-market'        => array(
          'name'               => 'Envato Market',
          'slug'               => 'envato-market',
          'required'           => false,
          'demo_required'      => false,
          'source'             => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
          'description'        => 'Automatically update your Envato theme',
          'demo_required'      => true
        ),
        'the-hanger-extender' => array(
          'name'               => 'The Hanger Extender',
          'slug'               => 'the-hanger-extender',
          'source'             => 'https://github.com/getbowtied/the-hanger-extender/zipball/master',
          'required'           => true,
          'external_url'       => 'https://github.com/getbowtied/the-hanger-extender',
          'description'        => 'Extends the functionality of The Hanger with theme specific shortcodes and page builder elements.',
          'demo_required'      => true,
          'version'            => '1.5'
        ),
      );

	$config = array(
	   'id'               => 'the-hanger',
		'default_path'      => '',
		'parent_slug'       => 'themes.php',
		'menu'              => 'tgmpa-install-plugins',
		'has_notices'       => false,
		'is_automatic'      => true,
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'getbowtied_theme_register_required_plugins' );


