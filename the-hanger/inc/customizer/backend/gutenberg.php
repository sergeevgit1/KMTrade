<?php

if ( !function_exists ('thehanger_custom_gutenberg_styles') ) {
	function thehanger_custom_gutenberg_styles() {

		global $shopkeeper_theme_options, $default_fonts, $current_screen;

		ob_start();	

		?>

		<style>

		.edit-post-visual-editor h1,
		.edit-post-visual-editor h2,
		.edit-post-visual-editor h3,
		.edit-post-visual-editor h4,
		.edit-post-visual-editor h5,
		.edit-post-visual-editor h6,
		.edit-post-visual-editor blockquote,
		.edit-post-visual-editor button,
		.edit-post-visual-editor input[type="submit"],
		.edit-post-visual-editor thead,
		.edit-post-visual-editor th,
		.edit-post-visual-editor label,
		.editor-post-title__block .editor-post-title__input,
		.edit-post-visual-editor p.wp-block-cover-text,
		.edit-post-visual-editor .wp-block-pullquote p,
		.edit-post-visual-editor .wp-block-quote p,
		.edit-post-visual-editor p.gbt_18_th_editor_slide_description_input,
		.gbt_18_th_editor_posts_grid_title
		{
			font-family: 
			<?php echo "'" . GBT_Opt::getOption('secondary_font')['font-family'] . "'," ?>
			sans-serif;
		}

		.edit-post-visual-editor p,
		.edit-post-visual-editor textarea,
		.wp-block-verse pre
		{ 
			font-family: 
			<?php echo "'" . GBT_Opt::getOption('main_font')['font-family'] . "'," ?>
			sans-serif;
		}

		</style>

		<?php

		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) { if(!empty($line)) $new_lines[] = trim($line); }

		$current_screen = get_current_screen();
		if ( method_exists($current_screen, 'is_block_editor') && $current_screen->is_block_editor() ) {
			wp_enqueue_style( 'getbowtied-default-fonts', get_template_directory_uri() . '/inc/fonts/default.css', false, getbowtied_theme_version(), 'all');
			echo implode($new_lines);
		}
	}
}
add_action( 'admin_head', 'thehanger_custom_gutenberg_styles' );