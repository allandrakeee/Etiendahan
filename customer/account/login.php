<?php  
	require '/../../db.php';
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

  	// Check if user is logged in using the session variable
  	if ($logged_in == 1) {
    	// header("location: /etiendahan/");    
    	$email = $mysqli->escape_string($_SESSION['email']);
		$result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'");
		$user = $result->fetch_assoc();

		if ($user['seller_centre'] == 0) {
			$_SESSION['cant-proceed-message'] = "You must activate first your seller centre account";
            header("location: /etiendahan/seller-centre/account/activate/");
        } else {
			$_SESSION['cant-proceed-message'] = "You already logged in";
            header("location: /etiendahan/");
        }  
  	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login - Etiendahan Dagupan</title>
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

<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    if (isset($_POST['button_login'])) { //user registering
	    	require '/../../c8NLPYLt-functions/login-function.php';
	    }
	}
?>

<body>
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="login-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include '../../header.php';
				?>

				<!-- LOGIN PAGE SECTION 1 -->
				<div id="etiendahan-login-page-section-1">
					<div class="container">
						<div class="page-title text-center"><h1>Registered Customers</h1></div>
						<div class="row-wrapper">
							<div class="row">
								<div class="col-md-8">
									<form action="/etiendahan/customer/account/login/" method="POST">		
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
												<a href="/etiendahan/customer/password/forgot/">Forgot your password?</a>
											</div>
										</div>
										
										<!-- login -->
										<div class="form-group row">
											<div class="col-sm-12 text-center">
												<button name="button_login"  class="btn btn-primary" type="submit">Login</button>
											</div>
										</div>										
									</form>

									<div class="or">OR</div>
								</div>

								<div class="col-md-4 text-center">
									<div class="social-medias">
										<button class="btn btn-primary facebook" type="submit">
										<i class="fa fa-facebook"></i>
										<span>Facebook</span></button>

										<button class="btn btn-primary google" type="submit">
										<i class="fa fa-google-plus"></i>
										<span>Google</span></button>
									</div>
								</div>
							</div>
						</div>
						<div class="new-here-content text-center">
							<h1>New Here?</h1>
							<p>Registration is free and easy!</p>
							<a href="/etiendahan/customer/account/create/"><button class="btn btn-primary" type="submit">Create an account</button></a>
						</div>
					</div>
				</div>
				<!-- END OF LOGIN PAGE SECTION 1 -->

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
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>