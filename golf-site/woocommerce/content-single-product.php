<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>

	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
	
	<?php	
	$sShippingPage = get_page_by_path('test-ankur');
	$sShippingPage_id = $sShippingPage->ID;
	$sShippingPage_post_content = get_post($sShippingPage_id); 
	$content = $sShippingPage_post_content->post_content;
	$content = apply_filters('the_content', $content);
	?>
	
	<div class="product_Icon_buttons">
		<span style="margin-left:6.5%;">
			<!--<a class="popup" href="http://localhost/wordpress/?page_id=3332"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/icon_inStock_shipTime.png" border="0"></a> -->
			<a class="simple-ajax-popup-align-top" href="http://ww2.superswingtrainer.com/shipping-time/"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/icon_inStock_shipTime.png" border="0"></a>
		</span>
		<span class="WorriesShipping">
			<a href="#tab-additional_information"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/icon_inStock_noWorriesShipping.png" alt="No worry shipping" border="0"></a>
		</span>
		<span class="ShipCanda" title="$99 Additional">
			<a  href="#"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/icon_shipToCanada.png" alt="Ship to Canada" border="0"></a>
		</span>
		<span>
			<a class="Golf-Image"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/icon_inStock_asPictured.png" alt="As pictured" border="0"></a>
		</span>
		<span class="USAFlag">
			<a ><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/icon_madeUSA.png" alt="Made in USA" border="0"></a>
		</span>
	</div>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
