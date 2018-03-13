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
	$category_product_id = ((isset($_SESSION['category_product_id']) && $_SESSION['category_product_id'] != '')?htmlentities($_SESSION['category_product_id']):'');
	$category_product_id_sightings = ((isset($_SESSION['category_product_id_sightings']) && $_SESSION['category_product_id_sightings'] != '')?htmlentities($_SESSION['category_product_id_sightings']):'');
	$email_go_to_recently_viewed_products = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');

	if($category_product_id_sightings != '') {
		$mysqli->query("UPDATE tbl_products SET sightings = sightings + 1 WHERE id = '$category_product_id_sightings'") or die($mysqli->error);
		unset($_SESSION['category_product_id_sightings']);
	}

	if($logged_in == true) {
		$recently_viewed_products_result = $mysqli->query("SELECT * FROM tbl_recently_viewed_products WHERE product_id = '$category_product_id' AND email = '$email_go_to_recently_viewed_products'");
		if ($recently_viewed_products_result->num_rows == 0) {
	        $sql = "INSERT INTO tbl_recently_viewed_products (id, product_id, email, created_at, modified_at) VALUES (null, '$category_product_id', '$email_go_to_recently_viewed_products', NOW(), NOW())";
			$mysqli->query($sql);
		} else {
			$sql = "UPDATE tbl_recently_viewed_products SET modified_at = NOW() WHERE product_id = '$category_product_id'";
			$mysqli->query($sql);
		}
	}

	if($category_product_id == '') {
		header("location: /etiendahan/"); 
	}

	$result_product = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$category_product_id'");
	$row_product = $result_product->fetch_assoc();
	// echo 'Sub ID'.$row_product['sub_id'].'<br>';
	$category_id = $row_product['category_id'];
	$municipality = $row_product['municipality_id'];

	if($row_product['stock'] <= 0) {
		header('location: /etiendahan/market/view/');
	} 
	$_SESSION['category_id'] = $category_id;
	$_SESSION['municipality_id'] = $municipality;
	$category_id = ((isset($_SESSION['category_id']) && $_SESSION['category_id'] != '')?htmlentities($_SESSION['category_id']):'');

	$result_category = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE id = '$municipality'");
	$row_category = $result_category->fetch_assoc();
	// echo $row_category['citymunDesc']
?>

<!DOCTYPE html>
<html>
<head>
	<title>Buy <?php echo $row_product['name'] ?> Online | Etiendahan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">

	<meta property="og:url"                content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="When Great Minds Don’t Think Alike" />
	<meta property="og:description"        content="How much does culture influence creative thinking?" />
	<meta property="og:image"              content="https://cfshopeeph-a.akamaihd.net/file/31a0944aada3b99fd34778ff7118f669_tn" />
	
	<!-- link inner -->
	<?php  
		include '../../header-link.php';
	?>

</head>

<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require '/../../c8NLPYLt-functions/wishlists-function.php';  
	}
?>

<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="view-product-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include '../../header.php';
				?>				

				<!-- VIEW PAGE -->
				<div id="etiendahan-view-product-page">
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<div class="container">
								<li class="breadcrumb-item"><a href="/etiendahan/" title="Back to the frontpage"><i class="fa fa-home"></i>Home</a></li>
								<li class="breadcrumb-item"><a href="/etiendahan/market/view/sub/" class="my-gallery-inner <?php echo $municipality ?>" data-value="<?php echo $municipality ?>"><?php echo $row_category['citymunDesc'] ?></a></li>
								<li class="breadcrumb-item active product-view" style="width: auto" aria-current="page"><?php echo trim($row_product['name']) ?></li>
							</div>
						</ol>
					</nav>

					<div class="container view-product">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12">
										<?php 
											$product_id = $row_product['id'];
											$date_joined_result_day = $mysqli->query("SELECT DATEDIFF(NOW(),created_at) FROM tbl_products WHERE id = '$product_id'");
											$date_joined_row_day = $date_joined_result_day->fetch_assoc();	
											
											if($date_joined_row_day['DATEDIFF(NOW(),created_at)'] < 3):
										?>
										<div class="ribbon product-image ribbon--dimgrey">NEW</div>
										<?php endif; ?>
										<div class="product-slider">
										    <ul id="lightSlider">
										        <?php
													$imagei = 1;  
													$result_product_image = $mysqli->query("SELECT image FROM tbl_products WHERE id='$category_product_id'");
													while($product_row_image = mysqli_fetch_assoc($result_product_image)):
														$saved_image = explode(',', $product_row_image['image']);
														foreach ($saved_image as $saved):
															if($product_row_image['image'] != ''):
												?>			
																<li data-thumb="<?php echo $saved ?>">
														            <div style="background-image: url(<?php echo $saved ?>); width: 100%; height: 450px; background-position: center center; background-size: cover; border: #dcdcdc solid 1px; cursor: default;"></div>
														        </li>
															<?php else: ?>
																<li data-thumb="http://via.placeholder.com/450?text=No+Image+Preview">
														            <img src="http://via.placeholder.com/450?text=No+Image+Preview" />
														        </li>
															<?php endif; ?>
														<?php $imagei++; ?>
													<?php endforeach; ?>
												<?php endwhile; ?>	
										    </ul>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
	 							<div class="product-shop-wrapper">
	 								<div class="product-name-wrapper">
		 								<div class="product-name">
		 									<?php echo $row_product['name'] ?>
		 								</div>
		 							</div>

	 								<div class="product-detail">
	 									<div class="product-price">₱<?php echo $row_product['price'] ?></div>
	 									<div class="product-rating">
	 										<?php  
												$ratings_result_count = $mysqli->query("SELECT COUNT(*) AS 'total' FROM tbl_ratings WHERE product_id = '$category_product_id'");
												$ratings_row_count = $ratings_result_count->fetch_assoc();
												$ratings_count = $ratings_row_count['total'];


												$ratings_result_avg = $mysqli->query("SELECT tbl_products.id, tbl_products.name, AVG(tbl_ratings.rating) AS rating FROM tbl_products LEFT JOIN tbl_ratings ON tbl_products.id = tbl_ratings.product_id AND tbl_ratings.product_id = '$category_product_id'");
												$ratings_row_avg = $ratings_result_avg->fetch_assoc();
												$ratings_avg = round($ratings_row_avg['rating']);												
											?>
											<?php  
												$ratins_result_row = $mysqli->query("SELECT * FROM tbl_ratings WHERE product_id = '$category_product_id'");
												if($ratins_result_row->num_rows == 0):
											?>
													Be the first to review this product
											<?php else: ?>
													<?php  
														$i=1;
														for($i;$i<=$ratings_avg;$i++):
													?>
														<i class="fa fa-star" style="width: 10px;"></i>
													<?php endfor; ?>
													<?php if($i <= 5): ?>
														<?php 
															for($i;$i<=5;$i++):
														?>
															<i class="fa fa-star-o" style="width: 10px;"></i>
														<?php endfor; ?>
													<?php endif; ?>
												 		(<?php echo $ratings_count; ?>)								 		 	
											<?php endif; ?>
										</div>
	 									<!-- <div class="product-share">Share:</div> -->
	 								</div>

	 								<div class="product-seller pull-right">
	 									<?php   
	 										$email 	= $row_product['seller_email'];
 											$result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'");
											$user 	= $result->fetch_assoc();
										?>
	 									<span><?php echo $user['fullname']; ?></span>
										<a href="/etiendahan/seller-shop/">
											<button class="btn btn-primary view-shop" id="<?php echo $row_product['seller_email']; ?>">view shop</button>
										</a>
	 								</div>

	 								<div class="product-button">
	 									<div class="quantity">
	 										<div class="input-group">
												<span class="input-group-btn">
													<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
														<span class="fa fa-minus"></span>
													</button>
												</span>
								          		<input id="input-quantity" type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="<?php echo $row_product['stock'] ?>" disabled>
												<span class="input-group-btn">
													<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
														<span class="fa fa-plus"></span>
													</button>
												</span>
									      	</div>
	 									</div>
	 									<?php if($row_product['stock'] <= 5): ?>
	 										<?php if($row_product['stock'] == 1): ?>
	 										<div class="items-left text-danger"><?php echo $row_product['stock'];?> item left</div>
	 										<?php else: ?>
	 										<div class="items-left text-danger"><?php echo $row_product['stock'];?> items left</div>
	 										<?php endif; ?>
	 									<?php endif; ?>
	 									<form class="add-to-cart-form" action="/etiendahan/c8NLPYLt-functions/add-to-cart-function/" method="POST">
	 										<button class="btn btn-primary add-to-cart" type="submit" name="add_to_cart" id="<?php echo $category_product_id ?>">Add to Cart</button>
 										</form>
	 									<div class="product-add-to-wishlist" >
	 										<form class="wishlists-form" action="/etiendahan/market/view/product/" method="POST">
	 											<?php  
	 												$customer_email = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');
	 												$wishlist_result = $mysqli->query("SELECT * FROM tbl_wishlists WHERE product_id = '$category_product_id' AND email = '$customer_email'");
													if($wishlist_result->num_rows == 0):
	 											?>
			 										<input id="heart" class="wishlists-input check" type="checkbox" name="wishlists" value="yes">
													<label for="heart" class="">❤</label>
												<?php else: ?>
													<input id="heart1" class="wishlists-input checked" type="checkbox" name="wishlists" value="no">
													<label for="heart1" class="dimgrey">❤</label>
												<?php endif; ?>
											</form>
	 									</div>
	 								</div>
	 							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<nav class="nav nav-tabs" id="myTab" role="tablist">
									<a class="nav-item nav-link active" id="nav-information-tab" data-toggle="tab" href="#nav-information" role="tab" aria-controls="nav-information" aria-selected="true">Information</a>
									<a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews" role="tab" aria-controls="nav-reviews" aria-selected="false">Reviews</a>
								</nav>
								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade show active" id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab">
										<?php echo nl2br($row_product['description']); ?>
									</div>
									<div class="tab-pane fade" id="nav-reviews" role="tabpanel" aria-labelledby="nav-reviews-tab">
										<?php  
											$result = $mysqli->query("SELECT * FROM tbl_ratings WHERE product_id = '$category_product_id'");
											if($result->num_rows > 0):
										?>
												<div class="rating-header">
													<div class="head">Customer Reviews</div>
													<?php  
														$ratings_result_count = $mysqli->query("SELECT COUNT(*) AS 'total' FROM tbl_ratings WHERE product_id = '$category_product_id'");
														$ratings_row_count = $ratings_result_count->fetch_assoc();
														$ratings_count = $ratings_row_count['total'];


														$ratings_result_avg = $mysqli->query("SELECT tbl_products.id, tbl_products.name, AVG(tbl_ratings.rating) AS rating FROM tbl_products LEFT JOIN tbl_ratings ON tbl_products.id = tbl_ratings.product_id AND tbl_ratings.product_id = '$category_product_id'");
														$ratings_row_avg = $ratings_result_avg->fetch_assoc();
														$ratings_avg = round($ratings_row_avg['rating']);
														// echo $ratings_avg;
													?>
													<div class="rate-reviews">
														<?php  
															$i=1;
															for($i;$i<=$ratings_avg;$i++):
														?>
															<i class="fa fa-star" style="width: 15px;"></i>
														<?php endfor; ?>
														<?php if($i <= 5): ?>
															<?php 
																for($i;$i<=5;$i++):
															?>
																<i class="fa fa-star-o" style="width: 15px;"></i>
															<?php endfor; ?>
														<?php endif; ?>

														<?php  
															if($ratings_count == 1):
														?>
														 		<div class="d-inline-block ml-1">Based on <?php echo $ratings_count; ?> review</div>
													 	<?php else: ?>
												 		 		<div class="d-inline-block ml-1">Based on <?php echo $ratings_count; ?> reviews</div>
											 		 	<?php endif; ?>
													</div>
													<div class="write-a-review pull-right"><a data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="collapseExample">Write a review</a></div>
													<div class="collapse" id="review">
														<div class="card card-body">
															<div class="write-a-review">Write a review</div>

															<form action="/etiendahan/c8NLPYLt-functions/product-rating/" method="POST">
																<div class="form-group">
																	<label for="exampleRating">Rating</label>
															  		<!-- Rating Stars Box -->
																	<div class='rating-stars'>
																		<ul id='stars'>
																			<li class='star' title='1 star' id='1'>
																				<i class='fa fa-star'></i>
																			</li>
																			<li class='star' title='2 stars' id='2'>
																				<i class='fa fa-star'></i>
																			</li>
																			<li class='star' title='3 stars' id='3'>
																				<i class='fa fa-star'></i>
																			</li>
																			<li class='star' title='4 stars' id='4'>
																				<i class='fa fa-star'></i>
																			</li>
																			<li class='star' title='5 stars' id='5'>
																				<i class='fa fa-star'></i>
																			</li>
																		</ul>
																	</div>
																</div>	

																<div class="form-group">
																	<label for="exampleReviewTitle">Review title</label>
																	<input type="text" class="form-control" id="reviewTitle" placeholder="Give your review a title" name="title" required disabled>														
																</div>

																<div class="form-group">
																	<label for="exampleFormControlTextarea">Body of Review (1500)</label>
																	<textarea class="form-control" id="reviewBody" rows="10" maxlength="1500" placeholder="Write your comments here" name="body" required disabled></textarea>
																</div>

																<button type="submit" class="btn btn-primary pull-right submit-review" disabled>Submit Review</button>
															</form>
														</div>
													</div>
												</div>
												
												<?php  
													$ratings_result = $mysqli->query("SELECT * FROM tbl_ratings WHERE product_id = '$category_product_id' GROUP BY created_at desc");
													while($ratings_row = mysqli_fetch_assoc($ratings_result)):
												?>
														<div class="rate">
															<div class="rate-reviews">
																<?php  
																	$i=1;
																	for($i;$i<=$ratings_row['rating'];$i++):
																?>
																	<i class="fa fa-star" style="width: 15px;"></i>
																<?php endfor; ?>
																<?php if($i <= 5): ?>
																	<?php 
																		for($i;$i<=5;$i++):
																	?>
																		<i class="fa fa-star-o" style="width: 15px;"></i>
																	<?php endfor; ?>
																<?php endif; ?>
															</div>
															<div class="rate-title"><?php echo $ratings_row['title']; ?></div>
															<div class="rate-name-and-date">
																<strong>
																	<?php echo $ratings_row['fullname']; ?></strong> on <strong><?php
																		$phpdate = strtotime($ratings_row['created_at']);
																		echo $mysqldate = date('M j, Y', $phpdate);
																	?>
																</strong>
														</div>
															<div class="rate-body"><?php echo nl2br($ratings_row['body']); ?></div>
														</div>
												<?php endwhile; ?>
										<?php else: ?>
											<!-- no reviews yet -->
											<div class="rating-header">
												<div class="head">Customer Reviews</div>
												<div class="rate-reviews">Be the first to review this product</div>
												<div class="write-a-review pull-right"><a data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="collapseExample" style="text-decoration: none;">Write a review</a></div>
											</div>

											<div class="collapse" id="review">
												<div class="card card-body">
													<div class="write-a-review">Write a review</div>

													<form action="/etiendahan/c8NLPYLt-functions/product-rating/" method="POST">
														<div class="form-group">
															<label for="exampleRating">Rating</label>
													  		<!-- Rating Stars Box -->
															<div class='rating-stars'>
																<ul id='stars'>
																	<li class='star' title='1 star' id='1'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='2 stars' id='2'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='3 stars' id='3'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='4 stars' id='4'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='5 stars' id='5'>
																		<i class='fa fa-star'></i>
																	</li>
																</ul>
															</div>
														</div>	

														<div class="form-group">
															<label for="exampleReviewTitle">Review title</label>
															<input type="text" class="form-control" id="reviewTitle" placeholder="Give your review a title" name="title" required disabled>														
														</div>

														<div class="form-group">
															<label for="exampleFormControlTextarea">Body of Review (1500)</label>
															<textarea class="form-control" id="reviewBody" rows="10" maxlength="1500" placeholder="Write your comments here" name="body" required disabled></textarea>
														</div>

														<button type="submit" class="btn btn-primary pull-right submit-review" disabled>Submit Review</button>
													</form>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

						<!-- From the same shop -->
						<div id="etiendahan-section-3" class="etiendahan-section">
							<div class="container">
								<div class="title-name">
									<a href="/etiendahan/seller-shop/" class="view-shop" id="<?php echo $row_product['seller_email']; ?>">See all<i class="fa fa-chevron-right fa-fw"></i></a>
									<h3><span class="wow pulse" data-wow-delay="1500ms">FROM THE SAME SHOP</span></h3>
								</div>

								<div class="owl-carousel">
									<?php 
										$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE seller_email = '$email' AND id != '$category_product_id' AND stock > 0 AND banned = 0 ORDER BY id desc LIMIT 10");
										while($product_row = mysqli_fetch_assoc($product_result)): 
										$product_id = $product_row['id'];
									?>
									<div class="item">
									<?php
										$date_joined_result_day = $mysqli->query("SELECT DATEDIFF(NOW(),created_at) FROM tbl_products WHERE id = '$product_id'");
										$date_joined_row_day = $date_joined_result_day->fetch_assoc();	
										
										if($date_joined_row_day['DATEDIFF(NOW(),created_at)'] < 3):
									?>
									<div class="ribbon related ribbon--dimgrey">NEW</div>
									<?php endif; ?>
										<a href="/etiendahan/market/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
											<div class="card">
												<?php $saved_image = explode(',', $product_row['image']); ?>
												<div class="card-image img-fluid owl-lazy" data-src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>"></div>
												<div class="card-body">
													<div class="product-name"><?php echo $product_row['name'] ?></div>
													<div class="product-price">₱<?php echo $product_row['price'] ?></div>
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
								</div>
							</div>
						</div>
						<!-- END OF From the same shop -->

						<!-- SECTION 3 - Homepage related products -->
						<div id="etiendahan-section-3" class="etiendahan-section">
							<div class="container">
								<div class="title-name">
									<a href="/etiendahan/related-products/" class="related-products" id="<?php echo $category_id; ?>">See all<i class="fa fa-chevron-right fa-fw"></i></a>
									<h3><span class="wow pulse" data-wow-delay="1500ms">RELATED PRODUCTS</span></h3>
								</div>

								<div class="owl-carousel">
									<?php 
										$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE category_id = '$category_id' AND id != '$category_product_id' AND stock > 0 AND banned = 0 ORDER BY id desc LIMIT 10");
										while($product_row = mysqli_fetch_assoc($product_result)): 
										$product_id = $product_row['id'];
									?>
									<div class="item">
									<?php
										$date_joined_result_day = $mysqli->query("SELECT DATEDIFF(NOW(),created_at) FROM tbl_products WHERE id = '$product_id'");
										$date_joined_row_day = $date_joined_result_day->fetch_assoc();	
										
										if($date_joined_row_day['DATEDIFF(NOW(),created_at)'] < 3):
									?>
									<div class="ribbon related ribbon--dimgrey">NEW</div>
									<?php endif; ?>
										<a href="/etiendahan/market/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
											<div class="card">
												<?php $saved_image = explode(',', $product_row['image']); ?>
												<div class="card-image img-fluid owl-lazy" data-src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>"></div>
												<div class="card-body">
													<div class="product-name"><?php echo $product_row['name'] ?></div>
													<div class="product-price">₱<?php echo $product_row['price'] ?></div>
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
								</div>
							</div>
						</div>
						<!-- END OF SECTION 3 -->
					</div>
				</div>
				<!-- END OF VIEW PAGE -->

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