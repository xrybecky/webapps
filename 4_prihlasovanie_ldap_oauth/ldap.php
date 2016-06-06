<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="style.css">
		<title>LDAP prihlásenie</title>
		<?php
			session_start();
			if(isset($_POST['login']) && isset($_POST['psswd'])){
				$uid = $_POST['login'];
				$ldaprdn = 'uid='.$uid.',ou=People,dc=stuba,dc=sk';
				$ldappass = $_POST['psswd'];
				
				$ldapconn = ldap_connect('ldap.stuba.sk');

				ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
				
				if ($ldapconn) {
					// binding to ldap server
					$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

					// verify binding
					if ($ldapbind) {
						$_SESSION['ldap'] = $uid;
						$sr = ldap_search($ldapconn, $ldaprdn, "uid=".$uid);
						$entry = ldap_first_entry($ldapconn, $sr);
						$usrName = ldap_get_values($ldapconn, $entry, "givenname")[0];
						$usrSurname = ldap_get_values($ldapconn, $entry, "sn")[0];
						$_SESSION['name'] = $usrName." ".$usrSurname;
						$_SESSION['user_email'] = $usrSurname = ldap_get_values($ldapconn, $entry, "mail")[0];
						header("Location:home.php");
					} else {
						echo "LDAP bind failed...";
					}
				}
			}
		?>
	</head>
	<body>
		<div class="row header">
			<div class="col-md-2 col-md-offset-2">
				<a href="index.php">Úvodná stránka</a>
			</div>
		</div>	
		<div class="row">
			<div class="col-md-10 col-md-offset-2">
					<h3>LDAP prihlásenie</h3>
			</div>
			<div class="col-md-3 col-md-offset-2">
					<form method="post" action="ldap.php">
						<div class="form-group col-md-12">
							<label class="sr-only" for="login">AIS login</label>
								<input id="login" placeholder="AIS Login" class="form-control input-sm no-radius" type="text" name="login">
						</div>
						<div class="form-group col-md-8">	
							<label class="sr-only" for="psw">Heslo</label>		
								<input id="psw" placeholder="Heslo" class="form-control input-sm no-radius" type="password" name="psswd">
						</div>
						<div class="col-md-4 button-right">
							<button type="submit" class="btn btn-default btn-sm no-radius ">Prihlásiť</button> 
						</div>
					</form>
			</div>
		</div>
	</body>
</html>