jQuery(document).ready(function($) {
	jQuery(document).ready(function($) {
		$( "#accordion" ).accordion({
			collapsible: true
		});
		$( 'form.login' ).slideDown(); //to always show the login form on checkout form
		//$( 'div.shipping_address' ).slideDown();
	});
	
		$( 'body' ).on( 'updated_checkout', function() { //trigger handler of event being generated from checkout.js of woocommerce
			$( "div.golf-credit-card-review-order #payment.woocommerce-checkout-payment" ).prepend( "<h3 id='order_review_heading' class='golf-credit-card-review-order'>Payment Information</h3>" );
			
		});
		
		
		$( 'body' ).on( 'checkout_error', function() { // handling of error on checkout page
			$('form.login').hide();	
			$('div.create-account.golf-credit-card').css('width', '100%');
			$('.checkout').css('margin-top', '0px');
		});

		
	// Credit card checkout Form handler
	function GolfCreditCardFormHandler() {
		var $form = $( 'form.checkout, form#order_review' ),
		ccForm = $( '#golf_credit_card-cc-form' ),
		errorList = '';
		
		if ( $( '#payment_method_golf_credit_card' ).is( ':checked' ) ) {
			var expiry = $('#golf_custom_credit_card_payment #golf_credit_card-card-expiry').payment('cardExpiryVal');
			var validateExpiry = $.payment.validateCardExpiry(expiry["month"], expiry["year"]);
			var validateCVC = $.payment.validateCardCVC($('#golf_custom_credit_card_payment #golf_credit_card-card-cvc').val());
			var validateCardNum = $.payment.validateCardNumber($('#golf_custom_credit_card_payment #golf_credit_card-card-number').val());
			
			if (false===validateExpiry || false===validateCVC || false==validateCardNum){
			$( '.woocommerce-error' ).hide();
				((false===validateCardNum) ? errorList+= '<li>Credit Card Number is invalid</li>' : "");
				((false===validateExpiry) ? errorList+= '<li>Credit Card Expiration Date is invalid</li>' : "");
				((false===validateCVC) ? errorList+= '<li>Credit Card CVC is invalid</li>' : "");
				ccForm.prepend( '<ul class="woocommerce-error">' + errorList + '</ul>' );
				return false; //do not submit the form if contains errors
			}
			else {
				$('#golf_credit_card-card-cvc-hidden').val($('#golf_custom_credit_card_payment #golf_credit_card-card-cvc').val());
				$('#golf_credit_card-card-number-hidden').val($('#golf_custom_credit_card_payment #golf_credit_card-card-number').val());
				$('#golf_credit_card-card-expiry-month-hidden').val(expiry["month"]);
				$('#golf_credit_card-card-expiry-year-hidden').val(expiry["year"]);
				$('#golf_credit_card-card-type-hidden').val($('#golf_credit_card-card-type').val());
				return true; //submit form after successful validations
			}	
			
		}
		
	}
	
	$( 'form.checkout' ).on( 'checkout_place_order_golf_credit_card', function () {
			return GolfCreditCardFormHandler();
	});
	
	if($(window).width() <= 600){
		$( 'a.golf-clear-cart:not(.buttons_added)' ).addClass( 'button' );
	}

	// Quantity buttons
	$( 'div.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
	
		$( document ).on( 'click', '.plus, .minus', function() {

		// Get values
		var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $( this ).is( '.plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event
		$qty.trigger( 'change' );
	});

   $('.popup').click(function() {
     var NWin = window.open($(this).prop('href'), '', 'scrollbars=1,height=200,width=400');
     if (window.focus)
     {
       NWin.focus();
     }
     return false;
    });
	
	
	
		$('.simple-ajax-popup-align-top').magnificPopup({
		type: 'ajax'
	});

	
	
	$('.woocommerce-tabs ul.tabs li a').tooltip();
	

    $( '.ShipCanda' ).tooltip();



	// Tabs
	$('.woocommerce-tabs .panel').hide();
	
		$('.golf-specs-container a').click(function(){
		var $tab = $($(".specification_information_tab" ));
		var $tabs_wrapper = $tab.closest('.woocommerce-tabs');
		$('ul.tabs li', $tabs_wrapper).removeClass('active');
		$('div.panel', $tabs_wrapper).hide();
		$("#tab-specification_information").show();
		$(".specification_information_tab").addClass('active');
		return false;
	});
	
	
	$('.WorriesShipping a').click(function(){
		var $tab = $($(".additional_information_tab" ));
		var $tabs_wrapper = $tab.closest('.woocommerce-tabs');
		$('ul.tabs li', $tabs_wrapper).removeClass('active');
		$('div.panel', $tabs_wrapper).hide();
		$("#tab-additional_information").show();
		$(".additional_information_tab").addClass('active');
		return false;
	});

	$('.woocommerce-tabs ul.tabs li a').click(function(){

		var $tab = $(this);
		var $tabs_wrapper = $tab.closest('.woocommerce-tabs');
		$('ul.tabs li', $tabs_wrapper).removeClass('active');
		$('div.panel', $tabs_wrapper).hide();
		$('div' + $tab.attr('href'), $tabs_wrapper).show();
		$tab.parent().addClass('active');

		return false;
	});

	$('.woocommerce-tabs').each(function() {
		var hash = window.location.hash;
		if (hash.toLowerCase().indexOf("comment-") >= 0) {
			$('ul.tabs li.reviews_tab a', $(this)).click();
		} else {
			$('ul.tabs li:first a', $(this)).click();
		}
	});

	// Star ratings for comments
	$('#rating').hide().before('<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>');

	$('body')
		.on( 'click', '#respond p.stars a', function(){
			var $star   = $(this);
			var $rating = $(this).closest('#respond').find('#rating');

			$rating.val( $star.text() );
			$star.siblings('a').removeClass('active');
			$star.addClass('active');

			return false;
		})
		.on( 'click', '#respond #submit', function(){
			var $rating = $(this).closest('#respond').find('#rating');
			var rating  = $rating.val();

			if ( $rating.size() > 0 && ! rating && woocommerce_params.review_rating_required == 'yes' ) {
				alert(woocommerce_params.i18n_required_rating_text);
				return false;
			}
		});
		
		
	jQuery(".page .content-area ul.products").addClass("product_list");
	jQuery(".page .content-area ul.products").wrap('<div class="products_block"></div>');
	jQuery(".page .content-area ul.products").attr("id","shop-grid");
	jQuery( "<span style='display: none; visibility: hidden;' class='shop_default_width'></span>" ).appendTo( jQuery( ".page .content-area .products_block" ) );
	

	// prevent double form submission
	$('form.cart').submit(function(){
		$(this).find(':submit').attr( 'disabled','disabled' );
	});
	
	// hide "Empty my shopping cart" if "cart-empty" class is present
	if ( $( ".cart-empty" ).length ){
		$( ".golf-clear-cart").hide();
		$(".golf-cart-continue").hide();
		$(".golf-cart-checkout").hide();
	}
	
	$( ".golf-clear-cart" ).click(function() {
		if (confirm("This will delete all the items in your cart\n\nClick OK to delete or Cancel to Continue Shopping")){ //clear cart on confirmation only
			$( "#golf-clear-cart-form" ).submit();
		}	
	});
	
});