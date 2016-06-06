<!DOCTYPE html>
<html>
	<head>
		<title>Meniny</title>
		<meta charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="actions.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		<!-- cdn for modernizr, if you haven't included it already -->
		<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
		<!-- polyfiller file to detect and load polyfills -->
		<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
		<script>
		  webshims.setOptions('waitReady', false);
		  webshims.setOptions('forms-ext', {types: 'date'});
		  webshims.polyfill('forms forms-ext');
		</script>
	</head>
	<body>
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-inverse">
				  <div class="container-fluid">
					<div class="navbar-header">
					  <a class="navbar-brand menu-item" href="klient.php">
						<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
					  </a>
					</div>
					<ul class="nav navbar-nav">
					  <li><a id="find-name" class="menu-item" href="#">Kto má meniny ?</a></li>
					  <li><a id="find-date" class="menu-item" href="#">Kedy má meniny ?</a></li>
					  <li><a id="get-holidays" class="menu-item" href="#">Zoznam sviatkov</a></li>
					  <li><a id="get-memory-days" class="menu-item" href="#">Zoznam pamätných dní</a></li>
					  <li><a id="add-name" class="menu-item" href="#">Pridať meno</a></li>
					  <li><a class="menu-item" href="api.php">API</a></li>
					</ul>
				  </div>
				</nav>
				
				<div class="row">
					<div id="container" class="col-md-2 col-md-offset-2">				
					
						<label class="date-input">Dátum
							<input id="date-input" class="date-input form-control" type="date" name="date-input">
						</label>
					
						<label class="name-input">Meno
							<input id="name-input" class="name-input form-control" type="text" name="name-input" hidden>
						</label>
				
						<label class="add-name-input">Meno
							<input id="add-name-input" class="add-name-input form-control" type="text" name="add-name-input" hidden>	
						</label>
				
						<label class="add-date-input">Dátum
							<input id="add-date-input" class="add-date-input form-control" type="date" name="add-date-input" hidden>
						</label>						
						
						<label class="country">Krajina
							<select id="country" class="country form-control">
								<option value="sk">Slovensko</option>
								<option value="cz">Česká republika</option>
								<option value="hu">Maďarsko</option>
								<option value="at">Rakúsko</option>	
								<option value="pl">Poľsko</option>						
							</select>		
						</label>
						
						<button id="name-by-date-button" class="btn btn-default">Nájdi meno</button>
						<button id="date-by-name-button" class="btn btn-default " >Nájdi dátum</button>
						<button id="add-name-button" class="btn btn-default " >Pridaj meno</button>
						<button id="sviatky-list-button" class="btn btn-default " >Zobraziť sviatky</button>
						<button id="dni-list-button" class="btn btn-default " >Zobraziť pamätné dni</button>
					</div>				
				
					<div id="myDiv" class="col-md-6">
						<table id="table" class="table table-hover">
							<thead>
								<tr><th>Dátum</th><th>Meno</th></tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>