
<?php
	session_start();
	include 'config.php';
	if(isset($_SESSION['lang'])){
		$jazykS = $_SESSION['lang'];	
	}else{
		$jazykS = "sk";	
	}

	$mysqli->connect($server,$user,$pass,$db);
	$mysqli->query("SET NAMES 'utf8'");
	$jazykS = $_SESSION["lang"];
	
	if(mysqli_connect_error()){
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	}
	
	function insertNews($title,$text){
		global $mysqli;
		$textEn = "";
		$text = urlencode($text);
		$from = 'sk';
		$to = 'en';

		//Preklad textu
		$key = 'aGNxZJXmmGdjWEvw+bvEBgnxqYWL3zXW4UTZo5NinYI';
		$ch = curl_init('https://api.datamarket.azure.com/Bing/MicrosoftTranslator/v1/Translate?Text=%27'.$text.'%27&From=%27'.$from.'%27&To=%27'.$to.'%27');
		curl_setopt($ch, CURLOPT_USERPWD, $key.':'.$key);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		$result = explode('<d:Text m:type="Edm.String">', $result);
		$result = explode('</d:Text>', $result[1]);
		$textEn = $result[0];

		$text = urldecode($text);
		$textEn = urldecode($textEn);
		
		//Preklad nadpisu
		$title = urlencode($title);
		$ch = curl_init('https://api.datamarket.azure.com/Bing/MicrosoftTranslator/v1/Translate?Text=%27'.$title.'%27&From=%27'.$from.'%27&To=%27'.$to.'%27');
		curl_setopt($ch, CURLOPT_USERPWD, $key.':'.$key);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		
		$result = curl_exec($ch);
		$result = explode('<d:Text m:type="Edm.String">', $result);
		$result = explode('</d:Text>', $result[1]);
		$titleEn = $result[0];

		$titleEn = urldecode($titleEn);
		$title = urldecode($title);
		$query = "INSERT INTO news (title, title_en, text_sk, text_en) VALUES ('".$title."','".$titleEn."','".$text."', '".$textEn."')";
		$res = $mysqli->query($query);
		
	}
	


	
	if(isset($_POST["toRegister"])){
		
		$jazykNews = $_POST["language"];
		$email = $_POST["email"];
		$cis = rand(1,5000);
		$hash = md5($cis);
		
		$to      = $email; // Send email to our user
		$header = "From: noreply@147.175.98.149"; 
	
		$subject = 'Signup | Verification'; // Give the email a subject 
		if($jazykNews == "sk"){
			$message = '
				Prosim overte svoj email pre posielanie noviniek.
				Kliknite na tento link.
				http://147.175.98.149/FinZadanie/verify.php?email='.$email.'&hash='.$hash.'	
			
			'; // Our message above including the link
		}
		if($jazykNews == "en"){
			$message = '
				Please clikn on lin below to verify your email:
				http://147.175.98.149/FinZadanie/verify.php?email='.$email.'&hash='.$hash.'	
			
			'; // Our message above including the link
		}
		
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers = 'From: abc.co.in' . "\r\n". 'Reply-To: noreply@147.175.98.149' . "\r\n" .'X-Mailer: PHP/' . phpversion();
		$headers .= 'Content-type : text/html; charset=iso-8859-1' . "\r\n";
		
		$mail = mail($email, $subject, $message, $header); // Send our email
		
		if($mail){
			$queryAddUser = "INSERT INTO newsusers (email, hash, lang) VALUES ('$email','$hash','$jazykNews')";
			$resultI = $mysqli->query($queryAddUser);
		}
	}
	if($_POST["addA"]){
		insertNews($_POST["header_aktuality"],$_POST["body_aktuality"]);
	}
	
	if($_POST["send"]){
		$idA = $_POST["idA"];
		$query="SELECT title, title_en, text_sk, text_en FROM news WHERE id = '".$idA."'";
	
		$res = $mysqli->query($query);
		
		if($res->num_rows > 0){
			
			$obj = $res->fetch_object();
			$titleSk = $obj->title;
			$titleEn = $obj->title_en;
			$textSk = $obj->text_sk;
			$textEn = $obj->text_en;
			
			$query= "Select email, lang, hash as hs FROM newsusers WHERE verified = 1";
			$resU = $mysqli->query($query);
		
			while($obj = $resU->fetch_object()){
				echo "aaa";
				$email = $obj->email;
				$jazykN = $obj->lang;
				$to      = $email; // Send email to our user
				$header = "From: noreply@147.175.98.149"; 
				$hash = $obj->hs;
				$subject = 'News'; // Give the email a subject 
				$message = '<html><body>';
				if($jazykN == "sk"){
			
					$message .= "
						<h2>$titleSk</h2> <br/><br/>
						$textSk<br/><br/>
						
						Odhlásiť z odoberania noviniek: <br/><br/>
						http://147.175.98.149/FinZadanie/unsubscribe.php?email=$email&hash=$hash	
					"; // Our message above including the link
				}
				if($jazykN == "en"){
					$message .= "
					<h2>$titleEn</h2> <br/><br/>
						$textEn<br/><br/>
						
						Odhlásiť z odoberania noviniek: <br/><br/>
						http://147.175.98.149/FinZadanie/unsubscribe.php?email=$email&hash=$hash	
					"; // Our message above including the link
				}
				$message .= '</body></html>';
				$headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
				$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
				$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								
				$mail = mail($email, $subject, $message, $headers); // Send our email
				echo $email." ";
			}
		}
	}
	$preklad["news"]["en"] = "News";
	$preklad["news"]["sk"] = "Aktuality";
	$preklad["odberTitle"]["en"] = "Subscribe for news";
	$preklad["odberTitle"]["sk"] = "Prihlásiť sa na odber noviniek";
	$preklad["lang"]["en"] = "Language";
	$preklad["lang"]["sk"] = "Jazyk";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Aktuality</title>
		<meta charset="UTF-8">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script src="js/html5lightbox.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/style-aktualit.css">
		<link rel="stylesheet" href="css/style-lightbox.css">
		<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>	
	
	</head>
	<body class = "inner">
		<?php include 'menu.php';?>

		<h1><?php echo $preklad["news"][$lang];?></h1>
		<a id="rss" href="rss/rss.xml" target="_blank">
			<img src="imgs/rss.png" alt="rss">
		</a>
	<?php
        /*** pridana cast = pridanie aktuality ***/
        if(isset($_GET['lang'])){
            $_SESSION['lang'] = $_GET['lang'];
        }
	if($_SESSION['lang'] == "en"){
		$btn_nova_aktualita = "Add new news";
		$header_news = "Header news";
		$write_news = "Here write news...";
		$add_news = "Add news";
	} else {
        $btn_nova_aktualita = "Pridaj novú aktualitu";
		$header_news = "Nadpis aktuality";
		$write_news = "Tu napíš správu...";
		$add_news = "Pridaj aktualitu";
	}
/*** koniec casti ***/	
//		   ak je prihlaseny admin na stranke tak sa zobrazi button pre pridanie aktuality + div s lightboxom /formular/ 
		 if(isset($_SESSION['login'])){?>
			<a style="margin-left: 20px;" href="#mydiv" class="html5lightbox btn btn-primary" data-width=800 data-height=400> 
				<?php echo $btn_nova_aktualita;
				?>
			</a>

			<div id="mydiv" style="display:none;">
				<div class="lightboxcontainer">
					<div class="divtext" style="text-align: center;">
					<form action="aktuality.php" method="POST">
						<input type="hidden" name="addA" value="1"/>
						<input placeholder="<?php echo $header_news; ?>" name="header_aktuality" type="text">
						<br>
						<br>
						<textarea placeholder="<?php echo $write_news;?>" cols="70" rows="10" name="body_aktuality"></textarea>
						<br>
						<br>
						<input class="btn btn-success" type="submit" name="submitBtn" value="<?php echo $add_news;?>">
					</form>
					</div>

				</div>
			</div>
				
		<?php } ?>
		<div class="row">
			<div class="col-md-8">
			<?php 
				$query = "SELECT id,text_sk,text_en,title,title_en,date FROM news ORDER BY date DESC";
				$result = $mysqli->query($query);
				$i = 0;
				while(($obj = $result->fetch_object())&&($i < 5)){
					echo "<div class=\"novinka\">";
						if($lang == "sk"){
							echo "<h3 class=\"novinka_title\">".$obj->title."</h3>";
						}else if($lang == "en"){
							echo "<h3 class=\"novinka_title\">".$obj->title_en."</h3>";
						}else{
							echo "<h3 class=\"novinka_title\">".$obj->title."</h3>";
						}
	
					echo "<div class=\"novinka_telo\">";
					if($lang == "sk"){
						echo $obj->text_sk;
					}else if($lang == "en"){
						echo $obj->text_en;
					}else{
						echo $obj->text_sk;
					}
					echo "</div>";
						if(isset($_SESSION['login'])){
						echo "<form action=\"aktuality.php\" method=\"POST\">";
						echo "<input type=\"hidden\" name=\"send\" value=\"1\"/>";
						echo "<input type=\"hidden\" name=\"idA\" value=\"$obj->id\"/>";
						echo "<input type=\"submit\"  class= \"btn btn-primary\" name=\"submit\" value=\"Odošli novinky $obj->id\"/>";	
						echo "</form>";
			
					}
								echo "</div><br/>";
					$i++;
				}
				
			?>
			</div>
			<div class="col-md-4">
				<div id="sub_to_news">
					<h4><?php echo $preklad["odberTitle"][$lang]?></h4>
					<form action="aktuality.php" method="POST">
						<input type="hidden" name="toRegister" value="1">
						
						<b><?php echo $preklad["lang"][$lang]?>:</b><br/>
						<select name="language" id="sel_lang">
							<option value="sk">Slovenský</option>
							<option value="en">English</option>
						</select><br/><br/>
						
						<b>Email:</b><br/>
						<input type="text" name="email" placeholder="Email" id="email_form"/><br/><br/>
					
						<input type="submit" name="submit" value="Prihlas na odber" class="btn btn-warning"/>
					</form>
				</div>	
			</div>
		</div>
	</body>
</html>
