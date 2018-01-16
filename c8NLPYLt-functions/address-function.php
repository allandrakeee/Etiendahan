<?php  
	require '/../db.php';
	session_start();

	$email			  = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']): '');	
	$fullname 		  = ((isset($_POST['fullname']) && $_POST['fullname'] != '')?htmlentities($_POST['fullname']): '');
	$phone_number 	  = ((isset($_POST['phone_number']) && $_POST['phone_number'] != '')?htmlentities($_POST['phone_number']): '');
	$postal_code 	  = ((isset($_POST['postal_code']) && $_POST['postal_code'] != '')?htmlentities($_POST['postal_code']): '');
	$province 		  = ((isset($_POST['province']) && $_POST['province'] != '')?htmlentities($_POST['province']): '');
	$city 			  = ((isset($_POST['city']) && $_POST['city'] != '')?htmlentities($_POST['city']): '');
	$barangay 		  = ((isset($_POST['barangay']) && $_POST['barangay'] != '')?htmlentities($_POST['barangay']): '');
	$complete_address = ((isset($_POST['complete_address']) && $_POST['complete_address'] != '')?htmlentities($_POST['complete_address']): '');
	$other_notes 	  = ((isset($_POST['other_notes']) && $_POST['other_notes'] != '')?htmlentities($_POST['other_notes']): '');

	$result = $mysqli->query("SELECT * FROM tbl_address WHERE email='$email'");

    if ( $result->num_rows == 0 ){ // User doesn't exist
        $sql = "INSERT INTO tbl_address (id, email, fullname, phone_number, postal_code, province, city, barangay, complete_address, other_notes, default_address) VALUES (null, '$email','$fullname', '$phone_number', '$postal_code', '$province', '$city', '$barangay', '$complete_address', '$other_notes', 1)";

	    if ($mysqli->query($sql) or die($mysqli->error)) {
	    	$_SESSION['success-message'] = 'Successfully added';
	        header("location: /etiendahan/customer/address/"); 
	    } else {
	        // $_SESSION['message'] = 'Registration failed!';
	        // header("location: /etiendahan/error/");
	    }
    } else {
    	$sql = "INSERT INTO tbl_address (id, email, fullname, phone_number, postal_code, province, city, barangay, complete_address, other_notes, default_address) VALUES (null, '$email','$fullname', '$phone_number', '$postal_code', '$province', '$city', '$barangay', '$complete_address', '$other_notes', 0)";

	    if ($mysqli->query($sql) or die($mysqli->error)) {
	    	$_SESSION['success-message'] = 'Successfully Added';
	        header("location: /etiendahan/customer/address/"); 
	    } else {
	        // $_SESSION['message'] = 'Registration failed!';
	        // header("location: /etiendahan/error/");
	    }
    }

    
?>