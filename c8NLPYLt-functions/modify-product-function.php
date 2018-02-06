<?php  
	require '/../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

    $sic_id              = $_SESSION['action_sic'];
	$product_name        = ((isset($_POST['product_name']) && $_POST['product_name'] != '')?htmlentities($_POST['product_name']):'');
    $product_description = ((isset($_POST['product_description']) && $_POST['product_description'] != '')?htmlentities($_POST['product_description']):'');
    $product_price       = ((isset($_POST['product_price']) && $_POST['product_price'] != '')?htmlentities($_POST['product_price']):'');
    $sic_owner           = ((isset($_POST['sic_owner']) && $_POST['sic_owner'] != '')?htmlentities($_POST['sic_owner']):'');
    
    if($_FILES['file']['name'] != '') {
        $slides_result = $mysqli->query("SELECT * FROM tbl_sic_product WHERE id = '$sic_id'");
        $slides_row = $slides_result->fetch_assoc();
        $slides_row['image'];

        $image_url = $_SERVER['DOCUMENT_ROOT'].$slides_row['image'];
        unlink($image_url);
        $admin_path = BASEURL.'images/administrator/';
        (count(glob("$admin_path/*")) === 0) ? rmdir($admin_path) : 'Not empty';
        
        $test = explode(".", $_FILES['file']['name']);
        $extension = end($test);
        $name = md5(microtime()).'.'.$extension;
        $admin_path = BASEURL.'images/administrator/';

        if(!is_dir($admin_path)) {
            mkdir($admin_path);
        }

        $upload_path = $admin_path.basename($name);
        move_uploaded_file($_FILES['file']['tmp_name'], $upload_path);

        $db_path = '/etiendahan/images/administrator/'.$name;
        
        $sql = "UPDATE tbl_sic_product SET name = '$product_name', description = '$product_description', price = '$product_price', image = '$db_path', owner_id = '$sic_owner' WHERE id = '$sic_id'";
        $mysqli->query($sql);
        $_SESSION['modify-product'] = "Successfully Modified.";
        header('location: /etiendahan/ed-admin/restricted/specialty-in-city/modify-product/');
    } else {
        $sql = "UPDATE tbl_sic_product SET name = '$product_name', description = '$product_description', price = '$product_price', owner_id = '$sic_owner' WHERE id = '$sic_id'";
        $mysqli->query($sql);
        $_SESSION['modify-product'] = "Successfully Modified.";
        header('location: /etiendahan/ed-admin/restricted/specialty-in-city/modify-product/');
    }
?>