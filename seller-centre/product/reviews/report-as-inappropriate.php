<?php  
	require '/../../../db.php';
	session_start();
	echo $report_id = $_SESSION['report_rating'];
  	$email = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');


	$sql = "UPDATE tbl_ratings SET report_as_inappropriate = 1 WHERE id = '$report_id'";
	$mysqli->query($sql);

    $sql1 = "INSERT INTO tbl_ratings_reports (id, rating_id, email, created_at, status) VALUES (null, '$report_id', '$email', NOW(), 'pending')";
	if($mysqli->query($sql1) or die($mysqli->error)) {
		header('location: /etiendahan/seller-centre/product/reviews/');
	}
?>