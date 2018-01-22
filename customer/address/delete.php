<?php  
	require '../../db.php';
	session_start();
	$address_id = $_SESSION['address_delete'];

	if($address_id == '') {
		header('location: /etiendahan/customer/address/');
	}
	
	$sql = "DELETE FROM tbl_address WHERE id = '$address_id'";
	$mysqli->query($sql);

	$_SESSION['success-message'] = 'Successfully Deleted.';
	header('location: /etiendahan/customer/address/');
?>