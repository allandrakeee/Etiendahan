<?php  
	require '/../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

    $id = $_SESSION['slide_id'];

	$title          = ((isset($_POST['title']) && $_POST['title'] != '')?htmlentities($_POST['title']):'');
    $promotional    = ((isset($_POST['promotional']) && $_POST['promotional'] != '')?htmlentities($_POST['promotional']):'0');
    $link_to    = ((isset($_POST['sic_owner']) && $_POST['sic_owner'] != '')?htmlentities($_POST['sic_owner']):'0');     
    $link_status    = ((isset($_POST['link_status']) && $_POST['link_status'] != '')?htmlentities($_POST['link_status']):'0');

	if($_FILES['file']['name'] != '') {
        $slides_result = $mysqli->query("SELECT * FROM tbl_slides WHERE id = '$id'");
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
    	
    	$sql = "UPDATE tbl_slides SET title = '$title', link_to = '$link_to', link_status = '$link_status', promotional = '$promotional', image = '$db_path' WHERE id = '$id'";
    	$mysqli->query($sql);
        $_SESSION['modify-slide'] = "Successfully Modified.";
    	header('location: /etiendahan/ed-admin/restricted/slides/modify/');
	} else {
        $sql = "UPDATE tbl_slides SET title = '$title', link_to = '$link_to', link_status = '$link_status', promotional = '$promotional' WHERE id = '$id'";
        $mysqli->query($sql);
        $_SESSION['modify-slide'] = "Successfully Modified.";
        header('location: /etiendahan/ed-admin/restricted/slides/modify/');
    }
?>