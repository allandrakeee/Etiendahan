<?php  
    require '../../../db.php';
	session_start();
	$id = $_SESSION['banned_customer_id'];

	$result = $mysqli->query("SELECT * FROM tbl_customers WHERE id = '$id'");
	$user = $result->fetch_assoc();

	if($user['seller_centre'] == 0) {
	    $sql = "UPDATE tbl_customers SET banned = '0' WHERE id = '$id'";
		$mysqli->query($sql);

		header('location: /etiendahan/ed-admin/restricted/banned-customers/');
	} else {
		$sql = "UPDATE tbl_customers SET banned = '0' WHERE id = '$id'";
		$mysqli->query($sql);

		$sql1 = "UPDATE tbl_sellers SET banned = '0' WHERE seller_id = '$id'";
		$mysqli->query($sql1);

		header('location: /etiendahan/ed-admin/restricted/banned-customers/');
	}
?>