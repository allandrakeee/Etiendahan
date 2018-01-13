<?php  
	require '/../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

	$product_details_id = ((isset($_SESSION['product_details_id']) && $_SESSION['product_details_id'] != '')?htmlentities($_SESSION['product_details_id']):'');

	$result = $mysqli->query("SELECT * FROM tbl_products WHERE id='$product_details_id'");
	$product_details_row = $result->fetch_assoc();
	$image_count = $product_details_row['image'];

	if($_FILES['file']['name'] != '') {
		$test = explode(".", $_FILES['file']['name']);
		$extension = end($test);
		$name = md5(microtime()).'.'.$extension;
        $email_path = BASEURL.'images/'.$_SESSION['email'].'/';

        if(!is_dir($email_path)) {
            mkdir($email_path);
        }

        $upload_path = $email_path.basename($name);
        move_uploaded_file($_FILES['file']['tmp_name'], $upload_path);

        if($image_count == '') {
        	$db_path = '/etiendahan/images/'.$_SESSION['email'].'/'.$name;
    	
	    	$sql = "UPDATE tbl_products SET image = '$db_path' WHERE id = '$product_details_id'";
	    	$mysqli->query($sql);
        } else {
        	$db_path = ',/etiendahan/images/'.$_SESSION['email'].'/'.$name;
    	
	    	$sql = "UPDATE tbl_products SET image = CONCAT(image, '$db_path') WHERE id = '$product_details_id'";
	    	$mysqli->query($sql);
        }
	}
?>