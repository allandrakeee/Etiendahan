<?php  
	require '/../../db.php';
	session_start();
	
	$name 				= ((isset($_POST['name']) && $_POST['name'] != '')?htmlentities($_POST['name']):'');
	$description 		= ((isset($_POST['description']) && $_POST['description'] != '')?htmlentities($_POST['description']):'');
	$category_post 		= ((isset($_POST['category']) && $_POST['category'] != '')?htmlentities($_POST['category']):'');
	$subCategory_post 	= ((isset($_POST['subCategory']) && $_POST['subCategory'] != '')?htmlentities($_POST['subCategory']):'');
	$price 				= ((isset($_POST['price']) && $_POST['price'] != '')?htmlentities($_POST['price']):'');
	$stock 				= ((isset($_POST['stock']) && $_POST['stock'] != '')?htmlentities($_POST['stock']):'1');
  	$logged_in  		= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add a new Product - Etiendahan Seller Centre</title>
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
		<div class="main-wrapper">
			<div class="main">
				
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
							<li class="breadcrumb-item active" aria-current="page">New Product</li>
						</ol>
					</nav>
				</div>
				<!-- END OF SECTION 1 -->	

				<div class="container products-action">
					<div class="row">
						<div class="col-md-12">
							<div class="product-wrapper p-4">	
								<form action="/etiendahan/c8NLPYLt-functions/new-product-function/" method="POST">			
									<div class="form-wrapper mt-1">
										<div class="title">Edit Product Images</div>
										<div class="sub-title mb" data-toggle="tooltip" data-placement="right" title="Showcase your product by taking a photo against a white background with good lighting. Upload more product images to show different angles.">Tips for better selling product images</div>
										
										<div class="form-group row mt-2">
											<div class="col-sm-12">
												<input type="file" class="form-control-file" id="exampleFormControlFile1">
											</div>
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
												<textarea class="form-control" id="inputProductDescription" rows="10" maxlength="1500" name="description" required=""><?php echo $description ?></textarea>
											</div>	
										</div>

										<div class="form-group row">
											<label for="selectCategory" class="col-sm-2 col-form-label">Category</label>
											<div class="col-sm-5">
												<?php
													// $category_id;
													// $category_name;
													$result = $mysqli->query("SELECT * FROM tbl_categories ORDER BY name");
												?>	
													<select class='form-control' id='category' name='category' required>"
														<option value=''>Parent Category</option>"
												<?php  
													while($category = mysqli_fetch_assoc($result)){
														$category_id = $category['id'];
														$category_name = $category['name'];
												?>
														<option value='<?php echo $category_id?>' <?php if($category_post == $category_id) echo 'selected'; ?>><?php echo $category_name?></option>
												<?php 
													}
												 ?>
													</select>
																						
											</div>	
											<div class="col-sm-5">
												<select class='form-control' id='sub-category' name='subCategory' required>	
													<option value=''>Sub Category</option>
												</select>				
											</div>
										</div>
									</div>

									<div class="form-wrapper mt-5">
										<div class="title">Price and Inventory</div>

										<div class="form-group row">
											<label for="inputProductPrice" class="col-sm-2 col-form-label">Price</label>
											<div class="peso-sign">₱</div>
											<div class="col-sm-2">
												<input type="number" class="form-control" id="inputProductPrice" pattern="[0-9]*" value="<?php echo $price ?>" name="price" required>
												<!-- <input type="text" class="form-control formatter" id="inputProductPrice"> -->
											</div>									
										</div>

										<div class="form-group row">
											<label for="inputProductStock" class="col-sm-2 col-form-label">Stock</label>
											<div class="col-sm-10">
												<input type="number" class="form-control formatter" id="inputProductStock" value="<?php echo $stock ?>" name="stock" required>
											</div>	
										</div>
									</div>
									
									<div class="cancel-forgot-password">
										<a href="/etiendahan/seller-centre/product/list/all/">Cancel</a>
									</div>	

									<div class="form-group row">
										<div class="col-sm-12 text-right">
											<button class="btn btn-primary" type="submit" name="button_save" >Save</button>
										</div>
									</div>	
								</form>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="footer mb-3">
								<div class="site-image" style="background-image: url(/etiendahan/temp-img/logo-seller-centre.png);"></div>
								<div class="site-centre">Etiendahan Seller Centre</div>
								<div class="site-version">Current Version: beta test</div>
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
							if ( isset($_SESSION['product-added-message']) ) {
								echo $_SESSION['product-added-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['product-added-message'] );
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
		get_child_options('<?php echo $subCategory_post ?>');
	});
</script>

<!-- Development - Minifies import of theme.js -->
<!-- <script src="/etiendahan/assets/js/theme.min.js"></script> -->

<!-- Production - Normal import of theme.js -->
<!-- <script src="/assets/js/theme.js"></script> -->

<!-- Production - Minified import of theme.js -->
<!-- <script src="/assets/js/theme.min.js"></script> -->
</html>