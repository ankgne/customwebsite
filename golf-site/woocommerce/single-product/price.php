<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
<div class="golf-price-container">
<?php echo $product->get_price_html(); ?>
</div>
<div class="golf-specs-container">
<a href="#tab-reviews"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/productInfo_spec_button.png" alt="Specs and Dimensions" border="0"></a>
<a href="#contact_form_pop1" class="fancybox"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/productInfo_question_button.png" border="0"></a> 
			<div style="display:none" class="fancybox-hidden">
				<div id="contact_form_pop1">
        		<?php echo do_shortcode ('[contact-form-7 id="3233" title="Contact form 1"]'); ?>
				</div>
			</div>               
</div>	

	<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>