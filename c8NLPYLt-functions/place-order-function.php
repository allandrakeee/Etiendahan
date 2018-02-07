<?php  
    require '/../db.php';
    session_start();

    $address_id = $_SESSION['address_id'];
    $total_amount_order = $_SESSION['total_amount_order'];
    $email = $_SESSION['email'];
    $unique_order_id = substr(md5(uniqid(rand(1,6))), 0, 8);

    // quantity product
    $cart_result1 = $mysqli->query("SELECT * FROM `tbl_cart` WHERE email = '$email' AND quantity > 0");
	while($cart_row1 = mysqli_fetch_assoc($cart_result1)):
		echo $product_id = $cart_row1['product_id'];
		echo $quantity = $cart_row1['quantity'];
		$sql = "UPDATE tbl_products SET stock = (stock - '$quantity') WHERE id = '$product_id'";
        $mysqli->query($sql);
	endwhile;

    $cart_result = $mysqli->query("SELECT * FROM `tbl_cart` WHERE email = '$email' AND quantity > 0");
	while($cart_row = mysqli_fetch_assoc($cart_result)):
		$product_id = $cart_row['product_id'];
		$quantity = $cart_row['quantity'];
		$sql = "INSERT INTO tbl_orders (id, unique_hash_id, product_id, quantity, email, address_id, created_at, total, status) VALUES (null, '$unique_order_id','$product_id', '$quantity', '$email', '$address_id', NOW(), '$total_amount_order', 'processing')";
		$mysqli->query($sql);
	endwhile;

    // delete cart
	$cart_result2 = $mysqli->query("SELECT * FROM `tbl_cart` WHERE email = '$email' AND quantity > 0");
	while($cart_row2 = mysqli_fetch_assoc($cart_result2)):
		echo $product_id = $cart_row2['product_id'];
        $sql = "DELETE FROM tbl_cart WHERE product_id = '$product_id'";
    	$mysqli->query($sql);
	endwhile;

	// /etiendahan/customer/orders/
	header('location: /etiendahan/customer/orders/');

?>