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
		include '../../header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="seller-centre-page" class="main-container">
		<div class="main-wrapper" id="product-details-page">
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
							<li class="breadcrumb-item"><a href="/etiendahan/seller-centre/product/list/all/">My Products</a></li>
							<li class="breadcrumb-item active" aria-current="page">Product Details</li>
						</ol>
					</nav>
				</div>
				<!-- END OF SECTION 1 -->	

				<div class="container products-action">
					<div class="row">
						<div class="col-md-12">
							<div class="add-a-new-product-wrapper p-4">
								<div class="title mb-1">Edit Product Images</div>
								<div class="sub-title" data-toggle="tooltip" data-placement="bottom" title="Showcase your product by taking a photo against a white background with good lighting. Upload more product images to show different angles.">Tips for better selling product images</div>
							
								<div class="form-wrapper mt-5">
									<div class="title">Basic Information</div>

									<form class="pl-5 pr-5">
										<div class="form-group row">
											<label for="inputProductName" class="col-sm-2 col-form-label">Product Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="inputProductName">
											</div>									
										</div>

										<div class="form-group row">
											<label for="inputProductDescription" class="col-sm-2 col-form-label">Product Description</label>
											<div class="col-sm-10">
												<textarea class="form-control" id="inputProductDescription" rows="10" maxlength="1500"></textarea>
											</div>	
										</div>

										<div class="form-group row">
											<label for="selectCategory" class="col-sm-2 col-form-label">Category</label>
											<div class="col-sm-10">
												<select class="form-control" id="selectCategory">
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>											
											</div>	
										</div>
									</form>
								</div>

								<div class="form-wrapper mt-5">
									<div class="title">Price and Inventory</div>

									<form class="add-product pl-5 pr-5">
										<div class="form-group row">
											<label for="inputProductPrice" class="col-sm-2 col-form-label">Price</label>
											<div class="peso-sign">₱</div>
											<div class="col-sm-2">
												<input type="text" class="form-control" id="inputProductPrice" pattern="[0-9]*">
												<!-- <input type="text" class="form-control formatter" id="inputProductPrice"> -->
											</div>									
										</div>

										<div class="form-group row">
											<label for="inputProductStock" class="col-sm-2 col-form-label">Stock</label>
											<div class="col-sm-10">
												<input type="number" class="form-control formatter" id="inputProductStock">
											</div>	
										</div>
									</form>
								</div>
							</div>
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