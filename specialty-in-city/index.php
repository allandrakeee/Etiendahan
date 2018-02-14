<?php  
	require '../db.php';
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Specialty in City | Etiendahan Dagupan</title>
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

	<!-- Preloader -->
	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="specialty-in-city-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include '../header.php';
				?>				

				<!-- SPECIALTY IN CITY PAGE -->
				<div id="etiendahan-information-page">
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<div class="container">
								<li class="breadcrumb-item"><a href="/etiendahan/" title="Back to the frontpage"><i class="fa fa-home"></i>Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Specialty in City</li>
								<div class="note pull-right"><div class="sub-title mb-1 d-inline-block" data-toggle="tooltip" data-placement="bottom" title="Specialty in city products AVAILABLE IN LOCATION ONLY."><span style="color: #007bff;">Note:</span></div></div>
							</div>
						</ol>
					</nav>
										
					<?php  
						$sic_owner_result = $mysqli->query("SELECT * FROM tbl_sic_owner");
						if($sic_owner_result->num_rows == 0):
					?>
						<div class="container">
							No Specialty in City Yet
						</div>
					<?php else: ?>
						<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyA7hfVchB6GQRHcmTwK8aLEAG2QwtYP6_A"></script>
						
						<?php  
							$count = 1;
							$sic_owner_result = $mysqli->query("SELECT * FROM tbl_sic_owner");
							while($sic_owner_row = mysqli_fetch_assoc($sic_owner_result)):
						?>
							<div id="sic-<?php echo $sic_owner_row['id'] ?>" style="position: relative; top: -80px"></div>
							<div class="container pb-5 mb-5" style="border-bottom: 10px solid #dcdcdc;">
								<div class="row">
									<div class="col-md-6">
										<div class="" style="height: 495px;width: 100%;background: url(<?php echo $sic_owner_row['image'] ?>);background-position: center center;background-size: cover;background-repeat: no-repeat;"></div>
									</div>
									<div class="col-md-6">
										<div class="shop-name" style="font-size: 15px;">Shop name: <span style="font-size: 25px;"><?php echo $sic_owner_row['name'] ?></span></div>
										<div class="cellphone-num" style="font-size: 15px;">Cellphone #: <span style="font-size: 20px;"><?php echo ($sic_owner_row['cellphone_number'] != '')? $sic_owner_row['cellphone_number'] : '-'?></span></div>
										<div class="email" style="font-size: 15px;">Email: <?php $sic_owner_email = $sic_owner_row['email']; echo ($sic_owner_row['email'] != '')? "<a href=mailto:$sic_owner_email target='_blank' style='text-decoration: none;'><span style='font-size: 20px;'>$sic_owner_email</span></a>" : "<span style='font-size: 20px;'>-</span>"?></div>
										<div class="address" style="font-size: 15px;">Address: <span style="font-size: 20px;"><?php echo $sic_owner_row['address'] ?></span></div>
										<div style="font-size: 15px;">Map: <span style="font-size: 25px;"></span></div>
										<div id="map-address<?php echo $count; ?>" style="height: 331px; width: 100%;"></div>
										<script>
										var map;

										function initialize() {
										    // create the maps
										    var myOptions = {
										        zoom: 16,
										        center: {lat: <?php echo $sic_owner_row['lat'] ?>, lng: <?php echo $sic_owner_row['lng'] ?>}
										    }
										    map = new google.maps.Map(document.getElementById("map-address<?php echo $count; ?>"), myOptions);

										    var marker = new google.maps.Marker({
										      map: map,
										      position: {lat: <?php echo $sic_owner_row['lat'] ?>, lng: <?php echo $sic_owner_row['lng'] ?>}
										    });
										}

										initialize();
										</script>
									</div>
								</div>
								<!-- available products -->
								<?php $sic_owner_id = $sic_owner_row['id'] ?>
								<?php  
								$sic_product_result = $mysqli->query("SELECT * FROM tbl_sic_product WHERE owner_id = '$sic_owner_id'");
								if($sic_product_result->num_rows > 0):
								?>
									<div class="row">
										<div class="col-md-12">
											<div id="etiendahan-specialty-in-city" class="etiendahan-section mt-5">
												<div class="container">
													<div class="title-name">
														<h3><span class="wow pulse" data-wow-delay="1500ms">AVAILABLE PRODUCTS</span></h3>
													</div>

													<div class="owl-carousel">
														<?php  
															$sic_product_result = $mysqli->query("SELECT * FROM tbl_sic_product WHERE owner_id = '$sic_owner_id'");
															while($sic_product_row = mysqli_fetch_assoc($sic_product_result)):
														?>
															<div class="item">
																<a>
																	<div class="card">
																		<div class="card-image img-fluid owl-lazy" data-src="<?php echo $sic_product_row['image']; ?>"></div>
																		<div class="card-body">
																			<div class="product-name" style="height: auto;display: block;-webkit-line-clamp: inherit;-webkit-box-orient: horizontal;overflow: inherit;text-overflow: ellipsis;"><?php echo $sic_product_row['name']; ?></div>
																			<div class="product-description mb-1"><?php echo $sic_product_row['description']; ?></div>
																			<div class="product-price">₱<?php echo $sic_product_row['price']; ?></div>
																		</div>
																	</div>
																</a>
															</div>
														<?php endwhile; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endif; ?>
							</div>
						<?php $count++; endwhile; ?>

					<?php endif; ?>

















					<!-- <div class="container mt-5 pb-5" style="border-bottom: 5px solid #dcdcdc;">
						<div class="row">
							<div class="col-md-6">
								<div class="" style="height: 495px;width: 100%;background: url(/etiendahan/images/administrator/83308d059a311f50b04fa5a8d64102d2.jpg);background-position: center center;background-size: cover;background-repeat: no-repeat;"></div>
							</div>
							<div class="col-md-6">
								<div class="shop-name" style="font-size: 15px;">Shop name: <span style="font-size: 25px;">Malou Lingayen Bagoong</span></div>
								<div class="cellphone-num" style="font-size: 15px;">Cellphone #: <span style="font-size: 20px;">09164026774</span></div>
								<div class="email" style="font-size: 15px;">Email: <a href="mailto:allandulay69@gmail.com" target="_blank" style="text-decoration: none;"><span style="font-size: 20px;">allandulay69@gmail.com</span></a></div>
								<div class="address" style="font-size: 15px;">Address: <span style="font-size: 20px;">Malingas Dagupan City</span></div>
								<div style="font-size: 15px;">Map: <span style="font-size: 25px;"></span></div>
								<div id="map-address2" style="height: 331px; width: 100%;"></div>
								<script>
								var map;

								function initialize() {
								    // create the maps
								    var myOptions = {
								        zoom: 14,
								        center: {lat: 41.85, lng: -87.65}
								    }
								    map = new google.maps.Map(document.getElementById("map-address2"), myOptions);

								    var marker = new google.maps.Marker({
								      map: map,
								      position: {lat: 41.85, lng: -87.65}
								    });
								}

								initialize();
								</script>
							</div>
						</div>
					</div> -->
				</div>
				<!-- END OF SPECIALTY IN CITY PAGE -->

<!-- footer inner -->
<?php  
	include '../footer.php';
?>
</html>