<!DOCTYPE html>
<html>
<head>
	<title>Create Account - Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">
	
	<!-- link inner -->
	<?php  
		include '../../header-link.php';
	?>

</head>
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
									<form>
										<!-- gender -->
										<div class="form-group row">
											<label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
											<div class="col-sm-10">
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioMale" value="optionMale" required> Male
													</label>
												</div>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioFemale" value="optionFemale" required> Female
													</label>
												</div>
											</div>
										</div>
		
										<!-- email -->
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
											<div class="col-sm-10">
												<input type="email" class="form-control" id="inputEmail" required>
											</div>
										</div>
										
										<!-- fullname -->
										<div class="form-group row">
											<label for="inputFullname" class="col-sm-2 col-form-label">Fullname</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="inputFullname" required>
											</div>
										</div>

										<!-- birtday -->
										<div id="three-col" class="form-group row">
											<label for="selectBirthday" class="col-md-2 col-form-label">Birthday</label>
											<div class="row">
												<div class="col-md-4">
													<select class="form-control" required>
														<option value="">Day</option>
														<?php
															for ($x=1; $x<=31; $x++) {
																echo'<option value="'.$x.'">'.$x.'</option>'; 
															} 
														?> 
													</select>
													
												</div>
												<div class="col-md-4">
													<select class="form-control" required>
														<option value="">Month</option>
														<?php 
															for($m = 1;$m <= 12; $m++){ 
															    $month =  date("F", mktime(0, 0, 0, $m)); 
															    echo "<option value='$m'>$month</option>"; 
															} 
														?>
													</select>
												</div>
												<div class="col-md-4">
													<select class="form-control" required>
														<option value="">Year</option>
														<?php
															for ($x=date("Y"); $x>=1900; $x--) {
																echo'<option value="'.$x.'">'.$x.'</option>'; 
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
												<input type="password" class="form-control" id="inputPasswordSignup" min="10" max="20" required>
												<div class="input-group-addon">
													<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>

										<!-- retype password -->
										<div class="form-group row">
											<label for="inputConfirmPasswordSignup" class="col-sm-2 col-form-label">Retype Password</label>
											<div id="show-hide-confirm-password" class="col-sm-10 input-group">
												<input type="password" class="form-control" id="inputConfirmPasswordSignup" required>
												<div class="input-group-addon">
													<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
												</div>
											</div>
										</div>

										<!-- read and understood -->
										<div class="form-group row read-and-understood">
											<label for="readAndUnderstood" class="col-sm-2 col-form-label"></label>
											<div class="col-sm-10">
												<p>*I read and understood Etiendahan <a href="#">Privacy Policy</a></p>
											</div>
										</div>
										
										<!-- create -->
										<div class="form-group row">
											<div class="col-sm-12 text-center">
												<button class="btn btn-primary" type="submit">Create</button>
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

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>