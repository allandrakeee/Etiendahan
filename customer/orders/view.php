<!DOCTYPE html>
<html>
<head>
	<title>View Order #123456 - Etiendahan Pangasinan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">
	
	<!-- link inner -->
	<?php  
		include '../../header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="order-view-page" class="main-container">
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
								<div class="tab-content"><h1>View Order #123456</h1></div>

								<!-- first row -->
								<div id="order-header-view" class="row">
									<div class="col-md-4">
										<div class="order-number">
											Order #123456
										</div>
									</div>
									<div class="col-md-4 text-center">
										<div class="order-place-date">
											Placed on 28/11/2017
										</div>
									</div>
									<div class="col-md-4 text-right">
										<div class="order-total">
											Total: ₱3,000.00
										</div>
									</div>
								</div>

								<div class="order-wrapper-content mt-3">
									<div id="order-header-view-package-seller" class="row">
										<div class="col-md-6 text-left"><i class="fa fa-cube fa-fw"></i><span>Package 1</span></div>
										<div class="col-md-6 text-right">
											<span>John Doe</span>
											<a href="">
												<button class="btn btn-primary">view shop</button>
											</a>
												
										</div>
									</div>

									<div id="order-delivery-shipping" class="row">
										<div class="col-md-12">
											<div class="order-delivery-shipping-name">
												<i class="fa fa-truck fa-fw"></i>Standard Shipping
											</div>
											<div class="order-delivery-shipping-date">
												01/12/2017
											</div>
										</div>
									</div>

									<div id="order-delivery-status" class="row">
										<div class="col-md-12">

												<!-- processing -->
												<div class="progress">
										        	<div class="one"></div><div class="two no-color"></div><div class="three no-color"></div>
										  			<div class="progress-bar" style="width: 0;"></div>
												</div>

												<!-- shipped -->
												<!-- <div class="progress">
										        	<div class="one"></div><div class="two"></div><div class="three no-color"></div>
										  			<div class="progress-bar" style="width: 50%;"></div>
												</div> -->

												<!-- delivered -->
												<!-- <div class="progress">
										        	<div class="one"></div><div class="two"></div><div class="three"></div>
										  			<div class="progress-bar" style="width: 100%;"></div>
												</div> -->

												<div class="processing-text">Processing</div>
												<div class="shipped-text">Shipped</div>
												<div class="delivered-text">Delivered</div>
										</div>
									</div>

									<div id="order-delivery-content" class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-2">
													<div class="item-product">
														<a href="" class="d-block my-item-product-inner">
															<div class="item-image">
																<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/094a04b65c85439eeb96f8cfa54ed86b_tn);"></div>
															</div>
														</a>
													</div>
												</div>
												<div class="col-md-6">
													<div class="item-name">
														<a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
													</div>
												</div>

												<div class="col-md-2">
													<div class="item-price">
														₱1,000.00
													</div>
												</div>

												<div class="col-md-2">
													<div class="item-quantity">
														x1
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="order-wrapper-content mt-3">
									<div id="order-header-view-package-seller" class="row">
										<div class="col-md-6 text-left"><i class="fa fa-cube fa-fw"></i><span>Package 2</span></div>
										<div class="col-md-6 text-right">
											<span>John Doe</span>
											<a href="">
												<button class="btn btn-primary">view shop</button>
											</a>
												
										</div>
									</div>

									<div id="order-delivery-shipping" class="row">
										<div class="col-md-12">
											<div class="order-delivery-shipping-name">
												<i class="fa fa-truck fa-fw"></i>Standard Shipping
											</div>
											<div class="order-delivery-shipping-date">
												01/12/2017
											</div>
										</div>
									</div>

									<div id="order-delivery-status" class="row">
										<div class="col-md-12">

												<!-- processing -->
												<!-- <div class="progress">
										        	<div class="one"></div><div class="two no-color"></div><div class="three no-color"></div>
										  			<div class="progress-bar" style="width: 0;"></div>
												</div> -->

												<!-- shipped -->
												<div class="progress">
										        	<div class="one"></div><div class="two"></div><div class="three no-color"></div>
										  			<div class="progress-bar" style="width: 50%;"></div>
												</div>

												<!-- delivered -->
												<!-- <div class="progress">
										        	<div class="one"></div><div class="two"></div><div class="three"></div>
										  			<div class="progress-bar" style="width: 100%;"></div>
												</div> -->

												<div class="processing-text">Processing</div>
												<div class="shipped-text">Shipped</div>
												<div class="delivered-text">Delivered</div>
										</div>
									</div>

									<div id="order-delivery-content" class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-2">
													<div class="item-product">
														<a href="" class="d-block my-item-product-inner">
															<div class="item-image">
																<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/74268199fec22c7a27e665d4b2d1e736_tn);"></div>
															</div>
														</a>
													</div>
												</div>
												<div class="col-md-6">
													<div class="item-name">
														<a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
													</div>
												</div>

												<div class="col-md-2">
													<div class="item-price">
														₱1,000.00
													</div>
												</div>

												<div class="col-md-2">
													<div class="item-quantity">
														x1
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="order-wrapper-content mt-3">
									<div id="order-header-view-package-seller" class="row">
										<div class="col-md-6 text-left"><i class="fa fa-cube fa-fw"></i><span>Package 3</span></div>
										<div class="col-md-6 text-right">
											<span>John Doe</span>
											<a href="">
												<button class="btn btn-primary">view shop</button>
											</a>
												
										</div>
									</div>

									<div id="order-delivery-shipping" class="row">
										<div class="col-md-12">
											<div class="order-delivery-shipping-name">
												<i class="fa fa-truck fa-fw"></i>Standard Shipping
											</div>
											<div class="order-delivery-shipping-date">
												01/12/2017
											</div>
										</div>
									</div>

									<div id="order-delivery-status" class="row">
										<div class="col-md-12">

												<!-- processing -->
												<!-- <div class="progress">
										        	<div class="one"></div><div class="two no-color"></div><div class="three no-color"></div>
										  			<div class="progress-bar" style="width: 0;"></div>
												</div> -->

												<!-- shipped -->
												<!-- <div class="progress">
										        	<div class="one"></div><div class="two"></div><div class="three no-color"></div>
										  			<div class="progress-bar" style="width: 50%;"></div>
												</div> -->

												<!-- delivered -->
												<div class="progress">
										        	<div class="one"></div><div class="two"></div><div class="three"></div>
										  			<div class="progress-bar" style="width: 100%;"></div>
												</div>

												<div class="processing-text">Processing</div>
												<div class="shipped-text">Shipped</div>
												<div class="delivered-text">Delivered</div>
										</div>
									</div>

									<div id="order-delivery-content" class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-2">
													<div class="item-product">
														<a href="" class="d-block my-item-product-inner">
															<div class="item-image">
																<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/eac2fa33b6bdb1d743e4ff218aa105eb_tn);"></div>
															</div>
														</a>
													</div>
												</div>
												<div class="col-md-6">
													<div class="item-name">
														<a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, consequuntur!</a>
													</div>
												</div>

												<div class="col-md-2">
													<div class="item-price">
														₱1,000.00
													</div>
												</div>

												<div class="col-md-2">
													<div class="item-quantity">
														x1
													</div>
												</div>
											</div>
										</div>
									</div>
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