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
	<title>Privacy Policy | Etiendahan Dagupan</title>
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
	<div id="privacy-policy-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include 'header.php';
				?>				

				<!-- PRIVACY POLICY PAGE -->
				<div id="etiendahan-information-page">
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<div class="container">
								<li class="breadcrumb-item"><a href="/etiendahan/" title="Back to the frontpage"><i class="fa fa-home"></i>Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
							</div>
						</ol>
					</nav>

					<div class="container privacy-policy">
						<div class="row">
							<div class="col-md-12">
								<h3 style="margin-top: 4px; font-size: 30px;">Privacy Policy</h3>
									<p class="margin-p">Last updated: February 09, 2018</p>
									<p class="margin-p">Etiendahan Dagupan ("us", "we", or "our") operates the http://localhost:8080/etiendahan/ website (the "Service").</p>
									<p class="margin-p">This page informs you of our policies regarding the collection, use and disclosure of Personal Information when you use our Service.</p>
									<p class="margin-p">We will not use or share your information with anyone except as described in this Privacy Policy. Privacy Policy for Etiendahan Dagupan based on the Privacy Policy example from TermsFeed.</p>
									<p class="margin-p">We use your Personal Information for providing and improving the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, accessible at https://www.etiendahan.com</p>

								<h3 class="margin-h">Information Collection And Use</h3>
									<p class="margin-p">While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. Personally identifiable information may include, but is not limited to, your name, postal address, other information ("Personal Information").</p>
								
								<h3 class="margin-h">Log Data</h3>
									<p class="margin-p">We collect information that your browser sends whenever you visit our Service ("Log Data"). This Log Data may include information such as your computer's Internet Protocol ("IP") address, browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages and other statistics.</p>

									<h3 class="margin-h">Cookies</h3>
									<p class="margin-p">Cookies are files with small amount of data, which may include an anonymous unique identifier. Cookies are sent to your browser from a web site and stored on your computer's hard drive.</p>
									<p class="margin-p">We use "cookies" to collect information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</p>

								<h3 class="margin-h">Service Providers</h3>
									<p class="margin-p">We may employ third party companies and individuals to facilitate our Service, to provide the Service on our behalf, to perform Service-related services or to assist us in analyzing how our Service is used.</p>
									<p class="margin-p">These third parties have access to your Personal Information only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>

								<h3 class="margin-h">Security</h3>
									<p class="margin-p">The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.</p>

								<h3 class="margin-h">Links To Other Sites</h3>
									<p class="margin-p">Our Service may contain links to other sites that are not operated by us. If you click on a third party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy of every site you visit.</p>
									<p class="margin-p">We have no control over, and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>

								<h3 class="margin-h">Children's Privacy</h3>
									<p class="margin-p">Our Service does not address anyone under the age of 13 ("Children").</p>
									<p class="margin-p">We do not knowingly collect personally identifiable information from children under 13. If you are a parent or guardian and you are aware that your Children has provided us with Personal Information, please contact us. If we discover that a Children under 13 has provided us with Personal Information, we will delete such information from our servers immediately.</p>

								<h3 class="margin-h">Changes To This Privacy Policy</h3>
									<p class="margin-p">We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>
									<p class="margin-p">You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>

								<h3 class="margin-h">Contact Us</h3>
									<p class="margin-p">If you have any questions about this Privacy Policy, please contact us <a href="/etiendahan/contact/" style="text-decoration: none;">here</a>.</p>
									<p class="margin-p"></p>
							</div>
						</div>
					</div>
				</div>
				<!-- END OF PRIVACY POLICY PAGE -->

<!-- footer inner -->
<?php  
	include 'footer.php';
?>
</html>