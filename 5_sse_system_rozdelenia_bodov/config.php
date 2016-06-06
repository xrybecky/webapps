<?php

	$mysqli = new mysqli('localhost', 'root', '06834265', 'teamproject');
	
	if(mysqli_connect_error()){
		die('Connect Error ('.mysqli_connect_errno() .')' . mysqli_connect_error());
	}
	$mysqli->query("SET NAMES 'utf8'");
		
	/*
	$query_test = "SELECT name FROM osoby WHERE id_person=5";
	$result = $mysqli->query($query_test)->fetch_object()->name;
	echo "result=".$result;
	*/
	 	
?>