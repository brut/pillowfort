<?php
	ini_set('display_errors', 'On');
	$handle = fopen($_SERVER['DOCUMENT_ROOT'].'/database/accounts.txt', 'r');

	$username = $_POST["username"];
	$password = $_POST["password"];

	while($line = fgets($handle)) {
		$credentials = explode('::', $line); //[0] = username, [2] = email, [1] = password [3] = level
		$credentials[3] = str_replace("\r\n", "", $credentials[3]);

		if (strcmp($credentials[0], $username) == 0 && strcmp($credentials[1], $password) == 0) {
			$userString = $credentials[0];
			$userLevel = $credentials[3];
			session_start();
			$_SESSION['userString'] = $userString;
			$_SESSION['userLevel'] = $userLevel;
			//setcookie( 'userString', ''.$userString, time()+60*30, '/');
			echo "Successfully logged in!";
			header( "refresh:1;url=../../" );
		}
	}

	if(!isset($_SESSION['userString']))
		echo "failed to log in";
	 
?>