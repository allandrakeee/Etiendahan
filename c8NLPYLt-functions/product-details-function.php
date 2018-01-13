<?php  
    require '/../db.php';
    session_start();

    // Escape all $_POST and $_SESSION variables to protect against SQL injections
    $name           = $mysqli->escape_string($_POST['name']);
    $description    = $mysqli->escape_string($_POST['description']);
    $sub_id         = $mysqli->escape_string($_POST['subCategory']);
    $price          = $mysqli->escape_string($_POST['price']);
    $stock          = $mysqli->escape_string($_POST['stock']);
    $id             = $mysqli->escape_string($_SESSION['product_details_id']);

    $sql = "UPDATE tbl_products SET name = '$name', description = '$description', sub_id = '$sub_id', price = '$price', stock = '$stock' WHERE id = '$id'";
    if ($mysqli->query($sql) or die($mysqli->error)) {
        header("location: /etiendahan/seller-centre/product/details/");
        $_SESSION['product-modified-message'] = 'Successfully Modified';
        // header("location: /etiendahan/"); 
    } else {
        // $_SESSION['message'] = 'Registration failed!';
        // header("location: /etiendahan/error/");
    }
?>