<?php  
	require '../db.php';
	session_start();
	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	$email = $_SESSION['email'];

    $result = $mysqli->query("SELECT * FROM tbl_address WHERE email = '$email' AND default_address = 1");
	if($result->num_rows == 0) {
		$_SESSION['logout-message-redirect'] = 'Required to have at least one default address <a href="/etiendahan/customer/address/" style="text-decoration:none;">here</a>.';
		header('location: /etiendahan/cart/');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout | Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">
	
	<!-- link inner -->
	<?php  
		include '../header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="checkout-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				<div id="etiendahan-checkout-page">
					<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light" style="border-bottom: #dcdcdc solid 1px;">
						<div class="container">
							<a href="/etiendahan/cart/"><i class="fa fa-angle-left" style="font-size: 30px; color: dimgrey;"></i></a>
						</div>
					</nav>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
							    <div class="customer-name pl-2">
							    	<div class="row">
							    		<div class="col-md-2">Your Account:</div>
							    		<div class="col-md-10"><strong style="font-size: 15px;"><?php echo $_SESSION['fullname']; ?></strong></div>
							    	</div>
							    </div>
							    <div class="delivery-address mt-2 pl-2 pt-2 pb-2">
							    	<div class="row">
							    		<?php  
											$address_result = $mysqli->query("SELECT * FROM tbl_address WHERE email = '$email' AND default_address = 1");
											$address_row = $address_result->fetch_assoc();
											$_SESSION['address_id'] = $address_row['id'];
							    		?>
							    		<div class="col-md-2">Delivery Address:</div>
							    		<div class="col-md-10">
											<div class="fullname" style="font-size: 15px;"><?php echo $address_row['fullname'] ?></div>
											<div class="postal-code" style="font-size: 15px;"><?php echo $address_row['postal_code'] ?></div>
											<div class="complete-address" style="font-size: 15px;"><?php echo $address_row['complete_address'] ?></div>
											<div class="province-citymun-barangay" style="font-size: 15px;">
												<?php  
										        	// province
										        	$province_id = $address_row['province'];
										        	$province_result = $mysqli->query("SELECT * FROM tbl_refprovince WHERE provCode = '$province_id'");
													$province_row = $province_result->fetch_assoc();
													$format_province = strtolower($province_row['provDesc']);

										        	// city mun
										        	$citymun_id = $address_row['city'];
										        	$citymun_result = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE citymunCode = '$citymun_id'");
													$citymun_row = $citymun_result->fetch_assoc();
													$format_citymun = strtolower($citymun_row['citymunDesc']);

										        	// barangay
										        	$barangay_id = $address_row['barangay'];
										        	$barangay_result = $mysqli->query("SELECT * FROM tbl_refbrgy WHERE brgyCode = '$barangay_id'");
													$barangay_row = $barangay_result->fetch_assoc();
													$format_barangay = strtolower($barangay_row['brgyDesc']);
										        ?>
												<?php echo ucwords($format_province).' - '.ucwords($format_citymun).' - '.ucwords($format_barangay); ?>
											</div>
											<div class="phone-number" style="font-size: 15px;"><?php echo $address_row['phone_number'] ?></div>
											<div class="other-notes" style="font-size: 15px;"><?php echo $address_row['other_notes'] ?></div>
							    		</div>
							    	</div>
							    </div>
							</div>

							<div class="col-md-12">
								<div class="text-center mt-3"><div>Products Ordered</div><div class="form-check form-check-inline">
									<label class="form-check-label">
										<input class="form-check-input" type="radio" checked> Cash on Delivery
									</label>
								</div></div>
								
								<?php  
									$countcount = 1;
									$formatted_total = 0;
									$cart_group_concat_result = $mysqli->query("SELECT GROUP_CONCAT(product_id ORDER BY id asc) as product_id_g_c FROM tbl_cart WHERE email = '$email' AND quantity > 0");
									while($cart_group_concat_row = mysqli_fetch_assoc($cart_group_concat_result)):
									$product_id_cart = $cart_group_concat_row['product_id_g_c'];
									
										$seller_result = $mysqli->query("SELECT distinct(seller_email) as seller_email_distinct FROM tbl_products WHERE id in($product_id_cart) AND banned = 0 ORDER BY seller_email_distinct asc");
										while($seller_row = mysqli_fetch_assoc($seller_result)):

											$seller_email = $seller_row['seller_email_distinct'];
											$customer_result = $mysqli->query("SELECT email,fullname FROM tbl_customers WHERE email = '$seller_email'");
											while($customer_row = mysqli_fetch_assoc($customer_result)):
												$countcount++;
								?>

									<div class="seller-and-product mt-4 p-2">
										<div class="seller pb-1" style="border-bottom: 1px #dcdcdc solid;"><img src="/etiendahan/temp-img/fa-shop.png" alt="" style="height: 15px;"> <?php echo $customer_row['fullname'] ?> shop <div class="shipping-fee d-inline pull-right">Shipping fee: <strong>+₱120.00</strong></div></div>
										
										<?php  
											$final_count = 0;
											$final_seller_email = $customer_row['email'];
											$product_id_cart = $cart_group_concat_row['product_id_g_c'];
											$final_product_result = $mysqli->query("SELECT * FROM `tbl_products` WHERE id in($product_id_cart) AND seller_email = '$final_seller_email'");
											while($final_product_row = mysqli_fetch_assoc($final_product_result)):
										?>
										
											<div class="product mt-1" style="height: 85px">
												<?php $saved_image = explode(',', $final_product_row['image']); ?>
												<div class="" style="background-image: url(<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>);display: inline-block; height: 80px;width: 80px;background-position: center center;background-size: cover;"></div>
												<div class="product-name d-inline" style="position: relative;top: -62px;"><?php echo $final_product_row['name'] ?></div>
												<?php  
													$final_product = $final_product_row['id'];
													$quantity_result = $mysqli->query("SELECT * FROM tbl_cart WHERE product_id = '$final_product' AND email = '$email'");
													$quantity_row = $quantity_result->fetch_assoc();
												?>
												<div class="product-price" style="position: relative;top: -63px;left: 84px;">₱<?php echo $final_product_row['price'].' x '.$quantity_row['quantity'];?></div>
											</div><?php $total = str_replace(',', '', $final_product_row['price']) * $quantity_row['quantity']; $formatted = number_format((float)$total, 2, '.', ''); ?>
											<?php $count = number_format((float)$total, 2, '.', ''); ?>
										<?php $final_count += $count;$formatted_total += $formatted;endwhile; ?>

										<!-- order total -->
										<div class="order-total pt-2" style="border-top: 1px solid #dcdcdc;">
											<div class="order-total text-right">Order Total: <strong>₱<?php $final_count+=120; echo number_format((float)$final_count, 2, '.', ','); ?></strong></div>
										</div>
									</div>

								<?php endwhile;endwhile;endwhile;?>
							</div>

							<div class="col-md-12 mb-3">
								<div class="place-order p-2 mt-4" style="height: 72px;">
									<div class="total-payment d-inline" style="line-height: 55px;">Total Payment: <strong style="font-size: 18px;">₱<?php $shipping_fee = 120 * ($countcount-1); $formatted_total+=$shipping_fee; echo number_format((float)$formatted_total, 2, '.', ','); ?></strong></div>
									<div class="place-order-button d-inline-block pull-right"><?php $_SESSION['total_amount_order'] = number_format((float)$formatted_total, 2, '.', ','); ?>
										<form action="/etiendahan/c8NLPYLt-functions/place-order-function/" method="POST" class="d-inline">
											<button class="btn btn-primary" type="submit">Place order</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
						
	
				

<!-- footer inner -->

</html>