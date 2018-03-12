<?php 

    if($_SESSION['logged_in'] == 0) {
        $_SESSION['profile-cant-proceed-message'] = "You must log in before adding your wishlists.";
        header('location: /etiendahan/customer/account/login/');
    } else {
    	$customer_email = $_SESSION['email'];
    	if(isset($_POST['wishlists']) && $_POST['wishlists'] == 'yes') {
            $sql = "INSERT INTO tbl_wishlists (id, product_id, email) VALUES (null,'$category_product_id', '$customer_email')";

            // Add user to the database
            if ($mysqli->query($sql) or die($mysqli->error)) {
                $_SESSION['message'] = 'Successfully added to your wishlists.';
                header("location: /etiendahan/market/view/product/"); 
            } else {
                // $_SESSION['message'] = 'Registration failed!';
                // header("location: /etiendahan/error/");
            }
    	} else if(isset($_POST['wishlists']) && $_POST['wishlists'] == 'no') {
    		$sql = "DELETE FROM tbl_wishlists WHERE product_id = '$category_product_id'";

            // Add user to the database
            if ($mysqli->query($sql) or die($mysqli->error)) {
                $_SESSION['message'] = 'Successfully removed to your wishlists.';
                header("location: /etiendahan/market/view/product/"); 
            } else {
                // $_SESSION['message'] = 'Registration failed!';
                // header("location: /etiendahan/error/");
            }
    	}
    }

?>