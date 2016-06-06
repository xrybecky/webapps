<?php
	include "config.php";
	$email = $_GET["email"];
	$hash = $_GET["hash"];
	$mysqli->connect($server,$user,$pass,$db);
	$mysqli->query("SET NAMES 'utf8'");
	$jazykS = $_SESSION["lang"];
	if(mysqli_connect_error()){
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	}
	if(isset($_GET["email"])){
		$query = "SELECT id,hash as hs FROM newsusers WHERE email='$email'";
		$result = $mysqli->query($query);
		if(mysqli_num_rows($result) != 0){
			$obj = $result->fetch_object();
			$hashDBS = $obj->hs;
			$id = $obj->id;

			if($hashDBS == $hash){
					$query = "UPDATE newsusers SET verified = 1 WHERE id = $id";
					$result = $mysqli->query($query);
				}
		}
		
	}
	$mysqli->close();
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Overenie</title>
		<meta charset="UTF-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style-aktualit.css">	
	</head>	
	<body>
		<div id="container">
			<div id="center">
				<?php
					echo $email." ".$hash;
				?>
			</div>
		</div>
	</body>
</html>