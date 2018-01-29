<?php  
    require '../../../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

	$id = $_SESSION['slide_id'];

	$slides_result_delete = $mysqli->query("SELECT * FROM tbl_slides");
	$slides_result = $mysqli->query("SELECT * FROM tbl_slides WHERE id = '$id'");

	if($slides_result_delete->num_rows == 1) {
        $_SESSION['cant-proceed-delete-slide'] = "Required atleast 1 slide.";
		header('location: /etiendahan/ed-admin/restricted/slides/');		
	} else {
		$slides_row = $slides_result->fetch_assoc();
		$slides_row['image'];

		$image_url = $_SERVER['DOCUMENT_ROOT'].$slides_row['image'];
	    unlink($image_url);
	    $admin_path = BASEURL.'images/administrator/';
	    (count(glob("$admin_path/*")) === 0) ? rmdir($admin_path) : 'Not empty';

		$sql = "DELETE FROM tbl_slides WHERE id = '$id'";
		$mysqli->query($sql);
        $_SESSION['delete-slide'] = "Successfully Deleted.";
		header('location: /etiendahan/ed-admin/restricted/slides/');
	}
?>