<html>
	<head>
		<meta charset=utf-8>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="style.css">
		<title>Registracia</title>
		<?php include("config.php");
			session_start();
			
			if(isset($_SESSION['login_type']) && isset($_SESSION['user'])){
				$login = $_SESSION['user'];
				$login_type = $_SESSION['login_type'];
				$email = $_SESSION['user_email'];
			}else{
				header("Location:index.php");
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
					<?php echo $login; if(isset($_SESSION['name'])){echo " - ".$_SESSION['name'];} ?>
				</div>
				<div class="col-md-3 email-padding">
					<?php echo strtolower($email); ?>
				</div>
				<div class="col-md-3 email-padding">
					<a href="<?php if(isset($_SESSION['google'])){echo "home.php?code=".$_SESSION['google']; }else echo "home.php" ?>">Do profilu</a>
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-md-6 col-md-offset-3 bg-white">
					<div class="col-md-12">
						<div class="table-responsive">
							<h3>Štatistika prihlásení</h3>
							<table class="no-border table">
								<tr class="no-border"><th class="th-form-table-cell">Formulár</th><th class="th-google-table-cell">Google konto</th><th class="th-ldap-table-cell">LDAP</th></tr>
								<?php
									$query_logins_form = 
										"SELECT COUNT(*) AS form FROM logins WHERE type='form'";
									$query_logins_gmail = 
										"SELECT COUNT(*) AS gmail FROM logins WHERE type='gmail'";
									$query_logins_ldap = 
										"SELECT COUNT(*) AS ldap FROM logins WHERE type='ldap'";
									$result_form = $mysqli->query($query_logins_form)->fetch_object()->form;
									$result_gmail = $mysqli->query($query_logins_gmail)->fetch_object()->gmail;
									$result_ldap = $mysqli->query($query_logins_ldap)->fetch_object()->ldap;
									echo "<tr class=\"no-border\"><td class=\"form-table-cell\">".$result_form."</td><td class=\"google-table-cell\">".$result_gmail."</td><td class=\"ldap-table-cell\">".$result_ldap."</td></tr>"
								?>
							</table>
						</div>
					</div>
					<div class="col-md-12 bg-white">
						<table class="table table-s">
							<thead><tr class="tr-s"><th>História prihlásení</th></tr></thead>
							<tbody class="tbody-s">
							<?php
								$query_login_history = 
									"SELECT date FROM logins WHERE user_login='$login' AND type='$login_type'";
								$result_login_history = $mysqli->query($query_login_history);
								while($row = $result_login_history->fetch_array(MYSQLI_ASSOC)){
									echo "<tr class=\"tr-s\"><td>".$row["date"]."</td></tr>";
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>	
	</body>
</html>
				