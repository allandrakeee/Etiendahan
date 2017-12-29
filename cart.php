<!DOCTYPE html>
<html>
<head>
	<title>Your Shopping Cart | Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">
	
	<!-- link inner -->
	<?php  
		include 'header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="shopping-cart-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include 'header.php';
				?>				

				<!-- SHOPPING CART PAGE -->
				<div id="etiendahan-shopping-cart-page">
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<div class="container">
								<li class="breadcrumb-item"><a href="/etiendahan/" title="Back to the frontpage"><i class="fa fa-home"></i>Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">YOUR SHOPPING CART</li>
							</div>
						</ol>
					</nav>

					<div class="container shopping-cart">
						<div class="row">
							<div class="col-md-8">
								<table class="table">
									<thead>
										<tr>
											<th class="shopping-cart" scope="col">Shopping Cart</th>
											<th scope="col"></th>
											<th class="text-center" scope="col">Price</th>
											<th class="text-center" scope="col">Quantity</th>
										</tr>
									</thead>

									<tbody>
										<tr>
											<td class="image" scope="row">
												<a href="#" class="d-block my-item-inner">
													<div class="item-image">
														<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/a6bb16c296f4b5d3c837521cc164b61e_tn);"></div>
													</div>
												</a>
											</td>
											<td class="description-button">
												<a class="product-title" href="">Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, hic..</a>
												<div class="cart-action">
													<a href="">Edit</a>
													<span>|</span>
													<a href="">Remove</a>
												</div>
											</td>
											<td class="price text-center">₱150.00</td>
											<td class="quantity text-center">1</td>
										</tr>
										<tr>
											<td class="image" scope="row">
												<a href="#" class="d-block my-item-inner">
													<div class="item-image">
														<div class="img-fluid" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/0333ba7960c7ad43b68bd4888db17481_tn);"></div>
													</div>
												</a>
											</td>
											<td class="description-button">
												<a class="product-title" href="">Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, hic..</a>
												<div class="cart-action">
													<a href="">Edit</a>
													<span>|</span>
													<a href="">Remove</a>
												</div>
											</td>
											<td class="price text-center">₱150.00</td>
											<td class="quantity text-center">1</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="col-md-4">
								<div class="totals">
									<div class="sub-total">Subtotal <span>₱150.00</span></div>
									<div class="grand-total">Grand Total <span>₱150.00</span></div>
									<button class="btn btn-primary" type="submit">Proceed to checkout</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF SHOPPING CART PAGE -->

<!-- footer inner -->
<?php  
	include 'footer.php';
?>
</html>