<?php  
	require '/../../../db.php';
	session_start();

  	$email = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');

	$result_banned = $mysqli->query("SELECT * FROM tbl_sellers WHERE seller_email = '$email'");
	$row_banned = $result_banned->fetch_assoc();
	if($row_banned['banned'] == 1) {
		$_SESSION['logged_in'] = false;
	    $_SESSION['cant-proceed-message-banned'] = "Your seller account is banned! <a href='mailto:etiendahan@gmail.com' style='text-decoration: none' target='_blank'>Email</a> us for info.";
	    header('location: /etiendahan/seller-centre/account/signin/');
	    exit;
	}

	$logged_in  = ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
	$product_details_id = ((isset($_SESSION['product_details_id']) && $_SESSION['product_details_id'] != '')?htmlentities($_SESSION['product_details_id']):'');
	
	if($product_details_id == '') {
		$_SESSION['cant-proceed-message-product'] = "You must select product before viewing product details page";
		header("location: /etiendahan/seller-centre/product/list/all/");  
	}

	// Check if user is logged in using the session variable
	if ($logged_in == false) {
	$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your seller centre page.";
	header("location: /etiendahan/seller-centre/account/signin/");    
	}
  
  	if ($logged_in == 1) {
    	// header("location: /etiendahan/seller-centre/");    
    	$email = $mysqli->escape_string($_SESSION['email']);
		$result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'");
		$user = $result->fetch_assoc();

		if ($user['seller_centre'] == 0) {
			$_SESSION['cant-proceed-message'] = "You must activate first your seller centre account.";
            header("location: /etiendahan/seller-centre/account/activate/");
        }
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
	// echo $product_details_id;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product Details | Etiendahan Seller Centre</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">

	<!-- link inner -->
	<?php  
		include '../../../header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="seller-centre-page" class="main-container">
		<div class="main-wrapper" id="product-details-page">
			<div class="main">
				<input type="hidden" id="hidden-input" name="my-hidden-input" value="<?php echo $product_details_id; ?>">
				
				<!-- SECTION 1 -->
				<div id="etiendahan-section-1" class="etiendahan-section">
					<!-- navbar -->
					<nav class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index shrink">
					  	<a class="navbar-brand" href="http://localhost:8080/etiendahan/seller-centre/">
							<img src="/etiendahan/temp-img/etiendahan-logo-seller-centre.png" width="178" height="58" class="d-inline-block align-top" alt="">
						</a>	

						<div class="ml-auto d-flex">
							<div class="nav-item right-nav dropdown" id="cart">
								<a class="nav-link" href="http://localhost:8080/etiendahan/" id="cart" role="button" aria-haspopup="true" aria-expanded="false">
									Etiendahan Homepage
								</a>
							</div>

							<div class="nav-item right-nav dropdown" id="user-account">
								<a href="/etiendahan/seller-centre/product/list/all/" class="nav-link" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user-circle pl-4 pr-4"></i>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<p>Howdie.</p>

									<a href="/etiendahan/seller-centre/product/list/all/"><div class="dropdown-item"><i class="fa fa-cubes fa-fw mr-2"></i>My Products</div></a>
									<a href="/etiendahan/seller-centre/sale/list/pending/"><div class="dropdown-item"><i class="fa fa-money fa-fw mr-2"></i>My Sales</div></a>
									<a href="/etiendahan/seller-centre/logout/"><div class="dropdown-item"><i class="fa fa-sign-out fa-fw mr-2"></i>Logout</div></a>
								</div>
							</div>
						</div>

						<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</nav>

					<nav class="breadcrumb-wrapper" aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/etiendahan/seller-centre/">Home</a></li>
							<li class="breadcrumb-item"><a href="/etiendahan/seller-centre/product/list/all/">My Products</a></li>
							<li class="breadcrumb-item active" aria-current="page">Product Details</li>
						</ol>
					</nav>
				</div>
				<!-- END OF SECTION 1 -->	

				<ul class="nav justify-content-center text-center">
					<li class="nav-item">
						<a class="nav-link" href="/etiendahan/seller-centre/product/details/">Edit Product</a>
					</li>
					<li class="nav-item active">
						<?php  
							$ratings_result_count = $mysqli->query("SELECT COUNT(*) AS 'total' FROM tbl_ratings WHERE product_id = '$product_details_id'");
							$ratings_row_count = $ratings_result_count->fetch_assoc();
							$ratings_count = $ratings_row_count['total'];
						?>
						<a class="nav-link active" href="/etiendahan/seller-centre/product/reviews/">Reviews (<?php echo $ratings_count; ?>)</a>
					</li>
				</ul>

				<div class="container products-action">
					<div class="row">
						<div class="col-md-12">
							<div class="product-wrapper p-4" style="height: 1062px; overflow: auto;">
								<div class="form-wrapper mt-1">
									<div class="title">Product Reviews</div>
									<div class="sub-title mb" data-toggle="tooltip" data-placement="right" title="Report products that Inappropriate. Wait for the confimation of the admin, if the review is inappropriate or legit. (If pending become Report as Inappropriate again it means review is Legit, and if the pending is gone it means its Inappropriate.)">Tips for handling review of products</div>
								</div>	

								<?php  
									$result = $mysqli->query("SELECT * FROM tbl_ratings WHERE product_id = '$product_details_id'");
									if($result->num_rows > 0):
								?>
										<div class="rating-header mt-3">
											<div class="head mb-0">Customer Reviews</div>
											<?php  
												$ratings_result_avg = $mysqli->query("SELECT tbl_products.id, tbl_products.name, AVG(tbl_ratings.rating) AS rating FROM tbl_products LEFT JOIN tbl_ratings ON tbl_products.id = tbl_ratings.product_id AND tbl_ratings.product_id = '$product_details_id'");
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
										</div>
										
										<?php  
											$ratings_result = $mysqli->query("SELECT * FROM tbl_ratings WHERE product_id = '$product_details_id' GROUP BY id desc");
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
													<div class="report-as-inappropriate pull-right mb-2" style="position: relative;bottom: 48px;">
														<?php if($ratings_row['report_as_inappropriate'] == 1): ?>
															pending
														<?php else: ?>
															<a href="/etiendahan/seller-centre/product/reviews/report-as-inappropriate/" class="report-review" id="<?php echo $ratings_row['id']; ?>" style="text-decoration: none;">Report as Inappropriate</a>
														<?php endif; ?>
													</div>
												</div>
										<?php endwhile; ?>
								<?php else: ?>
									<!-- no reviews yet -->
									<div class="rating-header mt-3">
										<div class="head mb-0">Customer Reviews</div>
										<div class="no-reviews-yet">No reviews yet</div>
									</div>

									
								<?php endif; ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="footer mb-3">
								<div class="site-image" style="background-image: url(/etiendahan/temp-img/logo-seller-centre.png);"></div>
								<div class="site-centre">Etiendahan Seller Centre</div>
								<div class="site-version">Current Version: 1.0.0</div>
							</div>
						</div>
					</div>
				</div>	

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-primary"></i>Complete!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['product-modified-message']) ) {
								echo $_SESSION['product-modified-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['product-modified-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->	

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-primary"></i>Complete!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['product-added-message']) ) {
								echo $_SESSION['product-added-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['product-added-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification-logout-redirect" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
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
			</div>
		</div>
	</div>	

<!-- footer inner -->
<!-- Development - Normal import of theme.js -->
<script src="/etiendahan/assets/js/theme.js"></script>

<!-- Development - Minifies import of theme.js -->
<!-- <script src="/etiendahan/assets/js/theme.min.js"></script> -->

<!-- Production - Normal import of theme.js -->
<!-- <script src="/assets/js/theme.js"></script> -->

<!-- Production - Minified import of theme.js -->
<!-- <script src="/assets/js/theme.min.js"></script> -->
</html>