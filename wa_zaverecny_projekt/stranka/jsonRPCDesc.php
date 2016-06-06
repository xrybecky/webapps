<?php
	include 'pdfcrowd/pdfcrowd.php';
	$pdfcAPI = "158ff6968aaa30f622ee26141cee960f";
	session_start();
	if(isset($_SESSION["lang"])){
		$lang = $_SESSION["lang"];
	}else{
		$lang = "sk";
	}
	$apikey = " ";
	$preklad["export"]["en"]="Export to PDF";
	$preklad["export"]["sk"]="Exportovať do PDF";
	$preklad["exportEB"]["en"]="Export to ePub";
	$preklad["exportEB"]["sk"]="Exportovať do ePub";
	$preklad["apikey"]["en"]="Get API key";
	$preklad["apikey"]["sk"]="Získať API kľúč";
	$preklad["title"]["sk"]="Popis API JSON-RPC pre výpočet funkcií";
	$preklad["title"]["en"]="JSON-RPC API Description";
	
	if($_POST["generate"]){
		$rand = rand(1,5000);
		$apikey = md5($rand);
		
		echo "generujem";
		if ($tmpFile = fopen ('keys.txt','a')) {
			fwrite($tmpFile,$apikey." ");
			fclose($tmpFile);
		} else {
			throw new Exception('Unable to change the internal state');
		}
	}
	if($_POST["export"]){
		try{   
			// create an API client instance
			$client = new Pdfcrowd("userexists", "60763037add633224e1dc7c977a9106c");

			// convert a web page and store the generated PDF into a $pdf variable
			$pdf = $client->convertUri('http://147.175.98.149/FinZadanie/jsonRPCDesc.php?lang=sk');

			// set HTTP response headers
			header("Content-Type: application/pdf");
			header("Cache-Control: max-age=0");
			header("Accept-Ranges: none");
			header("Content-Disposition: attachment; filename=\"ApiPopis.pdf\"");
			echo "aaaa";
			// send the generated PDF 
			echo $pdf;
		}catch(PdfcrowdException $why){
			echo "Pdfcrowd Error: " . $why;
		}
	}
	
	if($_POST["exportEB"]){
		$filename = 'Navod.epub';
		$mimetype = 'model/mimetype'; 
		header('Content-type: application/epub+zip');
		header('Content-disposition:attachment;filename=Navod.epub');
		header('Content-Transfer-Encoding: binary');
		



		system("zip -q0Xj $filename $mimetype");

		// For the rest of the epub file, lets use the easier ZipArchive php class.
		$zip = new ZipArchive();

		if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
		 // error out here
		}

		// Example of creating folders in the archive.
		$zip->addEmptyDir('META-INF');

		// Example of adding a file via the contents of another file
		$contents = file_get_contents('jsonRPCDesc.php');

		// Example of adding a file to the archive directly from a file on the filesystem.
		$zip->addFile('model/META-INF/container.xml', 'META-INF/container.xml');
		readfile($filename);

	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Aktuality</title>
		<meta charset="UTF-8">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/app-style.css">
		<link rel="stylesheet" href="css/style.css">
		<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>	

	</head>
	<body class="inner">
		<?php include 'menu.php';?>
		<br/><br/>
		<div id="popis" class="text-container">
			<h2><?php echo $preklad["title"][$lang];?></h2>
			<h3>Link</h3>
				<p>	
					API je dostupná na adrese <b>147.175.98.229/projekt/git/jsonService.php</b>
				</p>
			<h3>Dostupné metódy</h3>
				<p>	
				   <b>Metóda getCoordinates($begin,$end,$func,$key)</b><br/><br/>
					Na základe rozsahu, zadaného parametrami <b>$begin</b> a <b>$end</b> a funkcie <b>$func</b>. Na využívanie API je potrebné použiť kľúč<br/>
					@param begin(začiatok intervalu funkcie) <br/>
					@param end(koniec intervalu funkcie) <br/><br/>
					@param func(funkcia pre výpočet) <br/><br/>
					@param key(api kľúč na používanie API) <br/><br/>
				</p>
			<h3>Výsledok</h3>
				<p>	
					Výsledok je dostupný vo formáte <b>JSON</b>.
					X-ové súradnice majú označenie <b>x</b> a y-ové majú označenie <b>y</b>.
					Udalosti/Meniny majú označenie <b>podľa skratky krajiny(SK,CZ,...)</b>
				</p>
			<h3>Pripojenie</h3>
				<p>	
					Na pripojenie použite <b>jsonRPCClient</b>
				</p>
				<form action="jsonRPCDesc.php" method="POST">
					<input type="hidden" name="export" value="1"/>
					<input type="submit" name="exportS" class="btn btn-primary" value="<?php echo $preklad["export"][$lang]?>">
				</form>	<br/>
				
				<form action="jsonRPCDesc.php" method="POST">
					<input type="hidden" name="exportEB" value="1"/>
					<input type="submit" name="exportSB" class="btn btn-primary" value="<?php echo $preklad["exportEB"][$lang]?>">
				</form>	<br/>
				
				<form action="jsonRPCDesc.php" method="POST">
					<input type="hidden" name="generate" value="1"/>
					<input type="submit" name="generateS" class="btn btn-primary" value="<?php echo $preklad["apikey"][$lang]?>">
				</form>	
				Váš api kľúč je<b> <?php echo $apikey?></b>
		</div>	


	
	</body>
</html>