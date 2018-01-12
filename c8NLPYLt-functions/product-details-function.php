<?php   
    require '/../db.php';
    session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

    var_dump($_FILES);
    $image = $_FILES['image'];
    $name = $image['name'];
    $name_array = explode('.', $name);
    $file_name = $name_array[0];
    $file_extension = $name_array[1];
    $mime = explode('/', $image['type']);
    $mime_type = $mime[0];
    $mime_extension = $mime[1];
    $tmp_location = $image['tmp_name'];
    $image_size = $image['size'];
    $allowed_type = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');
    $allowed = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
    // upload to local
    $upload_name = md5(microtime()).'.'.$file_extension;
    // $upload_path = BASEURL."images/".basename($upload_name);
    $email_path = BASEURL."images/".$_SESSION['email']."/";
    mkdir($email_path);
    $upload_path = $email_path.basename($upload_name);

    $db_path = "/etiendahan/images/".$_SESSION['email']."/".$upload_name;

    if(!in_array($_FILES['image']['type'], $allowed_type)) {
        header("location: /etiendahan/seller-centre/product/details/");
        echo '1';
        $_SESSION['cant-proceed-message'] = 'Upload a valid image type';
    } else if(!in_array($file_extension, $allowed)) {
        header("location: /etiendahan/seller-centre/product/details/");
        echo '2';
        $_SESSION['cant-proceed-message'] = 'The image must be a .png, .jpg, .jpeg, or .gif';
    } else if($image_size > 15000000) {
        header("location: /etiendahan/seller-centre/product/details/");
        echo '3';
        $_SESSION['cant-proceed-message'] = 'The image size must be under 15mb';
    } else {
        move_uploaded_file($tmp_location, $upload_path);

        // Escape all $_POST and $_SESSION variables to protect against SQL injections
        $name   		= $mysqli->escape_string($_POST['name']);
        $description    = $mysqli->escape_string($_POST['description']);
        $sub_id  		= $mysqli->escape_string($_POST['subCategory']);
        $price 			= $mysqli->escape_string($_POST['price']);
        $stock  		= $mysqli->escape_string($_POST['stock']);
        $id             = $mysqli->escape_string($_SESSION['product_details_id']);

        $sql = "UPDATE tbl_products SET name = '$name', description = '$description', sub_id = '$sub_id', price = '$price', stock = '$stock', image = '$db_path' WHERE id = '$id'";

        if ($mysqli->query($sql) or die($mysqli->error)) {
    		header("location: /etiendahan/seller-centre/product/details/");
        	$_SESSION['product-modified-message'] = 'Successfully Modified';

            // header("location: /etiendahan/"); 
        } else {
            // $_SESSION['message'] = 'Registration failed!';
            // header("location: /etiendahan/error/");
        }
    }
?>