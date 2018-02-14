<?php  
	require '/db.php';
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
	<title>About Etiendahan | Online Shopping Marketplace here in Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="/etiendahan/temp-image/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/etiendahan/temp-img/favicon.ico" type="image/x-icon">
	
	<!-- link inner -->
	<?php  
		include 'header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="about-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include 'header.php';
				?>				

				<!-- ABOUT PAGE -->
				<div id="etiendahan-information-page">
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<div class="container">
								<li class="breadcrumb-item"><a href="/etiendahan/" title="Back to the frontpage"><i class="fa fa-home"></i>Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">About Etiendahan</li>
							</div>
						</ol>
					</nav>

					<div class="container about">
						<div class="row">
							<div class="col-md-12">
								<div class="title">
									What is Etiendahan?
								</div>

								<div class="info">
									<p>Online marketplace offers small and medium businesses to become seen in the Internet and compete with more established brands. Etiendahan empowers these entrepreneurs by placing all their online stores under one roof and gives customers the best shopping experience by providing amazing deals.</p>
									<p>One of the major hassles of shopping in malls is not really the selection of products, but in being unable to find the right products easily. In Etiendahan, product discovery is just a click away. Online shoppers can find new and interesting offers from local online shops, as well as items from their favorite brands.</p>
								</div>

								<div class="title margin-h">
									What are the available products in Etiendahan?
								</div>

								<div class="info">
									<p>Etiendahan has a wide selection of goods from sellers - from the authentic products here in Dagupan to the latest fashion trends and beauty products. Looking for home appliances for your home? How about toys and gift suggestions for kids and babies? Be amazed of Etiendahan’s huge assortment and competitive pricing. All these and more available in Etiendahan.com.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF ABOUT PAGE -->

<!-- footer inner -->
<?php  
	include 'footer.php';
?>
</html>