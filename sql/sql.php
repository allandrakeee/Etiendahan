<?php  
	$host = 'localhost';
	$user = 'root';
	$password = 'Wcfajmeojnapa1';

	//create mysql connection
	$mysqli = new mysqli($host,$user,$password);
	if ($mysqli->connect_errno) {
	    printf("Connection failed: %s\n", $mysqli->connect_error);
	    die();
	}
?>