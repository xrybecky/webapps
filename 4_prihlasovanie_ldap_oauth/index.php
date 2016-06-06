<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		<title>III. Zadanie WA</title>
		<?php 
			include("config.php");
			session_start();
			
			$authUrl = $gClient->createAuthUrl();
			if(isset($_SESSION['login']) || isset($_SESSION['ldap'])){
				header("Location: home.php");
			}else{
				if(isset($_POST["login"]) && isset($_POST["psswd"])){
					$login = $_POST["login"];
					$psswd = $_POST["psswd"];
					
					$query_check_login = 
						"SELECT * FROM registrations AS reg WHERE reg.login='$login' AND reg.password='".md5($psswd)."'";
						
					$result_login = $mysqli->query($query_check_login);
					
					
				}
			}
		?>
	</head>
	<body>
		<div class="row header">
			<div class="col-md-6 col-md-offset-2">
				<a href="registration.php">Registrácia</a>
			</div>
		</div>	
		<div class="row">		
			<div class="col-md-2 col-md-offset-2 login">
				<div class="page-header col-md-4">
					<h3>Prihlásenie</h3>
				</div>
				<form method="post" action="index.php">
					<div class="form-group">
						<label class="sr-only" for="login">Login</label>
							<input id="login" placeholder="Login" class="form-control input-sm no-radius" type="text" name="login">
					</div>
					<div class="row">
						<div class="form-group col-md-7">	
							<label for="psw" class="sr-only">Heslo</label>		
								<input id="psw" placeholder="Heslo" class="form-control input-sm no-radius" type="password" name="psswd">
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-default btn-sm no-radius button-right">Prihlásiť</button> 
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<a href="<?php if(isset($authUrl)){$_SESSION['login_type']='gmail'; echo $authUrl;} ?>"><img alt="Odkaz na LDAP" class="img-google-login" src="img/sign_google.png"></a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<a href="ldap.php"><div class="ldap-login">Sign with LDAP</div></a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php 
								if(isset($result_login)){
									if($result_login->num_rows == 1){
										$_SESSION['login'] = $login;
										header("Location: home.php");
									}else{
										echo "Zle meno alebo heslo";
									}
								}
							?>
						</div>
					</div>
					
					
				</form>
			</div>
			<div class="col-md-4 col-md-offset-2">
				<img alt="Logo" src="img/login.png" class="logo">
			</div>
		</div>
		<?php $mysqli->close(); ?>
	</body>
</html>