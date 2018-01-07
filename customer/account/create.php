<?php  
	require '/../../db.php';
	session_start();

	$gender 	= ((isset($_POST['gender']) && $_POST['gender'] != '')?htmlentities($_POST['gender']):'');
	$birthday 	= ((isset($_POST['birthday']) && $_POST['birthday'] != '')?htmlentities($_POST['birthday']):'');
	$birthmonth = ((isset($_POST['birthmonth']) && $_POST['birthmonth'] != '')?htmlentities($_POST['birthmonth']):'');
	$birthyear 	= ((isset($_POST['birthyear']) && $_POST['birthyear'] != '')?htmlentities($_POST['birthyear']):'');
	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Account - Etiendahan Dagupan</title>
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
	    if (isset($_POST['button_create'])) { //user registering
	    	require '/../../c8NLPYLt-functions/create-function.php';
	    }
	}
?>

<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="create-account-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">

				<!-- header inner -->
				<?php  
					include '../../header.php';
				?>

				<!-- CREATE PAGE SECTION 1 -->
				<div id="etiendahan-create-page-section-1">
					<div class="container">
						<div class="page-title text-center"><h1>Create Account</h1></div>
						<div class="row-wrapper">
							<div class="row">
								<div class="col-md-8">
									<form action="/etiendahan/customer/account/create/" method="POST">
										<!-- gender -->
										<div class="form-group row">
											<label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
											<div class="col-sm-10">
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input class="form-check-input" type="radio" name="gender" id="inlineRadioMale" value="Male" <?php if ($gender=="Male") {echo "checked";} ?> required> Male
													</label>
												</div>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input class="form-check-input" type="radio" name="gender" id="inlineRadioFemale" value="Female" <?php if ($gender=="Female") {echo "checked";} ?>  required> Female
													</label>
												</div>
											</div>
										</div>
		
										<!-- email -->
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
											<div class="col-sm-10">
												<input type="email" name="email" class="form-control" id="inputEmail" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
											</div>
										</div>
										
										<!-- fullname -->
										<div class="form-group row">
											<label for="inputFullname" class="col-sm-2 col-form-label">Fullname</label>
											<div class="col-sm-10">
												<input type="text" name="fullname" class="form-control" id="inputFullname" value="<?= isset($_POST['fullname']) ? $_POST['fullname'] : ''; ?>" required>
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

										<!-- password -->
										<div class="form-group row">
											<label for="inputPasswordSignup" class="col-sm-2 col-form-label">Password</label>
											<div id="show-hide-password" class="col-sm-10 input-group">
												<input type="password" name="password" class="form-control" id="inputPasswordSignup" min="10" max="20" required>
												<div class="input-group-addon">
													<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>

										<!-- retype password -->
										<div class="form-group row">
											<label for="inputConfirmPasswordSignup" class="col-sm-2 col-form-label">Retype Password</label>
											<div id="show-hide-confirm-password" class="col-sm-10 input-group">
												<input type="password" name="retypePassword" class="form-control" id="inputConfirmPasswordSignup" required>
												<div class="input-group-addon">
													<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>

										<!-- read and understood -->
										<div class="form-group row read-and-understood">
											<label for="readAndUnderstood" class="col-sm-2 col-form-label"></label>
											<div class="col-sm-10">
												<p>*I read and understood Etiendahan <a href="/etiendahan/privacy-policy/">Privacy Policy</a></p>
											</div>
										</div>
										
										<!-- create -->
										<div class="form-group row">
											<div class="col-sm-12 text-center">
												<button name="button_create" class="btn btn-primary" type="submit">Create</button>
											</div>
										</div>
									</form>

									<div class="or">OR</div>
								</div>

								<div class="col-md-4 text-center">
									<div class="social-medias">
										<button class="btn btn-primary facebook" type="submit">
										<i class="fa fa-facebook"></i>
										<span>Sign up with Facebook</span></button>

										<button class="btn btn-primary google" type="submit">
										<i class="fa fa-google-plus"></i>
										<span>Sign up with Google</span></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF CREATE PAGE SECTION 1 -->

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-danger"></i>Can't proceed!</div>
					<div class="popup-content text-center">
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

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>