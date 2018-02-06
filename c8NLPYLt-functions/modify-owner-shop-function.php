<?php  
    require '/../db.php';
    session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

    $sic_id = $_SESSION['action_sic'];
    $owner_name    = ((isset($_POST['owner_name']) && $_POST['owner_name'] != '')?htmlentities($_POST['owner_name']):'');
    $cellphone_number = ((isset($_POST['cellphone_number']) && $_POST['cellphone_number'] != '')?htmlentities($_POST['cellphone_number']):'');
    $owner_email       = ((isset($_POST['owner_email']) && $_POST['owner_email'] != '')?htmlentities($_POST['owner_email']):'');
    $store_address = ((isset($_POST['store_address']) && $_POST['store_address'] != '')?htmlentities($_POST['store_address']):'');
    $lat           = ((isset($_POST['lat']) && $_POST['lat'] != '')?htmlentities($_POST['lat']):'');
    $lng           = ((isset($_POST['lng']) && $_POST['lng'] != '')?htmlentities($_POST['lng']):'');

    $final_owner_name = str_replace("'", "''", $owner_name);
    
    echo $owner_name;
    echo '<pre>';
    var_dump($_FILES['file']);
    if($_FILES['file']['name'] != '') {
        $slides_result = $mysqli->query("SELECT * FROM tbl_sic_owner WHERE id = '$sic_id'");
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
        
        $sql = "UPDATE tbl_sic_owner SET name = '$final_owner_name', cellphone_number = '$cellphone_number', email = '$owner_email', address = '$store_address', lat = '$lat', lng = '$lng', image = '$db_path' WHERE id = '$sic_id'";
        $mysqli->query($sql);
        $_SESSION['modify-slide'] = "Successfully Modified.";
        header('location: /etiendahan/ed-admin/restricted/specialty-in-city/modify-owner-shop/');
    } else {
        $sql = "UPDATE tbl_sic_owner SET name = '$final_owner_name', cellphone_number = '$cellphone_number', email = '$owner_email', address = '$store_address', lat = '$lat', lng = '$lng' WHERE id = '$sic_id'";
        $mysqli->query($sql);
        $_SESSION['modify-slide'] = "Successfully Modified.";
        header('location: /etiendahan/ed-admin/restricted/specialty-in-city/modify-owner-shop/');
    }
?>