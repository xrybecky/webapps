<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css" />
		<title>Zadanie 2</title>

		<?php include("config.php");
			$um_id = $_GET['id'];

			$query_values = 
			"SELECT osoby.name, osoby.surname, oh.year, oh.city, oh.type, um.discipline FROM osoby 
				JOIN umiestnenia AS um ON osoby.id_person = um.id_person
				JOIN oh ON oh.id_OH = um.id_OH
			WHERE um.id=$um_id";
			
			if(!empty($_POST)){
				$name = $_POST["name"];
				$surname = $_POST["surname"];
				$year = $_POST["year"];
				$city = $_POST["city"];
				$type = $_POST["type"];
				$discipline = $_POST["discipline"];
				
				$query_update = 
				"UPDATE umiestnenia um 
					JOIN osoby o ON o.id_person = um.id_person
					JOIN oh ON oh.id_OH = um.id_OH
						SET o.name='$name', o.surname='$surname', oh.year='$year', 
							oh.city='$city', oh.type='$type', um.discipline='$discipline'
					WHERE um.id='$um_id'";
					
				
				
				$mysqli->query($query_update);			
				header("Location: index.php");
			}
			
			$result = $mysqli->query($query_values);
			$row = $result->fetch_array(MYSQLI_ASSOC);
			
			$mysqli->close();
		?>
	</head>
	<body>
	
		<section>
			<header>
				<img alt="Logo" src="images/olympic.png"><h3>Modifikácia údajov</h3><br><br>
			</header>
			<article>
				<form action="update.php?id=<?php echo $um_id?>" method="post">
					<input type="text" placeholder="Meno" name="name" value="<?php echo $row["name"]?>">
					<input type="text" placeholder="Priezvisko" name="surname" value="<?php echo $row['surname']?>">
					<input type="text" placeholder="Rok" name="year" value="<?php echo $row['year']?>">
					<input type="text" placeholder="Mesto" name="city" value="<?php echo $row['city']?>">
					<input type="text" placeholder="Typ" name="type" value="<?php echo $row['type']?>">
					<input type="text" placeholder="Disciplína" name="discipline" value="<?php echo $row['discipline']?>">
					<button type="submit">UPRAVIŤ</button>
					<a href="index.php" class="back">Späť</a>
				</form>
			</article>
		</section>

	</body>
</html>