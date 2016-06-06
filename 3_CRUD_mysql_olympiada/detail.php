<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css" />
		<title>Zadanie 2</title>

		<?php include("config.php");
			$um_id = $_GET['id'];
			

			$query_detail_person = 
			"SELECT * FROM osoby WHERE id_person=(SELECT id_person FROM umiestnenia WHERE id=$um_id)";
			
			$result_detail_person = $mysqli->query($query_detail_person);
			$row_person = $result_detail_person->fetch_row();
			
			$id_p = $row_person["id_person"];
			
			$result_detail_umiestnenie =
			"SELECT oh.type, oh.year, oh.city, oh.country, um.place, um.discipline
				FROM oh 
				JOIN umiestnenia AS um ON oh.id_OH=um.id_OH
				WHERE um.id_person=$id_p";
			
			
			
			$result_detail_umiestnenie = $mysqli->query($result_detail_umiestnenie);
			
			//$mysqli->close();

		?>
	</head>
	<body>
		<section>
			<header>
				<img alt="Logo" src="images/olympic.png"><h3>Detail olympionika</h3><br>
			</header>
			<article>
				<h4>Údaje o olympionikovi</h4>
				<table>
					<thead>
						<tr>
							<th>MENO</th>
							<th>PRIEZVISKO</th>
							<th>NARODENIE</th>
							<th>MIESTO NARODENIA</th>
							<th>KRAJINA NARODENIA</th>
							<th>ÚMRTIE</th>
							<th>MIESTO ÚMRTIA</th>
							<th>KRAJINA ÚMRTIA</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $row_person['name']; ?></td>
							<td><?php echo $row_person['surname']; ?></td>
							<td><?php echo $row_person['birthDay']; ?></td>
							<td><?php echo $row_person['birthPlace']; ?></td>
							<td><?php echo $row_person['birthCountry']; ?></td>
							<td><?php echo $row_person['deathDay']; ?></td>
							<td><?php echo $row_person['deathPlace']; ?></td>
							<td><?php echo $row_person['deathCountry']; ?></td>
						</tr>
					</tbody>
				</table>
			</article>
			<br><br>
		
			<article>
				<h4>Olympijské výsledky</h4>
				<table>
					<thead>
						<tr>
							<th>TYP</th>
							<th>ROK</th>
							<th>MIESTO</th>
							<th>DISCIPLÍNA</th>
							<th>UMIESTNENIE</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
							while($row_umiestnenie= $result_detail_umiestnenie->fetch_array(MYSQLI_ASSOC)){
								$type = $row_umiestnenie["type"];
								$year = $row_umiestnenie["year"];
								$city = $row_umiestnenie["city"];
								$country = $row_umiestnenie["country"];
								$discipline = $row_umiestnenie["discipline"];
								$place = $row_umiestnenie["place"];
								echo "<tr>";
									echo "<td>$type</td>";
									echo "<td>$year</td>";				
									echo "<td>$city".","."$country</td>";
									echo "<td>$discipline</td>";
									echo "<td>$place</td>";
								echo "</tr>";
							}
							
							$mysqli->close();
						?>
					</tbody>
				</table>
			</article>
			<footer>
				<a href="index.php" class="back">Späť</a>
			</footer>
		</section>
	</body>
</html>