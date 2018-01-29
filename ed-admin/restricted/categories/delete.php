<?php  
    require '../../../db.php';
	session_start();

	$id = $_SESSION['delete_sub_category'];

	$sql = "DELETE FROM tbl_categories_sub WHERE id = '$id'";
	$mysqli->query($sql);
    $_SESSION['delete-sub-category'] = "Successfully Deleted.";
	header('location: /etiendahan/ed-admin/restricted/categories/modify/');
?>