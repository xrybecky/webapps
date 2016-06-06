<?php include_once("../config.php");
	$id_person = $_POST['idPerson'];
	$status = $_POST['status'];
	
	$query_update_status = "UPDATE osoby SET status = '$status' WHERE id_person ='$id_person'";
	$mysqli->query($query_update_status);
	
	$query_select_status = "SELECT status FROM osoby WHERE id_person ='$id_person'";
	
	$status = $mysqli->query($query_select_status)->fetch_object()->status;
	echo $status;
?>