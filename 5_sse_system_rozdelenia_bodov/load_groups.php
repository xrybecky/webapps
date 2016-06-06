<?php // TABULKY TIMOV
	for($i=1;$i<=$group_num;$i++){
		$query_group = "SELECT points, approval FROM hodnotenie WHERE id_group='$i'";
		$group = $mysqli->query($query_group)->fetch_array(MYSQL_ASSOC);
		$g_points = $group['points'];
		$g_app = $group['approval'];
		
		if($g_app == null){
			$g_app_string = "Čaká na schválenie";
		}else if($g_app == 1) $g_app_string = "Schválené";
		else if($g_app == 0) $g_app_string = "Neschválené";
		
		
		
		$query_students = "SELECT id_person, name, surname, points, status FROM osoby WHERE id_role=2 AND id_group='$i'";
		$students = $mysqli->query($query_students);
		$result = array();
		echo "<div class=\"row\">".PHP_EOL;
			echo "<div class=\"col-md-5 col-md-offset-4 team-table\">".PHP_EOL;
				echo "<div class=\"col-md-3\">";
					echo "<h4>Tím č. ".$i."</h4>";
				echo "</div>";
				
				if($g_app == null){
					echo "<div id=\"approval_".$i."\">";
						echo "<div id=\"buttonBox_".$i."\">";
							
							echo "<div class=\"col-md-4\">";
								echo "<button class=\"alowButton\" value=\"".$i."\">Súhlasím</button>";
							echo "</div>";
							echo "<div class=\"col-md-4\">";
								echo "<button class=\"denyButton\" value=\"".$i."\">Nesúhlasím</button>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
				}
				echo "<table>".PHP_EOL;
					echo "<thead>".PHP_EOL;
						echo "<tr>".PHP_EOL;
							echo "<th>MENO</th><th>PRIEZVISKO</th><th>BODY</th><th>STATUS</th>".PHP_EOL;
						echo "</tr>".PHP_EOL;
					echo "</thead><tbody>".PHP_EOL;
						while($student = $students->fetch_array(MYSQL_ASSOC)){
							echo "<tr><td>".$student['name']."</td><td>".$student['surname']."</td><td id=\"points_".$student['id_person']."\">".$student['points']."</td><td id=\"status_".$student['id_person']."\">".$student['status']."</td>".PHP_EOL;
						}	
					echo "</tbody>".PHP_EOL;
					echo "<tr>".PHP_EOL;
							echo "<th colspan=\"2\">Celkovo bodov: ".$g_points."</th><th id=\"th_approval_".$i."\" colspan=\"2\">".$g_app_string."</th>".PHP_EOL;
						echo "</tr>".PHP_EOL;
				echo "</table>".PHP_EOL;
				echo "</div>";
			echo "</div>".PHP_EOL;
		echo "</div>".PHP_EOL;
		echo "<br>";
	}
?>