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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Change Password | Etiendahan</title>
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
	<div id="password-page" class="main-container">
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

										<div class="collapse show">
											<div class="card-body personal-info">
												<ul>
													<li><a href="/etiendahan/customer/account/profile/">Profile</a></li>
													<li class="active"><a href="">Change Password</a></li>												
												</ul>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingTwo">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/orders/">
													<?php  
														$email =  $_SESSION['email'];
													  	$result = $mysqli->query("SELECT COUNT(DISTINCT unique_hash_id) as 'total' FROM tbl_orders WHERE email = '$email' ORDER BY unique_hash_id");
												 		if($result->num_rows == 0):
													?>
													Orders
													<?php else: ?>
														<?php $row = $result->fetch_assoc(); ?>
													Orders <?php $total_row = $row['total']; echo ($row['total'] == 0)? '' : "($total_row)" ?>
													<?php endif; ?>
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingThree">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/wishlists/">
												<?php  
													$email =  $_SESSION['email'];
												  	$result = $mysqli->query("SELECT COUNT(*) as 'total' FROM tbl_wishlists WHERE email = '$email'");
											 		if($result->num_rows == 0):
												?>
												Wishlists
												<?php else: ?>
													<?php $row = $result->fetch_assoc(); ?>
												Wishlists <?php $total_row = $row['total']; echo ($row['total'] == 0)? '' : "($total_row)" ?>
												<?php endif; ?>
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
								<div class="tab-content"><h1>Change Password</h1><p>For your account's security, do not share your password with anyone else</p></div>
							
								<form action="/etiendahan/c8NLPYLt-functions/password-function/" method="POST">
									<?php  
										$email  = $mysqli->escape_string($_SESSION['email']);
										$result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'") or die($mysqli->error);
										$user   = $result->fetch_assoc();
										if($user['password'] == ''):
									?>
		
									<?php else: ?>
										<!-- current password -->
										<div class="form-group row">
											<label for="inputPasswordCurrent" class="col-sm-2 col-form-label">Current Password</label>
											<div id="show-hide-current-password" class="col-sm-10 input-group">
												<input name="currentPassword" type="password" class="form-control" id="inputPasswordCurrent" value="<?= isset($_POST['currentPassword']) ? $_POST['currentPassword'] : ''; ?>" min="10" max="20" required autofocus>
												<div class="input-group-addon">
													<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>		
									<?php endif; ?>						

									<!-- new password -->
									<div class="form-group row">
										<label for="inputPasswordNew" class="col-sm-2 col-form-label">New Password</label>
										<div id="show-hide-password" class="col-sm-10 input-group">
											<input name="newPassword" type="password" class="form-control" id="inputPasswordNew" min="10" max="20" required>
											<div class="input-group-addon">
												<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
											</div>
										</div>
									</div>

									<!-- retype password -->
									<div class="form-group row">
										<label for="inputConfirmPassword" class="col-sm-2 col-form-label">Retype Password</label>
										<div id="show-hide-confirm-password" class="col-sm-10 input-group">
											<input name="retypePassword" type="password" class="form-control" id="inputPasswordNewConfirm" required>
											<div class="input-group-addon">
												<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
											</div>
										</div>
									</div>
									
									<!-- create -->
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<button name="button_confirm" class="btn btn-primary" type="submit">Confirm</button>
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
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-danger"></i>Can't proceed!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['check-password-message']) ) {
								echo $_SESSION['check-password-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['check-password-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification-logout-redirect" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close-logout-redirect" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-primary"></i>Completed!</div>
					<div class="popup-content-logout-redirect text-center">
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