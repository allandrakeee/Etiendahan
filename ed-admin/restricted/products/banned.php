<?php  
    require '../../../db.php';
	session_start();
	$id = $_SESSION['banned_customer_id'];

	$sql = "UPDATE tbl_products SET banned = '1' WHERE id = '$id'";
	$mysqli->query($sql);

	header('location: /etiendahan/ed-admin/restricted/products/');
?>