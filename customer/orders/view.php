<?php  
	require '/../../db.php';
	session_start();
  	
  	$email = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');
  	$manage_order = $_SESSION['manage_order'];

	$result_banned = $mysqli->query("SELECT * FROM tbl_customers WHERE email = '$email'");
	$row_banned = $result_banned->fetch_assoc();
	if($row_banned['banned'] == 1) {
		$_SESSION['email'] = false;
		$_SESSION['logged_in'] = false;
	    $_SESSION['cant-proceed-message-banned'] = "Your customer account is banned! <a href='mailto:etiendahan@gmail.com' style='text-decoration: none' target='_blank'>Email</a> us for info.";
	    header('location: /etiendahan/customer/account/login/');
	    exit;
	}

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	// Check if user is logged in using the session variable
	if ( $logged_in == false ) {
		$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your profile page.";
		header("location: /etiendahan/customer/account/login/");    
	}
	else {
	    // Makes it easier to read
	    $fullname 	= $_SESSION['fullname'];
	    $gender     = $_SESSION['gender'];
	    $email      = $_SESSION['email'];
	    $active     = $_SESSION['active'];
	    $birthday   = $_SESSION['birthday'];
	    $birthmonth = $_SESSION['birthmonth'];
	    $birthyear  = $_SESSION['birthyear'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Order #<?php echo $manage_order; ?> | Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">
	
	<!-- link inner -->
	<?php  
		include '../../header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="order-view-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include '../../header.php';
				?>

				<!-- CUSTOMER PAGE SECTION 1 -->
				<div id="etiendahan-customer-page-section-1">
					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<div id="accordion" role="tablist">
									<div class="card">
										<div class="card-header" role="tab" id="headingOne">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/account/profile/">			
												Personal Information
												</a>
											</h5>
										</div>

										<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
											<div class="card-body personal-info">
												<ul>
													<li class="active"><a href="/etiendahan/customer/account/profile/">Profile</a></li>
													<li><a href="">Change Password</a></li>												</ul>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header active" role="tab" id="headingTwo">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/orders/">
												Orders
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingThree">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/wishlists/">
												Wishlists
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingFour">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/address/">
												Address Book
												</a>
											</h5>
										</div>
									</div>
								</div>
							</div>

							<div id="prevent-not-to-scroll" class="col-md-8">
								<div class="tab-content"><h1>View Order #<?php echo $manage_order; ?></h1></div>
								
								<?php 
									$order_result = $mysqli->query("SELECT * FROM tbl_orders WHERE unique_hash_id = '$manage_order'");
									$order_row = $order_result->fetch_assoc();
								?>

								<!-- first row -->
								<div id="order-header-view" class="row">
									<div class="col-md-4">
										<div class="order-number">
											Order #<?php echo $manage_order; ?>
										</div>
									</div>
									<div class="col-md-4 text-center">
										<div class="order-place-date">
											<?php 
												$phpdate = strtotime($order_row['created_at']);
												$mysqldate = date('M j, Y', $phpdate);
											?>
											Placed on <?php echo $mysqldate; ?>
										</div>
									</div>
									<div class="col-md-4 text-right">
										<div class="order-total">
											Total: ₱<?php echo $order_row['total']; ?>
										</div>
									</div>
								</div>
								
								<?php  
									$count = 1;
									$orders_count = $mysqli->query("SELECT GROUP_CONCAT(product_id) as product_id_gc FROM tbl_orders WHERE unique_hash_id = '$manage_order'");
									while($orders_count_row = mysqli_fetch_assoc($orders_count)):
									$product_id = $orders_count_row['product_id_gc'];

										$orders_count = $mysqli->query("SELECT * FROM tbl_products WHERE id IN($product_id) GROUP BY seller_email");
										while($orders_count_row = mysqli_fetch_assoc($orders_count)):
								?>
									<div class="order-wrapper-content mt-3">
										<div id="order-header-view-package-seller" class="row">
											<div class="col-md-6 text-left"><i class="fa fa-cube fa-fw"></i><span>Package <?php echo $count++; ?></span><span class="ml-1" style="font-size: 10px; font-style: italic;">(Shipping fee: +₱120.00)</span></div>
											<div class="col-md-6 text-right">
												<span>
													<?php
														$seller_email = $orders_count_row['seller_email']; 
												        $result = $mysqli->query("SELECT * FROM tbl_customers WHERE email = '$seller_email'");
														$row = $result->fetch_assoc();
														echo $row['fullname'];
													?>
												</span>
												<a href="/etiendahan/seller-shop/">
													<button class="btn btn-primary view-shop" id="<?php echo $orders_count_row['seller_email']; ?>">view shop</button>
												</a>
													
											</div>
										</div>

										<div id="order-delivery-shipping" class="row">
											<div class="col-md-12">
												<div class="order-delivery-shipping-name">
													<i class="fa fa-truck fa-fw"></i>Shipping Information?
												</div>
												<div class="order-delivery-shipping-date">
													Contact your seller <a href="mailto:<?php echo $orders_count_row['seller_email'] ?>" style="text-decoration: none;" target="_blank"><?php echo $orders_count_row['seller_email'] ?></a> for further info.
												</div>
											</div>
										</div>

										<div id="order-delivery-status" class="row">
											<div class="col-md-12">
													<?php 
														$product_id_orders = $orders_count_row['id']; 
														$result = $mysqli->query("SELECT * FROM tbl_orders WHERE product_id = '$product_id_orders' AND unique_hash_id = '$manage_order'");
														$row = $result->fetch_assoc();
													?>

													<?php if($row['status'] == 'processing'): ?>
															<!-- processing -->
															<div class="progress">
													        	<div class="one"></div><div class="two no-color"></div><div class="three no-color"></div>
													  			<div class="progress-bar" style="width: 0;"></div>
															</div>

														<?php elseif($row['status'] == 'shipped'): ?>
															<!-- shipped -->
															<div class="progress">
													        	<div class="one"></div><div class="two"></div><div class="three no-color"></div>
													  			<div class="progress-bar" style="width: 50%;"></div>
															</div>

														<?php else: ?>
															<!-- delivered -->
															<div class="progress">
													        	<div class="one"></div><div class="two"></div><div class="three"></div>
													  			<div class="progress-bar" style="width: 100%;"></div>
															</div>
														<?php endif; ?>

													<div class="processing-text">Processing</div>
													<div class="shipped-text">Shipped</div>
													<div class="delivered-text">Delivered</div>
											</div>
										</div>
										

										<?php  
											$orders_count1 = $mysqli->query("SELECT GROUP_CONCAT(product_id) as product_id_gc FROM tbl_orders WHERE unique_hash_id = '$manage_order'");
											while($orders_count_row1 = mysqli_fetch_assoc($orders_count1)):
											$product_id1 = $orders_count_row1['product_id_gc'];

												$orders_count1 = $mysqli->query("SELECT * FROM tbl_products WHERE id IN($product_id1) AND seller_email = '$seller_email'");
												while($orders_count_row1 = mysqli_fetch_assoc($orders_count1)):
										?>
											<div id="order-delivery-content" class="row">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-2">
															<div class="item-product">
																<a href="/etiendahan/category/view/product/" class="d-block my-item-product-inner category-product-id" id="<?php echo $orders_count_row1['id']; ?>">
																	<div class="item-image">
																		<?php $saved_image = explode(',', $orders_count_row1['image']); ?>
																		<div class="img-fluid" style="background-image: url(<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>);"></div>
																	</div>
																</a>
															</div>
														</div>
														<div class="col-md-6">
															<div class="item-name">
																<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $orders_count_row1['id']; ?>"><?php echo $orders_count_row1['name']; ?></a>
															</div>
														</div>

														<div class="col-md-2">
															<div class="item-price">
																₱<?php echo $orders_count_row1['price']; ?>
															</div>
														</div>

														<div class="col-md-2">
															<div class="item-quantity">
																x<?php 
																	$product_id_quantity =  $orders_count_row1['id']; 
																	$result1 = $mysqli->query("SELECT * FROM tbl_orders WHERE product_id = '$product_id_quantity' AND email = '$email' AND unique_hash_id = '$manage_order'");
																	$row1 = $result1->fetch_assoc();
																	echo $row1['quantity'];
																?>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php endwhile; endwhile;?>
									</div>
								<?php endwhile; endwhile; ?>

								<div class="mt-3 mb-3 row" style="font-weight: 600;font-size: 13px;border: 1px solid #b9b9c3;margin: 0;padding: 10px 0;">

									<div class="col-md-3">Delivery Address:</div>
									<div class="col-md-9">
										<?php
											$order_result1 = $mysqli->query("SELECT * FROM tbl_orders WHERE unique_hash_id = '$manage_order'");
											$order_row1 = $order_result1->fetch_assoc();
											$order_email = $order_row1['email'];
											$address_id = $order_row1['address_id'];
									        $result = $mysqli->query("SELECT * FROM tbl_address WHERE id = '$address_id'");
									        if($result->num_rows == 0) {
									        	$result1 = $mysqli->query("SELECT * FROM tbl_address WHERE email= '$order_email' AND default_address = 1");
												if($result1->num_rows == 0) {
									        		$result12 = $mysqli->query("SELECT * FROM tbl_address WHERE email= '$order_email'");
													$row12 = $result12->fetch_assoc();
													echo $row12['fullname'].'<br>';
													echo $row12['postal_code'].'<br>';
													echo $row12['complete_address'].'<br>';

													// province
										        	$province_id = $row12['province'];
										        	$province_result = $mysqli->query("SELECT * FROM tbl_refprovince WHERE provCode = '$province_id'");
													$province_row = $province_result->fetch_assoc();
													$format_province = strtolower($province_row['provDesc']);

										        	// city mun
										        	$citymun_id = $row12['city'];
										        	$citymun_result = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE citymunCode = '$citymun_id'");
													$citymun_row = $citymun_result->fetch_assoc();
													$format_citymun = strtolower($citymun_row['citymunDesc']);

										        	// barangay
										        	$barangay_id = $row12['barangay'];
										        	$barangay_result = $mysqli->query("SELECT * FROM tbl_refbrgy WHERE brgyCode = '$barangay_id'");
													$barangay_row = $barangay_result->fetch_assoc();
													$format_barangay = strtolower($barangay_row['brgyDesc']);
										        	echo ucwords($format_province).' - '.ucwords($format_citymun).' - '.ucwords($format_barangay).'<br>';

													echo $row12['phone_number'].'<br>';
													echo $row12['other_notes'].'<br>';										        	
												} else {
													$row1 = $result1->fetch_assoc();
													echo $row1['fullname'].'<br>';
													echo $row1['postal_code'].'<br>';
													echo $row1['complete_address'].'<br>';

													// province
										        	$province_id = $row1['province'];
										        	$province_result = $mysqli->query("SELECT * FROM tbl_refprovince WHERE provCode = '$province_id'");
													$province_row = $province_result->fetch_assoc();
													$format_province = strtolower($province_row['provDesc']);

										        	// city mun
										        	$citymun_id = $row1['city'];
										        	$citymun_result = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE citymunCode = '$citymun_id'");
													$citymun_row = $citymun_result->fetch_assoc();
													$format_citymun = strtolower($citymun_row['citymunDesc']);

										        	// barangay
										        	$barangay_id = $row1['barangay'];
										        	$barangay_result = $mysqli->query("SELECT * FROM tbl_refbrgy WHERE brgyCode = '$barangay_id'");
													$barangay_row = $barangay_result->fetch_assoc();
													$format_barangay = strtolower($barangay_row['brgyDesc']);
										        	echo ucwords($format_province).' - '.ucwords($format_citymun).' - '.ucwords($format_barangay).'<br>';

													echo $row1['phone_number'].'<br>';
													echo $row1['other_notes'].'<br>';
												}
									        } else {
												$row = $result->fetch_assoc();
												echo $row['fullname'].'<br>';
												echo $row['postal_code'].'<br>';
												echo $row['complete_address'].'<br>';

												// province
									        	$province_id = $row['province'];
									        	$province_result = $mysqli->query("SELECT * FROM tbl_refprovince WHERE provCode = '$province_id'");
												$province_row = $province_result->fetch_assoc();
												$format_province = strtolower($province_row['provDesc']);

									        	// city mun
									        	$citymun_id = $row['city'];
									        	$citymun_result = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE citymunCode = '$citymun_id'");
												$citymun_row = $citymun_result->fetch_assoc();
												$format_citymun = strtolower($citymun_row['citymunDesc']);

									        	// barangay
									        	$barangay_id = $row['barangay'];
									        	$barangay_result = $mysqli->query("SELECT * FROM tbl_refbrgy WHERE brgyCode = '$barangay_id'");
												$barangay_row = $barangay_result->fetch_assoc();
												$format_barangay = strtolower($barangay_row['brgyDesc']);
									        	echo ucwords($format_province).' - '.ucwords($format_citymun).' - '.ucwords($format_barangay).'<br>';

												echo $row['phone_number'].'<br>';
												echo $row['other_notes'].'<br>';
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF CUSTOMER PAGE SECTION 1 -->

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>