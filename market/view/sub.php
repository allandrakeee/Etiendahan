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
	$category_id = ((isset($_SESSION['product_category']) && $_SESSION['product_category'] != '')?htmlentities($_SESSION['product_category']):'');
	$municipality_id = ((isset($_SESSION['municipality_id']) && $_SESSION['municipality_id'] != '')?htmlentities($_SESSION['municipality_id']):'');
	
	$sub_category_id = ((isset($_SESSION['sub_category_id']) && $_SESSION['sub_category_id'] != '')?htmlentities($_SESSION['sub_category_id']):'');
	$result_sub_category = $mysqli->query("SELECT * FROM tbl_categories_sub WHERE id = '$sub_category_id'");
	$row_sub_category = $result_sub_category->fetch_assoc();

	$result_category = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE id = '$category_id'");
	$row_category = $result_category->fetch_assoc();
	// echo $sub_category_id;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Buy <?php echo ($category_id == 1) ? 'Manufactured Products' : 'Non-manufactured Products'; ?> Online | Etiendahan</title>
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
								<li class="breadcrumb-item"><a href="/etiendahan/market/view/">Products</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?php echo ($category_id == 1) ? 'Manufactured Products' : 'Non-manufactured Products'; ?></li>
							</div>
						</ol>
					</nav>

					<div class="container category">
						<div class="row">
							<div class="col-md-3" style="padding-right: 0">
								<div class="sidebar-wrapper">
									<div class="header text-center"><i class="fa fa-list fa-fw"></i>Categories</div>
									<div class="title"><a href="/etiendahan/market/view/">Products</a></div>
									<div class="sub">
										<ul>
											<?php if($category_id == 1): ?>
											<li class="active"><a href="/etiendahan/market/view/sub/" class="product-category" id="1">Manufactured Products (<?php
												$total_count_id = 1;
												$result = $mysqli->query("SELECT count(*) as 'count_tbl_products' FROM `tbl_products` where category_id = '$total_count_id' AND stock > 0 AND banned = 0");
												$count_tbl_products = $result->fetch_assoc();
												echo $count_tbl_products['count_tbl_products'];
											 ?>)</a></li>
											<li class=""><a href="/etiendahan/market/view/sub/" class="product-category" id="2">Non-manufactured Products (<?php
												$total_count_id = 2;
												$result = $mysqli->query("SELECT count(*) as 'count_tbl_products' FROM `tbl_products` where category_id = '$total_count_id' AND stock > 0 AND banned = 0");
												$count_tbl_products = $result->fetch_assoc();
												echo $count_tbl_products['count_tbl_products'];
											 ?>)</a></li>
											<?php elseif($category_id == 2): ?>
											<li class=""><a href="/etiendahan/market/view/sub/" class="product-category" id="1">Manufactured Products (<?php
												$total_count_id = 1;
												$result = $mysqli->query("SELECT count(*) as 'count_tbl_products' FROM `tbl_products` where category_id = '$total_count_id' AND stock > 0 AND banned = 0");
												$count_tbl_products = $result->fetch_assoc();
												echo $count_tbl_products['count_tbl_products'];
											 ?>)</a></li>
											<li class="active"><a href="/etiendahan/market/view/sub/" class="product-category" id="2">Non-manufactured Products (<?php
												$total_count_id = 2;
												$result = $mysqli->query("SELECT count(*) as 'count_tbl_products' FROM `tbl_products` where category_id = '$total_count_id' AND stock > 0 AND banned = 0");
												$count_tbl_products = $result->fetch_assoc();
												echo $count_tbl_products['count_tbl_products'];
											 ?>)</a></li>
											<?php endif; ?>
										</ul>
									</div>
								</div>

								<div class="sidebar-wrapper">
									<div class="header text-center"><i class="fa fa-filter fa-fw"></i>SEARCH FILTER</div>

									<?php $product_sort = ((isset($_POST['sort']) && $_POST['sort'] != '')?htmlentities($_POST['sort']):''); ?>
									<?php $location_sort = ((isset($_POST['locations']) && $_POST['locations'] != '')?htmlentities($_POST['locations']):''); ?>
									<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
										<div class="search-filter-price-range">Location</div>

										<select name="locations" class="form-control" style="margin-left: 20px; margin-right: 20px; width: 85%;">
											<option value="">All Locations</option>
											<?php
                        					$sic_owner_result = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE provCode = '0155' ORDER BY citymunDesc");
							                while($sic_owner_row = mysqli_fetch_assoc($sic_owner_result)):
							                	$result_id = $sic_owner_row['id'];
												$category_id_result = "AND municipality_id = '$result_id'";
							                	$category_name = strtolower($sic_owner_row['citymunDesc']);
							                ?>

						                        <option value="AND municipality_id = '<?php echo $sic_owner_row['id'];?>'" <?php if($location_sort == $category_id_result) echo 'selected'; ?>><?php echo ucwords($category_name);?></option>

							                <?php endwhile; ?>
										</select>

										<div class="search-filter-price-range">Price Range</div>
										<div class="price-range-filter">
											<label>
												<input type="radio" id="inlineRadioLowToHigh" value="replace(replace(price, ',', ''), '.', '')+0 asc" name="sort" <?php if($product_sort=="replace(replace(price, ',', ''), '.', '')+0 asc") echo "checked";?>> Low to High
											</label>

											<label>
												<input type="radio" id="inlineRadioHighToLow" value="replace(replace(price, ',', ''), '.', '')+0 desc" name="sort" <?php if($product_sort=="replace(replace(price, ',', ''), '.', '')+0 desc") echo "checked";?>> High to Low
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
										$sort_request = ((isset($_REQUEST['sort']) && $_REQUEST['sort'] != '')?htmlentities($_REQUEST['sort']):'');
										$locations_request = ((isset($_REQUEST['locations']) && $_REQUEST['locations'] != '')?htmlentities($_REQUEST['locations']):'');
										$product_order = ($sort_request == '') ? "id desc" : $sort_request;
										$location_order = ($locations_request == '') ? "" : $locations_request;

										$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE category_id = '$category_id' AND stock > 0 AND banned = 0 $location_order ORDER BY ".$product_order);
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
										<a href="/etiendahan/market/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
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