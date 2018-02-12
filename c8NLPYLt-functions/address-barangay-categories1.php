<?php
	require '/../db.php';
	session_start();

	// IF EMPTY AND PRODUCT DETAIL HAVE VALUE SHOW THE SUB CATEGORY ID AND PARENT ID IN SUB CATEGORY DROPDOWN LIST
	$address_update = ((isset($_POST['address_update']) && $_POST['address_update'] != '')?htmlentities($_POST['address_update']): '');
	$citymun_id = ((isset($_POST['citymun_id']) && $_POST['citymun_id'] != '')?htmlentities($_POST['citymun_id']): '');
	$selected = ((isset($_POST['selected']) && $_POST['selected'] != '')?htmlentities($_POST['selected']): '');
	
	$result_city = $mysqli->query("SELECT * FROM tbl_address WHERE id = '$address_update'");
	$row_city = $result_city->fetch_assoc();
	$row_city_id = $row_city['city'];
	$row_barangay_id = $row_city['barangay'];

	echo $citymun_id;

	if($citymun_id == '') {
		$result1 = $mysqli->query("SELECT * FROM tbl_refbrgy WHERE citymunCode = '$row_city_id' ORDER BY brgyDesc");
	} else {
		$result1 = $mysqli->query("SELECT * FROM tbl_refbrgy WHERE citymunCode = '$citymun_id' ORDER BY brgyDesc");
	}

	ob_start();
?>
	<!-- getting the category parent and the child -->	
	<option value="">Barangay</option>
	<?php while($sub1 = mysqli_fetch_assoc($result1)) : ?>
		<?php $format_barangay = strtolower($sub1['brgyDesc']); ?>
		<option value='<?php echo $sub1['brgyCode'] ?>' <?php if($row_barangay_id == $sub1['brgyCode']) echo 'selected'; ?>><?php echo ucwords($format_barangay); ?></option>
	<?php endwhile; ?>

<?php echo ob_get_clean(); ?>