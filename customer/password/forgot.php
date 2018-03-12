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

	// // Check if user is logged in using the session variable
	// if ( $logged_in == false ) {
	// 	$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your profile page";
	// 	header("location: /etiendahan/customer/account/login/");    
	// }
	// else {
	//     // Makes it easier to read
	//     $fullname 	= $_SESSION['fullname'];
	//     $gender     = $_SESSION['gender'];
	//     $email      = $_SESSION['email'];
	//     $active     = $_SESSION['active'];
	//     $birthday   = $_SESSION['birthday'];
	//     $birthmonth = $_SESSION['birthmonth'];
	//     $birthyear  = $_SESSION['birthyear'];
	// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot password? | Etiendahan</title>
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
	<div id="login-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include '../../header.php';
				?>				

				<!-- FORGOT PASSWORD PAGE SECTION 1 -->
				<div id="etiendahan-forgot-password-page-section-1">
					<div class="container">
						<div class="page-title text-center"><h1>Reset your password</h1></div>
						<div class="page-title-sub-title text-center">
							<p>We will send you an email to reset your password.</p>
						</div>

						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4 wrapper">
								<form>		
									<!-- email -->
									<div class="form-group row">
										<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
										<div class="col-sm-10">
											<input type="email" class="form-control" id="inputEmail" required autocomplete="off" autofocus>
										</div>
									</div>					
									
									<!-- submit -->
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<button class="btn btn-primary" type="submit">Submit</button>
										</div>
									</div>	

									<!-- forgot password -->
									<div class="row cancel-forgot-password">
										<div class="col-sm-12 text-center">
											<a href="/etiendahan/customer/account/login/">Cancel</a>
										</div>
									</div>								
								</form>
							</div>
							<div class="col-md-4"></div>
						</div>
					</div>
				</div>
				<!-- END OF FORGOT PASSWORD PAGE SECTION 1 -->

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>