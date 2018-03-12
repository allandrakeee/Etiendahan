<?php  
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientID("305772274821-tk5st8b9bd9nucn1vptkt6lqhjo55g6v.apps.googleusercontent.com");
	$gClient->setClientSecret("YlWNNf53GjQCptznQwAf9cTP");
	$gClient->setApplicationName("Etiendahan");
	$gClient->setRedirectUri("http://localhost:8080/etiendahan/google-login/g-callback.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>