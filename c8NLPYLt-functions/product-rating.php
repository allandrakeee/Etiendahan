<?php  
	require '/../db.php';
	session_start();

    $title   			 = $mysqli->escape_string($_POST['title']);
    $body 				 = $mysqli->escape_string($_POST['body']);
	$email 				 = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'Guest');
	$fullname 			 = ((isset($_SESSION['fullname']) && $_SESSION['fullname'] != '')?htmlentities($_SESSION['fullname']):'Guest');
	$category_product_id = ((isset($_SESSION['category_product_id']) && $_SESSION['category_product_id'] != '')?htmlentities($_SESSION['category_product_id']):'');
	$rating_value 		 = ((isset($_SESSION['rating_value']) && $_SESSION['rating_value'] != '')?htmlentities($_SESSION['rating_value']):'');

	echo $email;
	echo $fullname;
	echo $rating_value;

    $sql = "INSERT INTO tbl_ratings (id, fullname, email, title, body, created_at, product_id, rating) VALUES (null, '$fullname','$email', '$title', '$body', NOW(), '$category_product_id', '$rating_value')";
	$mysqli->query($sql);

	$_SESSION['message'] = 'Successfully Inserted.';
	header('location: /etiendahan/market/view/product/');
?>