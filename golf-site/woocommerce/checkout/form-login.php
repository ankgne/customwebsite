<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}
?>

<?php
if( 'paypal'=== $_GET['golf-payment-method']){ // create url for login button on checkout page
	$checkout_url = WC()->cart->get_checkout_url();
	$checkout_url = add_query_arg( array('golf-payment-method' => 'paypal'), $checkout_url );
	$message='If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.';
}
if( 'CC'=== $_GET['golf-payment-method']){
	$checkout_url = WC()->cart->get_checkout_url();
	$checkout_url = add_query_arg( array('golf-payment-method' => 'CC'), $checkout_url );
	$message='<h3>Existing Customers</h3>';
}

woocommerce_login_form(
		array(
			'message'  => $message,
			'redirect' => $checkout_url,
			//'redirect' => wc_get_page_permalink( 'checkout' ),
			'hidden'   => false
		)
	);
?>
