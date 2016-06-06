<?php include_once("../config.php");
	$id_person = $_POST['idPerson'];
	$group = $_POST['group'];
	
	// JOIN na hodnotenie a osoby pre výber kapitána
	$query_update_cpt = "UPDATE  hodnotenie SET cpt = '$id_person' WHERE id_group ='$group'";
	$mysqli->query($query_update_cpt);
	
	$query_select_cpt = "SELECT name, surname FROM osoby WHERE id_person ='$id_person'";
	$cpt = $mysqli->query($query_select_cpt)->fetch_array(MYSQL_ASSOC);
	$result = json_encode($cpt);
	echo $result;
?>