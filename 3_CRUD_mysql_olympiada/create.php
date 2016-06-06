<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css" />
		<title>Zadanie 2</title>
		<?php include("config.php");
		
			$query_person_option = "SELECT id_person, name, surname FROM osoby ORDER BY surname";
			$person_option_result = $mysqli->query($query_person_option);
			
			$query_oh_option = "SELECT id_OH, type, year, city FROM oh ORDER BY year";
			$oh_option_result = $mysqli->query($query_oh_option);
		
			if(!empty($_POST)){
				$id_person = $_POST["person"];
				$id_oh = $_POST["ohn"];
				$place = $_POST["place"];
				$discipline = $_POST["discipline"];
				
				$query_create = 
				"INSERT INTO umiestnenia (`id`,`id_person`, `id_OH`, `place`, `discipline`) 
					VALUES ('NULL','$id_person','$id_oh','$place','$discipline')";
				
				$mysqli->query($query_create);
				$mysqli->close();
				header("Location: index.php");
			}

			

			
		?>
	</head>
	<body>
		<section>
			<header>
				<img alt="Logo" src="images/olympic.png"><h3>Pridanie umiestnenia</h3><br><br>
			</header>
			<article>
				<form action="create.php" method="post">
				
					<select name="person">
						<?php 
							while($row_person = $person_option_result->fetch_array(MYSQLI_ASSOC)){
								$name = $row_person["name"];
								$surname = $row_person["surname"];
								$id = $row_person["id_person"];
								echo "<option value=\"$id\">".$name." ".$surname."</option>";
							}
						?>
					</select>
					
					<select name="ohn">
						<?php 
							while($row_oh = $oh_option_result->fetch_array(MYSQLI_ASSOC)){
								$type = $row_oh["type"];
								$year = $row_oh["year"];
								$city = $row_oh["city"];
								$id = $row_oh["id_OH"];
								echo "<option value=\"$id\">".$type." ".$year." ".$city."</option>";
							}
						?>
					</select>
					<input type="number" placeholder="Umiestnenie" name="place" value="">
					<input type="text" placeholder="Disciplína" name="discipline" value="">
					<button type="submit">Vytvoriť</button>
				</form>
			</article>
			<footer>
				<a href="index.php" class="back">Späť</a>
			</footer>
		</section>
	</body>
</html>