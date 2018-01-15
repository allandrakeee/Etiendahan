<?php  
	require '/db.php';
	session_start();

	$logged_in = ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
	$sub_category_name = ((isset($_SESSION['sub_category_name']) && $_SESSION['sub_category_name'] != '')?htmlentities($_SESSION['sub_category_name']):'');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Related Prducts | Etiendahan Dagupan</title>
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
													$sub_id_result = $mysqli->query("SELECT GROUP_CONCAT(id) FROM tbl_categories_sub WHERE name = '$sub_category_name'");
													$sub_id_row = $sub_id_result->fetch_assoc();
													$in_sub_id = $sub_id_row['GROUP_CONCAT(id)'];
													// echo $in_sub_id;
													// echo $category_product_id;


													$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE sub_id IN($in_sub_id) AND stock != 0 AND banned = 0 ORDER BY RAND(".date("Ymd").")");
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