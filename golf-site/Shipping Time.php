<?php
/*
Template Name: Shipping Time
*/
?>
<?php
$sCurrentDate=date("Y-m-d");
$sShippingStart = date('jS F, Y',strtotime('+7 days', strtotime($sCurrentDate))); 
$sShippingEnd = date('jS F, Y',strtotime('+14 days', strtotime($sCurrentDate))); 
?>
<div class="shipping-time">
 		<h3>EXPECTED SHIP TIME</h3>
        <div style="padding:0px;" align="center"><img src="<?php echo get_site_url(); ?>/wp-content/themes/ekornes-child-golf/images/icon_inStock_shipTime.png" border="0"><br>
        <strong>From the factory</strong><br>
				<?php echo $sShippingStart . " - " . $sShippingEnd ?>             
		</div>
		<br>
 </div>
 

