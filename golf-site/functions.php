<?php
/**Load all the jquery files */
function templatemela_load_scripts() {	
	wp_enqueue_script( 'jquery-jqtransform', get_template_directory_uri() . '/js/jquery.jqtransform.js', array(), '', true);
	wp_enqueue_script( 'jquery-jqtransform-script', get_template_directory_uri() . '/js/jquery.jqtransform.script.js', array(), '', true);
	wp_enqueue_script( 'jquery-custom-min', get_template_directory_uri() . '/js/jquery.custom.min.js', array(), '', true);
	wp_enqueue_script( 'carousel-min', get_template_directory_uri() . '/js/carousel.min.js', array(), '', true);
	wp_enqueue_script( 'megnor-min', get_template_directory_uri() . '/js/megnor.min.js', array(), '', true);
	wp_enqueue_script( 'custom',  get_template_directory_uri() . '/js/custom.js', array(), '', true);
	wp_enqueue_script( 'golf',  get_stylesheet_directory_uri() . '/js/golf.min.js', array(), '', true);
	wp_enqueue_script( 'imagelink', get_template_directory_uri() . '/js/imagelink.js', array(), '', true);
	wp_enqueue_script( 'jquery-formalize-min', get_template_directory_uri() . '/js/jquery.formalize.min.js', array(), '', true);
	wp_enqueue_script( 'respond-min', get_template_directory_uri() . '/js/respond.min.js', array(), '', true);	
	wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/js/jquery.validate.js', array(), '', true);	
	wp_enqueue_script( 'visuallightbox', get_template_directory_uri() . '/js/lightbox-2.6.min.js', array(), '', true);
	wp_enqueue_script( 'visuallightbox', get_template_directory_uri() . '/js/lightbox-2.6.min.js', array(), '', true);
	wp_enqueue_style( 'maginific-popup', get_stylesheet_directory_uri() . '/magnific_pop-up.css');
	wp_enqueue_script( 'maginific-popupjs', get_stylesheet_directory_uri() . '/js/Magnificpop-up.js', array(), '', true);
	?>
	
	<!--[if lt IE 9]>
	<?php wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '', true); ?>
	<![endif]-->
<?php }
?>
<?php 
function load_payment_jquery() {
	wp_deregister_script( 'jquery-payment' );
	wp_register_script ('jquery-payment', get_stylesheet_directory_uri(). '/js/jquery.payment.min.js', array( 'jquery' ), '1.2.1');
}
?>
<?php add_action( 'wp_enqueue_scripts', 'load_payment_jquery',9999 ); ?>


<?php
function my_s2_form($form) {
$form = str_replace('Your email:', '', $form);
return $form;
}

add_filter('s2_form', 'my_s2_form');
?>
<?php
/**Front page accordion*/
function front_page_accordion() {	
$sWelcome = get_field('welcome');
$sFeatures = get_field('features');
$sShipping = get_field('worry_free_shipping');
$sWarranty = get_field('lifetime_warranty');
$sQuestions = get_field('any_questions');
?>

<div class="woocommerce-tabs">
<div class="front-subscribe">
	<?php if ( !is_user_logged_in() ) {?>
		<span class="subscribetext">Sign up for Special Information, Specials and Products</span>
		<?php } ?>
		<span class="subscribe"><?php  echo do_shortcode('[subscribe2 wrap="false" hide="unsubscribe" ]'); ?> </span>
	</div>
	<div style="border-bottom: 1px solid rgb(194, 171, 149);">
	<ul class="tabs" >
		<?php if ( ! empty( $sWelcome ) ) { ?>
			<li class="welcome_tab active">
					<a href="#tab-welcome"><?php echo "Welcome"; ?></a>
			</li>
		<?php } ?>
		<?php if ( ! empty( $sFeatures ) ) { ?>
			<li class="features_tab">
					<a href="#tab-features"><?php echo "Features"; ?></a>
			</li>
		<?php } ?>
		<?php if ( ! empty( $sShipping ) ) { ?>
			<li class="shipping_tab">
					<a href="#tab-shipping"><?php echo "Worry Free Shipping"; ?></a>
			</li>
		<?php } ?>
		<?php if ( ! empty( $sWarranty ) ) { ?>
			<li class="warranty_tab active">
					<a href="#tab-warranty"><?php echo "Lifetime Warranty"; ?></a>
			</li>
		<?php } ?>
		<?php if ( ! empty( $sQuestions ) ) { ?>
			<li class="question_tab active">
					<a href="#tab-question"><?php echo "Any Questions"; ?></a>
			</li>
		<?php } ?>
	</ul>
	</div>
	<div class="panel entry-content" id="tab-welcome">
		<?php echo $sWelcome; ?>
	</div>
		
	<div class="panel entry-content" id="tab-features">
		<?php echo $sFeatures; ?>
	</div>

	<div class="panel entry-content" id="tab-shipping">
		<?php echo $sShipping; ?>
	</div>

	<div class="panel entry-content" id="tab-warranty">
		<?php echo $sWarranty; ?>
	</div>
	
	<div class="panel entry-content" id="tab-question">
		<?php echo $sQuestions; ?>
	</div>
</div>


<?php }
?>
<?php //remove related products, remove default woocommerce breadcrumbs and add yoast breadcrumbs
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_action( 'woocommerce_before_main_content','my_yoast_breadcrumb', 20, 0);
function my_yoast_breadcrumb (){
yoast_breadcrumb('<p id="breadcrumbs">','</p>');
}
?>
<?php 
add_filter( 'woocommerce_get_price_html', 'golf_price_html', 100, 2 );	
function golf_price_html( $price,$product ){
   // return $product->price;
    $from = $product->regular_price;
    $to = $product->price;
	$tax_display_mode      = get_option( 'woocommerce_tax_display_shop' );
   
   
   if (is_product()){ //Logic to be invoked for single product page only
    
	if ( $product->price > 0 ) {
	
      if ( $product->is_on_sale() && $product->get_regular_price() ) {
	  
		$save = $from - $to;
		
		if ($save > 0){
		
			return '<div class="golf-price"><span style="float:left">List Price:</span> <span class= "golf-retail-price">' . ( ( is_numeric( $from ) ) ? woocommerce_price( $from ) : $from ) . '</span></div> 
			<div class="golf-price"><span style="float:left">You Save:</span> <span class= "golf-retail-price">' . ( ( is_numeric( $save ) ) ? woocommerce_price( $save ) : $save ) . '</span></div>
			<div class="golf-price"><span class="golf-total">Total Price:</span> <span class="golf-total-price">' . ( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to ) . '</span></div>'
			;
		}
		else {
		
			return '<div class="golf-price"><span style="float:left">Our Price:</span> <span class= "golf-retail-price">' . ( ( is_numeric( $to ) ) ? woocommerce_price( $to ) : $to ) . '</span></div>';	
		}
	}
	  else {
	  
			return '<div class="golf-price"><span style="float:left">Our Price:</span> <span class= "golf-retail-price">' . ( ( is_numeric( $from ) ) ? woocommerce_price( $from ) : $from ) . '</span></div>';
			
		}
	} 
  } 
 if ( $product->get_price() > 0 ) {
   if ( $product->is_on_sale() && $product->get_regular_price() ) {
   
		return '<del>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . '</del> <ins>' . ( ( is_numeric( $to ) ) ? wc_price( $to ) : $to ) . '</ins>';
	
		}
   else {
   
		return wc_price( $from ) . $product->get_price_suffix();
	
		}
}
   elseif ( $product->get_price() === '' ) {

		return '';
		}
	elseif ( $product->get_price() == 0 ) {
	
			if ( $product->is_on_sale() && $product->get_regular_price() ) {

				return '<del>' . ( ( is_numeric( $from ) ) ? wc_price( $from ) : $from ) . '</del> <ins>' . "Free!" . '</ins>';
				//return "hello";
				
			} else {

				$price = __( 'Free!', 'woocommerce' );
				
				return $price;

			}
	
	}
}
?>
<?php
/*for changing sequence of summary on single page*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40 );
?>
<?php
function woocommerce_default_product_tabs( $tabs = array() ) {
		global $product, $post;

		// Description tab - shows product content
		if ( $post->post_content ) {
			$tabs['description'] = array(
				'title'    => __( 'Description', 'woocommerce' ),
				'priority' => 10,
				'callback' => 'woocommerce_product_description_tab'
			);
		}

				// Specification tab - shows attributes
		if ( $product && ( $product->enable_dimensions_display()) ) {
			$tabs['specification_information'] = array(
				'title'    => __( 'Specs / Dimensions', 'woocommerce' ),
				'priority' => 20,
				'callback' => 'woocommerce_product_specification_tab'
			);
		}
		
		// Additional information tab - shows attributes
		if ( $product && ( $product->has_attributes()  ) ) {
			$tabs['additional_information'] = array(
				'title'    => __( 'Additional Information', 'woocommerce' ),
				'priority' => 30,
				'callback' => 'woocommerce_product_additional_information_tab'
			);
		}

		// Reviews tab - shows comments
		if ( comments_open() ) {
			$tabs['reviews'] = array(
				'title'    => sprintf( __( 'Reviews (%d)', 'woocommerce' ), get_comments_number( $post->ID ) ),
				'priority' => 40,
				'callback' => 'comments_template'
			);
		}

		return $tabs;
	}
		function woocommerce_product_specification_tab() {
		wc_get_template( 'single-product/tabs/specifications.php' );
	}
?>
<?php
/*Added to empty the complete cart*/
add_action('init', 'golf_woocommerce_clear_cart_url');
function golf_woocommerce_clear_cart_url() {
	global $woocommerce;
	if( isset($_REQUEST['clear-cart']) && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'golf-woocommerce-cart' ) ) {
		$woocommerce->cart->empty_cart();
	}
}

function golf_clear_cart_url() {
	$cart_page_id = wc_get_page_id('cart');
	return apply_filters( 'woocommerce_get_remove_url', wp_nonce_url(get_permalink( $cart_page_id ) , 'golf-woocommerce-cart' ));
}	
?>
<?php
add_action( 'after_setup_theme', 'golf_add_image_sizes_checkout' );
function golf_add_image_sizes_checkout() {
	add_image_size( 'checkout_thumbnail', 100, 100, true);
}
?>
<?php
add_filter( 'woocommerce_cart_shipping_method_full_label', 'change_shipping_label', 10, 2 );
function change_shipping_label($full_label, $method){
//print_r ($method);

return $method->label;
}
?>
<?php
function woocommerce_button_proceed_to_checkout() {
	$nonce = wp_create_nonce( 'golf-paypal-nounce' );
	$checkout_url = WC()->cart->get_checkout_url();
	$checkout_url = add_query_arg( array('golf-payment-method' => 'paypal','_wpnonce' => $nonce), $checkout_url );
	?>
	<a class="checkout-button alt wc-forward golf-cart-paypal" href="<?php echo $checkout_url; ?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/button_paypal_checkout.png" alt="Paypal Checkout"></a>
	<?php
}
?>
<?php
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' ); 
function custom_override_checkout_fields( $fields ) {	
	if ( (isset( $_GET['golf-payment-method'] )|| isset($_POST['payment_method'])) && (("paypal"===$_GET['golf-payment-method']) || ("paypal"===$_POST['payment_method']))){	// change billing fields only in case of paypal payment gateway 
	// the above mentioned filter is ALSO invoked by  ajax call on checkout page and in order to avoid resetting of checkout field at ajax call added $_POST check
		$fields2=$fields;
		unset($fields2['billing']['billing_first_name']);
		unset($fields2['billing']['billing_last_name']);
		unset($fields2['billing']['billing_company']);
		unset($fields2['billing']['billing_address_1']);
		unset($fields2['billing']['billing_address_2']);
		unset($fields2['billing']['billing_city']);
		unset($fields2['billing']['billing_postcode']);
		unset($fields2['billing']['billing_country']);
		unset($fields2['billing']['billing_state']);
		unset($fields2['order']['order_comments']);
		unset($fields2['billing']['billing_address_2']);
		unset($fields2['billing']['billing_postcode']);
		unset($fields2['billing']['billing_company']);
		unset($fields2['billing']['billing_last_name']);
		unset($fields2['billing']['billing_city']); 
		return $fields2;
	} 
	else {
		return $fields;
	}	
}
add_filter( 'woocommerce_shipping_fields' , 'custom_override_shipping_fields' );
function custom_override_shipping_fields( $fields ) {
    $fields2['shipping_first_name']=array(
	'label' => "First Name",
    'required' => true
	);
    $fields2['shipping_last_name']= array(
	'label' => "Last Name",
    'required' => true
	);
    $fields2['shipping_address_1'] = array(
	'label' => "Street Address",
    'required' => true
	);
	$fields2['shipping_address_2'] = array(
	'label' => "Address Line 2",
    'required' => false
	);
    $fields2['shipping_city']= array(
	'label' => "City",
    'required' => true
	);
	$fields2['shipping_state'] = array(
	'label' => "State or Province",
    'required' => true
	);
    $fields2['shipping_postcode'] = array(
	'label' => "Post/Zip Code",
	'placeholder' => "Post/Zip Code",
    'required' => true
	);
	$fields2['shipping_country'] = $fields['shipping_country'];
return $fields2;
}
add_action( 'woocommerce_checkout_init', 'wc_add_confirm_password_checkout', 10, 1 );
function wc_add_confirm_password_checkout( $checkout ) {
	if ( get_option( 'woocommerce_registration_generate_password' ) == 'no' ) {
		$checkout->checkout_fields['account']['account_password2'] = array(
			'type' 				=> 'password',
			'label' 			=> __( 'Confirm password', 'woocommerce' ),
			'required'          => true,
			'placeholder' 		=> _x( 'Confirm Password', 'placeholder', 'woocommerce' )
		);
	}
}

// Check the password and confirm password fields match before allow checkout to proceed.
add_action( 'woocommerce_after_checkout_validation', 'wc_check_confirm_password_matches_checkout', 10, 2 );
function wc_check_confirm_password_matches_checkout( $posted ) {
	$checkout = WC()->checkout;
	if ( ! is_user_logged_in() && ( $checkout->must_create_account || ! empty( $posted['createaccount'] ) ) ) {
		if ( strcmp( $posted['account_password'], $posted['account_password2'] ) !== 0 ) {
			wc_add_notice( __( 'Passwords do not match.', 'woocommerce' ), 'error' );
		}
	}
}
//Add additional credit card fields for new payment method on check out page
add_filter( 'woocommerce_credit_card_form_fields' , 'custom_credit_card_fields_golf_cc' , 10, 2 );
function custom_credit_card_fields_golf_cc ($cc_fields , $payment_id){
if ("golf_credit_card"===$payment_id){
$cc_fields = array(
	'card-type' => '<p class="form-row form-row-wide">
		<label for="' . esc_attr( $payment_id) . '-card-type">' . __( 'Credit Card Type', 'woocommerce' ) . ' <span class="required">*</span></label>
        <select class="wc-credit-card-form-card-type" name="' . $payment_id . '-card-type' . '" id="' . esc_attr( $payment_id ) . '-card-type">
			<option value="Visa">Visa</option>
			<option value="MasterCard">Master Card</option>
			<option value="Discover">Discover</option>
			<option value="American Express">American Express</option>                    
	  </select>
	  <input type="hidden" id="' . esc_attr( $payment_id ) . '-card-type-hidden" name="' . esc_attr( $payment_id ) . '-card-type-hidden" value="" />
	</p>',
	'card-number-field' => '<p class="form-row form-row-wide">
		<label for="' . esc_attr( $payment_id ) . '-card-number">' . __( 'Card Number', 'woocommerce' ) . ' <span class="required">*</span></label>
		<input id="' . esc_attr( $payment_id ) . '-card-number" class="input-text wc-credit-card-form-card-number" type="text" maxlength="20" autocomplete="off" placeholder="•••• •••• •••• ••••" name="' . $payment_id . '-card-number' . '" />
		<input type="hidden" id="' . esc_attr( $payment_id ) . '-card-number-hidden" name="' . esc_attr( $payment_id ) . '-card-number-hidden" value="" />
	</p>',
	'card-expiry-field' => '<p class="form-row form-row-first">
		<label for="' . esc_attr( $payment_id ) . '-card-expiry">' . __( 'Expiry (MM/YY)', 'woocommerce' ) . ' <span class="required">*</span></label>
		<input id="' . esc_attr( $payment_id ) . '-card-expiry" class="input-text wc-credit-card-form-card-expiry" type="text" autocomplete="off" placeholder="' . __( 'MM / YY', 'woocommerce' ) . '" name="' .  $payment_id . '-card-expiry' . '" />
		<input type="hidden" id="' . esc_attr( $payment_id ) . '-card-expiry-month-hidden" name="' . esc_attr( $payment_id ) . '-card-expiry-month-hidden" value="" />
		<input type="hidden" id="' . esc_attr( $payment_id ) . '-card-expiry-year-hidden" name="' . esc_attr( $payment_id ) . '-card-expiry-year-hidden" value="" />
	</p>',
	'card-cvc-field' => '<p class="form-row form-row-last">
		<label for="' . esc_attr( $payment_id ) . '-card-cvc">' . __( 'Card Code', 'woocommerce' ) . ' <span class="required">*</span></label>
		<input id="' . esc_attr( $payment_id ) . '-card-cvc" class="input-text wc-credit-card-form-card-cvc" type="text" autocomplete="off" placeholder="' . __( 'CVC', 'woocommerce' ) . '" name="' .  $payment_id . '-card-cvc' . '" />
		<input type="hidden" id="' . esc_attr( $payment_id ) . '-card-cvc-hidden"  name="' . esc_attr( $payment_id ) . '-card-cvc-hidden" value="" />
	</p>'
);
}
return $cc_fields;
}
//Add additional fields from checkout page to order page
add_action('woocommerce_checkout_update_order_meta', 'custom_update_order_meta_golf_cc');
function custom_update_order_meta_golf_cc( $order_id ) {
    if ($_POST['golf_credit_card-card-number']) update_post_meta( $order_id, 'Card Number', esc_attr($_POST['golf_credit_card-card-number']));
    if ($_POST['golf_credit_card-card-expiry']) update_post_meta( $order_id, 'Expiration Date', esc_attr($_POST['golf_credit_card-card-expiry']));
    if ($_POST['golf_credit_card-card-cvc']) update_post_meta( $order_id, 'Card CVC', esc_attr($_POST['golf_credit_card-card-cvc']));
	if ($_POST['golf_credit_card-card-type']) update_post_meta( $order_id, 'Card Type', esc_attr($_POST['golf_credit_card-card-type']));
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'custom_display_admin_order_meta_golf_cc', 10, 1 ); 
function custom_display_admin_order_meta_golf_cc($order){
	if ('golf_credit_card'===$order->payment_method){ //show only for order fulfilled by custom credit card gateway.
		echo '<div class="order-cc-details"><p class="form-field form-field-wide"><label for="card_number">Credit Card Number:</label><input type="text" name="card_number" id="card_number"  value="' . get_post_meta( $order->id, 'Card Number', true ) . '"  readonly/><button class="button mask_credit_card">Mask Credit Card</button></p>';
		//echo '<p><strong>'.__('Card Number').':</strong> ' . get_post_meta( $order->id, 'Card Number', true ) . '</p>';
		echo '<p class="form-field form-field-wide"><label for="expiry_date">Expiration Date(MM/YY):</label><input type="text" name="expiry_date" id="expiry_date"  value="' . get_post_meta( $order->id, 'Expiration Date', true ) . '"  readonly/></p>';
		echo '<p class="form-field form-field-wide"><label for="card_cvc">Card CVC:</label><input type="text" name="card_cvc" id="card_cvc"  value="' . get_post_meta( $order->id, 'Card CVC', true ) . '"  readonly/></p>';
		//echo '<p><strong>'.__('Expiration Date(MM/YY)').':</strong> ' . get_post_meta( $order->id, 'Expiration Date', true ) . '</p>';
		//echo '<p><strong>'.__('Card CVC').':</strong> ' . get_post_meta( $order->id, 'Card CVC', true ) . '</p>';
		echo '<p class="form-field form-field-wide"><label for="card_cvc">Card Type:</label><input type="text" name="card_cvc" id="card_cvc"  value="' . get_post_meta( $order->id, 'Card Type', true ) . '"  readonly/></p></div>';
		//echo '<p><strong>'.__('Card Type').':</strong> ' . get_post_meta( $order->id, 'Card Type', true ) . '</p>';
	}
}
function woocommerce_login_form( $args = array() ) {

    $defaults = array(
		'message'  => '',
		'redirect' => '',
		'hidden'   => false
		);

    $args = wp_parse_args( $args, $defaults  );
    if ( isset( $_GET['golf-payment-method'] ) && ("CC"===$_GET['golf-payment-method'])) {
            wc_get_template( 'global/form-login-cc.php', $args );
    }
    elseif (isset( $_GET['golf-payment-method'] ) && ("paypal"===$_GET['golf-payment-method'])){
            wc_get_template( 'global/form-login-paypal.php', $args );
    }
    else {
            wc_get_template( 'global/form-login.php', $args );
    }
}
?>