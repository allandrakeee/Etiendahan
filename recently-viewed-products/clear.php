<?php  
	require '../db.php';
	session_start();
	$email = $_SESSION['email'];
	$sql = "DELETE FROM tbl_recently_viewed_products WHERE email = '$email'";
	$mysqli->query($sql);

	header('location: /etiendahan/recently-viewed-products/');
?>