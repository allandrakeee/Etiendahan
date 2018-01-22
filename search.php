<?php  
	require '/db.php';
	session_start();

	$logged_in = ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
	// $term = $_SESSION['term'];
	$term = $_SESSION['search'];
	// echo $term;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search Result | Etiendahan Dagupan</title>
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

				<!-- SEARCH RESULT -->
				<div id="etiendahan-seller-shop-page">
					<div class="container">
						<div class="row">
							<div class="col-md-12 p-0 mt-4">
								<!-- SECTION 5 - ll products -->
								<div id="etiendahan-section-5" class="etiendahan-section">
									<div class="container">
										<div class="title-name">
											<h3><span class="wow pulse" data-wow-delay="1000ms">SEARCH RESULT</span></h3>
										</div>
										
										<div class="item-wrapper">
											<?php  
												$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE stock > 0 AND banned = 0 and name LIKE '%$term%' ORDER BY RAND(".date("Ymd").")");
												if($product_result->num_rows > 0):
											?>
											<div class="dont-find-product">Dont find what are you looking for? Click <a href="/etiendahan/post-page/" class="post-page" id="<?php echo $term; ?>">here</a> to post to our facebook page to find a seller for you.</div>
											<div class="search-result">Your search for "<?php echo $term; ?>" revealed the following:</div>
											<?php 
												  while($product_row = mysqli_fetch_assoc($product_result)): ?>
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
												<div class="dont-find-product">Dont find what are you looking for? Click <a href="/etiendahan/post-page/" class="post-page" id="<?php echo $term; ?>">here</a> to post to our facebook page to find a seller for you.</div>
												<div class="search-result">Your search for "<?php echo $term; ?>" did not yield any results.</div>
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
								<!-- END OF SECTION 5 -->
							</div>
						</div>
					</div>
				</div>
				<!-- END OF SEARCH RESULT -->

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-info-circle mr-1 alert-primary"></i>Completed!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['successfully-posted']) ) {
								echo $_SESSION['successfully-posted'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['successfully-posted'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->

<!-- footer inner -->
<?php  
	include 'footer.php';
?>
</html>