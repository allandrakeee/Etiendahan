<?php  
	require '../db.php';
	session_start();

	if($logged_in == true) {
		$add_to_cart_product_id = ((isset($_SESSION['add_to_cart_product_id']) && $_SESSION['add_to_cart_product_id'] != '')?htmlentities($_SESSION['add_to_cart_product_id']):'');
		$input_quantity 	    = ((isset($_SESSION['input_quantity']) && $_SESSION['input_quantity'] != '')?htmlentities($_SESSION['input_quantity']):'');
		$email 				    = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');

		$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$add_to_cart_product_id'");
		$product_result = $product_result->fetch_assoc();
		$product_result_stock = $product_result['stock'];

		echo $product_result_stock;

		$cart_result = $mysqli->query("SELECT * FROM tbl_cart WHERE product_id = '$add_to_cart_product_id' AND email = '$email'");
		$cart_row = $cart_result->fetch_assoc();
		if($cart_result->num_rows > 0) {
			$total_quatity = $cart_row['quantity'] + $input_quantity;

			if($total_quatity > $product_result_stock) {
				$_SESSION['cant-proceed-message'] = 'Exceed the total number of stocks.';
				header('location: /etiendahan/category/view/product/');
			} else {
				$mysqli->query("UPDATE tbl_cart SET quantity = quantity + '$input_quantity' WHERE product_id = '$add_to_cart_product_id' AND email = '$email'") or die($mysqli->error);
				$_SESSION['message'] = 'Successfully Modified.';
				header('location: /etiendahan/category/view/product/');
			}

		} else {
			$sql = "INSERT INTO tbl_cart (id, product_id, quantity, email) VALUES (null, '$add_to_cart_product_id','$input_quantity', '$email')";
			if($mysqli->query($sql) or die($mysqli->error)) {
				$_SESSION['message'] = 'Successfully Inserted.';
				header('location: /etiendahan/category/view/product/');
			}
		}
	} else {
		$_SESSION['profile-cant-proceed-message'] = "You must log in before adding product to your cart.";
		header('location: /etiendahan/customer/account/login/');
	}
?>