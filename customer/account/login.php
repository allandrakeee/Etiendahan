<!DOCTYPE html>
<html>
<head>
	<title>Login - Etiendahan Dagupan</title>
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

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>