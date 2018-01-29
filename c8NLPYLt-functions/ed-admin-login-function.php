<?php
	$username = $mysqli->escape_string($_POST['u']);
	$password = $mysqli->escape_string($_POST['p']);
	echo $username;
	echo $password;

    $result = $mysqli->query("SELECT * FROM tbl_admin WHERE username = '$username'");

    if($result->num_rows == 0) { // User doesn't exist
        $_SESSION['username-doesnt-exist-message'] = "Username doesn't exist, try again.";
    }
    else { // User exists
        $user = $result->fetch_assoc();

        if ($password == $user['password']) {
            $_SESSION['admin_id']         	 = $user['id'];  
            $_SESSION['admin_fullname']   	 = $user['username'];
            $_SESSION['logged_in_admin']     = true;
            header("location: /etiendahan/ed-admin/restricted/");
        }
        else {
            $_SESSION['wrong-password-message'] = "You have entered wrong password, try again.";
        }
    }
?>