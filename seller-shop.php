<?php  
	require '/db.php';
	session_start();

	$logged_in 			= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
	$seller_shop_email 	= ((isset($_SESSION['seller_shop_email']) && $_SESSION['seller_shop_email'] != '')?htmlentities($_SESSION['seller_shop_email']):'');

	if($seller_shop_email == '') {
		header("location: /etiendahan/"); 
	}

	$result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$seller_shop_email'");
	$user 	= $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $user['fullname']; ?> Online Shop - Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">
	
	<!-- link inner -->
	<?php  
		include 'header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="order-view-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include 'header.php';
				?>

				<!-- SELLER SHOP PAGE SECTION 1 -->
				<div id="etiendahan-seller-shop-page">
					<div class="container">
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="seller-shop-name-wrapper">
									<img src="/etiendahan/temp-img/fa-shop.png" alt="..." class="seller-image">
									<div class="seller-shop-name"><?php echo $user['fullname']; ?> Shop</div>
									<div class="seller-shop-email mb-2"><a href="mailto:<?php echo $seller_shop_email; ?>" target="_blank"><?php echo $seller_shop_email; ?></a></div>
									<?php   $date_joined_result = $mysqli->query("SELECT TIMESTAMPDIFF(MONTH, joined_at, NOW()) FROM tbl_sellers WHERE seller_email = '$seller_shop_email'");
											$date_joined_row = $date_joined_result->fetch_assoc();
									?>
									<div class="joined"><i class="fa fa-check"></i><i class="fa fa-user-o"></i> 
									<?php if($date_joined_row['TIMESTAMPDIFF(MONTH, joined_at, NOW())'] == 0): ?>
									 	<?php 
									 		$date_joined_result_week = $mysqli->query("SELECT FLOOR(DATEDIFF(DATE(NOW()),DATE(joined_at))/7) FROM tbl_sellers WHERE seller_email = '$seller_shop_email'");
											$date_joined_row_week = $date_joined_result_week->fetch_assoc();

											$date_joined_result_day = $mysqli->query("SELECT DATEDIFF(NOW(),joined_at) FROM tbl_sellers WHERE seller_email = '$seller_shop_email'");
											$date_joined_row_day = $date_joined_result_day->fetch_assoc();										
									 	?>
									 	<?php if($date_joined_row_day['DATEDIFF(NOW(),joined_at)'] == 0): ?>
									 		Joined: This day
									 	<?php else: ?>
										 	<?php if($date_joined_row_week['FLOOR(DATEDIFF(DATE(NOW()),DATE(joined_at))/7)'] == 0 ): ?>
										 		Joined: This week
										 	<?php elseif($date_joined_row_week['FLOOR(DATEDIFF(DATE(NOW()),DATE(joined_at))/7)'] == 1 ): ?>
										 		Joined: <?php echo $date_joined_row_week['FLOOR(DATEDIFF(DATE(NOW()),DATE(joined_at))/7)']; ?> Week Ago
										 	<?php else: ?>
										 		Joined: <?php echo $date_joined_row_week['FLOOR(DATEDIFF(DATE(NOW()),DATE(joined_at))/7)']; ?> Weeks Ago
										 	<?php endif; ?>
									 	<?php endif; ?>










								 	<?php elseif($date_joined_row['TIMESTAMPDIFF(MONTH, joined_at, NOW())'] == 1): ?>
										Joined: <?php echo $date_joined_row['TIMESTAMPDIFF(MONTH, joined_at, NOW())']; ?> Month Ago
								 	<?php else: ?>
								 		Joined: <?php echo $date_joined_row['TIMESTAMPDIFF(MONTH, joined_at, NOW())']; ?> Months Ago
								 	<?php endif; ?>
									</div>
									<div class="rating"><i class="fa fa-star-o"></i> Rating: 4.7 Out Of 5 (9999 Ratings)</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 p-0 mt-4">
								<!-- SECTION 5 - Seller shop all products -->
								<div id="etiendahan-section-5" class="etiendahan-section">
									<div class="container">
										<div class="title-name">
											<h3><span class="wow pulse" data-wow-delay="1000ms">ALL PRODUCTS</span></h3>
										</div>
										
										<div class="item-wrapper">

											<?php 
												$result_product = $mysqli->query("SELECT * FROM tbl_products WHERE seller_email='$seller_shop_email' GROUP BY name");
												while($product_row = mysqli_fetch_assoc($result_product)):
										 	?>
													<div class="item">
													<?php 
														$product_id = $product_row['id'];
														$date_joined_result_day = $mysqli->query("SELECT DATEDIFF(NOW(),created_at) FROM tbl_products WHERE id = '$product_id'");
														$date_joined_row_day = $date_joined_result_day->fetch_assoc();	
														
														if($date_joined_row_day['DATEDIFF(NOW(),created_at)'] < 3):
													?>
													<div class="ribbon view-product ribbon--dimgrey">NEW</div>
													<?php endif; ?>
														<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>" style="width: 100%;">
															<div class="card">
																<?php $saved_image = explode(',', $product_row['image']); ?>
																<div class="card-image lazy" data-src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>"></div>
																<div class="card-body">
																	<div class="product-name"><?php echo $product_row['name']; ?></div>
																	<div class="product-price">₱<?php echo $product_row['price']; ?></div>
																	<div class="product-rating">
																		<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
																	</div>
																</div>
															</div>
														</a>
													</div>
											<?php endwhile; ?>
										</div>

										<!-- <div class="pagination-wrapper ml-auto">
											<nav aria-label="...">
												<ul class="pagination pagination-lg">
													<li class="page-item disabled">
														<a class="page-link" href="#" tabindex="-1">Previous</a>
													</li>
													<li class="page-item"><a class="page-link" href="#">1</a></li>
													<li class="page-item"><a class="page-link" href="#">2</a></li>
													<li class="page-item"><a class="page-link" href="#">3</a></li>
													<li class="page-item">
														<a class="page-link" href="#">Next</a>
													</li>
												</ul>
											</nav>
										</div> -->
									</div>
								</div>
								<!-- END OF SECTION 5 -->
							</div>
						</div>
					</div>
				</div>
				<!-- END OF SELLER SHOP PAGE SECTION 1 -->

<!-- footer inner -->
<?php  
	include 'footer.php';
?>
</html>