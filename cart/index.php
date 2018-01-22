<?php  
	require '../db.php';
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	// Check if user is logged in using the session variable
	if ( $logged_in == false ) {
		$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your cart page.";
		header("location: /etiendahan/customer/account/login/");    
	}
	else {
	    // Makes it easier to read
	    $email = $_SESSION['email'];
	    // echo $_SESSION['cart_id'];
	    // echo $_SESSION['input_quantity_cart'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    if (isset($_POST['button_delete_cart'])) {
	    	$cart_product_id_delete = $_SESSION['cart_product_id_delete'];
	    	$email =  $_SESSION['email'];

    	    $sql = "DELETE FROM tbl_cart WHERE product_id = '$cart_product_id_delete' AND email = '$email'";
		   	$mysqli->query($sql) or die($mysqli->error);
	    }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Your Shopping Cart | Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">
	
	<!-- link inner -->
	<?php  
		include '../header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="shopping-cart-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include '../header.php';
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
					<?php  
						$cart_result = $mysqli->query("SELECT * FROM tbl_cart WHERE email = '$email'");
						if($cart_result->num_rows == 0):
					?>
						<div class="container shopping-cart">
							<div class="row">
								<div class="col-md-8">
									<table class="table">
										<thead>
											<tr>
												<th class="shopping-cart" scope="col">Shopping Cart</th>
											</tr>
										</thead>

										<tbody>
											<?php $quant = 'no-cart'; ?>
											<tr>
												<td scope="row">
													You have no items in your shopping cart.
												</td>
											</tr>								
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<?php else: ?>
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
											<?php
												$quant = 1;
												$formatted_total = 0;
												$cart_result = $mysqli->query("SELECT * FROM tbl_cart WHERE email = '$email'");
												while($cart_row = mysqli_fetch_assoc($cart_result)):
												$product_result = $cart_row['product_id'];

												$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$product_result'");
												while($product_row = mysqli_fetch_assoc($product_result)):
											?>
											<tr>
												<td class="image" scope="row">
														<a href="/etiendahan/category/view/product/" class="d-block my-item-inner category-product-id" id=<?php echo $product_row['id']; ?>>
															<div class="item-image">
																<?php $saved_image = explode(',', $product_row['image']); ?>
																<div class="img-fluid" style="background-image: url(<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>);"></div>
															</div>
														</a>
													</td>
												<td class="description-button">
														<a href="/etiendahan/category/view/product/" class="product-title category-product-id" id=<?php echo $product_row['id']; ?>><?php echo $product_row['name']; ?></a>
														<div class="cart-action">
															<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
																<button class="cart-delete cart-delete-focus" id="<?php echo $product_row['id']; ?>" type="submit" name="button_delete_cart">
																	Remove
																</button>
															</form>
														</div>
												</td>
												<td class="price text-center"><?php $total = str_replace(',', '', $product_row['price']) * $cart_row['quantity']; $formatted = number_format((float)$total, 2, '.', ''); 
													
													if($cart_row['quantity'] == 0):
												?>
													<div class="text-danger" style="font-size: 10px;">Not Available</div>
														
													<?php else: ?>
													₱<?php echo $result_total_product = number_format((float)$total, 2, '.', ',');  ?>
												<?php endif; ?>
												
													
												</td>
												<td class="product-button quantity text-center">
													<div class="input-group input-group<?php echo $quant; ?>" id="<?php echo $cart_row['id'] ?>">
														<span class="input-group-btn">
															<button class="btn btn-default btn-number" data-type="minus" data-field="quant[<?php echo $quant; ?>]">
																<i class="fa fa-minus"></i>
															</button>
														</span>
														<input type="text" name="quant[<?php echo $quant; ?>]" class="form-control input-number quantity-change<?php echo $quant; ?>" value="<?php echo $cart_row['quantity'] ?>" min="1" max="<?php echo $product_row['stock'] ?>" style="width: 55px;" disabled>
														<span class="input-group-btn">
															<button class="btn btn-default btn-number" data-type="plus" data-field="quant[<?php echo $quant; ?>]">
																<i class="fa fa-plus"></i>
															</button>
														</span>
											      	</div>
												</td>
											</tr>	
											<?php $quant++; $formatted_total += $formatted;endwhile;endwhile;?>	
											
										</tbody>
									</table>
								</div>

								<div class="col-md-4">
									<div class="totals">
										<div class="sub-total">Subtotal <span>₱<?php echo number_format((float)$formatted_total, 2, '.', ','); ?></span></div>
										<div class="grand-total">Grand Total <span>₱<?php echo number_format((float)$formatted_total, 2, '.', ','); ?></span></div>
										<button class="btn btn-primary" type="submit">Proceed to checkout</button>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<!-- END OF SHOPPING CART PAGE -->




<!-- footer inner -->
<?php  
	include '../footer.php';
?>
<script>
	// ============ CART PAGE ============ 
	
	$(document).ready(function(){
		<?php if($quant == 'no-cart'): ?>
		<?php else: ?>
			<?php for($i=1;$i<=$quant-1;$i++): ?>
			$('.quantity-change<?php echo $i ?>').on('change keyup', function() {
				var input_quantity_cart = $(this).val();
				var cart_id = $('.input-group<?php echo $i ?>').attr('id');
				// alert(input_quantity_cart + '.' + cart_id);
				$.post("/etiendahan/c8NLPYLt-functions/child-categories/", {"cart_id": cart_id, "input_quantity_cart": input_quantity_cart});
				location.reload();
			});
			<?php endfor; ?>
		<?php endif; ?>
	});
// ============ END OF CART PAGE ============ 
</script>
</html>