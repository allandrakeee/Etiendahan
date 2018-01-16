<?php  
	require '/db.php';
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	$email 	= ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');
    $result = $mysqli->query("SELECT SUBSTRING_INDEX(fullname, ' ', 1) AS first_name FROM tbl_customers WHERE email='$email'");
	$user = $result->fetch_assoc();
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
												<a class="nav-link cl-effect" href="#">Specialty in City</a>
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
												<a class="nav-link" href="/etiendahan/customer/account/profile/" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
													<i class="fa fa-user-circle"></i>
												</a>
												<div class="dropdown-menu" aria-labelledby="navbarDropdown">
													<p>Howdie.</p>

													<a href="/etiendahan/customer/account/profile/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Manage my account</div></a>
													<a href="/etiendahan/customer/orders/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>My Orders</div></a>
													<a href="/etiendahan/customer/wishlists/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Wishlists</div></a>
													<a href="/etiendahan/logout/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>LOGOUT</div></a>
												</div>
											</div>
								</div>

								<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>
							</nav>

							<!-- carousel -->
							<div id="etiendahanCarouselIndicators" class="carousel slide my-carousel" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#etiendahanCarouselIndicators" data-slide-to="0" class="active"></li>
									<li data-target="#etiendahanCarouselIndicators" data-slide-to="1"></li>
									<li data-target="#etiendahanCarouselIndicators" data-slide-to="2"></li>
									<li data-target="#etiendahanCarouselIndicators" data-slide-to="3"></li>
								</ol>
								<div class="carousel-inner">
									<div class="carousel-item active" draggable="false" style="background-image: url(https://cdn.shopify.com/s/files/1/0998/0122/files/ico_slide_1_b9b255c6-a8d0-49ac-add0-9e94c0039e4c.jpg?v=1490971377);" alt="First slide" ></div>
									<div class="carousel-item" draggable="false" style="background-image: url(https://cdn.shopify.com/s/files/1/0998/0122/files/ico_slide_2.jpg);" alt="Second slide" ></div>
									<div class="carousel-item" draggable="false" style="background-image: url(http://via.placeholder.com/1200x480);" alt="Third slide" ></div>
									<div class="carousel-item" draggable="false" style="background-image: url(http://via.placeholder.com/1600x600);" alt="Fourth slide" ></div>
								</div>
								<a class="carousel-control-prev" href="#etiendahanCarouselIndicators" role="button" data-slide="prev">
									<i class="fa fa-angle-left" aria-hidden="true"></i>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#etiendahanCarouselIndicators" role="button" data-slide="next">
									<i class="fa fa-angle-right" aria-hidden="true"></i>
									<span class="sr-only">Next</span>
								</a>
							</div>
							
							<div id="shop-now"></div>
							<!-- <div id="shop-now-link"></div> -->
							<!-- search bar -->
							<div class="container my-search">
								<div class="row">
									<div class="col-md-12">
										<div class="search-box">
											<form class="search-form" action="/etiendahan/c8NLPYLt-functions/search-function/" method="POST">
												<input class="form-control form-control-lg hintable ui-autocomplete-input" id="customerAutocomplte" hint-class="show-recent" placeholder="Search products" type="text" name="search" autocomplete="off">
												<button class="btn btn-link search-btn" name="search_button">
													<i class="fa fa-search"></i>
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
												<a class="nav-link cl-effect" href="#">Specialty in City</a>
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
								<ol class="carousel-indicators">
									<li data-target="#etiendahanCarouselIndicators" data-slide-to="0" class="active"></li>
									<li data-target="#etiendahanCarouselIndicators" data-slide-to="1"></li>
									<li data-target="#etiendahanCarouselIndicators" data-slide-to="2"></li>
									<li data-target="#etiendahanCarouselIndicators" data-slide-to="3"></li>
								</ol>
								<div class="carousel-inner">
									<div class="carousel-item active" draggable="false" style="background-image: url(https://cdn.shopify.com/s/files/1/0998/0122/files/ico_slide_1_b9b255c6-a8d0-49ac-add0-9e94c0039e4c.jpg?v=1490971377);" alt="First slide" ></div>
									<div class="carousel-item" draggable="false" style="background-image: url(https://cdn.shopify.com/s/files/1/0998/0122/files/ico_slide_2.jpg);" alt="Second slide" ></div>
									<div class="carousel-item" draggable="false" style="background-image: url(http://via.placeholder.com/1200x480);" alt="Third slide" ></div>
									<div class="carousel-item" draggable="false" style="background-image: url(http://via.placeholder.com/1600x600);" alt="Fourth slide" ></div>
								</div>
								<a class="carousel-control-prev" href="#etiendahanCarouselIndicators" role="button" data-slide="prev">
									<i class="fa fa-angle-left" aria-hidden="true"></i>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#etiendahanCarouselIndicators" role="button" data-slide="next">
									<i class="fa fa-angle-right" aria-hidden="true"></i>
									<span class="sr-only">Next</span>
								</a>
							</div>
							
							<div id="shop-now"></div>
							<!-- <div id="shop-now-link"></div> -->
							<!-- search bar -->
							<div class="container my-search">
								<div class="row">
									<div class="col-md-12">
										<div class="search-box">
											<form class="search-form" action="/etiendahan/c8NLPYLt-functions/search-function/" method="POST">
												<input class="form-control form-control-lg hintable ui-autocomplete-input" id="customerAutocomplte" hint-class="show-recent" placeholder="Search products" type="text" name="search" autocomplete="off">
												<button class="btn btn-link search-btn" name="search_button">
													<i class="fa fa-search"></i>
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
				<div id="etiendahan-section-3" class="etiendahan-section">
					<div class="container">
						<div class="title-name">
							<a href="">See all<i class="fa fa-chevron-right fa-fw"></i></a>
							<h3><span class="wow pulse" data-wow-delay="1000ms">POPULAR PRODUCTS</span></h3>
						</div>

						<div class="owl-carousel">
							<div class="item">
								<a href="/etiendahan/view/">
									<div class="card">
										<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
										<div class="card-body">
											<div class="product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, consectetur.</div>
											<div class="product-price">₱150.00</div>
											<div class="product-rating">
												<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="item">
								<a href="https://www.google.com">
									<div class="card">
										<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
										<div class="card-body">
											<div class="product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, ut!</div>
											<div class="product-price">₱150.00</div>
											<div class="product-rating">
												<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="item">
								<a href="https://www.google.com">
									<div class="card">
										<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
										<div class="card-body">
											<div class="product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, odio.</div>
											<div class="product-price">₱150.00</div>
											<div class="product-rating">
												<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="item">
								<a href="https://www.google.com">
									<div class="card">
										<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
										<div class="card-body">
											<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
											<div class="product-price">₱150.00</div>
											<div class="product-rating">
												<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="item">
								<a href="https://www.google.com">
									<div class="card">
										<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
										<div class="card-body">
											<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
											<div class="product-price">₱150.00</div>
											<div class="product-rating">
												<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="item">
								<a href="https://www.google.com">
									<div class="card">
										<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
										<div class="card-body">
											<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
											<div class="product-price">₱150.00</div>
											<div class="product-rating">
												<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="item">
								<a href="https://www.google.com">
									<div class="card">
										<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
										<div class="card-body">
											<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
											<div class="product-price">₱150.00</div>
											<div class="product-rating">
												<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="item">
								<a href="https://www.google.com">
									<div class="card">
										<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
										<div class="card-body">
											<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
											<div class="product-price">₱150.00</div>
											<div class="product-rating">
												<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="item">
								<a href="https://www.google.com">
									<div class="card">
										<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
										<div class="card-body">
											<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
											<div class="product-price">₱150.00</div>
											<div class="product-rating">
												<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="item">
								<a href="https://www.google.com">
									<div class="card">
										<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
										<div class="card-body">
											<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
											<div class="product-price">₱150.00</div>
											<div class="product-rating">
												<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF SECTION 3 -->

				<!-- SECTION 4 - Homepage welcome message -->
				<div id="etiendahan-section-4" class="etiendahan-section">
					<div class="container-fluid">
						<div class="welcome-message-overlay">
							<div class="welcome-message-image" style="background-image: url(https://goodybagbsd.weebly.com/uploads/1/0/7/4/107489607/613870564.jpg);"></div>
							<div class="welcome-message-title">Welcome to Etiendahan</div>
							<div class="welcome-message-intro">Online Shopping Marketplace here in Dagupan</div>
							<div class="welcome-message-hashtag">#<a href="https://web.facebook.com/etiendahan/">SHOPATETIENDAHAN</a></div>
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
				<!-- END OF SECTION 5 -->
				
				<?php if($logged_in == true): ?>
					<!-- SECTION 6 - Homepage recommendations -->
					<div id="etiendahan-section-6" class="etiendahan-section">
						<!-- have recently view -->
						<div class="container">
							<div class="title-name">
								<a href="">See all<i class="fa fa-chevron-right fa-fw"></i></a>
								<h3><span class="wow pulse" data-wow-delay="1000ms">RECOMMENDATIONS FOR YOU, <?php echo $user['first_name']; ?></span></h3>
							</div>

							<div class="owl-carousel">
								<div class="item">
									<a href="https://www.google.com">
										<div class="card">
											<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
											<div class="card-body">
												<div class="product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, consectetur.</div>
												<div class="product-price">₱150.00</div>
												<div class="product-rating">
													<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="item">
									<a href="https://www.google.com">
										<div class="card">
											<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
											<div class="card-body">
												<div class="product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, ut!</div>
												<div class="product-price">₱150.00</div>
												<div class="product-rating">
													<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="item">
									<a href="https://www.google.com">
										<div class="card">
											<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
											<div class="card-body">
												<div class="product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, odio.</div>
												<div class="product-price">₱150.00</div>
												<div class="product-rating">
													<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="item">
									<a href="https://www.google.com">
										<div class="card">
											<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
											<div class="card-body">
												<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
												<div class="product-price">₱150.00</div>
												<div class="product-rating">
													<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="item">
									<a href="https://www.google.com">
										<div class="card">
											<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
											<div class="card-body">
												<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
												<div class="product-price">₱150.00</div>
												<div class="product-rating">
													<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="item">
									<a href="https://www.google.com">
										<div class="card">
											<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
											<div class="card-body">
												<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
												<div class="product-price">₱150.00</div>
												<div class="product-rating">
													<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="item">
									<a href="https://www.google.com">
										<div class="card">
											<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
											<div class="card-body">
												<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
												<div class="product-price">₱150.00</div>
												<div class="product-rating">
													<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="item">
									<a href="https://www.google.com">
										<div class="card">
											<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
											<div class="card-body">
												<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
												<div class="product-price">₱150.00</div>
												<div class="product-rating">
													<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="item">
									<a href="https://www.google.com">
										<div class="card">
											<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
											<div class="card-body">
												<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
												<div class="product-price">₱150.00</div>
												<div class="product-rating">
													<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="item">
									<a href="https://www.google.com">
										<div class="card">
											<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
											<div class="card-body">
												<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
												<div class="product-price">₱150.00</div>
												<div class="product-rating">
													<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>

						<!-- have not recently view -->
						<!-- <div class="container-fluid">
							<div class="recently-view">
								<div class="first-para">You don't have any recently viewed items.</div>
								<div class="second-para">View items on Etiendahan and we'll track them here..</div>
							</div>
						</div> -->
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
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi, pariatur.</p>
										<p>Nisi porttitor inceptos consectetur donec orci, dui ipsum leo class gravida.</p>
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
								<!-- <div id="fboverlay" class="fb-like" data-href="https://web.facebook.com/etiendahan/" data-layout="standard" data-width="300" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div> -->
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