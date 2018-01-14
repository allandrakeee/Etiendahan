<?php
// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'");

if ($result->num_rows == 0) { // User doesn't exist
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

        $_SESSION['logged_in'] = true;
        $_SESSION['welcome-message'] = $_SESSION['fullname'];

        if ($user['seller_centre'] == 0) {
            $_SESSION['cant-proceed-message'] = "You must activate first your seller centre account";
            header("location: /etiendahan/seller-centre/account/activate/");
        } else {
            $_SESSION['activateSeller'] = 1;
            header("location: /etiendahan/seller-centre/");
        }        
    }
    else {
        $_SESSION['wrong-password-message'] = "You have entered wrong password, try again";
    }
}

?>