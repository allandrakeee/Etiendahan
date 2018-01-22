<?php  
	/* Log out process, unsets and destroys session variables */
	session_start();

	$fullname 	= $_SESSION['fullname'];
	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	// Check if user is logged in using the session variable
	if ( $logged_in == false ) {
		$_SESSION['logout-message-redirect'] = "You must log in before you log out";
		header("location: /etiendahan/seller-centre/account/signin/");  
	}
	else {
		$_SESSION['logout-message'] = "$fullname";
		$_SESSION['logged_in'] = false;
		unset($_SESSION['google_access_token']);
		header("location: /etiendahan/seller-centre/account/signin/"); 
	}
?>