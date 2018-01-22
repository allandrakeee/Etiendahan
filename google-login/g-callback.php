<?php  
	require '/../db.php';
	require_once "config.php";
	
	session_start();
	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');


	if(isset($_SESSION['google_access_token'])) {
		$gClient->setAccessToken($_SESSION['google_access_token']);
	} else if(isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['google_access_token'] = $token;
	} else {
        header("location: /etiendahan/customer/account/login/");
    }

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();
	

    if ($logged_in == 0) {
        // Escape email to protect against SQL injections
        $email = $userData['email'];
        $result = $mysqli->query("SELECT * FROM tbl_customers WHERE email = '$email'");

        if ($result->num_rows == 0){

        	echo "<pre>";
			var_dump($userData);

	        $_SESSION['fullname']   = $userData['name'];
	        $_SESSION['email']      = $userData['email'];

	        // Escape all $_POST variables to protect against SQL injections
	        $fullname   = $mysqli->escape_string($userData['name']);
	        $email      = $mysqli->escape_string($userData['email']);
	        $hash       = $mysqli->escape_string( md5( rand(0,1000) ) );

            // active is 0 by DEFAULT (no need to include it here)
            $sql = "INSERT INTO tbl_customers (id, fullname, email, hash, joined_at) VALUES (null, '$fullname', '$email', '$hash', NOW())";

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
		    
        } else {
        	$user = $result->fetch_assoc();

			$_SESSION['id']         = $user['id'];  
            $_SESSION['fullname']   = $user['fullname'];
            $_SESSION['gender']     = $user['gender'];
            $_SESSION['email']      = $user['email'];
            $_SESSION['birthday']   = $user['birthday'];
            $_SESSION['birthmonth'] = $user['birthmonth'];
            $_SESSION['birthyear']  = $user['birthyear'];
            $_SESSION['active']     = $user['active'];

            $_SESSION['logged_in'] = true;
            $_SESSION['welcome-message'] = $_SESSION['fullname'];
            header("location: /etiendahan/");
        }
    } else {
        $_SESSION['cant-proceed-message'] = "You're already logged in.";
        header("location: /etiendahan/");
    }
?>