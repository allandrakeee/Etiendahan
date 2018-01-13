<?php  
	require '/../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

	$product_details_id = ((isset($_SESSION['product_details_id']) && $_SESSION['product_details_id'] != '')?htmlentities($_SESSION['product_details_id']):'');
	$post_delete_image_id = ((isset($_POST['post_delete_image_id']) && $_POST['post_delete_image_id'] != '')?htmlentities($_POST['post_delete_image_id']):'');
	$imagei = (int)$post_delete_image_id - 1;

	$result_product_details = $mysqli->query("SELECT * FROM tbl_products WHERE id='$product_details_id'");
	$product_details = $result_product_details->fetch_assoc();
	$saved_image = $product_details['image'];

	$images = explode(',', $saved_image);
	$image_url = $_SERVER['DOCUMENT_ROOT'].$images[$imagei];
	unlink($image_url);
	unset($images[$imagei]);

	$image_string = implode(',', $images);

	echo 'Image url'.$image_url.'<br>';
	echo 'Image url'.$image_string.'<br>';
	$mysqli->query("UPDATE tbl_products SET image = '{$image_string}' WHERE id = '$product_details_id'");
	$email_path = BASEURL.'images/'.$_SESSION['email'].'/';
    echo $email_path;
    echo (count(glob("$email_path/*")) === 0) ? rmdir($email_path) : 'Not empty';
	header("location: /etiendahan/seller-centre/product/details/");
	$_SESSION['product-modified-message'] = 'Image Successfully Deleted';
?>