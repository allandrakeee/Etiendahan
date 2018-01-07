<?php  
	if(isset($_POST['activateSeller']) && $_POST['activateSeller'] == 'yes') {
		$id      = $mysqli->escape_string($_SESSION['id']);
		$email      = $mysqli->escape_string($_SESSION['email']);
	    $sql = "UPDATE tbl_customers SET seller_centre = '1' WHERE email = '$email'";
	    $_SESSION['activateSeller'] = 1;

	    // Add user to the database
	    if ($mysqli->query($sql) or die($mysqli->error)){
	        $sql = "INSERT INTO tbl_sellers (id, seller_id, seller_email) VALUES (null,'$id', '$email')";

	        // Add user to the database
	        if ($mysqli->query($sql) or die($mysqli->error)) {
	            header("location: /etiendahan/seller-centre/"); 
	        } else {
	            // $_SESSION['message'] = 'Registration failed!';
	            // header("location: /etiendahan/error/");
	        }
	    } else {
	        // $_SESSION['message'] = 'Failed to modified!';
	        // header("location: /etiendahan/customer/account/profile/");
	    }
	}
?>