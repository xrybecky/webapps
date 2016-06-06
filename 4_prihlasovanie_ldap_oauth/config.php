<?php

	$mysqli = new mysqli('localhost', 'root', '06834265', 'authentication');
	
	if(mysqli_connect_error()){
		die('Connect Error ('.mysqli_connect_errno() .')' . mysqli_connect_error());
		
	}
	$mysqli->query("SET NAMES 'utf8'");
	
	include_once("src/Google_Client.php");
	include_once("src/contrib/Google_Oauth2Service.php");

	/**
	 * Google Project API Credentials
	**/
	$clientId = '348708241383-tu9j83bsepmvlgm3genecsokfevsc09b.apps.googleusercontent.com'; //Google CLIENT ID
	$clientSecret = 'F09tSFl99Rt4Z5_nl9x4qXaZ'; //Google CLIENT SECRET
	$redirectUrl = 'http://147.175.98.229.nip.io/3Zadanie/home.php';  //return url (url to script)
	$homeUrl = 'home.php';  //return to home

	/**
	 * Google Client Configuration
	**/
	$gClient = new Google_Client();
	$gClient->setApplicationName('Login to codexworld.com');
	$gClient->setClientId($clientId);
	$gClient->setClientSecret($clientSecret);
	$gClient->setRedirectUri($redirectUrl);
	
	$google_oauthV2 = new Google_Oauth2Service($gClient);

	
?>