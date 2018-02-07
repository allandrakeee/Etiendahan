<?php  
	require '/../../../db.php';
	session_start();
	echo $order_id = $_SESSION['goto_sales'];

    $sql = "UPDATE tbl_orders SET status = 'processing' WHERE id = '$order_id'";
	$mysqli->query($sql);
	header('location: /etiendahan/seller-centre/sale/list/shipped/');
?>