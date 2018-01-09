<?php  
    require '/../db.php';
    session_start();

    // Escape all $_POST and $_SESSION variables to protect against SQL injections
    $email     			= $mysqli->escape_string($_SESSION['email']);
    $currentPassword   	= $mysqli->escape_string($_POST['currentPassword']);
    $retypePassword  	= $mysqli->escape_string($_POST['retypePassword']);

    // Check if user with that email with password already exists
    $result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'") or die($mysqli->error);
    $user = $result->fetch_assoc();

    if ( password_verify($currentPassword, $user['password']) ) {

    	$password = $mysqli->escape_string( password_hash($retypePassword, PASSWORD_BCRYPT) );

        $sql = "UPDATE tbl_customers SET password = '$password' WHERE email = '$email'";

        // Add user to the database
        if ( $mysqli->query($sql) or die($mysqli->error) ){

            $_SESSION['modified-message'] = "Successfully modified";
            header("location: /etiendahan/customer/account/password/");
        }

        else {
            // $_SESSION['message'] = 'Registration failed!';
            // header("location: /etiendahan/error/");
        }
    }
    else {
        $_SESSION['check-password-message'] = "Password didn't match to you email, try again";
        header("location: /etiendahan/customer/account/password/");
    }
    
?>