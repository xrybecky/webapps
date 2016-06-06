<!DOCTYPE HTML>
<html>
    <head>
		<meta charset="utf-8">
		<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script type="text/javascript" src="canvasjs/canvasjs.min.js"></script>
		<link rel="stylesheet" href="css/app-style.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/style-menu.css">
		<link rel="stylesheet" href="css/style-aktualit.css">
		<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet" type="text/css">
		
		<?php
			$translate['getkey']['sk'] = 'Získať API kľúč';
			$translate['getkey']['en'] = 'Get API key';
		?>
		
        <title>REST API</title>
		<?php
			include 'pdfcrowd/pdfcrowd.php';
			if($_POST['export']){
				try{   
					// create an API client instance
					$client = new Pdfcrowd("userexists", "60763037add633224e1dc7c977a9106c");

					// convert a web page and store the generated PDF into a $pdf variable
					$pdf = $client->convertUri('http://147.175.98.229/projekt/git/rest.php');

					// set HTTP response headers
					header("Content-Type: application/pdf");
					header("Cache-Control: max-age=0");
					header("Accept-Ranges: none");
					header("Content-Disposition: attachment; filename=\"ApiPopis.pdf\"");
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
				$contents = file_get_contents('rest.php');

				// Example of adding a file to the archive directly from a file on the filesystem.
				$zip->addFile('model/META-INF/container.xml', 'META-INF/container.xml');
				readfile($filename);
			}

		?>

	</head>
    <body class="inner">
		<?php 
			include('menu.php');
		?>
		<div class="row">
			<div class="col-md-12">
				<h1>REST API</h1>
			</div>
			<div class="col-md-10 col-md-offset-1">
				<?php
					if(isset($_POST['email'])){
						$mysqli = new mysqli('localhost', 'root', '06834265', 'spolzadanie');
						$email = $_POST['email'];
						$check_key = "SELECT * FROM apis WHERE email='$email'";	
						$result_check = $mysqli->query($check_key);
						$key = '';
						if($result_check->num_rows == 0){
							$rand = rand(1,5000);
							$key = md5($rand);
							$query_insert = "INSERT INTO apis (`id_key`, `email`, `api_key`) VALUES ('NULL', '$email', '$key')";
							$mysqli->query($query_insert);
						}else{
							$key = $result_check->fetch_array(MYSQLI_ASSOC)['key'];
						}
						echo '<p>Kľúč: ' . $key . '</p>';
					}else{
						?>
					<form action="rest.php" method="post" class="form-inline">
						<div class="form-group">
							<label class="control-label">Email
								<input type="email" placeholder="Email" class="form-control" name="email">
							</label>
						</div>
						<input type="submit" value="<?php echo $translate['getkey'][$_SESSION['lang']]; ?>" class="btn btn-warning">
					</form>
				<?php } ?>
				<div class="text-container">
					<p>API slúži na získanie hodnôt Vašej funkcie a jej derivácie na zadanom intervale.</p>
					<h4>Formát požiadavky</h4>
						<p><b>Požiadavka:</b> 147.175.98.229/projekt/git/index.php/<?php if(isset($key)){ echo $key; } else{ echo '\'api-kľúč\'';}?>/'x1'/'x2'/'krok'?func='f(x)'</p>
						<p><b>x1</b> - začiatok intervalu</p>
						<p><b>x2</b> - koniec intervalu</p>
						<p><b>krok</b> - dĺžka medzi dvoma hodnotami</p>
						<p><b>Príklad požiadavky:</b> http://147.175.98.229/projekt/git/index.php/abc123/1/10/0,1?func=x</p>
						<p><b>Výstup JSON:</b><br>
										&#09;{<br>
												&#09;&#09;x:["1","2","3","4","5","6","7","8","9","10"], 	<br>
												&#09;&#09;y:["1","2","3","4","5","6","7","8","9","10"], 	<br>
												&#09;&#09;yd:["1","1","1","1","1","1","1","1","1"] 		<br>
											&#09;}</p>
					<div class="row">
						<div class="col-md-2">
							<form action="rest.php" method="POST">
								<input type="hidden" name="export" value="1"/>
								<input type="submit" name="exportS" class="btn btn-warning" value="Export PDF">
							</form>
						</div>
						<div class="col-md-2">
							<form action="rest.php" method="POST">
								<input type="hidden" name="exportEB" value="1"/>
								<input type="submit" name="exportSB" class="btn btn-warning" value="Export ePub">
							</form>
						</div>
					</div>
				</div>
			</div>	
		</div>		
    </body>
</html>
