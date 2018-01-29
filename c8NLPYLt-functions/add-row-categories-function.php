<?php  
	require '/../db.php';
	session_start();
	
	$id = $_SESSION['parent_category_id'];
	echo $id;

	$sub_category_replace = str_replace("'", "''", $_POST['sub_category']);
    foreach($sub_category_replace as $key => $value) {
		$final_key = htmlentities($key);
		$final_value = htmlentities($value);
		echo $final_value;
		$sql = "INSERT INTO tbl_categories_sub(id, name, parent_id) VALUES(null, '$final_value', '$id')";
    	$mysqli->query($sql);

	}
	$_SESSION['add-sub-category'] = "Successfully Added.";
	header('location: /etiendahan/ed-admin/restricted/categories/add-row/');
?>