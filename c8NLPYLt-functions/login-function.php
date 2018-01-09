<?php
    if ($logged_in == 0) {
        // Escape email to protect against SQL injections
        $email = $mysqli->escape_string($_POST['email']);
        $result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'");

        if ( $result->num_rows == 0 ){ // User doesn't exist
            $_SESSION['email-doesnt-exist-message'] = "User with that email doesn't exist, try again";
        }
        else { // User exists
            $user = $result->fetch_assoc();

            if (password_verify($_POST['password'], $user['password'])) {

                $_SESSION['id']         = $user['id'];  
                $_SESSION['fullname']   = $user['fullname'];
                $_SESSION['gender']     = $user['gender'];
                $_SESSION['email']      = $user['email'];
                $_SESSION['birthday']   = $user['birthday'];
                $_SESSION['birthmonth'] = $user['birthmonth'];
                $_SESSION['birthyear']  = $user['birthyear'];
                $_SESSION['active']     = $user['active'];

                // $fullname = $mysqli->escape_string($_POST['fullname']);
                
                // $_SESSION['active']     = 0;
                // This is how we'll know the user is logged in
                $_SESSION['logged_in'] = true;
                $_SESSION['welcome-message'] = $_SESSION['fullname'];

                header("location: /etiendahan/");
            }
            else {
                $_SESSION['wrong-password-message'] = "You have entered wrong password, try again";
            }
        }
    } else {
        $_SESSION['cant-proceed-message'] = "You already logged in";
        header("location: /etiendahan/");
    }
?>