<?php  
	require '/db.php';
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Us | Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">
	
	<!-- link inner -->
	<?php  
		include 'header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="contact-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include 'header.php';
				?>				

				<!-- CONTACT PAGE -->
				<div id="etiendahan-information-page">
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<div class="container">
								<li class="breadcrumb-item"><a href="/etiendahan/" title="Back to the frontpage"><i class="fa fa-home"></i>Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Contact Us</li>
							</div>
						</ol>
					</nav>

					<div class="container contact">
						<div class="row">
							<div class="col-md-12">
								<div class="title">
									We’d like to help you out! Send us a shout out at the following:
								</div>

								<div class="question">
									Unable to complete your shopping or need technical help?
								</div>
								<div class="link">
									<i class="fa fa-envelope-o"></i> Email: <a href="mailto:etiendahan@gmail.com" target="_blank">etiendahan@gmail.com</a>
								</div>

								<div class="question">
									Follow up on your orders? <span>(Best if you can put your order # in the Subject Line to make it easier for us to track your order)</span>
								</div>
								<div class="link">
									<i class="fa fa-envelope-o"></i> Email: <a href="mailto:etiendahan@gmail.com" target="_blank">etiendahan@gmail.com</a>
								</div>

								<div class="question">
									Feedback or Suggestion?
								</div>
								<div class="link">
									<i class="fa fa-envelope-o"></i> Email: <a href="mailto:etiendahan@gmail.com" target="_blank">etiendahan@gmail.com</a>
								</div>

								<div class="question">
									Want to become a seller?
								</div>
								<div class="link">
									<i class="fa fa-external-link"></i> Apply <a href="/etiendahan/seller-centre/account/signin/" target="_blank">here</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF CONTACT PAGE -->

<!-- footer inner -->
<?php  
	include 'footer.php';
?>
</html>