<?php  
	require '/../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

	$owner_name       = ((isset($_POST['owner_name']) && $_POST['owner_name'] != '')?htmlentities($_POST['owner_name']):'');
    $cellphone_number = ((isset($_POST['cellphone_number']) && $_POST['cellphone_number'] != '')?htmlentities($_POST['cellphone_number']):'');
    $owner_email       = ((isset($_POST['owner_email']) && $_POST['owner_email'] != '')?htmlentities($_POST['owner_email']):'');
    $store_address    = ((isset($_POST['store_address']) && $_POST['store_address'] != '')?htmlentities($_POST['store_address']):'');
    $lat              = ((isset($_POST['lat']) && $_POST['lat'] != '')?htmlentities($_POST['lat']):'');
    $lng              = ((isset($_POST['lng']) && $_POST['lng'] != '')?htmlentities($_POST['lng']):'');

    $final_owner_name = str_replace("'", "''", $owner_name);
	echo $owner_name;
    echo '<pre>';
    var_dump($_FILES['file']);
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
    	
    	$sql = "INSERT INTO tbl_sic_owner(id, name, cellphone_number, email, address, lat, lng, image) VALUES(null, '$final_owner_name', '$cellphone_number', '$owner_email', '$store_address', '$lat', '$lng', '$db_path')";
    	$mysqli->query($sql);
        $_SESSION['add-owner'] = "Successfully Added.";
    	header('location: /etiendahan/ed-admin/restricted/specialty-in-city/new-owner-shop/');
	}
?>