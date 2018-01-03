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
							<!-- CART -->
							<div class="nav-item right-nav dropdown" id="cart">
								<a class="nav-link" href="http://localhost:8080/etiendahan/" id="cart" role="button" aria-haspopup="true" aria-expanded="false">
									Etiendahan Homepage
								</a>
							</div>

							<div class="nav-item right-nav dropdown" id="user-account">
								<div class="social">
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

						<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</nav>
				</div>
				<!-- END OF SECTION 1 -->	

				<div class="container">
					<div class="row">
						<div class="col-md-7">
							<div class="info">
								<div class="title">Be a Power Seller</div>
								<div class="sub-title">Manage your shop efficiently on Shopee with our Shopee Seller Center</div>
								<div class="image-wrapper"><div class="image" style="background-image: url(/etiendahan/temp-img/fa-shop.png);"></div></div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="login-wrapper">
								<div class="title text-center mb-3">Etiendahan Seller Centre</div>
								<form>		
									<!-- email -->
									<div class="form-group row">
										<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
										<div class="col-sm-10">
											<input type="email" class="form-control" id="inputEmail" required autofocus>
										</div>
									</div>

									<!-- password -->
									<div class="form-group row">
										<label for="inputPasswordLogin" class="col-sm-2 col-form-label">Password</label>
										<div id="show-hide-password" class="col-sm-10 input-group">
											<input type="password" class="form-control" id="inputPasswordLogin" min="" required>
											<div class="input-group-addon">
												<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
											</div>
										</div>
									</div>

									<!-- forgot password -->
									<div class="form-group row read-and-understood">
										<label for="forgotPassword" class="col-sm-2 col-form-label"></label>
										<div class="col-sm-10">
											<a href="/etiendahan/customer/password/forgot/">Forgot your password?</a>
										</div>
									</div>
									
									<!-- login -->
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<button class="btn btn-primary" type="submit">Login</button>
										</div>
									</div>										
								</form>
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