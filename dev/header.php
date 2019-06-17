<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wprig
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php if ( ! wprig_is_amp() ) : ?>
		<script>document.documentElement.classList.remove("no-js");</script>
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'woocommerce' ); ?>>
<div class="body-overlay" aria-hidden="true"></div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wprig' ); ?></a>
		<header id="masthead" class="site-header">
			<div class="top-header is-paddingless">
				<div class="navbar is-transparent">
					<div class="container">
						<div class="navbar-end">
							<?php if ( is_user_logged_in() ) : ?>
								<a class="navbar-item" href="<?php echo esc_url( home_url( '/my-account/favorite-ads' ) ); ?>">Wishlist</a>
								<a class="navbar-item" href="<?php echo esc_url( home_url( '/my-account' ) ); ?>">Dashboard</a>
							<?php else : ?>
								<a class="navbar-item" href="<?php echo esc_url( home_url( '/my-account' ) ); ?>">Login</a>
								<a class="navbar-item" href="<?php echo esc_url( home_url( '/register' ) ); ?>">Register</a>
							<?php endif; ?>
							<a href="<?php echo esc_url( home_url( '/cart' ) ); ?>" class="navbar-item cart-icon" title="Go to your cart">
								<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
								<i class="fas fa-shopping-cart"></i>
							</a>
							<a href="#" class="navbar-item">
								<i class="fab fa-facebook-f"></i>
							</a>
							<a href="" class="navbar-item">
								<i class="fab fa-twitter"></i>
							</a>
							<a href="https://www.instagram.com/petdeals.1/" class="navbar-item" target="_blank" title="Visit Our Instagram">
								<i class="fab fa-instagram"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="bottom-header">
					<nav id="left-navigation" class="left-navigation main-navigation" aria-label="<?php esc_attr_e( 'Left menu', 'wprig' ); ?>">
						<div class="left-menu-container">
							<?php

							wp_nav_menu(
								array(
									'theme_location' => 'left',
									'menu_id'        => 'left-menu',
									'container'      => 'ul',
								)
							);

							?>
						</div>
					</nav><!-- #left-navigation -->

					<div class="site-branding">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo esc_url( get_theme_file_uri( '/images/logo.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?> Logo">
						</a>
					</div><!-- .site-branding -->

					<nav id="right-navigation" class="right-navigation main-navigation" aria-label="<?php esc_attr_e( 'Right menu', 'wprig' ); ?>">
						<div class="right-menu-container">
							<?php

							wp_nav_menu(
								array(
									'theme_location' => 'right',
									'menu_id'        => 'right-menu',
									'container'      => 'ul',
								)
							);

							?>
						</div>
					</nav><!-- #right-navigation -->

					<nav id="mobile-navigation" class="mobile-navigation main-navigation" aria-label="<?php esc_attr_e( 'Main menu', 'wprig' ); ?>"
						<?php if ( wprig_is_amp() ) : ?>
							[class]=" siteNavigationMenu.expanded ? 'main-navigation toggled-on' : 'main-navigation' "
						<?php endif; ?>
					>
						<?php if ( wprig_is_amp() ) : ?>
							<amp-state id="siteNavigationMenu">
								<script type="application/json">
									{
										"expanded": false
									}
								</script>
							</amp-state>
						<?php endif; ?>

						<button class="menu-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'wprig' ); ?>" aria-controls="primary-menu" aria-expanded="false"
							<?php if ( wprig_is_amp() ) : ?>
								on="tap:AMP.setState( { siteNavigationMenu: { expanded: ! siteNavigationMenu.expanded } } )"
								[aria-expanded]="siteNavigationMenu.expanded ? 'true' : 'false'"
							<?php endif; ?>
						>
							<svg x="0" y="0" viewBox="0 0 24 18" class="icon white">
								<rect width="24" height="2"></rect>
								<rect y="8" width="24" height="2"></rect>
								<rect y="16" width="24" height="2"></rect>
							</svg>
						</button>

						<div class="mobile-menu-container">
							<?php

							wp_nav_menu(
								array(
									'theme_location' => 'mobile',
									'menu_id'        => 'mobile-menu',
									'container'      => 'ul',
								)
							);

							?>
						</div>
					</nav><!-- #mobile-navigation -->
				</div>
			</div>

		</header><!-- #masthead -->
