<?php  
	/* Log out process, unsets and destroys session variables */
	session_start();
	session_unset();
	session_destroy(); 

	 // $_SESSION['logout-message'] = "$fullname";
	header("location: /etiendahan/"); 
?>