<?php  
	require '/db.php';
	require_once "/facebook-login/config.php";

	if ( $logged_in == true ) {

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    if (isset($_POST['button_delete_cart'])) {
	    	$cart_product_id_delete = $_SESSION['cart_product_id_delete'];
	    	$email =  $_SESSION['email'];

    	    $sql = "DELETE FROM tbl_cart WHERE product_id = '$cart_product_id_delete' AND email = '$email'";
		   	$mysqli->query($sql) or die($mysqli->error);
	    }
	}

	$fbSession = ((isset($_SESSION['facebook_access_token']) && $_SESSION['facebook_access_token'] != '')?htmlentities($_SESSION['facebook_access_token']):'');
	
	if($fbSession != "") {
		$logoutUrlFacebook = $helper->getLogoutUrl($fbSession, 'http://localhost:8080/etiendahan/logout/');
	} else {
		$logoutUrlFacebook = 'http://localhost:8080/etiendahan/logout/';
	}

?>
		<!-- SECTION 1 -->
		<div id="etiendahan-section-1" class="etiendahan-section">
			
			<!-- navbar -->
			<nav class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index shrink">
			  	<a class="navbar-brand" href="http://localhost:8080/etiendahan/">
					<img src="/etiendahan/temp-img/etiendahan-logo.png" width="178" height="58" class="d-inline-block align-top" alt="">
				</a>				

				<div class="collapse navbar-collapse" id="navbarCenterContent">
					<div class="container">
						<ul class="navbar-nav">

							<!-- SELL ON ETIENDAHAN -->
							<li class="nav-item">
								<a class="nav-link cl-effect" href="/etiendahan/seller-centre/account/signin/" target="_blank">Sell On Etiendahan</a>
							</li>

							<!-- SPECIALTY IN CITY -->
							<li class="nav-item">
								<a class="nav-link cl-effect" href="/etiendahan/specialty-in-city/">Specialty in City</a>
							</li>

							<!-- SPECIALTY IN CITY -->
							<!-- <li class="nav-item dropdown mega-dropdown">
								
								<a class="nav-link cl-effect" href="https://google.com" id="specialtyInCity" role="button" aria-haspopup="true" aria-expanded="false">
								Specialty
								</a>
								
								<div class="dropdown-menu mega-dropdown-menu" aria-labelledby="specialtyInCity">
									<div class="container">
										<div class="row">
											<div class="col-md-3">
												<a class="dropdown-header primary-header" href="#">A</a>
												<div class="dropdown-divider"></div>
												<div class="row">
													<div class="col-md-6">
														<a class="dropdown-header secondary-header" href="https://google.com">Alaminos</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Hipon</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Alcala</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Damit</a>																	</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Anda</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Sapatos</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Aguilar</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<a class="dropdown-header primary-header" href="#">B</a>
												<div class="dropdown-divider"></div>
												<div class="row">
													<div class="col-md-6">
														<a class="dropdown-header secondary-header" href="https://google.com">Bolinao</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Hipon</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Bugallon</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Damit</a>																	</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Binalonan</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Sapatos</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Binmaley</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Burgos</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Basista</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Baustista</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<a class="dropdown-header primary-header" href="#">C</a>
												<div class="dropdown-divider"></div>
												<div class="row">
													<div class="col-md-6">
														<a class="dropdown-header secondary-header" href="https://google.com">Calasiao</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Puto</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<a class="dropdown-header primary-header" href="#">D</a>
												<div class="dropdown-divider"></div>
												<div class="row">
													<div class="col-md-6">
														<a class="dropdown-header secondary-header" href="https://google.com">Dagupan</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Bangus</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li> -->

							<!-- ACCESSORIES -->
							<!-- <li class="nav-item">
								<a class="nav-link cl-effect" href="#">Accessories</a>
							</li> -->

							<?php  
								$men_result = $mysqli->query("SELECT id FROM tbl_categories WHERE name = 'Men\'s Fashion'");
								$men_row = $men_result->fetch_assoc();
							?>
							<!-- MEN -->
							<li class="nav-item">
								<a class="nav-link cl-effect my-gallery-inner" href="/etiendahan/category/view/" id="<?php echo $men_row['id']; ?>">Men</a>
							</li>
							
							<?php  
								$women_result = $mysqli->query("SELECT id FROM tbl_categories WHERE name = 'Women\'s Fashion'");
								$women_row = $women_result->fetch_assoc();
							?>
							<!-- WOMEN -->
							<li class="nav-item">
								<a class="nav-link cl-effect my-gallery-inner" href="/etiendahan/category/view/" id="<?php echo $women_row['id']; ?>">Women</a>
							</li>

							<!-- ALL CATEGORIES -->
							<li class="nav-item">
								<a href='http://localhost:8080/etiendahan/#shop-now' class="nav-link cl-effect scroll-link" data-id="shop-now-link">Shop Now</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="ml-auto d-flex">
					<div id="sb-search" class="sb-search">
						<form class="search-form" action="/etiendahan/c8NLPYLt-functions/search-function/" method="POST">
							<input class="sb-search-input hintable ui-autocomplete-input" id="customerAutocomplete" hint-class="show-recent" placeholder="Search products" type="text" name="search" autocomplete="off">
							<input class="sb-search-submit search-btn" type="submit" name="search_button">
							<span class="sb-icon-search"><i class="fa fa-search" style="color: dimgrey;"></i></span>
						</form>
					</div>	

					<!-- CART -->
					<div class="nav-item right-nav dropdown" id="cart">
						<a class="nav-link" href="/etiendahan/cart/" id="cart" role="button" aria-haspopup="true" aria-expanded="false">
							<?php  
								$product_available_banned_result = $mysqli->query("SELECT GROUP_CONCAT(id) as total_id FROM tbl_products WHERE banned = 0");
								$product_available_banned_row = $product_available_banned_result->fetch_assoc();
								$total_id_available = $product_available_banned_row['total_id'];

								if($total_id_available == null) {
									$total_id_available = 0;
								}

								$email = $_SESSION['email'];
								$cart_result_count = $mysqli->query("SELECT COUNT(*) as 'total' FROM tbl_cart WHERE email = '$email'");
								$cart_row_count = $cart_result_count->fetch_assoc();
							?>
							<span class="fa-stack has-badge" data-count="<?php echo $cart_row_count['total']; ?>">
							  <!-- <i class="fa fa-circle fa-stack-2x"></i> -->
							  <i class="fa fa-shopping-bag fa-stack-1x"></i>
							</span>
						</a>
						
						<!-- No items in the cart -->
						<?php  
							$result = $mysqli->query("SELECT * FROM tbl_cart WHERE email = '$email'");

					        if ($result->num_rows == 0):
						?>
							<div class="dropdown-menu" aria-labelledby="cart">
								<p>You have no items in your shopping cart.</p>
							</div>
						<?php else: ?>

						<!-- Have items in the cart -->
						
						<div class="dropdown-menu have-in-cart" aria-labelledby="cart">
							<p>Recently Added Products</p>
							<?php    
								$product_available_banned_result = $mysqli->query("SELECT GROUP_CONCAT(id) as total_id FROM tbl_products WHERE banned = 0");
								$product_available_banned_row = $product_available_banned_result->fetch_assoc();
								$total_id_available = $product_available_banned_row['total_id'];

								if($total_id_available == null) {
									$total_id_available = 0;
								}

								$cart_result = $mysqli->query("SELECT * FROM tbl_cart WHERE email = '$email'");
								while($cart_row = mysqli_fetch_assoc($cart_result)):
								$product_id_cart = $cart_row['product_id'];

								$product_result = $mysqli->query("SELECT * FROM tbl_products WHERE id = '$product_id_cart'");
								while($product_row = mysqli_fetch_assoc($product_result)):
									if($product_row['banned'] == 1):
									
							?>	
										<div class="item overlay">
											<div class="item-left">
												<?php $saved_image = explode(',', $product_row['image']); ?>
												<img src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>" style="height: 50px;width: 50px;margin-top: 6px;" alt="" />
												<div class="item-info">
													<div class="item-name"><span class="item-sold-out">Banned</span><?php echo $product_row['name']; ?></div>
													<?php if($cart_row['quantity'] == 1): ?>
														<div class="item-price">₱<?php $cart_quantity = $cart_row['quantity']; echo $product_row['price']; ?></div>													
													<?php else: ?>
														<?php $total = str_replace(',', '', $product_row['price']) * $cart_row['quantity']; $formatted = number_format((float)$total, 2, '.', ''); ?>
														<?php $result_total_product = number_format((float)$total, 2, '.', ',');  ?>
														<div class="item-price">₱<?php $cart_quantity = $cart_row['quantity']; echo $product_row['price']."<span style='font-size: 11px;'> x$cart_quantity = </span><div class='d-inline-block'>₱$result_total_product</div>"; ?></div>
													<?php endif; ?>
												</div>
											</div>
											<div class="item-right">
												<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
													<button class="cart-delete" id="<?php echo $product_row['id']; ?>" type="submit" name="button_delete_cart">
														<i class="fa fa-trash" style="color: dimgrey; z-index: 9999; position: relative; left: 10px;bottom: 9px;"></i>
													</button>
												</form>
											</div>
										</div>
									<?php elseif($product_row['stock'] <= 0): ?>
										<div class="item overlay">
											<div class="item-left">
												<?php $saved_image = explode(',', $product_row['image']); ?>
												<img src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>" style="height: 50px;width: 50px;margin-top: 6px;" alt="" />
												<div class="item-info">
													<div class="item-name"><span class="item-sold-out">Sold out</span><?php echo $product_row['name']; ?></div>
													<div class="item-price">₱<?php echo $product_row['price']; ?></div>
												</div>
											</div>
											<div class="item-right">
												<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
													<button class="cart-delete" id="<?php echo $product_row['id']; ?>" type="submit" name="button_delete_cart">
														<i class="fa fa-trash" style="color: dimgrey; z-index: 9999; position: relative; left: 10px;bottom: 9px;"></i>
													</button>
												</form>
											</div>
										</div>
									<?php else: ?>
										<div class="item">
											<div class="item-left">
												<a href="/etiendahan/category/view/product/" class="category-product-id" id="<?php echo $product_row['id']; ?>">
													<?php $saved_image = explode(',', $product_row['image']); ?>
													<img src="<?php echo ($saved_image[0] != '') ? $saved_image[0] : 'http://via.placeholder.com/155x155?text=No+Image+Preview' ; ?>" style="height: 50px;width: 50px;margin-top: 6px;" alt="" />
												</a>
												<div class="item-info">
													<div class="item-name"><?php echo $product_row['name']; ?></div>
													<?php if($cart_row['quantity'] <= 1): ?>
														<div class="item-price">₱<?php $cart_quantity = $cart_row['quantity']; echo $product_row['price']; ?></div>													
													<?php else: ?>
														<?php $total = str_replace(',', '', $product_row['price']) * $cart_row['quantity']; $formatted = number_format((float)$total, 2, '.', ''); ?>
														<?php $result_total_product = number_format((float)$total, 2, '.', ',');  ?>
														<div class="item-price">₱<?php $cart_quantity = $cart_row['quantity']; echo $product_row['price']."<span style='font-size: 11px;'> x$cart_quantity = </span><div class='d-inline-block'>₱$result_total_product</div>"; ?></div>
													<?php endif; ?>
												</div>
											</div>
											<div class="item-right">
												<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
													<button class="cart-delete" id="<?php echo $product_row['id']; ?>" type="submit" name="button_delete_cart">
														<i class="fa fa-trash" style="color: dimgrey; z-index: 9999; position: relative; left: 10px;bottom: 9px;"></i>
													</button>
												</form>
											</div>
										</div>

							<?php endif;endwhile;endwhile; ?>

							

							<a href="/etiendahan/cart/"><button type="button" class="btn btn-dark">View Cart</button></a>
						</div>
						<?php endif; ?>
					</div>

					<div class="nav-item right-nav dropdown" id="user-account">
						<a class="nav-link" href="/etiendahan/customer/account/profile/" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user-circle"></i>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<p>Howdie.</p>

							<a href="/etiendahan/customer/account/profile/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Manage my account</div></a>
							<a href="/etiendahan/customer/orders/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>My Orders</div></a>
							<a href="/etiendahan/customer/wishlists/">
								<div class="dropdown-item">
									<?php  
										$email =  $_SESSION['email'];
									  	$result = $mysqli->query("SELECT COUNT(*) as 'total' FROM tbl_wishlists WHERE email = '$email'");
								 		if($result->num_rows == 0):
									?>
									<i class="fa fa-caret-right fa-fw"></i>Wishlists
									<?php else: ?>
										<?php $row = $result->fetch_assoc(); ?>
									<i class="fa fa-caret-right fa-fw"></i>Wishlists <?php $total_row = $row['total']; echo ($row['total'] == 0)? '' : "($total_row)" ?>
									<?php endif; ?>
								</div>
							</a>
							<button class="facebook-logout" type="button" onclick="window.location = '<?php echo $logoutUrlFacebook; ?>'" style="background:none!important;color: inherit;border: none;padding: 0!important;font: inherit;cursor: pointer;width: 100%;text-align: left;"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw" id="logout"></i>LOGOUT</div></button>
						</div>
					</div>
				</div>

				<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</nav>
		</div>
		<!-- END OF SECTION 1 -->
<?php  
	} else {
?>
		<!-- SECTION 1 -->
		<div id="etiendahan-section-1" class="etiendahan-section">
			
			<!-- navbar -->
			<nav class="navbar fixed-top navbar-expand-xl cl-effect fake-cl-effect my-navbar index shrink">
			  	<a class="navbar-brand" href="http://localhost:8080/etiendahan/">
					<img src="/etiendahan/temp-img/etiendahan-logo.png" width="178" height="58" class="d-inline-block align-top" alt="">
				</a>					

				<div class="collapse navbar-collapse" id="navbarCenterContent">
					<div class="container">
						<ul class="navbar-nav">

							<!-- SELL ON ETIENDAHAN -->
							<li class="nav-item">
								<a class="nav-link cl-effect" href="/etiendahan/seller-centre/account/signin/" target="_blank">Sell On Etiendahan</a>
							</li>

							<!-- SPECIALTY IN CITY -->
							<li class="nav-item">
								<a class="nav-link cl-effect" href="/etiendahan/specialty-in-city/">Specialty in City</a>
							</li>

							<!-- SPECIALTY IN CITY -->
							<!-- <li class="nav-item dropdown mega-dropdown">
								
								<a class="nav-link cl-effect" href="https://google.com" id="specialtyInCity" role="button" aria-haspopup="true" aria-expanded="false">
								Specialty
								</a>
								
								<div class="dropdown-menu mega-dropdown-menu" aria-labelledby="specialtyInCity">
									<div class="container">
										<div class="row">
											<div class="col-md-3">
												<a class="dropdown-header primary-header" href="#">A</a>
												<div class="dropdown-divider"></div>
												<div class="row">
													<div class="col-md-6">
														<a class="dropdown-header secondary-header" href="https://google.com">Alaminos</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Hipon</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Alcala</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Damit</a>																	</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Anda</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Sapatos</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Aguilar</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<a class="dropdown-header primary-header" href="#">B</a>
												<div class="dropdown-divider"></div>
												<div class="row">
													<div class="col-md-6">
														<a class="dropdown-header secondary-header" href="https://google.com">Bolinao</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Hipon</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Bugallon</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Damit</a>																	</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Binalonan</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Sapatos</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Binmaley</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Burgos</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Basista</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
													<div class="col-md-6">
														<a class="dropdown-header" href="#">Baustista</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Calamay</a>
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Isda</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<a class="dropdown-header primary-header" href="#">C</a>
												<div class="dropdown-divider"></div>
												<div class="row">
													<div class="col-md-6">
														<a class="dropdown-header secondary-header" href="https://google.com">Calasiao</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Puto</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<a class="dropdown-header primary-header" href="#">D</a>
												<div class="dropdown-divider"></div>
												<div class="row">
													<div class="col-md-6">
														<a class="dropdown-header secondary-header" href="https://google.com">Dagupan</a>
														<div class="children">
															<a class="dropdown-item" href="#"><i class="fa fa-angle-right fa-fw"></i>Bangus</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li> -->

							<!-- ACCESSORIES -->
							<!-- <li class="nav-item">
								<a class="nav-link cl-effect" href="#">Accessories</a>
							</li> -->

							<?php  
								$men_result = $mysqli->query("SELECT id FROM tbl_categories WHERE name = 'Men\'s Fashion'");
								$men_row = $men_result->fetch_assoc();
							?>
							<!-- MEN -->
							<li class="nav-item">
								<a class="nav-link cl-effect my-gallery-inner" href="/etiendahan/category/view/" id="<?php echo $men_row['id']; ?>">Men</a>
							</li>
							
							<?php  
								$women_result = $mysqli->query("SELECT id FROM tbl_categories WHERE name = 'Women\'s Fashion'");
								$women_row = $women_result->fetch_assoc();
							?>
							<!-- WOMEN -->
							<li class="nav-item">
								<a class="nav-link cl-effect my-gallery-inner" href="/etiendahan/category/view/" id="<?php echo $women_row['id']; ?>">Women</a>
							</li>

							<!-- ALL CATEGORIES -->
							<li class="nav-item">
								<a href='http://localhost:8080/etiendahan/#shop-now' class="nav-link cl-effect" data-id="shop-now-link">Shop Now</a>
							</li>
						</ul>
					</div>

					
				</div>

				<div class="ml-auto d-flex">
					<div id="sb-search" class="sb-search">
						<form class="search-form" action="/etiendahan/c8NLPYLt-functions/search-function/" method="POST">
							<input class="sb-search-input hintable ui-autocomplete-input" id="customerAutocomplete" hint-class="show-recent" placeholder="Search products" type="text" name="search" autocomplete="off">
							<input class="sb-search-submit search-btn" type="submit" name="search_button">
							<span class="sb-icon-search"><i class="fa fa-search" style="color: dimgrey;"></i></span>
						</form>
					</div>

					<!-- CART -->
					<div class="nav-item right-nav dropdown" id="cart">
						<a class="nav-link" href="/etiendahan/cart/" id="cart" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="fa-stack has-badge" data-count="0">
							  <!-- <i class="fa fa-circle fa-stack-2x"></i> -->
							  <i class="fa fa-shopping-bag fa-stack-1x"></i>
							</span>
						</a>

						<!-- No items in the cart -->
						<div class="dropdown-menu" aria-labelledby="cart">
							<p>You have no items in your shopping cart.</p>
						</div>

						<!-- Have items in the cart -->
						<!-- <div class="dropdown-menu have-in-cart" aria-labelledby="cart">
							<p>Recently Added Products</p>
							<div class="item">
								<div class="item-left">
									<img src="http://via.placeholder.com/50x50" alt="" />
									<div class="item-info">
										<div class="item-name">Item name</div>
										<div class="item-price">?1,000.00</div>
									</div>
								</div>
								<div class="item-right">
									<i class="fa fa-trash"></i>
								</div>
							</div>
							<div class="item">
								<div class="item-left">
									<img src="http://via.placeholder.com/50x50" alt="" />
									<div class="item-info">
										<div class="item-name">Item name</div>
										<div class="item-price">?500.00</div>
									</div>
								</div>
								<div class="item-right">
									<i class="fa fa-trash"></i>
								</div>
							</div>
							<div class="item overlay">
								<div class="item-left">
									<img src="http://via.placeholder.com/50x50" alt="" />
									<div class="item-info">
										<div class="item-name"><span class="item-sold-out">Sold out</span>Item name</div>
										<div class="item-price">?1,500.00</div>
									</div>
								</div>
								<div class="item-right">
									<i class="fa fa-trash"></i>
								</div>
							</div>
							<div class="item">
								<div class="item-left">
									<img src="http://via.placeholder.com/50x50" alt="" />
									<div class="item-info">
										<div class="item-name">Item name</div>
										<div class="item-price">?500.00</div>
									</div>
								</div>
								<div class="item-right">
									<i class="fa fa-trash"></i>
								</div>
							</div>
							<div class="item overlay">
								<div class="item-left">
									<img src="http://via.placeholder.com/50x50" alt="" />
									<div class="item-info">
										<div class="item-name"><span class="item-sold-out">Sold out</span>Item name</div>
										<div class="item-price">?1,500.00</div>
									</div>
								</div>
								<div class="item-right">
									<i class="fa fa-trash"></i>
								</div>
							</div>
							<button type="button" class="btn btn-dark">View Cart</button>
						</div> -->
					</div>

					<div class="nav-item right-nav dropdown" id="user-account">
						<a class="nav-link" href="/etiendahan/customer/account/login/" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user-circle"></i>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<p>Howdie.</p>

							<!-- Development -->
							<a href="/etiendahan/customer/account/login/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Log in</div></a>
							<a href="/etiendahan/customer/account/create/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Create an account</div></a>

							<!-- Production -->
							<!-- <a href="/customer/account/login/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Log in</div></a>
							<a href="/customer/account/create/"><div class="dropdown-item"><i class="fa fa-caret-right fa-fw"></i>Create an account</div></a> -->


						</div>
					</div>
				</div>

				<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarCenterContent" aria-controls="navbarCenterContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</nav>
		</div>
		<!-- END OF SECTION 1 -->
<?php  
	}
?>