<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Konnichi An
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
<div id="page" class="hfeed site mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'konnichi_an' ); ?></a>

	<header id="masthead" class="site-header mdl-layout__header mdl-layout__header--transparent" role="banner">
			<div class="mdl-layout__header-row">
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="mdl-layout-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="mdl-layout-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>
				<!-- .site-title -->
				<div class="mdl-layout-spacer"></div>
				<!-- @TODO:Add Search Form -->
				<form>
					<input type="text" value="" placeholder="Sample Search">
				</form>
		</div>
	</header><!-- #masthead -->

	<nav class="mdl-layout__drawer">
	  <h2 class="mdl-layout-title">Title</h2>
		<div id="site-navigation" class="mdl-navigation" role="navigation">
			<?php
				$arg = array(
					'theme_location' => 'primary',
					'menu_id' => 'primary-menu',
					'items_wrap' => '%3$s',
					'container' => '',
					'fallback_cb' => konnichi_an_empty_menu,
					'walker'      => new MdlMenu
				);
				wp_nav_menu($arg);
			?>
		</div><!-- #site-navigation -->
	</nav>


	<p class="site-description"><?php bloginfo( 'description' ); ?></p>

	<main id="content" class="site-content mdl-layout__content">
