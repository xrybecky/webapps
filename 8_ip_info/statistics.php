<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <title>Návštevnosť</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<link rel="stylesheet" href="style.css">
		
		<?php		
			$page_index = 3;			
			require('user_location_info.php');		
			
			if(isset($_GET['c'])){
				$get_country = $_GET['c'];
				$total_counts_by_city = file_get_contents('http://147.175.98.229/7Zadanie/db/get_totals_cities.php?co='.$get_country);
				$total_counts_by_city = json_decode($total_counts_by_city);
			}
			
			$total_counts_by_country = file_get_contents('http://147.175.98.229/7Zadanie/db/get_totals.php');
			$total_counts_by_country = json_decode($total_counts_by_country);
			
			$times = file_get_contents('http://147.175.98.229/7Zadanie/db/times.php');
			$times = json_decode($times);
			
			$best_site = file_get_contents('http://147.175.98.229/7Zadanie/db/access_count_by_page.php');
			$best_url;
			switch($best_site){
				case 1: $best_site = "Počasie"; $best_url = "index.php";
				break;
				case 2: $best_site = "IP info"; $best_url = "ipinfo.php";
				break;
				case 3: $best_site = "Prehľad návštevníkov"; $best_url = "statistics.php";
				break;
			}
		?>
		
		<script>
			function initMap() {
				  // Create a map object and specify the DOM element for display.
				  var map = new google.maps.Map(document.getElementById('map'), {
					center: {lat: 48, lng: 17},
					scrollwheel: false,
					zoom: 4
				  });
				  
				  // SELECT lat lng
				  $.getJSON('db/lat_lng.php', function(data){
					  $.each(data, function(idx, value){
							var latLng = new google.maps.LatLng(value.lat,value.lon);
							var marker=new google.maps.Marker({
								position:latLng,
							});
							marker.setMap(map);
					  });
				  });
			}
			
			google.maps.event.addDomListener(window, 'load', initMap);
		</script>
		
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
					<div class="col-md-8 col-md-offset-1">
						<h4>Návštevnosť</h4>
					</div>
					<div class="col-md-3 col-md-offset-1">
						<h5>Prehľad podľa krajín</h5>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Krajina</th>
									<th>Zástava</th>
									<th>Počet návštevníkov</th>
								</tr>
							<tbody>
								<?php 
									foreach($total_counts_by_country as $obj){
										echo '<tr><td><a href="statistics.php?c='.$obj->name.'">'.$obj->name.'</a></td><td><img class="table-flag" alt="flag" src="'.$obj->flag.'"</td><td>'.$obj->count.'</td></tr>';
									}
								?>
							</tbody>
						</table>
						<br><br>
						<?php
							if($total_counts_by_city){
								echo '<h5>Prehľad podľa obcí</h5>';
								echo '<table class="table table-hover">';
									echo '<thead><tr>';
										echo '<th>Mesto</th>';
										echo '<th>Počet návštevníkov</th>';
										echo '</tr></thead>';
									echo '<tbody>';
										foreach($total_counts_by_city as $obj){
											echo '<tr><td>'.$obj->name.'</td><td>'.$obj->count.'</td></tr>';
										}
									echo '</tbody>';
								echo '</table>';
							}
						?>
					</div>
					<div class="col-md-4">
						<h5>Mapa návštevnosti</h5>
						<div id="map" class="map">
						</div>
					</div>
					<div class="col-md-3">
						<h5>Prehľad podľa času</h5>
						<?php
							if($times){
								echo '<table class="table table-hover">';
									echo '<thead><tr>';
										echo '<th>6:00 - 14:00</th>';
										echo '<th>14:00 - 20:00</th>';
										echo '<th>20:00 - 24:00</th>';
										echo '<th>00:00 - 6:00</th>';
										echo '</tr></thead>';
									echo '<tbody>';
											echo '<tr><td>'.$times->m.'</td><td>'.$times->l.'</td><td>'.$times->e.'</td><td>'.$times->n.'</td></tr>';
									echo '</tbody>';
								echo '</table>';
							}
						?>
						<p>Najnavštevovanejšia stránka: <a href="<?php echo $best_url; ?>"><?php echo $best_site; ?></a></p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>