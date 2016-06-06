<!DOCTYPE html>
<html>
	<head>
		<title>Hlavná stránka</title>
		<meta charset="UTF-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/style-menu.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/style-flip.css">
		<link rel="stylesheet" href="css/style-aktualit.css">
		<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet" type="text/css">
		
		
		<?php 
			include('location_functions.php');
			$translate['header']['sk'] = "Vitajte";
			$translate['header']['en'] = "Welcome";
			$lang = $_SESSION['lang'];
		?>
	</head>
	
	<body class="inner">
		<?php
			include 'menu.php';
		?>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-12">
						<div class="flip-container" ontouchstart="this.classList.toggle('hover');">
							<div class="flipper">
								<div class="front">
									<h1><?php echo $translate['header'][$lang]; ?></h1>
									<br>
									<img class="logo" src="imgs/cursor.png" alt="cursor">									
								</div>
								<div class="back">
									<img class="logo" src="imgs/itjoke.jpg" alt="joke">
									<br><br>
									<p>Webová stránka je výsledkom tímového zadania z predmetu Webové aplikácie.</p>
									<p>@ FEI STU Bratislava 2016 by Tím 18</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

