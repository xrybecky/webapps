<?php include_once("../config.php");
	$id_person = $_POST['idPerson'];
	$points = $_POST['points'];
	
	$query_update_points = "UPDATE  osoby SET points = '$points' WHERE id_person ='$id_person'";
	$mysqli->query($query_update_points);
	
	$query_select_points = "SELECT points FROM osoby WHERE id_person ='$id_person'";
	
	$points = $mysqli->query($query_select_points)->fetch_object()->points;
	echo $points;
?>