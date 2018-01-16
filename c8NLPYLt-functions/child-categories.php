<?php
	require '/../db.php';
	session_start();

	if($_POST['product_details_id'] != '') {
		$_SESSION['product_details_id'] = $_POST['product_details_id'];
	}

	if($_POST['category_id'] != '') {
		$_SESSION['category_id'] = $_POST['category_id'];
	}

	if($_POST['sub_category_id'] != '') {
		$_SESSION['sub_category_id'] = $_POST['sub_category_id'];
	}

	if($_POST['category_product_id'] != '') {
		$_SESSION['category_product_id'] = $_POST['category_product_id'];
	}

	if($_POST['category_product_id_sightings'] != '') {
		$_SESSION['category_product_id_sightings'] = $_POST['category_product_id_sightings'];
	}

	if($_POST['seller_shop_email'] != '') {
		$_SESSION['seller_shop_email'] = $_POST['seller_shop_email'];
	}

	if($_POST['sub_category_name'] != '') {
		$_SESSION['sub_category_name'] = $_POST['sub_category_name'];
	}

	if($_POST['post_page'] != '') {
		$_SESSION['post_page'] = $_POST['post_page'];
	}

	if($_POST['address_delete'] != '') {
		$_SESSION['address_delete'] = $_POST['address_delete'];
	}

	if($_POST['address_update'] != '') {
		$_SESSION['address_update'] = $_POST['address_update'];
	}

	if($_POST['wishlists_delete'] != '') {
		$_SESSION['wishlists_delete'] = $_POST['wishlists_delete'];
	}

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