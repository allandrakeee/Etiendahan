<?php
	require '/../db.php';
	session_start();

	// IF EMPTY AND PRODUCT DETAIL HAVE VALUE SHOW THE SUB CATEGORY ID AND PARENT ID IN SUB CATEGORY DROPDOWN LIST
	$province_id = ((isset($_POST['province_id']) && $_POST['province_id'] != '')?htmlentities($_POST['province_id']): '');
	$selected = ((isset($_POST['selected']) && $_POST['selected'] != '')?htmlentities($_POST['selected']): '');
	$result1 = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE provCode = '$province_id' ORDER BY citymunDesc");
	
	ob_start();
?>
	<!-- getting the category parent and the child -->	
	<option value="">City</option>
	<?php while($sub1 = mysqli_fetch_assoc($result1)) : ?>
		<?php $format_citymun = strtolower($sub1['citymunDesc']); ?>
		<option value='<?php echo $sub1['citymunCode'] ?>' <?php if($selected == $sub1['citymunCode']) echo 'selected'; ?>><?php echo ucwords($format_citymun); ?></option>
	<?php endwhile; ?>

<?php echo ob_get_clean(); ?>