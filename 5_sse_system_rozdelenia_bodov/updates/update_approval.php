<?php include_once("../config.php");
	$group = $_POST['group'];
	$approval = $_POST['approval'];
	
	$query_update_approval = "UPDATE  hodnotenie SET approval = '$approval' WHERE id_group ='$group'";
	$mysqli->query($query_update_approval);
	
	$query_select_approval = "SELECT approval FROM hodnotenie WHERE id_group ='$group'";
	
	$approval = $mysqli->query($query_select_approval)->fetch_object()->approval;
	echo $approval;
?>