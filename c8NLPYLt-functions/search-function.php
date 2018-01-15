<?php 
	// require '/db.php';
	session_start();

	if($_POST['search'] != '') {
		$_SESSION['search'] = $_POST['search'];
		echo $_SESSION['search'];
		header('location: /etiendahan/search/');
	} else {
		header('location: /etiendahan/');		
	}
?>