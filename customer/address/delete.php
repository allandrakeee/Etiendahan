<?php  
	require '../../db.php';
	session_start();
	$address_id = $_SESSION['address_delete'];
	$email = $_SESSION['email'];

	if($address_id == '') {
		header('location: /etiendahan/customer/address/');
	}

    $result1 = $mysqli->query("SELECT * FROM tbl_address WHERE email = '$email'");

    if($result1->num_rows == 1) {
    	$_SESSION['cant-proceed-message'] = 'Required to have you at least one address.';
		header('location: /etiendahan/customer/address/');
    } else {
	    $result = $mysqli->query("SELECT * FROM tbl_orders WHERE address_id = '$address_id'");
	    if($result->num_rows == 0) { 
	    	$sql = "DELETE FROM tbl_address WHERE id = '$address_id'";
			$mysqli->query($sql);

			$_SESSION['success-message'] = 'Successfully Deleted.';
			header('location: /etiendahan/customer/address/');
	    } else {
	    	$_SESSION['cant-proceed-message'] = 'This address is active to your order info.';
			header('location: /etiendahan/customer/address/');
	    }
    }
?>