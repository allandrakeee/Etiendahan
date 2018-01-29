<?php  
	require '/../../db.php';
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
	$category_id = ((isset($_SESSION['category_id']) && $_SESSION['category_id'] != '')?htmlentities($_SESSION['category_id']):'');

	if($category_id == '') {
		header("location: /etiendahan/"); 
	}

	$result_category = $mysqli->query("SELECT * FROM tbl_categories WHERE id = '$category_id'");
	$row_category = $result_category->fetch_assoc();
	// echo $category_id;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Buy <?php echo $row_category['name']; ?> Online | Etiendahan Dagupan</title>
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
	<div id="about-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include '../../header.php';
				?>				

				<!-- CATEGORY PAGE -->
				<div id="etiendahan-category-page">
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<div class="container">
								<li class="breadcrumb-item"><a href="/etiendahan/" title="Back to the frontpage"><i class="fa fa-home"></i>Home</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?php echo $row_category['name']; ?></li>
							</div>
						</ol>
					</nav>

					<div class="container category">
						<div class="row">
							<div class="col-md-3">
								<div class="sidebar-wrapper">
									<div class="header text-center"><i class="fa fa-list fa-fw"></i>Categories</div>
									<div class="title active"><a href=""><?php echo $row_category['name']; ?></a></div>
									<div class="sub">
										<ul>
											<?php  
												$result_category_sub = $mysqli->query("SELECT * FROM tbl_categories_sub WHERE parent_id = '$category_id'");
												while($row_category_sub = mysqli_fetch_assoc($result_category_sub)):
											?>
											<li><a href="/etiendahan/category/view/sub/" class="go-to-sub" id="<?php echo $row_category_sub['id']; ?>"><i class="fa fa-angle-right fa-fw"></i><?php echo $row_category_sub['name']; ?></a></li>
											<?php endwhile; ?>
										</ul>
									</div>
								</div>

								<div class="sidebar-wrapper">
									<div class="header text-center"><i class="fa fa-filter fa-fw"></i>SEARCH FILTER</div>
									<div class="search-filter-price-range">Price Range</div>
									<?php $product_sort = ((isset($_POST['sort']) && $_POST['sort'] != '')?htmlentities($_POST['sort']):''); ?>
									<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
										<div class="price-range-filter">
											<label>
												<input type="radio" id="inlineRadioLowToHigh" value="replace(replace(price, ',', ''), '.', '')+0 asc" name="sort" <?php if($product_sort=="replace(replace(price, ',', ''), '.', '')+0 asc") echo "checked";?> required> Low to High
											</label>

											<label>
												<input type="radio" id="inlineRadioHighToLow" value="replace(replace(price, ',', ''), '.', '')+0 desc" name="sort" <?php if($product_sort=="replace(replace(price, ',', ''), '.', '')+0 desc") echo "checked";?> required> High to Low
											</label>


											<!-- <input class="number" type="number" placeholder="₱ MIN">
											<div class="separator"></div>
											<input class="number" type="number" placeholder="₱ MAX"> -->
										</div>
										<button type="submit" class="btn btn-primary">Apply</button>
									</form>
									<div class="separator-button"></div>
									<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
										<button class="btn btn-primary" value="" name="sort">Clear All</button>
									</form>
									<div class="separator-bottom"></div>
								</div>
							</div>

							<div class="col-md-9">
								<div class="item-grid-list-option text-right">
									<a href="" id="grid" class="grid active"><li class="fa fa-th"></li></a>
									<a href="" id="list"><li class="fa fa-list"></li></a>
								</div>

								<div class="item-wrapper" id="item-wrapper-grid-list">
									<?php  
										$sub_id_result = $mysqli->query("SELECT GROUP_CONCAT(id) FROM tbl_categories_sub WHERE parent_id = '$category_id'");
										$sub_id_row = $sub_id_result->fetch_assoc();
										$in_sub_id = $sub_id_row['GROUP_CONCAT(id)'];
										// echo $in_sub_id;

										// $_REQUEST['sort'] = "replace(replace(price, ',', ''), '.', '')+0 desc";
										$sort_request = ((isset($_REQUEST['sort']) && $_REQUEST['sort'] != '')?htmlentities($_REQUEST['sort']):'');
										$product_order = ($sort_request == '') ? "RAND(".date("Ymd").")" : $sort_request;
										$sql = "SELECT * FROM tbl_products WHERE sub_id IN($in_sub_id) AND stock > 0 AND banned = 0 ORDER BY ".$product_order;
										$product_result = $mysqli->query($sql);
										if($product_result->num_rows > 0):
										while($product_row = mysqli_fetch_assoc($product_result)):
										$product_id = $product_row['id'];
									?>

									<div class="item">
									<?php 
										$date_joined_result_day = $mysqli->query("SELECT DATEDIFF(NOW(),created_at) FROM tbl_products WHERE id = '$product_id'");
										$date_joined_row_day = $date_joined_result_day->fetch_assoc();	
										
										if($date_joined_row_day['DATEDIFF(NOW(),created_at)'] < 3):
									?>
									<div class="ribbon view ribbon--dimgrey">NEW</div>
									<?php endif; ?>
										<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
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
							</div>
						</div>
					</div>
				</div>
				<!-- END OF ELECTRONICS PAGE -->

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>