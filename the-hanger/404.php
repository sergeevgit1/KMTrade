<?php get_header(); ?>

	<div class="row small-collapse">

		<div class="small-12 columns">

			<div class="site-content">

				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Данная страница не существует!', 'the-hanger' ); ?></h1>
					</header>

					<div class="page-content">
						<div class="error-404-description">Вы можете <a href="/">перейти на главную страницу сайта</a></div>
						<div class="error-404-searchform"><?php get_search_form(); ?></div>
					</div>
				</section>
				
			</div>

		</div>

	</div>

<?php
get_footer();
