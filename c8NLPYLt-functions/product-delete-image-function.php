<?php  
	require '/../db.php';
	session_start();

	$product_details_id = ((isset($_SESSION['product_details_id']) && $_SESSION['product_details_id'] != '')?htmlentities($_SESSION['product_details_id']):'');

	$result_product_details = $mysqli->query("SELECT * FROM tbl_products WHERE id='$product_details_id'");
	$product_details = $result_product_details->fetch_assoc();

	$saved_image = $product_details['image'];
	$image_url = $_SERVER['DOCUMENT_ROOT'].$saved_image;
	unlink($image_url);
	$mysqli->query("UPDATE tbl_products SET image = '' WHERE id = '$product_details_id'");

	header("location: /etiendahan/seller-centre/product/details/");
?>