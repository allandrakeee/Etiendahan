<?php  
    require '/../db.php';
    session_start();

    // Escape all $_POST variables to protect against SQL injections
    $fullname   = $mysqli->escape_string($_POST['fullname']);
    $gender     = $mysqli->escape_string($_POST['gender']);
    $birthday   = $mysqli->escape_string($_POST['birthday']);
    $birthmonth = $mysqli->escape_string($_POST['birthmonth']);
    $birthyear  = $mysqli->escape_string($_POST['birthyear']);
    $email      = $mysqli->escape_string($_SESSION['email']);


    $sql = "UPDATE tbl_customers SET fullname = '$fullname', gender = '$gender', birthday = '$birthday', birthmonth = '$birthmonth', birthyear = '$birthyear' WHERE email = '$email'";

    // Add user to the database
    if ( $mysqli->query($sql) or die($mysqli->error) ){
        
        // Set session variables to be used on other page
        $_SESSION['fullname']   = $_POST['fullname'];
        $_SESSION['gender']     = $_POST['gender'];
        $_SESSION['birthday']   = $_POST['birthday'];
        $_SESSION['birthmonth'] = $_POST['birthmonth'];
        $_SESSION['birthyear']  = $_POST['birthyear'];

        $_SESSION['modified-message-profile'] = "Successfully modified";
        header("location: /etiendahan/customer/account/profile/");
        
    }

    else {
        $_SESSION['message'] = 'Failed to modified!';
        header("location: /etiendahan/customer/account/profile/");
    }
    
?>