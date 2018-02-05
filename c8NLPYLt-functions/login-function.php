<?php
    if ($logged_in == 0) {
        // Escape email to protect against SQL injections
        $email = $mysqli->escape_string($_POST['email']);
        $result = $mysqli->query("SELECT * FROM tbl_customers WHERE email = '$email'");

        $result_banned = $mysqli->query("SELECT * FROM tbl_customers WHERE email = '$email'");
        $row_banned = $result_banned->fetch_assoc();

        if ( $result->num_rows == 0 ){ // User doesn't exist
            $_SESSION['email-doesnt-exist-message'] = "User with that email doesn't exist, try again.";
        } else if($row_banned['banned'] == 1) {
            $_SESSION['cant-proceed-message-banned'] = "Your customer account is banned! <a href='mailto:etiendahan@gmail.com' style='text-decoration: none' target='_blank'>Email</a> us for info.";
        } else { // User exists
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

                $unique_hash_visitors = $_SESSION['unique_hash_visitors'];
                $email = $_SESSION['email'];
                $sql = "UPDATE tbl_visits SET created_at = NOW(), registered_customer = 1, email = '$email' WHERE hash = '$unique_hash_visitors'";
                $mysqli->query($sql);

                header("location: /etiendahan/");
            }
            else {
                $_SESSION['wrong-password-message'] = "You have entered wrong password, try again.";
            }
        }
    } else {
        $_SESSION['cant-proceed-message'] = "You're already logged in.";
        header("location: /etiendahan/");
    }
?>