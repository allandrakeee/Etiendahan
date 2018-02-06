<?php  
	require '/../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

	$title          = ((isset($_POST['title']) && $_POST['title'] != '')?htmlentities($_POST['title']):'');
    $promotional    = ((isset($_POST['promotional']) && $_POST['promotional'] != '')?htmlentities($_POST['promotional']):'0');
    $link_status    = ((isset($_POST['link_status']) && $_POST['link_status'] != '')?htmlentities($_POST['link_status']):'0');

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
    	
    	$sql = "INSERT INTO tbl_slides(title, link_status, promotional, image) VALUES('$title', $link_status, $promotional, '$db_path')";
    	$mysqli->query($sql);
        $_SESSION['add-slide'] = "Successfully Added.";
    	header('location: /etiendahan/ed-admin/restricted/slides/new/');
	}
?>