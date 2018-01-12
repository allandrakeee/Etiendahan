<?php   
	require '/../db.php';
	session_start();

    // Escape all $_POST and $_SESSION variables to protect against SQL injections
    $id = $mysqli->escape_string($_SESSION['product_details_id']);

    $result_product_details = $mysqli->query("SELECT * FROM tbl_products WHERE id='$id'");
    $product_details = $result_product_details->fetch_assoc();

    $saved_image = $product_details['image'];
    $image_url = $_SERVER['DOCUMENT_ROOT'].$saved_image;
    unlink($image_url);
    
    $sql = "DELETE FROM tbl_products WHERE id = '$id'";

    if ($mysqli->query($sql) or die($mysqli->error)) {
		header("location: /etiendahan/seller-centre/product/list/all/");
    	$_SESSION['product-modified-message'] = 'Successfully Deleted';

        // header("location: /etiendahan/"); 
    } else {
        // $_SESSION['message'] = 'Registration failed!';
        // header("location: /etiendahan/error/");
    }
?>