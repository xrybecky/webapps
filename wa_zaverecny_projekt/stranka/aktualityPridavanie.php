<?php
session_start();
include 'config.php';
include 'menu.php'; // presunul som include na zaciatok suboru - inak mi zvykla blbnut session

/*** pridana cast = pridanie aktuality ***/
if($_SESSION['lang'] == "sk"){
    $btn_nova_aktualita = "Pridaj novú aktualitu";
    $header_news = "Nadpis aktuality";
    $write_news = "Tu napíš správu...";
    $add_news = "Pridaj aktualitu";
} else {
    $btn_nova_aktualita = "Add new news";
    $header_news = "Header news";
    $write_news = "Here write news...";
    $add_news = "Add news";
}
/*** koniec casti ***/		
	
	$mysqli->connect($server,$user,$pass,$db);
	$mysqli->query("SET NAMES 'utf8'");
	$jazykS = $_SESSION["lang"];
	if(mysqli_connect_error()){
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
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
			echo "aaaa";
		}
	}
	
	
?>


<!DOCTYPE html>
<html>

<head>
    <title>Aktuality</title>
    <meta charset="UTF-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-aktualit.css">
    <link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>

   
    <style>
        /*** css style pre pridanie aktuality ***/
        #html5-elem-box {
            height: inherit !important;
        }
        
        #html5-watermark {
            display: none !important;
        }
        
        .lightboxcontainer {
            width: 100%;
            text-align: left;
        }
        
        .lightboxleft {
            width: 40%;
            float: left;
        }
        
        .lightboxright {
            width: 60%;
            float: left;
        }
        
        .lightboxright iframe {
            min-height: 390px;
        }
        
        .divtext {
            margin: 36px;
        }
        
        @media (max-width: 800px) {
            .lightboxleft {
                width: 100%;
            }
            .lightboxright {
                width: 100%;
            }
            .divtext {
                margin: 12px;
            }
        }
        /*** koniec casti ***/
    </style>
</head>

<body>
        <div class="row">
            <div class="col-md-9">
                <h1>Aktuality</h1>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        
        <!-- ak je prihlaseny admin na stranke tak sa zobrazi button pre pridanie aktuality + div s lightboxom /formular/ -->
<?php if(isset($_SESSION['login'])){?>
        <a href="#mydiv" class="html5lightbox btn btn-primary" data-width=800 data-height=400>
            <?php echo $btn_nova_aktualita;?>
        </a>

        <div id="mydiv" style="display:none;">
            <div class="lightboxcontainer">
                <div class="divtext" style="text-align: center;">
                    <input placeholder="<?php echo $header_news; ?>" name="header_aktuality" type="text">
                    <br>
                    <br>
                    <textarea placeholder="<?php echo $write_news;?>" cols="70" rows="10" name="body_aktuality"></textarea>
                    <br>
                    <br>
                    <input class="btn btn-success" type="submit" name="submitBtn" value="<?php echo $add_news;?>">
                </div>

            </div>
        </div>
<?php } ?>
       <!-- koniec lightboxu -->
        <div class="row">
            <div class="col-md-9">
                <?php 
				//Kod na citanie noviniek z databazy
				
			?>
                    <div class="novinka">
                        <h3 class="novinka_title">Ukážka novinky</h3>
                        <div class="novinka_telo">
                            Lorem ipsum dolor sit amet, ad mel choro disputationi, vero debitis per ne. Tation qualisque evertitur vix ad, vivendo electram comprehensam nam te. Ne mea eripuit deterruisset, vix ad delectus mandamus, modus recusabo est ut. Ei laudem scaevola expetendis cum. Ne ferri possit ius. Eos cu vocent scripta antiopam.
                        </div>
                    </div>
            </div>

            <div class="col-md-3">
                <div id="sub_to_news">
                    <h4>Prihlásiť sa na odber noviniek</h4>
                    <form action="aktuality.php" method="POST">
                        <input type="hidden" name="toRegister" value="1">

                        <b>Jazyk:</b>
                        <br/>
                        <select name="language" id="sel_lang">
                            <option value="sk">Slovenský</option>
                            <option value="en">English</option>
                        </select>
                        <br/>
                        <br/>

                        <b>Email:</b>
                        <br/>
                        <input type="text" name="email" placeholder="Email" id="email_form" />
                        <br/>
                        <br/>

                        <input type="submit" name="submit" value="Prihlas na odber" class="btn btn-warning" />
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="html5lightbox/html5lightbox.js"></script>
</body>
<html>