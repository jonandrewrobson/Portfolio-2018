<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package deppo
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'deppo' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">

			<?php if (has_custom_logo()) {
				?> <div class="custom-logo-wrapper"> <?php
				the_custom_logo();
				?> </div> <?php

			?> <div class="site-branding-text"> <?php
			} ?>
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>

			<?php if (has_custom_logo()) {
			?> </div> <?php
			} ?>
		</div><!-- .site-branding -->

		<div class="navigation-wrapper">
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle clear-button" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'deppo' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->

			<?php if ( is_active_sidebar('sidebar-1') ) { ?>
				<div class="sidebar-button">
					<button class="sidebar-toggle clear-button">
						<span class="screen-reader-text"><?php esc_html_e( 'open sidebar', 'deppo' ); ?></span>
						<span class="sidebar-icon">
							<i></i>
							<i></i>
							<i></i>
						</span>
					</button>
				</div>
			<?php }; ?>
		</div>
	</header><!-- #masthead -->

	<?php if ( function_exists( 'jetpack_social_menu' ) ) {
		if ( has_nav_menu( 'jetpack-social-menu' ) ) { ?>
		<!-- Social menu -->
		<div id="bigSocialWrap" class="social-wrapper">
			<?php deppo_social_menu(); ?>
		</div>
	<?php
		}
	}
	?>

	<div id="content" class="site-content">
