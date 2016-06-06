<?php
	$mysqli = new mysqli('localhost', 'root', '06834265', 'ipstat');
	
	if(mysqli_connect_error()){
		die('Connect Error ('.mysqli_connect_errno() .')' . mysqli_connect_error());
	}
	$mysqli->query("SET NAMES 'utf8'");

?>