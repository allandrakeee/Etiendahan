<?php  
	require '../../db.php';
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');

	// Check if user is logged in using the session variable
	if ( $logged_in == false ) {
		$_SESSION['profile-cant-proceed-message'] = "You must log in before viewing your profile page.";
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
	<title>Address Book | Etiendahan Dagupan</title>
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
	<div id="address-page" class="main-container">
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
										<div class="card-header" role="tab" id="headingTwo">
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
										<div class="card-header active" role="tab" id="headingFour">
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
								<div class="tab-content"><h1>Your Address Book</h1>
									<button class="btn btn-primary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Add Address</button>
								</div>

								<!-- MODAL -->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Add A New Address</h5>
											</div>

											<div class="modal-body">
												<div class="container-fluid">
													<form id="submitAddAddress" action="/etiendahan/c8NLPYLt-functions/address-function/" method="POST">												
														<!-- fullname -->
														<div class="form-group row">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="inputFullnameAddAddress" placeholder="Fullname" name="fullname" required autofocus>
															</div>
														</div>

														<!-- phone number -->
														<div class="form-group row">
															<div class="col-sm-12">
																<input type="number" class="form-control" id="inputPhoneNumberAddAddress" name="phone_number" placeholder="Phone Number" required>
															</div>
														</div>

														<!-- postal code -->
														<div class="form-group row">
															<div class="col-sm-12">
																<input type="number" class="form-control" id="inputPostalCodeAddAddress" name="postal_code" placeholder="Postal Code" required>
															</div>
														</div>

														<!-- province -->
														<div class="form-group row">
															<div class="col-md-12">
																<select class="form-control" name="province" id="province" onChange="changeprovince(this.value);" required>
																	<option value="" selected>Province</option>
																    <option value="1">Abra</option>
																    <option value="2">Agusan Del Norte</option>
																    <option value="3">Agusan Del Sur</option>
																    <option value="4">Aklan</option>
																    <option value="5">Albay</option>
																    <option value="6">Antique</option>
																    <option value="7">Aurora</option>
																    <option value="8">Basilan</option>
																    <option value="9">Bataan</option>
																    <option value="10">Batangas</option>
																    <option value="11">Benguet</option>
																    <option value="12">Biliran</option>
																    <option value="13">Bohol</option>
																    <option value="14">Bukidnon</option>
																    <option value="15">Bulacan</option>
																    <option value="16">Cagayan</option>
																    <option value="17">Camarines Norte</option>
																    <option value="18">Camarines Sur</option>
																    <option value="19">Camiguin</option>
																    <option value="20">Capiz</option>
																    <option value="21">Catanduanes</option>
																    <option value="22">Cavite</option>
																    <option value="23">Cebu</option>
																    <option value="24">Compostela Valley</option>
																    <option value="25">Cotabato</option>
																    <option value="26">Davao Del Norte</option>
																    <option value="27">Davao Del Sur</option>
																    <option value="28">Davao Oriental</option>
																    <option value="29">Dinagat Islands</option>
																    <option value="30">Eastern Samar</option>
																    <option value="31">Guimaras</option>
																    <option value="32">Ifugao</option>
																    <option value="33">Ilocos Norte</option>
																    <option value="34">Ilocos Sur</option>
																    <option value="35">Iloilo</option>
																    <option value="36">Isabela</option>
																    <option value="37">Kalinga</option>
																    <option value="38">La Union</option>
																    <option value="39">Laguna</option>
																    <option value="40">Lanao Del Norte</option>
																    <option value="41">Lanao Del Sur</option>
																    <option value="42">Lazada Office</option>
																    <option value="43">Leyte</option>
																    <option value="44">Maguindanao</option>
																    <option value="45">Marinduque</option>
																    <option value="46">Masbate</option>
																    <option value="47">Metro Manila~Caloocan</option>
																    <option value="48">Metro Manila~Las Pinas</option>
																    <option value="49">Metro Manila~Makati</option>
																    <option value="50">Metro Manila~Malabon</option>
																    <option value="51">Metro Manila~Mandaluyong</option>
																    <option value="52">Metro Manila~Manila</option>
																    <option value="53">Metro Manila~Marikina</option>
																    <option value="54">Metro Manila~Muntinlupa</option>
																    <option value="55">Metro Manila~Navotas</option>
																    <option value="56">Metro Manila~Paranaque</option>
																    <option value="57">Metro Manila~Pasay</option>
																    <option value="58">Metro Manila~Pasig</option>
																    <option value="59">Metro Manila~Pateros</option>
																    <option value="60">Metro Manila~Quezon City</option>
																    <option value="61">Metro Manila~San Juan</option>
																    <option value="62">Metro Manila~Taguig</option>
																    <option value="63">Metro Manila~Valenzuela</option>
																    <option value="64">Misamis Occidental</option>
																    <option value="65">Misamis Oriental</option>
																    <option value="66">Mountain Province</option>
																    <option value="67">Negros Occidental</option>
																    <option value="68">Negros Oriental</option>
																    <option value="69">North Cotabato</option>
																    <option value="70">Northern Samar</option>
																    <option value="71">Nueva Ecija</option>
																    <option value="72">Nueva Vizcaya</option>
																    <option value="73">Occidental Mindoro</option>
																    <option value="74">Oriental Mindoro</option>
																    <option value="75">Palawan</option>
																    <option value="76">Pampanga</option>
																    <option value="77">Pangasinan</option>
																    <option value="78">Quezon</option>
																    <option value="79">Quirino</option>
																    <option value="80">Rizal</option>
																    <option value="81">Romblon</option>
																    <option value="82">Sarangani</option>
																    <option value="83">Siquijor</option>
																    <option value="84">Sorsogon</option>
																    <option value="85">South Cotabato</option>
																    <option value="86">Southern Leyte</option>
																    <option value="87">Sultan Kudarat</option>
																    <option value="88">Sulu</option>
																    <option value="89">Surigao Del Norte</option>
																    <option value="90">Surigao Del Sur</option>
																    <option value="92">Tarlac</option>
																    <option value="93">Tawi~Tawi</option>
																    <option value="94">Western Samar</option>
																    <option value="95">Zambales</option>
																    <option value="96">Zamboanga Del Norte</option>
																    <option value="97">Zamboanga Del Sur</option>
																    <option value="98">Zamboanga Sibugay</option>
																</select>
															</div>
														</div>

														<!-- city -->
														<div class="form-group row">
															<div class="col-md-12">
																<select class="form-control" name="city" id="city" onChange="changemunicipality(this.value);" required>
																	<option value="">City</option>
																</select>
															</div>
														</div>

														<!-- barangay -->
														<div class="form-group row">
															<div class="col-md-12">
																<select class="form-control" name="barangay" id="barangay" required>
																	<option value="">Barangay</option>
																</select>
															</div>
														</div>

														<!-- complete address -->
														<div class="form-group row">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="inputCompleteAddressAddAddress" name="complete_address" placeholder="Complete Address (House Number, Building and Street Name)" required>
															</div>
														</div>

														<!-- other note -->
														<div class="form-group row">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="inputOtherNotesAddAddress" name="other_notes" placeholder="Other notes" required>
															</div>
														</div>
														<input type="hidden" name="id" id="id">
													</form>
												</div>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-primary" form="submitAddAddress">Submit</button>
											</div>
										</div>
									</div>
								</div>
								
								<!-- If address is empty -->
								<?php $result = $mysqli->query("SELECT * FROM tbl_address WHERE email = '$email'");
									if($result->num_rows == 0):
								?>
									<p>You don't have addresses yet.</p>
								<?php else: ?>
									<!-- If address is not empty -->
									<?php  
										$address_result = $mysqli->query("SELECT * FROM tbl_address WHERE email = '$email'");
										while($address_row = mysqli_fetch_assoc($address_result)):
									?>
										<div class="row mb-1">
											<div class="col-md-10">
													<div class="address-name-customer"><?php echo $address_row['fullname']; ?></div>
													<div class="address-complete"><?php echo $address_row['complete_address']; ?></div>
													<div class="address"><?php echo $address_row['city'].' - '.$address_row['barangay']; ?></div>
													<div class="address-other-notes"><?php echo $address_row['other_notes']; ?></div>
													<div class="address-phone-number"><?php echo $address_row['phone_number']; ?></div>
													<div class="separator"></div>
											</div>
											<div class="col-md-2 text-right">
												<a class="address-fa address-update" data-toggle="modal" data-target="#modifyModal" id="<?php echo $address_row['id'] ?>"><i class="fa fa-edit"></i></a>
												<span>|</span>
												<a class="address-fa address-delete" href="/etiendahan/customer/address/delete/" id="<?php echo $address_row['id'] ?>"><i class="fa fa-close"></i></a>
												<?php if($address_row['default_address'] == 0): ?>
													<a class="address-delete"  href="/etiendahan/customer/address/set-as-default/" id="<?php echo $address_row['id'] ?>"><button class="btn btn-primary">Set As Default</button></a>
												<?php endif; ?>
											</div>
										</div>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF CUSTOMER PAGE SECTION 1 -->

				<!-- POPUP NOTIFICATION - greetings -->
				<div id="popup-notification" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close" class="popup-close"><i class="fa fa-times"></i></div>
					<div class="popup-title text-center mt-1"><i class="fa fa-info-circle mr-1 alert-primary"></i>Completed!</div>
					<div class="popup-content text-center">
						<?php  
							// Display message only once
							if ( isset($_SESSION['success-message']) ) {
								echo $_SESSION['success-message'];
								// Don't annoy the user with more messages upon page refresh
								unset( $_SESSION['success-message'] );
							}
						?>
					</div>
				</div>
				<!-- END OF POPUP NOTIFICATION -->

<!-- footer inner -->
<?php  
	include '../../footer.php';
?>
</html>