<?php  
	require '/../../db.php';
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
	<title>Orders | Etiendahan</title>
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
	<div id="orders-page" class="main-container">
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
										<div class="card-header" role="tab" id="headingThree">
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
								<div class="tab-content"><h1>Your Orders</h1></div>

								<?php  
									$result = $mysqli->query("SELECT * FROM tbl_orders WHERE email = '$email'");
									if($result->num_rows == 0):
								?>
										<!-- If orders is empty -->
										<p>You haven't placed any orders yet.</p>
										
									<?php else: ?>
										<!-- If wishlists is not empty -->

										<?php  
											$count_distinct_id_result = $mysqli->query("SELECT DISTINCT(unique_hash_id) as uniqid_order, created_at FROM `tbl_orders` WHERE email = '$email'");
											while($count_distinct_id_row = mysqli_fetch_assoc($count_distinct_id_result)):
										?>
											<div id="order-header" class="row">
												<div class="col-md-5">
													<div class="order-number">
														Order <a href="/etiendahan/customer/orders/view/" class="manage-order" id="<?php echo $count_distinct_id_row['uniqid_order']; ?>">#<?php echo $count_distinct_id_row['uniqid_order']; ?></a>
													</div>
													<div class="order-place-date">
														<?php 
															$phpdate = strtotime($count_distinct_id_row['created_at']);
															$mysqldate = date('M j, Y', $phpdate);
														?>

														Placed on <?php echo $mysqldate; ?>
													</div>
												</div>
												<div class="col-md-7 text-right">
													<div class="order-manage">
														<a href="/etiendahan/customer/orders/view/" class="manage-order" id="<?php echo $count_distinct_id_row['uniqid_order']; ?>">View order</a>
													</div>
												</div>
											</div>

											<div id="order-content" class="row">
												
												<?php  
													$unique_hash_id = $count_distinct_id_row['uniqid_order'];
													$product_distinct_result = $mysqli->query("SELECT * FROM `tbl_orders` WHERE unique_hash_id = '$unique_hash_id'");
													while($product_distinct_row = mysqli_fetch_assoc($product_distinct_result)):
												?>
												
												<?php $product_id =  $product_distinct_row['product_id'] ?>
												<?php $product_id_result = $mysqli->query("SELECT * FROM `tbl_products` WHERE id = '$product_id'");
													while($product_id_row = mysqli_fetch_assoc($product_id_result)): ?>
													
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-4">
																<div class="item-product">
																	<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner manage-order" id="<?php echo $count_distinct_id_row['uniqid_order']; ?>">
																		<div class="item-image">
																			<?php $saved_image = explode(',', $product_id_row['image']); ?>
																			<div class="img-fluid" style="background-image: url(<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>);"></div>
																		</div>
																	</a>
																</div>
															</div>
															<div class="col-md-8">
																<div class="item-name">
																	<a href="/etiendahan/customer/orders/view/"><?php echo $product_id_row['name']; ?></a>
																</div>
																
																<div class="item-status">
																	<a href="/etiendahan/customer/orders/view/">
																		<?php  
																			if($product_distinct_row['status'] == 'processing') {
																				echo 'Processing';
																			} else if($product_distinct_row['status'] == 'shipped') {
																				echo 'Shipped';
																			} else {
																				echo 'Delivered';
																			}
																		?>
																	</a>
																</div>
															</div>
														</div>
													</div>

												<?php endwhile; endwhile; ?>


												<div class="separator"></div>
											</div>
										<?php endwhile; ?>

										<!-- second row -->
										<!-- <div id="order-header" class="row">
											<div class="col-md-5">
												<div class="order-number">
													Order <a href="/etiendahan/customer/orders/view/">#123456</a>
												</div>
												<div class="order-place-date">
													Placed on 28/11/2017
												</div>
											</div>
											<div class="col-md-7 text-right">
												<div class="order-manage">
													<a href="/etiendahan/customer/orders/view/">Manage order</a>
												</div>
											</div>
										</div>
										<div id="order-content" class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-4">
														<div class="item-product">
															<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner">
																<div class="item-image">
																	<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/094a04b65c85439eeb96f8cfa54ed86b_tn);"></div>
																</div>
															</a>
														</div>
													</div>
													<div class="col-md-8">
														<div class="item-name">
															<a href="/etiendahan/customer/orders/view/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
														</div>
														
														<div class="item-status">
															<a href="/etiendahan/customer/orders/view/">Processing</a>
														</div>
													</div>
												</div>
											</div>
											<div class="separator"></div>
										</div> -->

										<!-- third row -->
										<!-- <div id="order-header" class="row">
											<div class="col-md-5">
												<div class="order-number">
													Order <a href="/etiendahan/customer/orders/view/">#123456</a>
												</div>
												<div class="order-place-date">
													Placed on 28/11/2017
												</div>
											</div>
											<div class="col-md-7 text-right">
												<div class="order-manage">
													<a href="/etiendahan/customer/orders/view/">Manage order</a>
												</div>
											</div>
										</div>
										<div id="order-content" class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-4">
														<div class="item-product">
															<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner">
																<div class="item-image">
																	<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/74268199fec22c7a27e665d4b2d1e736_tn);"></div>
																</div>
															</a>
														</div>
													</div>
													<div class="col-md-8">
														<div class="item-name">
															<a href="/etiendahan/customer/orders/view/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
														</div>
														
														<div class="item-status">
															<a href="/etiendahan/customer/orders/view/">Delivered</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-4">
														<div class="item-product">
															<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner">
																<div class="item-image">
																	<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/6ccef14930bf42a32f7d3580efa69a63_tn);"></div>
																</div>
															</a>
														</div>
													</div>
													<div class="col-md-8">
														<div class="item-name">
															<a href="/etiendahan/customer/orders/view/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
														</div>
														
														<div class="item-status">
															<a href="/etiendahan/customer/orders/view/">Closed</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-4">
														<div class="item-product">
															<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner">
																<div class="item-image">
																	<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/0511730fd313e860523e495f0f568b4d_tn);"></div>
																</div>
															</a>
														</div>
													</div>
													<div class="col-md-8">
														<div class="item-name">
															<a href="/etiendahan/customer/orders/view/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
														</div>
														
														<div class="item-status">
															<a href="/etiendahan/customer/orders/view/">Closed</a>
														</div>
													</div>
												</div>
											</div>
											<div class="separator"></div>
										</div> -->
									<?php endif; ?>
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