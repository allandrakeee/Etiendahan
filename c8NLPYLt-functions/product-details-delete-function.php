<?php   
	require '/../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

    // Escape all $_POST and $_SESSION variables to protect against SQL injections
    $id = $mysqli->escape_string($_SESSION['product_details_id']);
    $post_delete_image_id = ((isset($_POST['post_delete_image_id']) && $_POST['post_delete_image_id'] != '')?htmlentities($_POST['post_delete_image_id']):'');
    $imagei = (int)$post_delete_image_id - 1;

    $result_product_details = $mysqli->query("SELECT * FROM tbl_products WHERE id='$id'");
    $product_details = $result_product_details->fetch_assoc();

    $saved_image = $product_details['image'];
    $images = explode(',', $saved_image);
    $image_count = count($images);
    $number = 0;
    foreach (range(0, $image_count) as $number) {
        $image_url = $_SERVER['DOCUMENT_ROOT'].$images[$number];
        unlink($image_url);
    }
    
    $sql = "DELETE FROM tbl_products WHERE id = '$id'";
    $sql_delete_ratings = "DELETE FROM tbl_ratings WHERE product_id = '$id'";
    $mysqli->query($sql_delete_ratings);
    $sql_delete_cart = "DELETE FROM tbl_cart WHERE product_id = '$id'";
    $mysqli->query($sql_delete_cart);
    $sql_delete_recently_viewed_products = "DELETE FROM tbl_recently_viewed_products WHERE product_id = '$id'";
    $mysqli->query($sql_delete_recently_viewed_products);
    $sql_delete_wishlists = "DELETE FROM tbl_wishlists WHERE product_id = '$id'";
    $mysqli->query($sql_delete_wishlists);

    if ($mysqli->query($sql) or die($mysqli->error)) {
        $email_path = BASEURL.'images/'.$_SESSION['email'].'/';
        echo $email_path;
        echo (count(glob("$email_path/*")) === 0) ? rmdir($email_path) : 'Not empty';

		header("location: /etiendahan/seller-centre/product/list/all/");
    	$_SESSION['product-modified-message'] = 'Successfully Deleted.';

        // header("location: /etiendahan/"); 
    } else {
        // $_SESSION['message'] = 'Registration failed!';
        // header("location: /etiendahan/error/");
    }
?>