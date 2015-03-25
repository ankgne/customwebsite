<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">
	<fieldset>
	<?php if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) { ?>
		<legend class="return-customer">Your Account Information</legend>
	<?php }else{ ?>
		<legend class="return-customer">New? Please Provide Your Shipping Information</legend>
		<?php 
			$message="Create a login profile with <span>Super Swing Trainer</span> which allows you to shop faster, track the status of your current orders and review your previous orders.";
			echo wpautop( wptexturize( $message ));
	}?>	
	<?php
/* if request has come from paypal checkout button then set paypal as the default payment gateway*/  
	if ( isset( $_GET['golf-payment-method'] ) && ("paypal"===$_GET['golf-payment-method'])){
			$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
			$available_gateways['paypal']->chosen=true; /*set paypal as selected payment gateway*/
	?>
			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				
				<div class="col-2">
					<?php wc_get_template( 'checkout/form-shipping-paypal.php', array( 'checkout' => $checkout ) ); ?>
				</div>
				
				<div class="col-1">
						<?php wc_get_template( 'checkout/form-billing-paypal.php', array( 'checkout' => $checkout ) ); ?>
				</div>
				
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>

			<?php endif; ?>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>
		
		

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	</fieldset>	
</form>

	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<?php	}else{ 
			$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
			if (in_array("golf_credit_card", $available_gateways)){ // if credit card extension plugin is activated
				$available_gateways['golf_credit_card']->chosen=true; /*secure checkout*/
			}
		?>
			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div class="col2-set" id="	">
					<div class="col-1">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
					</div>

					<div class="col-2">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>

			<?php endif; ?>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>
		
		

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	</fieldset>	
</form>

	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<?php	}

