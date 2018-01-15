<?php
	require '/db.php';
	session_start();

	if(isset($_REQUEST['term'])) {
		$found = trim($_REQUEST['term']);
		$result = $mysqli->query("SELECT * FROM tbl_products WHERE stock != 0 AND banned = 0 AND name LIKE '%$found%' LIMIT 10");
		
		$data = array();
		while($row = mysqli_fetch_assoc($result)) {
			$data[] = array (
				'label' => $row['name'],
				'value' => $row['name'],
				'id' 	=> $row['id'],
			);
		}

		echo json_encode($data);
		flush();
	}	
?>