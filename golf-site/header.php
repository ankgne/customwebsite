<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Templatemela
 * @since Templatemela 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_option('tmoption_favicon_icon');?>" />		
	<?php templatemela_header(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="">
<?php if ( get_option('tmoption_control_panel') == 'yes' ) do_action('tm_show_panel'); ?>
	<div id="page" class="hfeed site">
	<?php templatemela_header_before(); ?>
		<header id="masthead" class="site-header" role="banner">
			<!-- Start header-main -->
			<div class="header-main">
				<!-- Start header-top -->
				<div class="header-top">
				
					<div class="home-link logo">											
						<?php if (get_option('tmoption_logo_image') != '') : ?>
							<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">	
								<?php tm_get_logo(); ?>
							</a>
						<div class="contact-header-menu">
							<?php templatemela_get_widget('header-contact'); ?>	
						</div>	
						<?php
						$tm_contact_header_menu =array(
						'menu' => 'TM Header Top Links',
						'depth'=> 1,
						'echo' => false,
						'menu_class'      => 'contact-header-menu', 
						'container'       => '', 
						'container_class' => '', 
						'theme_location' => 'contact-header-menu'
						);
						echo wp_nav_menu($tm_contact_header_menu);				    
						?>	
						
						<?php else: ?>
						<h1 class="site-title">
							<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">	
								<strong><?php bloginfo( 'name' ); ?></strong>
							</a>
						</h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php endif; ?>
					</div>	
										
					
					
					<?php templatemela_header_inside(); ?>
						
				</div><!-- End header-top -->
				
				<!-- Start header-middle -->
				<div class="header-middle">
				
					<!--Start header-middle-top -->
					<div class="header-middle-top">		
						<?php templatemela_get_widget('header-search'); ?>								
					</div><!--End header-middle-top -->	
				
					<!--Start header-middle-bottom -->
					<div class="header-middle-bottom">	
							<?php 
							// Woo commerce Header Cart
							if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
							<div class="header_cart"><!-- Start header cart -->
								<div class="togg">
									<?php global $woocommerce;
									ob_start();?>						
									<a id="shopping_cart" class="shopping_cart tog" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"> <?php _e( 'Cart', 'templatemela' ); ?>
										<span class="item-total">
											<?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>
										</span> 
									</a>	
									<?php templatemela_get_widget('header-widget'); ?>		
								</div>	
							</div>							
							<?php endif; ?>	
					</div><!--End header-middle-bottom -->
					
				</div><!-- End header-middle -->	
			</div><!-- End header-main -->		
			
		</header><!-- #masthead -->
		<?php templatemela_header_after(); ?>
		<div class="site-top">
			<div class="top_main">
				<!-- Start header-bottom -->		
				<div id="navbar" class="header-bottom navbar default">
					<nav id="site-navigation" class="navigation main-navigation" role="navigation">
						<h3 class="menu-toggle"><?php _e( 'Menu', 'templatemela' ); ?></h3>
						<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'templatemela' ); ?>"><?php _e( 'Skip to content', 'templatemela' ); ?></a>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'before' => '<span></span>' ) ); ?>
						
					</nav><!-- #site-navigation -->
				</div><!-- End header-bottom #navbar -->	
		<?php if (! is_front_page()) : ?>		
		<div class="Custom-Head">
		<span class="golf-contact-image">
		<?php echo '<img alt="'.get_option('tmoption_logo_image_alt').'" src=" '.get_stylesheet_directory_uri(). '/images/info_questionsCallNow.png">'; ?> </span>
			<?php if ( !is_user_logged_in() ) {?>
			<div class="golf-page-subscribe">
			<span class="subscribetext">Sign up for Special Information, Specials and Products</span>
			<?php } ?>
			<span class="subscribe"><?php  echo do_shortcode('[subscribe2 wrap="false" hide="unsubscribe" ]'); ?> </span>
			</div>
		</div>
		<?php endif; ?>

			</div>	
			<?php if (is_page_template('page-templates/home.php') || is_page_template('page-templates/home golf.php') ) : ?>		
				<div id="top-area">
					<div class="top-area-inner">
						<?php front_page_accordion() ?>
						<div class="home-topbanner">
							<?php templatemela_get_widget('homepage-top-banners-area');?>
						</div>
					</div>
				</div>			
			<?php endif; ?>
			<?php if (is_page_template('page-templates/home.php') ) : ?>		
				<div id="top-area">
					<div class="top-area-inner">
						<?php include_once(TEMPLATEPATH . '/slider.php'); ?>
						<div class="home-topbanner">
							<?php templatemela_get_widget('homepage-top-banners-area');?>
						</div>
					</div>
				</div>			
			<?php endif; ?>	
		</div>		
		<?php templatemela_main_before(); ?>

	<?php if ( 'page' == get_option('show_on_front') && is_front_page() ) :?>
	<div class="homepage">
	<?php endif; ?>
	<div id="main" class="site-main">	
		<div class="content-main">
		<?php templatemela_content_before(); ?>