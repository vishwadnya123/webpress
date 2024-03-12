<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ct-custom' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="topbar">
		<div class="container">
		<div class="lefttopbar"><span class="brown">Call us now!</span><a class="white" href="tel:<?php 
		$value = ct_custom_get_theme_option( 'phone_number' );
		echo esc_html($value);
		?>"><?php 
		$value = ct_custom_get_theme_option( 'phone_number' );
		echo esc_html($value);
		?></a>
		</div><div class="righttopbar"><a href="/" class="brown">LOGIN</a><a href="/" class="white">SIGNUP</a></div>
		</div>
		</div><!-- .topbar -->
		<div class="site-branding">
		<div class="container">
			<?php
			
			//COLORIZE FIRST WORD OR HALF WORD IN LOGO
			$blogstring = get_bloginfo('name');
			$center = floor(strlen($blogstring) / 2);	
			$blogname[0] = substr($blogstring, 0, $center);
			$blogname[1] = substr($blogstring, $center);
			if (has_custom_logo()) {
			the_custom_logo();
			}
			else if ( is_front_page() && is_home() ) :
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><h1><span class="dark"><?php echo esc_html($blogname[0]); ?></span><span class="orange"><?php echo esc_html($blogname[1]); ?></span></h1></a>
				<?php
			else :
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><span class="dark"><?php echo esc_html($blogname[0]); ?></span><span class="orange"><?php echo esc_html($blogname[1]); ?></span></a>
				<?php
			endif; ?>
		
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ct-custom' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->
		</div>
		</div><!-- .site-branding -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
	<div class="container">
