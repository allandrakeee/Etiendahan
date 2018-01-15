<?php  
	require '/../../../db.php';
	session_start();

	$logged_in  = ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	// Check if user is logged in using the session variable
	if ($logged_in == false) {
	$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your seller centre page";
	header("location: /etiendahan/seller-centre/account/signin/");    
	}
  
  	if ($logged_in == 1) {
    	// header("location: /etiendahan/seller-centre/");    
    	$email = $mysqli->escape_string($_SESSION['email']);
		$result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'");
		$user = $result->fetch_assoc();

		if ($user['seller_centre'] == 0) {
			$_SESSION['cant-proceed-message'] = "You must activate first your seller centre account";
            header("location: /etiendahan/seller-centre/account/activate/");
        }
  	}
	else {
	    // Makes it easier to read
	    $email = $_SESSION['email'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Etiendahan Seller Centre</title>
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
		<div class="main-wrapper">
			<div class="main">

				<!-- <div id="id-goes-here"></div> -->
				<input type="hidden" id="hidden-input" name="my-hidden-input">

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
							<li class="breadcrumb-item active" aria-current="page">My Products</li>
						</ol>
					</nav>
				</div>
				<!-- END OF SECTION 1 -->	
				
				<ul class="nav justify-content-center text-center">
					<li class="nav-item active">
						<a class="nav-link active" href="/etiendahan/seller-centre/product/list/all/">All</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/etiendahan/seller-centre/product/list/live/">Live</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/etiendahan/seller-centre/product/list/soldout/">Soldout</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/etiendahan/seller-centre/product/list/banned/">Banned</a>
					</li>
				</ul>

				<div class="container inner">
					<div class="row">
						<div class="col-md-12">
							<div class="products-number">
								<?php  
									$result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_products WHERE seller_email = '$email'");
									$product_count = $result_product_count->fetch_row();
									if($product_count[0] == 0 || $product_count[0] == 1)  {
										echo $product_count[0].' Product';
									} else {
										echo $product_count[0].' Products';
									}
								?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-2 product">
							<a href="/etiendahan/seller-centre/product/new/">
								<div class="add-a-new-product-wrapper">
									<div class="add-a-new-product"><i class="fa fa-plus-circle"></i><div>Add a New Product</div></div>
								</div>
							</a>
						</div>

						<?php  
							$result_product = $mysqli->query("SELECT * FROM tbl_products WHERE seller_email='$email' GROUP BY name");
							while($product_row = mysqli_fetch_assoc($result_product)):
							$product_id = $product_row['id'];
						?>
							<div class="col-md-2 product">
								<?php 
									$date_joined_result_day = $mysqli->query("SELECT DATEDIFF(NOW(),created_at) FROM tbl_products WHERE id = '$product_id'");
									$date_joined_row_day = $date_joined_result_day->fetch_assoc();	
									
									if($date_joined_row_day['DATEDIFF(NOW(),created_at)'] < 3):
								?>
										<div class="ribbon ribbon--dimgrey">NEW</div>
									<?php endif; ?>
								<a <?php echo ($product_row['banned'] == 1) ? '' : 'href="/etiendahan/seller-centre/product/details/"'?>>
									<div class="product-wrapper list" id="<?php echo $product_row['id'] ?>">
										<?php $saved_image = explode(',', $product_row['image']); ?>
										<div class="product-image" style="background-image: url(<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>);"><?php
											if ($product_row['banned'] == 1) {
												echo '<div class="banned-wrapper"><div class="banned">Banned</div></div>';
											} else if ($product_row['stock'] == 0) {
												echo '<div class="sold-wrapper"><div class="sold">Sold</div></div>';
											}
										?></div>
										<div class="product-name text-left pl-3 mt-2"><?php echo $product_row['name'] ?></div>
										<div class="product-price pull-left pl-3">₱<?php echo $product_row['price'] ?></div>
										<?php
											if($product_row['stock'] <= 5) {
												echo '<div class="product-stock text-danger">Stock '.$product_row['stock'].'</div>';
											} else {
												echo '<div class="product-stock">Stock '.$product_row['stock'].'</div>';
											}
										?>
										<div class="statistics mt-4 mb-1">statistics</div>
										<div class="sightings pr-3"><i class="fa fa-eye pr-1"></i><?php echo $product_row['sightings']; ?></div>
										<div class="wishlists pr-3"><i class="fa fa-heart-o pr-1"></i>0</div>
										<div class="sales">Sales 0</div>
										
										<?php if($product_row['banned'] == 1): ?>
										<div class="delete-product mt-3">
											<form class="delete-form" action="/etiendahan/c8NLPYLt-functions/product-details-delete-function/" method="POST">	
												<button name="button_delete" class="btn btn-primary delete-list" type="submit">Delete</button>
											</form>
										</div>
										<?php endif; ?>
									</div>
								</a>
							</div>	
						<?php endwhile; ?>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="footer mb-3">
								<div class="site-image" style="background-image: url(/etiendahan/temp-img/logo-seller-centre.png);"></div>
								<div class="site-centre">Etiendahan Seller Centre</div>
								<div class="site-version">Current Version: beta test</div>
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
				<div id="popup-notification-logout-redirect" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-danger"></i>Can't proceed!</div>
					<div class="popup-content-logout-redirect text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['cant-proceed-message-product']) ) {
								echo $_SESSION['cant-proceed-message-product'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['cant-proceed-message-product'] );
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