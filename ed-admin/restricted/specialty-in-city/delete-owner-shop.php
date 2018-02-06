<?php  
    require '../../../db.php';
    session_start();
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/etiendahan/');

    echo $sic_id = $_SESSION['action_sic'];

    $slides_result_delete = $mysqli->query("SELECT * FROM tbl_sic_owner");
    $slides_result = $mysqli->query("SELECT * FROM tbl_sic_owner WHERE id = '$sic_id'");

    $slides_row = $slides_result->fetch_assoc();
    $slides_row['image'];

    $image_url = $_SERVER['DOCUMENT_ROOT'].$slides_row['image'];
    unlink($image_url);
    $admin_path = BASEURL.'images/administrator/';
    (count(glob("$admin_path/*")) === 0) ? rmdir($admin_path) : 'Not empty';

    $sql = "DELETE FROM tbl_sic_owner WHERE id = '$sic_id'";
    $mysqli->query($sql);

    $while_delete_sic_product = $mysqli->query("SELECT * FROM tbl_sic_product WHERE owner_id = '$sic_id'");
    while($sic_row = mysqli_fetch_assoc($while_delete_sic_product)):
        $sic_row['image'];

        $image_url = $_SERVER['DOCUMENT_ROOT'].$sic_row['image'];
        unlink($image_url);
        $admin_path = BASEURL.'images/administrator/';
        (count(glob("$admin_path/*")) === 0) ? rmdir($admin_path) : 'Not empty';

        $sql = "DELETE FROM tbl_sic_product WHERE owner_id = '$sic_id'";
        $mysqli->query($sql);
    endwhile;




    $_SESSION['delete-product'] = "Successfully Deleted.";
    header('location: /etiendahan/ed-admin/restricted/specialty-in-city/');
?>