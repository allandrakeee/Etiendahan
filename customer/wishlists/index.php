<?php  
	require '../../db.php';
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	// Check if user is logged in using the session variable
	if ( $logged_in == false ) {
		$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your profile page";
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
	<title>Wishlists | Etiendahan Dagupan</title>
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
												Orders
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header active" role="tab" id="headingThree">
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
																		<a href="/etiendahan/category/view/product/" class="d-block my-item-inner category-product-id" id="<?php echo $product_row['id']; ?>">
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
																		<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>"><?php echo $product_row['name']; ?></a>
																	<?php endif; ?>
																</td>
																<td class="item-price text-center">
																	<?php if($product_row['stock'] <= 0): ?>
																		<span class="text-danger">Not Available</span>
																	<?php else: ?>
																		₱<?php echo $product_row['price'] ?>
																	<?php endif; ?>
																</td>
																<td class="action text-center">
																	<?php if($product_row['stock'] <= 0): ?>
																		<a class="action wishlists-delete"><i class="fa fa-shopping-cart"></i></a>
																	<?php else: ?>
																		<a class="action wishlists-delete" href=""><i class="fa fa-shopping-cart"></i></a>
																	<?php endif; ?>
																	<span>|</span>
																	<a class="action wishlists-delete" href="/etiendahan/customer/wishlists/delete/" id="<?php echo $product_row['id'] ?>"><i class="fa fa-close"></i></a>
																</td>
															</tr>
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

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>