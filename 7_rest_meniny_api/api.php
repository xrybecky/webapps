<html>
	<head>
		<meta charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		<?php
		/*RESOURCES			
				GET: index.php/<<countryCode>>/meniny/dayId -> meniny v dany den, v krajine <<countryCode>> 
				GET: index.php/<<countryCode>>/meniny?q=<<name>> -> datum, v ktory oslavuje meno
				
				GET: index.php/<<countryCode>>/sviatky -> vsetky sviatky v krajine
				GET: index.php/<<countryCode>>/dni -> vsetky pamatne dni v krajine
				
				POST: index.php/<<countryCode>>/meniny/dayId -> vlozit novy zaznam do <SKd>				
		*/
		?>
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
					  <li><a id="add-name" class="menu-item" href="api.php">API</a></li>
					</ul>
				  </div>
				</nav>
			</div>
			
			<div class="row">
				<div id="api-container" class="col-md-8 col-md-offset-2">	
				
					<h4>Meniny REST API</h4>
					<p>Server 147.175.98.229/6Zadanie poskytuje REST API, prostredníctvom, ktorého je možné vyhľadať dátum menín zadaného mena, meno, ktoré oslavuje v zadaný dátum, zoznam sviatkov, zoznam pamätných dní a pridanie vlastného mena do kalendára.</p>
					
					<h4>Vyhľadanie mena podľa dátumu</h4>
					<p>Požiadavka:<b> 147.175.98.229/6Zadanie/'kodKrajiny'/meniny/'datum'</b></p>
					<p>Podporované krajiny: Slovensko, Česká republika, Maďarsko, Rakúsko, Poľsko</p>
					<p>Príklad požiadavky:<b> http://147.175.98.229/6Zadanie/sk/meniny/0226</b></p>
					<p>Výstup JSON:  <b>{den: "26.2.", meno: "Viktor"}</p>
					<br>
					<h4>Vyhľadanie dátumu podľa mena</h4>
					<p>Požiadavka:<b> 147.175.98.229/6Zadanie/'kodKrajiny'/meniny?q=Vašemeno</b></p>
					<p>Podporované krajiny: Slovensko, Česká republika, Maďarsko, Rakúsko, Poľsko</p>
					<p>Príklad požiadavky: <b>http://147.175.98.229/6Zadanie/sk/meniny?q=Viktor</b></p>
					<p>Výstup JSON:  <b>{den: "26.2.", meno: "Viktor"}</b></p>
					<br>
					<h4>Zoznam sviatkov</h4>
					<p>Požiadavka:<b> 147.175.98.229/6Zadanie/'kodKrajiny'/sviatky</b></p>
					<p>Podporované krajiny: Slovensko, Česká republika</p>
					<p>Príklad požiadavky: <b>http://147.175.98.229/6Zadanie/sk/sviatky</b></p>
					<p>Výstup JSON:  <b>[{den: "1.1.", title: "Deň vzniku Slovenskej republiky"},{den: "6.1.", title: "Zjavenie Pána (Traja králi a vianočný sviatok pravoslávnych kresťanov)"}, ...]</b></p>
					<br>
					<h4>Zoznam pamätných dní</h4>
					<p>Požiadavka:<b> 147.175.98.229/6Zadanie/'kodKrajiny'/dni</b></b></p>
					<p>Podporované krajiny: Slovensko</p>
					<p>Príklad požiadavky: http://147.175.98.229/6Zadanie/sk/dni</b></p>
					<p>Výstup JSON:  [{den: "25.3.", title: "Deň zápasu za ľudské práva"},{den: "13.4.", title: "Deň nespravodlivo stíhaných"}, ...]</b></p>
					<br>
					<h4>Pridanie vlastného mena do kalendára</h4>
					<p>Požiadavka:<b> 147.175.98.229/6Zadanie/'kodKrajiny'/meniny/'datum'?q=Vašemeno</b></p>
					<p>Podporované krajiny: Slovensko</p>
					<p>Príklad požiadavky: <b>http://147.175.98.229/6Zadanie/sk/meniny/0226?q=Vašemeno</b></p>
					<p>Výstup JSON:  <b>{den: "26.2.", meno: "Viktor", other: "Viktor, Porfýr, Edina, Vašemeno"}</b></p>
					<br>
					<div class="row">
						<div class="col-md-6">
							<h4>Kód krajiny</h4>
							<p><b>'kodKrajiny'</b> nahraďte jedným z kódov z tabuľky kódov krajín podľa výberu</p>
							<br>
							<h4>Dátum</h4>
							<p>'datum' nahraďte dátumom vo formáte mmdd</p>
						</div>
						<div class="col-md-6">
							<table class="table table-hover">
								<thead>
									<tr><th>Krajina</th><th>Kód krajiny</th></tr>
								</thead>
								<tbody>
									<tr><td>Slovensko</td><td>sk</td></tr>
									<tr><td>Česká republika</td><td>cz</td></tr>
									<tr><td>Maďarsko</td><td>hu</td></tr>
									<tr><td>Rakúsko</td><td>at</td></tr>
									<tr><td>Poľsko</td><td>pl</td></tr>
								<tbody>
							</table>
						</div>
					</div>
					<br>
					
				
				</div>
			</div>
		</div>
		
	</body>
</html>