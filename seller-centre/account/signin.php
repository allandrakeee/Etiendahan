<?php  
	require '/../../db.php';
	session_start();

	$logged_in = ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

  	// Check if user is logged in using the session variable
  	if ($logged_in == 1) {
    	// header("location: /etiendahan/seller-centre/");    
    	$email = $mysqli->escape_string($_SESSION['email']);
		$result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'");
		$user = $result->fetch_assoc();

		if ($user['seller_centre'] == 0) {
			$_SESSION['cant-proceed-message'] = "You must activate first your seller center account";
            header("location: /etiendahan/seller-centre/account/activate/");
        } else {
            header("location: /etiendahan/seller-centre/");
        }  

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
		include '../../header-link.php';
	?>

</head>

<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    if (isset($_POST['button_login'])) { //user registering
	    	require '/../../c8NLPYLt-functions/signin-function.php';
	    }
	}
?>

<body>
	
	<!-- Preloader -->
	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>

	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="seller-centre-page" class="main-container">
		<div class="main-wrapper" id="seller-centre-page-signin">
			<div class="main">
				
				<!-- SECTION 1 -->
				<div id="etiendahan-section-1" class="etiendahan-section">
					<!-- navbar -->
					<nav class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index shrink">
					  	<a class="navbar-brand" href="http://localhost:8080/etiendahan/seller-centre/account/signin/">
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
								<div class="sub-title">Manage your shop efficiently on Etiendahan with our Etiendahan Seller Center</div>
								<div class="image-wrapper"><div class="image" style="background-image: url(/etiendahan/temp-img/fa-shop.png);"></div></div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="login-wrapper">
								<div class="title text-center mb-3">Etiendahan Seller Centre</div>
								<form action="/etiendahan/seller-centre/account/signin/" method="POST">
									<!-- email -->
									<div class="form-group row">
										<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
										<div class="col-sm-10">
											<input name="email" type="email" class="form-control" id="inputEmail" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" required autofocus>
										</div>
									</div>

									<!-- password -->
									<div class="form-group row">
										<label for="inputPasswordLogin" class="col-sm-2 col-form-label">Password</label>
										<div id="show-hide-password" class="col-sm-10 input-group">
											<input name="password" type="password" class="form-control" id="inputPasswordLogin" min="" required>
											<div class="input-group-addon">
												<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
											</div>
										</div>
									</div>

									<!-- forgot password -->
									<div class="form-group row read-and-understood">
										<label for="forgotPassword" class="col-sm-2 col-form-label"></label>
										<div class="col-sm-10">
											<a href="/etiendahan/customer/password/forgot/" style="height: 15px; display: block"></a>
										</div>
									</div>

									<div class="tooltip-wrapper" data-toggle="tooltip" data-placement="right" title="Not yet registered? Go to our create account page and go back to Sell on Etiendahan page to activate your account."><a href="/etiendahan/customer/account/create/"><i class="fa fa-info-circle"></i></a></div>
									
									<!-- login -->
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<button name="button_login" class="btn btn-primary" type="submit">Login</button>
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
								<div class="site-version">Current Version: 1.0.0</div>
							</div>
						</div>
					</div>
				</div>	

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-danger"></i>Can't proceed!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['profile-cant-proceed-message']) ) {
								echo $_SESSION['profile-cant-proceed-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['profile-cant-proceed-message'] );
							}

							if ( isset($_SESSION['email-doesnt-exist-message']) ) {
								echo $_SESSION['email-doesnt-exist-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['email-doesnt-exist-message'] );
							}

							if ( isset($_SESSION['wrong-password-message']) ) {
								echo $_SESSION['wrong-password-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['wrong-password-message'] );
							}

							if ( isset($_SESSION['cant-proceed-message-banned']) ) {
								echo $_SESSION['cant-proceed-message-banned'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['cant-proceed-message-banned'] );
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