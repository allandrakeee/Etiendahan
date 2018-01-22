<?php  
	require_once "FacebookAPI/autoload.php";
	$fbClient = new Facebook\Facebook([
		'app_id' => '163260327783771',
		'app_secret' => '607d3be29994a494c82aaa30d386e7dd',
		'default_graph_version' => 'v2.6',
  		'persistent_data_handler"=>"session'
	]);

	$helper = $fbClient->getRedirectLoginHelper();
	// if (isset($_GET['state'])) {
	//     $helper->getPersistentDataHandler()->set('state', $_GET['state']);
	// }
?>