<?php  
	require '/../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

	$product_name        = ((isset($_POST['product_name']) && $_POST['product_name'] != '')?htmlentities($_POST['product_name']):'');
    $product_description = ((isset($_POST['product_description']) && $_POST['product_description'] != '')?htmlentities($_POST['product_description']):'');
    $product_price       = ((isset($_POST['product_price']) && $_POST['product_price'] != '')?htmlentities($_POST['product_price']):'');
    $sic_owner           = ((isset($_POST['sic_owner']) && $_POST['sic_owner'] != '')?htmlentities($_POST['sic_owner']):'');

    if($_FILES['file']['name'] != '') {
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

        $sql = "INSERT INTO tbl_sic_product(id, name, description, price, image, created_at, owner_id) VALUES(null, '$product_name', '$product_description', '$product_price', '$db_path', NOW(), '$sic_owner')";
        $mysqli->query($sql);
        $_SESSION['add-product'] = "Successfully Added.";
        header('location: /etiendahan/ed-admin/restricted/specialty-in-city/new-product/');
    }
?>