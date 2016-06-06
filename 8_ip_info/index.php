<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <title>Počasie</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<?php
			$page_index = 1;
			require('user_location_info.php');
		?>
		<script>
			$(document).ready(function(){
				var lat = <?php echo $lat; ?>;
				var lon = <?php echo $lon; ?>;				
				//Forecast API key: e47dc8a6e42da679abe0ff3a08923fca
				var request = "http://api.wunderground.com/api/3fd279012192e4c7/lang:SK/conditions/forecast/alerts/q/"+lat+","+lon+".json";///*+lat+","+lon+"*/
				
				$.ajax({
				 url: request,
				 dataType: 'json',
				 success: function(data){
					console.log(data);
					var date = new Date(data.current_observation.local_time_rfc822);
					var month = date.getMonth()+1;
					var day = date.getDate();
					var year = date.getFullYear();
					
					$("#city").text(data.current_observation.display_location.full);
					$("#date").text(day+"."+month+"."+year);
					$("#wind").append(data.current_observation.wind_dir+", "+data.current_observation.wind_gust_kph + " km/h");
					$("#main-icon").html("<img src=\""+data.current_observation.icon_url+"\">");
					$("#main-temp").text(data.current_observation.temp_c+" °C");
					$("#conditions").html("<p><b>"+data.current_observation.weather+"</b></p>");
					$("#alert").append(data.alerts[0].description);
					
					$.each(data.forecast.simpleforecast.forecastday, function(idx, day){
						var day_weather = "den:"+day.date.day+"."+day.date.month+"."+day.date.year+"->"+day.date.weekday+" => počasie:"+ day.conditions +" /icon:"+ day.icon_url;
						day_weather += "min/max:"+ day.low.celsius + "/" +day.high.celsius;
						$("#forecast-4d").append("<div class=\"col-md-6 weather-day\"><div class=\"row\"></div></div>");
						var row = $(".row").last();
						row.append("<div class=\"col-md-12 day-weekday\">"+day.date.weekday+"</div>");
						row.append("<div class=\"col-md-12 day-date\">"+day.date.day+"."+day.date.month+"."+day.date.year+"</div>");
						row.append("<div class=\"col-md-12 centered day-cond\">"+day.conditions+"</div>");
						row.append("<div class=\"col-md-12 centered day-icon\"><img src=\""+day.icon_url+"\"></div>");
						row.append("<div class=\"col-md-12 centered day-temp\">"+ day.low.celsius + " / " +day.high.celsius+" °C</div>");
					});
				}});			
			});		
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
		
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h4>Predpoveď počasia</h4>
				</div>
			</div>
			<div class="row">				
				<div class="col-md-8 col-md-offset-2 weather-container">
					<div class="">
						<div class="col-md-6 main-weather">
							<div id="weather">
								<div class="row ">
									<div class="weather-header">
										<div class="col-md-12 weather-header-child">
											<b id="city"></b>
										</div>
										<div class="col-md-12 weather-header-child">
											<p id="date"></p>
										</div>
									</div>
									<br><br>
									<div class="weather-body">
										<div id="conditions" class="col-md-12 centered"></div>
										<div id="main-icon" class="col-md-6 centered"></div>
										
										<div class="col-md-6 centered">
											<p id="main-temp" class="main-temp"></p>
										</div>
									</div>
									<div class="col-md-12">
										<p id="alert" class="alert"><b>Výstraha: </b></p>
									</div>
									<div class="col-md-12">
										<p id="wind" class="alert wind"><b>Vietor:</b> </p>
									</div>
								</div>
							</div>
						</div>
					
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div id="forecast-4d" class="row">
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</body>
</html>

