<?php  
	require '../../db.php';
	session_start();
	$product_wishlists_id = $_SESSION['wishlists_delete'];
	$customer_email = $_SESSION['email'];

	if($_SESSION['wishlists_delete'] == '') {
		header('location: /etiendahan/customer/wishlists/');
	}

	$sql = "DELETE FROM tbl_wishlists WHERE product_id = '$product_wishlists_id' AND email = '$customer_email'";

    if ($mysqli->query($sql) or die($mysqli->error)) {
        $_SESSION['message'] = 'Successfully Deleted.';
        header("location: /etiendahan/customer/wishlists/"); 
    } else {
        // $_SESSION['message'] = 'Registration failed!';
        // header("location: /etiendahan/error/");
    }
?>