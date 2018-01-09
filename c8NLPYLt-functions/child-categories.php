<?php
	require '/../db.php';
	session_start();

	$product_id = ((isset($_POST['product_details_id']) && $_POST['product_details_id'] != '')?htmlentities($_POST['product_details_id']):'');
	$_SESSION['product_details_id'] = $product_id;

	// IF EMPTY AND PRODUCT DETAIL HAVE VALUE SHOW THE SUB CATEGORY ID AND PARENT ID IN SUB CATEGORY DROPDOWN LIST
	$parent_id = ((isset($_POST['parent_id']) && $_POST['parent_id'] != '')?htmlentities($_POST['parent_id']): '');
	$selected = ((isset($_POST['selected']) && $_POST['selected'] != '')?htmlentities($_POST['selected']): '');
	$result = $mysqli->query("SELECT * FROM tbl_categories_sub WHERE parent_id = '$parent_id'");
	$subCategory_post = ((isset($_POST['subCategory']) && $_POST['subCategory'] != '')?htmlentities($_POST['subCategory']):'');
	
	ob_start();
?>
	<!-- getting the category parent and the child -->	
	<option value="">Sub Category</option>
	<?php while($sub = mysqli_fetch_assoc($result)) : ?>
		<option value='<?php echo $sub['id'] ?>' <?php if($selected == $sub['id']) echo 'selected'; ?>><?php echo $sub['name'] ?></option>
	<?php endwhile; ?>

<?php echo ob_get_clean(); ?>