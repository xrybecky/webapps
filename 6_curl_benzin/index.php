<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="style.css">
		<?php include('get_prices.php'); ?>
		<script src="results.js"></script>
		<title>Ceny paliva</title>
	</head>
	<body>
		<div class="row">
			<div class="col-md-12">
				<div class="row vertical">
					<div class="col-md-8 col-md-offset-2 header">
						<form id="fuel-form" class="form-inline" method="post" action="index.php">
							<input id="psc" class="form-control" type="text" name="psc_input" placeholder="PSČ...">
							<select id="fuel"  class="form-control" name="fuel_input">
								<option class="form-control" value="8" >Diesel</option>
								<option class="form-control" value="256" >Diesel+ (aditovovaný)</option>
								<option class="form-control" value="32" >Normal95 (UNI)</option>
								<option class="form-control" value="2"  selected>Natural95</option>
								<option class="form-control" value="4096" >Natural95+ (aditovovaný)</option>
								<option class="form-control" value="4" >Natural98</option>
								<option class="form-control" value="128" >Natural99+ (aditovovaný 99/100)</option>
								<option class="form-control" value="16" >LPG</option>
								<option class="form-control" value="16384" >CNG</option>
								<option class="form-control" value="8192" >Adblue</option>
							</select>	
							<button id="send-button" class="btn btn-default" type="submit">Nájsť cenu</button>
						</form>		
					</div>
					<div class="col-md-8 col-md-offset-2">
						<div id="results-container">
							<table id="results-table" class="table table-s">
								<thead>
									<tr>
										<th>ČS</th>
										<th>Mesto</th>
										<th>Ulica</th>
										<th>Cena</th>
										<th>Dátum</th>
									</tr>
								</thead>
								<tbody class="tbody-s">
								</tbody>
							</table>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</body>
</html>