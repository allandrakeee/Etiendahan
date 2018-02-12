<?php
	require '/../db.php';
	session_start();

	// IF EMPTY AND PRODUCT DETAIL HAVE VALUE SHOW THE SUB CATEGORY ID AND PARENT ID IN SUB CATEGORY DROPDOWN LIST
	$citymun_id = ((isset($_POST['citymun_id']) && $_POST['citymun_id'] != '')?htmlentities($_POST['citymun_id']): '');
	$selected = ((isset($_POST['selected']) && $_POST['selected'] != '')?htmlentities($_POST['selected']): '');
	$result1 = $mysqli->query("SELECT * FROM tbl_refbrgy WHERE citymunCode = '$citymun_id' ORDER BY brgyDesc");
	
	ob_start();
?>
	<!-- getting the category parent and the child -->	
	<option value="">Barangay</option>
	<?php while($sub1 = mysqli_fetch_assoc($result1)) : ?>
		<?php $format_barangay = strtolower($sub1['brgyDesc']); ?>
		<option value='<?php echo $sub1['brgyCode'] ?>' <?php if($selected == $sub1['brgyCode']) echo 'selected'; ?>><?php echo ucwords($format_barangay); ?></option>
	<?php endwhile; ?>

<?php echo ob_get_clean(); ?>