<?php  
	require '../../db.php';
	session_start();
  	
  	$email = ((isset($_SESSION['email']) && $_SESSION['email'] != '')?htmlentities($_SESSION['email']):'');
	$city_post 	= ((isset($_POST['city']) && $_POST['city'] != '')?htmlentities($_POST['city']):'');
	$barangay_post 	= ((isset($_POST['barangay']) && $_POST['barangay'] != '')?htmlentities($_POST['barangay']):'');
	
	echo $barangay_post;
	
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
	<title>Address Book | Etiendahan</title>
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
													<?php  
														$email =  $_SESSION['email'];
													  	$result = $mysqli->query("SELECT COUNT(DISTINCT unique_hash_id) as 'total' FROM tbl_orders WHERE email = '$email' ORDER BY unique_hash_id");
												 		if($result->num_rows == 0):
													?>
													Orders
													<?php else: ?>
														<?php $row = $result->fetch_assoc(); ?>
													Orders <?php $total_row = $row['total']; echo ($row['total'] == 0)? '' : "($total_row)" ?>
													<?php endif; ?>
												</a>
											</h5>
										</div>
									</div>
									<div class="card">
										<div class="card-header" role="tab" id="headingThree">
											<h5 class="mb-0">
												<a href="/etiendahan/customer/wishlists/">
												<?php  
													$email =  $_SESSION['email'];
												  	$result = $mysqli->query("SELECT COUNT(*) as 'total' FROM tbl_wishlists WHERE email = '$email'");
											 		if($result->num_rows == 0):
												?>
												Wishlists
												<?php else: ?>
													<?php $row = $result->fetch_assoc(); ?>
												Wishlists <?php $total_row = $row['total']; echo ($row['total'] == 0)? '' : "($total_row)" ?>
												<?php endif; ?>
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
																<?php
																	$result = $mysqli->query("SELECT * FROM tbl_refprovince ORDER BY provDesc");
																?>	
																	<select class="form-control" id="province" name="province" required>"
																		<option value=''>Province</option>"
																<?php  
																	while($prov_row = mysqli_fetch_assoc($result)){
																		$prov_id = $prov_row['provCode'];
																		$prov_name = strtolower($prov_row['provDesc']);
																?>
																		<option value='<?php echo $prov_id?>'><?php echo ucwords($prov_name) ?></option>
																<?php 
																	}
																 ?>
																	</select>	
															</div>
														</div>

														<!-- city -->
														<div class="form-group row">
															<div class="col-md-12">
																<select class="form-control" name="city" id="city" required>
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
																<input type="text" class="form-control" id="inputOtherNotesAddAddress" name="other_notes" placeholder="Other notes">
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
										$count = 1;
										$address_result = $mysqli->query("SELECT * FROM tbl_address WHERE email = '$email'");
										while($address_row = mysqli_fetch_assoc($address_result)):
									?>
										<div class="row mb-1">
											<div class="col-md-10">
													<div class="address-name-customer"><?php echo $address_row['fullname']; ?></div>
													<div class="address-name-customer"><?php echo $address_row['postal_code']; ?></div>
													<div class="address-complete"><?php echo $address_row['complete_address']; ?></div>
													<div class="address">
												        <?php  
												        	// province
												        	$province_id = $address_row['province'];
												        	$province_result = $mysqli->query("SELECT * FROM tbl_refprovince WHERE provCode = '$province_id'");
															$province_row = $province_result->fetch_assoc();
															$format_province = strtolower($province_row['provDesc']);

												        	// city mun
												        	$citymun_id = $address_row['city'];
												        	$citymun_result = $mysqli->query("SELECT * FROM tbl_refcitymun WHERE citymunCode = '$citymun_id'");
															$citymun_row = $citymun_result->fetch_assoc();
															$format_citymun = strtolower($citymun_row['citymunDesc']);

												        	// barangay
												        	$barangay_id = $address_row['barangay'];
												        	$barangay_result = $mysqli->query("SELECT * FROM tbl_refbrgy WHERE brgyCode = '$barangay_id'");
															$barangay_row = $barangay_result->fetch_assoc();
															$format_barangay = strtolower($barangay_row['brgyDesc']);
												        ?>
														<?php echo ucwords($format_province).' - '.ucwords($format_citymun).' - '.ucwords($format_barangay); ?>
															
													</div>
													<div class="address-phone-number"><?php echo $address_row['phone_number']; ?></div>
													<div class="address-other-notes"><?php echo $address_row['other_notes']; ?></div>
													<div class="separator"></div>
											</div>
											<div class="col-md-2 text-right">
												<a class="address-fa address-update<?php echo $count; ?>" style="cursor: pointer;" data-toggle="modal" data-target="#modifyModal-<?php echo $address_row['id'] ?>" id="<?php echo $address_row['id'] ?>"><i class="fa fa-edit"></i></a>

												<!-- MODIFY MODAL -->
												<div class="modal fade modify" id="modifyModal-<?php echo $address_row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel-<?php echo $address_row['id'] ?>" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="modifyModalLabel-<?php echo $address_row['id'] ?>">Modify Address</h5>
															</div>

															<div class="modal-body">
																<div class="container-fluid">
																	<form id="submitModifyAddress<?php echo $address_row['id']; ?>" action="/etiendahan/customer/address/modify/" method="POST">
																		<input type="text" id="id<?php echo $address_row['id']; ?>" name="id<?php echo $count; ?>" value="<?php echo $address_row['id']; ?>" hidden>								
																		<!-- fullname -->
																		<div class="form-group row">
																			<div class="col-sm-12">
																				<input type="text" class="form-control" id="fullname<?php echo $address_row['id']; ?>" placeholder="Fullname" name="fullname<?php echo $count; ?>" value="<?php echo $address_row['fullname']; ?>" required autofocus>
																			</div>
																		</div>

																		<!-- phone number -->
																		<div class="form-group row">
																			<div class="col-sm-12">
																				<input type="number" class="form-control" id="phone_number<?php echo $address_row['id']; ?>" name="phone_number<?php echo $count; ?>" placeholder="Phone Number" value="<?php echo $address_row['phone_number']; ?>" required>
																			</div>
																		</div>

																		<!-- postal code -->
																		<div class="form-group row">
																			<div class="col-sm-12">
																				<input type="number" class="form-control" id="postal_code<?php echo $address_row['id']; ?>" name="postal_code<?php echo $count; ?>" placeholder="Postal Code" value="<?php echo $address_row['postal_code']; ?>" required>
																			</div>
																		</div>

																		<!-- province -->
																		<div class="form-group row">
																			<div class="col-md-12">
																				<?php
																					$result = $mysqli->query("SELECT * FROM tbl_refprovince ORDER BY provDesc");
																				?>	
																					<select class="form-control" id="province<?php echo $count; ?>" name="province<?php echo $count; ?>" required>"
																						<option value=''>Province</option>"
																				<?php  
																					while($prov_row = mysqli_fetch_assoc($result)){
																						$prov_id = $prov_row['provCode'];
																						$prov_name = strtolower($prov_row['provDesc']);
																				?>
																						<option value='<?php echo $prov_id?>' <?php if($address_row['province'] == $prov_id) echo 'selected'; ?>><?php echo ucwords($prov_name) ?></option>
																				<?php 
																					}
																				 ?>
																					</select>	
																			</div>
																		</div>

																		<!-- city -->
																		<div class="form-group row">
																			<div class="col-md-12">
																				<select class="form-control" name="city<?php echo $count; ?>" id="city<?php echo $count; ?>" required>
																					<option value="">City</option>
																				</select>
																			</div>
																		</div>

																		<!-- barangay -->
																		<div class="form-group row">
																			<div class="col-md-12">
																				<select class="form-control" name="barangay<?php echo $count; ?>" id="barangay<?php echo $count; ?>" required>
																					<option value="">Barangay</option>
																				</select>
																			</div>
																		</div>

																		<!-- complete address -->
																		<div class="form-group row">
																			<div class="col-sm-12">
																				<input type="text" class="form-control" id="complete_address<?php echo $count; ?>" name="complete_address<?php echo $count; ?>" placeholder="Complete Address (House Number, Building and Street Name)" value="<?php echo $address_row['complete_address']; ?>" required>
																			</div>
																		</div>

																		<!-- other note -->
																		<div class="form-group row">
																			<div class="col-sm-12">
																				<input type="text" class="form-control" id="other_notes<?php echo $count; ?>" name="other_notes<?php echo $count; ?>" placeholder="Other notes" value="<?php echo $address_row['other_notes']; ?>" required>
																			</div>
																		</div>
																		<input type="hidden" name="id" id="id">
																	</form>
																</div>
															</div>

															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
																<button type="submit" name="submitModifyAddress<?php echo $address_row['id']; ?>" id="submitModifyAddress<?php echo $address_row['id']; ?>" onclick="modifyAddress(<?php echo $count; ?>)" class="btn btn-primary-save modify-address" form="submitModifyAddress<?php echo $address_row['id']; ?>">Save</button>
															</div>
														</div>
													</div>
												</div>
												<span>|</span>
												<a class="address-fa address-delete" href="/etiendahan/customer/address/delete/" id="<?php echo $address_row['id'] ?>"><i class="fa fa-close"></i></a>
												<?php if($address_row['default_address'] == 0): ?>
													<a class="address-delete"  href="/etiendahan/customer/address/set-as-default/" id="<?php echo $address_row['id'] ?>"><button class="btn btn-primary">Set As Default</button></a>
												<?php endif; ?>
											</div>
										</div>
									<?php $count++; endwhile; $final_value_count = $count-1; ?>
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

				<!-- POPUP NOTIFICATION -->
				<div id="popup-notification-logout-redirect" class="wow fadeIn">
					<div id="etiendahan-notification">Etiendahan Notification</div>
					<div id="popup-close-logout-redirect" class="popup-close"><i class="fa fa-times"></i></div>
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

				<!-- SECTION 7 -->
				<div id="etiendahan-section-7" class="etiendahan-section">
					<div class="container">
						<div class="row">
							<div class="col-md-4 border-insert">
								<div class="about">
									<!-- <a href="http://localhost:8080/etiendahan/"><img src="http://via.placeholder.com/225x70/" alt=""></a> -->
									<a href="http://localhost:8080/etiendahan/"><img src="/etiendahan/temp-img/etiendahan-logo.png" alt=""></a>
									<div class="about-text">
										<p>Join Etiendahan to find everything you need at the best prices. Shopping online at Philippines’ best marketplace cannot get any easier.</p>
										<p>Etiendahan provides the right tools to support all our sellers on our marketplace platform. List your products in less than 30 seconds. Sell better and get more exposure for your products.</p>
									</div>

									<div class="social">
										<div class="title-footer">FOLLOW US</div>
										<ul class="social-icons">
											<li class="facebook">
												<a class="fa fa-facebook" href="https://web.facebook.com/etiendahan/" target="_blank"></a>
											</li>
											<li class="instagram">
												<a class="fa fa-instagram" href="https://www.instagram.com/etiendahan/" target="_blank"></a>
											</li>
											<li class="twitter">
												<a class="fa fa-twitter" href="https://twitter.com/etiendahan/" target="_blank"></a>
											</li>
											<li class="google-plus">
												<a class="fa fa-google-plus" href="https://plus.google.com/u/2/110265818297635318631/" target="_blank"></a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-md-2 ml-5">
								<div class="footer-info">
									<div class="footer-title">
										<h3>INFORMATION</h3>
									</div>
									<div class="sub-info">
										<ul class="footer-list">
											<li>
												<a href="/etiendahan/about/"><i class="fa fa-square-o"></i><i class="fa fa-square" style="display: none"></i>About Etiendahan</a>
											</li>
											<li>
												<a href="/etiendahan/terms-conditions/"><i class="fa fa-square-o"></i><i class="fa fa-square" style="display: none"></i>Terms & Conditions</a>
											</li>
											<li>
												<a href="/etiendahan/privacy-policy/"><i class="fa fa-square-o"></i><i class="fa fa-square" style="display: none"></i>Privacy Policy</a>
											</li>
											<li>
												<a href="/etiendahan/contact/"><i class="fa fa-square-o"></i><i class="fa fa-square" style="display: none"></i>Contact Us</a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-md-4 ml-5">
								<div class="footer-info">
									<div class="footer-title">
										<h3 class="like-page">Like our facebook page</h3>
									</div>
								</div>

								<!-- Your like button code -->
								<div id="fboverlay" class="fb-like" data-href="https://web.facebook.com/etiendahan/" data-layout="standard" data-width="300" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF SECTION 7 -->

				<!-- SECTION 8 -->
				<div id="etiendahan-section-8" class="etiendahan-section">
					<div class="container">
						<div class="footer-title">
							Copyright © <?php echo date("Y"); ?> by <a href="https://allandrake.wixsite.com/freelancer" target="_blank">ADPD</a>. All rights reserved.
						</div>
					</div>
				</div>
				<!-- END OF SECTION 8 -->					
			</div>
		</div>
	</div>
	
	<script>
		// expanding search
		/*!
		 * classie - class helper functions
		 * from bonzo https://github.com/ded/bonzo
		 * 
		 * classie.has( elem, 'my-class' ) -> true/false
		 * classie.add( elem, 'my-new-class' )
		 * classie.remove( elem, 'my-unwanted-class' )
		 * classie.toggle( elem, 'my-class' )
		 */

		/*jshint browser: true, strict: true, undef: true */
		/*global define: false */

		( function( window ) {

		'use strict';

		// class helper functions from bonzo https://github.com/ded/bonzo

		function classReg( className ) {
		  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
		}

		// classList support for class management
		// altho to be fair, the api sucks because it won't accept multiple classes at once
		var hasClass, addClass, removeClass;

		if ( 'classList' in document.documentElement ) {
		  hasClass = function( elem, c ) {
		    return elem.classList.contains( c );
		  };
		  addClass = function( elem, c ) {
		    elem.classList.add( c );
		  };
		  removeClass = function( elem, c ) {
		    elem.classList.remove( c );
		  };
		}
		else {
		  hasClass = function( elem, c ) {
		    return classReg( c ).test( elem.className );
		  };
		  addClass = function( elem, c ) {
		    if ( !hasClass( elem, c ) ) {
		      elem.className = elem.className + ' ' + c;
		    }
		  };
		  removeClass = function( elem, c ) {
		    elem.className = elem.className.replace( classReg( c ), ' ' );
		  };
		}

		function toggleClass( elem, c ) {
		  var fn = hasClass( elem, c ) ? removeClass : addClass;
		  fn( elem, c );
		}

		var classie = {
		  // full names
		  hasClass: hasClass,
		  addClass: addClass,
		  removeClass: removeClass,
		  toggleClass: toggleClass,
		  // short names
		  has: hasClass,
		  add: addClass,
		  remove: removeClass,
		  toggle: toggleClass
		};

		// transport
		if ( typeof define === 'function' && define.amd ) {
		  // AMD
		  define( classie );
		} else {
		  // browser global
		  window.classie = classie;
		}

		})( window );

		;window.Modernizr=function(a,b,c){function u(a){j.cssText=a}function v(a,b){return u(prefixes.join(a+";")+(b||""))}function w(a,b){return typeof a===b}function x(a,b){return!!~(""+a).indexOf(b)}function y(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:w(f,"function")?f.bind(d||b):f}return!1}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m={},n={},o={},p=[],q=p.slice,r,s={}.hasOwnProperty,t;!w(s,"undefined")&&!w(s.call,"undefined")?t=function(a,b){return s.call(a,b)}:t=function(a,b){return b in a&&w(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=q.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(q.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(q.call(arguments)))};return e});for(var z in m)t(m,z)&&(r=z.toLowerCase(),e[r]=m[z](),p.push((e[r]?"":"no-")+r));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)t(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},u(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+p.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};

		/**
		 * uisearch.js v1.0.0
		 * http://www.codrops.com
		 *
		 * Licensed under the MIT license.
		 * http://www.opensource.org/licenses/mit-license.php
		 * 
		 * Copyright 2013, Codrops
		 * http://www.codrops.com
		 */
		;( function( window ) {
			
			'use strict';
			
			// EventListener | @jon_neal | //github.com/jonathantneal/EventListener
			!window.addEventListener && window.Element && (function () {
			   function addToPrototype(name, method) {
				  Window.prototype[name] = HTMLDocument.prototype[name] = Element.prototype[name] = method;
			   }
			 
			   var registry = [];
			 
			   addToPrototype("addEventListener", function (type, listener) {
				  var target = this;
			 
				  registry.unshift({
					 __listener: function (event) {
						event.currentTarget = target;
						event.pageX = event.clientX + document.documentElement.scrollLeft;
						event.pageY = event.clientY + document.documentElement.scrollTop;
						event.preventDefault = function () { event.returnValue = false };
						event.relatedTarget = event.fromElement || null;
						event.stopPropagation = function () { event.cancelBubble = true };
						event.relatedTarget = event.fromElement || null;
						event.target = event.srcElement || target;
						event.timeStamp = +new Date;
			 
						listener.call(target, event);
					 },
					 listener: listener,
					 target: target,
					 type: type
				  });
			 
				  this.attachEvent("on" + type, registry[0].__listener);
			   });
			 
			   addToPrototype("removeEventListener", function (type, listener) {
				  for (var index = 0, length = registry.length; index < length; ++index) {
					 if (registry[index].target == this && registry[index].type == type && registry[index].listener == listener) {
						return this.detachEvent("on" + type, registry.splice(index, 1)[0].__listener);
					 }
				  }
			   });
			 
			   addToPrototype("dispatchEvent", function (eventObject) {
				  try {
					 return this.fireEvent("on" + eventObject.type, eventObject);
				  } catch (error) {
					 for (var index = 0, length = registry.length; index < length; ++index) {
						if (registry[index].target == this && registry[index].type == eventObject.type) {
						   registry[index].call(this, eventObject);
						}
					 }
				  }
			   });
			})();

			// http://stackoverflow.com/a/11381730/989439
			function mobilecheck() {
				var check = false;
				(function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
				return check;
			}
			
			// http://www.jonathantneal.com/blog/polyfills-and-prototypes/
			!String.prototype.trim && (String.prototype.trim = function() {
				return this.replace(/^\s+|\s+$/g, '');
			});

			function UISearch( el, options ) {	
				this.el = el;
				this.inputEl = el.querySelector( 'form > input.sb-search-input' );
				this._initEvents();
			}

			UISearch.prototype = {
				_initEvents : function() {
					var self = this,
						initSearchFn = function( ev ) {
							ev.stopPropagation();
							// trim its value
							self.inputEl.value = self.inputEl.value.trim();
							
							if( !classie.has( self.el, 'sb-search-open' ) ) { // open it
								ev.preventDefault();
								self.open();
							}
							else if( classie.has( self.el, 'sb-search-open' ) && /^\s*$/.test( self.inputEl.value ) ) { // close it
								ev.preventDefault();
								self.close();
							}
						}

					this.el.addEventListener( 'click', initSearchFn );
					this.el.addEventListener( 'touchstart', initSearchFn );
					this.inputEl.addEventListener( 'click', function( ev ) { ev.stopPropagation(); });
					this.inputEl.addEventListener( 'touchstart', function( ev ) { ev.stopPropagation(); } );
				},
				open : function() {
					var self = this;
					classie.add( this.el, 'sb-search-open' );
					// focus the input
					if( !mobilecheck() ) {
						this.inputEl.focus();
					}
					// close the search input if body is clicked
					var bodyFn = function( ev ) {
						self.close();
						this.removeEventListener( 'click', bodyFn );
						this.removeEventListener( 'touchstart', bodyFn );
					};
					document.addEventListener( 'click', bodyFn );
					document.addEventListener( 'touchstart', bodyFn );
				},
				close : function() {
					this.inputEl.blur();
					classie.remove( this.el, 'sb-search-open' );
				}
			}

			// add to global namespace
			window.UISearch = UISearch;

		} )( window );

		new UISearch( document.getElementById( 'sb-search' ) );
		
	</script>
	<!-- Development - Normal import of theme.js -->
	<script src="/etiendahan/assets/js/theme.js"></script>
	<script>
		<?php for($i=1;$i<=$final_value_count;$i++): ?>
			function get_citymuncode_options<?php echo $i; ?>(selected) {

				if(typeof selected === 'object') {
					var selected = '';
				}

			    var address_update = $('.address-update<?php echo $i; ?>').attr('id');
				var province_id = $('#province<?php echo $i; ?>').val();
				jQuery.ajax({
					url: '/etiendahan/c8NLPYLt-functions/address-citymun-categories1/',
					type: 'POST',
					data: {address_update: address_update, province_id : province_id, selected : selected},
					success: function(data){
						jQuery('#city<?php echo $i; ?>').html(data);
					},
					error: function(){alert("Something went wrong with the child options.")}
				});
			}

			jQuery('select[name="province<?php echo $i; ?>"]').change(function(){
				get_citymuncode_options<?php echo $i; ?>();
			});
			jQuery('document').ready(function(){
				get_citymuncode_options<?php echo $i; ?>();
			});	
		<?php endfor; ?>


		<?php for($i1=1;$i1<=$final_value_count;$i1++): ?>
			function get_barangay_options<?php echo $i1; ?>(selected) {
				if(typeof selected === 'object') {
					var selected = '';
				}

			    var address_update = $('.address-update<?php echo $i1; ?>').attr('id');
				var citymun_id = jQuery('#city<?php echo $i1; ?>').val();
				// alert(address_update);
				jQuery.ajax({
					url: '/etiendahan/c8NLPYLt-functions/address-barangay-categories1/',
					type: 'POST',
					data: {address_update : address_update, citymun_id : citymun_id, selected : selected},
					success: function(data){
						jQuery('#barangay<?php echo $i1; ?>').html(data);
					},
					error: function(){alert("Something went wrong with the child options.")}
				});
			}

			jQuery('select[name="city<?php echo $i1; ?>"]').change(function(){
				get_barangay_options<?php echo $i1; ?>();
			});

			jQuery('document').ready(function(){
				get_barangay_options<?php echo $i1; ?>();
			});	
		<?php endfor; ?>


		function modifyAddress(value) {
			var address_id = $('input[name=id'+value+']').val();
			var fullname_modify = $('input[name=fullname'+value+']').val();
			var phone_number_modify = $('input[name=phone_number'+value+']').val();
			var postal_code_modify = $('input[name=postal_code'+value+']').val();
			var complete_address_modify = $('input[name=complete_address'+value+']').val();
			var other_notes_modify = $('input[name=other_notes'+value+']').val();
			var province_modify = $('select[name=province'+value+']').val();
			var city_modify = $('select[name=city'+value+']').val();
			var barangay_modify = $('select[name=barangay'+value+']').val();

			// alert(address_id);
			// alert(fullname_modify);
			// alert(phone_number_modify);
			// alert(postal_code_modify);
			// alert(complete_address_modify);
			// alert(other_notes_modify);
			// alert(province_modify);
			// alert(city_modify);
			// alert(barangay_modify);

			$.post("/etiendahan/c8NLPYLt-functions/address-modify/", 
	    		{
	    			"address_id"				: address_id, 
	    			"fullname_modify"			: fullname_modify, 
	    			"phone_number_modify"		: phone_number_modify, 
	    			"postal_code_modify"		: postal_code_modify, 
	    			"province_modify"			: province_modify, 
	    			"city_modify"				: city_modify, 
	    			"barangay_modify"			: barangay_modify,  
	    			"complete_address_modify"	: complete_address_modify, 
	    			"other_notes_modify"		: other_notes_modify
	    		});
		}
	</script>
	
	<!-- Development - Minifies import of theme.js -->
	<!-- <script src="/etiendahan/assets/js/theme.min.js"></script> -->

	<!-- Production - Normal import of theme.js -->
	<!-- <script src="/assets/js/theme.js"></script> -->

	<!-- Production - Minified import of theme.js -->
	<!-- <script src="/assets/js/theme.min.js"></script> -->
</body>