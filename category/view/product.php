<?php  
	require '/../../db.php';
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
	$category_product_id = ((isset($_SESSION['category_product_id']) && $_SESSION['category_product_id'] != '')?htmlentities($_SESSION['category_product_id']):'');
	$category_product_id_sightings = ((isset($_SESSION['category_product_id_sightings']) && $_SESSION['category_product_id_sightings'] != '')?htmlentities($_SESSION['category_product_id_sightings']):'');

	if($category_product_id_sightings != '') {
		$mysqli->query("UPDATE tbl_products SET sightings = sightings + 1 WHERE id = '$category_product_id_sightings'") or die($mysqli->error);
		unset($_SESSION['category_product_id_sightings']);
	}

	if($category_product_id == '') {
		header("location: /etiendahan/"); 
	}

	$result_product = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$category_product_id'");
	$row_product = $result_product->fetch_assoc();
	// echo 'Sub ID'.$row_product['sub_id'].'<br>';
	$sub_id = $row_product['sub_id'];

	if($row_product['stock'] <= 0) {
		header('location: /etiendahan/category/view/');
	} 

	$result_sub_id = $mysqli->query("SELECT * FROM tbl_categories_sub WHERE id = '$sub_id'");
	$row_sub_id = $result_sub_id->fetch_assoc();
	$category_id = $row_sub_id['parent_id'];
	$category_name = $row_sub_id['name'];

	$_SESSION['category_id'] = $category_id;
	$category_id = ((isset($_SESSION['category_id']) && $_SESSION['category_id'] != '')?htmlentities($_SESSION['category_id']):'');

	$result_category = $mysqli->query("SELECT * FROM tbl_categories WHERE id = '$category_id'");
	$row_category = $result_category->fetch_assoc();
	// echo $row_category['name']
?>

<!DOCTYPE html>
<html>
<head>
	<title>Buy <?php echo $row_product['name'] ?> Online | Etiendahan Dagupan</title>
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
								<li class="breadcrumb-item"><a href="/etiendahan/category/view/"><?php echo $row_category['name'] ?></a></li>
								<li class="breadcrumb-item active product-view" aria-current="page"><?php echo $row_product['name'] ?></li>
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
											<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
										</div>
	 									<!-- <div class="product-share">Share:</div> -->
	 								</div>

	 								<div class="product-seller pull-right">
	 									<?php   $email 	= $row_product['seller_email'];
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
								          		<input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="<?php echo $row_product['stock'] ?>" disabled>
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
	 									<button class="btn btn-primary" type="submit">Add to Cart</button>
	 									<div class="product-add-to-wishlist" >
	 										<form class="wishlists-form" action="/etiendahan/category/view/product/" method="POST">
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
										<div class="rating-header">
											<div class="head">Customer Reviews</div>
											<div class="rate-reviews"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i> Based on 2 reviews</div>
											<div class="write-a-review pull-right"><a data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="collapseExample">Write a review</a></div>
											<div class="collapse" id="review">
												<div class="card card-body">
													<div class="write-a-review">Write a review</div>
													<form>
														<div class="form-group">
															<label for="examplName">Name</label>
															<input type="text" class="form-control" id="examplName" placeholder="Enter your name" required>
														</div>

														<div class="form-group">
															<label for="exampleInputEmail">Email address</label>
															<input type="email" class="form-control" id="exampleInputEmail" placeholder="john.smith@example.com" required>														
														</div>

														<div class="form-group">
															<label for="exampleRating">Rating</label>
													  		<!-- Rating Stars Box -->
															<div class='rating-stars'>
																<ul id='stars'>
																	<li class='star' title='1 star' data-value='1'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='2 stars' data-value='2'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='3 stars' data-value='3'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='4 stars' data-value='4'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='5 stars' data-value='5'>
																		<i class='fa fa-star'></i>
																	</li>
																</ul>
															</div>
															
														</div>													

														<div class="form-group">
															<label for="exampleReviewTitle">Review title</label>
															<input type="text" class="form-control" id="exampleReviewTitle" placeholder="Give your review a title">														
														</div>

														<div class="form-group">
															<label for="exampleFormControlTextarea">Body of Review (1500)</label>
															<textarea class="form-control" id="exampleFormControlTextarea" rows="10" maxlength="1500" placeholder="Write your comments here"></textarea>
														</div>

														<button type="submit" class="btn btn-primary pull-right">Submit Review</button>
													</form>
												</div>
											</div>
										</div>

										<div class="rate">
											<div class="rate-reviews"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
											<div class="rate-title">Title</div>
											<div class="rate-name-and-date"><strong>Allan Drake Paladin Dulay</strong> on <strong>Dec 06, 2017</strong></div>
											<div class="rate-body">this is a body</div>
										</div>

										<div class="rate">
											<div class="rate-reviews"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
											<div class="rate-title">Title</div>
											<div class="rate-name-and-date"><strong>Allan Drake Paladin Dulay</strong> on <strong>Dec 06, 2017</strong></div>
											<div class="rate-body">this is a body</div>
										</div>

										<!-- no reviews yet -->
										<!-- <div class="rating-header">
											<div class="head">Customer Reviews</div>
											<div class="rate-reviews">Be the first to review this item</div>
											<div class="write-a-review pull-right"><a data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="collapseExample">Write a review</a></div>
										</div>

										<div class="collapse" id="review">
											<div class="card card-body">
												<div class="write-a-review">Write a review</div>
												<form>
													<div class="form-group">
														<label for="examplName">Name</label>
														<input type="text" class="form-control" id="examplName" placeholder="Enter your name" required>
													</div>

													<div class="form-group">
														<label for="exampleInputEmail">Email address</label>
														<input type="email" class="form-control" id="exampleInputEmail" placeholder="john.smith@example.com" required>														
													</div>

													<div class="form-group">
														<label for="exampleRating">Rating</label>
														<div class='rating-stars'>
															<ul id='stars'>
																<li class='star' title='1 star' data-value='1'>
																	<i class='fa fa-star'></i>
																</li>
																<li class='star' title='2 stars' data-value='2'>
																	<i class='fa fa-star'></i>
																</li>
																<li class='star' title='3 stars' data-value='3'>
																	<i class='fa fa-star'></i>
																</li>
																<li class='star' title='4 stars' data-value='4'>
																	<i class='fa fa-star'></i>
																</li>
																<li class='star' title='5 stars' data-value='5'>
																	<i class='fa fa-star'></i>
																</li>
															</ul>
														</div>
														
													</div>													

													<div class="form-group">
														<label for="exampleReviewTitle">Review title</label>
														<input type="text" class="form-control" id="exampleReviewTitle" placeholder="Give your review a title">														
													</div>

													<div class="form-group">
														<label for="exampleFormControlTextarea">Body of Review (1500)</label>
														<textarea class="form-control" id="exampleFormControlTextarea" rows="10" maxlength="1500" placeholder="Write your comments here"></textarea>
													</div>

													<button type="submit" class="btn btn-primary pull-right">Submit Review</button>
												</form>
											</div>
										</div> -->
									</div>
								</div>
							</div>
						</div>

						<!-- From the same shop -->
						<div id="etiendahan-section-3" class="etiendahan-section">
							<div class="container">
								<div class="title-name">
									<a href="/etiendahan/seller-shop/" class="view-shop" id="<?php echo $row_product['seller_email']; ?>">See all<i class="fa fa-chevron-right fa-fw"></i></a>
									<h3><span class="wow pulse" data-wow-delay="1000ms">FROM THE SAME SHOP</span></h3>
								</div>

								<div class="owl-carousel">
									<?php 
										$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE seller_email = '$email' AND id != '$category_product_id' AND stock > 0 AND banned = 0 ORDER BY RAND(".date("Ymd").") LIMIT 10");
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
										<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
											<div class="card">
												<?php $saved_image = explode(',', $product_row['image']); ?>
												<div class="card-image img-fluid owl-lazy" data-src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>"></div>
												<div class="card-body">
													<div class="product-name"><?php echo $product_row['name'] ?></div>
													<div class="product-price">₱<?php echo $product_row['price'] ?></div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
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
									<a href="/etiendahan/related-products/" class="related-products" id="<?php echo $category_name; ?>">See all<i class="fa fa-chevron-right fa-fw"></i></a>
									<h3><span class="wow pulse" data-wow-delay="1000ms">RELATED PRODUCTS</span></h3>
								</div>

								<div class="owl-carousel">
									<?php 
										$sub_id_result = $mysqli->query("SELECT GROUP_CONCAT(id) FROM tbl_categories_sub WHERE name = '$category_name'");
										$sub_id_row = $sub_id_result->fetch_assoc();
										$in_sub_id = $sub_id_row['GROUP_CONCAT(id)'];
										// echo $in_sub_id;
										// echo $category_product_id;


										$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE sub_id IN($in_sub_id) AND id != '$category_product_id' AND stock > 0 AND banned = 0 ORDER BY RAND(".date("Ymd").") LIMIT 10");
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
										<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
											<div class="card">
												<?php $saved_image = explode(',', $product_row['image']); ?>
												<div class="card-image img-fluid owl-lazy" data-src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>"></div>
												<div class="card-body">
													<div class="product-name"><?php echo $product_row['name'] ?></div>
													<div class="product-price">₱<?php echo $product_row['price'] ?></div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
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
					<div class="popup-title text-center mt-1"><i class="fa fa-info-circle mr-1 alert-primary"></i>Complete!</div>
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
<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>