<!DOCTYPE html>
<html>
<head>
    <title>Technická dokumentácia</title>
    <meta charset="UTF-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style-menu.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-aktualit.css">
    <link rel="stylesheet" href="css/style-lightbox.css">
    <link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
</head>

<body class="inner">
<?php
include 'menu.php';
?>
<br><br><br>
<div class="container">
    <div class="row col-lg-12">
        <div class="row col-lg-12">
        <div class="col-lg-4 col-md-8">
            <div class="novinka">
                <h3 class="novinka_title">Aplikácia <a href="aplikacia.php"><span class="glyphicon glyphicon-hand-right"></span></a></h3> <p class="novinka_telo">Podstránka Aplikácia obsahuje aplikáciu na vykreslenie hodnôt funkcie a jej derivácie do grafu.  <br>Na tvorbu tejto podstránky boli použité tieto technológie: maxima, octave,canvasJS, jquery. <br>Dodatočne bolo nutné nainštalovať: maxima: sudo apt-get install maxima <br>
                Octave: sudo apt-get install octave
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-8">
            <div class="novinka">
                <h3 class="novinka_title">REST API <a href="rest.php"><span class="glyphicon glyphicon-hand-right"></span></a></h3> <p class="novinka_telo">Podstránka REST API obsahuje popis služby REST. Na stránke je potrebné zadať mail na vygenerovanie API kľúča potrebného pre využitie služby.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-8">
            <div class="novinka">
                <h3 class="novinka_title">JSON-RPC API <a href="jsonRPCDesc.php"><span class="glyphicon glyphicon-hand-right"></span></a></h3> <p class="novinka_telo">Podstránka JSON-RPC API obsahuje popis služby JSON-RPC. Pre využitie služby je nutné najskôr získať API kľúč.  <br>Na tvorbu tejto podstránky boli použité tieto technológie: pdfcrowd,JSON RPC api</p>
            </div>
        </div>
            </div>
        <div class="row col-lg-12">
        <div class="col-lg-4 col-md-8">
            <div class="novinka">
                <h3 class="novinka_title">Aktuality<a href="aktuality.php"><span class="glyphicon glyphicon-hand-right"></span></a></h3> <p class="novinka_telo">Na stránke sú zobrazené aktuality. Po výbere jazyka a zadaní emailovej adresy je možné prihlásiť sa na odber noviniek cez email. Taktiež je mozný ober cez rss. <br>Na tvorbu tejto podstránky boli použité tieto technológie: sendmail<br>Dodatočne bolo nutné nainštalovať: sendmail: sudo apt-get install sendmail</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-8">
            <div class="novinka">
                <h3 class="novinka_title">Technická správa <a href="tech.php"><span class="glyphicon glyphicon-hand-right"></span></a></h3> <p class="novinka_telo">Na stránke sa nachádza popis jednotlivých podstránok. <br>Na tvorbu tejto podstránky boli použité tieto technológie: php, html5, css.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-8">
            <div class="novinka">
                <h3 class="novinka_title">Kontakt <a href="kontakt.php"><span class="glyphicon glyphicon-hand-right"></span></a></h3> <p class="novinka_telo">Na stránke sa nachádza zoznam členov tímu s kontaktom na jednotlivých členov. Taktiež je tu zobrazené rozdelenie úloh.</p>
            </div>
        </div>
            </div>
        <div class="row col-lg-12">
            <div class="col-lg-4 col-md-8">
                <div class="novinka">
                    <h3 class="novinka_title">Prihlásiť sa <a href="login.php"><span class="glyphicon glyphicon-hand-right"></span></a></h3> <p class="novinka_telo">Slúži na prihlásenie a zobrazenie funkcií administrátora. Ten môže pozerať štatistiky o návštevnosti a pridávať novinky.<br>Na tvorbu tejto podstránky boli použité tieto technológie: mysql, html5lightbox.<br>Využité bolo aj API na zistenie polohy z IP adresy:<br>
                   http://ip-api.com</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <div class="novinka">
                    <h3 class="novinka_title">Ostatné informácie </h3> <p class="novinka_telo">Menu bolo vytvorené pomocou jQuery a Bootstrap. Stránka ponúka 2 jazykové možnosti - slovenčina a angličtina.<br>
                    Pri tvorbe zadania bol použitý verzionovací systém Git: sudo apt-get install git. <br> Dizajn stránky je responzívny.<br>Stránka je validná podľa HTML5</p>
                </div>
            </div>
            </div>
    </div>
</div>
</body>
</html>

