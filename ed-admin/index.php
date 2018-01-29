<?php  
	require '/../db.php';
	session_start();

	$logged_in_admin  = ((isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] != '')?htmlentities($_SESSION['logged_in_admin']):'');
    if($logged_in_admin == true) {
        $_SESSION['cant-proceed-message-logged-in'] = 'You already logged in.';
        header('location: /etiendahan/ed-admin/restricted/');
    }
?>

<!DOCTYPE html>
<html class="admin-page">
<head>
	<title>Administrator Page | Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">

	<!-- Normal import of theme.css -->
	<link rel="stylesheet" href="../assets/css/theme.css">

</head>

<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    if (isset($_POST['l'])) { //user registering
	    	require '/../c8NLPYLt-functions/ed-admin-login-function.php';
	    }
	}
?>

<body>
	<div id="gradient"></div>
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="admin-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				<div id="admin-page">
					<div class="login">
						<div class="text-center mb-4"><img src="/etiendahan/temp-img/etiendahan-logo-shrink.png" alt=""></div>
					    <form action="/etiendahan/ed-admin/" method="POST">
					    	<input type="text" name="u" placeholder="Username" required="required" autofocus autocomplete="off" value="allandrakeee">
					        <input type="password" name="p" placeholder="Password" required="required" value="asd">
					        <button type="submit" class="btn btn-primary btn-block btn-large" name="l">Let me in.</button>
					    </form>
					    <div class="mt-2"><a href="/etiendahan/" style="text-decoration: none; font-size: 11px;color:white;"><i class="fa fa-long-arrow-left"></i> Back to Etiendahan Dagupan</a></div>
					</div>
				</div>

				<!-- POPUP NOTIFICATION -->
			    <div id="popup-notification-welcome" class="wow fadeIn">
			        <div id="etiendahan-notification">Etiendahan Notification</div>
			        <div id="popup-close-welcome" class="popup-close"><i class="fa fa-times"></i></div>
			        <div class="popup-title text-center" style="margin-top: 5px;"><i class="fa fa-info-circle" style="margin-right: 2px; color: #004085; border-color: #b8daff; font-size: 18px;"></i>Completed!</div>
			        <div class="popup-content-welcome text-center" style="font-size: 14px;">
			            <?php  
			                // Display message only once
			                if ( isset($_SESSION['logout-message']) ) {
			                    echo $_SESSION['logout-message'];
			                    // Don't annoy the user with more messages upon page refresh
			                    unset($_SESSION['logout-message']);
			                }
			            ?>
			        </div>
			    </div>
			    <!-- END OF POPUP NOTIFICATION -->

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-danger"></i>Can't proceed!</div>
					<div class="popup-content text-center">
						<?php  
							if ( isset($_SESSION['username-doesnt-exist-message']) ) {
								echo $_SESSION['username-doesnt-exist-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['username-doesnt-exist-message'] );
							}

							if ( isset($_SESSION['wrong-password-message']) ) {
								echo $_SESSION['wrong-password-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['wrong-password-message'] );
							}

							if ( isset($_SESSION['cant-proceed-message']) ) {
								echo $_SESSION['cant-proceed-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['cant-proceed-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->
			</div>
		</div>
	</div>
	
	<!-- Normal import of theme.js -->
	<script src="../assets/js/theme.js"></script>

 	<!-- Minified import of theme.js -->
	<!-- <script src="assets/js/theme.min.js"></script> -->
</body>
</html>