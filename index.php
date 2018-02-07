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
	<title>Etiendahan Dagupan | Online Shopping Marketplace</title>
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
					if ( $logged_in == true) {
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

											<!-- SPECIALTY IN CITY -->
											<li class="nav-item">
												<a class="nav-link cl-effect" href="/etiendahan/specialty-in-city/">Specialty in City</a>
											</li>

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
											
											<?php  
												$men_result = $mysqli->query("SELECT id FROM tbl_categories WHERE name = 'Men\'s Fashion'");
												$men_row = $men_result->fetch_assoc();
											?>
											<!-- MEN -->
											<li class="nav-item">
												<a class="nav-link cl-effect my-gallery-inner" href="/etiendahan/category/view/" id="<?php echo $men_row['id']; ?>">Men</a>
											</li>
											
											<?php  
												$women_result = $mysqli->query("SELECT id FROM tbl_categories WHERE name = 'Women\'s Fashion'");
												$women_row = $women_result->fetch_assoc();
											?>
											<!-- WOMEN -->
											<li class="nav-item">
												<a class="nav-link cl-effect my-gallery-inner" href="/etiendahan/category/view/" id="<?php echo $women_row['id']; ?>">Women</a>
											</li>

											<!-- ALL CATEGORIES -->
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
																<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
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
											<p>Howdie.</p>

											<a href="/etiendahan/customer/account/profile/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Manage my account</div></a>
											<a href="/etiendahan/customer/orders/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>My Orders</div></a>
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

											<!-- SPECIALTY IN CITY -->
											<li class="nav-item">
												<a class="nav-link cl-effect" href="/etiendahan/specialty-in-city/">Specialty in City</a>
											</li>

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

											<?php  
												$men_result = $mysqli->query("SELECT id FROM tbl_categories WHERE name = 'Men\'s Fashion'");
												$men_row = $men_result->fetch_assoc();
											?>
											<!-- MEN -->
											<li class="nav-item">
												<a class="nav-link cl-effect my-gallery-inner" href="/etiendahan/category/view/" id="<?php echo $men_row['id']; ?>">Men</a>
											</li>
											
											<?php  
												$women_result = $mysqli->query("SELECT id FROM tbl_categories WHERE name = 'Women\'s Fashion'");
												$women_row = $women_result->fetch_assoc();
											?>
											<!-- WOMEN -->
											<li class="nav-item">
												<a class="nav-link cl-effect my-gallery-inner" href="/etiendahan/category/view/" id="<?php echo $women_row['id']; ?>">Women</a>
											</li>

											<!-- ALL CATEGORIES -->
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
											<p>Howdie.</p>

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

				
				
				<!-- SECTION 2 - Homepage categories -->
				<div id="etiendahan-section-2" class="etiendahan-section">
					<div class="container">
						<!-- <h1 class="my-4 text-center text-lg-left">CATEGORIES</h1> -->
						<div class="m-3"></div>
					 	<div class="row text-center text-lg-left">
					        <div class="col-md-2 col-sm-2">
					        </div>

					        <?php  
								$result_category = $mysqli->query("SELECT * FROM tbl_categories LIMIT 4");
								while($category_row = mysqli_fetch_assoc($result_category)):
							?>

					        <div class="col-md-2">
								<a href="/etiendahan/category/view/" class="d-block my-gallery-inner" id="<?php echo $category_row['id']; ?>">
									<div class="category-image">
										<div class="zoom img-fluid lazy" data-src="<?php echo ($category_row['image'] != '')? $category_row['image'] : 'http://via.placeholder.com/150/?text=No+Image+Preview'; ?>"></div>
									</div>
									<div class="category-name text-center mb-3">
										<?php echo $category_row['name']; ?>
									</div>
								</a>
					        </div>

					    	<?php endwhile; ?>

					        <div class="col-md-2">
					        </div>
			      		</div>

			      		<div class="row text-center text-lg-left mt-4">
					       
					        <?php  
								$result_category = $mysqli->query("SELECT * FROM tbl_categories LIMIT 4, 10");
								while($category_row = mysqli_fetch_assoc($result_category)):
							?>

					        <div class="col-md-2">
								<a href="/etiendahan/category/view/" class="d-block my-gallery-inner" id="<?php echo $category_row['id']; ?>">
									<div class="category-image">
										<div class="zoom img-fluid lazy" data-src="<?php echo ($category_row['image'] != '')? $category_row['image'] : 'http://via.placeholder.com/150/?text=No+Image+Preview'; ?>"></div>
									</div>
									<div class="category-name text-center mb-3">
										<?php echo $category_row['name']; ?>
									</div>
								</a>
					        </div>

					    	<?php endwhile; ?>	

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
							<div class="container-fluid">
								No Popular Products Yet
							</div>
						<?php else: ?>
							<!-- have recently view -->
							<div class="container">
								<div class="title-name">
									<a href="/etiendahan/popular-products/">See all<i class="fa fa-chevron-right fa-fw"></i></a>
									<h3><span class="wow pulse" data-wow-delay="1000ms">POPULAR PRODUCTS</h3>
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
										<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row_recently_viewed_products['id']; ?>">
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
				<!-- END OF SECTION 3 -->

				<!-- SECTION 4 - Homepage welcome message -->
				<div id="etiendahan-section-4" class="etiendahan-section">
					<div class="container-fluid">
						<div class="welcome-message-overlay">
							<div class="welcome-message-image" style="background-image: url(https://goodybagbsd.weebly.com/uploads/1/0/7/4/107489607/613870564.jpg);"></div>
							<div class="welcome-message-title wow fadeInUp" data-wow-delay="300ms">Welcome to Etiendahan</div>
							<div class="welcome-message-intro wow fadeInUp" data-wow-delay="600ms">Online Shopping Marketplace here in Dagupan</div>
							<div class="welcome-message-hashtag wow fadeInUp" data-wow-delay="600ms">#<a href="https://web.facebook.com/etiendahan/">SHOPATETIENDAHAN</a></div>
						</div>
					</div>
				</div>
				<!-- END OF SECTION 4 -->

				<!-- SECTION 5 - Homepage daily discover -->
				<div id="etiendahan-section-5" class="etiendahan-section">
					<div class="container">
						<div class="title-name">
							<a href="/etiendahan/daily-discover/">See all<i class="fa fa-chevron-right fa-fw"></i></a>
							<h3><span class="wow pulse" data-wow-delay="1000ms">DAILY DISCOVER</span></h3>
						</div>
						
						<div class="item-wrapper">
							<?php  
								$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE stock > 0 AND banned = 0 ORDER BY RAND(".date("Ymd").") LIMIT 15");
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
								<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
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
					<div id="etiendahan-section-6" class="etiendahan-section">
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
									<h3><span class="wow pulse" data-wow-delay="1000ms">YOUR RECENTLY VIEWED PRODUCTS<?php if($user['first_name'] != ''): ?>, <?php echo $user['first_name'] ?><?php endif; ?></span></h3>
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
										<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row_recently_viewed_products['id']; ?>">
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
										<p>Join Etiendahan to find everything you need at the best prices. Shopping online at Philippines’ best marketplace cannot get any easier.</p>
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
							Copyright © <?php echo date("Y"); ?> by <a href="https://allandrake.wixsite.com/freelancer" target="_blank">ADPD</a>. All rights reserved.
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