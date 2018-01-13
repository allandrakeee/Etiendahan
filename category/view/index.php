<?php  
	require '/../../db.php';
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
	$category_id = ((isset($_SESSION['category_id']) && $_SESSION['category_id'] != '')?htmlentities($_SESSION['category_id']):'');

	$result_category = $mysqli->query("SELECT * FROM tbl_categories WHERE id = '$category_id'");
	$row_category = $result_category->fetch_assoc();
	echo $category_id;
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
									<div class="price-range-filter">
										<label>
											<input type="radio" name="inlineRadioOptions" id="inlineRadioLowToHigh" value="optionLowToHigh" required> Low to High
										</label>

										<label>
											<input type="radio" name="inlineRadioOptions" id="inlineRadioHighToLow" value="optionHighToLow" required> High to Low
										</label>


										<input class="number" type="number" placeholder="₱ MIN">
										<div class="separator"></div>
										<input class="number" type="number" placeholder="₱ MAX">
									</div>
									<button class="btn btn-primary">Apply</button>
									<div class="separator-button"></div>
									<button class="btn btn-primary">Clear All</button>
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


										$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE sub_id IN($in_sub_id) AND stock != 0 AND banned = 0 ORDER BY RAND()");
										if($product_result->num_rows > 0):
										while($product_row = mysqli_fetch_assoc($product_result)):
									?>

									<div class="item">
										<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
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