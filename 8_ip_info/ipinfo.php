<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>IP info</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<link rel="stylesheet" href="style.css">
		
		<?php		
			$page_index = 2;
			require('user_location_info.php');
			if(isset($_SERVER['REMOTE_ADDR'])){
				$json_country_code = file_get_contents('https://restcountries.eu/rest/v1/alpha?codes='.$country_code);
				$json_country_code = json_decode($json_country_code);
				$capital_city = $json_country_code[0]->capital;
				
			}
		?>
	</head>
	<body>
		<div class="row">
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
				<div class="navbar-header">
				  <a class="navbar-brand menu-item" href="index.php">
					<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
				  </a>
				</div>
				<ul class="nav navbar-nav">
				  <li><a id="find-name" class="menu-item" href="index.php">POČASIE</a></li>
				  <li><a id="find-name" class="menu-item" href="ipinfo.php">IP INFO</a></li>
				  <li><a id="find-date" class="menu-item" href="statistics.php">ŠTATISTIKY</a></li>
				</ul>
			  </div>
			</nav>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<h4>Informácie podľa Vašej IP adresy</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<table class="table">
							<thead>
								<tr>
									<th>IP adresa</th>
									<th>Súradnice</th>
									<th>Miesto podľa IP adresy</th>
									<th>Krajina</th>
									<th>Hlavné mesto</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td id="ip"><?php echo $uip_addr; ?></td>
									<td id="coordinates"><?php echo $lat.' - '.$lon; ?></td>
									<td id="place"><?php echo $place; ?></td>
									<td id="country"><?php echo $country; ?></td>
									<td id="capital"><?php echo $capital_city; ?></th>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>