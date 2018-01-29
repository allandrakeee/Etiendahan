<?php  
	session_start();
	$_SESSION['logged_in_admin'] = false;
	$_SESSION['logout-message'] = 'You\'ve been logout. See you soon!';

	header('location: /etiendahan/ed-admin/');
?>