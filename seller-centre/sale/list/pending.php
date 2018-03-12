<?php  
	require '/../../../db.php';
	session_start();

	$logged_in  = ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	// Check if user is logged in using the session variable
	if ($logged_in == false) {
	$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your seller centre page.";
	header("location: /etiendahan/seller-centre/account/signin/");    
	}
  
  	if ($logged_in == 1) {
    	// header("location: /etiendahan/seller-centre/");    
    	$email = $mysqli->escape_string($_SESSION['email']);
		$result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'");
		$user = $result->fetch_assoc();

		if ($user['seller_centre'] == 0) {
			$_SESSION['cant-proceed-message'] = "You must activate first your seller centre account.";
            header("location: /etiendahan/seller-centre/account/activate/");
        }
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
	<title>Etiendahan Seller Centre</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">

	<!-- link inner -->
	<?php  
		include '../../../header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="seller-centre-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- SECTION 1 -->
				<div id="etiendahan-section-1" class="etiendahan-section">
					<!-- navbar -->
					<nav class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index shrink">
					  	<a class="navbar-brand" href="http://localhost:8080/etiendahan/seller-centre/">
							<img src="/etiendahan/temp-img/etiendahan-logo-seller-centre.png" width="178" height="58" class="d-inline-block align-top" alt="">
						</a>	

						<div class="ml-auto d-flex">
							<div class="nav-item right-nav dropdown" id="cart">
								<a class="nav-link" href="http://localhost:8080/etiendahan/" id="cart" role="button" aria-haspopup="true" aria-expanded="false">
									Etiendahan Homepage
								</a>
							</div>

							<div class="nav-item right-nav dropdown" id="user-account">
								<a href="/etiendahan/seller-centre/product/list/all/" class="nav-link" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user-circle pl-4 pr-4"></i>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<p>Howdie.</p>

									<a href="/etiendahan/seller-centre/product/list/all/"><div class="dropdown-item"><i class="fa fa-cubes fa-fw mr-2"></i>My Products</div></a>
									<a href="/etiendahan/seller-centre/sale/list/pending/"><div class="dropdown-item"><i class="fa fa-money fa-fw mr-2"></i>My Sales</div></a>
									<a href="/etiendahan/seller-centre/logout/"><div class="dropdown-item"><i class="fa fa-sign-out fa-fw mr-2"></i>Logout</div></a>
								</div>
							</div>
						</div>

						<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</nav>

					<nav class="breadcrumb-wrapper" aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/etiendahan/seller-centre/">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">My Sales</li>
						</ol>
					</nav>
				</div>
				<!-- END OF SECTION 1 -->	
				
				<ul class="nav justify-content-center text-center">
					<li class="nav-item active">
						<a class="nav-link active" href="/etiendahan/seller-centre/sale/list/pending/">Pending</a>
					</li>
<!-- 					<li class="nav-item">
						<a class="nav-link" href="/etiendahan/seller-centre/sale/list/ready-to-ship/">Ready to Ship</a>
					</li> -->
					<li class="nav-item">
						<a class="nav-link" href="/etiendahan/seller-centre/sale/list/shipped/">Shipped</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/etiendahan/seller-centre/sale/list/delivered/">Delivered</a>
					</li>
				</ul>

				<div class="container-fluid inner">
					<div class="row">
						<div class="col-md-12" id="page-inner">
							<table class="table" id="pending">
								<thead>
									<tr>
										<th scope="col">Order ID</th>
										<th scope="col" style="width: 15%;">Product Name</th>
										<th scope="col">Quantity</th>
										<th scope="col" style="width: 10%;">Price</th>
										<th scope="col" style="width: 20%; font-style: italic;">TOTAL</th>
										<th scope="col">Customer Email</th>
										<th scope="col" style="width: 20%;">Address</th>
										<th scope="col" style="width: 10%;">Date placed</th>
										<th scope="col">Action</th>
									</tr>
								</thead>

								<tbody>
									<?php  
										$orders_product_id_result = $mysqli->query("SELECT orders.unique_hash_id, orders.email, orders.address_id, orders.created_at FROM tbl_orders orders JOIN tbl_products products on orders.product_id = products.id and orders.status = 'processing' and products.seller_email = '$email' GROUP BY orders.unique_hash_id ORDER BY orders.created_at");
										while($orders_product_id_row = mysqli_fetch_assoc($orders_product_id_result)):
										$unique_hash_id = $orders_product_id_row['unique_hash_id'];
									?>
												<tr>
													<!-- unique hash id -->
													<th scope="row">#<?php echo $orders_product_id_row['unique_hash_id']; ?></th>

													<!-- product name -->
													<td>
														<?php  
															$count = 1;
															$product_orders = $mysqli->query("SELECT * FROM tbl_orders WHERE unique_hash_id = '$unique_hash_id' AND status = 'processing'");
															while($product_orders_row = mysqli_fetch_assoc($product_orders)):
														?>
															<table class="inner-table">
																<tr>
																	<td>
																		<?php 
																			$product_id = $product_orders_row['product_id'];
																			$orders_product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$product_id' AND seller_email = '$email'");
																			while($orders_product_row = mysqli_fetch_assoc($orders_product_result)):
																				echo "<span style='font-weight: bold;'>$count.</span> ".$orders_product_row['name'];
																			endwhile;
																		?>
																	</td>
																</tr>
															</table>
														<?php $count++; endwhile; ?>
													</td>

													<!-- quantity -->
													<td>
														<?php  
															$count = 1;
															$product_orders = $mysqli->query("SELECT * FROM tbl_orders WHERE unique_hash_id = '$unique_hash_id' AND status = 'processing'");
															while($product_orders_row = mysqli_fetch_assoc($product_orders)):
															$product_id_quantity = $product_orders_row['product_id'];

																$orders_product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$product_id_quantity' AND seller_email = '$email'");
																while($orders_product_row = mysqli_fetch_assoc($orders_product_result)):
														?>
															<table class="inner-table">
																<tr>
																	<td><?php echo "<span style='font-weight: bold;'>$count.</span> ".$product_orders_row['quantity']; ?></td>
																</tr>
															</table>
														<?php $count++; endwhile; endwhile; ?>
													</td>

													<!-- price -->
													<td>
														<?php  
															$count = 1;
															$product_orders = $mysqli->query("SELECT * FROM tbl_orders WHERE unique_hash_id = '$unique_hash_id' AND status = 'processing'");
															while($product_orders_row = mysqli_fetch_assoc($product_orders)):
														?>
															<table class="inner-table">
																<td>
																		<?php 
																			$product_id = $product_orders_row['product_id'];
																			$orders_product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$product_id' AND seller_email = '$email'");
																			while($orders_product_row = mysqli_fetch_assoc($orders_product_result)):
																			 	echo "<span style='font-weight: bold;'>$count.</span> ".$orders_product_row['price'];
																			endwhile;
																		?>
																	</td>
															</table>
														<?php $count++; endwhile; ?>
													</td>

													<!-- TOTAL -->
													<td>
														<?php  
															$final_count = 0;
															$product_orders = $mysqli->query("SELECT * FROM tbl_orders WHERE unique_hash_id = '$unique_hash_id' AND status = 'processing'");
															while($product_orders_row = mysqli_fetch_assoc($product_orders)):
															$product_id_quantity = $product_orders_row['product_id'];

																$orders_product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$product_id_quantity' AND seller_email = '$email'");
																while($orders_product_row = mysqli_fetch_assoc($orders_product_result)):
														?>
															<table class="inner-table">
																<tr>
																	<td><?php $total = str_replace(',', '', $orders_product_row['price']) * $product_orders_row['quantity']; $formatted = number_format((float)$total, 2, '.', ''); ?></td>
																	<?php $count = number_format((float)$total, 2, '.', ''); ?>
																	<?php $final_count += $count; ?>
																</tr>
															</table>
														<?php endwhile; endwhile; ?>
														<?php $final_count_with_shipment_fee = $final_count+120; $final_count_with_shipment_fee_formatted = number_format((float)$final_count_with_shipment_fee, 2, '.', ','); echo number_format((float)$final_count, 2, '.', ',')." + 120 shipment fee = <span style='font-weight: bold;'>$final_count_with_shipment_fee_formatted</span>"; ?>
													</td>

													<!-- customer email -->
													<td>
														<?php echo $order_email =  $orders_product_id_row['email'] ?>
													</td>

													<!-- address -->
													<td>
														<?php
															$address_id = $orders_product_id_row['address_id'];
													        $result = $mysqli->query("SELECT * FROM tbl_address WHERE id = '$address_id'");
													        if($result->num_rows == 0) {
													        	$result1 = $mysqli->query("SELECT * FROM tbl_address WHERE email= '$order_email' AND default_address = 1");
																if($result1->num_rows == 0) {
													        		$result12 = $mysqli->query("SELECT * FROM tbl_address WHERE email= '$order_email'");
																	$row12 = $result12->fetch_assoc();
																	echo $row12['fullname'].'<br>';
																	echo $row12['phone_number'].'<br>';
																	echo $row12['complete_address'].'<br>';
																	echo $row12['city'].'<br>';
																	echo $row12['barangay'].'<br>';
																} else {
																	$row1 = $result1->fetch_assoc();
																	echo $row1['fullname'].'<br>';
																	echo $row1['phone_number'].'<br>';
																	echo $row1['complete_address'].'<br>';
																	echo $row1['city'].'<br>';
																	echo $row1['barangay'].'<br>';
																}
													        } else {
																$row = $result->fetch_assoc();
																echo $row['fullname'].'<br>';
																echo $row['phone_number'].'<br>';
																echo $row['complete_address'].'<br>';
																echo $row['city'].'<br>';
																echo $row['barangay'].'<br>';
															}
														?>
													</td>

													<!-- date placed -->
													<td><?php $phpdate = strtotime($orders_product_id_row['created_at']);
															echo $mysqldate = date('M j, Y', $phpdate); ?>
													</td>

													<!-- action -->
													<td><a href="/etiendahan/seller-centre/sale/function/goto-shipped/" class="goto-sales" id="<?php echo $orders_product_id_row['unique_hash_id']; ?>"><i class="fa fa-angle-right" style="font-size: 20px; color: dimgrey;"></i></a></td>
												</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="footer mb-3">
								<div class="site-image" style="background-image: url(/etiendahan/temp-img/logo-seller-centre.png); left: 48.5%;"></div>
								<div class="site-centre">Etiendahan Seller Centre</div>
								<div class="site-version">Current Version: 1.0.0</div>
							</div>
						</div>
					</div>
				</div>			

			</div>
		</div>
	</div>	

<!-- footer inner -->
<!-- Development - Normal import of theme.js -->
<script src="/etiendahan/assets/js/theme.js"></script>

<!-- Development - Minifies import of theme.js -->
<!-- <script src="/etiendahan/assets/js/theme.min.js"></script> -->

<!-- Production - Normal import of theme.js -->
<!-- <script src="/assets/js/theme.js"></script> -->

<!-- Production - Minified import of theme.js -->
<!-- <script src="/assets/js/theme.min.js"></script> -->
</html>