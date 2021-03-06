<?php 
    if ($logged_in == 0) {
        // Set session variables to be used on other page
        $_SESSION['fullname']   = $_POST['fullname'];
        $_SESSION['gender']     = $_POST['gender'];
        $_SESSION['email']      = $_POST['email'];
        $_SESSION['birthday']   = $_POST['birthday'];
        $_SESSION['birthmonth'] = $_POST['birthmonth'];
        $_SESSION['birthyear']  = $_POST['birthyear'];

        // Escape all $_POST variables to protect against SQL injections
        $fullname   = $mysqli->escape_string($_POST['fullname']);
        $gender     = $mysqli->escape_string($_POST['gender']);
        $birthday   = $mysqli->escape_string($_POST['birthday']);
        $birthmonth = $mysqli->escape_string($_POST['birthmonth']);
        $birthyear  = $mysqli->escape_string($_POST['birthyear']);
        $email      = $mysqli->escape_string($_POST['email']);
        $password   = $mysqli->escape_string( password_hash($_POST['password'], PASSWORD_BCRYPT) );
        $hash       = $mysqli->escape_string( md5( rand(0,1000) ) );

        // Check if user with that email already exists
        $result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'") or die($mysqli->error);
        // We know user email exists if the rows returned are more than 0
        if ($result->num_rows > 0) {
            
            $_SESSION['user-exists-message'] = 'User with this email already exists';
            
        }
        else { // Email doesn't already exist in a database, proceed...

            // active is 0 by DEFAULT (no need to include it here)
            $sql = "INSERT INTO tbl_customers (id, fullname, gender, birthday, birthmonth, birthyear, email, password, hash, joined_at) VALUES (null, '$fullname','$gender', '$birthday', '$birthmonth', '$birthyear', '$email', '$password', '$hash', NOW())";

            // Add user to the database
            if ($mysqli->query($sql) or die($mysqli->error)) {
                $result_last_id = $mysqli->query("SELECT MAX(id) FROM tbl_customers");
                $row_last_id = $result_last_id->fetch_assoc();
                $_SESSION['id'] = $row_last_id['MAX(id)'];
                $_SESSION['active']                 = 0;        // 0 until user activates their account with verify.php
                $_SESSION['logged_in']              = true;     // So we know the user has logged in
                $_SESSION['get-fullname-message']   = "$fullname";
                // $_SESSION['message'] =
                        
                //          "Confirmation link has been sent to $email, please verify
                //          your account by clicking on the link in the message!";

                // Send registration confirmation link (verify.php)
                // $to      = $email;
                // $subject = 'Account Verification ( clevertechie.com )';
                // $message_body = '
                // Hello '.$fullname.',

                // Thank you for signing up!

                // Please click this link to activate your account:

                // http://localhost:8080/etiendahan/verify.php?email='.$email.'&hash='.$hash;  

                // mail( $to, $subject, $message_body );

                header("location: /etiendahan/"); 
            } else {
                $_SESSION['message'] = 'Registration failed!';
                header("location: /etiendahan/error/");
            }
        }
    } else {
        $_SESSION['cant-proceed-message'] = "You already logged in";
        header("location: /etiendahan/");
    }
?>