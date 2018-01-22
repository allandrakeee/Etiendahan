<?php  
	require '../../db.php';
	session_start();
	$address_id = $_SESSION['address_delete'];
	$email = $_SESSION['email'];

	if($address_id == '') {
		header('location: /etiendahan/customer/address/');
	}

 	$result = $mysqli->query("SELECT * FROM tbl_address WHERE default_address = 1 AND email='$email'");
	$row = $result->fetch_assoc();
	$current_default_id = $row['id'];

	$sql1 = "UPDATE tbl_address SET default_address = 0 WHERE id = '$current_default_id'";
	$mysqli->query($sql1);

	$sql2 = "UPDATE tbl_address SET default_address = 1 WHERE id = '$address_id'";
	$mysqli->query($sql2);

	$_SESSION['success-message'] = 'Default address changed.';
	header('location: /etiendahan/customer/address/');
?>