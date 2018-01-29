<?php  	
	require '/../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

    $id = $_SESSION['parent_category_id'];
    echo $id;
	$parent_category = ((isset($_POST['parent_category']) && $_POST['parent_category'] != '')?htmlspecialchars($_POST['parent_category']):'');
	$parent_category_replace = str_replace("'", "''", $parent_category);
	
	// echo '<pre>';
	// var_dump($_POST['sub_category']);
	$sub_category_replace = str_replace("'", "''", $_POST['sub_category']);
    foreach($sub_category_replace as $key => $value) {
		$final_key = htmlentities($key);
		$final_value = htmlentities($value);
		$sql = "UPDATE tbl_categories_sub SET name = '$final_value' WHERE id = '$final_key'";
        $mysqli->query($sql);
	}

	if($_FILES['file']['name'] != '') {
        $categories_result = $mysqli->query("SELECT * FROM tbl_categories WHERE id = '$id'");
        $categories_row = $categories_result->fetch_assoc();
        $categories_row['image'];

        $image_url = $_SERVER['DOCUMENT_ROOT'].$categories_row['image'];
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
    	
    	$sql = "UPDATE tbl_categories SET name = '$parent_category_replace', image = '$db_path' WHERE id = '$id'";
    	$mysqli->query($sql);
        $_SESSION['modify-category'] = "Successfully Modified.";
    	header('location: /etiendahan/ed-admin/restricted/categories/modify/');
	} else {
        $sql = "UPDATE tbl_categories SET name = '$parent_category_replace' WHERE id = '$id'";
        $mysqli->query($sql);
        $_SESSION['modify-category'] = "Successfully Modified.";
        header('location: /etiendahan/ed-admin/restricted/categories/modify/');
    }
?>