<?php  
    require '../../../db.php';
    session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

    echo $sic_id = $_SESSION['action_sic'];
    // die();
    $slides_result_delete = $mysqli->query("SELECT * FROM tbl_sic_product");
    $slides_result = $mysqli->query("SELECT * FROM tbl_sic_product WHERE id = '$sic_id'");

    $slides_row = $slides_result->fetch_assoc();
    $slides_row['image'];

    $image_url = $_SERVER['DOCUMENT_ROOT'].$slides_row['image'];
    unlink($image_url);
    $admin_path = BASEURL.'images/administrator/';
    (count(glob("$admin_path/*")) === 0) ? rmdir($admin_path) : 'Not empty';

    $sql = "DELETE FROM tbl_sic_product WHERE id = '$sic_id'";
    $mysqli->query($sql);
    $_SESSION['delete-product'] = "Successfully Deleted.";
    header('location: /etiendahan/ed-admin/restricted/specialty-in-city/');
?>