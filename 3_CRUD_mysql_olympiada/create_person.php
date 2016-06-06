<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css" />
		<title>Zadanie 2</title>
		<?php include("config.php");
	
			if(!empty($_POST)){
				$name = $_POST["name"];
				$surname = $_POST["surname"];
				$bD = $_POST["birthDay"];
				$bP = $_POST["birthPlace"];
				$bC = $_POST["birthCountry"];
				$dD = "";
				$dP = "";
				$dC = "";
				$query_create = 
					"INSERT INTO osoby (`id_person`, `name`, `surname`, `birthDay`, `birthPlace`, `birthCountry`, `deathDay`, `deathPlace`, `deathCountry`)
					VALUES ('NULL', '$name', '$surname', '$bD', '$bP', '$bC', '$dD', '$dP', '$dC')";
				
				$mysqli->query($query_create);
				$mysqli->close();
				header("Location: index.php");
			}

		?>
	</head>
	<body>
		<section>
			<header>
					<img alt="Logo" src="images/olympic.png"><h3>Pridanie osoby</h3><br><br>
			</header>
			<article>
				<form action="create_person.php" method="post">
					<input type="text" placeholder="Meno" name="name" value="">
					<input type="text" placeholder="Priezvisko" name="surname" value="">
					<input type="date" name="birthDay" value="">
					<input type="text" placeholder="Miesto narodenia" name="birthPlace" value="">
					<input type="text" placeholder="Krajina narodenia" name="birthCountry" value="">
					<button type="submit">Vytvoriť</button>
					
				</form>
			</article>
			<footer>
					<a href="index.php" class="back">Späť</a>
			</footer>
		</section>
	</body>
</html>