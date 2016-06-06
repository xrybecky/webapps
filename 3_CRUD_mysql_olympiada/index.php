<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css" />
		<title>Zadanie 2</title>
		<?php include "config.php";
			$order = isset($_GET['orderby']) ? $_GET['orderby'] : "";
			$ascdesc = isset($_GET['ascdesc']) ? $_GET['ascdesc'] : "";
			
			switch(strtoupper($ascdesc)){
				case 'DESC': $ascdesc = 'ASC'; break;
				case 'ASC': $ascdesc = 'DESC'; break;
				default: $ascdesc = 'ASC'; break;
			}
			
			$query_winners = 
			"SELECT um.id, osoby.name, osoby.surname, oh.year, oh.city, oh.type, um.discipline FROM osoby 
				JOIN umiestnenia AS um ON osoby.id_person = um.id_person
				JOIN oh ON oh.id_OH = um.id_OH
			WHERE um.place = 1";
			
			if(isset($_GET['orderby'])){
				if($order == 'type'){
					$order .= ' '.$ascdesc . ', year '; 
				}
				$order = 'ORDER BY ' . $order;
				$query_winners =  $query_winners ." ".$order." ".$ascdesc;
			}
			

			
				
			$result = $mysqli->query($query_winners);
			
			$mysqli->close();
		?>
	</head>
	<body>
		<nav>
			<ul>
				<li><a href="create_person.php"><img alt="Pridať osobu" src="images/add_person_b.png"></a></li>
				<li><a href="create.php"><img alt="Pridať umiestnenie" src="images/add_list_b.png"></a></li>
			</ul>
		</nav>
		
		<section>
			<header>
				<img alt="Logo" src="images/olympic.png"><h3>Prehľad Olympijských výsledkov</h3>
			</header>
			<article>
				<table>
					<thead>
						<tr>
							<th>MENO</th>
							<th class="clickable"><a class="a_head_table" href="index.php?orderby=surname&ascdesc=<?php echo $ascdesc;?>">PRIEZVISKO</a></th>
							<th class="clickable"><a class="a_head_table" href="index.php?orderby=year&ascdesc=<?php echo $ascdesc;?>">ROK</a></th>
							<th>MIESTO KONANIA</th>
							<th class="clickable"><a class="a_head_table" href="index.php?orderby=type&ascdesc=<?php echo $ascdesc;?>">TYP</a></th>
							<th>DISCIPLÍNA</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							while($row = $result->fetch_array(MYSQLI_ASSOC)){
								$id = $row["id"];
								$name = $row["name"];
								$surname = $row["surname"];
								$year = $row["year"];
								$city = $row["city"];
								$type = $row["type"];
								$discipline = $row["discipline"];
								echo "<tr>";
									echo "<td>$name</td>";
									echo "<td><a href=\"detail.php?id=$id\">$surname</a></td>";				
									echo "<td>$year</td>";
									echo "<td>$city</td>";
									echo "<td>$type</td>";
									echo "<td>$discipline</td>";
									echo "<td><a href=\"delete.php?id=$id\"><img class=\"icon\" alt=\"Vymazať záznam\" src=\"images/delete.png\"></a></td>";
									echo "<td><a href=\"update.php?id=$id\"><img class=\"icon\" alt=\"Upraviť záznam\" src=\"images/edit.png\"></a></td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</article>
		</section>
		
		
	</body>
</html>