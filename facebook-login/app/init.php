<?php  
	session_start();
	require_once '/../vendor/autoload.php';

	Facebook\FacebookSession::setDefaultApplication('163260327783771', '87fff403635df206542a02498c6bafa7');
	$facebook = new Facebook\FacebookRedirectLoginHelper('http://localhost:8080/etiendahan/facebook-login/index.php');

	try {
		if($session = $facebook->getSessionFromRedirect()) {
			$_SESSION['facebook'] = $session->getToken();
			header('location: /etiendahan/facebook-login/index/');
		}

		if(isset($_SESSION['facebook'])) {
			$session = new Facebook\FacebookSession($_SESSION['facebook']);
			$request = new Facebook\FacebookRequest($session, 'GET', '/me');
			$request = $request->execute();

			$user = $request->getGraphObject()->asArray();
			print_r($user);
		}
	} catch(Facebook\FacebookRequestException $e) {

	} catch(\Exception $e) {

	}
?>