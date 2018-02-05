<?php  
    require '../../../db.php';
    session_start();

    echo $rating_id = $_SESSION['review_go_to_message'];    

	$sql1 = "UPDATE tbl_ratings SET report_as_inappropriate = 0 WHERE id = '$rating_id'";
	$mysqli->query($sql1);

	$sql = "DELETE FROM tbl_ratings_reports WHERE rating_id = '$rating_id'";
	$mysqli->query($sql);

	$_SESSION['success-message'] = 'Review is remain.';
	header('location: /etiendahan/ed-admin/restricted/report-as-inappropriate/');
?>