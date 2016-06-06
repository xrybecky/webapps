<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<title>IV. Zadanie WA</title>

		<?php include("config.php");
			session_start();
			
			//if(isset($_SESSION['user'])){
			//	header("Location: newhome.php");
			//}else{
				if(isset($_POST["login"]) && isset($_POST["psswd"])){
						$login = $_POST["login"];
						$psswd = $_POST["psswd"];
						echo $login;
						echo $psswd;
						$query_check_login = 
							"SELECT * FROM osoby WHERE login='$login' AND password='$psswd'";
						$result_login = $mysqli->query($query_check_login);
						
						if($result_login->num_rows == 1){
							$_SESSION['user'] = $login;
							$role = $result_login->fetch_object()->id_role;
							$_SESSION['role'] = $role;
							switch($role){
								case 1: header("Location: admin.php");
									break;
								case 2: header("Location: newhome.php");
									break;
								case 3: header("Location: newhome.php");
									break;
								default: header("Location: index.php");
							}
						}
					}
			//}
		?>
	</head>
	<body>
		<div class="row login">
			<div class="col-md-3 col-md-offset-4">
				<form method="post" action="index.php">
						<input id="login" placeholder="Login" class="" type="text" name="login">
						<input id="psw" placeholder="Heslo" class="" type="password" name="psswd">		
						<button type="submit" class="confirm-button">Prihlásiť</button> 
				</form>		
			</div>
		</div>
		
		<?php $mysqli->close(); ?>
	</body>
</html>
