<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header("Connection: keep-alive");

include_once("../config.php");

		$query_group_num = "SELECT MAX(id_group) AS num FROM hodnotenie";
		$group_num = $mysqli->query($query_group_num)->fetch_object()->num;
		
//	while(1){
		
		
		$result = array();
		
		$result_by_group = array();
		for($i=1;$i<=$group_num;$i++){
			$query_students = "SELECT o.id_person, o.points, o.status, h.points, h.approval FROM osoby AS o 
								JOIN hodnotenie AS h ON o.id_group=h.id_group WHERE id_role=2 AND id_group='$i'";
			$students = $mysqli->query($query_students);
			$result = array();
			while($student = $students->fetch_array(MYSQL_ASSOC)){
				$result[] = $student;
			}	
			$result_by_group[] = $result;
		}
		
		$result_by_group = json_encode($result_by_group);
		
		echo "data: {$result_by_group}\n\n";
		flush();
//	}
	
	
	

?>