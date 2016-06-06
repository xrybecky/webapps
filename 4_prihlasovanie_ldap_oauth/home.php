<html>
	<head>
		<meta charset=utf-8>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="style.css">
		<title>Registracia</title>
		<?php include("config.php");
			session_start();
			$login_type='login';
			$login = 'unknown';
			$email = 'unknown';
			//FORM LOGIN
			
			if(isset($_SESSION['user']) && isset($_SESSION['user_email']) && isset($_SESSION['login_type'])){
				$login = $_SESSION['user'];
				$login_type = $_SESSION['login_type'];
				$email = $_SESSION['user_email'];
			}else{
				
				if(isset($_SESSION['login'])){
					$login = $_SESSION['login'];
					$login_type = 'form';
					$query_user_info = 
						"SELECT name,surname,email FROM registrations WHERE login='$login'";
						$result = $mysqli->query($query_user_info)->fetch_object();
					$email = $result->email;
					$name = $result->name;
					$surname = $result->surname;
					$date = date('Y-m-d H:i:s');
					if(!isset($_SESSION['user'])){
						$query_insert_login = 
							"INSERT INTO logins (`id_login`,`user_login`, `date`, `type`)
								VALUES ('NULL', '$login', '$date', '$login_type')";
						$mysqli->query($query_insert_login);	
					}
					$_SESSION['name'] = $name." ".$surname;
					$_SESSION['login_type'] = $login_type;
					$_SESSION['user'] = $login;
					$_SESSION['user_email'] = $email;
				}else if(isset($_GET['code'])){
					$gClient->authenticate($_GET['code']);
					$_SESSION['access_token'] = $gClient->getAccessToken();
					$userinfo = $google_oauthV2->userinfo;
					$login = $userinfo->get()['name'];
					$email = $userinfo->get()['email'];		
					$login_type = 'gmail';
					$date = date('Y-m-d H:i:s');
					if(!isset($_SESSION['user'])){
						$query_insert_login = 
							"INSERT INTO logins (`id_login`,`user_login`, `date`, `type`)
								VALUES ('NULL', '$login', '$date', '$login_type')";
						$mysqli->query($query_insert_login);	
					}
					$_SESSION['name'] = $login;
					$_SESSION['login_type'] = $login_type;
					$_SESSION['user'] = $login;			
					$_SESSION['user_email'] = $email;				
				}else if(isset($_SESSION['ldap'])){
					$login = $_SESSION['ldap'];
					$name = $_SESSION['name'];
					$email = $_SESSION['user_email'];
					$login_type = 'ldap';
					$date = date('Y-m-d H:i:s');
					if(!isset($_SESSION['user'])){
						$query_insert_login = 
							"INSERT INTO logins (`id_login`,`user_login`, `date`, `type`)
								VALUES ('NULL', '$login', '$date', '$login_type')";
						$mysqli->query($query_insert_login);	
					}
					
					$_SESSION['login_type'] = $login_type;
					$_SESSION['user'] = $login;
					$_SESSION['user_email'] = $email;
				}else{
					header("Location: index.php");
				}
			}
		?>
	</head>
	<body>			
		<div class="row">
			<div class="row header">
				<div class="col-md-1 col-md-offset-1 logout-right">
					<a href="logout.php">Odhlásiť</a>
				</div>
				<div class="col-md-3">
					<?php echo $login; ?>
				</div>
				<div class="col-md-3 email-padding">
					<?php echo strtolower($email); ?>
				</div>
				<div class="col-md-3 email-padding">
					<a href="stat.php">Minulé prihlásenia</a>
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<h4><b><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}?></b>, vítame ťa v Tvojom profile ;)</h4>
					<img src="img/home.png" class="image-circle img-welcome">
				</div>
				
				
			</div>
		</div>
				
		<?php $mysqli->close(); ?>
	</body>
</html>