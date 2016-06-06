<?php include_once("../config.php");

	$group = $_POST['group'];
	$query_select_approval = "SELECT approval FROM hodnotenie WHERE id_group ='$group'";
	$approval = $mysqli->query($query_select_approval)->fetch_object()->approval;
	echo $approval;
?>
