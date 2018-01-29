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

	if($_POST['wishlists_cart'] != '') {
		$_SESSION['wishlists_cart'] = $_POST['wishlists_cart'];
	}

	if($_POST['add_to_cart_product_id'] != '') {
		$_SESSION['add_to_cart_product_id'] = $_POST['add_to_cart_product_id'];
	}

	if($_POST['input_quantity'] != '') {
		$_SESSION['input_quantity'] = $_POST['input_quantity'];
	}

	if($_POST['rating_value'] != '') {
		$_SESSION['rating_value'] = $_POST['rating_value'];
	}

	if($_POST['cart_product_id_delete'] != '') {
		$_SESSION['cart_product_id_delete'] = $_POST['cart_product_id_delete'];
	}

	if($_POST['slide_id'] != '') {
		$_SESSION['slide_id'] = $_POST['slide_id'];
	}

	if($_POST['parent_category_id'] != '') {
		$_SESSION['parent_category_id'] = $_POST['parent_category_id'];
	}

	if($_POST['delete_sub_category'] != '') {
		$_SESSION['delete_sub_category'] = $_POST['delete_sub_category'];
	}

	if($_POST['banned_customer_id'] != '') {
		$_SESSION['banned_customer_id'] = $_POST['banned_customer_id'];
	}

	// modify quantity in cart
	if($_POST['cart_id'] != '') {
		$_SESSION['cart_id'] = $_POST['cart_id'];
	}

	if($_POST['input_quantity_cart'] != '') {
		$_SESSION['input_quantity_cart'] = $_POST['input_quantity_cart'];
	}

	$cart_id = $_SESSION['cart_id'];
	$input_quantity_cart = $_SESSION['input_quantity_cart'];

 //    $cart_result = $mysqli->query("SELECT * FROM tbl_cart WHERE id = '$cart_id'");
	// $cart_row = $cart_result->fetch_assoc();
	// $product_id =  $cart_row['product_id'];

 //    $product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$product_id'");
	// $product_row = $product_result->fetch_assoc();
	// $product_price = $product_row['price'];
	
    $sql = "UPDATE tbl_cart SET quantity = '$input_quantity_cart' WHERE id = '$cart_id'";
	$mysqli->query($sql);
	unset($_SESSION['cart_id']);
	unset($_SESSION['input_quantity_cart']);

	// end of modify quantity in cart



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