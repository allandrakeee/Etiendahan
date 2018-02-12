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
	if ( $logged_in == false ) {
		$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your profile page.";
		header("location: /etiendahan/customer/account/login/");    
	}
	else {
	    // Makes it easier to read
	    $fullname 	= ((isset($_SESSION['fullname']) && $_SESSION['fullname'] != '')?htmlentities($_SESSION['fullname']):'');
	    $gender     = ((isset($_SESSION['gender']) && $_SESSION['gender'] != '')?htmlentities($_SESSION['gender']):'');
	    $email      = $_SESSION['email'];
	    $active     = $_SESSION['active'];
	    $birthday   = ((isset($_SESSION['birthday']) && $_SESSION['birthday'] != '')?htmlentities($_SESSION['birthday']):'');
	    $birthmonth = ((isset($_SESSION['birthmonth']) && $_SESSION['birthmonth'] != '')?htmlentities($_SESSION['birthmonth']):'');
	    $birthyear  = ((isset($_SESSION['birthyear']) && $_SESSION['birthyear'] != '')?htmlentities($_SESSION['birthyear']):'');
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
											} else if($gender == 'Female') {
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
											} else {
										?>	
											<div class="form-check form-check-inline">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="gender" id="male" value="Male" required> Male
												</label>
											</div>
											<div class="form-check form-check-inline">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="gender" id="female" value="Female" required> Female
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
														for ($x=date("Y")-13; $x>=1900; $x--) {
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
					<div class="popup-title text-center mt-1"><i class="fa fa-info-circle mr-1 alert-primary"></i>Completed!</div>
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