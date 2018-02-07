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
					<li class="nav-item">
						<a class="nav-link" href="/etiendahan/seller-centre/product/list/all/">All</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link active" href="/etiendahan/seller-centre/product/list/live/">Live</a>
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
									$result_product_count = $mysqli->query("SELECT COUNT(*) FROM tbl_products WHERE seller_email = '$email' and stock > 0 and banned = 0");
									$product_count = $result_product_count->fetch_row();
									if($product_count[0] == 0 || $product_count[0] == 1) {
										echo $product_count[0].' Product';
									} else {
										echo $product_count[0].' Products';
									}
								?>	
							</div>
						</div>
					</div>

					<div class="row">
						<?php  
							$result_product = $mysqli->query("SELECT * FROM tbl_products WHERE seller_email = '$email' and stock > 0 and banned = 0 GROUP BY name");
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
											} else if ($product_row['stock'] <= 0) {
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
										<div class="wishlists pr-3"><i class="fa fa-heart-o pr-1"></i>
											<?php  
												$wishlists_id_product = $product_row['id'];
												$wishlists_product = $mysqli->query("SELECT COUNT(product_id) FROM tbl_wishlists WHERE product_id = '$wishlists_id_product'");
												while($wishlists_row = mysqli_fetch_assoc($wishlists_product)):
											?>
											<?php echo $wishlists_row['COUNT(product_id)'] ?>
											<?php endwhile; ?>
										</div>
										<div class="sales">
											<?php 
												$product_id_order = $product_row['id'];
										        $product_order_result = $mysqli->query("SELECT SUM(quantity) as 'total_quantity' FROM tbl_orders WHERE product_id = '$product_id_order'");
												$product_order_row = $product_order_result->fetch_assoc();
											?>
											Sales <?php echo ($product_order_row['total_quantity'] == '')?'0':$product_order_row['total_quantity']; ?>
										</div>
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