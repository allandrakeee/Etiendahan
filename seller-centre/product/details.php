<?php  
	require '/../../db.php';
	session_start();

    // $cart_result = $mysqli->query("SELECT * FROM tbl_cart");
    // while($cart_row = mysqli_fetch_assoc($cart_result)):
    //     $product_result = $cart_row['product_id'];
    //     $product_result = $mysqli->query("SELECT * FROM tbl_products");
    //     while($product_row = mysqli_fetch_assoc($product_result)):
    //         // echo $product_row['banned'];
    //         $product_id_to_cart = $product_row['id'];
    //         // echo $product_id_to_cart;
    //         if($cart_row['quantity'] <= 0 && $product_row['stock'] >= 1):
    //             // echo 'asdtest';
    //             $sql1 = "UPDATE tbl_cart SET quantity = 1 WHERE product_id = '$product_id_to_cart'";
    //             $mysqli->query($sql1);
    //         endif;
    //     endwhile;
    // endwhile;

  	$email = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');

	$result_banned = $mysqli->query("SELECT * FROM tbl_sellers WHERE seller_email = '$email'");
	$row_banned = $result_banned->fetch_assoc();
	if($row_banned['banned'] == 1) {
		$_SESSION['logged_in'] = false;
	    $_SESSION['cant-proceed-message-banned'] = "Your seller account is banned! <a href='mailto:etiendahan@gmail.com' style='text-decoration: none' target='_blank'>Email</a> us for info.";
	    header('location: /etiendahan/seller-centre/account/signin/');
	    exit;
	}

	$logged_in  = ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
	$product_details_id = ((isset($_SESSION['product_details_id']) && $_SESSION['product_details_id'] != '')?htmlentities($_SESSION['product_details_id']):'');
	
	if($product_details_id == '') {
		$_SESSION['cant-proceed-message-product'] = "You must select product before viewing product details page";
		header("location: /etiendahan/seller-centre/product/list/all/");  
	}

	// Check if user is logged in using the session variable
	if ($logged_in == false) {
	$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your seller centre page";
	header("location: /etiendahan/seller-centre/account/signin/");    
	}
  
  	if ($logged_in == 1) {
    	// header("location: /etiendahan/seller-centre/");    
    	$email = $mysqli->escape_string($_SESSION['email']);
		$result = $mysqli->query("SELECT * FROM tbl_customers WHERE email='$email'");
		$user = $result->fetch_assoc();

		if ($user['seller_centre'] == 0) {
			$_SESSION['cant-proceed-message'] = "You must activate first your seller centre account";
            header("location: /etiendahan/seller-centre/account/activate/");
        }
  	}
	else {
	    // Makes it easier to read
	    $fullname 	= $_SESSION['fullname'];
	    $gender     = $_SESSION['gender'];
	    $email      = $_SESSION['email'];
	    $active     = $_SESSION['active'];
	    $birthday   = $_SESSION['birthday'];
	    $birthmonth = $_SESSION['birthmonth'];
	    $birthyear  = $_SESSION['birthyear'];

	}
	// echo $product_details_id;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product Details | Etiendahan Seller Centre</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">

	<!-- link inner -->
	<?php  
		include '../../header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="seller-centre-page" class="main-container">
		<div class="main-wrapper" id="product-details-page">
			<div class="main">
				<input type="hidden" id="hidden-input" name="my-hidden-input" value="<?php echo $product_details_id; ?>">
				
				<!-- SECTION 1 -->
				<div id="etiendahan-section-1" class="etiendahan-section">
					<!-- navbar -->
					<nav class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index shrink">
					  	<a class="navbar-brand" href="http://localhost:8080/etiendahan/seller-centre/">
							<img src="/etiendahan/temp-img/etiendahan-logo-seller-centre.png" width="178" height="58" class="d-inline-block align-top" alt="">
						</a>	

						<div class="ml-auto d-flex">
							<div class="nav-item right-nav dropdown" id="cart">
								<a class="nav-link" href="http://localhost:8080/etiendahan/" id="cart" role="button" aria-haspopup="true" aria-expanded="false">
									Etiendahan Homepage
								</a>
							</div>

							<div class="nav-item right-nav dropdown" id="user-account">
								<a href="/etiendahan/seller-centre/product/list/all/" class="nav-link" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user-circle pl-4 pr-4"></i>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<p>Howdie.</p>

									<a href="/etiendahan/seller-centre/product/list/all/"><div class="dropdown-item"><i class="fa fa-cubes fa-fw mr-2"></i>My Products</div></a>
									<a href="/etiendahan/seller-centre/sale/list/pending/"><div class="dropdown-item"><i class="fa fa-money fa-fw mr-2"></i>My Sales</div></a>
									<a href="/etiendahan/seller-centre/logout/"><div class="dropdown-item"><i class="fa fa-sign-out fa-fw mr-2"></i>Logout</div></a>
								</div>
							</div>
						</div>

						<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</nav>

					<nav class="breadcrumb-wrapper" aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/etiendahan/seller-centre/">Home</a></li>
							<li class="breadcrumb-item"><a href="/etiendahan/seller-centre/product/list/all/">My Products</a></li>
							<li class="breadcrumb-item active" aria-current="page">Product Details</li>
						</ol>
					</nav>
				</div>
				<!-- END OF SECTION 1 -->	

				<ul class="nav justify-content-center text-center">
					<li class="nav-item active">
						<a class="nav-link active" href="/etiendahan/seller-centre/product/details/">Edit Product</a>
					</li>
					<li class="nav-item">
						<?php  
							$ratings_result_count = $mysqli->query("SELECT COUNT(*) AS 'total' FROM tbl_ratings WHERE product_id = '$product_details_id'");
							$ratings_row_count = $ratings_result_count->fetch_assoc();
							$ratings_count = $ratings_row_count['total'];
						?>
						<a class="nav-link" href="/etiendahan/seller-centre/product/reviews/">Reviews (<?php echo $ratings_count; ?>)</a>
					</li>
				</ul>

				<div class="container products-action">
					<div class="row">
						<div class="col-md-12">
							<div class="product-wrapper p-4">
								<?php  
									$result_product_details = $mysqli->query("SELECT * FROM tbl_products WHERE id='$product_details_id'");
									$product_details = $result_product_details->fetch_assoc();

				                	$id 				= ((isset($_POST['id']) && $_POST['id'] != '')?htmlentities($_POST['id']): $product_details['id']);
									$name 		        = ((isset($_POST['name']) && $_POST['name'] != '')?htmlentities($_POST['name']): $product_details['name']);
									$description 		= ((isset($_POST['description']) && $_POST['description'] != '')?htmlentities($_POST['description']): $product_details['description']);
									$municipality_id 		= ((isset($_POST['municipality_id']) && $_POST['municipality_id'] != '')?htmlentities($_POST['municipality_id']): $product_details['municipality_id']);
									$category_id 		= ((isset($_POST['category_id']) && $_POST['category_id'] != '')?htmlentities($_POST['category_id']): $product_details['category_id']);
									$price 				= ((isset($_POST['price']) && $_POST['price'] != '')?htmlentities($_POST['price']): $product_details['price']);
									$stock 				= ((isset($_POST['stock']) && $_POST['stock'] != '')?htmlentities($_POST['stock']): $product_details['stock']);

								?>

								<form id="delete-form" class="delete-form" action="/etiendahan/c8NLPYLt-functions/product-delete-image-function/" method="POST">	
								</form>
								<form class="product-details" action="/etiendahan/c8NLPYLt-functions/product-details-function/" method="POST" enctype="multipart/form-data">
									<div class="form-wrapper mt-1">
										<div class="title">Edit Product Images</div>
										<div class="sub-title mb" data-toggle="tooltip" data-placement="right" title="Showcase your product by taking a photo against a white background with good lighting. Upload more product images to show different angles.">Tips for better selling product images</div>
																				
										<div class="row mt-3">
											<div class="col-md-2 text-center">
												<label for="file" class="label-for-upload-image"><div class="wrapper-inner"><i class="fa fa-plus"></i><div>Upload Image</div></div></label>
												<input type="file" class="form-control-file" id="file" style="visibility:hidden;" id="exampleFormControlFile1" name="file">
												<span id="uploaded_image" hidden></span>
											</div>

											<?php
												$imagei = 1;  
												$result_product_image = $mysqli->query("SELECT image FROM tbl_products WHERE id='$product_details_id'");
												while($product_row_image = mysqli_fetch_assoc($result_product_image)):
													$saved_image = explode(',', $product_row_image['image']);
													foreach ($saved_image as $saved):

														if($product_row_image['image'] != ''):
											?>
															<div class="col-md-2 text-center">
																<div class="saved-image" style="background: url(<?php echo $saved ?>);"></div>
																<button class="text-danger d-inline-block mb-1 delete-image" type="submit" form="delete-form" name="post_delete_image_id" value="<?php echo $imagei; ?>">Delete Image</button>
															</div>
													<?php else: ?>
															<div class="col-md-2 text-center">
																<div class="saved-image" style="background: url('http://via.placeholder.com/155x155?text=No+Image+Preview');"></div>
															</div>
													<?php endif; ?>
													<?php $imagei++; ?>
												<?php endforeach; ?>
											<?php endwhile; ?>											
										</div>
									</div>

									<div class="form-wrapper mt-5">
										<div class="title">Basic Information</div>

										<div class="form-group row">
											<label for="inputProductName" class="col-sm-2 col-form-label">Product Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="inputProductName" value="<?php echo $name ?>" name="name" required>
											</div>									
										</div>

										<div class="form-group row">
											<label for="inputProductDescription" class="col-sm-2 col-form-label">Product Description</label>
											<div class="col-sm-10">
												<textarea class="form-control" id="inputProductDescription" rows="10" maxlength="1500" name="description" required><?php echo $description ?></textarea>
											</div>	
										</div>

										<div class="form-group row">
											<label for="selectCategory" class="col-sm-2 col-form-label">Category</label>
											<div class="col-sm-10">
												<?php
													$result_categories = $mysqli->query("SELECT * FROM tbl_categories WHERE id = '$category_id'");
													$categories_row = $result_categories->fetch_assoc();
													$get_sub_category_id = $categories_row['id'];
													$result = $mysqli->query("SELECT * FROM tbl_categories ORDER BY name");
													echo "<select class='form-control' id='category' name='category' required>";
													echo "<option value=''>Select</option>";
													while($category = mysqli_fetch_assoc($result)){
														$category_id = $category['id'];
														$category_name = $category['name'];
												?>	
														<option value='<?php echo $category_id ?>' <?php if($get_sub_category_id == $category_id) echo 'selected'; ?>><?php echo $category_name ?></option>
												<?php } ?>
													</select>							
											</div>	
										</div>

										<div class="form-group row">
											<label for="selectCategory" class="col-sm-2 col-form-label">Province</label>
											<div class="col-sm-10">
												<?php
													$result_categories = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE id = '$municipality_id'");
													$categories_row = $result_categories->fetch_assoc();

													$get_sub_category_id = $categories_row['id'];

													$result = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE provCode = '0155' ORDER BY citymunDesc");
													echo "<select class='form-control' id='municipality' name='municipality' required>";
													echo "<option value=''>Select</option>";
													while($category = mysqli_fetch_assoc($result)){
														$category_id = $category['id'];
														$category_name = strtolower($category['citymunDesc']);
												?>	
														<option value='<?php echo $category_id ?>' <?php if($get_sub_category_id == $category_id) echo 'selected'; ?>><?php echo ucwords($category_name) ?></option>
												<?php } ?>
													</select>	
											</div>
										</div>
									</div>

									<div class="form-wrapper mt-5">
										<div class="title">Price and Inventory</div>
	
										<div class="form-group row">
											<label for="inputProductPrice" class="col-sm-2 col-form-label">Price</label>
											<div class="peso-sign">₱</div>
											<div class="col-sm-2 money">
											    <input type="text" class="form-control numberOnly" autocomplete="off" id="inputProductPrice" value="<?php echo $price ?>" name="price" required><div></div>
											</div>
										</div>

										<div class="form-group row">
											<label for="inputProductStock" class="col-sm-2 col-form-label">Stock</label>
											<div class="col-sm-10">
												<input type="number" class="form-control formatter" id="inputProductStock" value="<?php echo $stock ?>" name="stock" required>
											</div>	
										</div>
									</div>
									
									<div class="cancel-forgot-password product-details">
										<a href="/etiendahan/seller-centre/product/list/all/">Cancel</a>
									</div>	

									<div class="form-group row">
										<div class="col-sm-12 text-right">
											<button name="button_modify" class="btn btn-primary" type="submit">Modify</button>
										</div>
									</div>									
								</form>

								<form class="delete-form" action="/etiendahan/c8NLPYLt-functions/product-details-delete-function/" method="POST">	
									<button name="button_delete" class="btn btn-primary delete" type="submit">Delete</button>
								</form>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="footer mb-3">
								<div class="site-image" style="background-image: url(/etiendahan/temp-img/logo-seller-centre.png);"></div>
								<div class="site-centre">Etiendahan Seller Centre</div>
								<div class="site-version">Current Version: 1.0.0</div>
							</div>
						</div>
					</div>
				</div>	

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-primary"></i>Complete!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['product-modified-message']) ) {
								echo $_SESSION['product-modified-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['product-modified-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->	

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-primary"></i>Complete!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['product-added-message']) ) {
								echo $_SESSION['product-added-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['product-added-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification-logout-redirect" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-times-circle mr-1 alert-danger"></i>Can't proceed!</div>
					<div class="popup-content-logout-redirect text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['cant-proceed-message']) ) {
								echo $_SESSION['cant-proceed-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['cant-proceed-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->		
			</div>
		</div>
	</div>	

<!-- footer inner -->
<!-- Development - Normal import of theme.js -->
<script src="/etiendahan/assets/js/theme.js"></script>
<script>
	jQuery('document').ready(function(){
		get_child_options('<?php echo $sub_id ?>');
	});
</script>

<!-- Development - Minifies import of theme.js -->
<!-- <script src="/etiendahan/assets/js/theme.min.js"></script> -->

<!-- Production - Normal import of theme.js -->
<!-- <script src="/assets/js/theme.js"></script> -->

<!-- Production - Minified import of theme.js -->
<!-- <script src="/assets/js/theme.min.js"></script> -->
</html>