<?php  
	require '/../../../db.php';
	session_start();
	echo $email = $_SESSION['email'];
	echo $unique_hash_id = $_SESSION['goto_sales'];

	$orders_unique_hash = $mysqli->query("SELECT * FROM tbl_orders WHERE unique_hash_id = '$unique_hash_id' AND status = 'processing'");
	while($orders_unique_hash_row = mysqli_fetch_assoc($orders_unique_hash)):
		$product_id = $orders_unique_hash_row['product_id'];

		$orders_product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$product_id' AND seller_email = '$email'");
		while($orders_product_row = mysqli_fetch_assoc($orders_product_result)):
			echo $orders_product_id = $orders_product_row['id'];
			$sql = "UPDATE tbl_orders SET status = 'shipped' WHERE unique_hash_id = '$unique_hash_id' AND product_id = '$orders_product_id'";
			$mysqli->query($sql);
		endwhile;
	endwhile;

	header('location: /etiendahan/seller-centre/sale/list/pending/');
?>