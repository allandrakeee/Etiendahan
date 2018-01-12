<?php   
	require '/../db.php';
	session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');


    var_dump($_FILES['image']);
    $photo_count = count($_FILES['image']['name']);

    $allowed_type = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');
    $allowed = array('png', 'jpg', 'jpeg', 'gif');
    $tmp_location = array();
    $upload_path = array();
    $db_path = '';

    if($photo_count > 0) {
        for($i=0;$i<$photo_count;$i++) {
            echo $i.'<br>';

            $name = $_FILES['image']['name'][$i];
            $name_array = explode('.', $name);
            $file_name = $name_array[0];
            $file_extension = $name_array[1];
            $mime = explode('/', $_FILES['image']['type'][$i]);
            $mime_type = $mime[0];
            $mime_extension = $mime[1];
            $tmp_location[] = $_FILES['image']['tmp_name'][$i];
            $image_size = $_FILES['image']['size'][$i];
            $upload_name = md5(microtime().$i).'.'.$file_extension;
            $email_path = BASEURL.'images/'.$_SESSION['email'].'/';

            if(!is_dir($email_path)) {
                mkdir($email_path);
            }
            
            $upload_path[] = $email_path.basename($upload_name);

            if($i != 0) {
            $db_path .= ',';
            }
            $db_path .= '/etiendahan/images/'.$_SESSION['email'].'/'.$upload_name;
        }
    }      

    if($mime_type != 'image') {
        header("location: /etiendahan/seller-centre/product/new/");
        echo '1';
        $_SESSION['cant-proceed-message'] = 'The file must be an image';
    } else if($image_size >= 11864210 || ($_FILES["image"]["size"] == 0)) {
        header("location: /etiendahan/seller-centre/product/new/");
        echo '2';
        $_SESSION['cant-proceed-message'] = 'Image too large. Each image must be less than 10 megabytes.';
    } if($photo_count > 8){
        header("location: /etiendahan/seller-centre/product/new/");
        echo '3';
        $_SESSION['cant-proceed-message'] = '8 images is the limit of uploading image';
    } else {
        if($photo_count > 0) {
            for ($i=0; $i < $photo_count; $i++) { 
                move_uploaded_file($tmp_location[$i], $upload_path[$i]);
            }
        }
        // Escape all $_POST and $_SESSION variables to protect against SQL injections
        $name           = $mysqli->escape_string($_POST['name']);
        $description    = $mysqli->escape_string($_POST['description']);
        $sub_id         = $mysqli->escape_string($_POST['subCategory']);
        $price          = $mysqli->escape_string($_POST['price']);
        $stock          = $mysqli->escape_string($_POST['stock']);
        $email          = $mysqli->escape_string($_SESSION['email']);

        $sql = "INSERT INTO tbl_products (id, name, description, sub_id, price, stock, image, seller_email) VALUES (null, '$name','$description', '$sub_id', '$price', '$stock', '$db_path', '$email')";

        if ($mysqli->query($sql) or die($mysqli->error)) {
            header("location: /etiendahan/seller-centre/product/new/");
            $_SESSION['product-added-message'] = 'Successfully Added';
        } else {
        // $_SESSION['message'] = 'Registration failed!';
        // header("location: /etiendahan/error/");
        }
    }
?>