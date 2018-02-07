<?php  
	require '/../../db.php';
	session_start();
  	
  	$email = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');

	$result_banned = $mysqli->query("SELECT * FROM tbl_customers WHERE email = '$email'");
	$row_banned = $result_banned->fetch_assoc();
	if($row_banned['banned'] == 1) {
		$_SESSION['email'] = false;
		$_SESSION['logged_in'] = false;
	    $_SESSION['cant-proceed-message-banned'] = "Your customer account is banned! <a href='mailto:etiendahan@gmail.com' style='text-decoration: none' target='_blank'>Email</a> us for info.";
	    header('location: /etiendahan/customer/account/login/');
	    exit;
	}

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	// Check if user is logged in using the session variable
	if ( $logged_in == false ) {
		$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your profile page.";
		header("location: /etiendahan/customer/account/login/");    
	}
	else {
	    // Makes it easier to read
	    // $fullname 	= $_SESSION['fullname'];
	    // $gender     = $_SESSION['gender'];
	    // $email      = $_SESSION['email'];
	    // $active     = $_SESSION['active'];
	    // $birthday   = $_SESSION['birthday'];
	    // $birthmonth = $_SESSION['birthmonth'];
	    // $birthyear  = $_SESSION['birthyear'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Orders | Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">
	
	<!-- link inner -->
	<?php  
		include '../../header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="orders-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include '../../header.php';
				?>

				<!-- CUSTOMER PAGE SECTION 1 -->
				<div id="etiendahan-customer-page-section-1">
					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<div id="accordion" role="tablist">
									<div class="card">
										<div class="card-header" role="tab" id="headingOne">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/account/profile/">			
												Personal Information
												</a>
											</h5>
										</div>

										<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
											<div class="card-body personal-info">
												<ul>
													<li class="active"><a href="/etiendahan/customer/account/profile/">Profile</a></li>
													<li><a href="">Change Password</a></li>												</ul>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-header active" role="tab" id="headingTwo">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/orders/">
												Orders
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingThree">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/wishlists/">
												Wishlists
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingFour">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/address/">
												Address Book
												</a>
											</h5>
										</div>
									</div>
								</div>
							</div>

							<div id="prevent-not-to-scroll" class="col-md-8">
								<div class="tab-content"><h1>Your Orders</h1></div>

								<!-- If orders is empty -->
								<!-- <p>You haven't placed any orders yet.</p> -->

								<!-- If wishlists is not empty -->

								<!-- first row -->
								<div id="order-header" class="row">
									<div class="col-md-5">
										<div class="order-number">
											Order <a href="/etiendahan/customer/orders/view/">#123456</a>
										</div>
										<div class="order-place-date">
											Placed on 28/11/2017
										</div>
									</div>
									<div class="col-md-7 text-right">
										<div class="order-manage">
											<a href="/etiendahan/customer/orders/view/">Manage order</a>
										</div>
									</div>
								</div>
								<div id="order-content" class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<div class="item-product">
													<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner">
														<div class="item-image">
															<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/eac2fa33b6bdb1d743e4ff218aa105eb_tn);"></div>
														</div>
													</a>
												</div>
											</div>
											<div class="col-md-8">
												<div class="item-name">
													<a href="/etiendahan/customer/orders/view/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
												</div>
												
												<div class="item-status">
													<a href="/etiendahan/customer/orders/view/">Processing</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<div class="item-product">
													<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner">
														<div class="item-image">
															<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/5ac1b1122075d8305d7a1349bc3d1c30_tn);"></div>
														</div>
													</a>
												</div>
											</div>
											<div class="col-md-8">
												<div class="item-name">
													<a href="/etiendahan/customer/orders/view/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
												</div>
												
												<div class="item-status">
													<a href="/etiendahan/customer/orders/view/">Processing</a>
												</div>
											</div>
										</div>
									</div>
									<div class="separator"></div>
								</div>

								<!-- second row -->
								<div id="order-header" class="row">
									<div class="col-md-5">
										<div class="order-number">
											Order <a href="/etiendahan/customer/orders/view/">#123456</a>
										</div>
										<div class="order-place-date">
											Placed on 28/11/2017
										</div>
									</div>
									<div class="col-md-7 text-right">
										<div class="order-manage">
											<a href="/etiendahan/customer/orders/view/">Manage order</a>
										</div>
									</div>
								</div>
								<div id="order-content" class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<div class="item-product">
													<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner">
														<div class="item-image">
															<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/094a04b65c85439eeb96f8cfa54ed86b_tn);"></div>
														</div>
													</a>
												</div>
											</div>
											<div class="col-md-8">
												<div class="item-name">
													<a href="/etiendahan/customer/orders/view/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
												</div>
												
												<div class="item-status">
													<a href="/etiendahan/customer/orders/view/">Processing</a>
												</div>
											</div>
										</div>
									</div>
									<div class="separator"></div>
								</div>

								<!-- third row -->
								<div id="order-header" class="row">
									<div class="col-md-5">
										<div class="order-number">
											Order <a href="/etiendahan/customer/orders/view/">#123456</a>
										</div>
										<div class="order-place-date">
											Placed on 28/11/2017
										</div>
									</div>
									<div class="col-md-7 text-right">
										<div class="order-manage">
											<a href="/etiendahan/customer/orders/view/">Manage order</a>
										</div>
									</div>
								</div>
								<div id="order-content" class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<div class="item-product">
													<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner">
														<div class="item-image">
															<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/74268199fec22c7a27e665d4b2d1e736_tn);"></div>
														</div>
													</a>
												</div>
											</div>
											<div class="col-md-8">
												<div class="item-name">
													<a href="/etiendahan/customer/orders/view/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
												</div>
												
												<div class="item-status">
													<a href="/etiendahan/customer/orders/view/">Delivered</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<div class="item-product">
													<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner">
														<div class="item-image">
															<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/6ccef14930bf42a32f7d3580efa69a63_tn);"></div>
														</div>
													</a>
												</div>
											</div>
											<div class="col-md-8">
												<div class="item-name">
													<a href="/etiendahan/customer/orders/view/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
												</div>
												
												<div class="item-status">
													<a href="/etiendahan/customer/orders/view/">Closed</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-4">
												<div class="item-product">
													<a href="/etiendahan/customer/orders/view/" class="d-block my-item-product-inner">
														<div class="item-image">
															<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/0511730fd313e860523e495f0f568b4d_tn);"></div>
														</div>
													</a>
												</div>
											</div>
											<div class="col-md-8">
												<div class="item-name">
													<a href="/etiendahan/customer/orders/view/">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
												</div>
												
												<div class="item-status">
													<a href="/etiendahan/customer/orders/view/">Closed</a>
												</div>
											</div>
										</div>
									</div>
									<div class="separator"></div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<!-- END OF CUSTOMER PAGE SECTION 1 -->

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>