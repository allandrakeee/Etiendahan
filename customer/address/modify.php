<?php  
	require '../../db.php';
	session_start();

  	echo $address_id 				= ((isset($_SESSION['address_id']) && $_SESSION['address_id'] != '')?htmlentities($_SESSION['address_id']):'');
  	echo $fullname_modify 			= ((isset($_SESSION['fullname_modify']) && $_SESSION['fullname_modify'] != '')?htmlentities($_SESSION['fullname_modify']):'');
  	echo $phone_number_modify 		= ((isset($_SESSION['phone_number_modify']) && $_SESSION['phone_number_modify'] != '')?htmlentities($_SESSION['phone_number_modify']):'');
  	echo $postal_code_modify 		= ((isset($_SESSION['postal_code_modify']) && $_SESSION['postal_code_modify'] != '')?htmlentities($_SESSION['postal_code_modify']):'');
  	echo $province_modify 			= ((isset($_SESSION['province_modify']) && $_SESSION['province_modify'] != '')?htmlentities($_SESSION['province_modify']):'');
  	echo $city_modify 				= ((isset($_SESSION['city_modify']) && $_SESSION['city_modify'] != '')?htmlentities($_SESSION['city_modify']):'');
  	echo $barangay_modify 			= ((isset($_SESSION['barangay_modify']) && $_SESSION['barangay_modify'] != '')?htmlentities($_SESSION['barangay_modify']):'');
  	echo $complete_address_modify 	= ((isset($_SESSION['complete_address_modify']) && $_SESSION['complete_address_modify'] != '')?htmlentities($_SESSION['complete_address_modify']):'');
  	echo $other_notes_modify 		= ((isset($_SESSION['other_notes_modify']) && $_SESSION['other_notes_modify'] != '')?htmlentities($_SESSION['other_notes_modify']):'');

    $mysqli->query("UPDATE tbl_address SET fullname = '$fullname_modify', phone_number = '$phone_number_modify', postal_code = '$postal_code_modify', province = '$province_modify', city = '$city_modify', barangay = '$barangay_modify', complete_address = '$complete_address_modify', other_notes = '$other_notes_modify' WHERE id = '$address_id'") or die($mysqli->error);
    header('location: /etiendahan/customer/address/');
?>