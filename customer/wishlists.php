<?php  
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	// Check if user is logged in using the session variable
	if ( $logged_in == false ) {
		$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your profile page";
		header("location: /etiendahan/customer/account/login/");    
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
	<title>Wishlists - Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- link inner -->
	<?php  
		include '../header-link.php';
	?>	

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="wishlists-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">

				<!-- header inner -->
				<?php  
					include '../header.php';
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
										<div class="card-header" role="tab" id="headingTwo">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/orders/">
												Orders
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header active" role="tab" id="headingThree">
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
								<div class="tab-content"><h1>Your Wishlists</h1></div>
								
								<!-- If wishlists is empty -->
								<!-- <p>You haven't select any item to wishlists yet.</p> -->

								<!-- If wishlists is not empty -->
								<div class="row">
									<div class="col-md-12">
										<table class="table">
											<thead>
												<tr>
													<th scope="col">Product Image</th>
													<th scope="col">Product Name</th>
													<th class="text-center" scope="col">Price</th>
													<th scope="col"></th>
												</tr>
											</thead>

											<tbody>
												<tr>
													<th scope="row">
														<a href="#" class="d-block my-item-inner">
															<div class="item-image">
																<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/a6bb16c296f4b5d3c837521cc164b61e_tn);"></div>
															</div>
														</a>
														<div class="separator"></div>
													</th>
													<td class="item-name">
														<a href="">Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, hic..</a>
													</td>
													<td class="item-price text-center">
														₱200.00
													</td>
													<td class="action text-center">
														<a id="action" href=""><i class="fa fa-shopping-cart"></i></a>
														<span>|</span>
														<a id="action" href=""><i class="fa fa-close"></i></a>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<a href="#" class="d-block my-item-inner">
															<div class="item-image">
																<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/0333ba7960c7ad43b68bd4888db17481_tn);"></div>
															</div>
														</a>
														<div class="separator"></div>
													</th>
													<td class="item-name">
														<a href="">Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, hic..</a>
													</td>
													<td class="item-price text-center">
														₱200.00
													</td>
													<td class="action text-center">
														<a id="action" href=""><i class="fa fa-shopping-cart"></i></a>
														<span>|</span>
														<a id="action" href=""><i class="fa fa-close"></i></a>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<a href="#" class="d-block my-item-inner">
															<div class="item-image">
																<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/28fbc9e80d4b24d2c67522c5243cf4ea_tn);"></div>
															</div>
														</a>
														<div class="separator"></div>
													</th>
													<td class="item-name">
														<a href="">Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, hic..</a>
													</td>
													<td class="item-price text-center">
														₱200.00
													</td>
													<td class="action text-center">
														<a id="action" href=""><i class="fa fa-shopping-cart"></i></a>
														<span>|</span>
														<a id="action" href=""><i class="fa fa-close"></i></a>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<a href="#" class="d-block my-item-inner">
															<div class="item-image">
																<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/67c398a9a00aa752a2d3b3f5beefafab_tn);"></div>
															</div>
														</a>
														<div class="separator"></div>
													</th>
													<td class="item-name">
														<a href="">Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, hic..</a>
													</td>
													<td class="item-price text-center">
														₱205.00
													</td>
													<td class="action text-center">
														<a id="action" href=""><i class="fa fa-shopping-cart"></i></a>
														<span>|</span>
														<a id="action" href=""><i class="fa fa-close"></i></a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF CUSTOMER PAGE SECTION 1 -->

<!-- footer inner -->
<?php  
	include '../footer.php';
?>
</html>