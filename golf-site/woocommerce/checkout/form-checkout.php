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
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );
$available_gateways = WC()->payment_gateways()->get_available_payment_gateways(); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">
<?php if ( isset( $_GET['golf-payment-method'] ) && ("CC"===$_GET['golf-payment-method'])) {?>
	<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

		<?php if ( $checkout->enable_guest_checkout ) : ?>

			<p class="form-row form-row-wide create-account">
				<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
			</p>

		<?php endif; ?>
		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

			<div class="create-account golf-credit-card">

				<?php _e( '<h3>New Customers</h3>', 'woocommerce' ); ?>

				<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php endforeach; ?>

				<div class="clear"></div>

			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>	

	<?php endif; ?>	
<?php 
		if (in_array("golf_credit_card", $available_gateways)){ // if credit card extension plugin is activated
			$available_gateways['golf_credit_card']->chosen=true; /*secure checkout*/
		}
		?>
			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div class="col2-set" id="	">
					<div class="col-1 golf-credit-card">
						<?php //do_action( 'woocommerce_checkout_billing' ); ?>
						<?php wc_get_template( 'checkout/form-billing-cc.php', array( 'checkout' => $checkout ) ); ?>
					</div>

					<div class="col-2 golf-credit-card">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<h3 id="order_review_heading" class="golf-credit-card-review-order"><?php _e( 'Your order', 'woocommerce' ); ?></h3>

			<?php endif; ?>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order golf-credit-card-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	</fieldset>	
</form>

			<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<?php 
} ?>
	

	<?php
/* if request has come from paypal checkout button then set paypal as the default payment gateway*/  
	if ( isset( $_GET['golf-payment-method'] ) && ("paypal"===$_GET['golf-payment-method'])){
			$available_gateways['paypal']->chosen=true; /*set paypal as selected payment gateway*/
?>
		<fieldset>
			<?php if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) { ?>
				<legend class="return-customer">Your Account Information</legend>
			<?php }else{ ?>
				<legend class="return-customer">New? Please Provide Your Shipping Information</legend>
				<?php 
					$message="Create a login profile with <span>Super Swing Trainer</span> which allows you to shop faster, track the status of your current orders and review your previous orders.";
					echo wpautop( wptexturize( $message ));
			}?>	
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
<?php	} ?>

