<?php 
	$dbhost = '127.0.0.1';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'source';
	$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
 
	// Check connection
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}

	$url = "http://127.0.0.1:8080/accounting/view/";
?>
