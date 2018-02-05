<?php  
    require '../../../db.php';
	session_start();
	$id = $_SESSION['banned_customer_id'];

	$sql1 = $mysqli->query("SELECT * FROM tbl_sellers WHERE seller_id = '$id'");
	$row = $sql1->fetch_assoc();

	echo $seller_email = $row['seller_email']; 

	$sql2 = "UPDATE tbl_products SET banned = '1' WHERE seller_email = '$seller_email'";
	$mysqli->query($sql2);

	$sql = "UPDATE tbl_sellers SET banned = '1' WHERE seller_id = '$id'";
	$mysqli->query($sql);

	header('location: /etiendahan/ed-admin/restricted/sellers/');
?>