<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css" type="text/css" />
		<title>Registrácia</title>
		<?php include("config.php");

			if(!empty($_POST)){
				$name = $_POST['name'];
				$surname = $_POST['surname'];
				$email = $_POST['email'];
				$login = $_POST['login'];
				$psswd = $_POST['psswd'];
				
				$query_if_exist_login = 
				"SELECT COUNT(*) AS c FROM registrations AS reg WHERE reg.login='$login'";
				
				$result_if_exist_login = $mysqli->query($query_if_exist_login);
				$number_of_logins = $result_if_exist_login->fetch_object()->c;
				
			}
		?>
	</head>
	<body>
		<div class="row header">
			<div class="col-md-6 col-md-offset-2">
				<a href="index.php">Prihlásenie</a>
			</div>
		</div>	
		<div class="row registration-form">
			<div class="page-header col-md-4 col-md-offset-4">
			  <h3>Registrácia</h3>
			</div>
			<div class="col-md-4 col-md-offset-4">
				<form method="post" action="registration.php">
					<div class="col-md-12 form-group">
						<label class="sr-only" for="u_name">Meno</label>
						<input id="u_name" class="form-control input-sm no-radius" placeholder="Meno" type="text" name="name">
					</div>
					<div class="col-md-12 form-group">
						<label class="sr-only" for="u_sur">Priezvisko</label>
						<input id="u_sur" class="form-control input-sm no-radius" placeholder="Priezvisko" type="text" name="surname">
					</div>
					<div class="col-md-12 form-group">
						<label class="sr-only" for="u_email">Email</label>
						<input id="u_email" class="form-control input-sm no-radius" placeholder="Email" type="text" name="email">
					</div>
					<div class="col-md-12 form-group">
						<label class="sr-only" for="u_login">Login</label>	
						<input id="u_login" class="form-control input-sm no-radius" placeholder="Login" type="text" name="login">
					</div>
					<div class="col-md-12 form-group">
						<label class="sr-only" for="u_pass">Heslo</label>
						<input id="u_pass" class="form-control input-sm no-radius" placeholder="Heslo" type="text" name="psswd">
					</div>
					<div class="col-md-12">
						<button class="btn btn-default btn-sm no-radius button-full-width" type="submit">Registrovať</button>				
					</div>
					
					<?php
						if(isset($number_of_logins)){
							if($number_of_logins == 0){
								echo "<div class=\"col-md-12\">";
								$query_insert_user = 
								"INSERT INTO registrations (`id_user`,`name`, `surname`, `email`, `login`, `password`)
										VALUES ('NULL', '$name', '$surname', '$email', '$login', '".md5($psswd)."')";
										
								$mysqli->query($query_insert_user);
								echo "<p>Registrácia prebehla úspešne. ";
								echo "<a href=\"index.php\">Môžete sa prihlásiť ;)</a></p>";
								echo "</div>";
							}else{
								echo "<div class=\"col-md-12\">";
								echo "Používateľ už existuje";
								echo "</div>";
							}
						}
						
						$mysqli->close();
					?>
					
				</form>
			</div>
		</div>
	</body>
</html>


