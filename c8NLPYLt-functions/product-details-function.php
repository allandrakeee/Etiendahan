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

    // $product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$id'");
    // $product_row = $product_result->fetch_assoc();
    // echo $product_row['stock'];
    
    $cart_result = $mysqli->query("SELECT * FROM tbl_cart WHERE product_id = '$id'");
    while($cart_row = mysqli_fetch_assoc($cart_result)) {
        echo $cart_row['quantity'];
        if($stock < $cart_row['quantity']) {
            $cart_quantity = $cart_row['quantity'];
            // echo 'less than '.$cart_row['quantity'];
            $sql = "UPDATE tbl_cart SET quantity = '$stock' WHERE quantity = '$cart_quantity' AND product_id = '$id'";
            $mysqli->query($sql);
        }
    }

    $sql = "UPDATE tbl_products SET name = '$name', description = '$description', sub_id = '$sub_id', price = '$price', stock = '$stock' WHERE id = '$id'";
    if ($mysqli->query($sql) or die($mysqli->error)) {
        header("location: /etiendahan/seller-centre/product/details/");
        $_SESSION['product-modified-message'] = 'Successfully Modified.';
        // header("location: /etiendahan/"); 
    } else {
        // $_SESSION['message'] = 'Registration failed!';
        // header("location: /etiendahan/error/");
    }
?>