<?php  
	require '/db.php';
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

	$logged_in = ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
	echo $sub_category_name = ((isset($_SESSION['sub_category_name']) && $_SESSION['sub_category_name'] != '')?htmlentities($_SESSION['sub_category_name']):'');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Related Prducts | Etiendahan</title>
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

				<!-- DAILY DISCOVER -->
				<div id="etiendahan-seller-shop-page">
					<div class="container">
						<div class="row">
							<div class="col-md-12 p-0 mt-4">
								<!-- SECTION 5 - Related products -->
								<div id="etiendahan-section-5" class="etiendahan-section">
									<div class="container">
										<div class="title-name">
											<h3><span class="wow pulse" data-wow-delay="1000ms">RELATED PRODUCTS</span></h3>
										</div>
										
										<div class="item-wrapper">

											
												<?php 


													$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE category_id = '$sub_category_name' AND stock > 0 AND banned = 0 ORDER BY RAND(".date("Ymd").")");
													if($product_result->num_rows > 0):
													while($product_row = mysqli_fetch_assoc($product_result)): 
													$product_id = $product_row['id'];
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
														<a href="/etiendahan/market/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>" style="width: 100%;">
															<div class="card">
																<?php $saved_image = explode(',', $product_row['image']); ?>
																<div class="card-image lazy" data-src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>"></div>
																<div class="card-body">
																	<div class="product-name"><?php echo $product_row['name']; ?></div>
																	<div class="product-price">₱<?php echo $product_row['price']; ?></div>
																	<div class="product-rating" style="height: 18px;">
																		<?php  
																			$ratings_result_count1 = $mysqli->query("SELECT COUNT(*) AS 'total' FROM tbl_ratings WHERE product_id = '$product_id'");
																			$ratings_row_count1 = $ratings_result_count1->fetch_assoc();
																			$ratings_count1 = $ratings_row_count1['total'];


																			$ratings_result_avg1 = $mysqli->query("SELECT tbl_products.id, tbl_products.name, AVG(tbl_ratings.rating) AS rating FROM tbl_products LEFT JOIN tbl_ratings ON tbl_products.id = tbl_ratings.product_id AND tbl_ratings.product_id = '$product_id'");
																			$ratings_row_avg1 = $ratings_result_avg1->fetch_assoc();
																			$ratings_avg1 = round($ratings_row_avg1['rating']);												
																		?>
																		<?php  
																			$ratins_result_row1 = $mysqli->query("SELECT * FROM tbl_ratings WHERE product_id = '$product_id'");
																			if($ratins_result_row1->num_rows == 0):
																		?>
																			No reviews yet
																		<?php else: ?>
																				<?php  
																					$ii=1;
																					for($ii;$ii<=$ratings_avg1;$ii++):
																				?>
																					<i class="fa fa-star" style="width: 10px;"></i>
																				<?php endfor; ?>
																				<?php if($ii <= 5): ?>
																					<?php 
																						for($ii;$ii<=5;$ii++):
																					?>
																						<i class="fa fa-star-o" style="width: 10px;"></i>
																					<?php endfor; ?>
																				<?php endif; ?>
																			 		(<?php echo $ratings_count1; ?>)								 		 	
																		<?php endif; ?>
																	</div>
																</div>
															</div>
														</a>
													</div>
											<?php endwhile; ?>
											<?php else: ?>
												<div class="">No Products Yet</div>
											<?php endif; ?>
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
								<!-- END OF SECTION 5 - Related products -->
							</div>
						</div>
					</div>
				</div>
				<!-- END OF DAILY DISCOVER -->

<!-- footer inner -->
<?php  
	include 'footer.php';
?>
</html>