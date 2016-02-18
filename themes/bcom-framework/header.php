<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package BCom
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'bcom' ); ?></a>

	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$("#menu-mobile").hide();
			$(".mtoggle").click(function () {
				$("#menu-mobile").slideToggle(500);
			});
		});
	</script>

	<nav id="mobile">

		<div id="toggle-bar">
			<strong><a class="mtoggle" href="#">MENU</a></strong>
			<a id="navicon" class="navicon mtoggle" href="#">MENU</a>
		</div>
		<?php wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu_class'     => 'nav-menu',
			'menu_id'        => 'menu-mobile',
			'container'      => false,
		) ); ?>

	</nav>

	<header role="banner">
		<div class="container">
			<div class="site-branding">
				<h1 class="site-title"><a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"
				                          rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<div class="site-description"><?php bloginfo( 'description' ); ?></div>
			</div><!-- .site-branding -->
		</div><!-- .container -->
	</header><!-- header -->


	<nav id="full" class="primary-navigation" role="navigation">
		<div class="container">
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_class'     => 'nav-menu-full',
				'menu_id'        => 'menu-full',
			) ); ?>
		</div>
	</nav><!-- .primary-navigation -->

	<section class="main container">
