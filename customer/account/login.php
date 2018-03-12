<?php  
	require '/../../db.php';
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

	require_once "/../../google-login/config.php";
	require_once "/../../facebook-login/config.php";
	$loginUrlGoogle = $gClient->createAuthUrl();
	$redirectURL = "http://localhost:8080/etiendahan/facebook-login/f-callback.php";
	$permissions = ['email'];
	$loginUrlFacebook = $helper->getLoginUrl($redirectURL, $permissions);
	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

  	// Check if user is logged in using the session variable
  	if ($logged_in == 1) {
    	$_SESSION['cant-proceed-message'] = "You already logged in.";
        header("location: /etiendahan/");
  	}

  	unset($_SESSION['google_access_token']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login | Etiendahan</title>
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
										<div class="form-group row read-and-understood" style="">
											<label for="forgotPassword" class="col-sm-2 col-form-label"></label>
											<div class="col-sm-10">
												<a href="/etiendahan/customer/password/forgot/" style="height: 15px; display: block"></a>
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
										<form action="">
											<button class="btn btn-primary facebook" type="button" onclick="window.location = '<?php echo $loginUrlFacebook; ?>'">
											<i class="fa fa-facebook"></i>
											<span>Facebook</span></button>

											<button class="btn btn-primary google" type="button" onclick="window.location = '<?php echo $loginUrlGoogle; ?>'">
												<i class="fa fa-google-plus"></i><span>Google</span>
											</button>
										</form>
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

							if ( isset($_SESSION['cant-proceed-message-banned']) ) {
								echo $_SESSION['cant-proceed-message-banned'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['cant-proceed-message-banned'] );
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