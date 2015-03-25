<?php
/* Template Name: Golf Cart Page */
?>
<?php get_header(); ?>
	<!--Start full-width-->
	<div class="full-width">
		<div id="primary" class="content-area">
		<?php breadcrumbs(); ?>
		<div id="content" class="site-content" role="main">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php $checkout_url = WC()->cart->get_checkout_url(); ?>
				
					<form id="golf-clear-cart-form" action="<?php echo esc_url( golf_clear_cart_url() ); ?>" method="post">
					<div class="golf-checkout-top-container">
						<a class="golf-clear-cart" href="#" >Empty My Shopping Cart</a>
						
						<a class="wc-backward golf-cart-continue" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ); ?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/button_continueShopping.png" alt="Continue Shopping"></a>
						
						<a class="checkout-button wc-forward golf-cart-checkout" href="
						<?php 
							$nonce = wp_create_nonce( 'golf-cc-nounce' );
							$checkout_url = WC()->cart->get_checkout_url();
							$checkout_url = add_query_arg( array('golf-payment-method' => 'CC','_wpnonce' => $nonce), $checkout_url );
							echo $checkout_url; ?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/button_checkout.png" alt="Secure Checkoutg"></a>
						
						<input type="hidden" name="clear-cart" />
					</div>		
					</form>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header page-title">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title page-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'templatemela' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						<div class="golf-cart-sidebar">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/SecureSite.jpg" alt="Equifax Secure Site">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/secureLogo_ssl.jpg" alt="SSL Encryption Protection">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/secureLogo_geoTrust.jpg" alt="Secured by Geotrust">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/secureLogo_bbb.png" alt="100% Accredited by the Better Business Bureau">
						</div>	
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'templatemela' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php //comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	</div><!-- End full-width -->

<?php get_footer(); ?>