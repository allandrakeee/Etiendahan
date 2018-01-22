<?php  
	require_once 'app/init.php';
	unset($_SESSION['facebook']);

	header('location: /etiendahan/facebook-login/index/');
?>	