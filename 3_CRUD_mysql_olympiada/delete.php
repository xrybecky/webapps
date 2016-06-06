<?php include("config.php");
	$id_to_delete = $_GET['id'];
	$query_person_to_delete = "";
	
	$query_delete = "DELETE FROM osoby WHERE id_person=(SELECT id_person FROM umiestnenia WHERE id=$id_to_delete)";
	$mysqli->query($query_delete);
	$mysqli->close();
	header("Location: index.php?orderby=surname&ascdesc=ASC");
?>