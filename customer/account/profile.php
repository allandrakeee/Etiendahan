<?php  
	require '/../../db.php';
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	// Check if user is logged in using the session variable
	if ( $logged_in == false ) {
		$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your profile page";
		header("location: /etiendahan/customer/account/login/");    
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
	<title>My Profile | Etiendahan Dagupan</title>
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
	<div id="profile-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">

				<?php  
					if ( $logged_in == true ) {
				?>
						<!-- SECTION 1 -->
						<div id="etiendahan-section-1" class="etiendahan-section">
							
							<!-- navbar -->
							<nav class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index shrink">
							  	<a class="navbar-brand" href="http://localhost:8080/etiendahan/">
									<img src="/etiendahan/temp-img/etiendahan-logo.png" width="178" height="58" class="d-inline-block align-top" alt="">
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

											<!-- MEN -->
											<li class="nav-item">
												<a class="nav-link cl-effect" href="#">Men</a>
											</li>

											<!-- WOMEN -->
											<li class="nav-item">
												<a class="nav-link cl-effect" href="#">Women</a>
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
											<a href="/etiendahan/customer/wishlists/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Wishlist</div></a>
											<a href="/etiendahan/logout/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>LOGOUT</div></a>
										</div>
									</div>
								</div>

								<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>
							</nav>
						</div>
						<!-- END OF SECTION 1 -->
				<?php  
					} else {
				?>
						<!-- SECTION 1 -->
						<div id="etiendahan-section-1" class="etiendahan-section">
							
							<!-- navbar -->
							<nav class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index shrink">
							  	<a class="navbar-brand" href="http://localhost:8080/etiendahan/">
									<img src="/etiendahan/temp-img/etiendahan-logo.png" width="178" height="58" class="d-inline-block align-top" alt="">
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

											<!-- MEN -->
											<li class="nav-item">
												<a class="nav-link cl-effect" href="#">Men</a>
											</li>

											<!-- WOMEN -->
											<li class="nav-item">
												<a class="nav-link cl-effect" href="#">Women</a>
											</li>

											<!-- ALL CATEGORIES -->
											<li class="nav-item">
												<a href='http://localhost:8080/etiendahan/#shop-now' class="nav-link cl-effect" data-id="shop-now-link">Shop Now</a>
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
						</div>
						<!-- END OF SECTION 1 -->
				<?php  
					}
				?>

				<!-- CUSTOMER PAGE SECTION 1 -->
				<div id="etiendahan-customer-page-section-1">
					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<div id="accordion" role="tablist">
									<div class="card">
										<div class="card-header active" role="tab" id="headingOne">
											<h5 class="mb-0">
												<a>
												Personal Information
												</a>
											</h5>
										</div>

										<div class="collapse show">
											<div class="card-body personal-info">
												<ul>
													<li class="active"><a href="">Profile</a></li>
													<li><a href="/etiendahan/customer/account/password/">Change Password</a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingTwo">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/orders/">
												Orders
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingThree">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/wishlists/">
												Wishlists
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingFour">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/address/">
												Address Book
												</a>
											</h5>
										</div>
									</div>
								</div>
							</div>

							<div id="prevent-not-to-scroll" class="col-md-8">
								<div class="tab-content"><h1>My Profile</h1><p>Manage and protect your account</p></div>
							
								<form action="/etiendahan/c8NLPYLt-functions/profile-function/" method="POST">
									<!-- gender -->
									<div class="form-group row">
										<label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
										<div class="col-sm-10">
										<?php  
											if($gender == 'Male') {
										?>
											<div class="form-check form-check-inline">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked required> Male
												</label>
											</div>
											<div class="form-check form-check-inline">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="gender" id="female" value="Female" required> Female
												</label>
											</div>

										<?php  
											} else {
										?>
											<div class="form-check form-check-inline">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="gender" id="male" value="Male" required> Male
												</label>
											</div>
											<div class="form-check form-check-inline">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="gender" id="female" value="Female" checked required> Female
												</label>
											</div>
										<?php  
											}
										?>											
										</div>
									</div>
	
									<!-- email -->
									<div class="form-group row">
										<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
										<div class="col-sm-10">
											<div name="email" class="email"><?= $email ?> <a href="/etiendahan/customer/account/email/">Change Email</a>
											<?php  
												if ( $active == 0 ){
												echo
													'<div class="message-info font-italic">
													Account is unverified, please confirm your email by clicking
													<a href="">here</a>!
													</div>';
												}
											?>


											</div>
										</div>
									</div>
									
									<!-- fullname -->
									<div class="form-group row">
										<label for="inputFullname" class="col-sm-2 col-form-label">Fullname</label>
										<div class="col-sm-10">
											<input name="fullname" type="text" class="form-control" id="inputFullname" value="<?= $fullname ?>" required>
										</div>
									</div>

									<!-- birtday -->
									<div id="three-col" class="form-group row">
										<label for="selectBirthday" class="col-md-2 col-form-label">Birthday</label>
										<div class="row">
											<div class="col-md-4">
												<select name="birthday" class="form-control" required>
													<option value="">Day</option>
													<?php
														for ($x=1; $x<=31; $x++) {
													?> 
															<option value="<?php echo $x; ?>" <?php if($birthday == $x) echo 'selected'; ?>><?php echo $x; ?></option>';
													<?php  
														} 
													?>
												</select>
												
											</div>
											<div class="col-md-4">
												<select name="birthmonth" class="form-control" required>
													<option value="">Month</option>
													<?php 
														for($m = 1;$m <= 12; $m++) { 
														    $month =  date("F", mktime(0, 0, 0, $m)); 
													?>
														    <option value="<?php echo $month; ?>" <?php if($birthmonth == $month) echo 'selected'; ?>><?php echo $month; ?></option>';
													<?php  
														}
													?>
												</select>
											</div>
											<div class="col-md-4">
												<select name="birthyear" class="form-control" required>
													<option value="">Year</option>
													<?php
														for ($x=date("Y"); $x>=1900; $x--) {
													?>
															<option value="<?php echo $x; ?>" <?php if($birthyear == $x) echo 'selected'; ?>><?php echo $x; ?></option>';
													<?php
														} 
													?> 
												</select>
											</div>
										</div>
									</div>
									
									<!-- save -->
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<button name="button_save" class="btn btn-primary" type="submit">Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF CUSTOMER PAGE SECTION 1 -->

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-info-circle mr-1 alert-primary"></i>Complete!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['modified-message-profile']) ) {
								echo $_SESSION['modified-message-profile'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['modified-message-profile'] );
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