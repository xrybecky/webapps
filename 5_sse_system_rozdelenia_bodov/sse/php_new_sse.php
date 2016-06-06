<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header("Connection: keep-alive");

include_once("../config.php");

	$group = $_GET['g'];
	
	$query_students = "SELECT id_person, points, status FROM osoby WHERE id_group='$group'";
	$students = $mysqli->query($query_students);
	
	$result = array();
	while($student = $students->fetch_array(MYSQL_ASSOC)){
		$result[] = $student;
	}
	
	$result = json_encode($result);
	echo "data: {$result}\n\n";

	flush();
?>