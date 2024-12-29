<?php


	require_once( get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php' );
	require_once( get_template_directory() . '/inc/tgm/plugins.php' );
	require_once( get_template_directory() . '/inc/admin/wizard/class-gbt-helpers.php' );
	require_once( get_template_directory() . '/inc/admin/wizard/class-gbt-install-wizard.php' );





	require_once(get_template_directory() . '/inc/demo/ocdi-setup.php');

	/**
	 * On theme activation redirect to splash page
	 */
	global $pagenow;

	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

		wp_redirect(admin_url("themes.php?page=gbt-setup")); // Your admin page URL
		
	}