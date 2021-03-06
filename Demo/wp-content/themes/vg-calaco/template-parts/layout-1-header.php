<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package VG Calaco
 */

// Get Theme Options Values
$vg_calaco_options = get_option("vg_calaco_options");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (isset($vg_calaco_options['theme_loading']) && $vg_calaco_options['theme_loading']) : ?>
<div id="pageloader">
	<div id="loader"></div>
	<div class="loader-section left"></div>
	<div class="loader-section right"></div>
</div>
<?php endif; ?>
<div class="vg-website-wrapper">
	<div class="vg-pusher">
		<div class="vg-pusher-after"></div> <!-- Don't REMOVE this code -->
		
		<header id="vg-header-wrapper">
			<?php if(isset($vg_calaco_options["top_bar_switch"]) && !empty($vg_calaco_options["top_bar_switch"])): ?>
			<div class="top-bar">
				<div class="container">
					<div class="row">
						<?php if(is_active_sidebar('topbar-1')) : ?>
							<div class="col-md-<?php echo(is_active_sidebar('topbar-2')) ? '6' : '12 text-center'; ?> col-xs-12 col-sm-6 col-topbar">
								<?php dynamic_sidebar('topbar-1'); ?>
							</div><!-- End Top Bar 01 Widget -->
						<?php endif;?>
						
						<?php if(is_active_sidebar('topbar-2')) : ?>
							<div class="col-md-<?php echo(is_active_sidebar('topbar-1')) ? '6 text-right' : '12 text-center'; ?> col-xs-12 col-sm-6 col-topbar">
								<a href="#" class="menu-top visible-small"><i class="ti-user user-trigger"></i></a>
								<?php dynamic_sidebar('topbar-2'); ?>
							</div><!-- End Top Bar 02 Widget -->
						<?php endif;?>
						
					</div>
				</div>
			</div><!-- End top-bar -->
			<?php endif; ?>
			
			<div class="header">
				<div class="container">
					<div class="row">
						<?php vg_calaco_display_logo_sticky(); ?>
						<div id="logo-wrapper" class="col-xs-12 <?php echo(is_active_sidebar('vg-woo-header') || is_active_sidebar('vg-search-widget')) ? 'col-md-3' : 'col-md-12 logo-center';?> col-sm-4">
							<div class="logo-inside">
							<a href="http://viewourdemo.com/corpattire/" rel="home"><img class="site-logo" src="http://viewourdemo.com/corpattire/wp-content/uploads/2019/10/logo_new_full.jpg" alt="The Corpattire"></a>
							</div>
						</div><!-- End site-logo -->
						
						<?php if(is_active_sidebar('vg-search-widget')) : ?>
							<div class="col-xs-12 col-md-<?php echo(is_active_sidebar('vg-woo-header')) ? 6 : 9; ?> col-sm-8 search-wrap">
								<span class="search-toggle"><i class="zmdi zmdi-search"></i></span>
								<div class="search-inside">
									<div class="search-popup-bg"></div>
									<?php dynamic_sidebar('vg-search-widget'); ?>
								</div>
							</div><!-- End VG Search Widget -->
						<?php endif;?>
						
						<?php if(is_active_sidebar('vg-woo-header')) : ?>
						<div class="col-xs-12 col-md-<?php echo(is_active_sidebar('vg-search-widget')) ? 3 : 6; ?> col-sm-4 ecommerce-wrap">
							<div class="ecommerce-inside">
								<?php dynamic_sidebar('vg-woo-header'); ?>
							</div>
						</div><!-- End VG Woocommerce Header Widget -->
						<?php endif;?>
					</div>
				</div>
			</div><!-- End Header Container -->
			
			<div class="vg-bottom-bar">
				<div class="container">
					<div class="row">
						<div id="navigation" class="col-xs-12 col-md-12 col-sm-8">
							<div class="site-navigation visible-lg">
								<nav class="main-navigation default-navigation align_center">
									<?php
										$walker = new rc_scm_walker;
										wp_nav_menu(array(
											'theme_location'  => 'primary',
											'fallback_cb'     => false,
											'container'       => false,
											'items_wrap'      => '<ul class="%1$s">%3$s</ul>',
											'walker' 		  => $walker
										));
									?>
								</nav><!-- .main-navigation -->
							</div><!-- End site-navigation -->
							
							<div class="responsive-navigation visible-xs">
								<ul>
									<li class="offcanvas-menu-button">
										<a class="tools_button">
											<span class="menu-button-text"><?php esc_html_e('Menu', 'vg-calaco'); ?></span>
											<span class="tools_button_icon">
												<i class="fa fa-bars"></i>
											</span>
										</a>
									</li>
								</ul>
							</div><!-- End mobile-navigation -->
						</div><!-- End #navigation -->
					</div>
				</div>
			</div><!-- End vg-bottom-bar -->
		</header>