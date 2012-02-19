<?php
	require 'constants.php';
	
	//1. create connection
	$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
	if (!$connection) {
		die("Database connection failed: " . mysql_error());
	}
	
	//2. select database
	$db_select = mysql_select_db(DB_NAME, $connection);
	if (!$db_select) {
		die("Database table selection failed: " . mysql_error());
	}


?>