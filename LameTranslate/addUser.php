<?php 	//adduser.php
	require_once 'login.php'; 
	// $testing = false; 

	// $conn = new mysqli($hn, $un, $pw, $db);

	// if ($conn->connect_error) die(error("Database Connection Issue", $conn, $testing));

	$forename = $surname = $username = $password = $age = $email = ""; 

	if (isset($_POST['forename'])
		$forename = fix_string($_POST(['forename'])); 