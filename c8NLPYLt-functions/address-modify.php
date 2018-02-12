<?php
	require '/../db.php';
	session_start();

	if($_POST['address_id'] != '') {
		$_SESSION['address_id'] = $_POST['address_id'];
	}

	if($_POST['fullname_modify'] != '') {
		$_SESSION['fullname_modify'] = $_POST['fullname_modify'];
	}

	if($_POST['phone_number_modify'] != '') {
		echo $_SESSION['phone_number_modify'] = $_POST['phone_number_modify'];
	}

	if($_POST['postal_code_modify'] != '') {
		echo $_SESSION['postal_code_modify'] = $_POST['postal_code_modify'];
	}

	if($_POST['province_modify'] != '') {
		echo $_SESSION['province_modify'] = $_POST['province_modify'];
	}

	if($_POST['city_modify'] != '') {
		echo $_SESSION['city_modify'] = $_POST['city_modify'];
	}

	if($_POST['barangay_modify'] != '') {
		echo $_SESSION['barangay_modify'] = $_POST['barangay_modify'];
	}

	if($_POST['complete_address_modify'] != '') {
		echo $_SESSION['complete_address_modify'] = $_POST['complete_address_modify'];
	}

	if($_POST['other_notes_modify'] != '') {
		echo $_SESSION['other_notes_modify'] = $_POST['other_notes_modify'];
	}
?>