<header class="site-header-style-1 header-sticky">

	<div class="row small-collapse">
		
		<div class="small-12 columns">

			<div class="header-content">

				<div class="header-line-2">

					<div class="row align-middle">
					 
						<div class="small-12 columns">

							<div class="header-navigation-wrapper <?php echo (GBT_Opt::getOption('mega_dropdown_toggle', 1) == 1) ? 'with-mega-button' : ''; ?>">

								<div class="header-branding site-secondary-font">
													
									<?php if ( ! empty( GBT_Opt::getOption('header_logo') ) ) : ?>
										
										<div class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( GBT_Opt::getOption('header_logo') ); ?>" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>"></a></div>
									
									<?php else : ?>

										<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></div>

									<?php endif; ?>

								</div>

								<div class="header-navigation">
									
									<nav class="navigation-foundation">
										<?php 
											wp_nav_menu(array(
												'theme_location'    => 'gbt_primary',
												'container'         => false,
												'menu_class'        => 'gbt-sticky dropdown menu site-secondary-font',
												'items_wrap'        => '<ul id="%1$s" class="%2$s" data-dropdown-menu data-hover-delay="250" data-closing-time="250">%3$s</ul>',
												'link_before'       => '<span>',
												'link_after'        => '</span>',
												'fallback_cb'     	=> 'Foundation_Dropdown_Menu_Fallback',
												'walker'            => new Foundation_Dropdown_Menu_Walker(),
											));
										?>
									</nav>

									<div class="header-megamenu-placeholder">
										<?php do_action('sticky-getbowtied_megamenu'); ?>
									</div>

								</div>

								<div class="header-secondary-navigation">
									
									<nav class="navigation-foundation">
										<?php 
											wp_nav_menu(array(
												'theme_location'    => 'gbt_secondary',
												'container'         => false,
												'menu_class'        => 'dropdown menu',
												'items_wrap'        => '<ul id="%1$s" class="%2$s" data-dropdown-menu data-hover-delay="250" data-closing-time="250">%3$s</ul>',
												'link_before'       => '<span>',
												'link_after'        => '</span>',
												'fallback_cb'     	=> 'Foundation_Dropdown_Menu_Fallback',
												'walker'            => new Foundation_Dropdown_Menu_Walker(),
											));
										?>
									</nav>

								</div>

<?/* ?>
								<ul class="header-tools">

									<?php if ( GBT_Opt::getOption('header_search_toggle') == 1 ) : ?>
										<li class="header-search">
											<a>
												<i class="thehanger-icons-search"></i>
											</a>
										</li>
									<?php endif; ?>

									<?php if ( GETBOWTIED_WOOCOMMERCE_IS_ACTIVE ) : ?>
									<?php if ( GBT_Opt::getOption('header_user_account') == 1 ) : ?>
										<li class="header-account">
											<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
												<i class="thehanger-icons-account"></i>
											</a>
										</li>
									<?php endif; ?>
									<?php endif; ?>

									<?php if ( GETBOWTIED_WISHLIST_IS_ACTIVE ) : ?>
									<?php if ( GBT_Opt::getOption('header_wishlist') == 1 ) : ?>
										<li class="header-wishlist">
											<a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>">
												<i class="thehanger-icons-wishlist"></i>
												<div class="tools_badge wishlist_items_number"><?php echo yith_wcwl_count_products(); ?></div>
											</a>
										</li>
									<?php endif; ?>
									<?php endif; ?>

									<?php if ( GETBOWTIED_WOOCOMMERCE_IS_ACTIVE ) : ?>
									<?php if ( GBT_Opt::getOption('header_cart') == 1 ) : ?>
										<li class="header-cart">
											<a href="<?php echo esc_url(wc_get_cart_url()); ?>" data-toggle="header-sticky-minicart">
												<i class="thehanger-icons-shopping-bag"></i>
												<div class="tools_badge shopping_bag_items_number"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></div>
											</a>
											<?php if( !is_cart() && !is_checkout() ) : ?>
												<div class="header-minicart-placeholder">
													<div class="dropdown-pane minicart" id="header-sticky-minicart" data-dropdown data-hover="true" data-hover-pane="true" data-alignment="right">
														<?php if ( class_exists( 'WC_Widget_Cart' ) ) { the_widget( 'WC_Widget_Cart' ); } ?>
														<div class="minicart_infos"><?php echo GBT_Opt::getOption('header_cart_info'); ?></div>
													</div>
												</div>
											<?php endif; ?>
										</li>
									<?php endif; ?>
									<?php endif; ?>

								</ul>
<? */ ?>


							</div>

						</div>

					</div>

				</div>

				<?php if ( GBT_Opt::getOption('mega_dropdown_toggle', 1) == 1) : ?>

				<div class="header-line-3">

					<div class="gbt-mega-dropdown-wrapper">								
							
						<div class="gbt-mega-dropdown">								
							
							<a class="gbt-mega-dropdown-button site-secondary-font">
								<i class="thehanger-icons-hamburger"></i>&nbsp;
							</a>

							<div class="row">

								<div class="small-12 large-3 columns">
									<?php if (GBT_Opt::getOption('header_template') == 'style-1'): ?>
										<?php getbowtied_mega_dropdown_action_output(true); ?>
									<?php endif; ?>
								</div>

								<div class="small-12 large-9 columns gbt-mega-dropdown-megamenu-offset">
									<div class="gbt-mega-dropdown-megamenu-placeholder">
										<?php do_action('sticky-dropdown-getbowtied_mega_dropdown_megamenu_action'); ?>
									</div>
								</div>

							</div>

						</div>

					</div>

				</div>

				<?php endif; ?>

			</div>

			<div class="shop_header_placeholder"></div>

		</div>

	</div>

</header>