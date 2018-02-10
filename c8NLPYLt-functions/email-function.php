<?php  
    require '/../db.php';
    session_start();

    // Escape all $_POST variables to protect against SQL injections
    $new_email = $mysqli->escape_string($_POST['newEmail']);
    $email     = $mysqli->escape_string($_SESSION['email']);

    // Check if user with that email already exists
    $result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$new_email'") or die($mysqli->error);

    // We know user email exists if the rows returned are more than 0
    if ($result->num_rows > 0) {
        $_SESSION['user-exists-message'] = 'User with this email already exists, try again.';
        header("location: /etiendahan/customer/account/email/");
    }
    else {
        define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');
        $email_path = BASEURL."images/".$email."/";
        $new_email_path = BASEURL."images/".$new_email."/";

        if(is_dir($email_path) && !is_dir($new_email_path)) {
            rename($email_path, $new_email_path);
        }

        $db_path = "/etiendahan/images/".$new_email."/";

        $mysqli->query("UPDATE tbl_products SET seller_email = '$new_email', image = REPLACE(image, '$email', '$new_email') WHERE seller_email='$email'") or die($mysqli->error);
        $mysqli->query("UPDATE tbl_sellers SET seller_email = '$new_email' WHERE seller_email='$email'") or die($mysqli->error);
        $mysqli->query("UPDATE tbl_address SET email = '$new_email' WHERE email='$email'") or die($mysqli->error);
        $mysqli->query("UPDATE tbl_cart SET email = '$new_email' WHERE email='$email'") or die($mysqli->error);
        $mysqli->query("UPDATE tbl_wishlists SET email = '$new_email' WHERE email='$email'") or die($mysqli->error);
        $mysqli->query("UPDATE tbl_orders SET email = '$new_email' WHERE email='$email'") or die($mysqli->error);
        $mysqli->query("UPDATE tbl_ratings SET email = '$new_email' WHERE email='$email'") or die($mysqli->error);
        $mysqli->query("UPDATE tbl_ratings_reports SET email = '$new_email' WHERE email='$email'") or die($mysqli->error);
        $mysqli->query("UPDATE tbl_recently_viewed_products SET email = '$new_email' WHERE email='$email'") or die($mysqli->error);
        $mysqli->query("UPDATE tbl_visits SET email = '$new_email' WHERE email='$email'") or die($mysqli->error);
        
        $sql = "UPDATE tbl_customers SET email = '$new_email' WHERE email = '$email'";

        if ($mysqli->query($sql) or die($mysqli->error)) {
            // Set session variables to be used on other page
            $_SESSION['email'] = $_POST['newEmail'];

            $email = $mysqli->escape_string($_SESSION['email']);   

            // Set the user status to active (active = 0)
            $mysqli->query("UPDATE tbl_customers SET active='0' WHERE email='$email'") or die($mysqli->error);
            $_SESSION['active'] = 0;

            $_SESSION['modified-message'] = "Successfully Modified.";
            header("location: /etiendahan/customer/account/email/");
        } else {
            // $_SESSION['message'] = 'Registration failed!';
            // header("location: /etiendahan/error/");
        }
    }
?>