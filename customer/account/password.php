<!DOCTYPE html>
<html>
<head>
	<title>Change Password - Etiendahan Pangasinan</title>
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
								<div class="tab-content"><h1>Change Password</h1><p>For your account's security, do not share your password with anyone else</p></div>
							
								<form>
									<!-- current password -->
									<div class="form-group row">
										<label for="inputPasswordCurrent" class="col-sm-2 col-form-label">Current Password</label>
										<div id="show-hide-current-password" class="col-sm-10 input-group">
											<input type="password" class="form-control" id="inputPasswordCurrent" min="10" max="20" required autofocus>
											<div class="input-group-addon">
												<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
											</div>
										</div>
									</div>								

									<!-- current password -->
									<div class="form-group row">
										<label for="inputPasswordNew" class="col-sm-2 col-form-label">New Password</label>
										<div id="show-hide-password" class="col-sm-10 input-group">
											<input type="password" class="form-control" id="inputPasswordNew" min="10" max="20" required>
											<div class="input-group-addon">
												<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
											</div>
										</div>
									</div>

									<!-- retype password -->
									<div class="form-group row">
										<label for="inputConfirmPassword" class="col-sm-2 col-form-label">Retype Password</label>
										<div id="show-hide-confirm-password" class="col-sm-10 input-group">
											<input type="password" class="form-control" id="inputPasswordNewConfirm" required>
											<div class="input-group-addon">
												<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
											</div>
										</div>
									</div>
									
									<!-- create -->
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<button class="btn btn-primary" type="submit">Create</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF CUSTOMER PAGE SECTION 1 -->

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>