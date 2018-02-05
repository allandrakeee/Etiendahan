<?php  
	require '../../db.php';
	session_start();
  	
  	$email = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');

	$result_banned = $mysqli->query("SELECT * FROM tbl_customers WHERE email = '$email'");
	$row_banned = $result_banned->fetch_assoc();
	if($row_banned['banned'] == 1) {
		$_SESSION['email'] = false;
		$_SESSION['logged_in'] = false;
	    $_SESSION['cant-proceed-message-banned'] = "Your customer account is banned! <a href='mailto:etiendahan@gmail.com' style='text-decoration: none' target='_blank'>Email</a> us for info.";
	    header('location: /etiendahan/customer/account/login/');
	    exit;
	}

	$product_wishlists_id   = ((isset($_SESSION['wishlists_cart']) && $_SESSION['wishlists_cart'] != '')?htmlentities($_SESSION['wishlists_cart']):'');
	$input_quantity 	    = 1;
	$email 				    = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');

	if($_SESSION['wishlists_cart'] == '') {
		header('location: /etiendahan/customer/wishlists/');
	}

	$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$product_wishlists_id'");
	$product_result = $product_result->fetch_assoc();
	$product_result_stock = $product_result['stock'];

	echo $product_wishlists_id;
	
	$cart_result = $mysqli->query("SELECT * FROM tbl_cart WHERE product_id = '$product_wishlists_id' AND email = '$email'");
	$cart_row = $cart_result->fetch_assoc();
	if($cart_result->num_rows > 0) {
		$total_quatity = $cart_row['quantity'] + $input_quantity;

		if($total_quatity > $product_result_stock) {
			$_SESSION['cant-proceed-message'] = 'Exceed the total number of stocks.';
			header('location: /etiendahan/customer/wishlists/');
		} else {
			$mysqli->query("UPDATE tbl_cart SET quantity = quantity + '$input_quantity' WHERE product_id = '$product_wishlists_id' AND email = '$email'") or die($mysqli->error);
			$_SESSION['message'] = 'Successfully Modified.';
			header('location: /etiendahan/customer/wishlists/');
		}

	} else {
		$sql = "INSERT INTO tbl_cart (id, product_id, quantity, email) VALUES (null, '$product_wishlists_id','$input_quantity', '$email')";
		if($mysqli->query($sql) or die($mysqli->error)) {
			$_SESSION['message'] = 'Successfully Inserted.';
			header('location: /etiendahan/customer/wishlists/');
		}
	}
?>