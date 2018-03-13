<?php  
	require '../../db.php';
	session_start();
  	
  	$email = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');

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
	    // $fullname 	= $_SESSION['fullname'];
	    // $gender     = $_SESSION['gender'];
	    // $email      = $_SESSION['email'];
	    // $active     = $_SESSION['active'];
	    // $birthday   = $_SESSION['birthday'];
	    // $birthmonth = $_SESSION['birthmonth'];
	    // $birthyear  = $_SESSION['birthyear'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Wishlists | Etiendahan</title>
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
	<div id="wishlists-page" class="main-container">
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
										<div class="card-header" role="tab" id="headingTwo">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/orders/">
													<?php  
														$email =  $_SESSION['email'];
													  	$result = $mysqli->query("SELECT COUNT(DISTINCT unique_hash_id) as 'total' FROM tbl_orders WHERE email = '$email' ORDER BY unique_hash_id");
												 		if($result->num_rows == 0):
													?>
													Orders
													<?php else: ?>
														<?php $row = $result->fetch_assoc(); ?>
													Orders <?php $total_row = $row['total']; echo ($row['total'] == 0)? '' : "($total_row)" ?>
													<?php endif; ?>
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header active" role="tab" id="headingThree">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/wishlists/">
												<?php  
													$email =  $_SESSION['email'];
												  	$result = $mysqli->query("SELECT COUNT(*) as 'total' FROM tbl_wishlists WHERE email = '$email'");
											 		if($result->num_rows == 0):
												?>
												Wishlists
												<?php else: ?>
													<?php $row = $result->fetch_assoc(); ?>
												Wishlists <?php $total_row = $row['total']; echo ($row['total'] == 0)? '' : "($total_row)" ?>
												<?php endif; ?>
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
								<div class="tab-content"><h1>Your Wishlists</h1></div>
								<!-- If wishlists is empty -->
								<?php $result = $mysqli->query("SELECT * FROM tbl_wishlists WHERE email = '$email'");
									if($result->num_rows == 0):
								?>
									<p>You haven't select any item to wishlists yet.</p>
								<?php else: ?>
									<!-- If wishlists is not empty -->
									<div class="row">
										<div class="col-md-12">
											<table class="table">
												<thead>
													<tr>
														<th scope="col">Product Image</th>
														<th scope="col">Product Name</th>
														<th class="text-center" scope="col">Price</th>
														<th scope="col"></th>
													</tr>
												</thead>

												<tbody>
													<?php  
														$product_id_result = $mysqli->query("SELECT GROUP_CONCAT(product_id) FROM tbl_wishlists WHERE email='$email'");
														$product_id_row = $product_id_result->fetch_assoc();
														// echo $product_id_row['GROUP_CONCAT(product_id)'];
														$group_concat = $product_id_row['GROUP_CONCAT(product_id)'];

														$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id IN($group_concat)");
														while($product_row = mysqli_fetch_assoc($product_result)):
													?>
															<?php if($product_row['banned'] == 1): ?>
																<tr>
																	<th scope="row">
																		<a class="d-block my-item-inner category-product-id" id="<?php echo $product_row['id']; ?>">
																			<div class="item-image">
																				<?php $saved_image = explode(',', $product_row['image']); ?>
																				<div class="img-fluid" style="background-image: url(<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>);"></div>
																			</div>
																		</a>
																		<div class="separator"></div>
																	</th>
																	<td class="item-name">
																		<a class="category-product-id" id="<?php echo $product_row['id']; ?>"><?php echo $product_row['name']; ?></a>
																	</td>
																	<td class="item-price text-center">
																		<span class="text-danger">Banned</span>
																	</td>
																	<td class="action text-center">
																		<a class="action"><i class="fa fa-shopping-cart"></i></a>
																		<span>|</span>
																		<a class="action wishlists-delete" href="/etiendahan/customer/wishlists/delete/" id="<?php echo $product_row['id'] ?>"><i class="fa fa-close"></i></a>
																	</td>
																</tr>
															<?php else: ?>
																<tr>
																<th scope="row">
																	<?php if($product_row['stock'] <= 0): ?>
																		<a class="d-block my-item-inner category-product-id" id="<?php echo $product_row['id']; ?>">
																			<div class="item-image">
																				<?php $saved_image = explode(',', $product_row['image']); ?>
																				<div class="img-fluid" style="background-image: url(<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>);"></div>
																			</div>
																		</a>																	
																	<?php else: ?>
																		<a href="/etiendahan/market/view/product/" class="d-block my-item-inner category-product-id" id="<?php echo $product_row['id']; ?>">
																			<div class="item-image">
																				<?php $saved_image = explode(',', $product_row['image']); ?>
																				<div class="img-fluid" style="background-image: url(<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>);"></div>
																			</div>
																		</a>
																	<?php endif; ?>
																		
																	<div class="separator"></div>
																</th>
																<td class="item-name">
																	<?php if($product_row['stock'] <= 0): ?>
																		<a class="category-product-id" id="<?php echo $product_row['id']; ?>"><?php echo $product_row['name']; ?></a>
																	<?php else: ?>
																		<a href="/etiendahan/market/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>"><?php echo $product_row['name']; ?></a>
																	<?php endif; ?>
																</td>
																<td class="item-price text-center">
																	<?php if($product_row['stock'] <= 0): ?>
																		<span class="text-danger">Sold out</span>
																	<?php else: ?>
																		₱<?php echo $product_row['price'] ?>
																	<?php endif; ?>
																</td>
																<td class="action text-center">
																	<?php if($product_row['stock'] <= 0): ?>
																		<a class="action"><i class="fa fa-shopping-cart"></i></a>
																	<?php else: ?>
																		<a class="action wishlists-cart" href="/etiendahan/customer/wishlists/cart/" id="<?php echo $product_row['id'] ?>"><i class="fa fa-shopping-cart"></i></a>
																	<?php endif; ?>
																	<span>|</span>
																	<a class="action wishlists-delete" href="/etiendahan/customer/wishlists/delete/" id="<?php echo $product_row['id'] ?>"><i class="fa fa-close"></i></a>
																</td>
															</tr>
															<?php endif; ?>
													<?php endwhile; ?>
												</tbody>
											</table>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF CUSTOMER PAGE SECTION 1 -->

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-info-circle mr-1 alert-primary"></i>Completed!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['message']) ) {
								echo $_SESSION['message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->		

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification-logout-redirect" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close-logout-redirect" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-danger"></i>Can't proceed!</div>
					<div class="popup-content-logout-redirect text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['cant-proceed-message']) ) {
								echo $_SESSION['cant-proceed-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['cant-proceed-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->	

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>