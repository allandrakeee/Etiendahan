<?php  
	require '/db.php';
	require_once "/facebook-login/config.php";
	session_start();

	if(!isset($_SESSION['unique_hash_visitors'])) {
		$uhv = md5( rand(0,1000) );
		$_SESSION['unique_hash_visitors'] = $uhv;
	} else {
		$_SESSION['unique_hash_visitors'];
	}

	$unique_hash_visitors = $_SESSION['unique_hash_visitors'];

	$result = $mysqli->query("SELECT * FROM tbl_visits");
	$row = $result->fetch_assoc();
	if($result->num_rows == 0) {
		$mysqli->query("INSERT INTO tbl_visits(created_at, hash, registered_customer, email) VALUES(NOW(), '$unique_hash_visitors', 0, 0)") or die($mysqli->error);
	} else {
		$result1 = $mysqli->query("SELECT * FROM tbl_visits WHERE id = (SELECT MAX(id) FROM tbl_visits)");
		$row1 = $result1->fetch_assoc();
		// echo $row1['hash'].'=='.$unique_hash_visitors;
		if($row1['hash'] != $unique_hash_visitors) {
			$mysqli->query("INSERT INTO tbl_visits(created_at, hash, email, registered_customer) VALUES(NOW(), '$unique_hash_visitors', 0, 0)") or die($mysqli->error);
		}
	}
  	
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
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    if (isset($_POST['button_delete_cart'])) {
	    	$cart_product_id_delete = $_SESSION['cart_product_id_delete'];
	    	$email =  $_SESSION['email'];

    	    $sql = "DELETE FROM tbl_cart WHERE product_id = '$cart_product_id_delete' AND email = '$email'";
		   	$mysqli->query($sql) or die($mysqli->error);
	    }
	}
	
	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	$email 	= ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');
    $result = $mysqli->query("SELECT SUBSTRING_INDEX(fullname, ' ', 1) AS first_name FROM tbl_customers WHERE email='$email'");
	$user = $result->fetch_assoc();

	$fbSession = ((isset($_SESSION['facebook_access_token']) && $_SESSION['facebook_access_token'] != '')?htmlentities($_SESSION['facebook_access_token']):'');
	
	if($fbSession != "") {
		$logoutUrlFacebook = $helper->getLogoutUrl($fbSession, 'http://localhost:8080/etiendahan/logout/');
	} else {
		$logoutUrlFacebook = 'http://localhost:8080/etiendahan/logout/';
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Etiendahan | Online Shopping Local Products | Province of Pangasinan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">

	<!-- Normal import of theme.css -->
	<link rel="stylesheet" href="assets/css/theme.css">
	
	<!-- Minified import of theme.css -->
	<!-- <link rel="stylesheet" href="assets/css/theme.min.css"> -->
</head>
<body>
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div class="main-container">
		<div class="main-wrapper">
			<div class="main">

				<?php  
					if($logged_in == true) {
				?>
						<!-- SECTION 1 - Homepage navbar and carousel -->
						<div id="etiendahan-section-1" class="etiendahan-section">
							
							<!-- navbar -->
							<nav id="for-index" class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index">
							  	<a class="navbar-brand" href="/etiendahan/">
									<!-- <img src="http://via.placeholder.com/178x58/000000" width="178" height="58" class="d-inline-block align-top" alt=""> -->
									<img class="logo" src="temp-img/etiendahan-logo-shrink.png" width="178" height="58" class="d-inline-block align-top" alt="">
								</a>					

								<div class="collapse navbar-collapse" id="navbarCenterContent">
									<div class="container">
										<ul class="navbar-nav">

											<!-- SELL ON ETIENDAHAN -->
											<li class="nav-item">
												<a class="nav-link cl-effect" href="/etiendahan/seller-centre/account/signin/" target="_blank">Sell On Etiendahan</a>
											</li>

											<!-- MARKET -->
											<li class="nav-item">
												<a class="nav-link cl-effect" href="/etiendahan/market/view/" target="">Market</a>
											</li>

											<!-- STORES -->
											<!-- <li class="nav-item">
												<a class="nav-link cl-effect" href="/etiendahan/stores/" target="">Stores</a>
											</li> -->

											

											<!-- SPECIALTY IN CITY -->
											<!-- <li class="nav-item">
												<a class="nav-link cl-effect" href="/etiendahan/specialty-in-city/">Specialty in City</a>
											</li> -->

											<!-- SPECIALTY IN CITY -->
											<!-- <li class="nav-item dropdown mega-dropdown">
												
												<a class="nav-link cl-effect" href="https://google.com" id="specialtyInCity" role="button" aria-haspopup="true" aria-expanded="false">
												Specialty
												</a>
												
												<div class="dropdown-menu mega-dropdown-menu" aria-labelledby="specialtyInCity">
													<div class="container">
														<div class="row">
															<div class="col-md-3">
																<a class="dropdown-header primary-header" href="#">A</a>
																<div class="dropdown-divider"></div>
																<div class="row">
																	<div class="col-md-6">
																		<a class="dropdown-header secondary-header" href="https://google.com">Alaminos</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Hipon</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Alcala</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Damit</a>																	</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Anda</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Sapatos</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Aguilar</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<a class="dropdown-header primary-header" href="#">B</a>
																<div class="dropdown-divider"></div>
																<div class="row">
																	<div class="col-md-6">
																		<a class="dropdown-header secondary-header" href="https://google.com">Bolinao</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Hipon</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Bugallon</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Damit</a>																	</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Binalonan</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Sapatos</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Binmaley</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Burgos</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Basista</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Baustista</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<a class="dropdown-header primary-header" href="#">C</a>
																<div class="dropdown-divider"></div>
																<div class="row">
																	<div class="col-md-6">
																		<a class="dropdown-header secondary-header" href="https://google.com">Calasiao</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Puto</a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<a class="dropdown-header primary-header" href="#">D</a>
																<div class="dropdown-divider"></div>
																<div class="row">
																	<div class="col-md-6">
																		<a class="dropdown-header secondary-header" href="https://google.com">Dagupan</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Bangus</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li> -->

											<!-- ACCESSORIES -->
											<!-- <li class="nav-item">
												<a class="nav-link cl-effect" href="#">Accessories</a>
											</li> -->

											<!-- SHOP NOW -->
											<li class="nav-item">
												<a href='http://localhost:8080/etiendahan/#shop-now' class="nav-link cl-effect scroll-link" data-id="shop-now-link">Shop Now</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="ml-auto d-flex">
									<!-- CART -->
									<div class="nav-item right-nav dropdown" id="cart">
										<a class="nav-link" href="/etiendahan/cart/" id="cart" role="button" aria-haspopup="true" aria-expanded="false">
											<?php  
												$product_available_banned_result = $mysqli->query("SELECT GROUP_CONCAT(id) as total_id FROM tbl_products WHERE banned = 0");
												$product_available_banned_row = $product_available_banned_result->fetch_assoc();
												$total_id_available = $product_available_banned_row['total_id'];

												if($total_id_available == null) {
													$total_id_available = 0;
												}

												$email = $_SESSION['email'];
												$cart_result_count = $mysqli->query("SELECT COUNT(*) as 'total' FROM tbl_cart WHERE email = '$email'");
												$cart_row_count = $cart_result_count->fetch_assoc();
											?>
											<span class="fa-stack has-badge" data-count="<?php echo $cart_row_count['total']; ?>">
											  <!-- <i class="fa fa-circle fa-stack-2x"></i> -->
											  <i class="fa fa-shopping-bag fa-stack-1x"></i>
											</span>
										</a>
										
										<!-- No items in the cart -->
										<?php  
											$result = $mysqli->query("SELECT * FROM tbl_cart WHERE email = '$email'");

									        if ($result->num_rows == 0):
										?>
											<div class="dropdown-menu" aria-labelledby="cart">
												<p>You have no items in your shopping cart.</p>
											</div>
										<?php else: ?>

										<!-- Have items in the cart -->
										
										<div class="dropdown-menu have-in-cart" aria-labelledby="cart">
											<p>Recently Added Products</p>
											<?php    
												$product_available_banned_result = $mysqli->query("SELECT GROUP_CONCAT(id) as total_id FROM tbl_products WHERE banned = 0");
												$product_available_banned_row = $product_available_banned_result->fetch_assoc();
												$total_id_available = $product_available_banned_row['total_id'];

												if($total_id_available == null) {
													$total_id_available = 0;
												}

												$cart_result = $mysqli->query("SELECT * FROM tbl_cart WHERE email = '$email'");
												while($cart_row = mysqli_fetch_assoc($cart_result)):
												$product_id_cart = $cart_row['product_id'];

												$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$product_id_cart'");
												while($product_row = mysqli_fetch_assoc($product_result)):
													if($product_row['banned'] == 1):
													
											?>	
														<div class="item overlay">
															<div class="item-left">
																<?php $saved_image = explode(',', $product_row['image']); ?>
																<img src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>" style="height: 50px;width: 50px;margin-top: 6px;" alt="" />
																<div class="item-info">
																	<div class="item-name"><span class="item-sold-out">Banned</span><?php echo $product_row['name']; ?></div>
																	<?php if($cart_row['quantity'] == 1): ?>
																		<div class="item-price">₱<?php $cart_quantity = $cart_row['quantity']; echo $product_row['price']; ?></div>													
																	<?php else: ?>
																		<?php $total = str_replace(',', '', $product_row['price']) * $cart_row['quantity']; $formatted = number_format((float)$total, 2, '.', ''); ?>
																		<?php $result_total_product = number_format((float)$total, 2, '.', ',');  ?>
																		<div class="item-price">₱<?php $cart_quantity = $cart_row['quantity']; echo $product_row['price']."<span style='font-size: 11px;'> x$cart_quantity = </span><div class='d-inline-block'>₱$result_total_product</div>"; ?></div>
																	<?php endif; ?>
																</div>
															</div>
															<div class="item-right">
																<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
																	<button class="cart-delete" id="<?php echo $product_row['id']; ?>" type="submit" name="button_delete_cart">
																		<i class="fa fa-trash" style="color: dimgrey; z-index: 9999; position: relative; left: 10px;bottom: 9px;"></i>
																	</button>
																</form>
															</div>
														</div>
													<?php elseif($product_row['stock'] <= 0): ?>
														<div class="item overlay">
															<div class="item-left">
																<?php $saved_image = explode(',', $product_row['image']); ?>
																<img src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>" style="height: 50px;width: 50px;margin-top: 6px;" alt="" />
																<div class="item-info">
																	<div class="item-name"><span class="item-sold-out">Sold out</span><?php echo $product_row['name']; ?></div>
																	<div class="item-price">₱<?php echo $product_row['price']; ?></div>
																</div>
															</div>
															<div class="item-right">
																<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
																	<button class="cart-delete" id="<?php echo $product_row['id']; ?>" type="submit" name="button_delete_cart">
																		<i class="fa fa-trash" style="color: dimgrey; z-index: 9999; position: relative; left: 10px;bottom: 9px;"></i>
																	</button>
																</form>
															</div>
														</div>
													<?php else: ?>
														<div class="item">
															<div class="item-left">
																<a href="/etiendahan/market/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
																	<?php $saved_image = explode(',', $product_row['image']); ?>
																	<img src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>" style="height: 50px;width: 50px;margin-top: 6px;" alt="" />
																</a>
																<div class="item-info">
																	<div class="item-name"><?php echo $product_row['name']; ?></div>
																	<?php if($cart_row['quantity'] <= 1): ?>
																		<div class="item-price">₱<?php $cart_quantity = $cart_row['quantity']; echo $product_row['price']; ?></div>													
																	<?php else: ?>
																		<?php $total = str_replace(',', '', $product_row['price']) * $cart_row['quantity']; $formatted = number_format((float)$total, 2, '.', ''); ?>
																		<?php $result_total_product = number_format((float)$total, 2, '.', ',');  ?>
																		<div class="item-price">₱<?php $cart_quantity = $cart_row['quantity']; echo $product_row['price']."<span style='font-size: 11px;'> x$cart_quantity = </span><div class='d-inline-block'>₱$result_total_product</div>"; ?></div>
																	<?php endif; ?>
																</div>
															</div>
															<div class="item-right">
																<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
																	<button class="cart-delete" id="<?php echo $product_row['id']; ?>" type="submit" name="button_delete_cart">
																		<i class="fa fa-trash" style="color: dimgrey; z-index: 9999; position: relative; left: 10px;bottom: 9px;"></i>
																	</button>
																</form>
															</div>
														</div>

											<?php endif;endwhile;endwhile; ?>

											

											<a href="/etiendahan/cart/"><button type="button" class="btn btn-dark">View Cart</button></a>
										</div>
										<?php endif; ?>
									</div>

									<div class="nav-item right-nav dropdown" id="user-account">
										<a class="nav-link" href="/etiendahan/customer/account/profile/" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-user-circle"></i>
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">
											<p>Howdy.</p>

											<a href="/etiendahan/customer/account/profile/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Manage my account</div></a>
											<a href="/etiendahan/customer/orders/">
												<div class="dropdown-item">
													<?php  
														$email =  $_SESSION['email'];
													  	$result = $mysqli->query("SELECT COUNT(DISTINCT unique_hash_id) as 'total' FROM tbl_orders WHERE email = '$email' ORDER BY unique_hash_id");
												 		if($result->num_rows == 0):
													?>
													<i class="fa fa-caret-right fa-fw"></i>My Orders
													<?php else: ?>
														<?php $row = $result->fetch_assoc(); ?>
													<i class="fa fa-caret-right fa-fw"></i>My Orders <?php $total_row = $row['total']; echo ($row['total'] == 0)? '' : "($total_row)" ?>
													<?php endif; ?>
												</div>
											</a>
											<a href="/etiendahan/customer/wishlists/">
												<div class="dropdown-item">
													<?php  
														$email =  $_SESSION['email'];
													  	$result = $mysqli->query("SELECT COUNT(*) as 'total' FROM tbl_wishlists WHERE email = '$email'");
												 		if($result->num_rows == 0):
													?>
													<i class="fa fa-caret-right fa-fw"></i>Wishlists
													<?php else: ?>
														<?php $row = $result->fetch_assoc(); ?>
													<i class="fa fa-caret-right fa-fw"></i>Wishlists <?php $total_row = $row['total']; echo ($row['total'] == 0)? '' : "($total_row)" ?>
													<?php endif; ?>
												</div>
											</a>
											<button class="facebook-logout" type="button" onclick="window.location = '<?php echo $logoutUrlFacebook; ?>'" style="background:none!important;color: inherit;border: none;padding: 0!important;font: inherit;cursor: pointer;width: 100%;text-align: left;"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw" id="logout"></i>LOGOUT</div></button>
										</div>
									</div>
								</div>

								<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>
							</nav>

							<!-- carousel -->
							<div id="etiendahanCarouselIndicators" class="carousel slide my-carousel" data-ride="carousel">
								<?php  
									$slides_result_one_result = $mysqli->query("SELECT * FROM tbl_slides");
									if($slides_result_one_result->num_rows > 1):
								?>
									<ol class="carousel-indicators">
										<?php  
										$count_indicator = 0;
											$slides_result_min_id = $mysqli->query("SELECT MIN(id) as min_id FROM tbl_slides");
											$slides_row_min_id = mysqli_fetch_assoc($slides_result_min_id);
											$slides_result_id = $mysqli->query("SELECT * FROM tbl_slides");
											while($slides_row_id = mysqli_fetch_assoc($slides_result_id)):
										?>
											<li data-target="#etiendahanCarouselIndicators" data-slide-to="<?php echo $count_indicator; ?>" <?php echo ($slides_row_min_id['min_id'] == $slides_row_id['id']) ? 'class="active"' : '' ?>></li>
										<?php $count_indicator++; endwhile; ?>
									</ol>
								<?php endif; ?>

								<div class="carousel-inner wrapper">
									<?php  
										$slides_result_min_id = $mysqli->query("SELECT MIN(id) as min_id FROM tbl_slides");
										$slides_row_min_id = mysqli_fetch_assoc($slides_result_min_id);
										$slides_result = $mysqli->query("SELECT * FROM tbl_slides");
										while($slides_row = mysqli_fetch_assoc($slides_result)):
									?>
										<div class="carousel-item <?php echo ($slides_row_min_id['min_id'] == $slides_row['id']) ? 'active' : '' ?>" draggable="false" style="background-image: url(<?php echo $slides_row['image'] ?>);" alt="First slide" >
											<div class="row h-100 d-flex">
												<div class="carousel-inner-overlay"></div>
												<?php  
													if($slides_row['promotional'] == 1):
												?>
													<div class="ribbon-promotional ribbon--dimgrey wow rollIn" data-wow-delay="400ms" style="visibility: hidden">Promotional</div>
												<?php endif; ?>
												<div class="col-md-12 text-center my-auto" style="z-index: 3">
													<div class="text-inner wow fadeInUp" data-wow-delay="600ms" style="visibility: hidden"><?php echo $slides_row['title']; ?></div>
													<?php  
														if($slides_row['link_status'] == 1):

														$seller_id = $slides_row['link_to'];
														$result_banned = $mysqli->query("SELECT * FROM tbl_sellers WHERE id = '$seller_id'");
														$row_banned = $result_banned->fetch_assoc();
													?>
														<div class="link-slider wow fadeInUp" data-wow-delay="920ms" style="visibility: hidden"><a href="/etiendahan/seller-shop/" class="view-shop" id="<?php echo $row_banned['seller_email'] ?>">View Shop</a></div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									<?php endwhile; ?>
								</div>
								<?php  
									$slides_result_one_result = $mysqli->query("SELECT * FROM tbl_slides");
									if($slides_result_one_result->num_rows > 1):
								?>
									<a class="carousel-control-prev" href="#etiendahanCarouselIndicators" role="button" data-slide="prev">
										<i class="fa fa-angle-left" aria-hidden="true"></i>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#etiendahanCarouselIndicators" role="button" data-slide="next">
										<i class="fa fa-angle-right" aria-hidden="true"></i>
										<span class="sr-only">Next</span>
									</a>
								<?php endif; ?>
							</div>
							
							<div id="shop-now"></div>
							<!-- <div id="shop-now-link"></div> -->
							<!-- search bar -->
							<div class="container my-search">
								<div class="row">
									<div class="col-md-12">
										<div class="search-box">
											<form class="search-form" action="/etiendahan/c8NLPYLt-functions/search-function/" method="POST">
												<input class="form-control form-control-lg hintable ui-autocomplete-input" id="customerAutocomplete" hint-class="show-recent" placeholder="Search products" type="text" name="search" autocomplete="off">
												<button class="btn btn-link search-btn" name="search_button">
													<i class="fa fa-search" style="position: relative;bottom: 2px;"></i>
												</button>
											</form>
										</div>
										<!-- <div class="recent show-recent">
									        <div class="inner-recent highlight">
									        	No recent search
									        </div>
									    </div> -->
									</div>
								</div>
							</div>
						</div>
						<!-- END OF SECTION 1 -->
				<?php  
					} else {
				?>
						<!-- SECTION 1 - Homepage navbar and carousel -->
						<div id="etiendahan-section-1" class="etiendahan-section">
							
							<!-- navbar -->
							<nav id="for-index" class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index">
							  	<a class="navbar-brand" href="/etiendahan/">
									<!-- <img src="http://via.placeholder.com/178x58/000000" width="178" height="58" class="d-inline-block align-top" alt=""> -->
									<img class="logo" src="temp-img/etiendahan-logo-shrink.png" width="178" height="58" class="d-inline-block align-top" alt="">
								</a>					

								<div class="collapse navbar-collapse" id="navbarCenterContent">
									<div class="container">
										<ul class="navbar-nav">

											<!-- SELL ON ETIENDAHAN -->
											<li class="nav-item">
												<a class="nav-link cl-effect" href="/etiendahan/seller-centre/account/signin/" target="_blank">Sell On Etiendahan</a>
											</li>

											<!-- MARKET -->
											<li class="nav-item">
												<a class="nav-link cl-effect" href="/etiendahan/market/view/" target="">Market</a>
											</li>

											<!-- STORES -->
											<!-- <li class="nav-item">
												<a class="nav-link cl-effect" href="/etiendahan/stores/" target="">Stores</a>
											</li> -->

											

											<!-- SPECIALTY IN CITY -->
											<!-- <li class="nav-item">
												<a class="nav-link cl-effect" href="/etiendahan/specialty-in-city/">Specialty in City</a>
											</li> -->

											<!-- SPECIALTY IN CITY -->
											<!-- <li class="nav-item dropdown mega-dropdown">
												
												<a class="nav-link cl-effect" href="https://google.com" id="specialtyInCity" role="button" aria-haspopup="true" aria-expanded="false">
												Specialty
												</a>
												
												<div class="dropdown-menu mega-dropdown-menu" aria-labelledby="specialtyInCity">
													<div class="container">
														<div class="row">
															<div class="col-md-3">
																<a class="dropdown-header primary-header" href="#">A</a>
																<div class="dropdown-divider"></div>
																<div class="row">
																	<div class="col-md-6">
																		<a class="dropdown-header secondary-header" href="https://google.com">Alaminos</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Hipon</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Alcala</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Damit</a>																	</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Anda</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Sapatos</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Aguilar</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<a class="dropdown-header primary-header" href="#">B</a>
																<div class="dropdown-divider"></div>
																<div class="row">
																	<div class="col-md-6">
																		<a class="dropdown-header secondary-header" href="https://google.com">Bolinao</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Hipon</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Bugallon</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Damit</a>																	</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Binalonan</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Sapatos</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Binmaley</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Burgos</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Basista</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<a class="dropdown-header" href="#">Baustista</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<a class="dropdown-header primary-header" href="#">C</a>
																<div class="dropdown-divider"></div>
																<div class="row">
																	<div class="col-md-6">
																		<a class="dropdown-header secondary-header" href="https://google.com">Calasiao</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Puto</a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<a class="dropdown-header primary-header" href="#">D</a>
																<div class="dropdown-divider"></div>
																<div class="row">
																	<div class="col-md-6">
																		<a class="dropdown-header secondary-header" href="https://google.com">Dagupan</a>
																		<div class="children">
																			<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Bangus</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li> -->

											<!-- ACCESSORIES -->
											<!-- <li class="nav-item">
												<a class="nav-link cl-effect" href="#">Accessories</a>
											</li> -->

											<!-- SHOP NOW -->
											<li class="nav-item">
												<a href='http://localhost:8080/etiendahan/#shop-now' class="nav-link cl-effect scroll-link" data-id="shop-now-link">Shop Now</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="ml-auto d-flex">
									<!-- CART -->
									<div class="nav-item right-nav dropdown" id="cart">
										<a class="nav-link" href="/etiendahan/cart/" id="cart" role="button" aria-haspopup="true" aria-expanded="false">
											<span class="fa-stack has-badge" data-count="0">
											  <!-- <i class="fa fa-circle fa-stack-2x"></i> -->
											  <i class="fa fa-shopping-bag fa-stack-1x"></i>
											</span>
										</a>

										<!-- No items in the cart -->
										<div class="dropdown-menu" aria-labelledby="cart">
											<p>You have no items in your shopping cart.</p>
										</div>

										<!-- Have items in the cart -->
										<!-- <div class="dropdown-menu have-in-cart" aria-labelledby="cart">
											<p>Recently Added Products</p>

											<div class="item">
												<div class="item-left">
													<img src="http://via.placeholder.com/50x50" alt="" />
													<div class="item-info">
														<div class="item-name">Item name</div>
														<div class="item-price">?1,000.00</div>
													</div>
												</div>
												<div class="item-right">
													<i class="fa fa-trash"></i>
												</div>
											</div>

											<div class="item">
												<div class="item-left">
													<img src="http://via.placeholder.com/50x50" alt="" />
													<div class="item-info">
														<div class="item-name">Item name</div>
														<div class="item-price">?500.00</div>
													</div>
												</div>
												<div class="item-right">
													<i class="fa fa-trash"></i>
												</div>
											</div>

											<div class="item overlay">
												<div class="item-left">
													<img src="http://via.placeholder.com/50x50" alt="" />
													<div class="item-info">
														<div class="item-name"><span class="item-sold-out">Sold out</span>Item name</div>
														<div class="item-price">?1,500.00</div>
													</div>
												</div>
												<div class="item-right">
													<i class="fa fa-trash"></i>
												</div>
											</div>

											<div class="item">
												<div class="item-left">
													<img src="http://via.placeholder.com/50x50" alt="" />
													<div class="item-info">
														<div class="item-name">Item name</div>
														<div class="item-price">?500.00</div>
													</div>
												</div>
												<div class="item-right">
													<i class="fa fa-trash"></i>
												</div>
											</div>

											<div class="item overlay">
												<div class="item-left">
													<img src="http://via.placeholder.com/50x50" alt="" />
													<div class="item-info">
														<div class="item-name"><span class="item-sold-out">Sold out</span>Item name</div>
														<div class="item-price">?1,500.00</div>
													</div>
												</div>
												<div class="item-right">
													<i class="fa fa-trash"></i>
												</div>
											</div>

											<button type="button" class="btn btn-dark">View Cart</button>
										</div> -->
									</div>

									<div class="nav-item right-nav dropdown" id="user-account">
										<a class="nav-link" href="/etiendahan/customer/account/login/" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-user-circle"></i>
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">
											<p>Howdy.</p>

											<!-- Development -->
											<a href="/etiendahan/customer/account/login/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Log in</div></a>
											<a href="/etiendahan/customer/account/create/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Create an account</div></a>

											<!-- Production -->
											<!-- <a href="/customer/account/login/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Log in</div></a>
											<a href="/customer/account/create/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Create an account</div></a> -->

										</div>
									</div>
								</div>

								<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>
							</nav>

							<!-- carousel -->
							<div id="etiendahanCarouselIndicators" class="carousel slide my-carousel" data-ride="carousel">
								<?php  
									$slides_result_one_result = $mysqli->query("SELECT * FROM tbl_slides");
									if($slides_result_one_result->num_rows > 1):
								?>
									<ol class="carousel-indicators">
										<?php  
										$count_indicator = 0;
											$slides_result_min_id = $mysqli->query("SELECT MIN(id) as min_id FROM tbl_slides");
											$slides_row_min_id = mysqli_fetch_assoc($slides_result_min_id);
											$slides_result_id = $mysqli->query("SELECT * FROM tbl_slides");
											while($slides_row_id = mysqli_fetch_assoc($slides_result_id)):
										?>
											<li data-target="#etiendahanCarouselIndicators" data-slide-to="<?php echo $count_indicator; ?>" <?php echo ($slides_row_min_id['min_id'] == $slides_row_id['id']) ? 'class="active"' : '' ?>></li>
										<?php $count_indicator++; endwhile; ?>
									</ol>
								<?php endif; ?>

								<div class="carousel-inner wrapper">
									<?php  
										$slides_result_min_id = $mysqli->query("SELECT MIN(id) as min_id FROM tbl_slides");
										$slides_row_min_id = mysqli_fetch_assoc($slides_result_min_id);
										$slides_result = $mysqli->query("SELECT * FROM tbl_slides");
										while($slides_row = mysqli_fetch_assoc($slides_result)):
									?>
										<div class="carousel-item <?php echo ($slides_row_min_id['min_id'] == $slides_row['id']) ? 'active' : '' ?>" draggable="false" style="background-image: url(<?php echo $slides_row['image'] ?>);" alt="First slide" >
											<div class="row h-100 d-flex">
												<div class="carousel-inner-overlay"></div>
												<?php  
													if($slides_row['promotional'] == 1):
												?>
													<div class="ribbon-promotional ribbon--dimgrey wow rollIn" data-wow-delay="400ms" style="visibility: hidden">Promotional</div>
												<?php endif; ?>
												<div class="col-md-12 text-center my-auto" style="z-index: 3">
													<div class="text-inner wow fadeInUp" data-wow-delay="600ms" style="visibility: hidden"><?php echo $slides_row['title']; ?></div>
													<?php  
														if($slides_row['link_status'] == 1):
													?>
														<div class="link-slider wow fadeInUp" data-wow-delay="920ms" style="visibility: hidden"><a href="/etiendahan/specialty-in-city/#sic-<?php echo $slides_row['link_to']; ?>">View Shop</a></div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									<?php endwhile; ?>
								</div>
								<?php  
									$slides_result_one_result = $mysqli->query("SELECT * FROM tbl_slides");
									if($slides_result_one_result->num_rows > 1):
								?>
									<a class="carousel-control-prev" href="#etiendahanCarouselIndicators" role="button" data-slide="prev">
										<i class="fa fa-angle-left" aria-hidden="true"></i>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#etiendahanCarouselIndicators" role="button" data-slide="next">
										<i class="fa fa-angle-right" aria-hidden="true"></i>
										<span class="sr-only">Next</span>
									</a>
								<?php endif; ?>
							</div>
							
							<div id="shop-now"></div>
							<!-- <div id="shop-now-link"></div> -->
							<!-- search bar -->
							<div class="container my-search">
								<div class="row">
									<div class="col-md-12">
										<div class="search-box">
											<form class="search-form" action="/etiendahan/c8NLPYLt-functions/search-function/" method="POST">
												<input class="form-control form-control-lg hintable ui-autocomplete-input" id="customerAutocomplete" hint-class="show-recent" placeholder="Search products" type="text" name="search" autocomplete="off">
												<button class="btn btn-link search-btn" name="search_button">
													<i class="fa fa-search" style="position: relative;bottom: 2px;"></i>
												</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END OF SECTION 1 -->
				<?php  
					}
				?>

				<!-- SECTION 4 - Homepage welcome message -->
				<div id="etiendahan-section-4" class="etiendahan-section">
					<div class="container">
						<!-- <div class="title-name">
							<h3><span class="wow pulse" data-wow-delay="1000ms">PROVINCE OF PANGASINAN</span></h3>
						</div> -->
						<h1 class="text-center wow slideInUp" data-wow-delay="400ms" style="visibility: hidden !important;">PROVINCE OF PANGASINAN</span></h1>
						<div class="row">
							<div class="col-md-2">
								<ul style="list-style: none; font-size: 12.6px;">
									<?php  
										$result_category_sub = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE provCode = '0155' ORDER BY citymunDesc LIMIT 24");
										while($row_category_sub = mysqli_fetch_assoc($result_category_sub)):
										$category_name = strtolower($row_category_sub['citymunDesc']);
									?>

									<a href="/etiendahan/market/view/sub/" class="my-gallery-inner <?php echo $row_category_sub['id'] ?>" data-value="<?php echo $row_category_sub['id'] ?>" style="color: black;"><li><?php echo ucwords($category_name) ?></li></a>

									<?php  
										endwhile;
									?>
								</ul>
							</div>
							<div class="col-md-8">
								<div class="welcome-message-image wow fadeInUp" data-wow-delay="550ms" style="background-image: url(temp-img/map-of-pangasinan.png); visibility: hidden !important;"></div>
								<!-- <div class="welcome-message-title wow fadeInUp" data-wow-delay="300ms">Welcome to Etiendahan</div>
								<div class="welcome-message-intro wow fadeInUp" data-wow-delay="600ms">Online Shopping Local Products | Province of Pangasinan</div>
								<div class="welcome-message-hashtag wow fadeInUp" data-wow-delay="600ms">#SHOPATETIENDAHAN</div> -->
								<!-- markers -->
								<div id="map-tips" style="position: relative;width: 0;height: 0;right: 206px;">
									<!-- bolinao -->
									<div class="tooltip-wrapper bolinao wow fadeInUp" data-wow-delay="1010ms" style="position: relative;bottom: 446px;left: 320px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Bolinao">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 91" data-value="91" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- anda -->
									<div class="tooltip-wrapper anda wow fadeInUp" data-wow-delay="1050ms" style="position: relative;bottom: 472px;left: 385px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Anda">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 82" data-value="82" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- bani -->
									<div class="tooltip-wrapper bani wow fadeInUp" data-wow-delay="1020ms" style="position: relative;bottom: 468px;left: 318px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Bani">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 85" data-value="85" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- agno -->
									<div class="tooltip-wrapper agno wow fadeInUp" data-wow-delay="1000ms" style="position: relative;bottom: 465px;left: 278px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Agno">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 78" data-value="78" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- city of alaminos -->
									<div class="tooltip-wrapper city-of-alaminos wow fadeInUp" data-wow-delay="1060ms" style="position: relative;bottom: 509px;left: 366px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="City Of Alaminos">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 80" data-value="80" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- burgos -->
									<div class="tooltip-wrapper burgos wow fadeInUp" data-wow-delay="1030ms" style="position: relative;bottom: 495px;left: 308px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Burgos">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 93" data-value="93" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- dasol -->
									<div class="tooltip-wrapper dasol wow fadeInUp" data-wow-delay="1040ms" style="position: relative;bottom: 485px;left: 298px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Dasol">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 96" data-value="96" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- infanta -->
									<div class="tooltip-wrapper infanta wow fadeInUp" data-wow-delay="1080ms" style="position: relative;bottom: 464px;left: 355px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Infanta">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 97" data-value="97" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- mabini -->
									<div class="tooltip-wrapper mabini wow fadeInUp" data-wow-delay="1070ms" style="position: relative;bottom: 561px;left: 369px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Mabini">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 100" data-value="100" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- sual -->
									<div class="tooltip-wrapper sual wow fadeInUp" data-wow-delay="1090ms" style="position: relative;bottom: 618px;left: 407px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Sual">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 119" data-value="119" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- labrador -->
									<div class="tooltip-wrapper labrador wow fadeInUp" data-wow-delay="1100ms" style="position: relative;bottom: 615px;left: 441px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Labrador">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 98" data-value="98" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- bugallon -->
									<div class="tooltip-wrapper bugallon wow fadeInUp" data-wow-delay="1120ms" style="position: relative;bottom: 620px;left: 477px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Bugallon">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 92" data-value="92" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- aguilar -->
									<div class="tooltip-wrapper aguilar wow fadeInUp" data-wow-delay="1130ms" style="position: relative;bottom: 609px;left: 495px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Aguilar">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 79" data-value="79" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- mangatarem -->
									<div class="tooltip-wrapper mangatarem wow fadeInUp" data-wow-delay="1140ms" style="position: relative;bottom: 546px;left: 518px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Mangatarem">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 104" data-value="104" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- lingayen (capital) -->
									<div class="tooltip-wrapper lingayen wow fadeInUp" data-wow-delay="1110ms" style="position: relative;bottom: 735px;left: 504px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Lingayen (capital)">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 99" data-value="99" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- binmaley -->
									<div class="tooltip-wrapper binmaley wow fadeInUp" data-wow-delay="1150ms" style="position: relative;bottom: 759px;left: 534px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Binmaley">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 90" data-value="90" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- dagupan city -->
									<div class="tooltip-wrapper dagupan-city wow fadeInUp" data-wow-delay="1160ms" style="position: relative;bottom: 815px;left: 569px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Dagupan City">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 95" data-value="95" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- calasiao -->
									<div class="tooltip-wrapper calasiao wow fadeInUp" data-wow-delay="1170ms" style="position: relative;bottom: 818px;left: 577px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Calasiao">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 94" data-value="94" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- san carlos city -->
									<div class="tooltip-wrapper san-carlos-city wow fadeInUp" data-wow-delay="1180ms" style="position: relative;bottom: 811px;left: 555px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="San Carlos City">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 109" data-value="109" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- urbiztondo -->
									<div class="tooltip-wrapper urbiztondo wow fadeInUp" data-wow-delay="1190ms" style="position: relative;bottom: 790px;left: 580px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Urbiztondo">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 122" data-value="122" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- basista -->
									<div class="tooltip-wrapper basista wow fadeInUp" data-wow-delay="1220ms" style="position: relative;bottom: 842px;left: 607px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Basista">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 86" data-value="86" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- bayambang -->
									<div class="tooltip-wrapper bayambang wow fadeInUp" data-wow-delay="1230ms" style="position: relative;bottom: 822px;left: 627px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Bayambang">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 88" data-value="88" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- bautista -->
									<div class="tooltip-wrapper bautista wow fadeInUp" data-wow-delay="1300ms" style="position: relative;bottom: 839px;left: 688px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Bautista">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 87" data-value="87" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- alcala -->
									<div class="tooltip-wrapper alcala wow fadeInUp" data-wow-delay="1290ms" style="position: relative;bottom: 919px;left: 689px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Alcala">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 81" data-value="81" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- santo tomas -->
									<div class="tooltip-wrapper santo-tomas wow fadeInUp" data-wow-delay="1390ms" style="position: relative;bottom: 954px;left: 721px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Santo Tomas">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 117" data-value="117" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- rosales -->
									<div class="tooltip-wrapper rosales wow fadeInUp" data-wow-delay="1400ms" style="position: relative;bottom: 978px;left: 755px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Rosales">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 108" data-value="108" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- balungao -->
									<div class="tooltip-wrapper balungao wow fadeInUp" data-wow-delay="1460ms" style="position: relative;bottom: 1021px;left: 795px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Balungao">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 84" data-value="84" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- umingan -->
									<div class="tooltip-wrapper umingan wow fadeInUp" data-wow-delay="1470ms" style="position: relative;bottom: 1053px;left: 866px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Umingan">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 121" data-value="121" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- san quintin -->
									<div class="tooltip-wrapper san-quintin wow fadeInUp" data-wow-delay="1440ms" style="position: relative;bottom: 1133px;left: 853px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="San Quintin">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 114" data-value="114" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- natividad -->
									<div class="tooltip-wrapper natividad wow fadeInUp" data-wow-delay="1420ms" style="position: relative;bottom: 1190px;left: 845px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Natividad">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 106" data-value="106" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- san nicolas -->
									<div class="tooltip-wrapper san-nicolas wow fadeInUp" data-wow-delay="1410ms" style="position: relative;bottom: 1257px;left: 807px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="San Nicolas">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 113" data-value="113" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- san manuel -->
									<div class="tooltip-wrapper san-manuel wow fadeInUp" data-wow-delay="1330ms" style="position: relative;bottom: 1275px;left: 747px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="San Manuel">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 112" data-value="112" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- sison -->
									<div class="tooltip-wrapper sison wow fadeInUp" data-wow-delay="1310ms" style="position: relative;bottom: 1341px;left: 680px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Sison">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 118" data-value="118" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- san fabian -->
									<div class="tooltip-wrapper san-fabian wow fadeInUp" data-wow-delay="1240ms" style="position: relative;bottom: 1351px;left: 617px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="San Fabian">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 110" data-value="110" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- mangaldan -->
									<div class="tooltip-wrapper mangaldan wow fadeInUp" data-wow-delay="1200ms" style="position: relative;bottom: 1347px;left: 599px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Mangaldan">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 103" data-value="103" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- santa barbara -->
									<div class="tooltip-wrapper santa-barbara wow fadeInUp" data-wow-delay="1210ms" style="position: relative;bottom: 1338px;left: 611px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Santa Barbara">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 115" data-value="115" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- malasiqui -->
									<div class="tooltip-wrapper malasiqui wow fadeInUp" data-wow-delay="1280ms" style="position: relative;bottom: 1326px;left: 646px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Malasiqui">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 101" data-value="101" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- villasis -->
									<div class="tooltip-wrapper villasis wow fadeInUp" data-wow-delay="1380ms" style="position: relative;bottom: 1359px;left: 711px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Villasis">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 124" data-value="124" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- santa maria -->
									<div class="tooltip-wrapper santa-maria wow fadeInUp" data-wow-delay="1450ms" style="position: relative;bottom: 1407px;left: 779px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Santa Maria">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 116" data-value="116" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- tayug -->
									<div class="tooltip-wrapper tayug wow fadeInUp" data-wow-delay="1430ms" style="position: relative;bottom: 1467px;left: 803px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Tayug">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 120" data-value="120" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- asingan -->
									<div class="tooltip-wrapper asingan wow fadeInUp" data-wow-delay="1360ms" style="position: relative;bottom: 1489px;left: 759px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Asingan">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 83" data-value="83" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- binalonan -->
									<div class="tooltip-wrapper binalonan wow fadeInUp" data-wow-delay="1340ms" style="position: relative;bottom: 1544px;left: 722px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Binalonan">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 89" data-value="89" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- laoac -->
									<div class="tooltip-wrapper laoac wow fadeInUp" data-wow-delay="1350ms" style="position: relative;bottom: 1564px;left: 690px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Laoac">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 125" data-value="125" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- pozorrubio -->
									<div class="tooltip-wrapper pozorrubio wow fadeInUp" data-wow-delay="1320ms" style="position: relative;bottom: 1625px;left: 680px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Pozzorubio">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 107" data-value="107" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- manaoag -->
									<div class="tooltip-wrapper manaoag wow fadeInUp" data-wow-delay="1260ms" style="position: relative;bottom: 1625px;left: 657px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Manaoag">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 102" data-value="102" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- san jacinto -->
									<div class="tooltip-wrapper san-jacinto wow fadeInUp" data-wow-delay="1250ms" style="position: relative;bottom: 1670px;left: 633px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="San Jacinto">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 111" data-value="111" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- city of urdaneta -->
									<div class="tooltip-wrapper city-of-urdaneta wow fadeInUp" data-wow-delay="1370ms" style="position: relative;bottom: 1648px;left: 700px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="City Of Urdaneta">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 123" data-value="123" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>

									<!-- mapandan -->
									<div class="tooltip-wrapper mapandan wow fadeInUp" data-wow-delay="1270ms" style="position: relative;bottom: 1694px;left: 640px;display: inline-block;" data-toggle="tooltip" data-placement="top" title="Mapandan">
										<a href="/etiendahan/market/view/sub/" class="my-gallery-inner 105" data-value="105" style="display:inline-block; margin-top: 3px;">
											<img src="temp-img/marker.png" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<ul style="list-style: none; font-size: 12.6px; text-align: right;">
									<?php  
										$result_category_sub = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE provCode = '0155' ORDER BY citymunDesc LIMIT 24, 48");
										while($row_category_sub = mysqli_fetch_assoc($result_category_sub)):
										$category_name = strtolower($row_category_sub['citymunDesc']);
									?>

									<a href="/etiendahan/market/view/sub/" class="my-gallery-inner <?php echo $row_category_sub['id'] ?>" data-value="<?php echo $row_category_sub['id'] ?>" style="color: black;"><li><?php echo ucwords($category_name) ?></li></a>

									<?php  
										endwhile;
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF SECTION 4 -->

				<!-- SECTION 2 - Homepage categories -->
				<div id="etiendahan-section-2" class="etiendahan-section">
					<div class="container">
						<div class="title-name">
							<h3><span class="wow pulse" data-wow-delay="1000ms">SHOP BY CATEGORIES</span></h3>
						</div>
						<span class="tooltip-wrapper" style="position: relative;left: 68%;bottom: 56px; color: dimgrey" data-toggle="tooltip" data-placement="right" title="Manufactured Products e.g. deboned bangus at Dagupan City, bamboo-based home furnishings at San Carlos City. Non-manufactured Products e.g. mango at Sta. Barbata, onion at Alcala."><i class="fa fa-info-circle" style="color: dimgrey; font-size: 20px;"></i></span>

						<div class="m-3"></div>
					 	<div class="row text-center text-lg-left">
					        <div class="col-md-2 col-sm-2" style="border-right: none;">
					        </div>
					        <div class="col-md-2 col-sm-2">
					        </div>

					        <?php  
								$result_category = $mysqli->query("SELECT * FROM tbl_categories LIMIT 2");
								while($category_row = mysqli_fetch_assoc($result_category)):
							?>

					        <div class="col-md-2">
								<a href="/etiendahan/market/view/sub/" class="d-block my-gallery-inner" id="<?php echo $category_row['id']; ?>">
									<div class="category-image">
										<div class="zoom img-fluid lazy" data-src="<?php echo ($category_row['image'] != '')? $category_row['image'] : 'http://via.placeholder.com/150/?text=No+Image+Preview'; ?>"></div>
									</div>
									<div class="category-name text-center mb-3">
										<?php echo $category_row['name']; ?>
									</div>
								</a>
					        </div>

					    	<?php endwhile; ?>

					        <div class="col-md-2" style="border-right: none;">
					        </div>
					        <div class="col-md-2" style="border-right: none;">
					        </div>
			      		</div>

			      		<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, quidem. Aperiam eaque porro cum, qui! Repellat quibusdam eos officiis consequuntur quidem nesciunt autem cum quos magnam reiciendis mollitia explicabo provident, adipisci optio fuga libero quo ad eveniet cumque. Quod voluptatum praesentium similique id voluptate blanditiis debitis, officia deserunt nemo et quis distinctio aliquam enim. Fuga illo blanditiis aperiam dolores eos expedita nihil, qui facere cum, ex, consequatur similique laborum rerum porro consectetur repellat dicta ipsam natus aspernatur. Deleniti expedita consequuntur in incidunt dolor. Magni ab accusamus dolore aperiam sapiente neque ad voluptas, nihil eligendi dolorum quidem recusandae quis rerum maxime molestiae aliquid deserunt minima libero necessitatibus? Doloremque minima quaerat dolorum quia repellendus eos delectus eum odit quo id. Voluptas necessitatibus, similique, cupiditate cum temporibus, perferendis dolorum nisi impedit eligendi consequatur, totam nobis culpa dolor minima. Nisi excepturi repudiandae quo labore, in delectus fugit doloremque. Illum voluptas magni ab saepe tempora veniam quidem odio dignissimos sapiente consequuntur laborum molestias amet incidunt optio sint, repellendus distinctio dolorum, delectus quam quaerat magnam officiis commodi consectetur. Dolor facilis, veniam molestiae dolores ratione exercitationem velit illum repellendus hic illo tempora dolore modi incidunt reprehenderit, alias magnam iusto nesciunt enim aspernatur officiis. Placeat veniam explicabo quia odit libero? Maxime, possimus iure ipsum quidem beatae iste explicabo perspiciatis quod in hic, officia laudantium error ipsam cupiditate natus nam eum debitis voluptatum impedit eligendi. Quibusdam libero dolor voluptatem vero corrupti et quia minima odit deserunt dolorum ipsum impedit doloremque corporis, magnam nisi perferendis iusto, eligendi unde, esse placeat! Nesciunt ipsa a provident corrupti sapiente neque! Consectetur animi fugiat officia doloremque cupiditate excepturi quo rerum porro aut perferendis commodi, blanditiis, iure nam sit exercitationem nulla magni omnis sequi vero perspiciatis. Laboriosam obcaecati cum laudantium, repellendus, autem eius. Non pariatur cupiditate beatae! Alias corporis vero nulla enim voluptas. Molestias velit, at architecto delectus nihil illo explicabo rem cupiditate enim neque possimus amet atque, soluta quos sit. Perspiciatis maiores vel sequi suscipit ipsam illum voluptates nostrum quo aperiam ex, voluptatibus provident nam quas quibusdam, incidunt. Sint, totam quis vero aliquam natus veniam veritatis pariatur quas velit non ad eum est hic dolores debitis fugit cupiditate unde repudiandae maiores. Nisi et aliquid aliquam sunt, cumque repudiandae, voluptatibus molestiae, culpa natus quaerat adipisci illum at ex possimus, quia nemo saepe necessitatibus veritatis nam optio suscipit laudantium? Laudantium quaerat quia illo consequuntur ad odio repellat eaque inventore! Consectetur velit quod error tenetur suscipit autem, ipsum voluptatem rem tempora cumque odio excepturi iste facilis ducimus est ad aliquam dignissimos esse, soluta accusantium dolore? Enim nostrum vitae, amet ea quis itaque cumque harum nobis quasi ex sequi explicabo saepe veritatis dignissimos eum quos repellat, recusandae pariatur ducimus blanditiis sint quidem. Dolores quisquam nisi, illo ab enim, voluptates accusantium quo doloribus aliquid et sequi necessitatibus corporis harum adipisci. Possimus nesciunt sunt quo temporibus itaque adipisci illo veniam nemo consequatur modi laudantium rerum sit amet, commodi eaque culpa, animi! Fuga vitae ea quam deserunt, suscipit quibusdam doloribus saepe dicta at minima iure recusandae sint consequatur laudantium laboriosam, cupiditate!</p>	 -->
		      		</div>
				</div>
				<!-- END OF SECTION 2 -->

				<!-- SECTION 3 - Homepage popular products -->
				<div id="etiendahan-section-6" class="etiendahan-section">
						<?php  
							$result = $mysqli->query("SELECT * FROM tbl_orders");
							if($result->num_rows == 0):
						?>
							<!-- have not recently view -->
							<div class="container" style="padding: 40px 0 70px 0">
								<div class="title-name" style="margin: 0 auto 35px;">
									<!-- <a href="/etiendahan/popular-products/">See all<i class="fa fa-chevron-right fa-fw"></i></a> -->
									<h3><span class="wow pulse" data-wow-delay="1200ms">POPULAR PRODUCTS</h3>
								</div>
								<div class="text-center">No Popular Products Yet</div>
							</div>
						<?php else: ?>
							<!-- have recently view -->
							<div class="container">
								<div class="title-name">
									<a href="/etiendahan/popular-products/">See all<i class="fa fa-chevron-right fa-fw"></i></a>
									<h3><span class="wow pulse" data-wow-delay="1200ms">POPULAR PRODUCTS</h3>
								</div>

								<div class="owl-carousel">
									<?php  
										$recently_viewed_products_result = $mysqli->query("SELECT substring_index(group_concat(product_id SEPARATOR ','), ',', 10) as 'product_id_result' FROM tbl_orders");
										while($recently_viewed_products_row = mysqli_fetch_assoc($recently_viewed_products_result)):
										$product_id = $recently_viewed_products_row['product_id_result'];

										$product_result_recently_viewed_products = $mysqli->query("SELECT * FROM tbl_products WHERE id IN($product_id) AND stock > 0 AND banned = 0");
										while($product_row_recently_viewed_products = mysqli_fetch_assoc($product_result_recently_viewed_products)):
									?>
									<div class="item">
										<?php 
											$product_id_date = $product_row_recently_viewed_products['id'];
											$date_joined_result_day = $mysqli->query("SELECT DATEDIFF(NOW(),created_at) FROM tbl_products WHERE id = $product_id_date");
											$date_joined_row_day = $date_joined_result_day->fetch_assoc();	
											
											if($date_joined_row_day['DATEDIFF(NOW(),created_at)'] < 3):
										?>
										<div class="ribbon view-product ribbon--dimgrey">NEW</div>
										<?php endif; ?>
										<a href="/etiendahan/market/view/product/" class="category-product-id" id="<?php echo $product_row_recently_viewed_products['id']; ?>">
											<div class="card">
												<?php $saved_image = explode(',', $product_row_recently_viewed_products['image']); ?>
												<div class="card-image img-fluid owl-lazy" data-src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>"></div>
												<div class="card-body">
													<div class="product-name"><?php echo $product_row_recently_viewed_products['name'] ?></div>
													<div class="product-price">₱ <?php echo $product_row_recently_viewed_products['price'] ?></div>
													<div class="product-rating" style="height: 18px;">
														<?php  
															$ratings_result_count1 = $mysqli->query("SELECT COUNT(*) AS 'total' FROM tbl_ratings WHERE product_id = '$product_id_date'");
															$ratings_row_count1 = $ratings_result_count1->fetch_assoc();
															$ratings_count1 = $ratings_row_count1['total'];

															$ratings_result_avg1 = $mysqli->query("SELECT tbl_products.id, tbl_products.name, AVG(tbl_ratings.rating) AS rating FROM tbl_products LEFT JOIN tbl_ratings ON tbl_products.id = tbl_ratings.product_id AND tbl_ratings.product_id = '$product_id_date'");
															$ratings_row_avg1 = $ratings_result_avg1->fetch_assoc();
															$ratings_avg1 = round($ratings_row_avg1['rating']);												
														?>
														<?php  
															$ratins_result_row1 = $mysqli->query("SELECT * FROM tbl_ratings WHERE product_id = '$product_id_date'");
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
									<?php endwhile; endwhile; ?>
								</div>
							</div>
						<?php endif; ?>
				</div>
				<!-- END OF SECTION 3 -->

				<!-- SECTION 5 - Homepage daily discover -->
				<div id="etiendahan-section-5" class="etiendahan-section">
					<div class="container">
						<div class="title-name">
							<a href="/etiendahan/daily-discover/">See all<i class="fa fa-chevron-right fa-fw"></i></a>
							<h3><span class="wow pulse" data-wow-delay="1300ms">DAILY DISCOVER</span></h3>
						</div>
						
						<div class="item-wrapper">
							<?php  
								$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE stock > 0 AND banned = 0 ORDER BY RAND(".date("Ymd").") LIMIT 10");
								if($product_result->num_rows > 0):
								while($product_row = mysqli_fetch_assoc($product_result)):
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
								<a href="/etiendahan/market/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
									<div class="card">
										<?php $saved_image = explode(',', $product_row['image']); ?>
										<div class="card-image lazy" style="width: 212px;" data-src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>"></div>
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
				<!-- END OF SECTION 5 -->
				
				<?php if($logged_in == true): ?>
					<!-- SECTION 6 - Homepage recently_viewed_products -->
					<div id="etiendahan-recently-viewed-products" class="etiendahan-section">
						<?php  
							$result = $mysqli->query("SELECT * FROM tbl_recently_viewed_products WHERE email = '$email'");
							if($result->num_rows == 0):
						?>
							<!-- have not recently view -->
							<div class="container-fluid">
								<div class="recently-view">
									<div class="first-para">You don't have any recently viewed products.</div>
									<div class="second-para">View products on Etiendahan and we'll track them here...</div>
								</div>
							</div>
						<?php else: ?>
							<!-- have recently view -->
							<div class="container">
								<div class="title-name">
									<a href="/etiendahan/recently-viewed-products/">See all<i class="fa fa-chevron-right fa-fw"></i></a>
									<h3><span class="wow pulse" data-wow-delay="1400ms">YOUR RECENTLY VIEWED PRODUCTS<?php if($user['first_name'] != ''): ?>, <?php echo $user['first_name'] ?><?php endif; ?></span></h3>
								</div>

								<div class="owl-carousel">
									<?php  
										$recently_viewed_products_result = $mysqli->query("SELECT GROUP_CONCAT(product_id) AS 'product_id_result' FROM tbl_recently_viewed_products WHERE email = '$email' GROUP BY modified_at desc LIMIT 10");
										while($recently_viewed_products_row = mysqli_fetch_assoc($recently_viewed_products_result)):
										$product_id = $recently_viewed_products_row['product_id_result'];

										$product_result_recently_viewed_products = $mysqli->query("SELECT * FROM tbl_products WHERE id IN($product_id) AND stock > 0 AND banned = 0");
										while($product_row_recently_viewed_products = mysqli_fetch_assoc($product_result_recently_viewed_products)):
									?>
									<div class="item">
										<?php 
											$product_id_date = $product_row_recently_viewed_products['id'];
											$date_joined_result_day = $mysqli->query("SELECT DATEDIFF(NOW(),created_at) FROM tbl_products WHERE id = $product_id_date");
											$date_joined_row_day = $date_joined_result_day->fetch_assoc();	
											
											if($date_joined_row_day['DATEDIFF(NOW(),created_at)'] < 3):
										?>
										<div class="ribbon view-product ribbon--dimgrey">NEW</div>
										<?php endif; ?>
										<a href="/etiendahan/market/view/product/" class="category-product-id" id="<?php echo $product_row_recently_viewed_products['id']; ?>">
											<div class="card">
												<?php $saved_image = explode(',', $product_row_recently_viewed_products['image']); ?>
												<div class="card-image img-fluid owl-lazy" data-src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>"></div>
												<div class="card-body">
													<div class="product-name"><?php echo $product_row_recently_viewed_products['name'] ?></div>
													<div class="product-price">₱ <?php echo $product_row_recently_viewed_products['price'] ?></div>
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
									<?php endwhile; endwhile; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<!-- END OF SECTION 6 -->
				<?php endif; ?>
				
				<!-- SECTION 7 - Homepage about -->
				<div id="etiendahan-section-7" class="etiendahan-section">
					<div class="container">
						<div class="row">
							<div class="col-md-4 border-insert">
								<div class="about">
									<!-- <a href="http://localhost:8080/etiendahan/"><img src="http://via.placeholder.com/225x70/" alt=""></a> -->
									<a href="http://localhost:8080/etiendahan/"><img src="temp-img/etiendahan-logo.png" alt=""></a>
									<div class="about-text">
										<p>Join Etiendahan to find local products available at Province of Pangasinan. Shopping online at Philippines’ best marketplace cannot get any easier.</p>
										<p>Etiendahan provides the right tools to support all our sellers on our marketplace platform. List your products in less than 30 seconds. Sell better and get more exposure for your products.</p>
									</div>

									<div class="social">
										<div class="title-footer">FOLLOW US</div>
										<ul class="social-icons">
											<li class="facebook">
												<a class="fa fa-facebook" href="https://web.facebook.com/etiendahan/" target="_blank"></a>
											</li>
											<li class="instagram">
												<a class="fa fa-instagram" href="https://www.instagram.com/etiendahan/" target="_blank"></a>
											</li>
											<li class="twitter">
												<a class="fa fa-twitter" href="https://twitter.com/etiendahan/" target="_blank"></a>
											</li>
											<li class="google-plus">
												<a class="fa fa-google-plus" href="https://plus.google.com/u/2/110265818297635318631/" target="_blank"></a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-md-2 ml-5">
								<div class="footer-info">
									<div class="footer-title">
										<h3>INFORMATION</h3>
									</div>
									<div class="sub-info">
										<ul class="footer-list">
											<li>
												<a href="/etiendahan/about/"><i class="fa fa-square-o"></i><i class="fa fa-square" style="display: none"></i>About Etiendahan</a>
											</li>
											<li>
												<a href="/etiendahan/terms-conditions/"><i class="fa fa-square-o"></i><i class="fa fa-square" style="display: none"></i>Terms & Conditions</a>
											</li>
											<li>
												<a href="/etiendahan/privacy-policy/"><i class="fa fa-square-o"></i><i class="fa fa-square" style="display: none"></i>Privacy Policy</a>
											</li>
											<li>
												<a href="/etiendahan/contact/"><i class="fa fa-square-o"></i><i class="fa fa-square" style="display: none"></i>Contact Us</a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-md-4 ml-5">
								<div class="footer-info">
									<div class="footer-title">
										<h3 class="like-page">Like our facebook page</h3>
									</div>
								</div>

								<!-- Your like button code -->
								<div id="fboverlay" class="fb-like" data-href="https://web.facebook.com/etiendahan/" data-layout="standard" data-width="300" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF SECTION 7 -->

				<!-- SECTION 8 - Homepage footer copyright -->
				<div id="etiendahan-section-8" class="etiendahan-section">
					<div class="container">
						<div class="footer-title">
							Copyright © <?php echo date("Y"); ?> by <a href="https://allandrake.wixsite.com/portfolio/" target="_blank">ADPD</a>. All rights reserved.
						</div>
					</div>
				</div>
				<!-- END OF SECTION 8 -->

				<!-- POPUP NOTIFICATION - greetings -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-info-circle mr-1 alert-primary"></i>Greetings to our new customer from Etiendahan!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['get-fullname-message']) ) {
								echo $_SESSION['get-fullname-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['get-fullname-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->

				<!-- POPUP NOTIFICATION - welcome -->
				<div id="popup-notification-welcome" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close-welcome" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-info-circle mr-1 alert-primary"></i>Welcome back!</div>
					<div class="popup-content-welcome text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['welcome-message']) ) {
								echo $_SESSION['welcome-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['welcome-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->

				<!-- POPUP NOTIFICATION - logout -->
				<div id="popup-notification-logout" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close-logout" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-info-circle mr-1 alert-primary"></i>You have been logged out, Thanks for stopping by!</div>
					<div class="popup-content-logout text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['logout-message']) ) {
								echo $_SESSION['logout-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['logout-message'] );

								session_unset();
								session_destroy();
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->

				<!-- POPUP NOTIFICATION - logout -redirect -->
				<div id="popup-notification-logout-redirect" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close-logout-redirect" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-danger"></i>Can't proceed!</div>
					<div class="popup-content-logout-redirect text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['logout-message-redirect']) ) {
								echo $_SESSION['logout-message-redirect'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['logout-message-redirect'] );
							}
						?>

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

	<!-- Normal import of theme.js -->
	<script src="assets/js/theme.js"></script>

 	<!-- Minified import of theme.js -->
	<!-- <script src="assets/js/theme.min.js"></script> -->
</body>
</html>