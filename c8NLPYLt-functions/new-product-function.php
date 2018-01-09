<?php   
	require '/../db.php';
	session_start();

    // Escape all $_POST and $_SESSION variables to protect against SQL injections
    $name   		= $mysqli->escape_string($_POST['name']);
    $description    = $mysqli->escape_string($_POST['description']);
    $sub_id  		= $mysqli->escape_string($_POST['subCategory']);
    $price 			= $mysqli->escape_string($_POST['price']);
    $stock  		= $mysqli->escape_string($_POST['stock']);
    $email      	= $mysqli->escape_string($_SESSION['email']);

    $sql = "INSERT INTO tbl_products (id, name, description, sub_id, price, stock, seller_email) VALUES (null, '$name','$description', '$sub_id', '$price', '$stock', '$email')";

    if ($mysqli->query($sql) or die($mysqli->error)) {
		header("location: /etiendahan/seller-centre/product/new/");
    	$_SESSION['product-added-message'] = 'Successfully Added';

        // header("location: /etiendahan/"); 
    } else {
        // $_SESSION['message'] = 'Registration failed!';
        // header("location: /etiendahan/error/");
    }
?>