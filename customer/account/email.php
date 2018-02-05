<?php  
	require '/../../db.php';
	session_start();
  	
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

	// Check if user is logged in using the session variable
	if ($logged_in == false) {
		$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your profile page.";
		header("location: /etiendahan/customer/account/login/");    
	}
	else {
	    // Makes it easier to read
	    $email = $_SESSION['email'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Account | Etiendahan Dagupan</title>
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
	<div id="change-email-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">

				<!-- header inner -->
				<?php  
					include '../../header.php';
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

										<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
											<div class="card-body personal-info">
												<ul>
													<li class="active"><a href="/etiendahan/customer/account/profile/">Profile</a></li>
													<li><a href="/etiendahan/customer/account/password/">Change Password</a></li>												</ul>
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
								<div class="tab-content"><h1>Change Email</h1></div>
								
								<form action="/etiendahan/c8NLPYLt-functions/email-function/" method="POST">
									<!-- email -->
									<div class="form-group row">
										<label for="inputEmail" class="col-sm-2 col-form-label">Current Email</label>
										<div class="col-sm-10">
											<div class="email"><?php echo $email;  ?></div>
										</div>
									</div>	

									<div class="form-group row">
										<label for="inputEmail" class="col-sm-2 col-form-label">New Email</label>
										<div class="col-sm-10">
											<input name="newEmail" type="email" class="form-control" id="inputEmail" required autocomplete="off" value="<?= isset($_POST['newEmail']) ? $_POST['newEmail'] : ''; ?>" autofocus>
										</div>
									</div>					
									
									<!-- submit -->
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<button name="button_confirm" class="btn btn-primary" type="submit">Confirm</button>
										</div>
									</div>	

									<!-- forgot password -->
									<div class="row cancel-forgot-password">
										<div class="col-sm-12 text-center">
											<a href="/etiendahan/customer/account/profile/">Cancel</a>
										</div>
									</div>								
								</form>								
							</div>
						</div>
					</div>
				</div>
				<!-- END OF CUSTOMER PAGE SECTION 1 -->

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification-logout-redirect" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close-logout-redirect" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-danger"></i>Can't proceed!</div>
					<div class="popup-content-logout-redirect text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['user-exists-message']) ) {
								echo $_SESSION['user-exists-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['user-exists-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-info-circle mr-1 alert-primary"></i>Completed!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['modified-message']) ) {
								echo $_SESSION['modified-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['modified-message'] );
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