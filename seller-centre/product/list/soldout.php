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
								<a class="nav-link" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
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
					<li class="nav-item">
						<a class="nav-link" href="/etiendahan/seller-centre/product/list/live/">Live</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link active" href="/etiendahan/seller-centre/product/list/soldout/">Soldout</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/etiendahan/seller-centre/product/list/banned/">Banned</a>
					</li>
				</ul>

				<div class="container inner">
					<div class="row">
						<div class="col-md-12">
							<div class="products-number">0 Products</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-2 product">
							<a href="/etiendahan/seller-centre/product/list/all">
								<div class="product-wrapper">
									<div class="product-image overlay" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/b241675a9821fca83eb64757e69e5143_tn);"><div class="sold-wrapper"><div class="sold">Sold</div></div></div>
									<div class="product-name text-left pl-3 mt-2">JBL</div>
									<div class="product-price pull-left pl-3 mt-1">₱1,000.00</div>
									<div class="product-stock mt-1">Stock 0</div>
									<div class="statistics mt-4 mb-1">statistics</div>
									<div class="sightings pr-3"><i class="fa fa-eye pr-1"></i>0</div>
									<div class="wishlists pr-3"><i class="fa fa-heart-o pr-1"></i>0</div>
									<div class="sales">Sales 0</div>
								</div>
							</a>
						</div>

						<div class="col-md-2 product">
							<a href="/etiendahan/seller-centre/product/list/all">
								<div class="product-wrapper">
									<div class="product-image overlay" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/b241675a9821fca83eb64757e69e5143_tn);"><div class="sold-wrapper"><div class="sold">Sold</div></div></div>
									<div class="product-name text-left pl-3 mt-2">JBL</div>
									<div class="product-price pull-left pl-3 mt-1">₱1,000.00</div>
									<div class="product-stock mt-1">Stock 0</div>
									<div class="statistics mt-4 mb-1">statistics</div>
									<div class="sightings pr-3"><i class="fa fa-eye pr-1"></i>0</div>
									<div class="wishlists pr-3"><i class="fa fa-heart-o pr-1"></i>0</div>
									<div class="sales">Sales 0</div>
								</div>
							</a>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="footer">
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